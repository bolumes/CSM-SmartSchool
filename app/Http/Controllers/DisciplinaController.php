<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDisciplinaRequest;
use App\Http\Requests\UpdateDisciplinaRequest;
use Illuminate\Http\Request;

class DisciplinaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function search(Request $request)
    {
        $disciplinas = [];
    
        if ($request->filled('codigo')) {
            $codigo = $request->input('codigo');
    
            $disciplinas = Disciplina::where('codigo', 'like', '%' . $codigo . '%')->get();
        }
    
        return view('disciplinas.search', compact('disciplinas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //dd("Criar Disciplina foi acessado!");
        return view('disciplinas.create'); // Retorna a view de criação de disciplina
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDisciplinaRequest $request)
    {
        // Validação dos dados
        $data = $request->validated();
        //dd($data); // Para depuração, você pode remover isso depois
        // Criação da disciplina no banco de dados
        Disciplina::create($data);

        // Redireciona com mensagem de sucesso para a lista de disciplinas
        return redirect()->route('disciplinas.create')->with('success', 'Disciplina criada com sucesso!');
    }

    public function listdisciplinas()
    {
        //dd("Listar Disciplinas foi acessado!");
        $disciplinas = Disciplina::all(); // Obtém todas as disciplinas do banco de dados
        return view('disciplinas.listdisciplinas', compact('disciplinas')); // Retorna a view com a lista de disciplinas
    }


    /**
     * Display the specified resource.
     */
    public function show(Disciplina $disciplina)
    {
        //dd("Mostrar Disciplina foi acessado!");
        return view('disciplinas.show', compact('disciplina')); // Retorna a view com a disciplina específica
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Disciplina $disciplina)
    {
        //dd("Editar Disciplina foi acessado!");
        return view('disciplinas.edit', compact('disciplina')); // Retorna a view de edição com a disciplina específica
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDisciplinaRequest $request, Disciplina $disciplina)
    {
        // Validação dos dados
        $data = $request->validated();
   
        // Atualização da disciplina no banco de dados
        $disciplina->update([
            'nome' => $request->input('nome'),
            'codigo' => $request->input('codigo'),
            'descricao' => $request->input('descricao'),
        ]);

        // Redireciona com mensagem de sucesso para a lista de disciplinas
        return redirect()->route('disciplinas.create')->with('success', 'Disciplina atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Disciplina $disciplina)
    {
        //dd("Deletar Disciplina foi acessado!");
        // Remove a disciplina do banco de dados
        $disciplina->delete();

        // Redireciona com mensagem de sucesso para a lista de disciplinas
        return redirect()->route('disciplinas.create')->with('success', 'Disciplina deletada com sucesso!');
    }
}
