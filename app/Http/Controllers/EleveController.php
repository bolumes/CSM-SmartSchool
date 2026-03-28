<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EleveController extends Controller
{
    
       

    // Metodo para buscar usuários com function = 'Parent'
    public function search(Request $request)
    {
        // Inicialize a variável de usuários
        $users = [];

        if ($request->filled('name')) {
            $name = $request->input('name');

            // Pesquisa apenas usuários com function = 'Parent' e que correspondam ao nome
            $users = User::where('function', 'Eleve')
                ->where(function ($query) use ($name) {
                    $query->where('firstname', 'like', '%' . $name . '%')
                        ->orWhere('lastname', 'like', '%' . $name . '%');
                })
                ->paginate(10);  // Paginação com 10 resultados por página
        }

        return view('users.search', compact('users'));
    }

     
    
    // Exibe a lista de usuários com function = 'Parent'
    public function listeleves()
    {
        $users = User::where('function', 'Eleve')->get();

        return view('users.listusers', compact('users'));
    }


    // Exporta os dados dos usuários para CSV
    public function export(Request $request)
    {
        $filename = 'users_eleves.csv'; // Nome sugerido para refletir o filtro

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

            // Filtra apenas usuários com function = 'Parent'
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


