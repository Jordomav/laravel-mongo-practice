
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

         vm.addQuestion = function () {
             console.log(vm.newQuestion());
             Questions.saveQuestion(vm.newQuestion());
         };

         // Display a default answer input type in New Question form.
         vm.newQuestion_trueFalse = true;

         vm.displayAnswerForm = function (event) {
             console.log(event.target.value);

             switch(event.target.value) {
                 case 'true_false':
                     vm.newQuestion_trueFalse = true;
                     vm.newQuestion_multipleChoice = false;
                     vm.newQuestion_range = false;
                     break;
                 case 'multiple_choice':
                     vm.newQuestion_trueFalse = false;
                     vm.newQuestion_multipleChoice = true;
                     vm.newQuestion_range = false;
                     break;
                 case 'range':
                     vm.newQuestion_trueFalse = false;
                     vm.newQuestion_multipleChoice = false;
                     vm.newQuestion_range = true;
                     break;
             }
         };

         vm.inputs = [];
         vm.addfield=function(){
             vm.inputs.push({

                 text: '',
                 data_type: ''
             })
         }

     });

 }());