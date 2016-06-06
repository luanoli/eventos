(function(){

    angular.module('app.controllers', []);
    angular.module('app.services', []);
    angular.module('app.filters', []);

    angular.module('app', ['app.controllers', 'app.services', 'app.filters', 'ui.bootstrap', 'ngRoute'])
        .config(['$routeProvider',function($routeProvider) {

        $routeProvider

        .when('/eventos',{
            templateUrl: 'pages/eventos/list.html',
            controller: 'EventoController'
        }).when('/eventos/insert',{
            templateUrl: 'pages/eventos/form.html',
            controller: 'EventoFormController'
        }).when('/eventos/update/:idEvento',{
            templateUrl: 'pages/eventos/form.html',
            controller: 'EventoFormController'
        })

        .when('/eventosclientes',{
            templateUrl: 'pages/eventosclientes/list.html',
            controller: 'EventoClienteController'
        }).when('/eventosclientes/:idEvento',{
            templateUrl: 'pages/eventosclientes/detail.html',
            controller: 'EventoClienteDetalhesController'
        })

        .otherwise({redirectTo: '/eventos'});


    }]);

}).call(this);