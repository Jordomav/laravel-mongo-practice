
(function () {

    'use strict';

    angular.module('adaApp')
        .service('Questions', function ($http) {

            var vm = this;

            vm.questions = [];


            vm.getQuestions = function () {
                return $http.get('get-questions');
            };


            init();


            function init() {
                vm.getQuestions()
                    .then( function successCallback(res) {

                        vm.questions = res.data;

                        },
                        function errorCallback(err) {
                            alert('There was a problem retrieving questions from the database.');
                            console.log(err);
                        });
            }


            vm.overallCompliance = function () {
                return _.every(vm.questions, ['compliant', true]);
            };


            vm.saveAnswer = function (question) {

                vm.setCompliance(question);

                $http.post('post-answer', {
                        id: question._id,

                        // selected_answer_id is used for true-false and multiple-choice question input types.
                        selected_answer_id: question.selected_answer_id || null,

                        // user_input is used for the range input question type.
                        user_input: question.user_input,

                        // Describes whether or not the selected or input answer is in compliance.
                        compliant: question.compliant
                    })
                    .then(function successCallback(res) {

                    }, function errorCallback(err) {
                        alert('There was a problem saving your answer.');
                        console.log(err);
                    });
            };


            vm.setCompliance = function (question) {

                if (question.data_type === 'range') {

                    var compliantRange = question.answers[0].compliant_range;

                    question.compliant = compliantRange[0] <= question.user_input &&
                                            question.user_input <= compliantRange[1];

                } else {
                    var selectedAnswer = question.answers[question.selected_answer_id];

                    if (selectedAnswer) {
                        question.compliant = selectedAnswer.compliant;
                    }
                }
            };


            vm.wasAnswered = function (question) {
                if (question.user_input && !question.selected_answer_id) {
                    return question.user_input !== null;

                } else if (question.selected_answer_id && !question.user_input) {
                    return question.selected_answer_id !== null;
                }
            };

        });
}());
