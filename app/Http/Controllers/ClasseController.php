<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClasseRequest;
use App\Http\Requests\UpdateClasseRequest;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function search(Request $request)
    {
        $classes = [];
    
        if ($request->filled('code')) {
            $name = $request->input('name');
    
            $classes = Classe::where('name', 'like', '%' . $name . '%')->get();
        }
    
        return view('classes.search', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('classes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClasseRequest $request)
    {
        // Valida os dados do formulário
        $data = $request->validated();

        // Cria o registro no banco
        Classe::create($data);

        // Redireciona com mensagem de sucesso
        return redirect()->route('classes.create')->with('success', 'Classe criada com sucesso!');
    }


    /**
     * Display a listing of the resource.
     */
    public function listclasses()   
    {
        //dd("Listar Classes foi acessado!");
        $classes = Classe::all(); // Obtém todas as classes do banco de dados
        return view('classes.listclasses', ['classes' => $classes]); // Retorna a view com os classes
    }

    /**
     * Display the specified resource.
     */
    public function show(Classe $classe)
    {
        //dd("Classe foi acessado!");
        return view('classes.show', compact('classe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classe $classe)
    {
        //dd($classe); // Exibe os dados da classe
        return view('classes.edit', compact('classe')); // Retorna a view com os dados da classe
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClasseRequest $request, Classe $classe)
    {
        //dd($classe); // Exibe os dados da classe
        $data = $request->validated(); // Valida os dados do formulário


        // Atualiza os dados do usuário com os dados validados
        $classe->update([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'level' => $request->input('level'),
            'description' => $request->input('description'),
        ]);

        // Redireciona com mensagem de sucesso
        return redirect()->route('classes.edit', $classe)->with('success', 'Classe atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classe $classe)
    {
        //dd($classe); // Exibe os dados da classe
        $classe->delete(); // Deleta a classe do banco de dados

        // Redireciona com mensagem de sucesso
        return redirect()->route('classes.listclasses')->with('success', 'Classe deletada com sucesso!');
    }

    /**
     * Exportar os dados das classes para Excel
     */
   public function export(Request $request)
    {
        $classes = Classe::all(); // Obtém todas as classes do banco de dados

        // Cria um arquivo CSV
        $filename = 'classes.csv';
        $handle = fopen($filename, 'w+');

        // Cabeçalho do CSV
        fputcsv($handle, ['ID', 'Nom', 'Code', 'Niveau', 'Description']);

        foreach ($classes as $classe) {
            fputcsv($handle, [
                $classe->id,
                $classe->name,
                $classe->code,
                $classe->level,
                $classe->description
            ]);
        }

        fclose($handle);

        // Retorna o arquivo para download e apaga depois
        return response()->download($filename)->deleteFileAfterSend(true);
    }

}
