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

    // Mostrar um espaço com posts e comentários (genérico)
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

    /**
     * Mostra o chat específico para professores.
     * Cria o espaço "Chat Professores" se não existir.
     */
    public function showProfessorChat()
    {
        // Cria ou recupera o espaço "Chat Professores"
        $space = Space::firstOrCreate(
            ['name' => 'Chat Professores'],
            [
                'description' => 'Espaço para troca de mensagens entre professores',
                'created_by' => auth()->id()
            ]
        );

        // Garante que o usuário atual é membro do espaço
        if (!$space->users->contains(auth()->id())) {
            $space->users()->attach(auth()->id());
        }

        // Carrega as relações necessárias
        $space->load([
            'posts.user',
            'posts.comments.user',
            'posts.attachments',  // se houver anexos
            'creator'
        ]);

        // Retorna a view específica para professores
        return view('spaces.professor', compact('space'));
    }

    /**
     * Mostra o chat específico para parents.
     * Verifica permissões e cria o espaço "Chat Parents" se não existir.
     */
    public function showParentChat()
    {
        $user = auth()->user();

        // Verifica permissão de acesso: função Parent/Admin/Direction OU permissão individual chat_parent = true
        if (!in_array($user->function, ['Parent', 'Admin', 'Direction']) && !$user->chat_parent) {
            abort(403, 'Acesso restrito.');
        }

        // Cria ou recupera o espaço "Chat Parents"
        $space = Space::firstOrCreate(
            ['name' => 'Chat Parents'],
            [
                'description' => 'Espaço para troca de mensagens entre pais',
                'created_by'  => $user->id
            ]
        );

        // Garante que o usuário atual seja membro do espaço
        if (!$space->users->contains($user->id)) {
            $space->users()->attach($user->id);
        }

        // Carrega as relações necessárias
        $space->load([
            'posts.user',
            'posts.comments.user',
            'posts.attachments',
            'creator'
        ]);

        // Retorna a view específica para parents
        return view('spaces.parent', compact('space'));
    }
}