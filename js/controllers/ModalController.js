(function(){

    angular.module('app.controllers').controller('ModalController', function ($scope, $uibModalInstance, mensagem) {
        $scope.mensagem = mensagem;

        $scope.ok = function () {
            $uibModalInstance.close(true);
        };

        $scope.cancel = function () {
            $uibModalInstance.dismiss(false);
        };
    });

}).call(this);