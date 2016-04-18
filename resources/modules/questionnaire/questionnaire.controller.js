
(function () {

 'use strict';
 angular.module('adaApp')
     .controller('QuestionnaireController', function($http, Questions, $timeout) {

         var vm = this;

         // Bind vm.questions (which will appear in the view) with Questions Service questions array.
         vm.questions = Questions.questions;


         // Invoke call to get questions array from questions service.
         Questions.getQuestions()
             .then( function (data) {
                 vm.questions = Questions.questions;
             });


         // Overall compliance of questionnaire, taking all questions into consideration.
         vm.getOverallCompliance = function () {
             return Questions.overallCompliance();
         };


         // Saving Answers for Individual Questions
         var timeout = null;
         vm.saveAnswer = function (question) {
             if (timeout !== null) {
                 $timeout.cancel(timeout);
             }
             Questions.saveAnswer(question);
             question.active = true;
             displaySaveMessage(question);
         };

         function displaySaveMessage(question) {
             timeout = $timeout(function () {
                 question.active = false;
                 timeout = null;
             }, 1820)
         }

     });

 }());