$(function() {

    $("#idGrauParentesco").select2({
        placeholder: "Selecione o Grau de Parentesco",
        allowClear: true
    });

    $("#idProfissao").select2({
        placeholder: "Selecione a Profissão",
        allowClear: true
    });



    // $("#idProfissao").select2({
    //     'placeholder': "Digite o nome da profissão.",
    //     'minimumInputLength': 2,
    //     'ajax': {
    //         url: "/application/familiar/ajax-buscar-profissao",
    //         dataType: "json",
    //         data: function(term, page) {
    //             return {
    //                 term: term
    //             };
    //         },
    //         'results': function(json, page) {
    //             return {
    //                 'results': json.rows
    //             };
    //         }
    //     },
    //     initSelection: function(element, callback) {
    //         // the input tag has a value attribute preloaded that points to a preselected repository's id
    //         // this function resolves that id attribute to an object that select2 can render
    //         // using its formatResult renderer - that way the repository name is shown preselected
    //         var id = $(element).val();
    //         if (id !== "") {
    //             $.ajax("/application/familiar/ajax-buscar-profissao", {
    //                 dataType: "json",
    //                 data: {id: id}
    //             }).done(function(data) {
    //                 callback(data);
    //             });
    //         }
    //     },
    //
    // });
    // $("#idGrauParentesco").select2({
    //     'placeholder': "Digite o nome do grau de parentesco.",
    //     'minimumInputLength': 2,
    //     'ajax': {
    //         url: "/application/familiar/ajax-buscar-grau-parentesco",
    //         dataType: "json",
    //         data: function(term, page) {
    //             return {
    //                 term: term
    //             };
    //         },
    //         'results': function(json, page) {
    //             return {
    //                 'results': json.rows
    //             };
    //         }
    //
    //     }
    //
    // });


});
