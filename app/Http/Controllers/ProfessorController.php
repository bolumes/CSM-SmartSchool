<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProfessorRequest;
use App\Http\Requests\UpdateProfessorRequest;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function search()
    {
        // Implement the search logic here
        // For example, you can return a view with a search form or handle search queries
        $professors = Professor::all(); // Fetch all professors if needed
        return view('professors.search', compact('professors')); // Adjust the view name as needed

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the view for creating a new professor
        return view('professors.create'); // Adjust the view name as needed
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfessorRequest $request)
    {
        // Validate and store the new professor data
        $validatedData = $request->validated();
        
        // Create a new professor record in the database
        Professor::create($validatedData);

        // Redirect or return a response after storing the professor
        return redirect()->route('professors.create')->with('success', 'Professor created successfully!');
    }

    /**
     * Display a listing of the resource.
     */
    public function listprofessors()
    {
        // Fetch all professors from the database
        $professors = Professor::all();

        // Return the view with the list of professors
        return view('professors.listprofessors', compact('professors')); // Adjust the view name as needed
    }

    /**
     * Display the specified resource.
     */
    public function show(Professor $professor)
    {
        // Return the view to show the details of a specific professor
        return view('professors.show', compact('professor')); // Adjust the view name as needed
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Professor $professor)
    {
        // Return the view for editing a specific professor
        return view('professors.edit', compact('professor')); // Adjust the view name as needed
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfessorRequest $request, Professor $professor)
    {
        // Validate and update the professor data
        $validatedData = $request->validated();

        // Update the professor record in the database
        $professor->update([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'telephone' => $request->input('telephone'),
            'address' => $request->input('address'),
        ]);

        // Redirect or return a response after updating the professor
        return redirect()->route('professors.show', $professor->id)->with('success', 'Professor updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Professor $professor)
    {
        // Delete the specified professor from the database
        $professor->delete();

        // Redirect or return a response after deleting the professor
        return redirect()->route('professors.index')->with('success', 'Professor deleted successfully!');
    }

    public function export(Request $request)
    {
        $professors = Professor::all(); // Obtém todas as matérias do banco de dados

        // Cria um arquivo CSV
        $filename = 'professors.csv';
        $handle = fopen($filename, 'w+');

        // Cabeçalho do CSV
        fputcsv($handle, ['ID', 'First Name', 'Last Name', 'Email', 'Telephone', 'Address']);

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

        // Retorna o arquivo para download e apaga depois
        return response()->download($filename)->deleteFileAfterSend(true);
    }
    
}
