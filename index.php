<?php
session_start();
//1=guardados(3) 0=publicados(4)
$public="";
if($_SESSION["usr"]!=""){$public = "1";}else{$public = "0";}
?>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/star-rating.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/jQuery.js" type="text/javascript"></script>
        <script src="js/knockout.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/VTicker.js" type="text/javascript"></script>
        <script src="js/star-rating.min.js" type="text/javascript"></script>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    </head>
   <!--  <body style="background-image: url('Images/bg.png'); background-size: 10%;"> -->
   <body style="background-color: #ddd; font-family: 'Open Sans', sans-serif;">
       <div style="background-color:#333; color:#ddd; text-align: center; width: 100%;">
                <div id="news" class="container">
                    <ul style="list-style-type: none;">
                        <li>
                          &nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-save"></span><a target="blank" href="http://www.bellasartes.gob.mx/index.php/2014-01-10-22-09-57/octubre-2014/8089-1622-altar-en-memoria-de-los-periodistas-muertos-y-desaparecidos-en-2014-en-el-museo-nacional-de-san-carlos" style="color:white;"> 2014-10-28 09:30:31 - Altar en memoria de los periodistas muertos y desapare...</a>
                        </li>
                        <li>
                          &nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-save"></span><a target="blank" href="http://www.bellasartes.gob.mx/index.php/2014-01-10-22-09-57/octubre-2014/8088-1621-se-presentara-el-primer-tomo-del-catalogo-comentado-de-pintura-del-siglo-xx-del-acervo-del-munal" style="color:white;"> 2014-10-28 09:20:00 - Se presentará el primer tomo del catálogo comentado...</a>
                        </li>
                        <li>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-save"></span><a target="blank" href="http://www.bellasartes.gob.mx/index.php/2014-01-10-22-09-57/octubre-2014/8086-1620-peliculas-que-vinculan-al-acervo-del-museo-nacional-de-san-carlos-con-el-septimo-arte" style="color:white;"> 2014-10-28 09:10:00  - Películas que vinculan al acervo del Museo Nacional... </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--MENUBAR-->
            <nav class="navbar navbar-default" role="navigation" style="background-color: #F9F8F7; border-color: transparent; border-radius: 0px; box-shadow: 1px 1px 3px #888888; ">
                <div class="container">
                <div class="container-fluid">
                  <div class="navbar-header">
                      <a class="navbar-brand" href="#"><img src="Images/logo_.png" style="width: 130px; margin-top:-15px; margin-left: 0px;"/></a>
                  </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="font-family: 'Open Sans', sans-serif; font-size: 12px;">
                        <ul class="nav navbar-nav">
                            <li><a href="./index.php">INICIO</a></li>
                         <!-- <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">CONSULTAR CATÁLOGOS<span class="caret"></span></a>
                                  <ul class="dropdown-menu" role="menu" style="font-family: 'Open Sans', sans-serif; font-size: 12px;">
                                      <li><a href="#">CATÁLOGOS DEL MES</a></li>
                                      <li class="divider"></li>
                                      <li><a href="#">LO MÁS LEIDO</a></li>
                                  </ul>
                          </li> -->
                          <li><a href="#">BUSCAR CATÁLOGO</a></li>
                          <li><a href="#">ACERCA DE</a></li>
                      </ul>
                    <ul class="nav navbar-nav pull-right">
                        <?php if($_SESSION["usr"]=="") { ?>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">INICIAR SESIÓN<span class="caret"></span></a>
                          <div class="dropdown-menu" style="background-color: #ddd; width: 250px; padding: 15px; ">
                              <form role="form" action="./Login.php" method="POST">
                              <div class="form-group">
                                <input type="text" name="user" class="form-control" placeholder="Usuario" style="color:#333;">
                              </div>
                              <div class="form-group">
                                <input type="password" name="pwd" class="form-control" placeholder="Contraseña" style="color:#333;">
                              </div>
                              <button type="submit" class="btn btn-success">Ingresar</button>
                              <a href="#" style="font-size: 12px;">¿olvidé mi contraseña?</a><hr/>
                              <a href="#"><img src="Images/fb.jpg" alt="" style="width:10%;"/> Iniciar sesión con Facebook</a>
                          </form>
                          </div>
                        </li>
                            <?php } else{ ?>
                        <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">EDITOR<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu" style="background-color: #fff; font-size:12px;">
                                    <li><a href="./EditorINBA.php" style="color:#777;">CREAR CATÁLOGO</a></li>
                                  <li><a href="#" style="color:#777;">CATALOGOS GUARDADOS</a></li>
                                  <li class="divider"></li>
                                  <li><form action="./Login.php" method="POST" role="form"><input type="submit" value="&nbsp;&nbsp; CERRAR SESIÓN" class="btn btn-sm btn-danger" style="color:#777; background-color: transparent; border-color: transparent" /><input type="hidden" value="exit" name="option" /></form></li>
                                </ul>
                              </li>
                            <?php } ?>
                    </ul>
                   <!-- <form class="navbar-form navbar-left" role="search" style="margin-left: 10px;">
                      <div class="form-group">
                          <input type="text" class="form-control" placeholder="BUSQUEDA RÁPIDA..." style="width: 180px; background-color: #333; border-color: #444; font-size: 12px; font-weight: normal;">
                      </div>
                      <button type="submit" class="btn btn-danger" style="font-size: 12px; font-weight: normal;">BUSCAR</button>
                    </form> -->
                  </div>
                </div>
                </div>
              </nav>
            <div style="margin-top: -20px; background-image: url('Images/bg1.jpg'); background-position: 50%;  background-size: 100%; width: 100%; font-family: 'Open Sans', sans-serif;">
                <div class="container" style="text-align: center; background-color: transparent; width: 100%;">
                    <div class="container">
                    <br/><br/><br/><br/><br/><br/>
                    <h2 style="color:#ddd; font-family: 'Pacifico', cursive;">Ningún gran artista ve las cosas como son en realidad; si lo hiciera, dejaría de ser artista...</h2>
                    <br/><br/><br/><br/><br/>
                    </div>
                </div>
                <div style="background-color: #ddd;">
                <div class="container">
                <br/><br/>
                  <div class="row">
                    <div class="col-md-4" style="text-align: justify; color:#777;">
                        <h2>Objetivo</h2>
                        Fomentar, estimular, crear e investigar las bellas artes en las ramas de la música, las artes visuales, el teatro, la danza, la literatura y la arquitectura en todos sus géneros.<br/>
                        
                    </div>
                    <div class="col-md-4" style="text-align: justify; color:#777;">
                        <h2>Misión</h2>
                        Preservar y difundir el patrimonio artístico nacional, difundir y promover la creación de las artes e impulsar la educación e investigación artísticas con la participación de los tres niveles de gobierno y de la sociedad para mejorar la calidad de vida de los mexicanos.<br/>
                        
                    </div>
                    <div class="col-md-4" style="text-align: justify; color:#777;">
                        <h2>Visión</h2>
                        La visión del INBA para el 2014 será fortalecerse como el máximo organismo nacional responsable de la difusión y promoción de las artes, la educación e investigación artísticas, así como de la preservación y conservación del patrimonio mueble e inmueble de los siglos XX y XXI.<br/>
                        
                    </div>
                </div>
                <br/><br/>
            </div>
            </div>
            </div>
            
            <div style="background-color: #2E3959; width: 100%; height: 100%;">
            <div class="container">
                <br/><br/>
                <h1 style="color:#ddd; text-align: center; font-weigh"><span class="glyphicon glyphicon-book"></span>&nbsp;<?php if($public =="1"){ echo "CATÁLOGOS GUARDADOS"; }else{ echo "CATÁLOGOS PUBLICADOS";} ?></h1>
                <br/><br/>
                <div data-bind="foreach: Catalogs">
                    <div class="col-md-4">
                        <div class="panel panel-primary" style="border:none;">
                            <div class="panel-heading" style="background-color: #f8efc0; border:none; text-align: center;">
                                <h4 style="color:#333;"><span data-bind="text:titulo"></span></h4>
                            </div>
                            <div class="panel-body" style="background-color: #f7f7f7; color:#333; text-align: center;">
                                <img src="Images/Templates/blick05.jpg" alt="" style="width: 60%;"/>
                                <hr>
                                <?php if($public=="0") { ?>
                                <button type="button" class="btn btn-primary" data-bind="click:function(){GeneratePublicPDF($data,1);}">
                                    <span class="glyphicon glyphicon-file"></span> &nbsp; PDF
                                </button>
                                <button type="button" class="btn btn-success" data-bind="click:function(){GeneratePublicPDF($data,0);}">
                                    <span class="glyphicon glyphicon-book"></span> &nbsp; Ebook
                                </button>
                                <?php } else{ ?>
                               <button type="button" class="btn btn-danger" data-bind="click:function(){window.location='EditorINBA.php?IdCatalog='+id;}">
                                    <span class="glyphicon glyphicon-edit"></span> &nbsp; Editar
                                </button>
                                <?php } ?>
                            </div>
                            <div class="panel-footer">
                                <input id="input-id" type="number" class="rating" min=0 max=5 step=1 data-size="sm" onratechange="hola(this);"/>
                            </div>
                        </div>
                </div>                    
                </div>
            </div>    
            </div>
            <div class="footer" style="background-color: #111; color:#ddd;">
                <div class="container" style="text-align: center; padding: 10px;">
                    DERECHOS RESERVADOS - © - POLITICAS DE PRIVACIDAD
Avenida Paseo de la Reforma y Campo Marte S/N, Col. Polanco Chapultepec, Del. Miguel Hidalgo, C.P. 11560, México D.F. Tel. 5283 4600
                </div>
            </div>
            
    <!-- Modal 
            <script src="http://code.jquery.com/ui/1.8.24/jquery-ui.min.js" type="text/javascript"></script>
            <script src="js/modernizr.2.5.3.min.js" type="text/javascript"></script>
            <script src="js/EbookExt.js" type="text/javascript"></script>
    <div class="modal fade" id="Ebook" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 31%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Libro Electrónico</h4>
                </div>
                <div class="modal-body" style="margin-right: 30px;"><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

                <div id="dvSource">
                   <div class="flipbook-viewport">
                        <div class="container">
                                <div id="idFlip" class="flipbook">
                                <div id='mi1'>P1</div>
                                <div>P2</div>
                                <div>P3</div>
                                </div>
                        </div>	
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div> -->
    
        <script src="js/Functions.js" type="text/javascript"></script>
        <script>
            $(':input').on('rating.change', function(event, value, caption) {
                console.log(value);
                console.log(caption);
            });
            $(document).ready(function(){
                $('#news').vTicker();
                $('#Ebook').on('show.bs.modal', function (e) {
                    GenerateEbook();    
                });
                $('#Ebook').on('hide.bs.modal', function (e) {
                    RemoveEbook();
                });
            });
            BookViewModel = new Application.ViewModelCatalog();
            BookViewModel.LoadCatalogs(<?php echo $public; ?>);
        </script>
    </body>
</html>