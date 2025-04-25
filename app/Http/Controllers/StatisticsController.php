<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Edificio;
use App\Models\Matiere;
use App\Models\Sala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    // Método estatística de salas por edifício
    public function salasPorEdificio()
    {
        $estatistics = Edificio::leftJoin('salas', 'edificios.id', '=', 'salas.edificio_id')
            ->select('edificios.name as edificio_nome', DB::raw('COUNT(salas.id) as numero_de_salas'))
            ->groupBy('edificios.id', 'edificios.name')
            ->orderBy('edificios.name')
            ->get();

        return view('estatistics.salasporedificio', compact('estatistics'));
    }

 
     // Método estatística de docentes por formação
     public function professorPorMatiere()
     {
         $estatistics = Matiere::join('events', 'matieres.id', '=', 'events.matiere_id')
             ->join('professors', 'events.professor_id', '=', second: 'professors.id')
             ->select('matieres.code as matiere_code', DB::raw('COUNT(DISTINCT events.professor_id) as numero_de_professors'))
             ->groupBy('matieres.id', 'matieres.code')
             ->orderBy('matieres.code')
             ->get();
 
         return view('estatistics.professorpormatiere', compact('estatistics'));
     }
 
     // Método estatística de eventos por sala
     public function eventosPorSala()
     {
         $estatistics = Sala::leftJoin('progevents', 'salas.id', '=', 'progevents.sala_id')
             ->leftJoin('events', 'progevents.event_id', '=', 'events.id')
             ->select('salas.name as sala_name', DB::raw('COUNT(events.id) as numero_de_events'))
             ->groupBy('salas.id', 'salas.name')
             ->orderBy('salas.name')
             ->get();
 
         return view('estatistics.eventosporsala', compact('estatistics'));
     }
 

}
