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

            <div class="question row">

                {{-- Display the question --}}
                <h3>@{{ question.text }}</h3>

                {{-- Display appropriate input type to allow user to answer question --}}
                <multiple-choice-input data-ng-if="question.data_type === 'multiple_choice'"></multiple-choice-input>
                <true-false-input data-ng-if="question.data_type === 'true_false'"></true-false-input>
                <range-input data-ng-if="question.data_type === 'number'"></range-input>

            </div>
            {{--Save Status Icons--}}
            <div class="notifyBox">
                <i class="fa fa-times-circle fa-2x notify"></i>
            </div>
            {{--<i class="fa fa-check fa-2x notify"></i>--}}


            <br>

            {{-- TODO: implement compliance popouts --}}
            {{--Compliance Pop-outs--}}
            {{--Compliant Pop-out--}}
            {{--<div class="compliance">--}}
            {{--<div class="compliant"><h4><i class="fa fa-check icon-size"></i> You are ADA compliant.</h4></div>--}}
            {{--</div>--}}
            {{--Non-Compliant Pop-Out--}}
            {{--<div class="compliance">--}}
            {{--<div class="non-compliant"><h4><i class="fa fa-times-circle icon-size"></i> You are NOT ADA compliant.</h4></div>--}}
            {{--</div>--}}
            
        </div>

        <div>@{{ questionnaire.selectedAnswer }}</div>


    </div>

    </body>
    <script src="/build/js/deps.js"></script>
    <script src="/build/js/app.js"></script>
</html>