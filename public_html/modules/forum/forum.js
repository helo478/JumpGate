angular.module('jumpgate.forum', ['ngRoute', 'jumpgate.forum.thread'])

.config(['$routeProvider'], function($routeProvider) {
    $routeProvider
        .when('/forum/:forumId', {
            templateUrl: 'modules/forum/forum.html',
            controller: 'ForumCtrl',
            resolve: {
                immediate: ['Constant', function(Constant) {
                    return Constant.MAGIC_NUMBER * 4;
                }],
                async: ['http', function($http) {
                    return $http.get('trivialAJAX.php');
                }]
            }
        });
})

.controller('ForumCtrl', ['$routeParams', '$scope', '$http', 
    function($routeParams, $scope, $http) {

    var forumCtrl = this;
    
    // TODO error handle bad routeParam.forumId
    var forumId = $routeParams.forumId;
}])