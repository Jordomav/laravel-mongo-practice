/**
 * Created by JordanMavrogeorge on 3/31/16.
 */
 
(function () {

 'use strict';
 angular.module('adaApp')
     .controller('adaController', function($http){
         var vm = this;
         vm.questions = {
            { 
                id: 1,
                text:'Is your door and hall clearance 32 inches wide?',
                answers: [
                    {text: 'yes', compliant: true},
                    {text: 'no', compliant: false}
                ],
                helpUrl: '',
                dataType: 'true_false',
                defaultQuestion: 'true'

            },
            {
                id: 2,
                text:'If the threshold is vertical is it no more than 1/4 inch high?',
                answers: [
                    {
                        text: 'No more than ½ inch high with the top ¼ inch beveled no steeper than 1:2, 
                              if the threshold was installed on or after the 1991 ADA Standards went into effect 
                              (1/26/93)?', 
                        compliant: true
                    },
                    {
                        text: 'No more than ¾ inch high with the top ½ inch beveled no steeper than 1:2, 
                              if the threshold was installed before the 1991 ADA Standards went into effect 
                              (1/26/93)?', 
                        compliant: true
                    },
                    {
                        text: 'Not within range', compliant: false
                    }
                ],
                helpUrl: '',
                dataType: 'multiple_choice',
                defaultQuestion: 'true'

            },
            {
                id: 3,
                text:'How high is your toilet?',
                answers: [
                    {
                        text: 'inches', 
                        compliant: return function () {

                            return vm.userInput >= 17 && vm.userInput >=19;
                        }
                    }
                ],
                helpUrl: '',
                dataType: 'number',
                defaultQuestion: 'true'

            }
        };

        vm.userInput = null;
         vm.trueFalse = {
             name: 'Yes'
         };

     });

 
 }());
