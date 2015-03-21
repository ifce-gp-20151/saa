
$(function() {
    $('.deletar').click(function () {
        var self = this;
        alertify.confirm("Deseja realmente deletar este Cargo?", function () {
            window.location = $(self).attr('href');
        }).set('reverseButtons', true).set('defaultFocus', 'cancel');
        return false;
    });
});
