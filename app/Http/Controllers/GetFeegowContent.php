<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;


class GetFeegowContent extends Controller
{
    private $tokenDoug = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJmZWVnb3ciLCJhdWQiOiJwdWJsaWNhcGkiLCJpYXQiOiIxNy0wOC0yMDE4IiwibGljZW5zZUlEIjoiMTA1In0.UnUQPWYchqzASfDpVUVyQY0BBW50tSQQfVilVuvFG38';

    /**
     * Função/Métoodo para requisitar dados da API via REST
     * @param string $url
     * @return mixed
     */
    public function getApiContent($url)
    {
        $header = ['x-access-token' => $this->tokenDoug, 'Content-Type' => 'application/json'];

        $httpCli = new Client();

        try {
            $resp = $httpCli->get($url,['headers' => $header]);
        } catch (\Exception $excep) {
            return false;
        }

        //pegando statusCode;
        //Existem outros estados, mas para o consumo de aplicação, somente era esperdo 200 para as consultas bem sucedidas
        if($resp->getStatusCode() != 200) {
            return false;
        }

        $bodyContent = $resp->getBody()->getContents();

        $ok = json_decode($bodyContent)->success;

        if($ok) {
            $resp = json_decode($bodyContent)->content;
            return $resp;
        } else {
            return false;
        }
    }
}
