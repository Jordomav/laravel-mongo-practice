/**
 * Created by JordanMavrogeorge on 3/31/16.
 */
 
(function () {

 'use strict';
 angular.module('adaApp')
     .controller('QuestionnaireController', function($http, Questions) {

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

         vm.saveAnswer = function (question) {
             Questions.saveAnswer(question);
         };

         vm.getWasAnswered = function (question) {
             return Questions.wasAnswered(question);
         };

     });

 }());