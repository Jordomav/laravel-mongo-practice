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

            <div id="questionnaire">
                <div class="row">
                    <h1 class="col-xs-11 text-left app-title">ADA Compliance Survey</h1>
                    <i class="fa fa-plus add text-right" data-toggle="modal" data-target=".bs-example-modal-lg"></i>
                </div>

                <div data-ng-repeat="question in questionnaire.questionsPaginated" class="question row">

                    <div class="col-xs-8">
                        {{-- Display the question --}}
                        <p class="question-text">@{{ ($index + 1) + '. ' + question.text }}</p>

                        {{-- Display appropriate input type to allow user to answer question --}}
                        <div class="answer-input col-xs-10">
                            <multiple-choice-input data-ng-show="question.data_type === 'multiple_choice'"></multiple-choice-input>
                            <true-false-input data-ng-show="question.data_type === 'true_false'"></true-false-input>
                            <range-input data-ng-show="question.data_type === 'range'"></range-input>
                        </div>

                        {{-- Save message --}}
                        <span data-ng-show="question.active" class="save-message col-xs-2 text-right">
                        saving
                    </span>

                    </div>

                    <div data-ng-if="questionnaire.getWasAnswered(question)" class="col-xs-4 text-right">
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

                    {{-- Delete Question Button --}}
                    {{-- TODO: Delete Question functionality will only be present in admin view --}}
                    <div class="text-muted col-xs-12 text-right">
                        delete question
                        <i class="fa fa-times-circle-o non-compliant"
                           data-ng-click="questionnaire.deleteQuestion(question)"></i>
                    </div>

                    <div class="col-xs-12">
                        <hr />
                    </div>

                </div>

                {{-- Page Navigation --}}
                <uib-pagination total-items="questionnaire.questions.length"
                                items-per-page="questionnaire.pageSize"
                                data-ng-model="questionnaire.currentPage"
                                data-ng-change="questionnaire.updatePage()"
                                class="pagination-sm"></uib-pagination>

                {{-- Button to open Compliance Report --}}
                <button type="button"
                        class="compliance-report-btn btn btn-primary row"
                        data-toggle="modal"
                        data-target=".compliance-report">
                    View Compliance Results
                </button>
            </div>


            {{-- Compliance Report Modal --}}
            <compliance-report class="modal fade compliance-report"
                               tabindex="-1" role="dialog" id="complianceModal"></compliance-report>



            {{-- Add Question modal --}}
            <new-questions-screen class="modal fade bs-example-modal-lg"
                                  tabindex="-1" role="dialog" id="addQuestionModal"></new-questions-screen>



        </div>
    </body>
    <script src="/build/js/deps.js"></script>
    <script src="/build/js/app.js"></script>
</html>