<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body data-ng-app="adaApp" data-ng-controller="QuestionnaireController as questionnaire">
            <div>
                <h2 class="text-center">Compliance Overview</h2>
                <a href="/print"><i class="fa fa-print"></i></a>
            </div>
            {{-- Overall Questionnaire Complaince Headers --}}
            <h3 data-ng-if="questionnaire.getOverallCompliance()" class="compliant text-center">
                You're compliant in all areas.
            </h3>

            <h3 data-ng-if="!questionnaire.getOverallCompliance()" class="non-compliant text-center">
                You are out of compliance.
            </h3>
            {{-- Individual Question Compliance --}}
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
</body>
</html>