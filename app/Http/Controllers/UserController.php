<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Exibe a página inicial
    public function index(){
        
        //dd("Index foi acessado!");
        return view('home.index');
    
    }
     // Metodo para buscar usuer
     public function search(Request $request)
     {
         $users = [];
     
         if ($request->filled('name')) {
             $name = $request->input('name');
     
             // Pesquisa nos campos 'firstname' e 'lastname' usando 'orWhere' para procurar em qualquer parte do nome
             $users = User::where('firstname', 'like', '%' . $name . '%')
                 ->orWhere('lastname', 'like', '%' . $name . '%')
                 ->get();
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
        $user->delete(); // Remove o usuário do banco de dados
        return redirect()->route('users.listusers')->with('success', 'Usuário removido com sucesso!'); // Redireciona para a lista de usuários com uma mensagem de sucesso
    }
    
}


