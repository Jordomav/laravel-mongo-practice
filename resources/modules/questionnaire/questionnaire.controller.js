/**
 * Created by JordanMavrogeorge on 3/31/16.
 */
 
(function () {

 'use strict';
 angular.module('adaApp')
     .controller('QuestionnaireController', function($http, Questions) {

         var vm = this;

         vm.questions = Questions.questions;

         Questions.getQuestions()
             .then( function (data) {
                 vm.questions = Questions.questions;
             });


     });

 }());
