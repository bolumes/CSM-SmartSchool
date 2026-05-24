<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNoteRequest;
use App\Models\Note;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Classe;
use App\Models\Professor;
use App\Models\Matiere;
use App\Models\Eleve;

class NoteController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $classes = Classe::all();
        $professors = Professor::all();
        $matieres = Matiere::all(); 

        return view('notes.create', compact('classes', 'professors', 'matieres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request)
    {
        $validated = $request->validated();

        // 🔹 (opcional) garantir que classe_id também é guardado
        // se estiver no form
        Note::create($validated);

        return redirect()
            ->route('notes.create')
            ->with('success', 'Nota criada com sucesso!');
    }

    public function getMatieresByNiveau($niveau)
    {
        $matieres = Matiere::where('level', $niveau)->get();

        return response()->json($matieres);
    }

    // lista de notas ou seja lista de eleves com respeitivos notas por classe
    public function listenotes(Request $request)
    {
        $classeId = $request->classe_id;

        $matieres = Matiere::all();

        // UTILIZADOR AUTENTICADO
        $user = auth()->user();

        // =========================
        // ADMIN
        // =========================
        if ($user->role == 'admin') {

            $classes = Classe::all();

            $eleves = Eleve::query()
                ->when($classeId, function ($query) use ($classeId) {
                    $query->where('classe_id', $classeId);
                })
                ->with('notes', 'classe')
                ->get();
        }

        // =========================
        // ELEVE
        // =========================
        else {

            // aluno autenticado
            $eleveAuth = Eleve::where('user_id', $user->id)
                ->first();

            // apenas a classe dele
            $classes = Classe::where('id', $eleveAuth->classe_id)
                ->get();

            // apenas os dados dele
            $eleves = Eleve::where('id', $eleveAuth->id)
                ->with('notes', 'classe')
                ->get();
        }

        $data = [];

        foreach ($eleves as $eleve) {

            $notes = $eleve->notes->groupBy('matiere_id');

            $data[$eleve->id] = [
                'eleve' => $eleve,
                'notes' => $notes
            ];
        }

        return view('notes.listenotes', compact(
            'classes',
            'matieres',
            'data'
        ));
    }

    // Editar notas de um aluno específico
    public function editByEleve($id)
    {
        $eleve = Eleve::with(['notes.matiere'])->findOrFail($id);

        // 🔹 primeiro por trimestre
        $notesByTrimestre = $eleve->notes->groupBy('trimestre');

        return view('notes.edit', compact('eleve', 'notesByTrimestre'));
    }
    // Atualizar notas de um aluno específico
    public function updateByEleve(Request $request, $id)
    {
        $eleve = Eleve::with('notes')->findOrFail($id);

        foreach ($request->notes as $noteId => $value) {

            $note = Note::where('id', $noteId)
                ->where('eleve_id', $id)
                ->first();

            if ($note) {
                $note->update([
                    'nota' => $value
                ]);
            }
        }

        return redirect()
            ->route('notes.notesEleves', ['id' => $id])
            ->with('success', 'Notas atualizadas com sucesso!');
    }

    
}