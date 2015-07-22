<div class="col-xs-3">
    <div class="row profile">
        <div class="col-md-12">
            <div class="profile-sidebar">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    {{ HTML::image('upload/miller.png', '', array('class' => 'img-responsive')) }}
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        Blendo Miller
                    </div>
                    <div class="profile-usertitle-job">
                        Developer
                    </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li class="{{ Request::is('reserva') ? 'active' : '' }} {{ Request::is('reserva/cadastro') ? 'active' : '' }} {{ Request::is('reserva/lancamento') ? 'active' : '' }}">
                            <a href="/reserva">
                                <i class="glyphicon glyphicon-calendar"></i>
                                Reservas
                            </a>
                        </li>
                        <li class="{{ Request::is('caixa') ? 'active' : '' }} {{ Request::is('caixa/lancar') ? 'active' : '' }} {{ Request::is('caixa/reserva') ? 'active' : '' }}">
                            <a href="/caixa">
                                <i class="glyphicon glyphicon-usd"></i>
                                Caixa
                            </a>
                        </li>
                        <li class="{{ Request::is('servico') ? 'active' : '' }} {{ Request::is('servico/cadastro') ? 'active' : '' }}">
                            <a href="/servico">
                                <i class="glyphicon glyphicon-list-alt"></i>
                                Serviços
                            </a>
                        </li>
                        <li class="{{ Request::is('produto') ? 'active' : '' }} {{ Request::is('produto/cadastro') ? 'active' : '' }}">
                            <a href="/produto">
                                <i class="glyphicon glyphicon-barcode"></i>
                                Produtos
                            </a>
                        </li>
                        <li class="{{ Request::is('mesa') ? 'active' : '' }} {{ Request::is('mesa/cadastro') ? 'active' : '' }}">
                            <a href="/mesa">
                                <i class="glyphicon glyphicon-cutlery"></i>
                                Mesas 
                            </a>
                        </li>
                        <li class="{{ Request::is('usuario') ? 'active' : '' }} {{ Request::is('usuario/cadastro') ? 'active' : '' }}">
                            <a href="/usuario">
                                <i class="glyphicon glyphicon-user"></i>
                                Usuários 
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- END MENU -->
            </div>
        </div>
    </div>
</div>