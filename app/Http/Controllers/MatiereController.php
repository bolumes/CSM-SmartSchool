<?php

namespace App\Http\Controllers;

use App\Models\Matiere;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMatiereRequest;
use App\Http\Requests\UpdateMatiereRequest;
use Illuminate\Http\Request;


class MatiereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function search(Request $request)
    {
        $matieres = [];
    
        if ($request->filled('name')) {
            $name = $request->input('name');
    
            $matiere = Matiere::where('name', 'like', '%' . $name . '%')->get();
        }
    
        return view('matieres.search', compact('matieres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('matieres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMatiereRequest $request)
    {
        // Valida os dados
        $data = $request->validated();

        // Verifica se um campo opcional foi preenchido
        if ($request->filled('description')) {
            // Talvez fazer algo extra aqui se a descrição estiver presente
        }

        // Cria a matéria
        Matiere::create($data);

        // Redireciona com sucesso
        return redirect()->route('matieres.create')->with('success', 'Matière criada com sucesso!');
    }


    /**
     * Display a listing of the resource.
     */
    public function listmatieres()  
    {
        //dd("Listar Matieres foi acessado!");
        $matieres = Matiere::all(); // Obtém todos os registros de Matieres
        return view('matieres.listmatieres', compact('matieres'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Matiere $matiere)
    {
        //dd("Listar Matieres foi acessado!");
        return view('matieres.show', compact('matiere'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Matiere $matiere)
    {
      
        return view('matieres.edit', compact('matiere'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMatiereRequest $request, Matiere $matiere)
    {
        //dd("Atualizar Matieres foi acessado!");
        // Valida os dados do formulário
        $data = $request->validated();


        // Atualiza os dados do usuário com os dados validados
        $matiere->update([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'level' => $request->input('level'),
            'description' => $request->input('description'),
        ]);

        // Redireciona com mensagem de sucesso
        return redirect()->route('matieres.edit', $matiere)->with('success', 'Matiere atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Matiere $matiere)
    {
        //dd("Deletar Matieres foi acessado!");
        // Remove o registro do banco de dados
        $matiere->delete();

        // Redireciona com mensagem de sucesso
        return redirect()->route('matieres.create')->with('success', 'Matiere deletada com sucesso!');
    }

    /**
    * Exportar os dados para Excel.
    */

    public function export(Request $request)
    {
        $matieres = Matiere::all(); // Obtém todas as matérias do banco de dados

        // Cria um arquivo CSV
        $filename = 'matieres.csv';
        $handle = fopen($filename, 'w+');

        // Cabeçalho do CSV
        fputcsv($handle, ['ID', 'Nom', 'Code', 'Niveau', 'Description']);

        foreach ($matieres as $matiere) {
            fputcsv($handle, [
                $matiere->id,
                $matiere->name,
                $matiere->code,
                $matiere->level,
                $matiere->description
            ]);
        }

        fclose($handle);

        // Retorna o arquivo para download e apaga depois
        return response()->download($filename)->deleteFileAfterSend(true);
    }
    
}
