$(document).ready(function() {

    $('.datatable').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ resultados por pagina",
            "zeroRecords": "Nenhum resultado - sorry",
            "info": "Pagina _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum resultado",
            "search":         "Pesquisa:",
            "paginate": {
		        "first":      "Primeiro",
		        "last":       "Ultimo",
		        "next":       "Proximo",
		        "previous":   "Anterior"
		    },
            "infoFiltered": "(filtered from _MAX_ total records)"
        },
        "aoColumnDefs": [
          { "sType": "integer", "aTargets": [ 0 ] }
        ]
    });

    var x = 0;
    $(".add_itens").click(function (e) {
        var $input = $('<div class="form-group col-md-4 form-items-add">' +
            '<input class="form-control" placeholder="Nome do Item" name="items[' + x + '][title]" type="text">' +
            '<input class="form-control" placeholder="Quantidade" name="items[' + x + '][amount]" type="text">' +
            '<input class="form-control" placeholder="Descrição" name="items[' + x + '][content]" type="text">' +
        '</div>');
        $('.itens').append($input);
        x++;
    });

} );