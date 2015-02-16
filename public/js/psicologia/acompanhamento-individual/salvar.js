
$(function () {
    var btnSalvar = $('#btn-salvar');

    var configs = {
        theme: 'snow',
        modules: {
            'link-tooltip': true,
            'toolbar': {
                container: '#toolbar',
            }
        }
    };
    var quill = new Quill('#editor', configs);
    quill.focus();

    function _prevent(e) {
        if (e.preventDefault) {
            e.preventDefault();
        } else {
            // internet explorer
            e.returnValue = false;
        }
    }

    var documento = {
        salvar: function() {
            btnSalvarCarregando();
            var data = {
                descricao: quill.getHTML(),
                id: $('#id').val()
            };

            $.ajax({
                url: '/psicologia/acompanhamento-individual/ajax-salvar',
                type: 'POST',
                data: data,
                success: function (json) {
                    if (json.ok) {
                        alertify.success('Todas as alterações foram salvas.');
                    } else if (json.error) {
                        alertify.error(json.error);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alertify.error(textStatus + ':' + errorThrown);
                },
                complete: function () {
                    btnSalvarPadrao();
                }
            });
        }
    };

    btnSalvar.click(function() {
        documento.salvar();
        return false;
    });

    Mousetrap.bindGlobal('ctrl+s', function(e) {
        _prevent(e);
        documento.salvar();
    });

    function btnSalvarCarregando () {
        btnSalvar.html('<i class="fa fa-spinner fa-spin"></i> Aguarde...').attr('disabled', 'disabled');
    }

    function btnSalvarPadrao () {
        btnSalvar.html('<i class="fa fa-save"></i> Salvar').removeAttr('disabled');
    }
});
