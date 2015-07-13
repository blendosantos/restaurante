@extends('template.principal')

@section('pagina')
Home
@stop

@section('reserva')
@include('template.reserva')
@stop

@section('conteudo')

<div class="container">
    <h2 class="title_novidades">Experimente também: </h2>

    @foreach ($servicos as $servico)
    <div class="col-xs-6">
        <div class="media">
            <div class="media-left">
                <a href="#">
                    {{ HTML::image($servico->img, '', array('class' => 'media-object img-media', 'data-holder-rendered' => 'true')) }}
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">{{$servico->servico}}</h4>
                <p>{{$servico->dsServico}}</p>
            </div>
        </div>
        <div class="border-bottom"></div>
    </div>
    @endforeach

</div>

<div class="container">
    <div class="row espaco-imgs">
        <div class="col-xs-3">{{ HTML::image('imgs/passo_01.png')}}</div>
        <div class="col-xs-3">{{ HTML::image('imgs/passo_01.png')}}</div>
        <div class="col-xs-3">{{ HTML::image('imgs/passo_01.png')}}</div>
        <div class="col-xs-3">{{ HTML::image('imgs/passo_01.png')}}</div>
    </div>

    <div class="col-xs-12">
        <p style="margin-top: 10px; text-align: justify;">
            {{Config::get('config.texto-restaurante');}}
        </p>
    </div>

</div>

@stop