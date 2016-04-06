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
                    <h3>@{{ question.text }}</h3>
                    <form data-ng-if="question.data_type === 'multiple_choice'" class="">
                        <select name="" id="" class="form-control">
                            <option value="" disabled selected>Please select one of the following...</option>
                            <option value="" data-ng-repeat="answer in question.answers">@{{ answer.text }}</option>
                        </select>
                    </form>

                    <form data-ng-if="question.data_type === 'true_false'">
                <span data-ng-repeat="answer in question.answers" class="radio-inline">
                    <input title="true-false" name="toggle" type="radio">
                    @{{ answer.text }}<br>
                </span>
                    </form>

                    <form data-ng-if="question.data_type === 'number'" class="col-xs-2">
                        <input type="number" class="form-control">
                    </form>
                </div>
                <br>
            </div>
        </div>
    </div>

    </body>
    <script src="/build/js/deps.js"></script>
    <script src="/build/js/app.js"></script>
</html>