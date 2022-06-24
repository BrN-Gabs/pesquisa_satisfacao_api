<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
 
    public function index()
    {
        $clientes = Cliente::get();

        if (!!$clientes) {
            return $this->successResponseJson(json_encode($clientes));
        } else {
            return $this->errorResponse("Error ao Buscar Clientes!");
        }
    }

    public function store(Request $request)
    {   
        $dados = $request->except('_token');

        if (!!$dados) {
            Cliente::create($dados);
            return $this->successResponse("Cadastro Realizado com Sucesso!");
        }

        return $this->errorResponse("Error ao Cadastrar Clientes!");
 
    }

    public function show($id)
    {
        $clientes = Cliente::find($id);

        if (!!$clientes) {
            return $this->successResponseJson(json_encode($clientes));
        }

        return $this->errorResponse("Cliente Não Existe!");

    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        if (!!$cliente) {

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

            return $this->successResponse("Perfil Alterado com Sucesso!");

        }

        return $this->errorResponse("Error ao Realizar Alteração!");
        
    }

    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        if (!!$cliente) {
            $cliente->delete();
            return $this->successResponse("Cliente Deletado com Sucesso!");
        }

        return $this->errorResponse("Error ao Deletar o Cliente!");
        
    }
}
