<!DOCTYPE html>
<html>
    <head>
        <title>Laravel/Angular/Mongo</title>
        <link rel="stylesheet" href="/build/css/css-deps.css">
        <link rel="stylesheet" href="/build/css/app.css">
    </head>
    <body data-ng-app="adaApp" data-ng-controller="QuestionnaireController as questionnaire">
    <div class="container">
        <div class="row">
            <h1>ADA Compliance Survey</h1>
            <div data-ng-repeat="question in questionnaire.questions">

                <div class="question container">

                    {{-- Display the question --}}
                    <h3>@{{ question.text }}</h3>

                    {{-- Display appropriate input type for each question --}}
                    <multiple-choice-input data-ng-if="question.data_type === 'multiple_choice'"></multiple-choice-input>
                    <true-false-input data-ng-if="question.data_type === 'true_false'"></true-false-input>
                    <range-input data-ng-if="question.data_type === 'number'"></range-input>

                </div>

                <br>
            </div>
        </div>

        <true-false-question></true-false-question>


    </div>

    </body>
    <script src="/build/js/deps.js"></script>
    <script src="/build/js/app.js"></script>
</html>