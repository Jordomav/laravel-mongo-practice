<!DOCTYPE html>
<html>
    <head>
        <title>Laravel/Angular/Mongo</title>
        <link rel="stylesheet" href="/build/css/css-deps.css">
        <link rel="stylesheet" href="/build/css/app.css">
    </head>
    <body data-ng-app="adaApp" data-ng-controller="adaController">
        <div class="container">
            <div class="content">
                <h1 class="title">Angular, Laravel and Mongo</h1>
                <div class="container">
                    <div class="question">
                        <h3>Here is a question</h3>
                        <form role="form" class="choices">
                            <label class="radio-inline">
                                <input type="radio" name="optradio" data-ng-click="">Option 1
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="optradio">Option 2
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="optradio">Option 3
                            </label>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="/build/js/js-deps.js"></script>
    <script src="/build/js/app.js"></script>
</html>
