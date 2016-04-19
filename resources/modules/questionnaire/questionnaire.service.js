
(function () {

    'use strict';

    angular.module('adaApp')
        .service('Questions', function ($http, $timeout) {

            var vm = this;

            vm.questions = [];


            /**
             *  Init Methods
             */

            // Init function gets called from Questionnaire Controller on page load.
            vm.init = function () {
                return getQuestions()
                    .then( function successCallback(res) {

                        vm.questions = res.data;

                        },
                        function errorCallback(err) {
                            alert('There was a problem retrieving questions from the database.');
                            console.log(err);
                        });
            };

            function getQuestions() {
                return $http.get('get-questions');
            }


            /**
             *  Questionnaire Methods
             */

            // Returns a boolean representing whether the questionnaire is compliant, accounting for every question.
            // Questionnaire is compliant as a whole only if every question is compliant.
            vm.overallCompliance = function () {
                return _.every(vm.questions, ['compliant', true]);
            };


            /**
             *  Individual Question / Answer Methods
             */

            // Upon answering a question, set the question compliance, save answer to the database, and display
            // 'saving' message.
            var savingMessageTimeout = null;
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

                // Our initial thought was to display the 'saving' message only if POST request is successful, but the
                // problem with this is the delay between inputting an answer and seeing the 'saving' message seems too
                // long. For now we are leaving this outside of the `post.then()` block.
                if (savingMessageTimeout !== null) {
                    $timeout.cancel(savingMessageTimeout);
                }

                displaySavingMessage(question);

                function displaySavingMessage(question) {

                    // 'saving' message displays inside of question element when `question.active === true`.
                    question.active = true;

                    // Hide 'saving' message after delay.
                    savingMessageTimeout = $timeout(function () {
                        question.active = false;
                        savingMessageTimeout = null;

                        // Ensure that 'saving' message gets cleared out from previous question if new question is
                        // answered prior to its $timeout completing. With more questions, we will probably only want to
                        // iterate over only the questions currently being displayed on the page.
                        _.forEach(vm.questions, function (question) {
                            question.active = false;
                        });

                    }, 1820);
                }
            };


            vm.setCompliance = function (question) {

                if (question.data_type === 'range') {

                    var compliantRange = question.answers[0].compliant_range,
                        lowBound = compliantRange[0],
                        highBound = compliantRange[1];

                    question.compliant = lowBound <= question.user_input && question.user_input <= highBound;

                } else {
                    var selectedAnswer = question.answers[question.selected_answer_id];

                    if (selectedAnswer) {
                        question.compliant = selectedAnswer.compliant;
                    }
                }
            };


            // We use `vm.wasAnswered()` to display the compliance of a question only once it has been answered.
            vm.wasAnswered = function (question) {

                if (question.data_type === 'range') {
                    if (question.user_input && !question.selected_answer_id) {
                        return !!question.user_input;
                    }

                } else {
                    if (question.selected_answer_id && !question.user_input) {
                        return !!question.selected_answer_id;
                    }
                }
            };

        });
}());
