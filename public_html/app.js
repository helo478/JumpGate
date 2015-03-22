angular.module('jumpgate', ['ngRoute', 'jumpgate.forum'])

.config(['$routeProvider', function($routeProvider) {
    $routeProvider.when('/', {
        templateUrl: 'landing.html'
    })
}])