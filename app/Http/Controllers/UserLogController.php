<?php

namespace App\Http\Controllers;

use App\Models\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLogController extends Controller
{
    
    // Exibe todos os logs (talvez apenas para Admin/Direction)
    public function adminLogs()
    {
        $this->authorizeByFunction('Admin');

        $logs = UserLog::where('fonction', 'Admin')->with('user')->orderBy('logged_in_at', 'desc')->get();
        return view('userlogs.admin', compact('logs'));
    }

    public function directionLogs()
    {
        $this->authorizeByFunction('Direction');

        $logs = UserLog::where('fonction', 'Direction')->with('user')->orderBy('logged_in_at', 'desc')->get();
        return view('userlogs.direction', compact('logs'));
    }

    public function professeurLogs()
    {
        $this->authorizeByFunction('Professeur');

        $logs = UserLog::where('fonction', 'Professeur')->with('user')->orderBy('logged_in_at', 'desc')->get();
        return view('userlogs.professeur', compact('logs'));
    }

    public function parentLogs()
    {
        $this->authorizeByFunction('Parent');

        $logs = UserLog::where('fonction', 'Parent')->with('user')->orderBy('logged_in_at', 'desc')->get();
        return view('userlogs.parent', compact('logs'));
    }

    public function eleveLogs()
    {
        $this->authorizeByFunction('Eleve');

        $logs = UserLog::where('fonction', 'Eleve')->with('user')->orderBy('logged_in_at', 'desc')->get();
        return view('userlogs.eleve', compact('logs'));
    }

    // Verificação se o user é Admin ou Direction
    private function authorizeAdminOrDirection()
    {
        $user = Auth::user();
        if (!in_array($user->fonction, ['Admin', 'Direction'])) {
            abort(403, 'Acesso não autorizado.');
        }
    }

    // Verificação se o user tem a função correta para ver os logs
    private function authorizeByFunction($requiredFunction)
    {
        $userFunction = strtolower(trim(Auth::user()->fonction));
        $required = strtolower(trim($requiredFunction));

        if (!in_array($userFunction, ['admin', 'direction', $required])) {
            abort(403, 'Acesso não autorizado.');
        }
    }


}
