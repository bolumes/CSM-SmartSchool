<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnneeScolaireRequest;
use App\Http\Requests\UpdateAnneeScolaireRequest;
use App\Models\AnneeScolaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnneeScolaireController extends Controller
{
    /**
     * ==========================================================
     * LISTAR ANOS LETIVOS
     * ==========================================================
     */
    public function index()
    {
        $anneesScolaires = AnneeScolaire::orderByDesc(
            'data_inicio'
        )->paginate(15);

        return view(
            'annees_scolaires.index',
            compact('anneesScolaires')
        );
    }


    /**
     * ==========================================================
     * FORMULÁRIO PARA CRIAR
     * ==========================================================
     */
    public function create()
    {
        return view(
            'annees_scolaires.create'
        );
    }


    /**
     * ==========================================================
     * GUARDAR NOVO ANO LETIVO
     * ==========================================================
     */
    public function store(
        StoreAnneeScolaireRequest $request
    ) {
        $validated = $request->validated();

        DB::transaction(function () use ($validated) {

            /*
             * Se o novo ano for ativo,
             * desativar todos os outros.
             */
            if (!empty($validated['ativo'])) {

                AnneeScolaire::query()
                    ->where('ativo', true)
                    ->update([
                        'ativo' => false,
                    ]);
            }


            /*
             * Criar ano letivo.
             */
            AnneeScolaire::create([
                'nome' =>
                    $validated['nome'],

                'data_inicio' =>
                    $validated['data_inicio'],

                'data_fim' =>
                    $validated['data_fim'],

                'ativo' =>
                    !empty($validated['ativo']),
            ]);
        });


        return redirect()
            ->route('annees-scolaires.index')
            ->with(
                'success',
                'Ano letivo criado com sucesso.'
            );
    }


    /**
     * ==========================================================
     * MOSTRAR ANO LETIVO
     * ==========================================================
     */
    public function show(
        AnneeScolaire $anneeScolaire
    ) {
        $anneeScolaire->loadCount(
            'inscriptions'
        );

        return view(
            'annees_scolaires.show',
            compact('anneeScolaire')
        );
    }


    /**
     * ==========================================================
     * FORMULÁRIO PARA EDITAR
     * ==========================================================
     */
    public function edit(
        AnneeScolaire $anneeScolaire
    ) {
        return view(
            'annees_scolaires.edit',
            compact('anneeScolaire')
        );
    }


    /**
     * ==========================================================
     * ATUALIZAR ANO LETIVO
     * ==========================================================
     */
    public function update(
        UpdateAnneeScolaireRequest $request,
        AnneeScolaire $anneeScolaire
    ) {
        $validated = $request->validated();

        DB::transaction(function () use (
            $validated,
            $anneeScolaire
        ) {

            /*
             * Se este ano for ativado,
             * desativar todos os outros.
             */
            if (!empty($validated['ativo'])) {

                AnneeScolaire::query()
                    ->where(
                        'id',
                        '!=',
                        $anneeScolaire->id
                    )
                    ->where(
                        'ativo',
                        true
                    )
                    ->update([
                        'ativo' => false,
                    ]);
            }


            /*
             * Atualizar ano letivo.
             */
            $anneeScolaire->update([
                'nome' =>
                    $validated['nome'],

                'data_inicio' =>
                    $validated['data_inicio'],

                'data_fim' =>
                    $validated['data_fim'],

                'ativo' =>
                    !empty($validated['ativo']),
            ]);
        });


        return redirect()
            ->route('annees-scolaires.index')
            ->with(
                'success',
                'Ano letivo atualizado com sucesso.'
            );
    }


    /**
     * ==========================================================
     * ELIMINAR ANO LETIVO
     * ==========================================================
     */
    public function destroy(
        AnneeScolaire $anneeScolaire
    ) {
        /*
         * Não permitir eliminar o ano ativo.
         */
        if ($anneeScolaire->ativo) {

            return back()
                ->withErrors([
                    'anneeScolaire' =>
                        'Não é possível eliminar o ano letivo ativo.',
                ]);
        }


        /*
         * Não permitir eliminar ano
         * que tenha inscrições.
         */
        if (
            method_exists(
                $anneeScolaire,
                'inscriptions'
            )
            &&
            $anneeScolaire
                ->inscriptions()
                ->exists()
        ) {

            return back()
                ->withErrors([
                    'anneeScolaire' =>
                        'Não é possível eliminar este ano letivo porque existem inscrições associadas.',
                ]);
        }


        /*
         * Eliminar.
         */
        $anneeScolaire->delete();


        return redirect()
            ->route('annees-scolaires.index')
            ->with(
                'success',
                'Ano letivo eliminado com sucesso.'
            );
    }
}