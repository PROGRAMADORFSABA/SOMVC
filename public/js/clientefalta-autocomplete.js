var licitacaoCliente_cod = null;

var optionsCliente = {
    url: function(cliente) {
        return "http://localhost/SOMVC/clienteLicitacao/autoComplete/" + cliente;
    },

    getValue: function(element) {
        return element.nomefantasia;
    },

    list: {
        onChooseEvent: function() {
            licitacaoCliente_cod = $("#autocomplete-clientefalta").getSelectedItemData().licitacaoCliente_cod;
            $('#cliente').val(licitacaoCliente_cod);
        },

        onHideListEvent: function(){
            if(licitacaoCliente_cod == null){
                $("#autocomplete-clientefalta").val('');
            }
        }

    }
};

$("#autocomplete-clientefalta").easyAutocomplete(optionsCliente);