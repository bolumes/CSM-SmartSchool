<?php

namespace App\Http\Controllers;

use App\Models\Space;
use App\Models\SpacePost;
use Illuminate\Http\Request;

class SpacePostController extends Controller
{
    /**
     * Criar uma nova mensagem dentro de um espaço.
     */
    public function store(Request $request, Space $space)
    {
        // 1️⃣ Validação do conteúdo
        $validated = $request->validate([
            'content' => 'required|string|max:2000',
            'title'   => 'nullable|string|max:255', // opcional
        ]);

        // 2️⃣ Verifica se o usuário é membro do espaço
        // Se ainda não tem relação many-to-many, pode simplificar:
        // if ($space->created_by != auth()->id()) abort(403);
        if (!$space->users->contains(auth()->id())) {
            abort(403, 'Você não tem permissão para postar neste espaço.');
        }

        // 3️⃣ Criar a mensagem de forma segura
        $post = SpacePost::create([
            'space_id' => $space->id,
            'user_id'  => auth()->id(),
            'title'    => $validated['title'] ?? null,
            'content'  => $validated['content'],
        ]);

        // 4️⃣ Redireciona para a página do espaço
        return redirect()
            ->route('spaces.show', $space)
            ->with('success', 'Mensagem enviada com sucesso!');
    }
}
