
$(function() {

    var dadosAluno = $('#dados-aluno');
    var btnConsultar = $('#btn-consultar');
    var matricula = $('#matricula');
    
    if (matricula.val() !== '') {
        carregar();
    }
    
    btnConsultar.click(function() {
        if (matricula.val() === '') {
            matricula.focus();
            return false;
        }
        carregar();
        return false;
    });
    
    function carregar() {
        btnConsultarCarregando();
        $.ajax({
            url: '/psicologia/acompanhamento/ajax-buscar-aluno',
            type: 'POST',
            data: {
                matricula: matricula.val()
            },
            success: function (json) {
                if (json.ok) {
                    show(json.aluno);
                } else if (json.error) {
                    dadosAluno.html("");
                    alertify.error(json.error);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                dadosAluno.html("");
                alertify.error(textStatus + ':' + errorThrown);
            },
            complete: function () {
                btnConsultarPadrao();
            }
        });
    }

    function show(aluno) {
        var template = sprintf(
            "<p><strong>Nome: </strong> %(nome)s</p>" +
            "<p><strong>Situação Escolar: </strong> %(situacaoEscolar)s</p>" +
            "<p><strong>Curso/Período: </strong> %(curso)s/%(periodo)s</p>"
            , aluno
        );
        dadosAluno.html(template).show();
    }
    
    function btnConsultarCarregando () {
        btnConsultar.html('<i class="fa fa-spinner fa-spin"></i> Aguarde...').attr('disabled', 'disabled');
    }
    
    function btnConsultarPadrao () {
        btnConsultar.html('<i class="fa fa-search"></i> Consultar').removeAttr('disabled');
    }
});
