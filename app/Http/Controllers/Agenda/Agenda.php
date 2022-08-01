<?php

namespace App\Http\Controllers\Agenda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Agenda extends Controller
{
    public function CadastroCompromisso(Request $Request){
        //MONTA A REQUISICAO
        $Requisicao= $this->Helpers->Requisicao();
        $Validacao = Validator::make($Request->all(),
            [
                'DATAHORAINICIO'=> 'required',
                'DATAHORAFIM'=> 'required',
                'ASSUNTO'=> 'required',
                'RELEVANCIA'=> 'required',
            ],
            [

                'DATAHORAINICIO.required' => "O campo DATA HORA INICIO é obrigatório!",
                'DATAHORAFIM.required' => "O campo DATA HORA FIM é obrigatório!",
                'ASSUNTO.required' => "O campo ASSUNTO é obrigatório!",
                'RELEVANCIA.required' => "O campo RELEVACIA é obrigatório!",
            ]
        );
        //VALIDA SE EXISTE ERRO
        if(!empty($Validacao->errors()->first())){
            $Requisicao['resposta']['toast'] = $this->Helpers->ToastAlerta($Validacao->errors()->first());
            return response()->json($Requisicao);
        }
        //VERIFICA SE A DATA É VALIDA
        if(!empty($Request->DATAHORAINICIO)){
            $Data = $this->Helpers->DataValida($Request->DATAHORAINICIO);
            if($Data == false){
                $Requisicao['resposta']['toast'] = $this->Helpers->ToastAlerta(
                    "O campo DATA HORA INICIO precisa ser uma data válida!");
                return response()->json($Requisicao);
            }
        }
        if(!empty($Request->DATAHORAFIM)){
            $Data = $this->Helpers->DataValida($Request->DATAHORAFIM);
            if($Data == false){
                $Requisicao['resposta']['toast'] = $this->Helpers->ToastAlerta(
                    "O campo DATA HORA FIM precisa ser uma data válida!");
                return response()->json($Requisicao);
            }
        }
        //MONTA O ARRAY DOS DADOS
        $arrCadastroCompromisso= [
            'DATAHORAINICIO' => $this->Helpers->TimeStampFormatoBanco($Request->DATAHORAINICIO),
            'DATAHORAFIM' => $this->Helpers->TimeStampFormatoBanco($Request->DATAHORAFIM),
            'COMQUEM' => $Request->COMQUEM,
            'ASSUNTO' => $Request->ASSUNTO,
            'RELEVANCIA' => $Request->RELEVANCIA,
            'DESCRICAO' => $Request->DESCRICAO,
            'CRIADOPOR' => Session::get('3WINGS.AUTENTICACAO')->ID,
            'CRIADOEM' => date('Y-m-d H:i:s'),
            'STATUS' => 1,
        ];
        $CadastroCompromisso = DB::table('compromissos')->insertGetId($arrCadastroCompromisso);
        if(!empty($CadastroCompromisso)){
            //INFORMA SE FOI INSERIDO NO BANCO
            $Requisicao['resposta']['data']['INSERT'] = true;
            $arrCadastroCompromisso['ID'] = $CadastroCompromisso;
            $Requisicao['resposta']['data']['COMPROMISSO'] = $arrCadastroCompromisso;
            //MENSAGEM DE SUCESSO
            $Requisicao['resposta']['toast'] = $this->Helpers->ToastSucesso(
                "Compromisso cadastrado com sucesso!"
            );
            $Requisicao['resposta']['data']['HTML_COMPROMISSO'] = $this->Helpers->HTMLcompromisso($arrCadastroCompromisso);
            return response()->json($Requisicao);
        }
        //MENSAGEM DE ERRO
        $Requisicao['resposta']['toast'] = $this->Helpers->ToastError(
            "Erro ao tentar cadastrar o compromisso, recarregue a página e tente novamente!"
        );
        return response()->json($Requisicao);
    }

    public function PreviewCompromisso(Request $Request){
        //MONTA REQUISICAO
        $Requisicao = $this->Helpers->Requisicao();
        //VALIDA OS DADOS
        $Validacao = Validator::make($Request->all(),
            [ 'ID'=> 'required' ],
            [ 'ID.required' => 'Algo deu errado, recarregue a pagina e tente novamente!' ]
        );
        //VALIDA SE EXISTE ERRO
        if(!empty($Validacao->errors()->first())){
            $Requisicao['resposta']['toast'] = $this->Helpers->ToastError($Validacao->errors()->first());
            return response()->json($Requisicao);
        }
        $DadosPreview = $this->Helpers->DadosCompromisso($Request->ID);
        if(!empty($DadosPreview)){
            $ArrDadosPreview = [
                'ID' => $DadosPreview->ID,
                'DATAHORAINICIO' => $DadosPreview->DATAHORAINICIO,
                'DATAHORAFIM' => $DadosPreview->DATAHORAFIM,
                'COMQUEM' => $DadosPreview->COMQUEM,
                'ASSUNTO' => $DadosPreview->ASSUNTO,
                'HTMLRELEVANCIA' => $DadosPreview->HTMLRELEVANCIA,
                'DESCRICAO' => $DadosPreview->DESCRICAO,
                'CRIADOEM' => $DadosPreview->CRIADOEM,
            ];
            //INFORMA SE FOI INSERIDO NO BANCO
            $Requisicao['resposta']['data']['COMPROMISSO_VALIDO'] = true;
            //MONTA HTML DO USUÁRIO NA TABELA USUÁRIOS
            $Requisicao['resposta']['data']['HTML_PREVIEW_COMPROMISSO'] = $this->Helpers->HTMLPreviewCompromisso($ArrDadosPreview);
            return response()->json($Requisicao);
        }
    }

    public function ConcluirCompromisso(Request $Request){
        //MONTA A REQUISIÇÃO
        $Requisicao = $this->Helpers->Requisicao();
        //VALIDA OS DADOS
        $Validacao = Validator::make($Request->all(), [
            'ID' => 'required',
        ]);
        if($Validacao->fails()){
            $Requisicao['resposta']['toast'] = $this->Helpers->ToastError(
                'Parâmetros inválidos, atualize a página e tente novamente...'
            );
            return response()->json($Requisicao);
        }
        $DadosCompromissoConcluido = $this->Helpers->DadosCompromisso($Request->ID);
        if(!empty($DadosCompromissoConcluido)){
            $ArrDadosCompromissoConcluido = [
                'ID' => $DadosCompromissoConcluido->ID,
                'DATAHORAINICIO' => $DadosCompromissoConcluido->DATAHORAINICIO,
                'DATAHORAFIM' => $DadosCompromissoConcluido->DATAHORAFIM,
                'COMQUEM' => $DadosCompromissoConcluido->COMQUEM,
                'ASSUNTO' => $DadosCompromissoConcluido->ASSUNTO,
                'HTMLRELEVANCIA' => $DadosCompromissoConcluido->HTMLRELEVANCIA,
                'DESCRICAO' => $DadosCompromissoConcluido->DESCRICAO,
                'CRIADOEM' => $DadosCompromissoConcluido->CRIADOEM,
            ];
            //MONTA A MENSAGEM DE SUCESSO NA REQUISIÇÃO
            $Requisicao['resposta']['data']['SWAL_SUCESSO'] = true;
            DB::table('compromissos')->where('ID', $Request->ID)->update([
                'STATUS' => 2,
            ]);
            $Requisicao['resposta']['data']['HTML_COMPROMISSO_CONCLUIDO'] = $this->Helpers->HTMLcompromissoConcluido($ArrDadosCompromissoConcluido);
            return response()->json($Requisicao);
        }
    }

    public function CancelarCompromisso(Request $Request){
        //MONTA A REQUISIÇÃO
        $Requisicao = $this->Helpers->Requisicao();
        //VALIDA OS DADOS
        $Validacao = Validator::make($Request->all(), [
            'ID' => 'required',
        ]);
        if($Validacao->fails()){
            $Requisicao['resposta']['toast'] = $this->Helpers->ToastError(
                'Parâmetros inválidos, atualize a página e tente novamente...'
            );
            return response()->json($Requisicao);
        }
        //MONTA A MENSAGEM DE SUCESSO NA REQUISIÇÃO
        $Requisicao['resposta']['data']['SWAL_SUCESSO'] = true;
        DB::table('compromissos')->where('ID', $Request->ID)->update([
            'STATUS' => 3,
        ]);
        return response()->json($Requisicao);
    }
}
