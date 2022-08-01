<!DOCTYPE html>
<html lang="zxx" class="js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base" content="<?=env('APP_URL');?>">
    <!-- Page Title  -->
    <title>Login | Teste 3Wings</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="./assets/css/dashlite.css?ver=3.0.2">
    <link id="skin-default" rel="stylesheet" href="./assets/css/theme.css?ver=3.0.2">
    <!--Toastr CSS -->
    <link type="text/css" href="{{ asset('/assets/css/toastr.min.css') }}" rel="stylesheet">

    <!--SeetAlert2-->
    <link type="text/css" href="{{ asset('/assets/css/sweetalert2.min.css') }}" rel="stylesheet">
</head>

<body class="nk-body bg-white npc-general pg-auth dark-mode">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Autenticação</h4>
                                        <div class="nk-block-des">
                                            <p>Acesse o painel agenda usando seu e-mail e senha.</p>
                                        </div>
                                    </div>
                                </div>
                                <form action="/autenticacao" method="post" name="FormAutenticacao">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Email ou nome de usuário</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" name="USUARIO" value="agendamentos@3wings.com" class="form-control form-control-lg" id="default-01" placeholder="Digite seu endereço de e-mail ou nome de usuário">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">Senha</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" name="SENHA" value="123456" class="form-control form-control-lg" id="password" placeholder="Digite sua senha">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary btn-block">Entrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="nk-footer nk-auth-footer-full">
                        <div class="container wide-lg">
                            <div class="row g-3">
                                <div class="nk-block-content text-center text-lg-left">
                                    <p class="text-soft">&copy; <?= date('Y'); ?> Slaython Gleyson. Teste da empresa 3Wings.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="./assets/js/bundle.js?ver=3.0.2"></script>
    <script src="./assets/js/scripts.js?ver=3.0.2"></script>
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

</html>