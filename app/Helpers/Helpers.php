<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class Helpers
{
	/* TOASTS PADRÕES DA DASHBOARD */
    public function ToastError(string $Mensagem){
        return ['show' => true, 'icon' => 'ni ni-cross-circle-fill', 'classe' => 'error', 'position' => 'top-right', 'mensagem' => $Mensagem];
    }

    public function ToastInfo(string $Mensagem){
        return ['show' => true, 'icon' => 'ni ni-info-fill', 'classe' => 'info', 'position' => 'top-right', 'mensagem' => $Mensagem];
    }

    public function ToastSucesso(string $Mensagem){
        return ['show' => true, 'icon' => 'ni ni-check-circle', 'classe' => 'success', 'position' => 'top-right', 'mensagem' => $Mensagem];
    }

    public function ToastAlerta(string $Mensagem){
        return ['show' => true, 'icon' => 'ni ni-alert-fill', 'classe' => 'warning', 'position' => 'top-right', 'mensagem' => $Mensagem];
    }

	//DEFINE A REQUISIÇÃO PARA RETORNOS JSON
	public function Requisicao(){
		$Resposta = [
		   'resposta' => [
		       'data' => [],
		       'redirect' => false,
		       'loading' => false,
		       'toast' => [
       		        'icon' => 'ni ni-alert-fill',
                    'classe' => 'info',
                    'position' => 'top-right',
                    'mensagem' => 'Mensagem padrão, favor alterar!',
                    'show' => true
   		        ]
		    ],
		   'error' => [
		       'erro' => false,
		       'codigo' => '',
		       'mensagem' => '',
		    ]
		];
		return $Resposta;
	}

	//VERIFICA SE É UMA DTA VÁLIDA
	public function DataValida(string $data){
        $data = explode(' ', $data);
		$Data = explode('/', $data[0]);
		return checkdate($Data[1], $Data[0], $Data[2]);
	}

	//FORMATA A DATA PARA INSERÇÃO NO BANCO
	public function DataFormatoBanco(string $data){
		$Data = explode('/', $data);
		return "$Data[2]-$Data[1]-$Data[0]";
	}

	public function TimeStampFormatoView(string $DATA){
		$Data = explode(' ', $DATA);
		$data = explode('-', $Data[0]);
		$data2 = explode(':', $Data[1]);
		return "$data[2]/$data[1]/$data[0] $data2[0]:$data2[1]";
	}

    public function TimeStampDateFormatoView(string $DATA){
		$Data = explode(' ', $DATA);
		$data = explode('-', $Data[0]);
		return "$data[2]/$data[1]/$data[0]";
	}

	//FORMATA O TIMESTAMP PARA INSERÇÃO NO BANCO
	public function TimeStampFormatoBanco(string $data){
		$Data = explode(' ', $data);
		$DataData = explode('/', $Data[0]);
		return "$DataData[2]-$DataData[1]-$DataData[0] $Data[1]:00";
	}

	//FORMATA O NOME
	public function Nome(string $NOME){
		$Nome = explode(' ', $NOME);
		return "$Nome[0]";
	}

	//FORMATA O NOME
	public function NomeSobrenome(string $NOME){
		$Nome = explode(' ', $NOME);
		return "$Nome[0] $Nome[1]";
	}

    //CONSULTA OS DADOS DE LOGIN NO BANCO
	public function DadosLogin($Usuario){
		$QrLogin = DB::connection()->selectOne(
			"SELECT * FROM USUARIOS WHERE EMAIL = '{$Usuario}'"
		);
		return $QrLogin;
	}

    //ADICIONA A HASH A SENHA INPUTADA
	public function SenhaMake(string $Senha){
		return Hash::make("1!@3wings@".$Senha);
	}

	//COMPARA A SENHA DO BANCO À SENHA INPUTADA PELO USUÁRIO
	public function SenhaCheck(string $Senha, string $SenhaBanco){
		return Hash::check("1!@3wings@".$Senha, $SenhaBanco);
	}

    public function Compromissos(){
        $QrCompromissos = "
            SELECT
                compromissos.*,
                relevancias.HTMLRELEVANCIA,
                relevancias.DOTRELEVANCIA
            FROM
                compromissos
                LEFT JOIN relevancias
                ON compromissos.RELEVANCIA = relevancias.ID  
            WHERE
                compromissos.STATUS != 3
        ";
        $Compromissos = DB::connection()->select($QrCompromissos);
        foreach ($Compromissos as $Compromisso) {
            $Compromisso->DATAHORAINICIO = $this->TimeStampFormatoView($Compromisso->DATAHORAINICIO);
            $Compromisso->DATAHORAFIM = $this->TimeStampFormatoView($Compromisso->DATAHORAFIM);
        }
        return $Compromissos;
    }

    public function HTMLcompromisso($COMPROMISSO){
        $STAUTS = DB::connection()->selectOne("
            SELECT
                *
            FROM
                relevancias
            WHERE
                ID = {$COMPROMISSO['RELEVANCIA']}
        ");
        return "
            <tr class='nk-tb-item compromisso_{$COMPROMISSO['ID']}'>
                <td class='nk-tb-col'>
                    <div class='user-card'>
                        <div class='user-info'>
                            <span class='tb-lead'>{$this->TimeStampFormatoView($COMPROMISSO['DATAHORAINICIO'])} <span class='dot {$STAUTS->DOTRELEVANCIA} d-md-none ms-1'></span></span>
                            <span>Até {$this->TimeStampFormatoView($COMPROMISSO['DATAHORAFIM'])}</span>
                        </div>
                    </div>
                </td>
                <td class='nk-tb-col tb-col-mb' data-order='35040.34'>
                    <span class='currency'>{$COMPROMISSO['COMQUEM']}</span>
                </td>
                <td class='nk-tb-col tb-col-lg'>
                    <span>{$COMPROMISSO['ASSUNTO']}</span>
                </td>
                <td class='nk-tb-col tb-col-lg'>
                    <span>{$COMPROMISSO['CONTATO']}</span>
                </td>
                <td class='nk-tb-col tb-col-md'>
                    <span class='tb-status text-warning'>{$STAUTS->HTMLRELEVANCIA}</span>
                </td>
                <td class='nk-tb-col nk-tb-col-tools'>
                    <ul class='nk-tb-actions gx-1'>
                        <li>
                            <div class='drodown'>
                                <a href='#' class='dropdown-toggle btn btn-icon btn-trigger' data-bs-toggle='dropdown'><em class='icon ni ni-more-h'></em></a>
                                <div class='dropdown-menu dropdown-menu-end'>
                                    <ul class='link-list-opt no-bdr'>
                                        <li><a href='#' class='js_visualizar_compromisso' data-id='{$COMPROMISSO['ID']}' data-bs-toggle='modal' data-bs-target='#modalVisualizar'><em class='icon ni ni-eye'></em><span>Visualizar</span></a></li>
                                        <li><a href='#' class='js_feito_compromisso' data-id='{$COMPROMISSO['ID']}'><em class='icon ni ni-check'></em><span>Feito</span></a></li>
                                        <li><a href='#' class='js_cancelar_compromisso' data-id='{$COMPROMISSO['ID']}'><em class='icon ni ni-cross'></em><span>Cancelar</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </td>
            </tr>
        ";
    }

    public function DadosCompromisso($ID){
        $QrDadosPreview = "
            SELECT
                compromissos.*,
                relevancias.HTMLRELEVANCIA,
                relevancias.DOTRELEVANCIA
            FROM
                compromissos
                LEFT JOIN relevancias
                ON compromissos.RELEVANCIA = relevancias.ID  
            WHERE
                compromissos.ID = {$ID}
        ";
        $DadosPreview = DB::connection()->selectOne($QrDadosPreview);
            $DadosPreview->DATAHORAINICIO = $this->TimeStampFormatoView($DadosPreview->DATAHORAINICIO);
            $DadosPreview->DATAHORAFIM = $this->TimeStampFormatoView($DadosPreview->DATAHORAFIM);
            $DadosPreview->CRIADOEM = $this->TimeStampDateFormatoView($DadosPreview->CRIADOEM);
        return $DadosPreview;
    }
    
    public function HTMLPreviewCompromisso($DADOS){
        return "
            <div class='js_dados_compromisso_rmv' id='js_dados_compromisso_rmv'>
                <div class='nk-block-head'>
                    <div class='nk-block-head-content'>
                        <h5 class='nk-block-title title'>Informações do candidato</h5>
                        <p>Informações de cadastro relacionadas ao usuário em destaque.</p>
                    </div>
                </div>
                <div class='card card-bordered'>
                    <ul class='data-list is-compact'>
                        <li class='data-item pt-1 pb-1'>
                            <div class='data-col'>
                                <div class='data-label'>Data Hora de :</div>
                                <div class='data-value'>{$DADOS['DATAHORAINICIO']}</div>
                            </div>
                        </li>
                        <li class='data-item pt-1 pb-1'>
                            <div class='data-col'>
                                <div class='data-label'>Data Hora até :</div>
                                <div class='data-value'>{$DADOS['DATAHORAFIM']}</div>
                            </div>
                        </li>
                        <li class='data-item pt-1 pb-1'>
                            <div class='data-col'>
                                <div class='data-label'>Com quem :</div>
                                <div class='data-value'>{$DADOS['COMQUEM']}</div>
                            </div>
                        </li>
                        <li class='data-item pt-1 pb-1'>
                            <div class='data-col'>
                                <div class='data-label'>Assunto :</div>
                                <div class='data-value'>{$DADOS['ASSUNTO']}</div>
                            </div>
                        </li>
                        <li class='data-item pt-1 pb-1'>
                            <div class='data-col'>
                                <div class='data-label'>Contato :</div>
                                <div class='data-value'>{$DADOS['CONTATO']}</div>
                            </div>
                        </li>
                        <li class='data-item pt-1 pb-1'>
                            <div class='data-col'>
                                <div class='data-label'>Relevância :</div>
                                <div class='data-value'>{$DADOS['HTMLRELEVANCIA']}</div>
                            </div>
                        </li>
                        <li class='data-item pt-1 pb-1'>
                            <div class='data-col'>
                                <div class='data-label'>Descrição :</div>
                                <div class='data-value'>{$DADOS['DESCRICAO']}</div>
                            </div>
                        </li>
                        <li class='data-item pt-1 pb-1'>
                            <div class='data-col'>
                                <div class='data-label'>Criado em :</div>
                                <div class='data-value'>{$DADOS['CRIADOEM']}</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        ";
    }

    public function HTMLcompromissoConcluido($DADOS){
        return "
            <tr class='nk-tb-item compromisso_concluido_{$DADOS['ID']}'>
                <td class='nk-tb-col'>
                    <div class='user-card'>
                        <div class='user-info'>
                            <span class='tb-lead text-success'>{$DADOS['DATAHORAINICIO']} <span class='dot d-md-none ms-1'></span></span>
                            <span>Até {$DADOS['DATAHORAFIM']}</span>
                        </div>
                    </div>
                </td>
                <td class='nk-tb-col tb-col-mb' data-order='35040.34'>
                    <span class='currency text-success'>{$DADOS['COMQUEM']}</span>
                </td>
                <td class='nk-tb-col tb-col-lg'>
                    <span class='currency text-success'>{$DADOS['ASSUNTO']}</span>
                </td>
                <td class='nk-tb-col tb-col-lg'>
                    <span class='currency text-success'>{$DADOS['CONTATO']}</span>
                </td>
                <td class='nk-tb-col tb-col-md'>
                    <span class='tb-status text-warning'>{$DADOS['HTMLRELEVANCIA']}</span>
                </td>
            </tr>
        ";
    }
}