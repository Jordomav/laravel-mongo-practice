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
         vm.newQuestionText = '';
         vm.newQuestionAnswerType =  NewQuestion.answerType;
         vm.newQuestionMultipleChoiceInputs = NewQuestion.multipleChoiceInputs;

         vm.newQuestion = function () {
             return {
                 text: vm.newQuestionText,
                 data_type: vm.newQuestionAnswerType,

                 // Hard-coding all new questions as default questions for now.
                 default_question: true,
                 help_url: ''
             };
         };


         vm.addQuestion = function () {
             console.log(vm.newQuestion());
             Questions.saveQuestion(vm.newQuestion());
         };


         vm.displayAnswerForm = function (event) {
             NewQuestion.setAnswerType(event);
             vm.newQuestionAnswerType =  NewQuestion.answerType;
         };


         vm.addMultipleChoiceAnswer = function () {
             NewQuestion.addMultipleChoiceInput();
         };

         vm.filteredQuestions = [];
         vm.currentPage = 1;
         vm.numPerPage = 1;
         vm.maxSize = 5;

     });

 }());