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
        // Valida os dados do formulário usando o UserRequest
        $request->validated();
    
        // Cria o usuário
        $user = User::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'telephone' => $request->input('telephone'),
            'address' => $request->input('address'),
            'function' => $request->input('function'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        
        // Redireciona direto pra home
        return redirect()->route('login')->with('success', 'Cadastro realizado com sucesso!');
    }


    // Armazena os dados do usuário
    public function store(UserRequest $request)
    {
        
        // Valida os dados do formulário usando o UserRequest
        $request->validated();
        
        // Cria um novo usuário com os dados validados
        User::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'telephone' => $request->input('telephone'),
            'address' => $request->input('address'),
            'function' => $request->input('function'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        //dd($request);
        return redirect()->route('users.create')->with('success', 'Usuário criado com sucesso!');
    }
    
    // Exibe a lista de usuarios
    public function listusers()
    {
        $users = User::all(); // Obtém todos os usuários do banco de dados
        return view('users.listusers', compact('users')); // Retorna a view com a lista de usuários
    }

    // Edita os dados do usuário
    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]); // Retorna a view de edição com os dados do usuário
    }

    // Atualiza os dados do usuário
    public function update(UserRequest $request, User $user)
    {
        // Valida os dados do formulário usando o UserRequest
        $request->validated();
        
        // Atualiza os dados do usuário com os dados validados
        $user->update([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'telephone' => $request->input('telephone'),
            'address' => $request->input('address'),
            'function' => $request->input('function'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'description' => $request->input('description'),
        ]);

        //return redirect()->route('users.show')->with('success', 'Usuário atualizado com sucesso!');
        return redirect()->route('users.show', $user)->with('success', 'Usuário atualizado com sucesso!');

    }

    // Remove o usuário do banco de dados
    public function destroy(User $user)
    {
        // Impede a exclusão de usuários com função "Admin" ou "Direction"
        if (in_array($user->role, ['Admin', 'Direction'])) {
            return redirect()->back()->with('error', 'Você não pode excluir um usuário com privilégio de Admin ou Direction.');
        }
    
        $currentUser = auth()->user();
    
        // Remove o usuário do banco de dados
        $user->delete();
    
        // Se o usuário deletado for o usuário autenticado, faz logout
        if ($currentUser->id === $user->id) {
            auth()->logout();
            return redirect()->route('login')->with('success', 'Sua conta foi excluída com sucesso.');
        }
    
        // Redireciona para a lista de usuários com mensagem de sucesso
        return redirect()->route('users.listusers')->with('success', 'Usuário removido com sucesso!');
    }
    
    
}


