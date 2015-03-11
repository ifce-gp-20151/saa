
$(function () {
    $('#cpf').mask('999.999.999-99');
    $('.date')
        .mask('99/99/9999')
        .datetimepicker({
            locale: 'pt-br',
            format: 'DD/MM/YYYY'
        });
});
