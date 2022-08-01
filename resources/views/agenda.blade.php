<!DOCTYPE html>
<html lang="zxx" class="js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base" content="<?=env('APP_URL');?>">
    <!-- Page Title  -->
    <title>Agenda | Teste 3Wings</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="./assets/css/dashlite.css?ver=3.0.2">
    <link id="skin-default" rel="stylesheet" href="./assets/css/theme.css?ver=3.0.2">
    <!--Toastr CSS -->
    <link type="text/css" href="{{ asset('/assets/css/toastr.min.css') }}" rel="stylesheet">
    <!--SeetAlert2-->
    <link type="text/css" href="{{ asset('/assets/css/sweetalert2.min.css') }}" rel="stylesheet">
</head>

<body class="nk-body bg-white has-sidebar dark-mode">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-header-news d-none d-xl-block">
                                <div class="nk-news-list">
                                    <a class="nk-news-item" href="https://github.com/slaython/Teste3Wings" target="_blank">
                                        <div class="nk-news-icon">
                                            <em class="icon ni ni-card-view"></em>
                                        </div>
                                        <div class="nk-news-text">
                                            <p>Quer ver o código desse projeto? <span> Acesse pelo github.......</span></p>
                                            <em class="icon ni ni-external"></em>
                                        </div>
                                    </a>
                                </div>
                            </div><!-- .nk-header-news -->
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                                <div class="user-info d-none d-md-block">
                                                    <div class="user-status">Administrator</div>
                                                    <div class="user-name dropdown-indicator"><?= Session::get('3WINGS.AUTENTICACAO')->NOME; ?></div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <span>3W</span>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text"><?= Session::get('3WINGS.AUTENTICACAO')->NOME; ?></span>
                                                        <span class="sub-text"><?= Session::get('3WINGS.AUTENTICACAO')->EMAIL; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a class="js_logout"><em class="icon ni ni-signout"></em><span>Sair</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li><!-- .dropdown -->
                                </ul><!-- .nk-quick-nav -->
                            </div><!-- .nk-header-tools -->
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>
                <!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                            <div class="components-preview wide-md mx-auto">
                                <div class="nk-block-head nk-block-head-lg wide-sm">
                                    <div class="nk-block-head-content">                                        
                                        <h2 class="nk-block-title fw-normal">Agendamentos 3Wings</h2>
                                        <div class="nk-block-des">
                                            <p class="lead">Faça a sua agenda. Adicione seus compromissos, Cadastre seus contatos e tarefas importantes de acordo com seu perfil.</p>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head -->
                                <div class="nk-block nk-block-lg">
                                    <div class="nk-block-head nk-block-head-sm">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h3 class="nk-block-title page-title">Sua Agenda ( Agendamentos em aberto )</h3>
                                                <div class="nk-block-des text-soft">
                                                    <p>Visualize os ultimos agendamentos cadastrados.</p>
                                                </div>
                                            </div><!-- .nk-block-head-content -->
                                            <div class="nk-block-head-content">
                                                    <div class="toggle-wrap nk-block-tools-toggle">
                                                        <div class="toggle-expand-content" data-content="pageMenu">
                                                            <div class="">
                                                                <button href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm">Novo Compromisso</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- .nk-block-head-content -->
                                        </div><!-- .nk-block-between -->
                                    </div><!-- .nk-block-head -->
                                    <div class="card card-bordered card-preview">
                                        <div class="card-inner">
                                            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                                <thead>
                                                    <tr class="nk-tb-item nk-tb-head">
                                                        <th class="nk-tb-col"><span class="sub-text">Agendamento</span></th>
                                                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Com quem</span></th>
                                                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Assunto</span></th>
                                                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Contato</span></th>
                                                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Relevância</span></th>
                                                        <th class="nk-tb-col nk-tb-col-tools text-end">
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="js_add_compromisso">
                                                    <?php foreach($COMPROMISSOS as $COMPROMISSO): ?>
                                                    <?php if($COMPROMISSO->STATUS == 1): ?>
                                                    <tr class="nk-tb-item compromisso_<?= $COMPROMISSO->ID; ?>">
                                                        <td class="nk-tb-col">
                                                            <div class="user-card">
                                                                <div class="user-info">
                                                                    <span class="tb-lead"><?= $COMPROMISSO->DATAHORAINICIO; ?> <span class="dot <?= $COMPROMISSO->DOTRELEVANCIA; ?> d-md-none ms-1"></span></span>
                                                                    <span>Até <?= $COMPROMISSO->DATAHORAFIM; ?></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="nk-tb-col tb-col-mb" data-order="35040.34">
                                                            <span class="currency"><?= $COMPROMISSO->COMQUEM; ?></span>
                                                        </td>
                                                        <td class="nk-tb-col tb-col-lg">
                                                            <span><?= $COMPROMISSO->ASSUNTO; ?></span>
                                                        </td>
                                                        <td class="nk-tb-col tb-col-lg">
                                                            <span><?= $COMPROMISSO->CONTATO; ?></span>
                                                        </td>
                                                        <td class="nk-tb-col tb-col-md">
                                                            <span class="tb-status text-warning"><?= $COMPROMISSO->HTMLRELEVANCIA; ?></span>
                                                        </td>
                                                        <td class="nk-tb-col nk-tb-col-tools">
                                                            <ul class="nk-tb-actions gx-1">
                                                                <li>
                                                                    <div class="drodown">
                                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                        <div class="dropdown-menu dropdown-menu-end">
                                                                            <ul class="link-list-opt no-bdr">
                                                                                <li><a href="#" class="js_visualizar_compromisso" data-id="<?= $COMPROMISSO->ID; ?>" data-bs-toggle="modal" data-bs-target="#modalVisualizar"><em class="icon ni ni-eye"></em><span>Visualizar</span></a></li>
                                                                                <li><a href="#" class="js_compromisso_feito" data-id="<?= $COMPROMISSO->ID; ?>"><em class="icon ni ni-check"></em><span>Feito</span></a></li>
                                                                                <li><a href="#" class="js_cancelar_compromisso" data-id="<?= $COMPROMISSO->ID; ?>"><em class="icon ni ni-cross"></em><span>Cancelar</span></a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!-- .card-preview -->
                                </div> <!-- nk-block -->

                                <div class="nk-block nk-block-lg">
                                    <div class="nk-block-head nk-block-head-sm">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h3 class="nk-block-title page-title text-success">Agendamentos finalizados com sucesso</h3>
                                                <div class="nk-block-des text-soft">
                                                    <p>Visualize os agendamentos que você ja concluiu.</p>
                                                </div>
                                            </div><!-- .nk-block-head-content -->
                                        </div><!-- .nk-block-between -->
                                    </div><!-- .nk-block-head -->
                                    <div class="card card-bordered card-preview">
                                        <div class="card-inner">
                                            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                                <thead>
                                                    <tr class="nk-tb-item nk-tb-head">
                                                        <th class="nk-tb-col"><span class="sub-text">Agendamento</span></th>
                                                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Com quem</span></th>
                                                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Assunto</span></th>
                                                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Contato</span></th>
                                                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Relevância</span></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="js_add_compromisso_concluido">
                                                    <?php foreach($COMPROMISSOS as $COMPROMISSO): ?>
                                                    <?php if($COMPROMISSO->STATUS == 2): ?>
                                                    <tr class="nk-tb-item compromisso_concluido_<?= $COMPROMISSO->ID; ?>">
                                                        <td class="nk-tb-col">
                                                            <div class="user-card">
                                                                <div class="user-info">
                                                                    <span class="tb-lead text-success"><?= $COMPROMISSO->DATAHORAINICIO; ?> <span class="dot <?= $COMPROMISSO->DOTRELEVANCIA; ?> d-md-none ms-1"></span></span>
                                                                    <span>Até <?= $COMPROMISSO->DATAHORAFIM; ?></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="nk-tb-col tb-col-mb" data-order="35040.34">
                                                            <span class="currency text-success"><?= $COMPROMISSO->COMQUEM; ?></span>
                                                        </td>
                                                        <td class="nk-tb-col tb-col-lg">
                                                            <span class="currency text-success"><?= $COMPROMISSO->ASSUNTO; ?></span>
                                                        </td>
                                                        <td class="nk-tb-col tb-col-lg">
                                                            <span class="currency text-success"><?= $COMPROMISSO->CONTATO; ?></span>
                                                        </td>
                                                        <td class="nk-tb-col tb-col-md">
                                                            <span class="tb-status text-warning"><?= $COMPROMISSO->HTMLRELEVANCIA; ?></span>
                                                        </td>
                                                    </tr>
                                                    <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!-- .card-preview -->
                                </div> <!-- nk-block -->
                            </div><!-- .components-preview -->
                        </div>
                    </div>
                </div>
                <!-- content @e -->
                <!-- footer @s -->
                <div class="nk-footer">
                    <div class="container wide-lg">
                        <div class="row g-3">
                            <div class="nk-block-content text-center text-lg-left">
                                <p class="text-soft">&copy; <?= date('Y'); ?> Slaython Gleyson. Teste da empresa 3Wings.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- Modal Form -->
    <div class="modal fade" id="modalForm">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Novo compromisso</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="d-flex mb-2">
                        <h5 class="card-title text-secondary">Dados do compromisso</h5>
                    </div>
                    <form action="/cadastro-compromisso" class="form-validate is-alter" method="post" name="FormCadastroCompromisso" autocomplete="off">
                        <div class="row gy-2 ">
                            <div class="col-md-6 mt-0">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input name="DATAHORAINICIO" type="text" class="js-mask-data-hora form-control mt-3 form-control-outlined" for="outlined-dt-nascimento-mpc">
                                        <label class="form-label-outlined" for="outlined-dt-nascimento-mpc">Data-Hora de início</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-0">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input name="DATAHORAFIM" type="text" class="js-mask-data-hora form-control form-control-outlined mt-3 form-control-outlined" id="outlined-telefone-mpc">
                                        <label class="form-label-outlined" for="outlined-telefone-mpc">Data-Hora de fim</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-0">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input name="COMQUEM" type="text" class="form-control mt-3 form-control-outlined" id="outlined-nome-mpc">
                                        <label class="form-label-outlined" for="outlined-nome-mpc">Com quem</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-0">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input name="ASSUNTO" type="text" class="form-control mt-3 form-control-outlined" id="outlined-nome-mpc">
                                        <label class="form-label-outlined" for="outlined-nome-mpc">Assunto</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-0">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input name="CONTATO" type="text" class="form-control mt-3 form-control-outlined" id="outlined-nome-mpc">
                                        <label class="form-label-outlined" for="outlined-nome-mpc">Contato</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="form-control-wrap mt-1 mb-0">
                                    <select class="form-select js-select2" name="RELEVANCIA" id="outlined-select">
                                        <option value="">Escolha a importância</option>
                                        <option value="1">Leve</option>
                                        <option value="2">Méida</option>
                                        <option value="3">Importante</option>
                                        <option value="4">Urgente</option>
                                    </select>
                                    <label class="form-label-outlined" for="outlined-select">Relevância</label>
                                </div>
                            </div>
                            <div class="col-md-12 mt-0 mb-2">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <textarea name="DESCRICAO" class="form-control no-resize mt-3 form-control-outlined" id="default-observacoes-mcc"></textarea>
                                        <label class="form-label-outlined" for="outlined-observacoes-mcc">Descrição do compromisso</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group d-flex justify-content-end mt-1">
                                <button class="btn btn-primary" type="submit">Cadastrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalVisualizar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Visualizar compromisso</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="w-100 d-flex justify-content-center" id="js_loading_modal_preview_compromisso">
                    <div class="spinner-border m-5" role="status">
                        <span class="visually"></span>
                    </div>
                </div>
                <div class="modal-body js_dados_compromisso_add" id="js_modal_preview_compromisso">
                    <!-- <div class='js_dados_compromisso_rmv' id='js_dados_compromisso_rmv'>
                        <div class='nk-block-head'>
                            <div class='nk-block-head-content'>
                                <h5 class='nk-block-title title'>Informações do Compromisso</h5>
                                <p>Informações de cadastro relacionadas ao compromisso em destaque.</p>
                            </div>
                        </div>
                        <div class='card card-bordered'>
                            <ul class='data-list is-compact'>
                                <li class='data-item pt-1 pb-1'>
                                    <div class='data-col'>
                                        <div class='data-label'>Data de :</div>
                                        <div class='data-value'>Teste</div>
                                    </div>
                                </li>
                                <li class='data-item pt-1 pb-1'>
                                    <div class='data-col'>
                                        <div class='data-label'>Data até :</div>
                                        <div class='data-value'>Teste</div>
                                    </div>
                                </li>
                                <li class='data-item pt-1 pb-1'>
                                    <div class='data-col'>
                                        <div class='data-label'>Com quem :</div>
                                        <div class='data-value'>Teste</div>
                                    </div>
                                </li>
                                <li class='data-item pt-1 pb-1'>
                                    <div class='data-col'>
                                        <div class='data-label'>Assunto :</div>
                                        <div class='data-value'>Teste</div>
                                    </div>
                                </li>
                                <li class='data-item pt-1 pb-1'>
                                    <div class='data-col'>
                                        <div class='data-label'>Relevância :</div>
                                        <div class='data-value'>Teste</div>
                                    </div>
                                </li>
                                <li class='data-item pt-1 pb-1'>
                                    <div class='data-col'>
                                        <div class='data-label'>Descrição :</div>
                                        <div class='data-value'>Teste</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript -->
    <script src="./assets/js/bundle.js?ver=3.0.2"></script>
    <script src="./assets/js/scripts.js?ver=3.0.2"></script>
    <script src="./assets/js/libs/datatable-btns.js?ver=3.0.2"></script>
    <!-- Jquery -->
    <script src="{{ asset('/assets/js/jquery.form.js') }}?nocache=<?=time();?>"></script>
    <script src="{{ asset('/assets/js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('/widgets/3wings.js') }}?nocache=<?=time();?>"></script>
    <!-- DOM Factory -->
    <script src="{{ asset('/assets/js/dom-factory.js') }}"></script>
    <!-- Toastr.js -->
    <script src="{{ asset('/assets/js/toastr.min.js') }}"></script>
    <!--SweetAler2-->
    <script src="{{ asset('/assets/js/sweetalert2.all.min.js') }}?nocache=<?=time();?>"></script>
</body>

</html>

