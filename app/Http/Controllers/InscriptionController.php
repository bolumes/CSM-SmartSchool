<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use App\Models\Eleve;
use App\Models\Classe;
use App\Models\AnneeScolaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;

class InscriptionController extends Controller
{
    /**
     * Lista inscrições
     */
    public function index(Request $request)
    {
        $query = Inscription::with([
            'eleve',
            'classe',
            'anneeScolaire'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Pesquisa
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->whereHas('eleve', function ($q) use ($search) {

                $q->where('matricula', 'like', "%{$search}%")
                    ->orWhere('nome', 'like', "%{$search}%")
                    ->orWhere('apelido', 'like', "%{$search}%");

            });
        }

        /*
        |--------------------------------------------------------------------------
        | Filtro por ano letivo
        |--------------------------------------------------------------------------
        */

        if ($request->filled('annee_scolaire_id')) {

            $query->where(
                'annee_scolaire_id',
                $request->annee_scolaire_id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Filtro por classe
        |--------------------------------------------------------------------------
        */

        if ($request->filled('classe_id')) {

            $query->where(
                'classe_id',
                $request->classe_id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Paginação
        |--------------------------------------------------------------------------
        */

        $inscriptions = $query
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Apenas anos letivos ativos
        |--------------------------------------------------------------------------
        |
        | Como o sistema permite apenas UM ano ativo,
        | normalmente será retornado apenas um registo.
        |
        */

        $anneesScolaires = AnneeScolaire::where('ativo', true)
            ->orderByDesc('data_inicio')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Classes
        |--------------------------------------------------------------------------
        */

        $classes = Classe::orderBy('level')
            ->orderBy('name')
            ->get();

        return view(
            'inscriptions.index',
            compact(
                'inscriptions',
                'anneesScolaires',
                'classes'
            )
        );
    }


    /**
     * Formulário de nova inscrição
     */
    public function create()
    {
        /*
        |--------------------------------------------------------------------------
        | Apenas o ano letivo ativo
        |--------------------------------------------------------------------------
        */

        $anneesScolaires = AnneeScolaire::where('ativo', true)
            ->orderByDesc('data_inicio')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Níveis existentes na tabela classes
        |--------------------------------------------------------------------------
        */

        $levels = Classe::query()
            ->whereNotNull('level')
            ->where('level', '<>', '')
            ->distinct()
            ->orderBy('level')
            ->pluck('level');

        return view(
            'inscriptions.create',
            compact(
                'anneesScolaires',
                'levels'
            )
        );
    }


    /**
     * Guardar inscrição
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validação
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'eleve_id' => [
                'required',
                'exists:eleves,id'
            ],

            'classe_id' => [
                'required',
                'exists:classes,id'
            ],

            /*
             * IMPORTANTE:
             * O ano selecionado tem obrigatoriamente
             * de estar ativo.
             */
            'annee_scolaire_id' => [
                'required',
                Rule::exists('annees_scolaires', 'id')
                    ->where(function ($query) {
                        $query->where('ativo', true);
                    }),
            ],

        ], [

            'eleve_id.required' =>
                'É necessário selecionar um aluno.',

            'eleve_id.exists' =>
                'O aluno selecionado não existe.',

            'classe_id.required' =>
                'É necessário selecionar uma classe.',

            'classe_id.exists' =>
                'A classe selecionada não existe.',

            'annee_scolaire_id.required' =>
                'É necessário selecionar o ano letivo.',

            'annee_scolaire_id.exists' =>
                'O ano letivo selecionado não está ativo ou não existe.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Verificar se o aluno já está inscrito nesse ano
        |--------------------------------------------------------------------------
        */

        $existing = Inscription::where(
                'eleve_id',
                $validated['eleve_id']
            )
            ->where(
                'annee_scolaire_id',
                $validated['annee_scolaire_id']
            )
            ->first();

        if ($existing) {

            return back()
                ->withInput()
                ->withErrors([
                    'eleve_id' =>
                        'Este aluno já possui uma inscrição neste ano letivo.'
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Criar inscrição
        |--------------------------------------------------------------------------
        */

        Inscription::create([

            'eleve_id' =>
                $validated['eleve_id'],

            'classe_id' =>
                $validated['classe_id'],

            'annee_scolaire_id' =>
                $validated['annee_scolaire_id'],

            'data_inscricao' =>
                now(),

        ]);


        /*
        |--------------------------------------------------------------------------
        | Redirecionar
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('inscriptions.index')
            ->with(
                'success',
                'Inscrição realizada com sucesso!'
            );
    }


    /**
     * Procurar aluno pela matrícula
     */
    public function studentByMatricula(Request $request)
    {
        $request->validate([
            'matricula' => [
                'required',
                'string'
            ]
        ]);

        $student = Eleve::query()
            ->where(
                'matricula',
                $request->matricula
            )
            ->first();

        if (!$student) {

            return response()->json([

                'success' => false,

                'message' =>
                    'Nenhum aluno encontrado com esta matrícula.'

            ], 404);
        }

        return response()->json([

            'success' => true,

            'student' => [

                'id' =>
                    $student->id,

                'matricula' =>
                    $student->matricula,

                'nome' =>
                    $student->nome,

                'apelido' =>
                    $student->apelido,

            ]

        ]);
    }


    /**
     * Carregar classes por nível
     */
    public function classesByLevel($level)
    {
        $classes = Classe::query()

            ->where('level', $level)

            ->orderBy('name')

            ->get([
                'id',
                'name',
                'code',
                'description',
                'level'
            ]);

        return response()->json(
            $classes
        );
    }


    /**
     * Procurar alunos associados a uma classe
     */
    public function studentsByClasse($classeId)
    {
        /*
        |--------------------------------------------------------------------------
        | Verificar classe
        |--------------------------------------------------------------------------
        */

        $classe = Classe::find($classeId);

        if (!$classe) {

            return response()->json([

                'success' => false,

                'message' =>
                    'Classe não encontrada.'

            ], 404);
        }


        /*
        |--------------------------------------------------------------------------
        | Alunos que ainda não possuem inscrição
        | nessa classe
        |--------------------------------------------------------------------------
        */

        $students = Eleve::query()

            ->whereDoesntHave(
                'inscriptions',
                function ($query) use ($classeId) {

                    $query->where(
                        'classe_id',
                        $classeId
                    );

                }
            )

            ->orderBy('nome')
            ->orderBy('apelido')

            ->get([

                'id',
                'matricula',
                'nome',
                'apelido'

            ]);

        return response()->json(
            $students
        );
    }


    /**
     * Mostrar inscrição
     */
    public function show(Inscription $inscription)
    {
        $inscription->load([
            'eleve',
            'classe',
            'anneeScolaire'
        ]);

        return view(
            'inscriptions.show',
            compact('inscription')
        );
    }


    /**
     * Formulário de edição
     */
    public function edit(Inscription $inscription)
    {
        $inscription->load([
            'eleve',
            'classe',
            'anneeScolaire'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Apenas o ano ativo
        |--------------------------------------------------------------------------
        */

        $anneesScolaires = AnneeScolaire::where('ativo', true)
            ->orderByDesc('data_inicio')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Níveis
        |--------------------------------------------------------------------------
        */

        $levels = Classe::query()
            ->whereNotNull('level')
            ->where('level', '<>', '')
            ->distinct()
            ->orderBy('level')
            ->pluck('level');

        /*
        |--------------------------------------------------------------------------
        | Classes
        |--------------------------------------------------------------------------
        */

        $classes = Classe::orderBy('level')
            ->orderBy('name')
            ->get();

        return view(
            'inscriptions.edit',
            compact(
                'inscription',
                'anneesScolares',
                'levels',
                'classes'
            )
        );
    }


    /**
     * Atualizar inscrição
     */
    public function update(
        Request $request,
        Inscription $inscription
    ) {

        $validated = $request->validate([

            'classe_id' => [
                'required',
                'exists:classes,id'
            ],

            /*
             * Só permite atualizar para um ano ativo.
             */
            'annee_scolaire_id' => [
                'required',
                Rule::exists('annees_scolaires', 'id')
                    ->where(function ($query) {
                        $query->where('ativo', true);
                    }),
            ],

        ], [

            'classe_id.required' =>
                'É necessário selecionar uma classe.',

            'classe_id.exists' =>
                'A classe selecionada não existe.',

            'annee_scolaire_id.required' =>
                'É necessário selecionar o ano letivo.',

            'annee_scolaire_id.exists' =>
                'O ano letivo selecionado não está ativo ou não existe.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Verificar inscrição duplicada
        |--------------------------------------------------------------------------
        */

        $existing = Inscription::where(
                'eleve_id',
                $inscription->eleve_id
            )
            ->where(
                'annee_scolaire_id',
                $validated['annee_scolaire_id']
            )
            ->where(
                'id',
                '!=',
                $inscription->id
            )
            ->exists();

        if ($existing) {

            return back()
                ->withInput()
                ->withErrors([
                    'annee_scolaire_id' =>
                        'Este aluno já possui uma inscrição neste ano letivo.'
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Atualizar
        |--------------------------------------------------------------------------
        */

        $inscription->update([

            'classe_id' =>
                $validated['classe_id'],

            'annee_scolaire_id' =>
                $validated['annee_scolaire_id'],

        ]);


        return redirect()
            ->route('inscriptions.index')
            ->with(
                'success',
                'Inscrição atualizada com sucesso!'
            );
    }


    /**
     * Eliminar inscrição
     */
    public function destroy(
        Inscription $inscription
    ) {

        $inscription->delete();

        return redirect()
            ->route('inscriptions.index')
            ->with(
                'success',
                'Inscrição eliminada com sucesso!'
            );
    }
}