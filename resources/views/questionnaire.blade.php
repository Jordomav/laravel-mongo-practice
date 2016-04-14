<!DOCTYPE html>
<html>
    <head>
        <title>Laravel/Angular/Mongo</title>
        <link rel="stylesheet" href="/build/css/css-deps.css">
        <link rel="stylesheet" href="/build/css/app.css">
    </head>

    {{--Angular Controller and App Connected--}}
    <body data-ng-app="adaApp" data-ng-controller="QuestionnaireController as questionnaire">
    <div class="container">

        <h1>ADA Compliance Survey</h1>
        <div data-ng-repeat="question in questionnaire.questions">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 question">
                        {{-- Display the question --}}
                        <h3>@{{ question.text }}</h3>

                        {{-- Display appropriate input type to allow user to answer question --}}
                        <multiple-choice-input data-ng-if="question.data_type === 'multiple_choice'"></multiple-choice-input>
                        <true-false-input data-ng-if="question.data_type === 'true_false'"></true-false-input>
                        <range-input data-ng-if="question.data_type === 'range'"></range-input>
                    </div>

                    {{--Compliance Pop-outs--}}
                    {{--Compliant Pop-out--}}
                    <div class="compliance col-lg-4" data-ng-show="question.compliant === true" data-ng-class="{someClass: hover}" ng-mouseenter="hover = true" ng-mouseleave="hover = false">
                        <div class="compliant"><h4><i class="fa fa-check icon-size"></i> You are ADA compliant.</h4></div>
                    </div>
                    {{--Non-Compliant Pop-Out--}}
                    <div class="compliance col-lg-4" data-ng-hide="question.compliant === true" data-ng-class="{someClass: hover}" ng-mouseenter="hover = true" ng-mouseleave="hover = false">
                        <div class="non-compliant"><h4><i class="fa fa-times-circle icon-size"></i> You are NOT ADA compliant.</h4></div>
                    </div>

                </div>

                <div class="row notifier">
                    <div class="col-lg-7">
                        {{--Save Status Icons--}}
                        <div class="notifyBox" >
                            <i data-ng-hide="questionnaire.getWasAnswered(question)"
                               class="fa fa-times-circle fa-2x notify"></i>
                        </div>
                        <div class="notifyBox">
                            <i data-ng-show="questionnaire.getWasAnswered(question)"
                               style="color:#00AA00;"
                               class="fa fa-check fa-2x notify"
                               id="flip"></i>
                        </div>
                    </div>
                </div>

            </div>




        </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">View Compliance Results</button>

        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">Compliance Overview</div>
                    <div data-ng-repeat="question in questionnaire.questions">
                            <div data-ng-if="question.selected_answer !== question.default_question">
                                <h4>You are not in Compliance with regards to "@{{ question.text }}"</h4>
                                <p>To learn how to become compliant with this area go to <a href="">@{{ question.help_url }}</a></p>
                            </div>
                            <div data-ng-if="question.selected_answer === question.default_question">
                                You are in compliance with regards to "@{{ question.text }}"
                            </div>
                        <hr>
                    </div>
                    <h3 data-ng-if="questionnaire.compliant === false">You're compliant in all areas.</h3>
                </div>
            </div>
        </div>

    </div>
    </body>
    <script src="/build/js/deps.js"></script>
    <script src="/build/js/app.js"></script>
</html>