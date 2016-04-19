
(function () {

 'use strict';
 angular.module('adaApp')
     .controller('QuestionnaireController', function($http, Questions) {

         var vm = this;

         // Get questions from database, and then bind vm.questions to the underlying questions collection from the
         // Questions Service.
         Questions.init()
             .then( function () {
                 vm.questions = Questions.questions;
             });


         // Overall compliance of questionnaire, taking all questions into consideration.
         vm.getOverallCompliance = function () {
             return Questions.overallCompliance();
         };


         // Save answers for individual questions.
         vm.saveAnswer = function (question) {
             Questions.saveAnswer(question);
         };

         // Returns boolean representing whether a question has been answered.
         vm.getWasAnswered = function (question) {
             return Questions.wasAnswered(question);
         };



         // Add New Questions

         vm.newQuestionText = '';

         vm.newQuestion = function () {
             return {
                 text: vm.newQuestionText,

                 // TODO: We should probably have a default data_type, i.e. 'true-false'.
                 data_type: '',

                 // Hard-coding all new questions as default questions for now.
                 default_question: true,
                 help_url: ''
             }
         };

         vm.addQuestion = function() {
             console.log('hello');
             console.log(vm.newQuestion());
             Questions.saveQuestion(vm.newQuestion());
         };

     });

 }());