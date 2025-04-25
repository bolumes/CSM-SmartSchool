<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProgeventRequest;
use App\Http\Requests\UpdateProgeventRequest;
use App\Models\Professor;
use App\Models\Progevent;
use App\Models\Sala;

use Illuminate\Http\Request;
use App\Models\Event;




class ProgeventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function search(Request $request)
    {
        $progevents = [];
    
        if ($request->filled('codigo')) {
            $id = $request->input('codigo');
    
            $progevents = Progevent::where('id', 'like', '%' . $id . '%')->get();

        }
    
        return view('progevents.search', compact('progevents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Récupérer toutes les matières et professeurs pour le formulaire de création
        $salas = Sala::all();  // Récupérer toutes les salles
        $events = Event::all();  // Récupérer tous les professeurs
        return view('progevents.create', compact('salas', 'events'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProgeventRequest $request)
    {
        // Valida os dados do formulário
        $data = $request->validated();

        // Cria o registro no banco
        Progevent::create($data);

        // Redireciona com mensagem de sucesso
        return redirect()->route('progevents.create')->with('success', 'Progevent criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Récupérer l'événement par son ID
        $progevent = Progevent::findOrFail($id);

        // Afficher la vue avec les détails de l'événement
        return view('progevents.show', compact('progevent'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function listprogevents()
    {
        // Usando 'with' para carregar as relações sala, event, matiere e professor
        $progevents = Progevent::with(['sala', 'event.matiere', 'event.professor'])->get();
        
        return view('progevents.listprogevents', compact('progevents'));
    }
    


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $progevent = Progevent::findOrFail($id);
        $salas = Sala::all();
        $events = Event::with(['matiere', 'professor'])->get(); // Pega eventos + professor + matéria

        return view('progevents.edit', compact('progevent', 'salas', 'events'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProgeventRequest $request, Progevent $progevent)
    {
        // Valida os dados do formulário
        $data = $request->validated();

        // Atualiza o registro no banco
        $progevent->update([
            'date' => $request->input('date'),
            'start' => $request->input('start'),
            'end' => $request->input('end'),
            'sala_id' => $request->input('sala_id'),
            'event_id' => $request->input('event_id'),
        ]);

        // Redireciona com mensagem de sucesso
        return redirect()->route('progevents.edit', $progevent)->with('success', 'Progevent atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Récupérer l'événement par son ID
        $progevent = Progevent::findOrFail($id);

        // Supprimer l'événement
        $progevent->delete();

        // Rediriger avec un message de succès
        return redirect()->route('progevents.create')->with('success', 'Progevent supprimé avec succès!');
    }
}
