<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    

    // Exibe a página inicial
    public function index(){
        
        //dd("Index foi acessado!");
        return view('home.index');
    }

    // Exibe a página de signup

    public function signup()
    {
        if (Auth::check()) {
            // Se o usuário estiver logado, redireciona para a página inicial ou para o painel
            return redirect()->route('home.welcome'); // Ou outra rota que você queira redirecionar
        }

        return view('home.signup'); // Retorna a view com o formulário de signup
    }

    // Exibe a página inicial 0
    public function index0(){
        
        //dd("Index foi acessado!");
        return view('home.index0');
    }

    // Exibe a página de contato
    public function contact()
    {
        //dd("Contact foi acessado!");
        return view('home.contact'); 
    }
    // Exibe a página sobre
    public function about()
    {
        //dd("About foi acessado!");
        return view('home.about'); 
    }

    // Exibe a página de serviços
    public function services()
    {
        //dd("About foi acessado!");
        return view('home.services'); 
    }

    // Exibe a página de gestacad
    public function gestacad()
    {
        //dd("gestacad foi acessado!");
        return view('home.gestacad'); 
    }

    // Exibe a página de gestchat
    public function gestchat()
    {
        //dd("gestchat foi acessado!");
        return view('home.gestchat');
    }

    // Exibe a página de gesteventos
    public function gesteventos()
    {
        //dd("gesteventos foi acessado!");
        return view('home.gesteventos'); 
    }

    // Exibe a página de acess rapide
    public function acessrapide()
    {
        //dd("acessrapide foi acessado!");
        return view('home.acessrapide'); 
    }

    // Exibe a página de login
    public function login() 
    {
        if (Auth::check()) {
            return redirect()->route('home.welcome'); // Redireciona se já estiver logado
        }

        return view('login'); // Só retorna a view limpa
        
    }
        

    // Método para processar a autenticação (POST)
    public function authenticate(Request $request)
    {
        // Validação dos campos do formulário
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Tentativa de autenticação com 'remember me'
        if (Auth::attempt($credentials, $request->has('remember'))) {
            // Regenera a sessão para evitar fixação de sessão
            $request->session()->regenerate();

            // Redireciona para a página desejada
            return redirect()->intended(route('home.welcome'));
        }

        // Se a autenticação falhar, retorna para o login com uma mensagem de erro
        return back()->withErrors([
            'email' => 'As credenciais fornecidas estão incorretas. Por favor, tente novamente.',
        ])->onlyInput('email');
    }


    // Exibe a página de sair
    public function sair()
    {
        //dd("Sair foi acessado!");
        return view('home.sair');
    }   


  

     // Metodo para buscar usuer
     public function search(Request $request)
        {
            // Inicialize a variável de usuários
            $users = [];

            if ($request->filled('name')) {
                $name = $request->input('name');

                // Pesquisa nos campos 'firstname' e 'lastname' usando 'orWhere' para procurar em qualquer parte do nome
                $users = User::where('firstname', 'like', '%' . $name . '%')
                            ->orWhere('lastname', 'like', '%' . $name . '%')
                            ->paginate(10);  // Usando paginate para paginar os resultados, 10 por página
            }

            return view('users.search', compact('users'));
        }

     


    // Exibe a página inicial
    public function settings()
    {
        //dd("settings foi acessado!");
        return view('home.settings'); 
    }

    // Exibe a página de boas-vindas
    public function welcome()
    {
        //dd("Welcome foi acessado!");
        return view('home.welcome'); 
    }

    // Exibe a página de criação de usuários
    public function create()
    {
        //dd("Create foi acessado!");
        return view('users.create'); 
    }

    
    public function show(User $user) // Recebe um objeto User como parâmetro
    {
        //dd($user); // Exibe os dados do usuário
        return view('users.show', ['user' => $user]); // Retorna a view com os dados do usuário
    }

    // storeSignup - Armazena os dados do usuário durante o signup

    public function storeSignup(UserRequest $request)
    {
        $request->validated();

        User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'telephone' => $request->telephone,
            'address' => $request->address,
            'function' => $request->function,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Certifique-se de criptografar a senha
        ]);

        return back()->with('success','Cadastro realizado com sucesso!');
    }


    // Armazena os dados do usuário
   public function store(UserRequest $request)
    {
        $currentUser = auth()->user();

        if (!$currentUser) {
            abort(403, 'Acesso não autorizado.');
        }

        $allowedFunctions = match ($currentUser->function) {

            // Admin pode criar tudo
            'Admin' => [
                'Admin',
                'Direction',
                'Se_Direction',
                'Se_Administratif',
                'Se_Financier',
                'Professeur',
                'Parent',
                'Eleve',
            ],

            // Direção
            'Direction' => [
                'Se_Direction',
                'Se_Administratif',
                'Se_Financier',
                'Professeur',
                'Parent',
                'Eleve',
            ],

            // Secretário Administrativo
            'Se_Administratif' => [
                'Se_Direction',
                'Se_Financier',
                'Professeur',
                'Parent',
                'Eleve',
            ],

            // Secretário de Direção
            'Se_Direction' => [
                'Parent',
                'Eleve',
            ],

            // Secretário Financeiro
            'Se_Financier' => [
                'Parent',
                'Eleve',
            ],

            default => [],
        };

        $data = $request->validated();

        // Verifica se pode criar esta função
        if (!in_array($data['function'], $allowedFunctions)) {
            return back()->withErrors([
                'function' => 'Não possui permissão para criar este tipo de utilizador.'
            ])->withInput();
        }

        // Apenas alunos possuem classe
        if ($data['function'] !== 'Eleve') {
            $data['classe_id'] = null;
        }

        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return redirect()
            ->route('users.create')
            ->with('success', 'Utilizador criado com sucesso!');
    }
    
    // Exibe a lista de todos os usuários
    public function listusers()
    {
        $users = User::all();

        return view('users.listusers', compact('users'));
    }

    // Mostra detalhes de um único usuário
    public function showPermission(User $user)
    {
        return view('users.showPermission', compact('user')); // Blade: show-permission.blade.php
    }

    // Mostra detalhes de um único usuário para a direção
    public function showPerDirection()
    {
        $user = auth()->user(); // usuário autenticado

        if (!in_array($user->function, ['Admin', 'Direction'])) {
            abort(403, 'Acesso não permitido');
        }

        return view('users.showPerDirection', compact('user'));
    }

    // Mostra detalhes de um único usuário para os pais
    public function showPerParent(User $user)
    {
        if($user->function !== 'Parent'){
            abort(403, 'Acesso não permitido');
        }

        return view('users.showPerParent', compact('user'));
    }

    // Mostra detalhes de um único usuário para os alunos
    public function showPerEleve(User $user)
    {

        if (strtolower(trim($user->function)) !== 'eleve') {
            abort(403, 'Acesso negado');
        }

        // Passa apenas este usuário para a view
        return view('users.showPerEleve', compact('user'));
    }

    // Mostra detalhes de um único usuário para os professores
    public function showPerProfessor(User $user)
    {
        if ($user->function !== 'Professeur') {
            abort(403, 'Acesso negado: usuário não é um professor.');
        }

        // Passa apenas este usuário para a view
        return view('users.showPerProfessor', compact('user'));
    }

    // Edita os dados do usuário
    public function edit(User $user)
    {
        $currentUser = auth()->user();

        // Não autenticado
        if (!$currentUser) {
            abort(403);
        }

        // Admin e Direction podem editar utilizadores
        if (in_array($currentUser->function, ['Admin', 'Direction'])) {
            return view('users.edit', compact('user'));
        }

        // Professor, Parent e Eleve só podem editar a própria conta
        if (
            in_array($currentUser->function, ['Professeur', 'Parent', 'Eleve'])
            && $currentUser->id === $user->id
        ) {
            return view('users.edit', compact('user'));
        }

        // Qualquer outra tentativa
        abort(403, 'Vous n\'êtes pas autorisé à modifier cet utilisateur.');
    }

    // Atualiza os dados do usuário
    public function update(UserRequest $request, User $user)
    {
        $currentUser = auth()->user();

        if (!$currentUser) {
            abort(403);
        }

        // Professor / Parent / Eleve
        // só podem alterar a própria conta
        if (
            in_array($currentUser->function, ['Professeur', 'Parent', 'Eleve'])
            && $currentUser->id !== $user->id
        ) {
            abort(403, 'Vous ne pouvez modifier que votre propre compte.');
        }

        // Admin e Direction podem editar outros utilizadores
        if (!in_array($currentUser->function, ['Admin', 'Direction'])) {

            // Um utilizador normal NÃO pode alterar a própria função
            $request->merge([
                'function' => $user->function,
            ]);
        }

        $request->validated();

        $user->update([
            'firstname'  => $request->input('firstname'),
            'lastname'   => $request->input('lastname'),
            'telephone'  => $request->input('telephone'),
            'address'    => $request->input('address'),
            'email'      => $request->input('email'),
            'function'   => $request->input('function'),
            'password'   => $request->filled('password')
                ? bcrypt($request->input('password'))
                : $user->password,
        ]);

        return redirect()
            ->route('users.show', $user)
            ->with('success', 'Utilisateur mis à jour avec succès.');
    }

    // Atualiza as permissões de chat do usuário

    public function chatUpdate(Request $request, User $user)
    {
        // Debug opcional (remova depois se quiser)
        // dd($request->all());

        // Validação
        $request->validate([
            'chat_direction' => 'required|in:0,1',
            'chat_parent' => 'required|in:0,1',
            'chat_professor' => 'required|in:0,1',
        ]);

        // Update apenas dos campos chat
        $user->chat_direction = (int) $request->chat_direction;
        $user->chat_parent = (int) $request->chat_parent;
        $user->chat_professor = (int) $request->chat_professor;

        $user->save();

        return redirect()
            ->route('users.showPermission', $user)
            ->with('success', 'Permissions chat mises à jour avec succès!');
    }




    // Remove o usuário do banco de dados
    /**
     * =====================================================================
     * ELIMINAR USUÁRIO
     * =====================================================================
     */
     /**
 * =====================================================================
 * ELIMINAR USUÁRIO
 * =====================================================================
 */
public function destroy(User $user)
{
    // ================================================================
    // 1. Obter o utilizador autenticado
    // ================================================================
    $currentUser = auth()->user();

    // Se não houver utilizador autenticado
    if (!$currentUser) {
        abort(403, 'Acesso não autorizado.');
    }

    // ================================================================
    // 2. PROTEÇÃO ABSOLUTA DO ADMIN
    // ================================================================
    // NINGUÉM pode eliminar um utilizador com function = Admin.
    if (strtolower(trim($user->function)) === 'admin') {

        return redirect()
            ->back()
            ->with(
                'error',
                'Não é permitido eliminar uma conta Admin.'
            );
    }

    // ================================================================
    // 3. ADMIN / DIRECTION
    // ================================================================
    // Admin e Direction podem eliminar utilizadores que não sejam Admin.
    if (in_array($currentUser->function, ['Admin', 'Direction'])) {

        $user->delete();

        return redirect()
            ->route('users.listusers')
            ->with(
                'success',
                'Usuário removido com sucesso!'
            );
    }

    // ================================================================
    // 4. PROFESSOR / PARENT / ELEVE
    // ================================================================
    // Estes utilizadores só podem eliminar a PRÓPRIA conta.
    if ($currentUser->id !== $user->id) {

        return redirect()
            ->back()
            ->with(
                'error',
                'Você só pode eliminar a sua própria conta.'
            );
    }

    // ================================================================
    // 5. ELIMINAR A PRÓPRIA CONTA
    // ================================================================
    $user->delete();

    // Fazer logout depois de eliminar a própria conta
    auth()->logout();

    // Invalidar a sessão
    request()->session()->invalidate();

    // Regenerar o token da sessão
    request()->session()->regenerateToken();

    return redirect()
        ->route('login')
        ->with(
            'success',
            'Sua conta foi excluída com sucesso.'
        );
}


    // Exporta os dados dos usuários para CSV
    public function export(Request $request)
        {
            $filename = 'users.csv';

            return response()->streamDownload(function () {

                $handle = fopen('php://output', 'w');

                // Cabeçalho CSV
                fputcsv($handle, [
                    'ID',
                    'First Name',
                    'Last Name',
                    'Email',
                    'Telephone',
                    'Address',
                    'Function'
                ]);

                // Todos os usuários (sem filtro)
                User::orderBy('firstname')
                    ->chunk(200, function ($users) use ($handle) {

                        foreach ($users as $user) {
                            fputcsv($handle, [
                                $user->id,
                                $user->firstname,
                                $user->lastname,
                                $user->email,
                                $user->telephone,
                                $user->address,
                                $user->function
                            ]);
                        }

                    });

                fclose($handle);

            }, $filename);
        }

        // Exibe a página de direitos dos usuários
        public function droit()
        {
            $users = User::all(); // ou o filtro que quiser

            return view('users.droits', compact('users'));
        }

        // Exibe a página de direitos dos usuários para a direção
        public function droitDirection()
        {
            $users = User::whereIn('function', ['Admin', 'Direction'])->get();

            return view('users.droitsDirection', compact('users'));
        }

        // Exibe a página de direitos dos usuários para os pais
        public function droitParent()
        {
            $users = User::whereIn('function', ['Parent'])->get();

            return view('users.droitsParent', compact('users'));
        }

        // Exibe a página de direitos dos usuários para os pais
        public function droitEleve()
        {
            $users = User::whereIn('function', ['Eleve'])->get();

            return view('users.droitsEleves', compact('users'));
        }

        // Exibe a página de direitos dos usuários para os pais
        public function droitProfessor()
        {
            $users = User::whereIn('function', ['Professeur'])->get();

            return view('users.droitsProfessor', compact('users'));
        }




    
}


