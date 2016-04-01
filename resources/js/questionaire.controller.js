/**
 * Created by JordanMavrogeorge on 3/31/16.
 */
 
(function () {

 'use strict';
 angular.module('adaApp')
     .controller('adaController', function($http, Questionaire){
         var vm = this;

         vm.trueFalse = {
             name: 'Yes'
         };
         it('should change state', function (){
             var trueFalse = element(by.binding(trueFalse.name));
             expect(trueFalse.getText()).toContain('Yes');

             element.all(by.model('trueFalse.name')).get(0).click();
             expect(color.getText()).toContain('No');
         });
     });

 
 }());
