
(function () {

 'use strict';
 angular.module('adaApp')
     .controller('QuestionnaireController', function($http, Questions, NewQuestion) {

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


         /**
          *  New Question Methods
          */
         vm.getNewQuestion = function () {
             NewQuestion.newQuestion();
         };


         vm.addQuestion = function () {
             console.log(vm.getNewQuestion());
             Questions.saveQuestion(vm.getNewQuestion());
         };


         vm.newQuestionAnswerType =  NewQuestion.answerType;
         vm.displayAnswerForm = function (event) {
             NewQuestion.setAnswerType(event);
             vm.newQuestionAnswerType =  NewQuestion.answerType;
         };


         vm.inputs = [];
         vm.addField = function () {
             console.log('something');
             vm.inputs.push({
                 text: '',
                 data_type: ''
             });
         };

     });

 }());