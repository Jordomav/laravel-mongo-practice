/**
 * Created by Neil Strain on 4/27/2016.
 */

(function () {

    'use strict';

    angular.module('adaApp')
        .directive('complianceReport', function () {
            return {
                restrict: 'E',
                scope: '=',
                templateUrl: '/build/templates/compliance-report-modal/compliance-report.html'
            };
        });

}());
