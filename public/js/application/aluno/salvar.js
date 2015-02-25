
$( function() {
  $( "#id_curso" ).select2( {
    'placeholder': "Digite o nome do curso.",
    'minimumInputLength': 2,
    'ajax' : {
      url : "/application/aluno/ajax-buscar-curso",
      dataType : "json",
      data: function ( term, page ) {
        return {
          term: term
        };
      },
      'results' : function ( json, page ) {
        return { 'results' : json.rows };
      }
      
    }

  } );
} );
