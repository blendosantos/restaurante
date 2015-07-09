<!DOCTYPE html>
<html>
    <head>
        <title>Login | {{Config::get('config.titulo');}}</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='http://fonts.googleapis.com/css?family=Chewy' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="css/login.css" />
        <script src="js/jquery.js"></script>

    </head>
    <body>

        <div class="container">
            <div class="col-xs-3"></div>

            <div class="col-xs-6">
                <h1 class="title_page espaco-top">
                    {{Config::get('config.titulo');}}                    
                </h1>
                <div class="col-xs-12">
                    <div class="janela-login">
                        <form class="form-signin" method="POST">
                            @if (Request::is('login'))
                            <input type="text" name="usuario" id="inputLogin" class="form-control" placeholder="Usuário" required="" autofocus="">
                            <input type="password" name="senha" id="inputPassword" class="form-control" placeholder="Password" required="">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="lembrar"> Lembrar-me                                    
                                </label>                                
                            </div>
                            <input class="btn btn-lg btn-login btn-block" type="submit" value="Entrar" name="entrar"/>

                            <a href="/resertPassword" class="btn-lg btn-block txtSenha">Esqueci minha senha</a>
                            @elseif (Request::is('resertPassword'))
                            <input type="email" id="inputEmail" class="form-control" placeholder="Email" required="" autofocus="" name="email">
                            <input class="btn btn-lg btn-login btn-block" type="submit" value="Enviar" name="enviar"/>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xs-3"></div>
        </div>

    </body>
</html>
