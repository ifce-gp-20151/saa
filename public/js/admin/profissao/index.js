
$(function() {
    $('.deletar').click(function () {
        var self = this;
        alertify.confirm("Deseja realmente deletar esta Profissão?", function () {
            window.location = $(self).attr('href');
        }).set('reverseButtons', true).set('defaultFocus', 'cancel');
        return false;
    });
});
