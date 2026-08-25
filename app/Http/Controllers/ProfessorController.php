<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use App\Http\Requests\StoreProfessorRequest;
use App\Http\Requests\UpdateProfessorRequest;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    /**
     * Pesquisa professores.
     */
    public function search()
    {
        $professors = Professor::all();

        return view('professors.search', compact('professors'));
    }


    /**
     * Formulário para criar professor.
     */
    public function create()
    {
        return view('professors.create');
    }


    /**
     * Guardar novo professor.
     */
    public function store(StoreProfessorRequest $request)
    {
        $validatedData = $request->validated();

        Professor::create($validatedData);

        return redirect()
            ->route('professors.create')
            ->with('success', 'Professor created successfully!');
    }


    /**
     * Lista de professores.
     */
    public function listprofessors()
    {
        $professors = Professor::all();

        return view(
            'professors.listprofessors',
            compact('professors')
        );
    }


    /**
     * Mostrar professor.
     */
    public function show(Professor $professor)
    {
        return view(
            'professors.show',
            compact('professor')
        );
    }


    /**
     * Formulário de edição.
     */
    public function edit(Professor $professor)
    {
        /*
        |--------------------------------------------------------------------------
        | PROTEÇÃO
        |--------------------------------------------------------------------------
        | Admin e Direction não podem ser editados através
        | do módulo de professores.
        */

        if (in_array($professor->function, ['Admin', 'Direction'])) {

            abort(
                403,
                'Vous ne pouvez pas modifier un utilisateur Admin ou Direction.'
            );
        }

        return view(
            'professors.edit',
            compact('professor')
        );
    }


    /**
     * Atualizar professor.
     */
    public function update(
        UpdateProfessorRequest $request,
        Professor $professor
    ) {

        /*
        |--------------------------------------------------------------------------
        | PROTEÇÃO 1
        |--------------------------------------------------------------------------
        | Impede modificar Admin ou Direction.
        */

        if (in_array($professor->function, ['Admin', 'Direction'])) {

            abort(
                403,
                'Vous ne pouvez pas modifier un utilisateur Admin ou Direction.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDAÇÃO
        |--------------------------------------------------------------------------
        */

        $validatedData = $request->validated();


        /*
        |--------------------------------------------------------------------------
        | ATUALIZAÇÃO
        |--------------------------------------------------------------------------
        |
        | IMPORTANTE:
        | Não atualizamos "function".
        |
        | Portanto esta página não pode transformar:
        |
        | Professor -> Admin
        | Professor -> Direction
        |
        */

        $professor->update([

            'firstname' => $validatedData['firstname'],

            'lastname' => $validatedData['lastname'],

            'email' => $validatedData['email'],

            'telephone' => $validatedData['telephone'] ?? null,

            'address' => $validatedData['address'] ?? null,

        ]);


        /*
        |--------------------------------------------------------------------------
        | RETORNO
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'professors.show',
                $professor->id
            )
            ->with(
                'success',
                'Professor updated successfully!'
            );
    }


    /**
     * Eliminar professor.
     */
    public function destroy(Professor $professor)
    {
        /*
        |--------------------------------------------------------------------------
        | PROTEÇÃO ABSOLUTA
        |--------------------------------------------------------------------------
        | Admin e Direction nunca podem ser eliminados
        | através deste controller.
        */

        if (in_array($professor->function, ['Admin', 'Direction'])) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Vous ne pouvez pas supprimer un utilisateur Admin ou Direction.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | ELIMINAR
        |--------------------------------------------------------------------------
        */

        $professor->delete();


        /*
        |--------------------------------------------------------------------------
        | RETORNO
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('professors.listprofessors')
            ->with(
                'success',
                'Professor deleted successfully!'
            );
    }


    /**
     * Exportar professores para CSV.
     */
    public function export(Request $request)
    {
        $professors = Professor::all();

        $filename = 'professors.csv';

        $handle = fopen($filename, 'w+');


        /*
        |--------------------------------------------------------------------------
        | CABEÇALHO
        |--------------------------------------------------------------------------
        */

        fputcsv($handle, [
            'ID',
            'First Name',
            'Last Name',
            'Email',
            'Telephone',
            'Address'
        ]);


        /*
        |--------------------------------------------------------------------------
        | DADOS
        |--------------------------------------------------------------------------
        */

        foreach ($professors as $professor) {

            fputcsv($handle, [

                $professor->id,

                $professor->firstname,

                $professor->lastname,

                $professor->email,

                $professor->telephone,

                $professor->address

            ]);
        }


        fclose($handle);


        /*
        |--------------------------------------------------------------------------
        | DOWNLOAD
        |--------------------------------------------------------------------------
        */

        return response()
            ->download($filename)
            ->deleteFileAfterSend(true);
    }
}