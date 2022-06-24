<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function index()
    {
        $perfil = Perfil::get();

        if (!!$perfil) {
            return $this->successResponseJson(json_encode($perfil));
        } 
            
        return $this->errorResponse("Error ao Buscar Perfis!");
        
    }

    public function store(Request $request)
    {
        $dados = $request->except('_token');

        if (!!$dados) {
            Perfil::create($dados);

            return $this->successResponse("Cadastro Realizado com Sucesso!");
        }

        return $this->errorResponse("Error ao Realizar Cadastro!");
        
    }

    public function show($id)
    {
        $perfil = Perfil::find($id);

        if (!!$perfil) {
            return $this->successResponseJson(json_encode($perfil));
        } 
            
        return $this->errorResponse("Perfil Não Existe!");
        
    }

    public function update(Request $request, $id)
    {
        $cliente = Perfil::find($id);

        if (!!$cliente) {

            $cliente->update([
                'descricao' => $request->descricao,
            ]);

            return $this->successResponse("Perfil Alterado com Sucesso!");

        }

        return $this->errorResponse("Error ao Realizar Alteração!");
        
    }

    public function destroy($id)
    {
        $cliente = Perfil::find($id);

        if (!!$cliente) {
            $cliente->delete();
            return $this->successResponse("Perfil Deletado com Sucesso!");
        } 
        
        return $this->errorResponse("Error ao Deletar o Perfil!");
        
    }
}
