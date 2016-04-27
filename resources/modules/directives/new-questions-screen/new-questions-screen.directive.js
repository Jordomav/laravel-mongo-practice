/**
 * Created by Neil Strain on 4/27/2016.
 */

(function () {

    'use strict';

    angular.module('adaApp')
        .directive('newQuestionsScreen', function () {
            return {
                restrict: 'E',
                scope: '=',
                templateUrl: '/build/templates/new-questions-screen/new-questions-screen.html'
            };
        });
}());
