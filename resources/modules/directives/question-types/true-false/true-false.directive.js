/**
 * Created by Neil Strain on 4/6/2016.
 */

(function () {

    'use strict';

    angular.module('templates')
        .directive('trueFalseQuestion', function () {
            return {
                restrict: 'E',
                scope: '=',
                templateUrl: '/build/templates/question-types/true-false/true-false.html'
            };
        });
}());
