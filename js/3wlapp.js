'use strict';
angular.module('3wlapp', ['ngAnimate', 'ngTouch'])
    .controller('MainCtrl', function ($scope, $http) {
        $http({method: 'GET', url: '/api?showall=true'})
            .then(function (result, error) {
                $scope.photos = result.data;
            });
        $scope.popupContent = 'PopUp Content';
// initial image index
        $scope._Index = 0;
// if a current image is the same as requested image
        $scope.isActive = function (index) {
            return $scope._Index === index;
        };
// show prev image
        $scope.showPrev = function () {
            $scope._Index = ($scope._Index > 0) ? --$scope._Index : $scope.photos.length - 1;
        };
// show next image
        $scope.showNext = function () {
            $scope._Index = ($scope._Index < $scope.photos.length - 1) ? ++$scope._Index : 0;
        };
// show a certain image
        $scope.showPhoto = function (index) {
            $scope._Index = index;
        };
    })
    .directive('menuItem', function () {
        return {
            restrict: 'AE',
            replace: true,
            scope: {
                caption: '@',
                mode: '@',
                popupContent: '='
            },
            transclude: true,
            link: function (scope) {
                scope.show = function () {
                    console.log('Pop ' + scope.mode);
                    document.getElementById('menuForm').innerHTML = document.getElementById(scope.mode).innerHTML;

                }
            },
            templateUrl: 'templates/menu-item.html'
        }
    })
    .directive('slider', function ($timeout) {
        return {
            restrict: 'AE',
            replace: true,
            scope: {
                images: '=',
            },
            link: function (scope, elem, attrs) {
                scope.currentIndex = 0; // Initially the index is at the first image
                scope.next = function () {
                    scope.currentIndex < scope.images.length - 1 ? scope.currentIndex++ : scope.currentIndex = 0;
                };

                scope.prev = function () {
                    scope.currentIndex > 0 ? scope.currentIndex-- : scope.currentIndex = scope.images.length - 1;
                };
                scope.$watch('currentIndex', function () {
                    scope.images.forEach(function (image) {
                        image.visible = false; // make every image invisible
                    });

                    scope.images[scope.currentIndex].visible = true; // make the current image visible
                });

            },
            templateUrl: 'templates/smart-image.html'
        };
    });
