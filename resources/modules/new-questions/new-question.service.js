
(function () {

    'use strict';

    angular.module('adaApp')
        .service('NewQuestion', function ($http) {

            var vm = this;

            vm.newQuestionDataType = '';
            vm.multipleChoiceInputs = [];

            // Display a default answer input type in New Question form.
            vm.answerType = 'true_false';

            vm.setAnswerType = function (event) {
                vm.answerType = event.target.value;
            };


            vm.addMultipleChoiceInput = function () {
                vm.multipleChoiceInputs.push({
                    text: '',
                    data_type: ''
                });
            };

    });

}());
