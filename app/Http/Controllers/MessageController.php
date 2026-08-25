<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Lista de Parents
     */
    public function listPar()
    {
        $users = User::where('id', '!=', Auth::id())
            ->where('function', 'Parent')
            ->orderBy('firstname', 'asc')
            ->get();

        return view('chat.listParent', compact('users'));
    }

    /**
     * Lista de Professores
     */
    public function listProf()
    {
        $users = User::where('id', '!=', Auth::id())
            ->where('function', 'Professeur')
            ->orderBy('firstname', 'asc')
            ->get();

        return view('chat.listProfesseur', compact('users'));
    }

    /**
     * Lista da Administração
     */
    public function listAdmin()
    {
        $users = User::where('id', '!=', Auth::id())
            ->whereIn('function', ['Direction', 'Admin'])
            ->orderBy('firstname', 'asc')
            ->get();

        return view('chat.listAdministration', compact('users'));
    }

    /**
     * Abrir conversa privada
     */
    public function show(User $user)
    {
        $authUser = Auth::user();

        $messages = Message::where(function ($query) use ($authUser, $user) {

                $query->where('sender_id', $authUser->id)
                      ->where('receiver_id', $user->id);

            })->orWhere(function ($query) use ($authUser, $user) {

                $query->where('sender_id', $user->id)
                      ->where('receiver_id', $authUser->id);

            })
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'asc')
            ->get();

        return view('chat.private', compact('messages', 'user'));
    }

    /**
     * Enviar mensagem
     */
    public function send(Request $request, User $user)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Message::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => $user->id,
            'content'     => trim($request->content),
        ]);

        return redirect()
            ->route('chat.show', $user->id)
            ->with('success', 'Mensagem enviada com sucesso.');
    }
}