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
                {{--Compliant Pop-out--}}
                <div class="compliance">
                    <div class="compliant"><h4><i class="fa fa-check icon-size"></i> You are ADA compliant.</h4></div>
                </div>
                {{--Non-Compliant Pop-Out--}}
                <div class="compliance">
                    <div class="non-compliant"><h4><i class="fa fa-times-circle icon-size"></i> You are NOT ADA compliant.</h4></div>
                </div>
            </div>
        </div>
    </div>

    </body>
    <script src="/build/js/deps.js"></script>
    <script src="/build/js/app.js"></script>
</html>