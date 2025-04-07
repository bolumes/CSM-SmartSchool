<?php

namespace App\Http\Controllers;

use App\Models\Edificio;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEdificioRequest;
use App\Http\Requests\UpdateEdificioRequest;
use Illuminate\Http\Request;

class EdificioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Metodo para buscar edifícios
    public function search(Request $request)
    {
        $edificios = [];
    
        if ($request->filled('name')) {
            $name = $request->input('name');
    
            $edificios = Edificio::where('name', 'like', '%' . $name . '%')->get();
        }
    
        return view('edificios.search', compact('edificios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //dd("Create foi acessado!");
        return view('edificios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEdificioRequest $request)
    {
        // Valida os dados do formulário
        $data = $request->validated();

        // Cria o registro no banco
        Edificio::create($data);

        // Redireciona com mensagem de sucesso
        return redirect()->route('edificios.create')->with('success', 'Edifício criado com sucesso!');
    }

    /**
     * Display a listing of the resource.
     */
    public function listedificios()
    {
        //dd("Listar Edificios foi acessado!");
        $edificios = Edificio::all(); // Obtém todos os edifícios do banco de dados
        return view('edificios.listedificios', ['edificios' => $edificios]); // Retorna a view com os edifícios
    }


    /**
     * Display the specified resource.
     */
    public function show(Edificio $edificio)
    {
        //dd($edificio); // Exibe os dados do edifício
        return view('edificios.show', ['edificio' => $edificio]); // Retorna a view com os dados do edifício
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Edificio $edificio)
    {
        //dd($edificio); // Exibe os dados do edifício
        return view('edificios.edit', ['edificio' => $edificio]); // Retorna a view com os dados do edifício
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEdificioRequest $request, Edificio $edificio)
    {
        // Valida os dados do formulário
        $data = $request->validated();

        // Atualiza os dados do usuário com os dados validados
        $edificio->update([
            'name' => $request->input('name'),
            'location' => $request->input('location'),
            'description' => $request->input('description'),
        ]);


        // Redireciona com mensagem de sucesso
        return redirect()->route('edificios.edit', $edificio)->with('success', 'Edifício atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Edificio $edificio)
    {
        // Deleta o edifício do banco de dados
        $edificio->delete();

        // Redireciona com mensagem de sucesso
        return redirect()->route('edificios.listedificios')->with('success', 'Edifício deletado com sucesso!');
    }
}
