
(function () {

    'use strict';

    angular.module('adaApp')
        .service('NewQuestion', function ($http) {

        var vm = this;

        vm.newQuestionText = '';
        vm.newQuestionDataType = '';

        vm.newQuestion = function () {
            return {
                text: vm.newQuestionText,

                // TODO: We should probably have a default data_type, i.e. 'true-false'.
                data_type: vm.newQuestionDataType,

                // Hard-coding all new questions as default questions for now.
                default_question: true,
                help_url: ''
            };
        };

        // Display a default answer input type in New Question form.
        vm.answerType = 'true_false';

        vm.setAnswerType = function (event) {
            vm.answerType = event.target.value;
        };

    });

}());
