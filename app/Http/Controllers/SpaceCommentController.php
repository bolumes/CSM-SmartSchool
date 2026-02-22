<?php

namespace App\Http\Controllers;

use App\Models\SpacePost;
use App\Models\SpaceComment;
use Illuminate\Http\Request;

class SpaceCommentController extends Controller
{
    /**
     * Criar um comentário em uma mensagem/post dentro de um espaço.
     */
    public function store(Request $request, SpacePost $post)
    {
        // 1️⃣ Validação do conteúdo
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // 2️⃣ Verifica se o usuário é membro do espaço do post
        // Caso o relacionamento users ainda não exista, use apenas auth()->id() == $post->user_id
        if (!$post->space->users->contains(auth()->id())) {
            abort(403, 'Você não tem permissão para comentar neste espaço.');
        }

        // 3️⃣ Criar o comentário com MassAssignment seguro
        $comment = SpaceComment::create([
            'space_post_id' => $post->id,
            'user_id'       => auth()->id(),
            'content'       => $validated['content'], // usa array validado
        ]);

        // 4️⃣ Redirecionar de volta para o espaço com sucesso
        return redirect()
            ->route('spaces.show', $post->space)
            ->with('success', 'Comentário enviado com sucesso!');
    }
}
