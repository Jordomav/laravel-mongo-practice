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

        <h1 class="row">ADA Compliance Survey</h1>

        <div data-ng-repeat="question in questionnaire.questions" class="question row">

            <div class="col-xs-8">
                {{-- Display the question --}}
                <p>@{{ question.text }}</p>

                {{-- Display appropriate input type to allow user to answer question --}}
                <multiple-choice-input data-ng-if="question.data_type === 'multiple_choice'"></multiple-choice-input>
                <true-false-input data-ng-if="question.data_type === 'true_false'"></true-false-input>
                <range-input data-ng-if="question.data_type === 'range'"></range-input>

                {{-- Save message --}}
                <flash-message duration="2000" show-close="true" class="save-message row text-right">
                    saved
                </flash-message>

            </div>

            <div class="col-xs-4">
                {{-- Display when question answer is compliant --}}
                <div data-ng-show="question.compliant === true"
                     class="compliant">
                    <h4><i class="fa fa-check icon-size"></i> You are ADA compliant.</h4>
                </div>

                {{-- Display when question answer is noncompliant --}}
                <div data-ng-hide="question.compliant === true"
                     class="non-compliant">
                    <h4><i class="fa fa-times-circle icon-size"></i> You are NOT ADA compliant.</h4>
                </div>
            </div>

        </div>

        {{-- Button to open Compliance Report --}}
        <button type="button"
                class="btn btn-primary"
                data-toggle="modal"
                data-target=".compliance-report">
            View Compliance Results
        </button>

        {{-- Compliance Report Modal --}}
        <div class="modal fade compliance-report" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">

                    <div class="modal-header">Compliance Overview</div>

                    <div data-ng-repeat="question in questionnaire.questions">

                        {{-- Display when question answer in noncompliant --}}
                        <div data-ng-show="question.compliant">
                            You are in compliance with regards to "@{{ question.text }}"
                        </div>

                        {{-- Display when question answer is compliant --}}
                        <div data-ng-hide="question.compliant">
                            <h4>You are not in Compliance with regards to "@{{ question.text }}"</h4>
                            <p>To learn how to become compliant with this area go to
                                <a href="">@{{ question.help_url }}</a>
                            </p>
                        </div>

                        <hr>
                    </div>

                    <h3 data-ng-if="questionnaire.getOverallCompliance()">You're compliant in all areas.</h3>
                </div>
            </div>
        </div>

    </div>
    </body>
    <script src="/build/js/deps.js"></script>
    <script src="/build/js/app.js"></script>
</html>