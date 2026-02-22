<?php

namespace App\Http\Controllers;

use App\Models\Space;
use Illuminate\Http\Request;

class SpaceController extends Controller
{
    // Listar todos os espaços/grupos
    public function index()
    {
        $spaces = Space::with('creator')->latest()->get();
        return view('spaces.index', compact('spaces'));
    }

    // Mostrar um espaço com posts e comentários
    public function show(Space $space)
    {
        // Só membros podem acessar
        if (!$space->users->contains(auth()->id())) {
            abort(403);
        }

        $space->load('creator', 'messages.user', 'messages.comments.user');

        return view('spaces.show', compact('space'));
    }

    // Criar novo espaço
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $space = Space::create([
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => auth()->id(),
        ]);

        // Adiciona o criador como membro
        $space->users()->attach(auth()->id());

        return redirect()->route('spaces.show', $space)->with('success', 'Espaço criado!');
    }

    public function showProfessorChat()
    {
        // Escolhe ou cria um espaço fixo para todos os professores
        $space = \App\Models\Space::firstOrCreate(
            ['name' => 'Chat Professores'],
            [
                'description' => 'Espaço para troca de mensagens entre professores',
                'created_by' => auth()->id()
            ]
        );

        // Garante que o usuário está na lista de membros
        if (!$space->users->contains(auth()->id())) {
            $space->users()->attach(auth()->id());
        }

        $space = \App\Models\Space::with([
            'posts.user',          // autor das mensagens
            'posts.comments.user', // autor dos comentários
            'creator'              // criador do espaço
        ])->firstOrCreate(
            ['name' => 'Chat Professores'],
            ['description' => 'Espaço para troca de mensagens entre professores', 'created_by' => auth()->id()]
        );

        // Carrega posts e comentários com os usuários
        $space->load('posts.user', 'posts.comments.user', 'creator');

        return view('spaces.show', compact('space'));
    }


}
