//var HOST = 'http://plannera.mateusmarques.net';
var HOST = 'http://localhost:8000';

// servico que controla as requisicoes HTTP
Mod.factory('Request', ['RequestHttp', function(RequestHttp){
    return{
        get_request:function(tipo, value, metodo){
            // verifica qual o tipo de requisicao, e monta a URL adequada
            switch (tipo){
                case 'addProduto':      var url = HOST + '/prod/add'; break;
                case 'validaCodigo':    var url = HOST + '/prod/validaCodigo/'+value.cod; break;
                case 'estatistica':     var url = HOST + '/prod/estatistica/'+value.num; break;
                default : return false;
            }
            
            // faz a requisicao e gera o retorno
            return RequestHttp.get_request(url, value, metodo);
        }
    };
}])

// servico que executa e retorna uma requisicao POST ou GET
.factory('RequestHttp', ['$http', function($http){
    return{
        get_request: function(url, value, metodo){
            switch (metodo){
                case 'GET' : return $http.get(url);
                case 'POST': return $http.post(url, value);
            }
        }
    };
}]);