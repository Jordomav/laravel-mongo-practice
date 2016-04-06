/**
 * Created by JordanMavrogeorge on 3/31/16.
 */
 
(function () {

 'use strict';
 angular.module('adaApp')
     .controller('QuestionnaireController', function($http) {
         var vm = this;

         vm.questions = [];

         init();

         function init() {
             $http.get('get-questions')
                 .then( function successCallback(res) {

                     vm.questions = res.data;
                     console.log(vm.questions);

                 },
                    function errorCallback(err) {
                        alert('There was a problem retrieving questions from the database.');
                    });
         }


     });

 }());
