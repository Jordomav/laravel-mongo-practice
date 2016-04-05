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

             function init(){
                 $http.get('get-questions')
                     .then(function successCallback(res){
                         console.log(res);
                         vm.questions = res.data;
                     },
                     function errorCallback(err){
                         alert('There was a error finding the questions');
                         console.log(err);
                     });
             }

     });

 }());
