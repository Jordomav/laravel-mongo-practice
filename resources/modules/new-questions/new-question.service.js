
(function () {

    'use strict';

    angular.module('adaApp')
        .service('NewQuestion', function ($http) {

            var vm = this;

            vm.test = 'something';

            vm.newQuestionDataType = '';

            // Hard-code empty answer so that at least one input element displays in ng-repeat.
            vm.multipleChoiceAnswers = [{text: '', compliant: false}];

            // Display a default answer input type in New Question form.
            vm.answerType = 'true_false';

            vm.setAnswerType = function (event) {
                vm.answerType = event.target.value;
            };


            vm.addMultipleChoiceInput = function () {
                vm.multipleChoiceAnswers.push({text: '', compliant: false});
            };

            return vm;

    });

}());
