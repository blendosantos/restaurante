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

    <div class="col-xs-6">
        <div class="media">
            <div class="media-left">
                <a href="#">
                    {{ HTML::image('imgs/carne-de-sol.jpg', 'Carne do Sol', array('class' => 'media-object img-media', 'data-holder-rendered' => 'true')) }}
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">Carne do Sol, 4 Toscanas</h4>
                <p>3 Acompanhamentos para até 4 pessoas</p>
            </div>
        </div>
        <div class="border-bottom"></div>
    </div>

    <div class="col-xs-6">
        <div class="media">
            <div class="media-left">
                <a href="#">
                    {{ HTML::image('imgs/carne-de-sol.jpg', 'Carne do Sol', array('class' => 'media-object img-media', 'data-holder-rendered' => 'true')) }}
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">Carne do Sol, 4 Toscanas</h4>
                <p>3 Acompanhamentos para até 4 pessoas</p>
            </div>
        </div>
        <div class="border-bottom"></div>
    </div>

    <div class="col-xs-6">
        <div class="media">
            <div class="media-left">
                <a href="#">
                    {{ HTML::image('imgs/carne-de-sol.jpg', 'Carne do Sol', array('class' => 'media-object img-media', 'data-holder-rendered' => 'true')) }}
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">Carne do Sol, 4 Toscanas</h4>
                <p>3 Acompanhamentos para até 4 pessoas</p>
            </div>
        </div>
        <div class="border-bottom"></div>
    </div>

    <div class="col-xs-6">
        <div class="media">
            <div class="media-left">
                <a href="#">
                    {{ HTML::image('imgs/carne-de-sol.jpg', 'Carne do Sol', array('class' => 'media-object img-media', 'data-holder-rendered' => 'true')) }}
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">Carne do Sol, 4 Toscanas</h4>
                <p>3 Acompanhamentos para até 4 pessoas</p>
            </div>
        </div>
        <div class="border-bottom"></div>
    </div>

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