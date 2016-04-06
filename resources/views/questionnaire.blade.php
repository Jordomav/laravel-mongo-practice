<!DOCTYPE html>
<html>
    <head>
        <title>Laravel/Angular/Mongo</title>
        <link rel="stylesheet" href="/build/css/css-deps.css">
        <link rel="stylesheet" href="/build/css/app.css">
    </head>
    <body data-ng-app="adaApp" data-ng-controller="QuestionnaireController as questionnaire">
        <div data-ng-repeat="question in questionnaire.questions" class="question">

            @{{ question.text }}

            <form data-ng-if="question.data_type === 'multiple_choice'">
                <select data-ng-model="question.selectedAnswer" name="" id="">
                    <option value="@{{ question.selectedAnswer }}" data-ng-repeat="answer in question.answers">@{{ answer.text }}</option>
                </select>
            </form>

            <form data-ng-if="question.data_type === 'true_false'">
                <span data-ng-repeat="answer in question.answers">
                    <input title="true-false" name="toggle" type="radio">
                    @{{ answer.text }}<br>
                </span>
            </form>

            <form data-ng-if="question.data_type === 'number'">
                <input type="number">
            </form>

            <span>@{{ question.selectedAnswer }}</span>

        </div>
    </body>
    <script src="/build/js/deps.js"></script>
    <script src="/build/js/app.js"></script>
</html>