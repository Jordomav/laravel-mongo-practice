/**
 * Created by Neil Strain on 4/6/2016.
 */

(function () {

    'use strict';

    angular.module('templates')
        .directive('multipleChoiceInput', function () {
            return {
                restrict: 'E',
                scope: '=',
                templateUrl: '/build/templates/question-types/multiple-choice/multiple-choice.html'
            };
        });


}());
