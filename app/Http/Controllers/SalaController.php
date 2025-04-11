<?php

namespace App\Http\Controllers;

use App\Models\Edificio;
use App\Models\Sala;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSalaRequest;
use App\Http\Requests\UpdateSalaRequest;

class SalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function search()
    {
        //dd("Buscar Salas foi acessado!");
        $salas = Sala::all(); // Obtém todas as salas do banco de dados
        return view('salas.search', compact('salas')); // Retorna a view com as salas
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $edificios = Edificio::all(); // busca todos os edifícios

        return view('salas.create', compact('edificios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSalaRequest $request)
    {
        // Validação dos dados
        $data = $request->validated();
        //dd($data); // Para depuração, você pode remover isso depois
        // Criação da sala no banco de dados
        Sala::create($data);

        // Redireciona com mensagem de sucesso para a lista de salas
        return redirect()->route('salas.create')->with('success', 'Sala criada com sucesso!');
    }


    /**
     * Display the List resource.
     */     
    public function listsalas()
    {
        //dd("Listar Salas foi acessado!");
        $salas = Sala::all(); // Obtém todas as salas do banco de dados
        return view('salas.listsalas', compact('salas')); // Retorna a view com as salas
    }

    /**
     * Display the specified resource.
     */
    public function show(Sala $sala)
    {
        //dd($sala); // Para depuração, você pode remover isso depois
        return view('salas.show', compact('sala')); // Retorna a view com a sala específica
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sala $sala)
    {
        $edificios = Edificio::all(); // busca todos os edifícios
        return view('salas.edit', compact('sala', 'edificios')); // Retorna a view de edição com a sala e edifícios
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSalaRequest $request, Sala $sala)
    {
        // Validação dos dados
        $data = $request->validated();
        
        // Atualização da disciplina no banco de dados
        $sala->update([
            'name' => $request->input('name'),
            'reservar' => $request->input('reservar'),
            'categoria' => $request->input('categoria'),
            'capacidade' => $request->input('capacidade'),
            'edificio_id' => $request->input('edificio_id'),
            'caracteristicas' => $request->input('caracteristicas'),
            'localizacao' => $request->input('localizacao'),
            'imagem' => $request->input('imagem'),
        ]);

        // Redireciona com mensagem de sucesso para a lista de salas
        return redirect()->route('salas.show', $sala->id)->with('success', 'Sala atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sala $sala)
    {
        //dd($sala); // Para depuração, você pode remover isso depois
        $sala->delete(); // Deleta a sala do banco de dados

        // Redireciona com mensagem de sucesso para a lista de salas
        return redirect()->route('salas.listsalas')->with('success', 'Sala deletada com sucesso!');
    }
}
