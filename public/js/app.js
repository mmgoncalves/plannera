var Mod = angular.module('App', ['ngRoute'])
.config(['$routeProvider',  function($routeProvider) {

   $routeProvider
    .when('/', {
      templateUrl : 'templates/produto.html',
      controller : 'ProdutoController'
   })

   .when('/estatisticas', {
       templateUrl : 'templates/estatisticas.html',
       controller : 'EstatisticaController'
   })

   // caso não seja nenhum desses, redirecione para a rota '/'
   .otherwise ({ redirectTo: '/' });
}]);

Mod.constant("CSRF_TOKEN", CONSTTK);
Mod.run(['$http', 'CSRF_TOKEN', function($http, CSRF_TOKEN) {
    $http.defaults.headers.common['X-Csrf-Token'] = CSRF_TOKEN;
}]);