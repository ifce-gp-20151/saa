
$( function() {
	$('.date')
		.mask('99/99/9999')
		.datetimepicker({
			locale: 'pt-br',
			format: 'DD/MM/YYYY'
		});
	
	$('#cpf').mask('999.999.999-99');
	
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
	});
});
