function GeneratePDF2(ViewModel){
    request = {"funcion": "convertirHtmlaPdf","htmlCatalogo":""};
    $.each(JSON.parse(ko.toJSON(ViewModel.Pages)),function(i,field){
        request.htmlCatalogo = request.htmlCatalogo + "<page>" + field.Page + "</page>"; 
    });
    return request;
}
function GeneratePDF(ViewModel){
    request = {"funcion": "convertirHtmlaPdf","htmlCatalogo":""};
    $.each(ViewModel.Catalogo.paginas,function(i,field){
        request.htmlCatalogo = request.htmlCatalogo + "<page>" + field.Page + "</page>"; 
    });
     return request;
}
function GenerateEbook(ViewModel){
    request = "";
    $.each(ViewModel.Catalogo.paginas,function(i,field){
        request = request + "<div>" + $('<div>').append($('#inline1',field.Page).css({width: 'auto',height: '100%'}).clone()).html() + "</div>";
    });
     return request;
}
function GetCatalogById(IdCatalog){
    $.getJSON("js/Struct.json",function(json){ struct = json[1]; struct.idCatalogo = IdCatalog;
    $.ajax({
                type: "POST",
                url: "http://recatalogarte.com/PhpFunctions/FuncionesCatalogo_.php",
                //dataType: "json",
                data: ko.toJSON(struct),
                success:function(data){
                    var d = JSON.parse(data.replace("\"[","[").replace("]\"","]"));
                    LoadCatalog(d);
                },
                error: function(data){
                    console.log(data);
                    alert("mal: "+ko.toJSON(data));
                }
            });
    });
};

//READ CATALOGS
var Application = (function (Application) {
    Application.ViewModelCatalog = function() {
        var self = this;
        self.Catalogs = ko.observableArray([]);
        self.Pages = ko.observableArray([]);
        self.LoadCatalogs = function (value){
           $.getJSON("js/Struct.json",function(json){
               var val;
               if(value=="0"){val = json[4]; }else{val = json[3]}
               $.ajax({
                       type: "POST",
                       url: "http://recatalogarte.com/PhpFunctions/FuncionesCatalogo_.php",
                       //dataType: "json",
                       data: ko.toJSON(val),
                       success:function(data){
                           //console.log(data);
                           self.Catalogs = JSON.parse(data);
                           //console.log(ko.toJSON(self.Catalogs));
                           ko.applyBindings(self);
                       },
                       error: function(data){
                           alert("algo sali¨® mal: " + data);
                           console.log(data);
                       }
                });
           });

        };
    };

    return Application;
}(Application || {}));

function Catalog(id,tittle,date,description,path, name)
{
    this.id = id;
    this.titulo = tittle;
    this.fecha = date;
    this.resumen = description;
    this.rutaPdf = path;
    this.nombre = name;
};
function GeneratePublicPDF(DataContext,isPDF){
     $.getJSON("js/Struct.json",function(json){ struct = json[1]; struct.idCatalogo = DataContext.id;
    $.ajax({
                type: "POST",
                 url: "http://recatalogarte.com/PhpFunctions/FuncionesCatalogo_.php",
                //dataType: "json",
                data: ko.toJSON(json[1]),
                success:function(data){
                    //CREATE FORM AND SUBMIT
                    var d = JSON.parse(data.replace("\"[","[").replace("]\"","]"));
                    var request;
                    var form = document.createElement("form");
                    var element1 = document.createElement("input");
                    form.method = "POST";
                    if(isPDF===0){
                        request = GenerateEbook(d);
                        form.action = "Libroelectronico.php";
                        element1.value = request;
                    }else{
                        request = GeneratePDF(d);
                        form.action = "http://recatalogarte.com/PhpFunctions/ConvertidorPhp.php";
                        element1.value=ko.toJSON(request);
                    }
                    element1.name="json";
                    form.appendChild(element1);  
                    document.body.appendChild(form);
                    form.submit();
                },
                error: function(data){
                    //alert("mal: "+ko.toJSON(data));
                    console.log(data);
                }
            });
    });
}

      