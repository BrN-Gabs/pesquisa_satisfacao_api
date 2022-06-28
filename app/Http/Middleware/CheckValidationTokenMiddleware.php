<?php

namespace App\Http\Middleware;

use App\Models\Cliente;
use Closure;
use Illuminate\Http\Request;
use ReallySimpleJWT\Token;

use function PHPUnit\Framework\isFalse;
use function PHPUnit\Framework\isTrue;

class CheckValidationTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');

        $tokenBearer = explode("Bearer ", $token);  

        $tokenParts = explode(".", $tokenBearer[1]);

        $tokenHeader = base64_decode($tokenParts[0]);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtHeader = json_decode($tokenHeader);
        $jwtPayload = json_decode($tokenPayload);  

        $validateExpiration = Token::validateExpiration($tokenBearer[1]);

        if ($validateExpiration == false) {
            return response(
                "Token Expirado!",
                400
            )->header('Content-Type', 'text/plain');
        }
        
        $email = $jwtPayload->client->email;
        $senha = $jwtPayload->client->senha;

        $cliente = Cliente::select("*")->where("email", $email)->where("senha", $senha)->get();

        if (!$cliente) {
            return response(
                "Token não Autenticado!",
                400
            )->header('Content-Type', 'text/plain');
        }

        return $next($request);
    }
}
