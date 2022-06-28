<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Perfil;
use Illuminate\Http\Request;

use ReallySimpleJWT\Token;

class ClienteController extends Controller
{


    public function index()
    {
        $clientes = Cliente::get();

        if (!!$clientes) {
            return $this->successResponseJson(json_encode($clientes));
        }

        return $this->errorResponse("Error ao Buscar Clientes!");

    }

    public function store(Request $request)
    {
        $dados = $request->except('_token');

        $perfil = Perfil::find($request['perfils_id']);

        if (json_decode($perfil)) {

            $clienteEmail = Cliente::select('*')->where('email', $request['email'])->get();

            if (!json_decode($clienteEmail)) {

                $dados['senha'] = md5($dados['senha']);

                if (!!$dados) {
                    Cliente::create($dados);
                    return $this->successResponse("Cadastro Realizado com Sucesso!");
                }

                return $this->errorResponse("Error ao Cadastrar Clientes!");
            }

            return $this->errorResponse("E-mail já Cadastrado!");
        }

        return $this->errorResponse("Perfil Não Cadastrado!");
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
        $dados = $request->except('_token');

        $perfil = Perfil::find($dados['perfils_id']);

        if (json_decode($perfil)) {

            $cliente = Cliente::find($id);

            if (!!$cliente) {

                if (!$request['senha']) {

                    $senha = Cliente::select('senha')->where('id', $id)->get();
                    
                    array_push($dados, $senha);

                    $cliente->update($dados);
                    
                    return $this->successResponse("Cliente Alterado com Sucesso!");

                }
    
                $dados['senha'] = md5($dados['senha']);
    
                $cliente->update($dados);

                return $this->successResponse("Cliente Alterado com Sucesso!");

            }

            return $this->errorResponse("Cliente Não Encontrado!");

        }

        return $this->errorResponse("Perfil Não Cadastrado!");

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

    public function verificaLogin(Request $request)
    {

        if ($request['email'] && $request['senha']) {

            $clienteEmail = Cliente::select('*')->where('email', $request['email'])->get();

            if (json_decode($clienteEmail)) {

                $clienteSenha = Cliente::select('*')->where('email', $request['email'])->where('senha', md5($request['senha']))->get();

                if (json_decode($clienteSenha)) {

                    return $this->createToken($clienteSenha[0]);
                }

                return $this->errorResponse("Senha Inválida");
            }

            return $this->errorResponse("E-mail Inválido");
        }

        return $this->errorResponse("E-mail ou Senha Vazio!");
    }

    private function createToken($dadosCliente)
    {

        $payload = [
            'iat' => time(),
            'uid' => 1,
            'exp' => time() + 100000,
            'iss' => 'localhost',
            'client' => $dadosCliente
        ];

        $secret = 'ChaveSuperSecreta&123';
        $token = Token::customPayload($payload, $secret);

        return $token;
    }


}
