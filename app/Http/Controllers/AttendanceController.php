<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Classe;
use App\Models\Professor;
use App\Models\Matiere;
use App\Models\Eleve;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Mostrar formulário de assiduidade.
     */

    public function create()
    {
        $classes = Classe::all();
        $professors = Professor::all();
        $matieres = Matiere::all();

        $students = collect();

        return view('attendance.create', compact(
            'classes',
            'professors',
            'matieres',
            'students'
        ));
    }

    /**
     * Lista os alunos de uma turma (AJAX).
     */
    public function getElevesByClasse($classeId)
    {
        $eleves = Eleve::where('classe_id', $classeId)
            ->orderBy('nome')
            ->orderBy('apelido')
            ->get();

        return response()->json($eleves);
    }

    /**
     * Filtrar matérias pelo nível.
     */
    public function getMatieresByNiveau($niveau)
    {
        $matieres = Matiere::where('level', $niveau)->get();

        return response()->json($matieres);
    }

    /**
    * Filtrar turmas pelo nível.
    */
    public function getClassesByNiveau($niveau)
    {
        $classes = Classe::where('level', $niveau)
            ->orderBy('code')
            ->get();

        return response()->json($classes);
    }

    /**
     * Guardar assiduidade.
     */
    public function store(Request $request)
    {
        $request->validate([

            'classe_id'      => 'required|exists:classes,id',
            'matiere_id'     => 'required|exists:matieres,id',
            'professor_id'   => 'required|exists:professors,id',
            'lesson_number'  => 'required|integer|min:1',
            'attendance_date'=> 'required|date',
            'attendance'     => 'required|array',

        ]);

        foreach ($request->attendance as $eleveId => $status) {

            Attendance::updateOrCreate(

                [
                    'eleve_id'        => $eleveId,
                    'attendance_date' => $request->attendance_date,
                    'lesson_number'   => $request->lesson_number,
                    'matiere_id'      => $request->matiere_id,
                ],

                [
                    'classe_id'    => $request->classe_id,
                    'professor_id' => $request->professor_id,
                    'status'       => $status,
                    'remarks'      => $request->remarks[$eleveId] ?? null,
                ]

            );

        }

        return redirect()
            ->route('attendance.create')
            ->with(
                'success',
                'Assiduidade registada com sucesso!'
            );
    }

    public function listAttendance()
    {
        $classes = Classe::all();

        return view('attendance.listAttendance', compact('classes'));
    }

    /**
     * Lista a assiduidade por turma (AJAX).
     */
    public function getAttendanceByClasse($classeId)
    {
        $attendance = Attendance::with([
            'eleve',
            'classe',
            'matiere',
            'professor'
        ])
        ->where('classe_id', $classeId)
        ->orderByDesc('attendance_date')
        ->orderBy('lesson_number')
        ->get();

        return response()->json($attendance);
    }

    public function getAttendance(Request $request)
    {
        $query = Attendance::with([
            'eleve',
            'classe',
            'matiere',
            'professor'
        ]);

        if ($request->filled('classe_id')) {
            $query->where('classe_id', $request->classe_id);
        }

        if ($request->filled('attendance_date')) {
            $query->whereDate('attendance_date', $request->attendance_date);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $attendance = $query
            ->orderByDesc('attendance_date')
            ->orderBy('lesson_number')
            ->get();

        return response()->json($attendance);
    }
    
}