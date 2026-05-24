<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreEleveRequest;
use App\Models\Eleve;
use App\Models\Classe;
use Illuminate\Http\Request;

class EleveController extends Controller
{
    /**
     * Search eleves by matricula
     */
    public function search(Request $request)
    {
        $eleves = [];

        if ($request->filled('matricula')) {

            $matricula = $request->input('matricula');

            $eleves = Eleve::where('matricula', 'like', '%' . $matricula . '%')
                ->with('classe')
                ->get();
        }

        return view('eleves.search', compact('eleves'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $classes = Classe::all();

        return view('eleves.create', compact('classes'));
    }

    /**
     * Store new eleve
     */
    public function store(StoreEleveRequest $request)
    {
        Eleve::create($request->validated());

        return redirect() ->route('eleves.create')->with('success', 'Aluno criado com sucesso!');
    }

    /**
     * List all eleves
     */
    public function listeleves(Request $request)
    {
        $classes = Classe::all();

        $query = Eleve::with('classe');

        // filtro por classe
        if ($request->filled('classe_id')) {
            $query->where('classe_id', $request->classe_id);
        }

        $eleves = $query->get();

        return view('eleves.listeleves', compact('eleves', 'classes'));
    }

    /**
     * Show single eleve
     */
    public function show(Eleve $eleve)
    {
        return view('eleves.show', compact('eleve'));
    }

    /**
     * Edit eleve
     */
    public function edit(Eleve $eleve)
    {
        $classes = Classe::all();

        return view('eleves.edit', compact('eleve', 'classes'));
    }

    /**
     * Update eleve
     */
    public function update(Request $request, Eleve $eleve)
    {
        $data = $request->validate([
            'classe_id' => 'required|exists:classes,id',
            'matricula' => 'required|unique:eleves,matricula,' . $eleve->id,
            'nome' => 'required|string',
            'apelido' => 'required|string',
            'data_nascimento' => 'required|date',
            'endereco' => 'nullable|string',
            'telefone' => 'nullable|string',
        ]);

        $eleve->update($data);

        return redirect()
            ->route('eleves.edit', $eleve)
            ->with('success', 'Aluno atualizado com sucesso!');
    }

    /**
     * Delete eleve
     */
    public function destroy(Eleve $eleve)
    {
        $eleve->delete();

        return redirect()
            ->route('eleves.listeleves')
            ->with('success', 'Aluno eliminado com sucesso!');
    }

    /**
     * Export CSV
     */
   public function export(Request $request)
    {
        $query = Eleve::with('classe');

        // aplicar filtro por classe (se existir)
        if ($request->filled('classe_id')) {
            $query->where('classe_id', $request->classe_id);
            $classe = Classe::find($request->classe_id);
            $classeNome = $classe?->code ?? 'classe';
        } else {
            $classeNome = 'todas';
        }

        $eleves = $query->get();

        // nome do ficheiro dinâmico
        $filename = 'eleves_' . $classeNome . '_' . now()->format('Ymd_His') . '.csv';

        // headers para download direto (sem guardar no servidor)
        $headers = [
            "Content-type" => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$filename",
        ];

        return response()->stream(function () use ($eleves) {

            $handle = fopen('php://output', 'w');

            // BOM para acentos (Excel)
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

            // cabeçalho
            fputcsv($handle, [
                'Classe',
                'Matricula',
                'Nome',
                'Apelido',
                'Data Nascimento',
                'Endereco',
                'Telefone'
            ]);

            // dados
            foreach ($eleves as $eleve) {
                fputcsv($handle, [
                    $eleve->classe?->code,
                    $eleve->matricula,
                    $eleve->nome,
                    $eleve->apelido,
                    $eleve->data_nascimento,
                    $eleve->endereco,
                    $eleve->telefone,
                ]);
            }

            fclose($handle);

        }, 200, $headers);
    }

    // Eleve pour classe
    public function index(Request $request)
    {
        $classes = Classe::all();

        $eleves = Eleve::with('classe')
            ->when($request->classe_id, function ($query) use ($request) {
                $query->where('classe_id', $request->classe_id);
            })
            ->orderBy('nome')
            ->get();

        return view('notes.listenotes', compact('eleves', 'classes'));
    }

    // Get eleves by classe (JSON)

    public function getElevesByClasse($id)
    {
        $eleves = Eleve::with('classe')
            ->where('classe_id', $id)
            ->select(
                'id',
                'matricula',
                'nome',
                'apelido',
                'classe_id'
            )
            ->orderBy('nome')
            ->get();

        return response()->json($eleves);
    }

    // Boletim do eleve
    public function notes($id)
    {
        $eleve = Eleve::with([
            'classe',
            'notes.matiere'
        ])->findOrFail($id);

        // AGRUPAR POR TRIMESTRE
        $trimestres = $eleve->notes
            ->groupBy('trimestre')
            ->map(function ($notesTrimestre) {

                // AGRUPAR MATIERES DENTRO DO TRIMESTRE
                return $notesTrimestre
                    ->groupBy('matiere_id')
                    ->map(function ($notes) {

                        $media = $notes->avg('nota');

                        return [

                            'matiere' => $notes->first()->matiere,

                            'notes' => $notes,

                            'media' => $media,

                            'observacao' =>
                            $media >= 10
                                ? 'Validé'
                                : 'Échec'

                        ];
                    });
            });

        return view(
            'notes.notesEleves',
            compact('eleve', 'trimestres')
        );
    }

    // Form para criar nota
    private function getObservation($media)
    {
        if ($media >= 10) return 'Validado';
        return 'Reprovado';
    }

    // Exportar boletim do eleve (Excel)
    public function exportBoletim($id)
    {
        $eleve = Eleve::with(['classe', 'notes.matiere'])->findOrFail($id);

        $data = collect();

        // INFO ALUNO
        $data->push([
            'Matricula' => $eleve->matricula,
            'Nome' => $eleve->nome . ' ' . $eleve->apelido,
            'Classe' => $eleve->classe->code ?? '-',
        ]);

        $data->push(['']);
        $data->push(['Matière', 'Nota', 'Observation']);

        foreach ($eleve->notes as $note) {

            $data->push([
                $note->matiere->name ?? '-',
                $note->nota,
                $note->observation ?? ($note->nota >= 10 ? 'Validé' : 'Échec')
            ]);
        }

        $data->push(['']);
        $data->push([
            'Média',
            $eleve->notes->avg('nota')
        ]);

        return Excel::download(
            new class($data) implements \Maatwebsite\Excel\Concerns\FromCollection {
                private $data;

                public function __construct($data)
                {
                    $this->data = $data;
                }

                public function collection()
                {
                    return $this->data;
                }
            },
            'boletim_'.$eleve->matricula.'.xlsx'
        );
    }
}