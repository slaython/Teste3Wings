<?php

namespace App\Http\Controllers\Autenticacao;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Autenticacao\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Autenticacao extends Controller
{
    //LOGIN DOS USUÁRIOS
    public function Autenticacao(Request $Request){
        //MONTA A REQUISICAO
        $Requisicao = $this->Helpers->Requisicao();
        //VALIDAÇÃO DOS DADOS INFORMADOS PELO USUARIO
        $Validacao = Validator::make($Request->all(),
            [
                'USUARIO' => 'required', 
                'SENHA' => 'required'
            ],
            [
                'USUARIO.required' => "O campo USUARIO é obrigatório!",
                'SENHA.required' => "O campo SENHA é obrigatório!",
            ]
        );
        //VALIDA SE EXISTE ERROS
        if(!empty($Validacao->errors()->first())){
    		$Requisicao['resposta']['toast'] = $this->Helpers->ToastAlerta($Validacao->errors()->first());
    		return response()->json($Requisicao);
	    }
        //BUSCA OS DADOS NO BANCO
        $Login = $this->Helpers->DadosLogin($Request->USUARIO);
        if(!empty($Login)){
            if($this->Helpers->SenhaCheck($Request->SENHA, $Login->SENHA)){
                //MONTA AS SESSOES
                if(!Session::has('3WINGS')){
                    //SESSAO DE AUTENTICACAO
                    Session::put('3WINGS.AUTENTICACAO', $Login);
                }
                //REDIRECIONA
                $Requisicao['resposta']['redirect'] = 'http://127.0.0.1:8000/agenda';
                //MENSAGEM DE SUCESSO
                $Requisicao['resposta']['toast'] = $this->Helpers->ToastSucesso("Olá <b>{$this->Helpers->Nome($Login->NOME)}</b>, seja bem vindo!");
            }
            //MONSTA MENSAGEM E RETORNA JSON
            if(!$this->Helpers->SenhaCheck($Request->SENHA, $Login->SENHA)){
                //MENSAGEM DE ERRO
                $Requisicao['resposta']['toast'] = $this->Helpers->ToastError("Senha informada inválida!");
                return response()->json($Requisicao);
            }
        }
        //MONTA MENSAGEM E RETORNA JSON
        if(empty($Login)){
            //MENSAGEM DE ERRO
            $Requisicao['resposta']['toast'] = $this->Helpers->ToastError("Usuário informado não existe!");
            return response()->json($Requisicao);
        }
        return response()->json($Requisicao);
    }

    //LOGOUT DOS USUÁRIOS
    public function Logout(Request $Request){
        //MONTA A MINHA REQUISICAO
        $Requisicao = $this->Helpers->Requisicao();
        // RECUPERA O NOME DO USUÁRIO
        $Nome = $this->Helpers->Nome(Session::get('3WINGS.AUTENTICACAO')->NOME);
        //RETORNA A MENSAGEM DE LOGOUT
        $Requisicao['resposta']['toast'] = $this->Helpers->ToastInfo("Tchau <b>{$Nome}</b>, até mais!");
        //DEFINE A ROTA PARA O REDIRECIONAMENTO
        $Requisicao['resposta']['redirect'] = '/';
        //REMOVE SESSAO
        Session::flush('3WINGS');
        return response()->json($Requisicao);
    }
}
