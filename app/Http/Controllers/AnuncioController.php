<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAnuncioRequest;
use App\Http\Requests\UpdateAnuncioRequest;
use App\Models\Anuncio;
use Illuminate\Http\Request;

class AnuncioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function search(Request $request)
    {
        $anuncios = [];
    
        if ($request->filled('date')) {
            $date = $request->input('date');
    
            $anuncios = Anuncio::where('date', 'like', '%' . $date . '%')->get();
        }
    
        return view('anuncios.search', compact('anuncios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //dd("Create foi acessado!");
        return view('anuncios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnuncioRequest $request)
    {
        // Valida os dados do formulário, incluindo o arquivo
        $data = $request->validated();

        // Se o arquivo foi enviado, armazene-o
        if ($request->hasFile('fichier')) {
            // Armazenando o arquivo na pasta public/anuncios e obtendo o caminho
            $filePath = $request->file('fichier')->store('anuncios', 'public');

            
            // Adiciona o caminho do arquivo ao array de dados
            $data['fichier'] = $filePath;
        }

        // Cria o anúncio no banco de dados, incluindo o caminho do arquivo
        Anuncio::create($data);

        // Redireciona com mensagem de sucesso
        return redirect()->route('anuncios.create')->with('success', 'Anúncio criado com sucesso!');
    }


    public function listAnuncio()   
    {
        $anuncios = Anuncio::orderBy('date', 'desc')->get(); // Ordena pela data mais recente
        return view('anuncios.listanuncios', ['anuncios' => $anuncios]);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $anuncio = Anuncio::findOrFail($id);
        return view('anuncios.show', compact('anuncio'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $anuncio = Anuncio::findOrFail($id);
        return view('anuncios.edit', compact('anuncio'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnuncioRequest $request, Anuncio $anuncio)
    {
        $data = $request->validated();
    
        // Verifica se foi enviado um novo arquivo
        if ($request->hasFile('fichier')) {
            // Armazena o novo arquivo corretamente em 'storage/app/public/anuncios'
            $filePath = $request->file('fichier')->store('anuncios', 'public');
            $data['fichier'] = $filePath;
        } else {
            // Garante que o campo não seja sobrescrito se não houver novo upload
            unset($data['fichier']);
        }
    
        $anuncio->update($data);
    
        return redirect()->route('anuncios.edit', $anuncio)->with('success', 'Anúncio atualizado com sucesso!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Anuncio $anuncio)
    {
        $anuncio->delete();

        return redirect()
            ->route('anuncios.listanuncios')
            ->with('success', 'Anúncio deletado com sucesso!');
    }
}
