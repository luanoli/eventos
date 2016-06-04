(function(){

    angular.module('app.services').service('api', ['$http', function($http){

        return {
            eventos: {
                list: function(){
                    return $http.get('rest/eventos');
                },
                update: function(evento){
                    return $http.put('rest/eventos/' + evento.id, evento);
                },
                insert: function(evento){
                    return $http.post('rest/eventos', evento);
                },
                get: function(id){
                    return $http.get('rest/eventos/' + id);
                },
                delete:  function(id){
                    return $http.delete('rest/eventos/' + id);
                }
            },
        };
    }]);

}).call(this);
