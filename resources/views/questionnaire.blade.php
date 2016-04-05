<!DOCTYPE html>
<html>
    <head>
        <title>Laravel/Angular/Mongo</title>
        <link rel="stylesheet" href="/build/css/css-deps.css">
        <link rel="stylesheet" href="/build/css/app.css">
    </head>
    <body data-ng-app="adaApp" data-ng-controller="QuestionnaireController as questionnaire">
        <div data-ng-repeat="question in questionnaire.questions" class="question">
            <h3>@{{ question.text }}</h3>
            <form data-ng-if="question.data_type === 'multiple_choice'">
                <select name="" id="">
                    <option name="toggle" data-ng-repeat="answer in question.answers">@{{ answer.text }}</option>
                </select>
            </form>
            <div data-ng-if="question.data_type === 'true_false'">
                <form>
                    <span data-ng-repeat="answer in question.answers">
                        <input  name="toggle" type="radio" >@{{ answer.text }}<br>
                    </span>
                </form>
            </div>
            <form data-ng-if="question.data_type === 'number'">
                <input type="number">
            </form>
        </div>
    </body>
    <script src="/build/js/deps.js"></script>
    <script src="/build/js/app.js"></script>
</html>



{{--<div data-ng-repeat="answer in question.answers" class="choices">--}}
    {{--<div>@{{ answer.text }}</div>--}}
{{--</div>--}}