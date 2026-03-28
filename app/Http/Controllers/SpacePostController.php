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
        // 1️⃣ Validação (agora com anexos)
        $validated = $request->validate([
            'content' => 'nullable|string|max:2000',
            'title'   => 'nullable|string|max:255',
            'attachments.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:10240'
        ]);

        // 2️⃣ Verifica se o usuário é membro do espaço
        if (!$space->users->contains(auth()->id())) {
            abort(403, 'Você não tem permissão para postar neste espaço.');
        }

        // 3️⃣ Criar a mensagem
        $post = SpacePost::create([
            'space_id' => $space->id,
            'user_id'  => auth()->id(),
            'title'    => $validated['title'] ?? null,
            'content'  => $validated['content'] ?? null,
        ]);

        // 4️⃣ Guardar anexos (SE existirem)
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {

                $path = $file->store('chat_files', 'public');

                $post->attachments()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'file_type' => $file->getClientMimeType(),
                    'file_size' => $file->getSize(),
                ]);
            }
        }

        // 5️⃣ Volta para o espaço
        return redirect()
            ->route('spaces.show', $space)
            ->with('success', 'Mensagem enviada com sucesso!');
    }
}
