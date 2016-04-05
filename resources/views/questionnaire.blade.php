<!DOCTYPE html>
<html>
    <head>
        <title>Laravel/Angular/Mongo</title>
        <link rel="stylesheet" href="/build/css/css-deps.css">
        <link rel="stylesheet" href="/build/css/app.css">
    </head>
    <body data-ng-app="adaApp" data-ng-controller="adaController as questionaire">
        <div class="container">
            <div class="content">
                <h1 class="title">Angular, Laravel and Mongo</h1>
                <div class="container">
                    <div class="question">
                        <h4>Wheel chair door and hall clearance at lease 32 inches?</h4>
                        <form role="form" class="choices">
                            <label class="radio-inline">
                                <input type="radio" name="optradio" data-ng-model="trueFalse.name" value="yes">Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="optradio" data-ng-model="trueFalse.name" value="no">No
                            </label>
                            <tt>@{{trueFalse.name}}</tt>
                        </form>
                    </div>
                    <div class="question">
                        <h3>If the threshold is vertical is it no more than ¼ inch high?</h3>
                        <form role="form" class="choices">
                            <select  class="form-control">
                                <option data-ng-repeat="">@{{Answers}}</option>
                            </select>
                        </form>
                    </div>
                    <div class="question">
                        <h3>Toilet height range?</h3>
                        <form role="form" class="choices">
                            <input type="number" style="width:50px;" data-ng-model="range.q as response"><span> inches</span>
                            <div data-ng-if="response == compliant_range"><i class="fa fa-check"></i>You are ADA compliant</div>
                            <div data-ng-if="response !== complianct_range"><i class="fa fa-times"></i>You are not ADA compliant</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="/build/js/deps.js"></script>
    <script src="/build/js/app.js"></script>
</html>
