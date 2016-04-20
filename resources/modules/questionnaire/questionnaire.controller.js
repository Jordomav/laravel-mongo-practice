(function () {

 'use strict';
 angular.module('adaApp')
     .controller('QuestionnaireController', function($http, Questions, NewQuestion) {

         var vm = this;

         // Get questions from database, and then bind vm.questions to the underlying questions collection from the
         // Questions Service.
         displayQuestions();

         function displayQuestions() {
             Questions.init()
                 .then( function () {
                     vm.questions = Questions.questions;
                     console.log(vm.questions);

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


         /**
          *  New Question Methods
          */

         // TODO: Move more of this logic to the Service.
         // New Question Values
         vm.newQuestionText = '';
         vm.newQuestionAnswerType =  NewQuestion.answerType;

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
                 help_url: ''
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
                 });
             swal("Success!", "You're question has been submitted", "success");
         };


         vm.displayAnswerForm = function (event) {
             NewQuestion.setAnswerType(event);
             vm.newQuestionAnswerType =  NewQuestion.answerType;
         };


         vm.addMultipleChoiceAnswer = function () {
             NewQuestion.addMultipleChoiceInput();
         };

         /**
          * Pagination
          */
         vm.pageSize = 6;
         vm.currentPage = 1;

         vm.updatePage = function () {
             console.log(vm.currentPage);
             vm.questionsPaginated = [];

             var i = (vm.currentPage - 1) * vm.pageSize;
             var j = vm.currentPage * vm.pageSize;

             for(i, j; i <j && i < vm.questions.length; i++) {
                 vm.questionsPaginated.push(
                   vm.questions[i]
                 );
                 console.log(vm.questionsPaginated);
             }
         };

         vm.resetForm = function () {
             vm.newQuestionText = '';
             vm.trueFalseAnswers = '';
             vm.newQuestionMultipleChoiceAnswers = [];
             vm.rangeMeasurement = '';

         };

         vm.deleteQuestion = function () {
             swal({ title: "Are you sure?",
                    text: "You will not be able to recover this question",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false },

                    function(){
                        $http.delete('delete-question', {
                            id: questionnaire._id
                        })
                            //Complete http request
                            .then (
                                swal("Deleted!", "You have deleted the question.", "success"));
                         });

         }

     });

 }());