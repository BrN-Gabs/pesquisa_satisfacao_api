<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
 
    public function index()
    {
        $clientes = Cliente::get();

        return response(
            json_encode($clientes),
            200
        )->header('Content-Type', 'text/plain');
    }

    public function store(Request $request)
    {   
        //$cliente = new Cliente();

        $dados = $request->except('_token');
        Cliente::create($dados);

        //$perfil = $cliente->perfil();

        return redirect('/clientes');
    }

    public function show($id)
    {
        $clientes = Cliente::find($id);

        return response(
            json_encode($clientes),
            200
        )->header('Content-Type', 'text/plain');   
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);
        $cliente->update([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => $request->senha,
            'telefone' => $request->telefone,
            'cpf' => $request->cpf,
            'cep' => $request->cep,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
            'endereco' => $request->endereco,
            'bairro' => $request->bairro,
            'numero' => $request->numero,
            'perfils_id' => $request->perfils_id,
        ]);

        return redirect('/clients');
    }

    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();

        return redirect('/clientes');
    }
}
