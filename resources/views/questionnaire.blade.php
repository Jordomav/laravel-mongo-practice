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

            <div class="col-xs-12">
                <hr />
            </div>



        </div>

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

                    <h3 data-ng-if="questionnaire.getOverallCompliance()" class="compliant text-center">
                        You're compliant in all areas.
                    </h3>

                </div>
            </div>
        </div>

        <!-- Add Question modal -->
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                    <div class="modal-interior">
                        <h1>Add a question</h1>
                        <form action="">
                            <h3>Question</h3>
                            <input type="text" name="question" placeholder="Question text">
                            <h3>Question type</h3>
                            <div>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#true_false" aria-controls="home" role="tab" data-toggle="tab">True-False</a></li>
                                    <li role="presentation"><a href="#multiple" aria-controls="profile" role="tab" data-toggle="tab">Multiple Choice</a></li>
                                    <li role="presentation"><a href="#range" aria-controls="messages" role="tab" data-toggle="tab">Range</a></li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="true_false">
                                        
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="multiple">

                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="range">

                                    </div>

                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Submit your question</button>
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