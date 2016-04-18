
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
         vm.saveMessage = '';
         var timeout;


         // TODO: $timeout.cancel() doesn't seem to be working when another answer is selected while timer is already
         // (todo cont...) in process.
         vm.saveAnswer = function (question) {
             if (timeout) {
                 $timeout.cancel(timeout);
             }
             Questions.saveAnswer(question);
             question.active = true;
             displaySaveMessage(question);
         };

         function displaySaveMessage(question) {

             vm.saveMessage = 'saved';

             timeout = $timeout(function () {
                 vm.saveMessage = '';
             }, 1820)

             .then(function () {
                 question.active = false;
             });
         }

     });

 }());