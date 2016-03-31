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
                                <input type="radio" name="optradio" data-ng-toggle="">True
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="optradio" data-ng-toggle="">False
                            </label>
                        </form>
                    </div>
                    <div class="question">
                        <h3>Here is a second question</h3>
                        <form role="form" class="choices">
                            <label class="radio-inline">
                                <input type="radio" name="optradio" data-ng-click="">Option 1
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="optradio" data-ng-click="">Option 2
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="optradio" data-ng-click="">Option 3
                            </label>
                        </form>
                    </div>
                    <div class="question">
                        <h3>Here is a third question</h3>
                        <form role="form" class="choices">
                            <input type="number" style="width:50px;" data-ng-model="range.q as response"><span> inches</span>
                            <div data-ng-if="response.length == 0">Correct</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="/build/js/js-deps.js"></script>
    <script src="/build/js/app.js"></script>
</html>
