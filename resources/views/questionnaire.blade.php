<!DOCTYPE html>
<html>
    <head>
        <title>Laravel/Angular/Mongo</title>
        <link rel="stylesheet" href="/build/css/css-deps.css">
        <link rel="stylesheet" href="/build/css/app.css">
        <link href='https://fonts.googleapis.com/css?family=Noto+Sans' rel='stylesheet' type='text/css'>
    </head>

    {{--Angular Controller and App Connected--}}
    <body data-ng-app="adaApp" data-ng-controller="QuestionnaireController as questionnaire">
    <div class="container">

        <div class="row">
            <h1 class="col-lg-6">ADA Compliance Survey</h1>
            <i class="fa fa-plus col-lg-offset-5 add" data-toggle="modal" data-target=".bs-example-modal-lg"></i>
        </div>

        <div data-ng-repeat="question in questionnaire.questions" class="question row">

            <div class="col-xs-8">
                {{-- Display the question --}}
                <p>@{{ question.text }}</p>

                {{-- Display appropriate input type to allow user to answer question --}}
                <div class="answer-input col-xs-10">
                    <multiple-choice-input data-ng-if="question.data_type === 'multiple_choice'"></multiple-choice-input>
                    <true-false-input data-ng-if="question.data_type === 'true_false'"></true-false-input>
                    <range-input data-ng-if="question.data_type === 'range'"></range-input>
                </div>

                {{-- Save message --}}
                <span data-ng-show="question.active" class="save-message col-xs-2 text-right">
                    saving
                </span>

            </div>

            <div data-ng-if="questionnaire.getWasAnswered(question)" class="col-xs-4">
                {{-- Display when question answer is compliant --}}
                <div data-ng-show="question.compliant === true"
                     class="compliant">
                    <h4><i class="fa fa-check icon-size"></i> compliant</h4>
                </div>

                {{-- Display when question answer is noncompliant --}}
                <div data-ng-hide="question.compliant === true"
                     class="non-compliant">
                    <h4><i class="fa fa-times-circle icon-size"></i> non-compliant</h4>
                </div>
            </div>
            <span><i class="fa fa-times-circle-o" data-ng-click="questionnaire.deleteQuestion()"></i></span>
            <div class="col-xs-12">
                <hr />
            </div>



        </div>
        <pagination total-items="filterQuestions.length" items-per-page="pageSize" ng-model="currentPage" max-size="5" class="pagination-sm"></pagination>

        {{-- Button to open Compliance Report --}}
        <button type="button"
                class="compliance-report-btn btn btn-primary row"
                data-toggle="modal"
                data-target=".compliance-report">
            View Compliance Results
        </button>

        {{-- TODO: move the Compliance Report Modal to a separate template file. --}}
        {{-- Compliance Report Modal --}}
        <div class="modal fade compliance-report" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <h2 class="modal-header text-center">Compliance Overview</h2>

                    {{-- Overall Questionnaire Complaince Headers --}}
                    <h3 data-ng-if="questionnaire.getOverallCompliance()" class="compliant text-center">
                        You're compliant in all areas.
                    </h3>

                    <h3 data-ng-if="!questionnaire.getOverallCompliance()" class="non-compliant text-center">
                        You are out of compliance.
                    </h3>

                    {{-- Individual Question Compliance --}}
                    <div data-ng-repeat="question in questionnaire.questions" class="question report">

                        {{-- Display when question answer in noncompliant --}}
                        <div data-ng-show="question.compliant">
                            <i class="compliant fa fa-check icon-size"></i>
                            You are in compliance with regards to "@{{ question.text }}"
                        </div>

                        {{-- Display when question answer is compliant --}}
                        <div data-ng-hide="question.compliant">
                            <h4>
                                <i class="non-compliant fa fa-times-circle icon-size"></i>
                                You are not in compliance with regards to "@{{ question.text }}"
                            </h4>
                            To learn how to become compliant with this area go to: 
                            <a href="">@{{ question.help_url }}</a>

                        </div>

                        <hr>
                    </div>

                </div>
            </div>
        </div>

        {{-- TODO: Move the Add Question Model to separate file --}}
        <!-- Add Question modal -->
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="font-size: 40px; margin-right:10px;">&times;</span></button>
                    <div class="modal-interior">
                        <h1>Add a question</h1>
                        <form name="questionnaire.newForm" action="">

                            {{-- New Question text input --}}
                            <h3>Question</h3>
                            <div class="form-group">
                                <textarea data-ng-model="questionnaire.newQuestionText"
                                          type="text"
                                          name="question"
                                          placeholder="Question text"
                                          rows="3"
                                          class="form-control question-input"></textarea>
                            </div>


                            <div class="row">
                                <h3 class="col-xs-12">Question type:</h3>
                                <div class="col-xs-12 ">
                                    <button data-ng-click="questionnaire.displayAnswerForm($event)"
                                            value="true_false"
                                            type="button"
                                            class="btn btn-default answer-type-btn">True-False</button>

                                    <button data-ng-click="questionnaire.displayAnswerForm($event)"
                                            value="multiple_choice"
                                            type="button"
                                            class="btn btn-default answer-type-btn">Multiple Choice</button>

                                    <button data-ng-click="questionnaire.displayAnswerForm($event)"
                                            value="range"
                                            type="button"
                                            class="btn btn-default answer-type-btn">Range</button>
                                </div>
                            </div>

                            <div data-ng-if="questionnaire.newQuestionAnswerType === 'true_false'" class="row tab-inner tab-wrap">
                                <div class="row">
                                    <span class="col-xs-6">
                                        <span>True:</span>
                                        <input data-ng-model="questionnaire.trueFalseAnswers.true"
                                               title="true-answer" type="text" class="form-control">
                                    </span>
                                </div>
                                <div class="row">
                                    <span class="col-xs-6">
                                        <span>False:</span>
                                        <input data-ng-model="questionnaire.trueFalseAnswers.false"
                                               title="false-answer" type="text" class="form-control">
                                    </span>
                                </div>
                            </div>

                            <div data-ng-if="questionnaire.newQuestionAnswerType === 'multiple_choice'" class="row tab-inner tab-wrap">
                                <div data-ng-repeat="answer in questionnaire.newQuestionMultipleChoiceAnswers">

                                    <textarea data-ng-model="answer.text"
                                              class="col-xs-8 form-control question-input multi-input"
                                              rows="1"
                                              title="multiple-choice-answer"></textarea>

                                    <span class="col-xs-2 multi-input2">Compliant?
                                        <input data-ng-model="answer.compliant"
                                               type="checkbox"
                                               title="multiple-choice-answer-compliance">
                                    </span>

                                </div>
                                <i data-ng-click="questionnaire.addMultipleChoiceAnswer()"
                                   class="fa fa-plus-circle col-xs-1 multi-input2"></i>
                            </div>

                            <div data-ng-if="questionnaire.newQuestionAnswerType === 'range'" class="row tab-inner tab-wrap">
                                <div class="col-xs-6">
                                    <div class="col-xs-12">
                                    <span class="col-xs-6">
                                        <span>Min:</span>
                                        <input data-ng-model="questionnaire.rangeAnswer[0]"
                                               type="number"
                                               class="form-control" title="range-answer-min">
                                    </span>
                                    </div>
                                    <div class="col-xs-12">
                                    <span class="col-xs-6">
                                        <span>Max:</span>
                                        <input data-ng-model="questionnaire.rangeAnswer[1]"
                                               type="number"
                                               class="form-control" title="range-answer-max">
                                    </span>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="col-xs-12">
                                        <span class="col-xs-6">
                                            <span>Measurement:</span>
                                            <input data-ng-model="questionnaire.rangeMeasurement"
                                                   name="questionnaire.messurement"
                                                   type="text"
                                                   class="form-control" title="range-measurement">
                                        </span>
                                    </div>

                                </div>
                            </div>
                            <br>
                            <p>Help URL:</p>
                            <textarea name="" id="" cols="40" rows="1" class="form-control question-input" data-ng-model="questionnaire.resetUrl"></textarea>
                            <br/><br>
                            <button data-ng-click="questionnaire.addQuestion()"
                                    type="button"
                                    class="btn btn-success">
                                Submit
                            </button>
                            <button type="button" data-ng-click="questionnaire.resetForm()" class="btn btn-danger">Clear</button>
                            <br/>
                        </form>
                    </div>

                </div>
            </div>
        </div>


    </div>
    </body>
    <script src="/build/js/deps.js"></script>
    <script src="/build/js/app.js"></script>
</html>



