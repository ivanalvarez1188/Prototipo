<?php
session_start();
if($_SESSION["usr"]==""){  header( 'Location: ./Index.php' ); }
$IdCatalog = $_REQUEST['IdCatalog'];
?>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/jQuery.js" type="text/javascript"></script>
        <script src="http://code.jquery.com/ui/1.8.24/jquery-ui.min.js" type="text/javascript"></script>
        <script src="js/knockout.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/Functions.js" type="text/javascript"></script>
        <script src="js/ckeditor/ckeditor.js" type="text/javascript"></script>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <style>
            #dvLoading
            {
               background:#3a314c url(Images/load.png) no-repeat center center;
               background-size: 300px;
               height: 100%;
               width: 100%;
               position: fixed;
               z-index: 1000;;
            }
        </style>
    </head>
    <!-- <body style="background-image: url('Images/bg.png'); background-size: 10%; font-family: 'Open Sans', sans-serif; font-size: 12px;"> -->
    <body style="background-color: #ddd; text-align: center; width: 100%; font-family: 'Open Sans', sans-serif; font-size: 12px;">
            <div id="dvLoading"></div>
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
                    
        <div class="container" id="Container">
        <div class="row"><br/>
            <div class="col-md-2">
                <div class="panel" style="background-color: #222328; color:white; border:none;">
                    <div class="panel-heading" style='color:#999;'>PLANTILLAS</div>
                    <div class="panel-body" style="background-color:#292929; text-align: center;">
                        <div class="btn-group-vertical">
                            <button onclick="OnSelectedOption('0')" type="button" class="btn btn-default"><img src="Images/Templates/Plantilla1Portada.jpg" alt="" style="width: 100px;"/></button>
                            <button onclick="OnSelectedOption('1')" type="button" class="btn btn-default"><img src="Images/Templates/Plantilla1HojaLegal.jpg" alt="" style="width: 100px;"/></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-primary" style="border: none; background-color: #353535; color:#999;">
                    <div class="panel-heading" style="background-color: #222328;">
                        <div class="col-md-10" style="margin-top: 15px; font-size: 14px; color:#999"> <span class="glyphicon glyphicon-certificate"></span> &nbsp;&nbsp; NUEVO CATÁLOGO</div>
                        <div class="col-md-2"><button type="submit" class="btn btn-success" style="margin-top: 8px; margin-left: -40px;" data-toggle="modal" data-target="#SaveCat">Guardar catálogo</button></div><hr>
                    </div>
                    <br/>
                    <br/>
                    
                    <div class="panel-body" style='margin-top:-40px; margin-left: 15px;'> <!-- <div id='texto'><h3>SELECCIONE UNA PÁGINA</h3></div> -->
                        <div id="HtmlCode" data-bind="html: WorkArea, valueUpdate: 'afterkeydown'" contenteditable='true'>
                        <!-- LOAD HTML CODE -->                           
                        </div>
                        <script>
                            function WorkAreahandleDragOver(evt) {
                                evt.stopPropagation();
                                evt.preventDefault();
                                evt.dataTransfer.dropEffect = 'copy';
                            }
                            function WorkAreahandleFileSelect(evt){
                            }
                            var WorkAreaDropZone = document.getElementById('HtmlCode');
                            WorkAreaDropZone.addEventListener('dragover', WorkAreahandleDragOver, false);
                            WorkAreaDropZone.addEventListener('drop', WorkAreahandleFileSelect, false);
                           
                            
                        </script>
                        
                    </div>
                    <div class="panel-footer" style='background-color: #222328;'>
                        <div class="row" style="white-space:nowrap;">
                            <div class="col-md-1">
                                <button type="button" class="btn btn-primary btn-lg" data-bind="click: AddPage()"><span class="glyphicon glyphicon-plus"></span></button>
                                <button type="button" class="btn btn-primary btn-lg" id='BtnSubmit' data-bind="click: function(){SavePage($('#DynamicBox'));}"><span class=" glyphicon glyphicon-floppy-disk"</span></button>
                               <!-- <form id="PdfExport" action="http://recatalogarte.com/PhpFunctions/ConvertidorPhp.php" method="POST">
                                    <button class="btn btn-primary">Exportar PDF</button>
                                    <input id="json" name="json" type="hidden"/>
                                </form> -->
                                
                            </div>
                            <div class="col-md-10" style="overflow: auto; margin-left: 50px;">
                            <div class="btn-group">
                                <div data-bind="foreach: Pages">
                                    <button type="button" class="btn btn-default" data-bind="click: function () { GetPageByIndex(id); }">
                                        <img src="Images/page.png" alt="" style="width: 150px;"/>
                                    </button>
                                    <!-- PAGES TIMELINE -->
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="panel" style="background-color: #222328; color:white; border:none;">
                    <div class="panel-heading" style='color:#999;'>IMÁGENES</div>
                    <div class="panel-body" style="background-color:#292929; text-align: center;">
                        <style>
                            .drop_zone {
                                border: 2px dashed #bbb;
                                -moz-border-radius: 5px;
                                -webkit-border-radius: 5px;
                                border-radius: 5px;
                                padding: 25px;
                                text-align: center;
                                color: #bbb;
                            }
                            .thumb {
                                max-width:100%;
                                max-height:100%;
                                border: 1px solid #000;
                                margin: 10px 5px 0 0;
                            }
                        </style>
                        <div id="drop_zone" class="drop_zone"><div id="t">Arrastre sus imágenes aquí</div>
                            <output id="list"></output>
                        </div>
                        <script>
                            function handleFileSelect(evt) {
                                $('#drop_zone').removeClass("drop_zone");
                                $('#t').remove();
                                evt.stopPropagation();
                                evt.preventDefault();
                                var files = evt.dataTransfer.files;
                                for (var i = 0, f; f = files[i]; i++) {
                                    //VERIFICA QUE SOLO SE TRATEN DE IMAGENES
                                    if (!f.type.match('image.*')) {continue;}
                                    //BUFFER DE IMAGEN
                                    var reader = new FileReader();
                                    //EVENTO PARA CARGA DE ARCHIVO
                                    reader.onload = (function(theFile) {
                                        //REMOVE STYLE
                                        return function(e) {                                          
                                            var span = document.createElement('span');
                                            span.setAttribute("id","img"+i);
                                            span.innerHTML = ['<img class="thumb" src="', e.target.result,
                                                          '" title="', escape(theFile.name),'" />'].join('');
                                            document.getElementById('list').insertBefore(span, null);
                                        };
                                    })(f);
                                    //LEER IMAGEN COMO DATA URL
                                    reader.readAsDataURL(f);
                                }
                            }

                            function handleDragOver(evt) {
                                evt.stopPropagation();
                                evt.preventDefault();
                                evt.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
                            }

                            // Setup the dnd listeners.
                            var dropZone = document.getElementById('drop_zone');
                            dropZone.addEventListener('dragover', handleDragOver, false);
                            dropZone.addEventListener('drop', handleFileSelect, false);
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>        
        <!-- SAVE CATALOG FORM -->
        <div class="modal fade" id="SaveCat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="text-align:left;">
  <div class="modal-dialog">
    <div class="modal-content">
        <form id="FrmCatalog">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Guardar</h4>
      </div>
      <div class="modal-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre de catálogo:</label>
                <input type="text" class="form-control" id="CatTittle" placeholder="Ingrese titutlo..." required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Autor(es):</label>
                <input type="text" class="form-control" id="CatAuthor" placeholder="Ingrese autor(es)..." required>
            </div>
                <textarea id="CatDescription" class="form-control" rows="3" placeholder="Descripción de catálogo..."></textarea>
            <div class="checkbox">
                <label>
                    <input id="CatIsPublished" type="checkbox" data-bind="checked:IsPublished"> <b>Publicar catálogo</b>
                </label>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button id="BtnSubmit" type="submit" class="btn btn-primary">Guardar</button>
      </div>
        </form>
    </div>
  </div>
</div>
    <script>
        $(window).load(function(){
            //THREAD PAUSE...
 	  $('#dvLoading').delay(500).fadeOut(500);
 	});
        var selectedOption="";
        var jsonTemplate="";
        var jsonStruct="";
        var jsonData = "";
        var counter = 0;
        var editable = 0;
        var struct;

        function LoadCatalog(viewModel){
            //alert(ko.toJSON(viewModel.Catalogo.paginas[0].Page));
                $.each(viewModel.Catalogo.paginas,function(i,field){
                    //alert(field.id+" "+field.Page+" "+field.TempId);
                    BookViewModel.Pages.push(new Page(field.id,field.Page,field.TempId));
                    //INCREMENT COUNTER

                    counter++;
                });
                //SELECTED ONE
        }
        function OnSelectedOption(idRef)
        {
            selectedOption=idRef;
        }
        function GetAuthors(value){
            var arg = value.split(";");
            var array = [];
            $.each(arg,function(i){
                if($.trim(arg[i])===""){return;}
                if(arg[i].substring(0,1) === " ") {arg[i] = arg[i].substring(1,arg[i].length);}
                array.push({"nombre":arg[i]});
            });
            return array;
        }
        $(document).ready(function(){
            $.getJSON("js/Templates.json",function(json){
                jsonTemplate = json;
            });
            $.getJSON("js/Struct.json",function(json){
                jsonStruct = json[0];
            });
            $("#FrmCatalog").submit(function(e){
                $('#BtnSubmit').attr('disabled', 'disabled');
                jsonStruct["Catalogo"].titulo = $("#CatTittle").val();
                jsonStruct["Catalogo"].fecha = new Date($.now());
                jsonStruct["Catalogo"].resumen = $("#CatDescription").val();
                jsonStruct["Catalogo"].Autor = GetAuthors($("#CatAuthor").val());
                jsonStruct["Catalogo"].paginas = ko.toJSON(BookViewModel.Pages);
                jsonStruct["Catalogo"].publicado = BookViewModel.IsPublished;
                $.ajax(
                {
                    type: "POST",
                    url: "http://recatalogarte.com/PhpFunctions/FuncionesCatalogo_.php",
                    //dataType: "json",
                    data: ko.toJSON(jsonStruct),
                    success:function(data){
                        //alert("todo ok: " + data);
                        console.log(data);
                        $('#BtnSubmit').removeAttr('disabled');
                        $('#SaveCat').modal('hide')
                    },
                    error: function(data){
                        alert("algo salió mal: " + data);
                        console.log(data);
                        $('#BtnSubmit').removeAttr('disabled');
                    }
                });
                e.preventDefault(); //STOP default action
            });
            $("#PdfExport").submit(function(){
                var value = GeneratePDF2(BookViewModel);
                $('#json').val(JSON.stringify(value));
            });
            if(<?php echo "'".$IdCatalog."'" ?> !==""){
                GetCatalogById(<?php echo "'".$IdCatalog."'" ?>);
            }
        });
        function Page(name,obj, template )
        {
            this.id = name;
            this.Page = obj;
            this.TempId = template;
            this.Params = "";
        };
        
        LoadPage = function(id){
            //LOAD PAGE WITH VALUES
            BookViewModel.WorkArea(jsonTemplate[id].Html);
            //$.each(BookViewModel.Pages()[id].Params, function(i, field){
            //    $('#'+field.name).val(field.value);
            //});
        };
        GetPageByIndex = function(id){
            if(editable === 0){
                BookViewModel.WorkArea(BookViewModel.Pages()[id].Page);
            }
            else{
                alert("Necesita guardar la página");
            }
        };
        var BookViewModel = {
            IsPublished : ko.observable(false),
            WorkArea: ko.observable(),
            jsonSave: ko.observableArray([]),
            //COLLECTION
            Pages : ko.observableArray([]),
            
            AddPage : function () {
                if(selectedOption !== "" && editable === 0){
                    editable = 1;
                    //LOAD VIEW HTML CONTENT
                    LoadPage(selectedOption);
                    //ADD PAGE TO TIMELINE
                    BookViewModel.Pages.push(new Page(counter,BookViewModel.WorkArea,selectedOption));
                    //alert(ko.toJSON(BookViewModel.Pages));
                    //RESET SELECTED TEMPLATE
                    selectedOption="";      
                    //INCREMENT COUNTER
                    counter++;
                    //alert(ko.toJSON(BookViewModel.Pages));
                    //jsonData = ko.toJSON(BookViewModel);
                    
                    //NO SE PUEDE HACER NUEVAMENTE BINDING SOBRE ESTE ELEMENTO MAS DE UNA VEZ
                    ko.applyBindings(BookViewModel, document.getElementById("DynamicBox"));
                }
            },
            SavePage: function(formElement) {
                $(formElement).find('#BtnSubmit').remove();
                //INSERT PARAMETER INTO PAGE OBJECT
                editable = 0;
                alert(counter);
                BookViewModel.Pages()[counter-1].Params = $(formElement).serializeArray();
                //BookViewModel.jsonSave.push($(formElement).serializeArray());
                //CONVERT INPUTS TO DIVS (SEARCH ID AND CONVERT)
                
                $.each(BookViewModel.Pages()[counter-1].Params, function(i, field){
                    $('#'+field.name).replaceWith(function(){
                        return "<br/><br/><br/>"+field.value+"<br/><br/><br/><br/>";
                    });
                });
                BookViewModel.WorkArea($("#HtmlCode").html());
                BookViewModel.Pages()[counter-1].Page = BookViewModel.WorkArea();
                                   // $.each(BookViewModel.Pages()[0].Params, function(i, field){
                        //$('#'+field.name).replaceWith(function(){
                          //return '<div>HELLO</div>';  
                        //});
                    //});
               // $.each(BookViewModel.Pages()[0].Page, function(ii, fieldd){
                 //   alert(fieldd);
               // });
                //$.each(BookViewModel.Pages()[0].Params, function(i, field){
                    //$('#'+field.name).replaceWith(function(){
                        //'<div id=#'+field.name+'>HOLA</div>';
                        //$('#'+field.name).val(field.value);
                    //});
                  //  alert(field.name);
                //});
                //alert(ko.toJSON(BookViewModel.Pages()[0].Page));
                //alert(ko.toJSON(BookViewModel.Pages));
                //$.each(arg, function(i, field){
                    //$(field.name).val(field.value);
                  //  $(field.name).val(field.value);
                //});
                //$('#DynamicBox').clone().appendTo("#Clones");
                //alert($("#Clones").html());
                //alert($(formElement).serialize());
            }
        };
        ko.applyBindings(BookViewModel);
        //GetPageByIndex(0);
        $('#hola').click(function(){
            //$clone = $("#HtmlCode").clone();
            //$clone.appendTo("body");
            
            //alert(jsonData);
            //alert(BookViewModel.WorkArea());
            //alert(BookViewModel.name());
        });
        /*
        var viewModel = {
            Tittle : ko.observable("Tittle"),
            imagePath : ko.observable("imagePath"),
            Description : ko.observable("Description")
        };
        //JSON DATA
        var jsonData = ko.toJSON(viewModel);
        //JS SERTIALIZATION
        var plainJs = ko.toJS(viewModel);
        
        $('#hola').click(function(){
            alert(jsonData);
        });
     */
        
    /*    
    $(document).ready(function(){
            $('#hola').click(function(){
                alert(json);
            });
            var json="";
             var ViewModel = function(Tittle, Description, Image) {
    this.tittle = ko.observable(Tittle);
    this.description = ko.observable(Description);
    this.imagePath = ko.observable(Image);
    //ARRAY
    this.items = ko.observableArray(json);
    //ADD
    this.addPage = function(){
        this.items.push(this.tittle());
    }.bind(this);
    
    this.fullHtml5 = ko.pureComputed(function() {
        return this.items();
    }, this);
};
ko.applyBindings(new ViewModel("", "","Images/Templates/NoImage.png"));

            $('#hola').click(function(){
                ViewModel.tittle;
            });
        });
    contenedor con valor de html debe ser observable para que vaya guardando lo que se escribe.
    NO ES POSIBLE AÑADIR OTRA NUEVA PAGINA HASTA NO HABER GUARDADO LA PAGINA ANTERIOR
        */
    </script>
</body>
</html>