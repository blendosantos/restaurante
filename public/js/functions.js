jQuery(function ($) {
    $("#titlePage").click(function () {
        window.location.href = "/";
    });

    $("#dtNascimento").datepicker({
        changeYear: true
    });
    $("#dtNascimento").mask("99/99/9999");
    $("#cpf").mask("999.999.999-99");
    $("#cep").mask("99999-999");
    $(".telefone").mask("(99) 9999-9999");
    $('.valor').maskMoney();

    $('.numero').keypress(verificaNumero);

    $('#conteudo').height(($(window).height()) - 110 - 200);
    $(window).on('resize', function () {
        $('#conteudo').height(($(window).height()) - 110 - 200);
    });
    
    $("#cep").change(function () {
        var cep_code = $(this).val();
        if (cep_code.length <= 0)
            return;
        $.get("http://apps.widenet.com.br/busca-cep/api/cep.json", {code: cep_code},
        function (result) {
            if (result.status != 1) {
                alert(result.message || "Houve um erro desconhecido");
                return;
            }
            $("input#cep").val(result.code);
            $("input#estado").val(result.state);
            $("input#cidade").val(result.city);
            $("input#bairro").val(result.district);
            $("input#endereco").val(result.address);
            $("input#estado").val(result.state);
        });
    });

    $("#dtNascimento").change(function () {
        var dataIdade = $(this).val();
        var dataAtual = dataAtualFormatada();
        var idade = dataAtual.substring(6, 10) - dataIdade.substring(6, 10);
        if (idade < 18) {
            bootbox.alert("<h4>Por questão de segurança não podemos efetuar cadastro para menores de 18 anos!</h4>");
            $("#dtNascimento").val("");
        }
    });

    $('#conteudo').height(($(window).height()) - 100 - 125);
    $(window).on('resize', function () {
        $('#conteudo').height(($(window).height()) - 100 - 125);
    });

    $("#cargo").change(function () {
        if ($(this).val() === 'CLI') {
            $("#vlSalario").hide();
        } else {
            $("#vlSalario").show();
        }
    })
});

function dataAtualFormatada() {
    var data = new Date();
    var dia = data.getDate();
    if (dia.toString().length == 1)
        dia = "0" + dia;
    var mes = data.getMonth() + 1;
    if (mes.toString().length == 1)
        mes = "0" + mes;
    var ano = data.getFullYear();
    return dia + "/" + mes + "/" + ano;
}

function verificaNumero(e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        return false;
    }
}

function verificaDestaque() {
    var destaque = $('input[name="destaque"]:checked').val();
    var file = $('#img').val();
    if (destaque === 'S') {
        if (file === "") {
            bootbox.alert("É necessario adicionar uma imagem para que o serviço possa ser adicionado em destaque!");
            return false;
        }
    }
}

$(document).on('change', '.btn-file :file', function () {
    var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
});

$(document).ready(function () {
    $('.btn-file :file').on('fileselect', function (event, numFiles, label) {

        var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;

        if (input.length) {
            input.val(log);
        } else {
            if (log)
                alert(log);
        }

    });
});

function validarCamposFiltro() {
    var descricao = formularioPesquisa.descricao.value;
    var quantidade = formularioPesquisa.quantidade.value;
    var valor = formularioPesquisa.valor.value;

    if (descricao === '' && quantidade === '' && valor === '') {
        alert('Preencha no mínimo um campo!');
        formularioPesquisa.descricao.focus();
        return false;
    }
}

function formatReal(mixed) {
    var int = parseInt(mixed.toFixed(2).toString().replace(/[^\d]+/g, ''));
    var tmp = int + '';
    tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
    if (tmp.length > 6)
        tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

    return tmp;
}

function excluirItem(id) {
    bootbox.confirm({
        title: 'Exclusão',
        message: 'Deseeja realmente excluir?',
        buttons: {
            confirm: {
                label: 'Sim, excluir!',
                className: 'btn-danger'
            },
            cancel: {
                label: 'Não!',
                className: 'btn-negar-modal'
            }
        },
        callback: function (response) {
            if (response) {
                location.href = '/' + entity + '/delete?id=' + id;
            }
        }
    });
}

/******************** Paginacao *******************/

function ajustarBotoes() {
    $('#proximo').prop('disabled', dados.length <= tamanhoPagina || pagina >= Math.ceil(dados.length / tamanhoPagina) - 1);
    $('#anterior').prop('disabled', dados.length <= tamanhoPagina || pagina == 0);
}

$(function () {
    $('#proximo').click(function () {
        if (pagina < dados.length / tamanhoPagina - 1) {
            pagina++;
            paginar();
            ajustarBotoes();
        }
    });
    $('#anterior').click(function () {
        if (pagina > 0) {
            pagina--;
            paginar();
            ajustarBotoes();
        }
    });
    paginar();
    ajustarBotoes();
});

/*************************************************************/