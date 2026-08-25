<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEleveRequest;
use App\Models\AnneeScolaire;
use App\Models\Classe;
use App\Models\Eleve;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EleveController extends Controller
{
    /**
     * ==========================================================================
     * PESQUISAR ALUNO PELA MATRÍCULA
     * ==========================================================================
     */
    public function search(Request $request)
    {
        $anneeScolaireActive = AnneeScolaire::where(
            'ativo',
            true
        )->first();

        $eleves = collect();

        if ($request->filled('matricula')) {

            $matricula = trim(
                $request->input('matricula')
            );

            $query = Eleve::query()
                ->where(
                    'matricula',
                    'like',
                    '%' . $matricula . '%'
                );

            if ($anneeScolaireActive) {

                $query->with([
                    'inscriptions' => function ($q) use (
                        $anneeScolaireActive
                    ) {

                        $q->where(
                            'annee_scolaire_id',
                            $anneeScolaireActive->id
                        )
                        ->with([
                            'classe',
                            'anneeScolaire',
                        ]);
                    }
                ]);
            }

            $eleves = $query
                ->orderBy('nome')
                ->get();
        }

        return view(
            'eleves.search',
            compact(
                'eleves',
                'anneeScolaireActive'
            )
        );
    }


    /**
     * ==========================================================================
     * CRIAR ALUNO
     * ==========================================================================
     */
    public function create()
    {
        $students = User::where(
            'function',
            'Eleve'
        )
        ->orderBy('firstname')
        ->orderBy('lastname')
        ->get();

        $parents = User::where(
            'function',
            'Parent'
        )
        ->orderBy('firstname')
        ->orderBy('lastname')
        ->get();

        $ultimaMatricula = Eleve::where(
            'matricula',
            'like',
            'CSM%'
        )
        ->orderByRaw(
            "CAST(SUBSTRING(matricula, 4) AS UNSIGNED) DESC"
        )
        ->value('matricula');

        if ($ultimaMatricula) {

            $numero = (int) substr(
                $ultimaMatricula,
                3
            );

            $numero++;

        } else {

            $numero = 1;
        }

        $proximaMatricula =
            'CSM' .
            str_pad(
                $numero,
                3,
                '0',
                STR_PAD_LEFT
            );

        return view(
            'eleves.create',
            compact(
                'students',
                'parents',
                'proximaMatricula'
            )
        );
    }


    /**
     * ==========================================================================
     * GUARDAR ALUNO
     * ==========================================================================
     */
    public function store(StoreEleveRequest $request)
    {
        $data = $request->validated();

        $ultimaMatricula = Eleve::where(
            'matricula',
            'like',
            'CSM%'
        )
        ->orderByRaw(
            "CAST(SUBSTRING(matricula, 4) AS UNSIGNED) DESC"
        )
        ->value('matricula');

        if ($ultimaMatricula) {

            $numero = (int) substr(
                $ultimaMatricula,
                3
            );

            $numero++;

        } else {

            $numero = 1;
        }

        $data['matricula'] =
            'CSM' .
            str_pad(
                $numero,
                3,
                '0',
                STR_PAD_LEFT
            );

        $eleve = Eleve::create($data);

        return redirect()
            ->route('eleves.create')
            ->with(
                'success',
                'Aluno criado com sucesso! Matrícula atribuída: ' .
                $eleve->matricula
            );
    }


    /**
     * ==========================================================================
     * LISTA DE ALUNOS
     * ==========================================================================
     *
     * FILTRO:
     *
     * - Classe
     * - Ano letivo
     *
     * O aluno só aparece se possuir uma inscrição
     * correspondente à classe E ao ano selecionados.
     */
    public function listeleves(Request $request)
    {
        /*
         * ==============================================================
         * ANO LETIVO ATIVO
         * ==============================================================
         */
        $anneeScolaireActive = AnneeScolaire::where(
            'ativo',
            true
        )->first();


        /*
         * ==============================================================
         * LISTA DE CLASSES
         * ==============================================================
         */
        $classes = Classe::orderBy(
            'code'
        )->get();


        /*
         * ==============================================================
         * LISTA DE ANOS LETIVOS
         * ==============================================================
         *
         * Ordenamos do mais recente para o mais antigo.
         */
        $anneesScolaires = AnneeScolaire::orderBy(
            'id',
            'desc'
        )->get();


        /*
         * ==============================================================
         * QUERY DOS ALUNOS
         * ==============================================================
         */
        $query = Eleve::query();


        /*
         * ==============================================================
         * FILTRO POR CLASSE + ANO LETIVO
         * ==============================================================
         *
         * Se o utilizador selecionar classe e ano,
         * procuramos apenas alunos que tenham inscrição
         * nessa combinação.
         */
        if (
            $request->filled('classe_id') &&
            $request->filled('annee_scolaire_id')
        ) {

            $query->whereHas(
                'inscriptions',
                function ($q) use ($request) {

                    $q->where(
                        'classe_id',
                        $request->classe_id
                    );

                    $q->where(
                        'annee_scolaire_id',
                        $request->annee_scolaire_id
                    );
                }
            );
        }


        /*
         * ==============================================================
         * FILTRO SOMENTE POR CLASSE
         * ==============================================================
         *
         * Permite também selecionar apenas uma classe.
         */
        elseif (
            $request->filled('classe_id')
        ) {

            $query->whereHas(
                'inscriptions',
                function ($q) use ($request) {

                    $q->where(
                        'classe_id',
                        $request->classe_id
                    );
                }
            );
        }


        /*
         * ==============================================================
         * FILTRO SOMENTE POR ANO LETIVO
         * ==============================================================
         *
         * Permite listar todos os alunos inscritos
         * num determinado ano letivo.
         */
        elseif (
            $request->filled('annee_scolaire_id')
        ) {

            $query->whereHas(
                'inscriptions',
                function ($q) use ($request) {

                    $q->where(
                        'annee_scolaire_id',
                        $request->annee_scolaire_id
                    );
                }
            );
        }


        /*
         * ==============================================================
         * CARREGAR INSCRIÇÕES
         * ==============================================================
         *
         * Aqui carregamos apenas a inscrição correspondente
         * aos filtros selecionados.
         */
        $query->with([
            'inscriptions' => function ($q) use ($request) {

                /*
                 * Se foi escolhido um ano letivo,
                 * carregar apenas esse ano.
                 */
                if (
                    $request->filled(
                        'annee_scolaire_id'
                    )
                ) {

                    $q->where(
                        'annee_scolaire_id',
                        $request->annee_scolaire_id
                    );
                }

                /*
                 * Se foi escolhida uma classe,
                 * carregar apenas essa classe.
                 */
                if (
                    $request->filled('classe_id')
                ) {

                    $q->where(
                        'classe_id',
                        $request->classe_id
                    );
                }

                $q->with([
                    'classe',
                    'anneeScolaire',
                ]);
            }
        ]);


        /*
         * ==============================================================
         * ORDENAR ALUNOS
         * ==============================================================
         */
        $eleves = $query
            ->orderBy('nome')
            ->get();


        /*
         * ==============================================================
         * VIEW
         * ==============================================================
         */
        return view(
            'eleves.listeleves',
            compact(
                'eleves',
                'classes',
                'anneesScolaires',
                'anneeScolaireActive'
            )
        );
    }


    /**
     * ==========================================================================
     * MOSTRAR ALUNO
     * ==========================================================================
     */
    public function show(Eleve $eleve)
    {
        $eleve->load([
            'inscriptions.classe',
            'inscriptions.anneeScolaire',
            'notes.matiere',
        ]);

        $anneeScolaireActive = AnneeScolaire::where(
            'ativo',
            true
        )->first();

        $inscriptionActive = null;

        if ($anneeScolaireActive) {

            $inscriptionActive = $eleve->inscriptions
                ->where(
                    'annee_scolaire_id',
                    $anneeScolaireActive->id
                )
                ->first();
        }

        return view(
            'eleves.show',
            compact(
                'eleve',
                'anneeScolaireActive',
                'inscriptionActive'
            )
        );
    }


    /**
     * ==========================================================================
     * EDITAR ALUNO
     * ==========================================================================
     */
    public function edit(Eleve $eleve)
    {
        $eleve->load([
            'inscriptions.classe',
            'inscriptions.anneeScolaire',
        ]);

        $parents = User::where(
            'function',
            'Parent'
        )
        ->orderBy('firstname')
        ->orderBy('lastname')
        ->get();

        return view(
            'eleves.edit',
            compact(
                'eleve',
                'parents'
            )
        );
    }


    /**
     * ==========================================================================
     * ATUALIZAR ALUNO
     * ==========================================================================
     */
    public function update(Request $request, Eleve $eleve) {

        $data = $request->validate([

            'matricula' => [
                'required',
                'string',
                'max:255',
                'unique:eleves,matricula,' . $eleve->id,
            ],

            'nome' => [
                'required',
                'string',
                'max:255',
            ],

            'apelido' => [
                'required',
                'string',
                'max:255',
            ],

            'data_nascimento' => [
                'required',
                'date',
            ],

            'sexo' => [
                'required',
                'string',
                'max:20',
            ],

            'endereco' => [
                'nullable',
                'string',
                'max:255',
            ],

            'telefone' => [
                'nullable',
                'string',
                'max:50',
            ],
        ]);

        $eleve->update($data);

        return redirect()
            ->route(
                'eleves.edit',
                $eleve
            )
            ->with(
                'success',
                'Aluno atualizado com sucesso!'
            );
    }


    /**
     * ==========================================================================
     * ELIMINAR ALUNO
     * ==========================================================================
     */
    public function destroy(Eleve $eleve)
    {
        $eleve->delete();

        return redirect()
            ->route('eleves.listeleves')
            ->with(
                'success',
                'Aluno eliminado com sucesso!'
            );
    }


    /**
     * ==========================================================================
     * EXPORTAR ALUNOS
     * ==========================================================================
     */
    
    public function export(Request $request)
{
    /*
     * ==============================================================
     * QUERY DOS ALUNOS
     * ==============================================================
     */
    $query = Eleve::query();

    /*
     * ==============================================================
     * FILTRO POR CLASSE + ANO LETIVO
     * ==============================================================
     */
    if (
        $request->filled('classe_id') &&
        $request->filled('annee_scolaire_id')
    ) {

        $query->whereHas('inscriptions', function ($q) use ($request) {

            $q->where('classe_id', $request->classe_id)
              ->where('annee_scolaire_id', $request->annee_scolaire_id);

        });
    }

    /*
     * ==============================================================
     * FILTRO SOMENTE POR CLASSE
     * ==============================================================
     */
    elseif ($request->filled('classe_id')) {

        $query->whereHas('inscriptions', function ($q) use ($request) {

            $q->where('classe_id', $request->classe_id);

        });
    }

    /*
     * ==============================================================
     * FILTRO SOMENTE POR ANO LETIVO
     * ==============================================================
     */
    elseif ($request->filled('annee_scolaire_id')) {

        $query->whereHas('inscriptions', function ($q) use ($request) {

            $q->where(
                'annee_scolaire_id',
                $request->annee_scolaire_id
            );

        });
    }

    /*
     * ==============================================================
     * CARREGAR SOMENTE A INSCRIÇÃO FILTRADA
     * ==============================================================
     */
    $query->with([
        'inscriptions' => function ($q) use ($request) {

            if ($request->filled('classe_id')) {

                $q->where(
                    'classe_id',
                    $request->classe_id
                );
            }

            if ($request->filled('annee_scolaire_id')) {

                $q->where(
                    'annee_scolaire_id',
                    $request->annee_scolaire_id
                );
            }

            $q->with([
                'classe',
                'anneeScolaire',
            ]);
        }
    ]);

    /*
     * ==============================================================
     * ALUNOS
     * ==============================================================
     */
    $eleves = $query
        ->orderBy('nome')
        ->get();

    /*
     * ==============================================================
     * NOME DA CLASSE
     * ==============================================================
     */
    $classeNome = 'todas';

    if ($request->filled('classe_id')) {

        $classe = Classe::find($request->classe_id);

        $classeNome = $classe?->code ?? 'classe';
    }

    /*
     * ==============================================================
     * NOME DO ANO LETIVO
     * ==============================================================
     */
    $anneeNome = 'todos';

    if ($request->filled('annee_scolaire_id')) {

        $annee = AnneeScolaire::find(
            $request->annee_scolaire_id
        );

        $anneeNome = $annee?->nome ?? 'ano';
    }

    /*
     * ==============================================================
     * NOME DO FICHEIRO
     * ==============================================================
     */
    $filename =
        'eleves_' .
        $classeNome .
        '_' .
        $anneeNome .
        '_' .
        now()->format('Ymd_His') .
        '.csv';

    /*
     * ==============================================================
     * HEADERS
     * ==============================================================
     */
    $headers = [

        'Content-Type' =>
            'text/csv; charset=UTF-8',

        'Content-Disposition' =>
            'attachment; filename="' .
            $filename .
            '"',
    ];

    /*
     * ==============================================================
     * EXPORTAÇÃO
     * ==============================================================
     */
    return response()->stream(

        function () use ($eleves) {

            $handle = fopen(
                'php://output',
                'w'
            );

            /*
             * UTF-8 BOM
             */
            fprintf(
                $handle,
                chr(0xEF) .
                chr(0xBB) .
                chr(0xBF)
            );

            /*
             * CABEÇALHO
             */
            fputcsv(
                $handle,
                [
                    'Classe',
                    'Ano Letivo',
                    'Matricula',
                    'Nome',
                    'Apelido',
                    'Data Nascimento',
                    'Endereco',
                    'Telefone',
                ]
            );

            /*
             * DADOS
             */
            foreach ($eleves as $eleve) {

                /*
                 * Como a relação já foi filtrada,
                 * aqui teremos somente a inscrição
                 * correspondente aos filtros.
                 */
                $inscription =
                    $eleve->inscriptions->first();

                fputcsv(
                    $handle,
                    [

                        $inscription
                            ?->classe
                            ?->code ?? '-',

                        $inscription
                            ?->anneeScolaire
                            ?->nome ?? '-',

                        $eleve->matricula,

                        $eleve->nome,

                        $eleve->apelido,

                        $eleve->data_nascimento,

                        $eleve->endereco,

                        $eleve->telefone,
                    ]
                );
            }

            fclose($handle);
        },

        200,

        $headers
    );
}

    /**
     * ==========================================================================
     * ALUNOS PARA NOTAS
     * ==========================================================================
     */
    public function index(Request $request)
    {
        $anneeScolaireActive =
            AnneeScolaire::where(
                'ativo',
                true
            )->first();

        $classes = Classe::orderBy(
            'code'
        )->get();

        $query = Eleve::query();


        /*
         * FILTRO POR CLASSE + ANO ATIVO
         */
        if (
            $request->filled('classe_id') &&
            $anneeScolaireActive
        ) {

            $query->whereHas(
                'inscriptions',
                function ($q) use (
                    $request,
                    $anneeScolaireActive
                ) {

                    $q->where(
                        'classe_id',
                        $request->classe_id
                    );

                    $q->where(
                        'annee_scolaire_id',
                        $anneeScolaireActive->id
                    );
                }
            );
        }


        /*
         * CARREGAR INSCRIÇÃO ATIVA
         */
        if ($anneeScolaireActive) {

            $query->with([
                'inscriptions' => function ($q) use (
                    $anneeScolaireActive
                ) {

                    $q->where(
                        'annee_scolaire_id',
                        $anneeScolaireActive->id
                    )
                    ->with([
                        'classe',
                        'anneeScolaire',
                    ]);
                }
            ]);
        }


        $eleves = $query
            ->orderBy('nome')
            ->get();


        return view(
            'notes.listenotes',
            compact(
                'eleves',
                'classes',
                'anneeScolaireActive'
            )
        );
    }


    /**
     * ==========================================================================
     * OBTER ALUNOS POR CLASSE
     * ==========================================================================
     */
    public function getElevesByClasse($id)
    {
        $anneeScolaireActive =
            AnneeScolaire::where(
                'ativo',
                true
            )->first();


        if (!$anneeScolaireActive) {

            return response()->json([]);
        }


        $eleves = Eleve::whereHas(
            'inscriptions',
            function ($query) use (
                $id,
                $anneeScolaireActive
            ) {

                $query->where(
                    'classe_id',
                    $id
                );

                $query->where(
                    'annee_scolaire_id',
                    $anneeScolaireActive->id
                );
            }
        )

        ->with([
            'inscriptions' => function ($query) use (
                $anneeScolaireActive
            ) {

                $query->where(
                    'annee_scolaire_id',
                    $anneeScolaireActive->id
                )
                ->with([
                    'classe',
                    'anneeScolaire',
                ]);
            }
        ])

        ->select([
            'id',
            'matricula',
            'nome',
            'apelido',
        ])

        ->orderBy('nome')

        ->get();


        return response()->json(
            $eleves
        );
    }


    /**
     * ==========================================================================
     * BOLETIM DO ALUNO
     * ==========================================================================
     */
    public function notes($id)
    {
        $eleve = Eleve::with([
            'inscriptions.classe',
            'inscriptions.anneeScolaire',
            'notes.matiere',
        ])
        ->findOrFail($id);


        $trimestres = $eleve->notes
            ->groupBy('trimestre')
            ->map(
                function ($notesTrimestre) {

                    return $notesTrimestre
                        ->groupBy('matiere_id')
                        ->map(
                            function ($notes) {

                                $media =
                                    $notes->avg('nota');

                                return [

                                    'matiere' =>
                                        $notes
                                            ->first()
                                            ->matiere,

                                    'notes' =>
                                        $notes,

                                    'media' =>
                                        $media,

                                    'observacao' =>
                                        $media >= 10
                                            ? 'Validé'
                                            : 'Échec',
                                ];
                            }
                        );
                }
            );


        return view(
            'notes.notesEleves',
            compact(
                'eleve',
                'trimestres'
            )
        );
    }


    /**
     * ==========================================================================
     * OBSERVAÇÃO
     * ==========================================================================
     */
    private function getObservation($media)
    {
        return $media >= 10
            ? 'Validado'
            : 'Reprovado';
    }


    /**
     * ==========================================================================
     * EXPORTAR BOLETIM
     * ==========================================================================
     */
    public function exportBoletim($id)
    {
        $eleve = Eleve::with([
            'inscriptions.classe',
            'inscriptions.anneeScolaire',
            'notes.matiere',
        ])
        ->findOrFail($id);


        $inscription = $eleve->inscriptions
            ->sortByDesc('data_inscricao')
            ->first();


        $data = collect();


        /*
         * INFORMAÇÕES DO ALUNO
         */
        $data->push([

            'Matricula' =>
                $eleve->matricula,

            'Nome' =>
                $eleve->nome .
                ' ' .
                $eleve->apelido,

            'Classe' =>
                $inscription
                    ?->classe
                    ?->code ?? '-',

            'Ano Letivo' =>
                $inscription
                    ?->anneeScolaire
                    ?->nome ?? '-',
        ]);


        $data->push(['']);


        /*
         * CABEÇALHO DAS NOTAS
         */
        $data->push([
            'Matière',
            'Nota',
            'Observation',
        ]);


        /*
         * NOTAS
         */
        foreach ($eleve->notes as $note) {

            $data->push([

                'Matière' =>
                    $note
                        ->matiere
                        ->name ?? '-',

                'Nota' =>
                    $note->nota,

                'Observation' =>
                    $note->observation ??
                    (
                        $note->nota >= 10
                            ? 'Validé'
                            : 'Échec'
                    ),
            ]);
        }


        /*
         * MÉDIA
         */
        $data->push(['']);


        $data->push([

            'Média',

            $eleve
                ->notes
                ->avg('nota'),
        ]);


        /*
         * EXPORTAR EXCEL
         */
        return Excel::download(

            new class($data)
                implements \Maatwebsite\Excel\Concerns\FromCollection
            {

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

            'boletim_' .
            $eleve->matricula .
            '.xlsx'
        );
    }
}