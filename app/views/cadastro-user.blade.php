@extends('template.principal')

@section('pagina')
Cadastro
@stop

@section('conteudo')

<div class="container">
    <h1 class="title_top">Cadastre-se</h1>
    <span class="dadosObrigatorio">* Dados obrigatórios</span>

    <div class="row_form">
        <div class="col-xs-12">
            <form class="row" method="POST" name="formCadastroUser">

                <div class="col-xs-12">&nbsp;</div>
                <div class="col-xs-9 bg_ln">
                    <h4>Dados Pessoais</h4>
                </div>                
                <div class="col-xs-12"></div>

                <div class="col-xs-6 form-group">
                    <label class="control-label">Nome: *</label>
                    <input type="text" class="form-control" name="nome" required/>
                </div>

                <div class="col-xs-3 form-group">
                    <label class="control-label">Data Nascimento: *</label>
                    <input type="text" name="dtNascimento" class="form-control" id="dtNascimento" required/>
                </div>

                <div class="col-xs-12"></div>

                <div class="col-xs-3 form-group">
                    <label class="control-label">CPF: *</label>
                    <input type="text" name="cpf" class="form-control" id="cpf" required/>
                </div>

                <div class="col-xs-3 form-group">
                    <label class="control-label">Sexo: *</label>
                    <div class="checkbox">
                        <label>
                            <input type="radio" name="sexo" value="F" required/> Feminino &nbsp;&nbsp;&nbsp;
                            <input type="radio" name="sexo" value="M" required/> Masculino
                        </label>
                    </div>
                </div>

                <div class="col-xs-3 form-group">
                    <label class="control-label">CEP: *</label>
                    <input type="text" name="cep" class="form-control" id="cep" required/>
                </div>

                <div class="col-xs-12"></div>

                <div class="col-xs-3 form-group">
                    <label class="control-label">Cidade:</label>
                    <input type="text" name="cidade" id="cidade" class="form-control" disabled/>
                </div>

                <div class="col-xs-3 form-group">
                    <label class="control-label">Estado:</label>
                    <input type="text" name="estado" id="estado" class="form-control" disabled/>
                </div>

                <div class="col-xs-3 form-group">
                    <label class="control-label">Bairro:</label>
                    <input type="text" name="bairro" id="bairro" class="form-control" disabled/>
                </div>

                <div class="col-xs-6 form-group">
                    <label class="control-label">Endereço:</label>
                    <input type="text" class="form-control" name="endereco" id="endereco" disabled/>
                </div>

                <div class="col-xs-3 form-group">
                    <label class="control-label">Número:</label>
                    <input type="text" name="numero" class="form-control" required/>
                </div>

                <div class="col-xs-9 form-group">
                    <label class="control-label">Complemento:</label>
                    <input type="text" class="form-control" name="complemento"/>
                </div>

                <div class="col-xs-12">&nbsp;</div>
                <div class="col-xs-9 bg_ln">
                    <h4>Dados de Acesso</h4>
                </div>                
                <div class="col-xs-12"></div>

                <div class="col-xs-3 form-group">
                    <label class="control-label">Usuário: *</label>
                    <input type="text" class="form-control" name="usuario" required/>
                </div>

                <div class="col-xs-3 form-group">
                    <label class="control-label">Senha: *</label>
                    <input type="password" name="senha" class="form-control" required/>
                </div>

                <div class="col-xs-3 form-group">
                    <label class="control-label">Foto: *</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <span class="btn btn-file">
                                Arquivo… <input type="file" name="foto" multiple="">
                            </span>
                        </span>
                        <input type="text" class="form-control" readonly="">
                    </div>
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