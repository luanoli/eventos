(function(){

    angular.module('app.controllers').controller('EventoClienteController',
        ['$scope', 'api', '$location', function($scope, api, $location){

        api.eventosClientes.list().success(function(data){
            $scope.eventosClientes = data;
        });

        $scope.detalhar = function(evento){
            $location.path('/eventosclientes/' + evento.id);
        };

        $scope.insert = function(eventocliente){
            $location.path('/eventosclientes/insert');
        };

    }]);

    angular.module('app.controllers').controller('EventoClienteDetalhesController',
        ['$scope', 'api', '$location', '$routeParams', '$uibModal',
            function($scope, api, $location, $routeParams, $uibModal){

        $scope.id_evento = $routeParams.idEvento;

        api.eventosClientes.get($scope.id_evento).success(function(data){
            $scope.detalhes = data;
        });

        $scope.participar = function(evento){
            var modalInstance = $uibModal.open({
                templateUrl: 'pages/eventosclientes/modal.html',
                controller: 'EventoClienteModalController',
                backdrop: 'static',
                resolve: {
                    evento: function () {
                        return evento;
                    }
                }
            });

            modalInstance.result.then(function () {

            });
        };

    }]);

    angular.module('app.controllers').controller('EventoClienteModalController',
        ['$scope', 'api', '$location', '$uibModalInstance', 'evento',
            function ($scope, api, $location, $uibModalInstance, evento) {

        $scope.ok = true;

        $scope.obj = new Object();
        $scope.obj.id_evento = evento.id;

        $scope.confirmar = function () {
            api.eventosClientes.insert($scope.obj).success(function(data){
                $scope.ok = false;
                $scope.codigo = data;
            });
        };

        $scope.fechar = function(){
            $uibModalInstance.dismiss(false);
            $location.path('/eventosclientes');
        };

        $scope.cancel = function () {
            $uibModalInstance.dismiss(false);
        };

    }]);

}).call(this);





