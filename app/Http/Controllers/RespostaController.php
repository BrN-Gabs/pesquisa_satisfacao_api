<?php

namespace App\Http\Controllers;

use App\Models\Pesquisa;
use App\Models\Resposta;
use Illuminate\Http\Request;

class RespostaController extends Controller
{
 
    public function index()
    {
        $respostas = Resposta::get();

        if (!!$respostas) {
            return $this->successResponseJson(json_encode($respostas));
        } 
            
        return $this->errorResponse("Error ao Buscar Respostas!");
        
    }

    public function store(Request $request, $pesquisaId, $clientesId)
    {
        
        if ($pesquisaId) {

            $pesquisa = Pesquisa::find($pesquisaId);

            if (!!$pesquisa) {

                $dados = $request->except('_token');
                $dados['pesquisa_id'] = $pesquisaId;
    
                Resposta::create($dados);
    
                return $this->successResponse("Cadastro Realizado com Sucesso!");

            }

            return $this->errorResponse("Não foi Encontrado a Pesquisa!");
        }

        return $this->errorResponse("Campo pesquisaId está Vazio!");
    }

    public function show($id)
    {
        $resposta = Resposta::find($id);

        if (!!$resposta) {
            return $this->successResponseJson(json_encode($resposta));
        } 
            
        return $this->errorResponse("Erro ao Buscar a Resposta!");
    }

    public function update(Request $request, $pesquisaId, $id)
    {
        if ($pesquisaId) {

            $pesquisa = Pesquisa::find($pesquisaId);

            if (!!$pesquisa) {

                $resposta = Resposta::find($id);

                if (!!$resposta) {

                    if (strval($resposta["pesquisa_id"]) === $pesquisaId) {

                        $resposta->update([
                            'resposta' => $request->resposta,
                            'nome' => $request->nome
                        ]);

                        return $this->successResponse("Resposta Alterada com Sucesso!");

                    }

                    return $this->errorResponse("Essa Pesquisa não tem Resposta!");

                }

                return $this->errorResponse("Resposta Não Encontrada!");

            }
            
            return $this->errorResponse("Pesquisa Não Encontrado!");
        }

        return $this->errorResponse("Error ao Realizar Alteração!");
    }

    public function respostaCliente($clienteId) {

        if ($clienteId) {

            $pesquisa = Pesquisa::select("*")->where("cliente_id", $clienteId)->get();

            if (json_decode($pesquisa)) {

                //select r.* from resposta r left join pesquisas p on p.id = r.pesquisa_id left join clientes c on c.id = p.cliente_id where c.id = $clienteId
                $resposta = Resposta::select("respostas.*")
                    ->leftJoin('pesquisas', 'pesquisas.id', '=', 'respostas.pesquisa_id')
                    ->leftJoin('clientes', 'clientes.id', '=', 'pesquisas.cliente_id')
                    ->where('clientes.id', $clienteId)
                    ->get();
                
                if (json_decode($resposta)) {

                    return $this->successResponseJson(json_encode($resposta));

                }

                return $this->errorResponse("Esse Cliente não tem Respostas em suas Pesquisas!");

            }

            return $this->errorResponse("Esse Cliente não tem Pesquisa Cadastrada!");

        }
        
        return $this->errorResponse("Cliente está Vazio!");

    }

    public function respostaClienteNome($nome) {

        $resposta = Resposta::select("*")->where("nome", $nome)->get();

        if (json_decode($resposta)) {

            return $this->successResponseJson(json_encode($resposta));

        }

        return $this->errorResponse("Esse Cliente não tem Resposta Cadastrada!");

    }

    

    public function respostaPesquisa($pesquisaId) {

        Pesquisa::find($pesquisaId);

        if (!!$pesquisaId) {
            
            $resposta = Resposta::select("*")->where('pesquisa_id', $pesquisaId)->get();

            if (json_decode($resposta)) {

                return $this->successResponseJson(json_encode($resposta));

            }

            return $this->errorResponse("Resposta não Encontrada!");

        }

        return $this->errorResponse("Pesquisa não Encontrada!");
        
    }

    public function destroy($id)
    {
        $resposta = Resposta::find($id);

        if (!!$resposta) {
            $resposta->delete();
            return $this->successResponse("Resposta Deletada com Sucesso!");
        }

        return $this->errorResponse("Error ao Deletar a Resposta!");
    }
}
