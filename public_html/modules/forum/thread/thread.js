angular.module('jumpgate.forum.thread', [])

.directive('forumThread', function() {
    return {
        restrict: 'E',
        templateUrl: 'modules/forum/thread/thread.html',
        controller: 'ThreadCtrl'
    };
})

.controller('ThreadCtrl', ['$scope', function($scope) {
    
    var threadCtrl = this;
}])