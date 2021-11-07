<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, height=device-height, user-scalable=no, initial-scale=1, minimum-scale=1, maximum-scale=1">
<title>Konsep 1</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/jquery-ui.css" rel="stylesheet">
<link href="img/nicklahara.png" rel="icon">
<link href="css/default.css" rel="stylesheet">
<link href="css/costumize.css" rel="stylesheet">
    <script type="text/javascript">
        var i=1;
        function slide(){
            if(i==1){
                document.getElementById('top-menu').style.top='0px';
                i=2;
            }else{
                document.getElementById('top-menu').style.top='-200px';
                i=1;
            }
        }
    </script>
</head>
<body>
    <div class="container-fluid no-padding bg-abu">
        <div class="rows">
            <div class="jumbotron no-margin height-200" id="jumbo"></div>
        </div>
        <div class="rows">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pos-fixed  z-index999 no-padding" id="top-menu">
                <div class="rows">
                    <div class="container-fluid bg-abu">
                        <div class="container">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 height-40">Menu 1</div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 height-40 bor-top-solid">Menu 1</div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 height-40 bor-top-solid">Menu 1</div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 height-40 bor-top-solid">Menu 1</div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 height-40 bor-top-solid">Menu 1</div>
                            </div>
                    </div>
                </div>
                <div class="rows">
                    <div class="bor-ra-50per f-20 line-h-40 border-solid pos-center text-center w-40 height-40 cursor-pointer" id="tombol" onclick="slide()">
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="rows">
            <div class="col-lg-12 col-md-12 content-menu col-sm-12 col-xs-12 no-margin bor-top-solid bor-bottom-solid no-padding">
                <div class="container-fluid height-80 no-padding">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 bg-white">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <img src="img/nicklahara.png" class="img-responsive img-100 bor-radius-50">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            Pesan Tiket
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 menu line-h-80">
                        <ul>
                            <li>Menu 1</li>
                            <li>Menu 2</li>
                            <li>Menu 3</li>
                            <li>Menu 4</li>
                            <li>Menu 5</li>
                            <li>Menu 6</li>
                        </ul>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">asd</div>
                </div>
            </div>
        </div>
        
    </div>
    
    <div class="container-fluid padding bor-bottom-solid">
        <div class="container bor-left-solid bor-right-solid bor-bottom-solid ">
            <div class="rows">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bor-top-solid bg-abu">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-9 bor-right-solid min-w-200">Content  1</div>
                </div>
            </div>
            <div class="rows">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 height-200 no-padding bor-bottom-solid bor-top-solid">
                    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12  bor-right-solid">asd</div>
                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 bg-abu">ad</div>
                </div>
            </div>
            <div class="rows">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 bor-right-solid">asd</div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 bor-right-solid">asd</div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 bor-right-solid">asd</div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">asd</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid padding bor-bottom-solid bg-abu">
        <div class="container bor-left-solid bor-right-solid">
            <div class="rows">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-9 bor-right-solid">Content 2</div>
                </div>
            </div>
            <div class="rows">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bor-top-solid no-padding">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 bor-right-solid no-padding content-2-st">
                <div class="rows">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bor-bottom-solid padding">asd</div>
                </div>
                <div class="rows">
                    <div class="col-lg-12 padding">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bor-right-solid">asd</div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">asd</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 no-padding margin-top-10 content-2-nd">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 border-solid margin-bottom-10 img-content-2-nd"><img src="../apotek/images/1.jpg" class="img-responsive"></div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 border-solid margin-bottom-10 img-content-2-nd"><img src="../apotek/images/1.jpg" class="img-responsive"></div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 border-solid margin-bottom-10 img-content-2-nd"><img src="../apotek/images/1.jpg" class="img-responsive"></div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 border-solid margin-bottom-10 img-content-2-nd"><img src="../apotek/images/1.jpg" class="img-responsive"></div>
                </div>
                </div>
            </div>
            <div class="rows">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding content-2-rd">
                <div id="myCarousel" class="carousel slide" >
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="../apotek/images/1.jpg" class="img-responsive">
                        </div>
                        <div class="item">
                            <img src="../apotek/images/1.jpg" class="img-responsive">
                        </div>
                        <div class="item">
                            <img src="../apotek/images/1.jpg" class="img-responsive">
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid padding bor-bottom-solid">
        <div class="container bor-left-solid bor-right-solid">
            <div class="rows">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-9 bor-right-solid">
                        Content-3
                    </div>
                </div>
            </div>
            <div class="rows">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bor-top-solid">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 bor-right-solid">asd</div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 bor-right-solid">asd</div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 bor-right-solid">asd</div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 bor-right-solid">asd</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid padding bg-abu">
        <div class="container bor-left-solid bor-right-solid">
            <div class="rows">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 bor-right-solid">asd</div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 bor-right-solid">asd</div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">asd</div>
                </div>
            </div>
            <div class="rows">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bor-top-solid">
                    copyright
                </div>
            </div>
        </div>
    </div>
    
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery-2.1.4.js" type="text/javascript"></script>
<script src="js/jquery-ui.js" type="text/javascript"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
<script src="js/default.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#myCarousel').carousel();
        })
    </script>
</body>
</html>