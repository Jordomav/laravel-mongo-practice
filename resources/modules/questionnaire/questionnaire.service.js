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
                            console.log(res);

                            vm.questions = res.data;
                        },
                        function errorCallback(err) {
                            alert('There was a problem retrieving questions from the database.');
                        });
            }

            vm.saveAnswer = function (question) {
                console.log(question);
                $http.post('post-answer', {
                        id: question._id,
                        answers: question.answers,
                        selected_answer: question.selected_answer
                    })
                    .then(function successCallback(res) {
                        console.log('hi');
                    },

                    function errorCallback(err) {
                        console.log(question._id);
                        console.log(question.selected_answer);
                        console.log(err);
                    });
            };

        });
}());
