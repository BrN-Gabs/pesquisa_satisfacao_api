<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function index()
    {
        $perfil = Perfil::get();

        return response(
            json_encode($perfil),
            200
        )->header('Content-Type', 'text/plain');
    }

    public function store(Request $request)
    {
        $dados = $request->except('_token');

        Perfil::create($dados);

        return redirect('/perfis');
    }

    public function show($id)
    {
        $perfil = Perfil::find($id);

        return response(
            json_encode($perfil),
            200
        );
    }

    public function update(Request $request, $id)
    {
        $cliente = Perfil::find($id);
        $cliente->update([
            'descricao' => $request->descricao,
        ]);

        return redirect('/perfis');
    }

    public function destroy($id)
    {
        $cliente = Perfil::find($id);
        $cliente->delete();

        return redirect('/perfis');
    }
}
