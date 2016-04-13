/**
 * Created by Neil Strain on 4/6/2016.
 */

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
                        });
            }

            vm.saveAnswer = function (question) {
                $http.post('post-answer', {
                        id: question._id,
                        selected_answer: question.selected_answer
                    })
                    .then(function successCallback(res) {
                    }, function errorCallback(err) {
                        alert('There was a problem saving your answer.');
                        console.log(err);
                    });
            };

            vm.answerIsCompliant = function (question) {
                var compliantAnswer = _.some(question.answers, function (answer) {
                    answer.compliant === true;
                });

                console.log(compliantAnswer);

                
            };

        });
}());
