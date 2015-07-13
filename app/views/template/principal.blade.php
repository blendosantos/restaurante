<!DOCTYPE html>
<html>
    <head>
        <title>@yield('pagina') | {{Config::get('config.titulo');}}</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        {{ HTML::style('css/bootstrap.min.css') }}        
        {{ HTML::style('jquery/jquery-ui.min.css') }}
        {{ HTML::style('jquery/jquery-ui.structure.min.css') }}
        {{ HTML::style('css/menu-lateral.css') }}
        {{ HTML::style('css/style.css') }}


        {{ HTML::script('jquery/jquery-2.1.4.min.js') }}
        {{ HTML::script('jquery/jquery-ui.min.js') }}
        {{ HTML::script('jquery/datepicker-pt-br.js') }}
        {{ HTML::script('jquery/jquery.maskedinput.js') }}
        {{ HTML::script('jquery/jquery-maskmoney.js') }}
        {{ HTML::script('js/bootstrap.min.js') }}        
        {{ HTML::script('js/bootbox.js') }}
        {{ HTML::script('js/functions.js') }}

    </head>
    <body>

        <!--    Cabecalho   -->
        <header class="container">
            <div class="row">
                <div class="col-xs-6">
                    <h3 class="title_page" id="titlePage">{{Config::get('config.titulo');}}</h3>
                </div>
                <div class="col-xs-6 cont_login">
                    <a href="/login" class="{{ Request::is('login') ? 'active' : '' }}">Login</a> 
                    <a href="/create-login" class="{{ Request::is('create-login') ? 'active' : '' }}">Cadastre-se</a>
                </div>
            </div>
        </header>

        <!--    Formulario de Reserva     -->
        @yield('reserva')
        <div class="row">

            @yield('menu-lateral')
            <!-- Conteudo  -->
            @yield('conteudo')

        </div>
        <!-- Rodape  -->
        <footer class="container constant-footer">
            <div class="row txtFooter">
                <div class="col-xs-6">
                    fasfa
                </div>
                <div class="col-xs-3">
                    sdfasf
                </div>
                <div class="col-xs-3">
                    asdfasd
                </div>
            </div>
        </footer>

    </body>
</html>