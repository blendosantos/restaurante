@extends('template.principal')

@section('pagina')
Reserva
@stop

@section('menu-lateral')
@include('template.menu-lateral')
@stop

@section('conteudo')
<div class="col-xs-9">
    <div class="container" id="conteudo">
        <h1 class="title_top">Cadastro Reserva</h1>
        <span class="dadosObrigatorio">* Dados obrigatórios</span>

        <div class="row_form">
            <div class="col-xs-12">
                <form class="row" method="POST" name="formReserva">
                    <div class="col-xs-12">&nbsp;</div>
                    <div class="col-xs-9 bg_ln">
                        <h4>Reserva</h4>
                    </div>                
                    <div class="col-xs-12"></div>

                    <div class="col-xs-6 form-group">
                        <label class="control-label">Solicitante: *</label>
                        {{Form::select('idSolicitante', array('' => '::SELECIONE::') + AuthController::getUserActive(), isset($reserva->idSolicitante) ? $reserva->idSolicitante : Input::old('idSolicitante'), array('class' => 'form-control','required' => 'required'))}}
                    </div>

                    <div class="col-xs-3 form-group">
                        <label class="control-label">Mesa: *</label>
                        <select class="form-control" name="idMesa">
                            @foreach (MesaController::getMesaActive() as $mesa)
                            <option value="" selected="selected">::SELECIONE::</option>
                            <option value="{{$mesa->id}}">{{$mesa->nuMesa." para ".$mesa->qtdPessoas." Pessoas"}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xs-12"></div>               

                    <div class="col-xs-3 form-group">
                        <label class="control-label">Data Reserva: *</label>
                        <input type="text" name="dtReserva" class="form-control data" required value="{{isset($reserva->dtReserva) ? $reserva->dtReserva : Input::old('dtReserva')}}"/>
                    </div>

                    <div class="col-xs-6 form-group">
                        <label class="control-label">Observação: *</label>
                        <input type="text" name="obsReserva" class="form-control" required value="{{isset($reserva->obsReserva) ? $reserva->obsReserva : Input::old('obsReserva')}}" />
                    </div>

                    <div class="col-xs-12">&nbsp;</div>
                    <div class="col-xs-6"></div>

                    <div class="col-xs-3 form-group">
                        <input class="btn btn-cadastro btn-block" type="submit" onclick="return verificaDestaque()" value="Cadastrar" name="cadastrar"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop