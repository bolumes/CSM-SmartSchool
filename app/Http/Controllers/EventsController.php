<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventsRequest;
use App\Http\Requests\UpdateEventsRequest;
use App\Models\Matiere;
use App\Models\Professor;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function search(Request $request)
    {
        $events = [];
    
        if ($request->filled('codigo')) {
            $id = $request->input('codigo');
    
            $events = Event::where('id', 'like', '%' . $id . '%')->get();

        }
    
        return view('events.search', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $matieres = Matiere::all();  // Récupérer toutes les matières
        $professors = Professor::all();  // Récupérer tous les professeurs
        return view('events.create', compact('matieres', 'professors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventsRequest $request)
    {
         // Valida os dados do formulário
         $data = $request->validated();

         // Cria o registro no banco
         Event::create($data);
 
         // Redireciona com mensagem de sucesso
         return redirect()->route('events.create')->with('success', 'Evento criado com sucesso!');
    }

    public function listevents()
    {
        $events = Event::all();  // Récupérer tous les événements
        return view('events.listevents', compact('events'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //dd("Show foi acessado!");
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        // Carrega as relações "matiere" e "professor"
        $event->load(['matiere', 'professor']);

        // Obtém todos os registros de matérias e professores
        $matieres = Matiere::all();
        $professors = Professor::all();

        // Retorna a view com os dados carregados
        return view('events.edit', compact('event', 'matieres', 'professors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventsRequest $request, Event $event)
    {
        //dd("Update foi acessado!");
        // Valida os dados do formulário
        $data = $request->validated();

        // Atualiza os dados do usuário com os dados validados
        $event->update([
            'type' => $request->input('type'),
            'matiere_id' => $request->input('matiere_id'),
            'professor_id' => $request->input('professor_id'),
        ]);

        // Redireciona com mensagem de sucesso
        return redirect()->route('events.edit', $event)->with('success', 'Evento atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //dd("Destroy foi acessado!");
        // Remove o registro do banco
        $event->delete();

        // Redireciona com mensagem de sucesso
        return redirect()->route('events.create')->with('success', 'Evento removido com sucesso!');
    }

    public function export(Request $request)
    {
        $events = Event::all(); // Obtém todas as matérias do banco de dados

        // Cria um arquivo CSV
        $filename = 'events.csv';
        $handle = fopen($filename, 'w+');

        // Cabeçalho do CSV
        fputcsv($handle, ['ID', 'Type', 'Matiere ID', 'Professor ID']);

        foreach ($events as $event) {
            fputcsv($handle, [
                $event->id,
                $event->type,
                $event->matiere_id,
                $event->professor_id
            ]);
        }

        fclose($handle);

        // Retorna o arquivo para download e apaga depois
        return response()->download($filename)->deleteFileAfterSend(true);
    }   

}
