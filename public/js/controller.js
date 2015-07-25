/*
 *  Controller da View Produto
 */
function ProdutoController($scope, Request){
    // Funcao para criar novo produto
    $scope.addProduto = function(){
        $scope.retornoForm = '';

        // Monta o JSON da requisoca
        var values = {codigo:$scope.codigo, nome: $scope.nome, quantidade:$scope.quantidade};

        // Chama o servico que faz a requisicao HTTP
        Request.get_request("addProduto", values, "POST")
            .success(function(data, status){
                // Se o produto for cadastrado com sucesso, chama a funcao que limpa o form e exibi a msg de sucesso
                if(status == 201){
                    $scope.limpaForm();
                    $scope.retornoForm = 'Produto cadastrado com sucesso';
                }else{
                    // exibi a msg de erro
                    $scope.retornoForm = data.errorMsg;
                }
            });
    };

    // Funcao que valida o codigo do produto
    $scope.validaCodigo = function () {
        if($scope.codigo != ""){
            // Recupera o Codigo digitado
            var values = {cod:$scope.codigo};

            // Chama o servico que faz a requisicao HTTP
            Request.get_request("validaCodigo", values, "GET")
                .success(function(data, status){
                    if(status == 200){
                        $scope.codigoInvalido = true;
                        $scope.errorMsg = 'Código já cadastrado no sistema.';
                    }else{
                        $scope.codigoInvalido = false;
                        $scope.errorMsg = '';
                    }
                });
        }
    };

    // Funcao que limpra o form apos a criacao de um novo produto
    $scope.limpaForm = function () {
        $scope.codigo = '';
        $scope.nome = '';
        $scope.quantidade = '';
    };
}


/*
 *  Controller da View Estatisticas
 */
function EstatisticaController($scope, Request){
    // Funcao que gera as estatisticas
    $scope.mostraEstatistica = function () {
        if($scope.num != ""){
            // Recuperao o valor digitado
            var values = {num:$scope.num};

            // Chama o servico que faz a requisicao
            Request.get_request("estatistica", values, "GET")
                .success(function(data, status){
                    if(status == 201){
                        // monta a lista com os produtos e suas informacoes em caso de sucesso na requisicao
                        $scope.produtos = data.prod;
                        $scope.total = data.total;
                    }else{
                        $scope.produtos = '';
                    }
                });
        }
    };
}