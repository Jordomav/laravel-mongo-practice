(function () {


 'use strict';

 angular.module('adaApp')
     .controller('QuestionnaireController', function($http, Questions, NewQuestion, $window) {

         var vm = this;

         // Get questions from database, and then bind vm.questions to the underlying questions collection from the
         // Questions Service.
         displayQuestions();

         function displayQuestions() {
             Questions.init()
                 .then( function () {
                     vm.questions = Questions.questions;
                     vm.updatePage();
                 });
         }

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

         // Returns an array of compliant answer for a question.
         vm.getCompliantAnswers = function (question) {
             return Questions.compliantAnswers(question);
         };

         // Returns text of current answer
         vm.getSelectedAnswerText = function (question) {
             return Questions.selectedAnswerText(question);
         };


         /**
          *  Question Methods
          */

         // TODO: Move more of this logic to the Service.
         // New Question Values
         vm.newQuestionText = '';
         vm.newQuestionAnswerType =  NewQuestion.answerType;
         vm.newQuestionHelpUrl = '';

         // Properties for storing answers for new questions.
         vm.trueFalseAnswers = {};
         vm.newQuestionMultipleChoiceAnswers = NewQuestion.multipleChoiceAnswers;
         vm.rangeAnswer = [];
         vm.rangeMeasurement = '';

         vm.newQuestion = function () {
             var question = {
                 text: vm.newQuestionText,
                 data_type: vm.newQuestionAnswerType,

                 // Hard-coding all new questions as default questions for now.
                 default_question: true,

                 help_url: vm.newQuestionHelpUrl
             };

             switch (question.data_type) {
                 case 'true_false':
                     question.answers = [
                         {
                             text: vm.trueFalseAnswers.true,
                             compliant: true
                         },
                         {
                             text: vm.trueFalseAnswers.false,
                             compliant: false
                         }
                     ];
                     break;

                 case 'multiple_choice':
                     question.answers = [];
                     _.forEach(vm.newQuestionMultipleChoiceAnswers, function (answer) {
                         question.answers.push(answer);
                     });
                     break;

                 case 'range':
                     question.answers = {};
                     question.answers.text = vm.rangeMeasurement;
                     question.answers.compliant_range = vm.rangeAnswer;
                     break;
             }

             return question;
         };


         vm.addQuestion = function () {
             Questions.saveQuestion(vm.newQuestion())
                 .then(function () {
                     displayQuestions();
                     swal("Success!", "You're question has been submitted", "success");
                     vm.resetForm();
                 });
         };

         vm.deleteQuestion = function (question) {
             Questions.deleteQuestion(question, displayQuestions);
         };


         vm.displayAnswerForm = function (event) {
             NewQuestion.setAnswerType(event);
             vm.newQuestionAnswerType =  NewQuestion.answerType;
         };


         vm.addMultipleChoiceAnswer = function () {
             NewQuestion.addMultipleChoiceInput();
         };

         vm.resetForm = function () {
             vm.newQuestionText = '';
             vm.trueFalseAnswers = '';
             vm.newQuestionMultipleChoiceAnswers = [];
             vm.rangeMeasurement = '';
             vm.newQuestionHelpUrl = '';
             vm.rangeAnswer = [];
             vm.newQuestionMultipleChoiceAnswers = [{text: '', compliant: false}];
         };

         /**
          * Pagination
          */
         vm.pageSize = 6;
         vm.currentPage = 1;

         vm.updatePage = function () {
             vm.questionsPaginated = [];

             var i = (vm.currentPage - 1) * vm.pageSize;
             var j = vm.currentPage * vm.pageSize;

             for(i, j; i <j && i < vm.questions.length; i++) {
                 vm.questionsPaginated.push(
                   vm.questions[i]
                 );
             }
         };

         /**
          *  Printing
          */
         vm.print = function () {
             $window.print();
         };
     });

 }());