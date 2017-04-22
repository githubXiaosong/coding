@extends('page.index')

@section('title')
    home
@stop

@section('content')
	 <div class="container" ng-controller="HomeController">

        <div class="row">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style=" width: 100%">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li  data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">

                    <div class="item active">
                        <img src="/img/title.png" alt="...">

                        <div class="carousel-caption">
                            ...
                        </div>
                    </div>

                    <div class="item ">
                        <img src="/img/title.png" alt="...">

                        <div class="carousel-caption">
                            ...
                        </div>
                    </div>


                    <div class="item ">
                        <img src="/img/title.png" alt="...">

                        <div class="carousel-caption">
                            ...
                        </div>
                    </div>

                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        <div class="row">


            <div class="col-xs-2 col-md-2 ">
                <a href="#" class="thumbnail hvr-float-shadow ">
                    <img class="img-circle " src="/img/android_small.png" alt="...">
                </a>
            </div>


            <div class="col-xs-2 col-md-2 ">
                <a href="#" class="thumbnail hvr-float-shadow ">
                    <img class="img-circle " src="/img/c_small.png" alt="...">
                </a>
            </div>
            <div class="col-xs-2 col-md-2 ">
                <a href="#" class="thumbnail hvr-float-shadow ">
                    <img class="img-circle " src="/img/ios_small.png" alt="...">
                </a>
            </div>
            <div class="col-xs-2 col-md-2 ">
                <a href="#" class="thumbnail hvr-float-shadow ">
                    <img class="img-circle " src="/img/js_small.png" alt="...">
                </a>
            </div>
            <div class="col-xs-2 col-md-2 ">
                <a href="#" class="thumbnail hvr-float-shadow ">
                    <img class="img-circle " src="/img/php_small.png" alt="...">
                </a>
            </div>
            <div class="col-xs-2 col-md-2 ">
                <a href="#" class="thumbnail hvr-float-shadow ">
                    <img class="img-circle " src="/img/html_small.png" alt="...">
                </a>
            </div>


            ...
        </div>

        <div class="row">

            <div class="col-sm-4 col-md-3" >
                <a href="">
                <div class="thumbnail hvr-shadow">
                    <img src="/img/test_small.jpg" alt="...">

                    <div class="caption">
                        <h3>Thumbnail label</h3>

                        <p> Thumbnail desc Thumbnail desc Thumbnail desc Thumbnail desc</p>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-sm-4 col-md-3" >
                <a href="">
                    <div class="thumbnail hvr-shadow">
                        <img src="/img/test_small.jpg" alt="...">

                        <div class="caption">
                            <h3>Thumbnail label</h3>

                            <p> Thumbnail desc Thumbnail desc Thumbnail desc Thumbnail desc</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-4 col-md-3" >
                <a href="">
                    <div class="thumbnail hvr-shadow">
                        <img src="/img/test_small.jpg" alt="...">

                        <div class="caption">
                            <h3>Thumbnail label</h3>

                            <p> Thumbnail desc Thumbnail desc Thumbnail desc Thumbnail desc</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-4 col-md-3" >
                <a href="">
                    <div class="thumbnail hvr-shadow">
                        <img src="/img/test_small.jpg" alt="...">

                        <div class="caption">
                            <h3>Thumbnail label</h3>

                            <p> Thumbnail desc Thumbnail desc Thumbnail desc Thumbnail desc</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-4 col-md-3" >
                <a href="">
                    <div class="thumbnail hvr-shadow">
                        <img src="/img/test_small.jpg" alt="...">

                        <div class="caption">
                            <h3>Thumbnail label</h3>

                            <p> Thumbnail desc Thumbnail desc Thumbnail desc Thumbnail desc</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-4 col-md-3" >
                <a href="">
                    <div class="thumbnail hvr-shadow">
                        <img src="/img/test_small.jpg" alt="...">

                        <div class="caption">
                            <h3>Thumbnail label</h3>

                            <p> Thumbnail desc Thumbnail desc Thumbnail desc Thumbnail desc</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-4 col-md-3" >
                <a href="">
                    <div class="thumbnail hvr-shadow">
                        <img src="/img/test_small.jpg" alt="...">

                        <div class="caption">
                            <h3>Thumbnail label</h3>

                            <p> Thumbnail desc Thumbnail desc Thumbnail desc Thumbnail desc</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-4 col-md-3" >
                <a href="">
                    <div class="thumbnail hvr-shadow">
                        <img src="/img/test_small.jpg" alt="...">

                        <div class="caption">
                            <h3>Thumbnail label</h3>

                            <p> Thumbnail desc Thumbnail desc Thumbnail desc Thumbnail desc</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-4 col-md-3" >
                <a href="">
                    <div class="thumbnail hvr-shadow">
                        <img src="/img/test_small.jpg" alt="...">

                        <div class="caption">
                            <h3>Thumbnail label</h3>

                            <p> Thumbnail desc Thumbnail desc Thumbnail desc Thumbnail desc</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-4 col-md-3" >
                <a href="">
                    <div class="thumbnail hvr-shadow">
                        <img src="/img/test_small.jpg" alt="...">

                        <div class="caption">
                            <h3>Thumbnail label</h3>

                            <p> Thumbnail desc Thumbnail desc Thumbnail desc Thumbnail desc</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-4 col-md-3" >
                <a href="">
                    <div class="thumbnail hvr-shadow">
                        <img src="/img/test_small.jpg" alt="...">

                        <div class="caption">
                            <h3>Thumbnail label</h3>

                            <p> Thumbnail desc Thumbnail desc Thumbnail desc Thumbnail desc</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-4 col-md-3" >
                <a href="">
                    <div class="thumbnail hvr-shadow">
                        <img src="/img/test_small.jpg" alt="...">

                        <div class="caption">
                            <h3>Thumbnail label</h3>

                            <p> Thumbnail desc Thumbnail desc Thumbnail desc Thumbnail desc</p>
                        </div>
                    </div>
                </a>
            </div>

        </div>

    </div>

@stop
