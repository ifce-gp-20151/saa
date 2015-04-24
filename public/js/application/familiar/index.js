
$(function() {
    moment.locale('pt-BR');
    $("span.moment").each(function(idx, item) {
        var $item = $(item);
        var date = $item.html();
        $item.html(moment(date, 'YYYY-MM-DD HH:mm:ss').fromNow());
    });
});
