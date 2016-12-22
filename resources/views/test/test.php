<!doctype html>
<html lang="zh" ng-app="test" >
<head>
    <meta charset="UTF-8">
    <title>Test for directive</title>

<!--    {{--默认是从public目录开始的  /就是跟目录的--}}-->
    <link rel="stylesheet" href="/laravel/xiaohu/public/lib/normalize/normalize.css">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <script src="/laravel/xiaohu/public/lib/jquery/jquery.js"></script>
    <script src="/laravel/xiaohu/public/lib/angular/angular.min.js"> </script>

    <script src="/laravel/xiaohu/public/lib/angular-ui/1.2.5/ui-bootstrap-tpls.js"></script>
    <script src="/laravel/xiaohu/public/test/directive.js"></script>

</head>
<body>

    <div ng-controller="testController" >
        <div hello howToLoad="loadData()">

        </div>
    </div>

    <div ng-controller="test2Controller">
        <div hello howToLoad="loadData2()">

        </div>
    </div>

    <hr>

    <div>
        <superman strength>力量</superman>
    </div>
    <div>
        <superman strength speed>力量 敏捷</superman>
    </div>
    <div>
        <superman strength speed light>力量 敏捷 发光</superman>
    </div>

    <hr>

    <inputtest></inputtest>
    <inputtest></inputtest>
    <inputtest></inputtest>
    <inputtest></inputtest>

    <hr>

    <div ng-controller="ctrl1">
        <drink flaveor="{{ flaveor }}"></drink>

        <input type="text" ng-model="flaveor">

        <drink1 flaveor=" flaveor "></drink1>
    </div>

    <div ng-controller="ctrl2">
        <greeting greet="sayHello(name)"></greeting>
    </div>

    <hr>





    <style>
        .horizontal-collapse {
            height: 70px;
        }
        .navbar-collapse.in {
            overflow-y: hidden;
        }

    </style>

    <div ng-controller="CollapseDemoCtrl">
        <p>Resize window to less than 768 pixels to display mobile menu toggle button.</p>
        <nav class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" ng-click="isNavCollapsed = !isNavCollapsed">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">A menu</a>
            </div>
            <div class="collapse navbar-collapse" uib-collapse="isNavCollapsed">
                <ul class="nav navbar-nav">
                    <li><a href="#">Link 1</a></li>
                    <li><a href="#">Link 2</a></li>
                </ul>
            </div>
        </nav>
        <hr>
        <button type="button" class="btn btn-default" ng-click="isCollapsed = !isCollapsed">Toggle collapse Vertically</button>
        <hr>
        <div uib-collapse="isCollapsed">
            <div class="well well-lg">Some content</div>
        </div>

        <button type="button" class="btn btn-default" ng-click="isCollapsedHorizontal = !isCollapsedHorizontal">Toggle collapse Horizontally</button>
        <hr>
        <div class="horizontal-collapse" uib-collapse="isCollapsedHorizontal" horizontal>
            <div class="well well-lg">Some content</div>
        </div>
    </div>

<hr>


    <div ng-controller="AlertDemoCtrl">
        <script type="text/ng-template" id="alert.html">
            <div ng-transclude></div>
        </script>

        <div uib-alert ng-repeat="alert in alerts" ng-class="'alert-' + (alert.type || 'warning')" close="closeAlert($index)">{{alert.msg}}</div>
        <div uib-alert template-url="alert.html" style="background-color:#fa39c3;color:white">A happy alert!</div>
        <button type="button" class='btn btn-default' ng-click="addAlert()">Add Alert</button>
    </div>

    <hr>
    <hr>
    <hr>

    <style type="text/css">
        form.tab-form-demo .tab-pane {
            margin: 20px 20px;
        }
    </style>

    <div ng-controller="TabsDemoCtrl">
        <p>Select a tab by setting active binding to true:</p>
        <p>
            <button type="button" class="btn btn-default btn-sm" ng-click="active = 1">Select second tab</button>
            <button type="button" class="btn btn-default btn-sm" ng-click="active = 2">Select third tab</button>
        </p>
        <p>
            <button type="button" class="btn btn-default btn-sm" ng-click="tabs[1].disabled = ! tabs[1].disabled">Enable / Disable third tab</button>
        </p>
        <hr />

        <uib-tabset active="active">
            <uib-tab index="0" heading="Static title">Static content</uib-tab>
            <uib-tab index="$index + 1" ng-repeat="tab in tabs" heading="{{tab.title}}" disable="tab.disabled">
                {{tab.content}}
            </uib-tab>
            <uib-tab index="3" select="alertMe()">
                <uib-tab-heading>
                    <i class="glyphicon glyphicon-bell"></i> Alert!
                </uib-tab-heading>
                I've got an HTML heading, and a select callback. Pretty cool!
            </uib-tab>
        </uib-tabset>

        <hr />

        <uib-tabset active="activePill" vertical="true" type="pills">
            <uib-tab index="0" heading="Vertical 1">Vertical content 1</uib-tab>
            <uib-tab index="1" heading="Vertical 2">Vertical content 2</uib-tab>
        </uib-tabset>

        <hr />

        <uib-tabset active="activeJustified" justified="true">
            <uib-tab index="0" heading="Justified">Justified content</uib-tab>
            <uib-tab index="1" heading="SJ">Short Labeled Justified content</uib-tab>
            <uib-tab index="2" heading="Long Justified">Long Labeled Justified content</uib-tab>
        </uib-tabset>

        <hr />

        Tabbed pills with CSS classes
        <uib-tabset type="pills">
            <uib-tab heading="Default Size">Tab 1 content</uib-tab>
            <uib-tab heading="Small Button" classes="btn-sm">Tab 2 content</uib-tab>
        </uib-tabset>

        <hr />

        Tabs using nested forms:
        <form name="outerForm" class="tab-form-demo">
            <uib-tabset active="activeForm">
                <uib-tab index="0" heading="Form Tab">
                    <ng-form name="nestedForm">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" required ng-model="model.name"/>
                        </div>
                    </ng-form>
                </uib-tab>
                <uib-tab index="1" heading="Tab One">
                    Some Tab Content
                </uib-tab>
                <uib-tab index="2" heading="Tab Two">
                    More Tab Content
                </uib-tab>
            </uib-tabset>
        </form>
        Model:
        <pre>{{ model | json }}</pre>
        Nested Form:
        <pre>{{ outerForm.nestedForm | json }}</pre>
    </div>


</body>




</html>