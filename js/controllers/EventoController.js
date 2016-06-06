(function(){

    angular.module('app.controllers').controller('EventoController', ['$scope', 'api', '$location', '$uibModal',
        function($scope, api, $location, $uibModal){

        api.eventos.list().success(function(data){
            $scope.eventos = data;
        });        

        $scope.insert = function(evento){
            $location.path('/eventos/insert');
        };

        $scope.update = function(evento){
            $location.path('/eventos/update/' + evento.id);
        };

        $scope.delete = function(evento){
            var modalInstance = $uibModal.open({
                templateUrl: 'pages/partials/modal.html',
                controller: 'ModalController',
                resolve: {
                    mensagem: function () {
                        return "Deseja excluir o evento?";
                    }
                }
            });

            modalInstance.result.then(function () {
                api.eventos.delete(evento.id).success(function(){
                    $scope.eventos.splice($scope.eventos.indexOf(evento), 1);
                }).error(function(){

                });
            });
        };
    }]);

    angular.module('app.controllers').controller('EventoFormController', 
        ['$scope', 'api', '$location', '$routeParams',
            function($scope, api, $location, $routeParams){

            $scope.idEvento = $routeParams.idEvento;

            $scope.hoje = new Date();

            api.tipos.list().success(function(data){
                $scope.tipos = data;
            });

            if ( $scope.idEvento != null && $scope.idEvento > 0 ){
                $scope.title = "Editar Evento";
                api.eventos.get($scope.idEvento).success(function(data){
                    data.lotacao_maxima = data.lotacao_maxima * 1;

                    temp_data = data.data_realizacao;
                    dt = temp_data.split("-");
                    dt[1] = dt[1] - 1;
                    data.data_realizacao = new Date(dt[0],dt[1],dt[2]);

                    $scope.evento = data;
                });
                $scope.save = function(){
                    api.eventos.update($scope.evento).success(function(){
                        $location.path('/eventos');
                    }).error(function(data, headers, status){
                        $location.path('/eventos');
                        console.log(headers + status);
                });
            };
        }else{
            $scope.title = "Inserir Evento";
            $scope.run = new Evento();

            $scope.save = function(){
                api.eventos.insert($scope.evento).success(function(){
                    $location.path('/eventos');
                }).error(function(data, headers, status){
                    $location.path('/eventos');
                    console.log(headers + status);
                });
            };
        }

        $scope.open = function($event) {
            $event.preventDefault();
            $event.stopPropagation();
            $scope.opened = true;
        };

        $scope.cancel = function(){
            $location.path('/eventos');
        };
    }]);

}).call(this);




