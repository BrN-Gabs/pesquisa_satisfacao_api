<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pesquisa;
use Illuminate\Http\Request;

class PesquisaController extends Controller
{

    public function index()
    {

        $pesquisas = Pesquisa::select("pesquisas.*", "clientes.nome", "clientes.cpf", "clientes.email")
                    ->leftJoin('clientes', 'clientes.id', '=', 'pesquisas.cliente_id')
                    ->get();

        if (!!$pesquisas) {
            return $this->successResponseJson(json_encode($pesquisas));
        } 
            
        return $this->errorResponse("Error ao Buscar Pesquisas!");
        
    }

    public function store(Request $request, int $clienteId)
    {

        if ($clienteId) {

            $cliente = Cliente::find($clienteId);

            if (!!$cliente) {

                $dados = $request->except('_token');
                $dados['cliente_id'] = $clienteId;

                Pesquisa::create($dados);

                return $this->successResponse("Cadastro Realizado com Sucesso!");
            }

            return $this->errorResponse("Não foi Encontrado o Cliente!");
        }

        return $this->errorResponse("Campo clienteID está Vazio!");
    }

    public function show($id)
    {
        $pesquisa = Pesquisa::find($id);

        if (!!$pesquisa) {
            return $this->successResponseJson(json_encode($pesquisa));
        } 
            
        return $this->errorResponse("Erro ao Buscar a Pesquisa!");
    
    }

    public function pesquisaCliente($clienteId)
    {
        if ($clienteId) {

            $cliente = Cliente::find($clienteId);

            if (!!$cliente) {

                $pesquisaCliente = Pesquisa::select("pesquisas.*", "clientes.nome", "clientes.cpf", "clientes.email")
                    ->leftJoin('clientes', 'clientes.id', '=', 'pesquisas.cliente_id')
                    ->where('clientes.id', $clienteId)
                    ->get();

                if ($pesquisaCliente) {

                    return $this->successResponseJson(json_encode($pesquisaCliente));

                } else {

                    return $this->errorResponse("Erro ao Buscar a Pesquisa por Cliente!");

                }

            }

            return $this->errorResponse("Não foi Encontrado o Cliente!");
        }

        return $this->errorResponse("Campo clienteID está Vazio!");
    }

    public function pesquisaTema($tema)
    {
        if ($tema) {
            
            $pesquisa = Pesquisa::select("*")->where('tema_pesquisa', $tema)->get();

            if (json_decode($pesquisa)) {

                return $this->successResponseJson(json_encode($pesquisa));

            }

            return $this->errorResponse("Não foi Encontrado o Tema!");
        }

        return $this->errorResponse("Tema está Vazio!");
    }

    public function update(Request $request, $clienteId, $id)
    {   
       
        if ($clienteId) {

            $cliente = Cliente::find($clienteId);

            if (!!$cliente) {

                $pesquisa = Pesquisa::find($id);

                if (!!$pesquisa) {

                    if (strval($pesquisa["cliente_id"]) === $clienteId) {

                        $pesquisa->update([
                            'tema_pesquisa' => $request->tema_pesquisa,
                            'conteudo' => $request->conteudo,
                            'status' => $request->status,
                        ]);

                        return $this->successResponse("Pesquisa Alterada com Sucesso!");

                    }

                    return $this->errorResponse("Esse Cliente não fez essa Pesquisa!");

                }

                return $this->errorResponse("Pesquisa Não Encontrada!");

            }
            
            return $this->errorResponse("Cliente Não Encontrado!");
        }

        return $this->errorResponse("Error ao Realizar Alteração!");
    }

    public function destroy($id)
    {
        $pesquisa = Pesquisa::find($id);

        if (!!$pesquisa) {
            $pesquisa->delete();
            return $this->successResponse("Pesquisa Deletada com Sucesso!");
        }

        return $this->errorResponse("Error ao Deletar a Pesquisa!");
        
    }
}
