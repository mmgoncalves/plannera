/*
 *  Controller da View Produto
 */
function ProdutoController(Request){
    var Ctrl = this;

    // Funcao para criar novo produto
    Ctrl.addProduto = function(){
        Ctrl.retornoForm = '';

        // Monta o JSON da requisoca
        var values = {codigo:Ctrl.codigo, nome: Ctrl.nome, quantidade:Ctrl.quantidade};

        // Chama o servico que faz a requisicao HTTP
        Request.get_request("addProduto", values, "POST")
            .success(function(data, status){
                // Se o produto for cadastrado com sucesso, chama a funcao que limpa o form e exibi a msg de sucesso
                if(status == 201){
                    Ctrl.limpaForm();
                    Ctrl.retornoForm = 'Produto cadastrado com sucesso';
                }else{
                    // exibi a msg de erro
                    Ctrl.retornoForm = data.errorMsg;
                }
            });
    };

    // Funcao que valida o codigo do produto
    Ctrl.validaCodigo = function () {
        if(Ctrl.codigo != ""){
            // Recupera o Codigo digitado
            var values = {cod:Ctrl.codigo};

            // Chama o servico que faz a requisicao HTTP
            Request.get_request("validaCodigo", values, "GET")
                .success(function(data, status){
                    if(status == 200){
                        Ctrl.codigoInvalido = true;
                        Ctrl.errorMsg = 'Código já cadastrado no sistema.';
                    }else{
                        Ctrl.codigoInvalido = false;
                        Ctrl.errorMsg = '';
                    }
                });
        }
    };

    // Funcao que limpra o form apos a criacao de um novo produto
    Ctrl.limpaForm = function () {
        Ctrl.codigo = '';
        Ctrl.nome = '';
        Ctrl.quantidade = '';
    };
}


/*
 *  Controller da View Estatisticas
 */
function EstatisticaController(Request){
    var Ctrl = this;

    // Funcao que gera as estatisticas
    Ctrl.mostraEstatistica = function () {
        if(Ctrl.num != ""){
            // Recuperao o valor digitado
            var values = {num:Ctrl.num};

            // Chama o servico que faz a requisicao
            Request.get_request("estatistica", values, "GET")
                .success(function(data, status){
                    if(status == 201){
                        // monta a lista com os produtos e suas informacoes em caso de sucesso na requisicao
                        Ctrl.lista = data.prod;
                        Ctrl.total = data.total;
                    }else{
                        Ctrl.lista = '';
                    }
                });
        }
    };
}