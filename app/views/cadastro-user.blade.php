@extends('template.principal')

@section('pagina')
Usuário
@stop

@if (!Request::is('create-login'))
@section('menu-lateral')
@include('template.menu-lateral')
@stop
@endif

@section('conteudo')

@if (Session::has('message'))
<script type="text/javascript">
    bootbox.alert("{{Session::get('message')}}");
</script>
@endif

<div class="{{Request::is('create-login') ? 'col-xs-12' : 'col-xs-9'}}">
    <div class="container">
        @if (Request::is('create-login'))
        <h1 class="title_top">Cadastre-se</h1>
        @else
        <h1 class="title_top">Cadastro de Usuário</h1>
        @endif
        <span class="dadosObrigatorio">* Dados obrigatórios</span>

        <form class="row" method="POST" name="formCadastroUser" accept-charset="UTF-8" enctype="multipart/form-data">

            <div class="col-xs-12">&nbsp;</div>
            <div class="col-xs-9 bg_ln">
                <h4>Dados de Acesso</h4>
            </div>                
            <div class="col-xs-12"></div>

            <div class="col-xs-3 form-group">
                <label class="control-label">Usuário: *</label>
                <input type="text" class="form-control" name="login" required  value="{{isset($login->login) ? $login->login : Input::old('login')}}"/>
            </div>

            @if (Request::is('create-login'))
            <div class="col-xs-3 form-group">
                <label class="control-label">Senha: *</label>
                <input type="password" name="senha" class="form-control" required/>
            </div>
            @endif

            @if (!Request::is('create-login'))
            <div class="col-xs-3 form-group">
                <label class="control-label">Cargo: *</label>
                {{Form::select('cargo', array('' => ':: SELECIONE ::') + Config::get('perfil.perfil'), isset($login->perfil) ? $login->perfil : Input::old('cargo'), ['class' => 'form-control cargo', 'id' => 'cargo', 'required' => 'required'])}}
            </div>
            @endif

            <div class="col-xs-3 form-group">
                <label class="control-label">Foto: *</label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <span class="btn btn-file">
                            Arquivo… <input type="file" name="img" accept="image/*" />
                        </span>
                    </span>
                    <input type="text" class="form-control" readonly="" value="{{isset($usuario->img) ? $usuario->img : Input::old('img')}}">
                </div>
            </div>

            <div class="col-xs-6 form-group">
                <label class="control-label">Email: *</label>
                <input type="email" required class="form-control" name="email" value="{{isset($login->email) ? $login->email : Input::old('email')}}">
            </div>
            
            <div class="col-xs-3 form-group">
                <label class="control-label">Telefone: *</label>
                <input type="text" required class="form-control telefone" name="telefone" value="{{isset($usuario->telefone) ? $usuario->telefone : Input::old('telefone')}}">
            </div>

            <div class="col-xs-12">&nbsp;</div>
            <div class="col-xs-9 bg_ln">
                <h4>Dados Pessoais</h4>
            </div>                
            <div class="col-xs-12"></div>

            <div class="col-xs-6 form-group">
                <label class="control-label">Nome: *</label>
                <input type="text" class="form-control" name="nmPessoa" required value="{{isset($usuario->nmPessoa) ? $usuario->nmPessoa : Input::old('nmPessoa')}}" />
            </div>

            <div class="col-xs-3 form-group">
                <label class="control-label">Data Nascimento: *</label>
                <input type="text" name="dtNascimento" class="form-control" id="dtNascimento" required value="{{isset($usuario->dtNascimento) ? $usuario->dtNascimento : Input::old('dtNascimento')}}" />
            </div>

            <div class="col-xs-12"></div>

            <div class="col-xs-3 form-group">
                <label class="control-label">CPF: *</label>
                <input type="text" name="cpf" class="form-control" id="cpf" required  value="{{isset($usuario->cpf) ? $usuario->cpf : Input::old('cpf')}}" />
            </div>

            <div class="col-xs-3 form-group">
                <label class="control-label">Sexo: *</label>
                <div class="checkbox">
                    <label>
                        <input type="radio" name="sexo" value="F" required <?php
                        if (isset($usuario->sexo) && $usuario->sexo == 'F') {
                            echo "checked";
                        }
                        ?> /> Feminino &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="sexo" value="M" required <?php
                        if (isset($usuario->sexo) && $usuario->sexo == 'M') {
                            echo "checked";
                        }
                        ?> /> Masculino
                    </label>
                </div>
            </div>

            <div class="col-xs-3 form-group">
                <label class="control-label">CEP: *</label>
                <input type="text" name="cep" class="form-control" id="cep" required value="{{isset($usuario->cep) ? $usuario->cep : Input::old('cep')}}"/>
            </div>

            <div class="col-xs-12"></div>

            <div class="col-xs-3 form-group">
                <label class="control-label">Cidade:</label>
                <input type="text" id="cidade" class="form-control" disabled  value="{{isset($usuario->cidade) ? $usuario->cidade : Input::old('cidade')}}"/>
                <input type="hidden" name="cidade" id="cidade" value="{{isset($usuario->cidade) ? $usuario->cidade : Input::old('cidade')}}"/>
            </div>

            <div class="col-xs-3 form-group">
                <label class="control-label">Estado:</label>
                <input type="text" id="estado" class="form-control" disabled value="{{isset($usuario->estado) ? $usuario->estado : Input::old('estado')}}"/>
                <input type="hidden" name="estado" id="estado" value="{{isset($usuario->estado) ? $usuario->estado : Input::old('estado')}}"/>
            </div>

            <div class="col-xs-3 form-group">
                <label class="control-label">Bairro:</label>
                <input type="text" id="bairro" class="form-control" disabled value="{{isset($usuario->bairro) ? $usuario->bairro : Input::old('bairro')}}"/>
                <input type="hidden" name="bairro" id="bairro" value="{{isset($usuario->bairro) ? $usuario->bairro : Input::old('bairro')}}"/>
            </div>

            <div class="col-xs-6 form-group">
                <label class="control-label">Endereço:</label>
                <input type="text" class="form-control" id="endereco" disabled value="{{isset($usuario->endereco) ? $usuario->endereco : Input::old('endereco')}}"/>
                <input type="hidden" name="endereco" id="endereco" value="{{isset($usuario->endereco) ? $usuario->endereco : Input::old('endereco')}}"/>
            </div>

            <div class="col-xs-3 form-group">
                <label class="control-label">Número:</label>
                <input type="text" name="numero" class="form-control" required value="{{isset($usuario->numero) ? $usuario->cep : Input::old('numero')}}"/>
            </div>

            <div class="col-xs-6 form-group">
                <label class="control-label">Complemento:</label>
                <input type="text" class="form-control" name="complemento" value="{{isset($usuario->complemento) ? $usuario->complemento : Input::old('complemento')}}"/>
            </div>

            <div class="col-xs-3 form-group" id="vlSalario">
                <label class="control-label">Salário:</label>
                <input type="text" class="form-control valor" name="vlSalario" value="{{isset($usuario->vlSalario) ? $usuario->vlSalario : Input::old('vlSalario')}}" data-affixes-stay="true" data-prefix="R$ " data-thousands="." data-decimal=","/>
            </div>               

            <div class="col-xs-12">&nbsp;</div>
            <div class="col-xs-6"></div>

            <div class="col-xs-3 form-group">
                <input class="btn btn-cadastro btn-block" type="submit" value="Cadastrar" name="cadastrar"/>
            </div>

        </form>
    </div>
</div>
</div>

@stop