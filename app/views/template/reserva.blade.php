<div class="container"> 
    <div class="row">
        <div class="col-xs-12">
            <h1 class="title_top">Agende agora sua reserva.</h1>
        </div>

        <div class="col-xs-12 form_busca">

            <form class="row" method="POST" name="formReserva">
                <div class="col-xs-1"></div>

                <div class="col-xs-3 form-group">
                    <label class="control-label title_form">Tipos de comida</label>
                    <select class="form-control" name="comida">
                        <option label="Todos" />
                    </select>
                    <span class="sub_title_form">Culinária diária.</span>
                </div>

                <div class="col-xs-3 form-group">
                    <label class="title_form">First Request</label>
                    <select class="form-control" name="prato">
                        <option label="Todos" />
                    </select>
                    <span class="sub_title_form">Escolha do pedido inicial.</span>
                </div>

                <div class="col-xs-2 form-group">
                    <label class="title_form">Mesa para</label>
                    <select class="form-control" name="qtdPessoa">
                        <option value="1" label="1" />
                    </select>
                    <span class="sub_title_form" style="width: 150px; display: block;">Quantidade de pessoa.</span>
                </div>

                <div class="col-xs-1">
                    <label class="control-label">&nbsp;</label>
                    <input type="submit" class="btn btn_agendar" name="agendar" value="">
                </div>                        
            </form>

        </div>
    </div>
</div>