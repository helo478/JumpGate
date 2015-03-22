angular.module('jumpgate.forum.thread.post', [])

.directive('threadPost', function() {
    return {
        restrict: 'E',
        templateUrl: 'modules/forum/thread/post/post.html',
        controller: 'PostCtrl'
    };
})

.controller('PostCtrl', ['$scope', function($scope) {
    
    var postCtrl = this;
    
    
}])