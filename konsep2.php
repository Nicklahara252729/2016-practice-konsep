<!doctype html>
<html>
    <head>
        <title>Konsep 2</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/default2.css" rel="stylesheet">
        <link href="css/costumize2.css" rel="stylesheet">
        <script type="text/javascript">
            var i =1;
            function slide(){
                if(i==1){
                    document.getElementById('top-menu').style.top="0";
                    i=2;
                }else{
                    document.getElementById('top-menu').style.top="-160px";
                    i=1;
                }
            }
        </script>
    </head>
    <body>
        <div class="top c-pointer">
            <span class="glyphicon glyphicon-chevron-up"></span>
        </div>
        <div class="container-fluid no-padding">
            <div class="rows">
                <div class="jumbotron no-margin" id="jumbo"></div>
            </div>
            <div class="rows">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 z-index999 pos-fixed no-padding" id="top-menu">
                    <div class="rows">
                        <div class="container-fluid bg-abu">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 h-40">Home</div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 h-40">Jadwal</div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 h-40">Rute</div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 h-40">Kereta</div>
                        </div>
                    </div>
                    <div class="rows">
                        <div class="container mar-top-10">
                            <div class="w-40 h-40 bor-radius-50per bor-solid text-center pos-center line-40 f-20 c-pointer" onclick="slide();" id="tombol">
                                <span class="glyphicon glyphicon-chevron-down"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rows">
                <div class="container-fluid  h-80 z-index999" id="menu">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 h-100per">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">asd</div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">fas</div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7  no-padding" id="isi-menu">
                        <ul>
                            <li>Home</li>
                            <li>Jadwal</li>
                            <li>Rute</li>
                            <li>Kereta</li>
                            <li>Info</li>
                            <li>Bantuan</li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 h-60 mar-top-10" id="sosmed">
                        <ul>
                            <li>f</li>
                            <li>t</li>
                            <li>in</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container-fluid no-padding">
            <div class="carousel slide" id="slider">
                <ol class="carousel-indicators">
                    <li data-target="#slider" data-slide-to="0" class="active"></li>
                    <li data-target="#slider" data-slide-to="1"></li>
                    <li data-target="#slider" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="img/april-promo.png" class="img-responsive">
                    </div>
                    <div class="item">
                        <img src="img/booking.png" class="img-responsive">
                    </div>
                    <div class="item">
                        <img src="img/kualitas.png" class="img-responsive">    
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container-fluid padding bg-abu">
            <div class="container bor-top-dashed pad-top-10">
                <div class="rows">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-9 h-40 bg-kuning f-20 line-40 text-center">Order Here</div>
                    </div>
                </div>
                <div class="rows">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 no-padding">
                            <div class="rows">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 h-40 line-40 text-center f-20 bor-bot-dashed  bg-white">Jurusan</div>
                            </div>
                            <div class="rows">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-white pad-top-10 pad-bot-10">
                                <form>
                                    <div class="rows">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 h-40 bg-white ">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                Dari
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-19">
                                                <select name="" id="" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 h-30">
                                                <option selected disabled>- Dari -</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rows">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 h-40  bg-white ">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                Ke
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                                <select name="" id="" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 h-30">
                                                    <option selected disabled>- Ke -</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rows">
                                        <button type="submit" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 btn btn-primary mar-top-10">
                                            <span class="glyphicon glyphicon-search"></span>
                                            &nbsp; Cari
                                        </button>
                                    </div>
                                </form>
                                    </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
                            <div id="sliding" class="carousel slide">
                                <ol class="carousel-indicators">
                                    <li data-target="#sliding" data-slide-to="0" class="active"></li>
                                    <li data-target="#sliding" data-slide-to="1"></li>
                                    <li data-target="#sliding" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <img src="img/siliwangi1.png" class="img-responsive">
                                    </div>
                                    <div class="item">
                                        <img src="img/siliwangi2.png" class="img-responsive">
                                    </div>
                                    <div class="item">
                                        <img src="img/alpha.png" class="img-responsive">
                                    </div>
                                </div>
                                <a class="left carousel-control" href="#sliding" data-slide="prev">&lsaquo;</a>
                                <a class="right carousel-control" href="#sliding" data-slide="next">&lsaquo;</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container-fluid">
            <div class="container bor-top-dashed padding">
                <div class="rows">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-9 h-40 bg-pink f-20 text-center line-40">
                            More Train
                        </div>
                    </div>
                </div>
                <div class="rows">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                       <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                           <div class="rows">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                   <img src="img/alpha.png" class="img-responsive">
                               </div>
                           </div>
                           <div class="rows">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding text-center box-shadow bor-bot-pink">
                                   <blockquote>
                                       SILIWANGI I<br>
                                       Medan - Kisaran<br>
                                       Eko : Rp 25.000 -
                                   </blockquote>
                                   <button type="button" class="btn btn-primary col-lg-12 col-md-12 col-sm-12 col-xs-12">Booking</button>
                               </div>
                           </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                           <div class="rows">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                   <img src="img/alpha.png" class="img-responsive">
                               </div>
                           </div>
                           <div class="rows">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding text-center box-shadow bor-bot-pink">
                                   <blockquote>
                                       SILIWANGI I<br>
                                       Medan - Kisaran<br>
                                       Eko : Rp 25.000 -
                                   </blockquote>
                                   <button type="button" class="btn btn-primary col-lg-12 col-md-12 col-sm-12 col-xs-12">Booking</button>
                               </div>
                           </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                           <div class="rows">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                   <img src="img/alpha.png" class="img-responsive">
                               </div>
                           </div>
                           <div class="rows">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding text-center box-shadow bor-bot-pink">
                                   <blockquote>
                                       SILIWANGI I<br>
                                       Medan - Kisaran<br>
                                       Eko : Rp 25.000 -
                                   </blockquote>
                                   <button type="button" class="btn btn-primary col-lg-12 col-md-12 col-sm-12 col-xs-12">Booking</button>
                               </div>
                           </div>
                        </div>
                       <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                           <div class="rows">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                   <img src="img/alpha.png" class="img-responsive">
                               </div>
                           </div>
                           <div class="rows">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding text-center box-shadow bor-bot-pink">
                                   <blockquote>
                                       SILIWANGI I<br>
                                       Medan - Kisaran<br>
                                       Eko : Rp 25.000 -
                                   </blockquote>
                                   <button type="button" class="btn btn-primary col-lg-12 col-md-12 col-sm-12 col-xs-12">Booking</button>
                               </div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!--<div class="container-fluid">

            <div class="container">
                <div class="rows">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-9">Train Available</div>
                    </div>
                </div>
                <div class="rows">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="col-lg-3">Kereta Satu</div>
                        <div class="col-lg-3">Kereta Satu</div>
                        <div class="col-lg-3">Kereta Satu</div>
                        <div class="col-lg-3">Kereta Satu</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container-fluid">
            <div class="rows">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">content footer 1</div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">content footer 2</div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">content footer 2</div>
            </div>
            <div class="rows">
                <div class="container">
                    Copyright
                </div>
            </div>
        </div>-->
        <script src="js/jquery-2.1.4.js" type="text/javascript"></script>
        <script src="js/jquery-ui.js" type="text/javascript"></script>
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <script src="js/default2.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#slider').carousel();
            })
            $(document).ready(function(){
                $('#sliding').carousel();
            })
        </script>
    </body>
</html>