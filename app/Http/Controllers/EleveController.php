<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;

class EleveController extends Controller
{
    // Busca por Eleve
    public function search(Request $request)
    {
        $users = [];

        if ($request->filled('search')) {

            $search = $request->input('search');

            $users = User::where('function', 'Eleve')
                ->where(function ($query) use ($search) {

                    // Se for número → pesquisa por ID
                    if (is_numeric($search)) {
                        $query->where('id', $search);
                    }

                    // Pesquisa por nome ou sobrenome
                    $query->orWhere('firstname', 'like', "%{$search}%")
                        ->orWhere('lastname', 'like', "%{$search}%");

                })
                ->get();
        }

        return view('eleve.search', compact('users'));
    }

    // Exibe os detalhes de um usuário específico
    public function show(User $user)
    {
        if ($user->function !== 'Eleve') {
            abort(404); // ou abort(403);
        }

        return view('eleve.show', ['user' => $user]);
    }

    // Exibe a lista de Eleve
    public function listeleve()
    {
        $users = User::where('function', 'Eleve')->get();

        return view('eleve.listeleve', compact('users'));
    }

    // Edita os dados do usuário
    public function edit(User $user)
    {
        return view('eleve.edit', ['user' => $user]); // Retorna a view de edição com os dados do usuário
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
        ]);

        //return redirect()->route('users.show')->with('success', 'Usuário atualizado com sucesso!');
        return redirect()->route('eleve.show', $user)->with('success', 'Eleve atualizado com sucesso!');

    }

    // Exporta os dados dos Eleve para CSV
    public function export(Request $request)
    {
        $filename = 'eleves.csv';

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

            // Apenas Eleves
            User::where('function', 'Eleve')
                ->orderBy('firstname')
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

}

