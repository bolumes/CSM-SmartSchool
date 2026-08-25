<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Barryvdh\DomPDF\Facade\Pdf;

class HorarioController extends Controller
{
    /**
     * ==========================================
     * REUSO: QUERY BASE
     * ==========================================
     */
    private function baseProfessorQuery()
    {
        return Professor::with([
            'events.matiere',
            'events.progevents.sala'
        ])->orderBy('firstname');
    }

    /**
     * ==========================================
     * HORÁRIO DOS PROFESSORES
     * ==========================================
     */
    public function scheduleProf()
    {
        $professors = $this->baseProfessorQuery()->get();

        return view('horarios.horarioProfessor', compact('professors'));
    }

    /**
     * ==========================================
     * DOWNLOAD PDF INDIVIDUAL
     * ==========================================
     */
    public function downloadSchedule($id)
    {
        $professor = $this->baseProfessorQuery()
            ->where('id', $id)
            ->firstOrFail();

        $pdf = Pdf::loadView('horarios.pdf', [
            'professor' => $professor
        ]);

        return $pdf->download(
            'Horario_' . $professor->firstname . '_' . $professor->lastname . '.pdf'
        );
    }

    /**
     * ==========================================
     * DOWNLOAD TODOS OS HORÁRIOS
     * ==========================================
     */
    public function downloadAll()
    {
        $professors = $this->baseProfessorQuery()->get();

        $pdf = Pdf::loadView('horarios.pdf_all', [
            'professors' => $professors
        ]);

        return $pdf->download('Horario_Todos_Professores.pdf');
    }
}