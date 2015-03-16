
$(function () {
    $('.date')
        .mask('99/99/9999')
        .datetimepicker({
            locale: 'pt-br',
            format: 'DD/MM/YYYY'
        });

    $('.time')
        .mask('99:99')
        .datetimepicker({
            locale: 'pt-br',
            format: 'HH:mm'
    });
});
