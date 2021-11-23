<?php

namespace App\Http\Middleware;
use Closure;
use App\User;

class CheckApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        //Recuper l'authorization token dalla request
        $auth_token = $request->header('authorization');
        // Verifico se è presente un token di autorizzazione
        if(empty($auth_token)){
            return response()->json([
                'success'=>false,
                'error'=>'API Token mancante'
            ]);
        }

        //Estrarre l'API Token di autorizzazione che è formato in questo modo: 'Bearer api_token'
        $api_token = substr($auth_token, 7);

        // Verifico la correttezza dell'api token
        $user = User::where('api_token', $api_token)->first();
        if(!$user){
            return response()->json([
                'success'=>false,
                'error'=>'API Token errato'
            ]);
        }
        return $next($request);
    }
}   