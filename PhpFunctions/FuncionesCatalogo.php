<?php  
		header("Access-Control-Allow-Origin: *");
	header('Content-Type: application/json');

$mysqli = new mysqli("localhost", "silvercv_user2", "{SC;GzkR?}GO","silvercv_RetoCatalogarte");
if(!$mysqli) {die('Could not connect: ' . mysql_error());
return;
}


$request='{
  "funcion": "CrearCatalogo",
	"Catalogo": {
		"titulo":"Titulo1",
		"fecha":"2014-10-15 00:00:00",
		"resumen":"Resumen 2",
		"ebook": "este es el html completo ",
		"paginas":"este es el json de cada pagina",
		"idMuseo":1,
		"publicado":true,
		"idCatalogo":-1,
		"idUsuario":1,
		"rutaPdf":"ruta",
		"Autor":[
			{"nombre":"Jo", "apellidos":"Doe","id":1}, 
			{"nombre":"An", "apellidos":"Smith","id":-1}, 
			{"nombre":"au 3", "apellidos":"apellido autor 3","id":2}
		]
    }
    

}';

$request2='{
  "funcion": "ObtenerCatalogoPorId"",
	"idCatalogo": 123
}';


$request3='{
  "funcion": "ObtenerCatalogosGuardados",
	"Catalogo": {
		"idUsuario":1
    }
	}' ;

$request4= '"funcion": "GuardarCatalogo",
	"Catalogo": {
		"titulo":"Titulo Actualizado 1",
		"fecha":"2014-10-15 00:00:00",
		"resumen":"Resumen actualizado 1",
		"ebook": "este es el html completo Actualizado 1",
		"paginas":"este es el json de cada pagina Actualizado 1",
		"idMuseo":1,
		"publicado":true,
		"idCatalogo":57,
		"idUsuario":1,
		"rutaPdf":"ruta Actualizada 1"	
    }   

}';

$request5= '{"funcion": "AgregarAutor",
	"Catalogo": {
		"id":"103",
		"nombreAutor":"Nuevo autor 103",
		"apellidosAutor":"apellido de nuevo autor 103"		
    }   

}';

$request6= '[{"funcion": "<form id=\"DynamicBox\" data-bind=\"submit: SavePage\">","TempId":"","Params":[{"name":"tittle","value":"HELLO"},{"name":"description","value":"z"}],
	"Catalogo": {
		"id":"103",
		"nombreAutor":"Jo",
		"apellidosAutor":"DOe"		
    }   

}]';

$request7='{"funcion":"CrearCatalogo","Catalogo": {
		"titulo":"Titulo1",
		"fecha":"2014-10-15 00:00:00",
		"resumen":"Resumen 2",
		"ebook": "este es el html completo ",
		"paginas":"este es el json de cada pagina",
		"idMuseo":1,
		"publicado":true,
		"idCatalogo":1,
		"idUsuario":1,
		"rutaPdf":"ruta",
		"Autor":[
			{"nombre":"Jo", "apellidos":"Doe","id":1}, 
			{"nombre":"An", "apellidos":"Smith","id":-1}, 
			{"nombre":"au 3", "apellidos":"apellido autor 3","id":2}
		]
    },
    "Paginas":[{"id":0,
"Page":"<form id=\"DynamicBox\" data-bind=\"submit: SavePage\">",
"TempId":"",
"Params":[{"name":"tittle","value":"HELLO"},{"name":"hola","value":"velu1"}]
          },{"id":2,
"Page":"<form id=\"DynamicBox\" data-bind=\"submit: SavePage\">",
"TempId":"",
"Params":[{"name":"tittle","value":"HELLO"},{"name":"hola","value":"velu1"}]
          }]
}';

$request8= '{"funcion": "GuardarImagenes",
	"Catalogo": {
		"imagenes":[
			{"imagen":"data:image/jpeg;base64,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","idImagen":1},
			{"imagen":"data:image/png;base64,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X542Z97/f2Y2HTUcCtHgaro+yxw/t34A6ggpgP+0fdk8r8ti9lQeHx7KdDotD49PZbZYlpdtfvz3z13Df4E5AlwSIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQ+h9OaCdW3kXmdwAAAABJRU5ErkJggg==","idImagen":2} 
		],
		"idCatalogo":1
    }   
}';
$request9= '{"funcion": "ObtenerImagenes",
	"Catalogo": {
		"imagenes":[
			{"imagen":"data:image/jpeg;base64,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","idImagen":1},
			{"imagen":"data:image/png;base64,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X542Z97/f2Y2HTUcCtHgaro+yxw/t34A6ggpgP+0fdk8r8ti9lQeHx7KdDotD49PZbZYlpdtfvz3z13Df4E5AlwSIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQ+h9OaCdW3kXmdwAAAABJRU5ErkJggg==","idImagen":2} 
		],
		"idCatalogo":1
    }   
}';
//$imagen='data:image/png;base64,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X542Z97/f2Y2HTUcCtHgaro+yxw/t34A6ggpgP+0fdk8r8ti9lQeHx7KdDotD49PZbZYlpdtfvz3z13Df4E5AlwSIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQElIAAAAhIQUAABASUgAAACEhBQAAEBJSAAAAISEFAAAQ+h9OaCdW3kXmdwAAAABJRU5ErkJggg==';   
//$imagen2="data:image/jpeg;base64,/9j/4AAQSkZJRgABAgAAAQABAAD//gAEKgD/4gIcSUNDX1BST0ZJTEUAAQEAAAIMbGNtcwIQAABtbnRyUkdCIFhZWiAH3AABABkAAwApADlhY3NwQVBQTAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA9tYAAQAAAADTLWxjbXMAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAApkZXNjAAAA/AAAAF5jcHJ0AAABXAAAAAt3dHB0AAABaAAAABRia3B0AAABfAAAABRyWFlaAAABkAAAABRnWFlaAAABpAAAABRiWFlaAAABuAAAABRyVFJDAAABzAAAAEBnVFJDAAABzAAAAEBiVFJDAAABzAAAAEBkZXNjAAAAAAAAAANjMgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAB0ZXh0AAAAAEZCAABYWVogAAAAAAAA9tYAAQAAAADTLVhZWiAAAAAAAAADFgAAAzMAAAKkWFlaIAAAAAAAAG+iAAA49QAAA5BYWVogAAAAAAAAYpkAALeFAAAY2lhZWiAAAAAAAAAkoAAAD4QAALbPY3VydgAAAAAAAAAaAAAAywHJA2MFkghrC/YQPxVRGzQh8SmQMhg7kkYFUXdd7WtwegWJsZp8rGm/fdPD6TD////bAEMACQYHCAcGCQgICAoKCQsOFw8ODQ0OHBQVERciHiMjIR4gICUqNS0lJzIoICAuPy8yNzk8PDwkLUJGQTpGNTs8Of/bAEMBCgoKDgwOGw8PGzkmICY5OTk5OTk5OTk5OTk5OTk5OTk5OTk5OTk5OTk5OTk5OTk5OTk5OTk5OTk5OTk5OTk5Of/CABEIAIEAiAMAIgABEQECEQH/xAAbAAEAAgMBAQAAAAAAAAAAAAAABAUCAwYBB//EABkBAQADAQEAAAAAAAAAAAAAAAABAwQCBf/EABkBAQADAQEAAAAAAAAAAAAAAAABAwQCBf/aAAwDAAABEQIRAAAB5sAAAAAAAAAA9PHZ4HH5d7uPn8rprY+fRexoOua1s19QFfYACyrb8uKmHh6/n3krjJuPR2OVSyaNMWDJvqqNezC6sMWkAD3suV6rqOa1+V3o47PouV6WY6WDFh+Xu8oegq++a7drymIwr7AA6q+05FRbwbU5u6qOhInM9fy5BlaNJhjhu9rzYeOzX5O8K+2WItcawX8vlNkxbXPNY6qOji0G/LfLxx8iazZLg31e+FNgRIAAI8y8X1ydGKJ2bI/tNkqJ74AAAAAAAAAAAAAAAAAAAAf/xAAqEAACAQMDAgUEAwAAAAAAAAABAgMABBEFEhMgIhUhMDEyEBQjMyRQYP/aAAgBAAABBQL+pwaWN3Is7g1Jbyxj0k0+ALdwQQ28ECRxHai6cPxVfnLPCMyAA9enx8l1PeCKSe65Wg1FWk1B9ttEoji5EqVt803xfzbr0+GXZkszUBuNvAZp/Crem0y1VVzbGZslxg4x1z/xtP3imYYQVpid1XjYgCgq52HeWph29NsyLOdRtmF4IN1Ry1a31vDF4na1PdRXDZ2rEMxOvHI57enSIvx7RUAE1/xR1qiJgW0IH20FXMCtMbhjEBgSnvUZDDaei3j4oZn4otNTZbV+7V6Y7VSrtQ7o7Rk+ZX2f5/UHaRqNyKmvZZoo9TKqNUFWd2kEg1O3qe+geJPY91xN+pkK1HJj0YxltgrjAoqaimeOoTmp/Y+3pbnFCV65FIyaBNcm5n+P+I//xAAhEQACAgEEAwEBAAAAAAAAAAABAgMRABAgITESEzAUQP/aAAgBAhEBPwH7M3iLxHDixtad74yOXnxOkxpDkGwixWeisiQ+znRkDd4qqvXxkbm8QkqL2E0Lz9KYCD1o0StuMSnI4wnX8/8A/8QAJBEAAgEDBAEFAQAAAAAAAAAAAQIDAAQREBIgITATFDJAQWH/2gAIAQERAT8B8yJvO2pIzGcHilpHt7FS2+BuXS1XdKKuv7wU4Oa93uFTyj0cDRJGT407u/beGFOgKlADkDgqljgUbKWmUqcHRLhlonPfFbh1/ammMuM/X//EADEQAAEDAgQCCAUFAAAAAAAAAAEAAhEDIRASMUEwURMgIjIzYYGRQlBikqEEQHFygv/aAAgBAAAGPwL5Tooa0leEVLmRwxmbJ3unFtNuY2Ca3KJhF0CydUOr3TgxnqpVuA3k26yZZTOzAaZhZKgy8iiBq6ya2RYLvt904i4wPANVtQMai464SmNzGN1rU90SQ+31K96R/CEcEM8oWoWuD3+mBHOygiQiGt7IMKIHXY6p3QZUHMR/VZv0+aNwdsIcsrnHNvZd8/amtpumETyV/iQ5dd1Q72WgVZ8DKzsheGz7VSpMY0Oe7YKOiZ7LwWeyd0UMLdITqT2xU0/lQirqOqxnIJ7+QQJ1f2sPKi3AnkpTGLLU02dieoCNQu8D6LI7LHkEG9E2B5q9L8qq+o1xdUOoXxj/ACi1j+0fLB30iE7CCp4EThqtFBEtTjuSmjmeJZxV74aypCGbb9lHzj//xAAoEAEAAgIBAwMEAgMAAAAAAAABABEhMUFRcYEQIGEwUPDxQNGhweH/2gAIAQAAAT8h+0iaT4jBMbo1ALjaEPpAqAWsvUp8k2BQVyzALZNcwsCBeovML0fABaHxtd4br3+hnpyfH/Y+tZvMe7zU3KGL8mPMTZEMqeUG4ns/GC+NAkwp1jtQ2+8L6YbLUIpG02soS4XMoY/JxLm2RfqlwyZL31wLASruL8TLbc59wW0blbDNG/LuB/3Ryoq43MU7AKenWxkVOJwxxrEMclmgKvg91iWcouIRRsdpTUHpY7JZ1hmTzKt1rpefv0pVLLZUQroXDwbyUlOy79oN8mfcAMZ0voT9NL6xaMX+XP1ycz3xGvxgTACtYt/TjOVK0GJ/iBCKAcFS74sQEpcXkdPZvBPIt35hq8z5j7VK/wBejj/c/H0FPQuXbW1uaFOVeZTu4FY9X0HfwY9j4Ulk2HdGPqic4IuyAClOY+JtRB6BEb80XNcNKIIdmCuQvGIVdqRdmusW16n3JcqUNlckX6w0FOYa7xux071APK1OkUIsn6XlO3ogDodoJ5prTKaoCWbC+pFJAU3FT+f4FvWW1lj7x//aAAwDAAABEQIRAAAQ888888888844sgz58888R70Ku888YJ5hUt888cQEpYt18somf3Fhd888v904U88888888888888888888//EAB8RAQACAAcBAQAAAAAAAAAAAAEAERAgITAxQVFAkf/aAAgBAhEBPxDeJF1mAKVtJaOXHwt04rJceol8wVxxgHRuaaa2FqIoexg5VkNl1B/fyC2rMBKYFFGRB0Z10tTt8/8A/8QAIREBAAIBAwQDAAAAAAAAAAAAAQARIRAgMTBAQVFhgZH/2gAIAQERAT8Q6zCEF97u4hmazljqePXxpQfWfyJChm9lei6gqAI+7lxozaqVqL0AVogDTgnF6LsJ8zBeB+5RGnRMSIledgo2Thotx47f/8QAKBABAAIBAgUEAgMBAAAAAAAAAQARITFBUWFxgaEQILHBMJFQ0fDh/9oACAEAAAE/EP4nwhJmjLeq9XCDAA8UPuWeVoXd/EzZFAbsMA5sqmmcdYCkA6zoYvvLcQhirut6xxE3hoFxwWYNahg+/RzHCFzcH3FSZ6ggHtCRDFi1v9wbLPfQrLseOD4QHnxRUFzUTBtqvc0tqJsfA2s7cHWIl3BvL4JRAOKDNZ8zzcB9wupRyxA28xAblM6WDX6mg2995wzXIFHYv4iI2kas3Gm8TJLsWrqudxM1ejtFlK26rXxAqCq3sdIvaEalOMNcaBkzFV5yDGkiq06e5AC00HFhwtRhjUXLNzBVdkMsVAs5lBhrTBNzcvwelVNCe7b4IqENIYYnq9i6m0GKlBYtkKOIO3uDFiG81kx1qFCugkHMuLzgtGm1ruuW0OEHrKkCbF+YPcHdDOlJrivRB8NVqrcYHWaiBfYuCQQljW2Fndghb1TBEUB7kdk617j5fEs374n+pTKcq2tTjTZd4rqvX+mVIiKQGNQvXwh/cVm5rnU1JIXVApyatOd5jGqi1YFy/rtC08X6TBnFIHQDjMUppVriewFAKuAN4RwCJzrPks2SN50wfupqEMVqOPAvv6Cpd2v96+HpjaW+xc41pdVuIilBTA2+4ZZpAWJzm+9jDR55mOcHh/32NSANQ0jZrKj/ADLaV7mUyabDXS/iVcJoFBRMF7W+yYBIKJYtZTd8E0P3z4WL+o45FzlK0lIxNxQD1cv3EUDQw3cEHGjMmp1lTe2o0nO4fPuDVAmM51ph4AC8iYxa8LhqUVKHIS6j7YTUQyUOoL0P1GG8wnBOiW+hrAFaAuYfhTcRxVM3AObFSvUp5lDgFxIFADVQWVpo0sHvEtKAHCvxO2B+WvSq0x0ihSnrN+N7Dh/Mf//Z";

  $objRequest =json_decode($request3,true);
 //$objRequest[0]['funcion']=json_encode($objRequest[0]['funcion']);

switch ($objRequest['funcion']) {
  case 'ObtenerMuseos':
	ObtenerMuseos($mysqli,$objRequest);
    break;
	case 'ObtenerCatalogosGuardados':
	ObtenerCatalogosGuardados($mysqli,$objRequest['Catalogo']['idUsuario']);
    break;
	case 'ObtenerCatalogosPublicados':
	ObtenerCatalogosPublicados($mysqli,$objRequest['Catalogo']['idUsuario']);
    break;
  case 'CrearCatalogo':
  	CrearCatalogo($mysqli,$objRequest,$request7);
    break;
  case 'ObtenerCatalogoPorId':
		ObtenerCatalogo($mysqli,$objRequest['idCatalogo']);
		break;
 case 'AgregarAutor':
		AgregarAutor($mysqli,$objRequest['Catalogo']['nombreAutor'],$objRequest['Catalogo']['apellidosAutor'],$objRequest['Catalogo']['id']);
		break;
case 'EliminarAutor':
		EliminarAutor($mysqli,$objRequest['Catalogo']['nombreAutor'],$objRequest['Catalogo']['apellidosAutor'],$objRequest['Catalogo']['id']);
		break;
  case 'GuardarCatalogo':
		GuardarCatalogo($mysqli,$objRequest);
		break;
case 'GuardarImagenes':
		  GuardarImagenes($objRequest);
		break;
  default:
    

}
function GuardarImagenes($objRequest){

foreach ($objRequest['Catalogo']['imagenes'] as $imagenes){


list($type, $imagenes['imagen']) = explode(';', $imagenes['imagen']);
list(, $imagenes['imagen'])      = explode(',', $imagenes['imagen']);
$imagenes['imagen'] = base64_decode($imagenes['imagen']);
file_put_contents($objRequest['Catalogo']['idCatalogo'].$imagenes['idImagen'].'.png', $imagenes['imagen']);
$i=$i+1;
}


// '<img src="data:image/jpg;base64,'.base64_encode($imgbinary).'" />';  
}

function CargarImagenes($objRequest){
$img_src =$objRequest['Catalogo'];  
$imgbinary = fread(fopen($img_src, "r"), filesize($img_src));  
$img_str = base64_encode($imgbinary);  
echo $img_str;
}


function EliminarAutor($mysqli,$nombre,$apellidos,$idCatalogo){


//Llenado de Parametros
$mysqli->query("SET @nombre_  = " . "'" . $mysqli->real_escape_string($nombre) . "'");
$mysqli->query("SET @apellidos_   = " . "'" . $mysqli->real_escape_string($apellidos) . "'");
$mysqli->query("SET @idCatalogo_   = " . "'" . $mysqli->real_escape_string($idCatalogo) . "'");
$mysqli->query("SET @idInsertado= 0");

 //Ejecucion de SP
$result =$mysqli->query("CALL SP_EliminarAutorPorNombreApellidosIdCatalogo(@nombre_, @apellidos_,@idCatalogo_)");
if(!$result) die("CALL failed: (" . $mysqli->errno . ") " . $mysqli->error);


}


function AgregarAutor($mysqli,$nombre,$apellidos,$idCatalogo){

		$idAutor=ObtenerIdAturoPorNombreApellidos($mysqli,$nombre,$apellidos);
//Si el autor es nuevo
	if($idAutor<1){
		$idAutor=InsertarAutor($mysqli,$nombre,$apellidos);
		$idCatalogo_Autor=InsertarCatalogo_Autor($mysqli,$idAutor, $idCatalogo);	
		
	}
	else{
	
	$idCatalogo_Autor=InsertarCatalogo_Autor($mysqli,$idAutor, $idCatalogo);	
		
	}
}

function GuardarCatalogo($mysqli,$objRequest){

$titulo=$objRequest['Catalogo']['titulo'];
$fecha=$objRequest['Catalogo']['fecha'];
$resumen=$objRequest['Catalogo']['resumen'];
$ebook=$objRequest['Catalogo']['ebook'];
$rutaPdf=$objRequest['Catalogo']['rutaPdf'];
$idMuseo=$objRequest['Catalogo']['idMuseo'];
$publicado=$objRequest['Catalogo']['publicado'];
$paginas=$objRequest['Catalogo']['paginas'];
$idCatalogo=$objRequest['Catalogo']['idCatalogo'];
//Seteo de parametro
$mysqli->query("SET @titulo_  = " . "'" . $mysqli->real_escape_string($titulo) . "'");
$mysqli->query("SET @fecha_   = " . "'" . $mysqli->real_escape_string($fecha) . "'");
$mysqli->query("SET @resumen_  = " . "'" . $mysqli->real_escape_string($resumen) . "'");
$mysqli->query("SET @ebook_  = " . "'" . $mysqli->real_escape_string($ebook) . "'");
$mysqli->query("SET @paginas_   = " . "'" . $mysqli->real_escape_string($paginas) . "'");
$mysqli->query("SET @rutaPdf_  = " . "'" . $mysqli->real_escape_string($rutaPdf) . "'");
$mysqli->query("SET @idMuseo_  = " . "'" . $mysqli->real_escape_string($idMuseo) . "'");
$mysqli->query("SET @publicado_   = " . "'" . $mysqli->real_escape_string($publicado) . "'");
$mysqli->query("SET @idCatalogo_   = " . "'" . $mysqli->real_escape_string($idCatalogo) . "'");
$mysqli->query("SET @idInsertado= 0");
 //Ejecucion de SP

 
$result =$mysqli->query("CALL SP_GuardarCatalogo(@titulo_, @fecha_, @resumen_,@ebook_,@paginas_,@rutaPdf_,@idMuseo_,@publicado_,@idCatalogo_)");
if(!$result) die("CALL failed: (" . $mysqli->errno . ") " . $mysqli->error);
}

function ObtenerCatalogo($mysqli,$idCatalogo){

$mysqli->query("SET @idCatalogo_  = " . "'" . $mysqli->real_escape_string($idCatalogo) . "'");

 //Ejecucion de SP
$result =$mysqli->query("CALL SP_ObtenerCatalogoporId(@idCatalogo_)");
if(!$result) die("CALL failed: (" . $mysqli->errno . ") " . $mysqli->error);

$Autores = array();
 
	if($result->num_rows > 0){
			$i=0;
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
		{	
			if($i==0){
			$b='[{"id":0,"Page":"<form id=\"DynamicBox\" data-bind=\"submit: SavePage\">",
					"TempId":"","Params":[{"name":"tittle","value":"HELLO"},{"name":"description","value":"z"}]}]';
	
				//$row["paginas"];
	
	
				$Catalogo['Catalogo']['titulo']  = $row["titulo"];
				$Catalogo['Catalogo']['resumen'] = $row["resumen"];
				$Catalogo['Catalogo']['ebook'] = $row["ebook"];
				$c=json_decode($b,true);
		$Catalogo['Catalogo']['Paginas']=$c;
				}
			

				//echo $Catalogo['Catalogo']['paginas'] ;
					//echo $row["paginas"];
	
				$Catalogo['Catalogo']['publicado'] = $row["publicado"];
				$Catalogo['Catalogo']['idCatalogo'] = $row["idCatalogo"];
				$Catalogo['Catalogo']['idUsuario'] = $row["idUsuario"];
				$Catalogo['Catalogo']['rutaPdf'] = $row["ruta"];
				$Catalogo['Catalogo']['Autor'][$i]['nombre']=$row["nombreAutor"];
				$Catalogo['Catalogo']['Autor'][$i]['apellidos']=$row["apellidosAutor"];
	
    // array_push($Catalogos,$Catalogo);
			
				$i=$i+1;
	}
}
else {
    // No rows returned
}
//echo $Catalogo['Catalogo']['paginas'][0]['id'];
//echo $Catalogo['Catalogo'];
//echo $Catalogo['Catalogo']['Params'][0]['value'];
//echo $Catalogo['Catalogo']['Autor'][0]['nombre'];
//echo json_encode($Catalogo);
		
	//	$Catalogo['Catalogo']['idUsuario']='hola';

	//echo $Catalogo[0]['Params'][0]['name'];
		echo $a=json_encode($Catalogo,true) ;
	
	//echo $Catalogo['Catalogo']['resumen'];
}
function CrearCatalogo($mysqli,$objrequest,$cadena){
//Se verifica que autores se deben insertar y se procede a insertarlos recorer cada uno.
//Se inserta el autor en caso de ser necesario
//$mysqli->autocommit(FALSE);


	$idCatalogo=InsertaCatalogo($mysqli,$objRequest,$cadena);
	foreach ($objRequest['Catalogo']['Autor'] as $Autores){
	$nombre=$Autores['nombre'];
	$apellidos=$Autores['apellidos'];
	$idAutor=ObtenerIdAturoPorNombreApellidos($mysqli,$nombre,$apellidos);
//Si el autor es nuevod
	if($idAutor<1){
		$idAutor=InsertarAutor($mysqli,$Autores['nombre'],$Autores['apellidos']);
		$idCatalogo_Autor=InsertarCatalogo_Autor($mysqli,$idAutor, $idCatalogo);	
	}
	else{
	
	$idCatalogo_Autor=InsertarCatalogo_Autor($mysqli,$idAutor, $idCatalogo);	
	}
	}

}


function ObtenerCatalogosGuardados($mysqli,$idUsuario){

$mysqli->query("SET @idUsuario_  = " . "'" . $mysqli->real_escape_string($idUsuario) . "'");
 //Ejecucion de SP
$result =$mysqli->query("CALL SP_ObtenerCatalogosGuardados(@idUsuario_)");
if(!$result) die("CALL failed: (" . $mysqli->errno . ") " . $mysqli->error);
$Catalogos = array();
if($result->num_rows > 0) 
{
while($row = $result->fetch_object())
{
 $Catalogo['id'] =$row->id;
 $Catalogo['titulo'] =$row->titulo;
 $Catalogo['fecha'] =$row->fecha;
 $Catalogo['resumen'] =$row->resumen;
  $Catalogo['rutaPdf'] =$row->rutaPdf;
 $Catalogo['nombre'] =$row->nombre;
  array_push($Catalogos,$Catalogo);
}
   
}
else {


    // No rows returned
}


	$result->close();
$mysqli->next_result();

echo json_encode($Catalogos);
return json_encode($Catalogos);//

}
function ObtenerCatalogosPublicados($mysqli,$idUsuario){

 //Ejecucion de SP
$result =$mysqli->query("CALL SP_ObtenerCatalogosPublicados()");
if(!$result) die("CALL failed: (" . $mysqli->errno . ") " . $mysqli->error);
$Catalogos = array();
if($result->num_rows > 0) 
{
while($row = $result->fetch_object())
{
 $Catalogo['id'] =$row->id;
 $Catalogo['titulo'] =$row->titulo;
 $Catalogo['fecha'] =$row->fecha;
 $Catalogo['resumen'] =$row->resumen;
  $Catalogo['rutaPdf'] =$row->rutaPdf;
 $Catalogo['nombre'] =$row->nombre;
  array_push($Catalogos,$Catalogo);
}
   
}
else {


    // No rows returned
}

	$result->close();
$mysqli->next_result();
echo json_encode($Catalogos);
return;


}


function ObtenerIdAturoPorNombreApellidos($mysqli,$nombre,$apellidos){

$idAutor=0;


//Seteo de parametro
$mysqli->query("SET @nombre_  = " . "'" . $mysqli->real_escape_string($nombre) . "'");
$mysqli->query("SET @apellidos_  = " . "'" . $mysqli->real_escape_string($apellidos) . "'");
 //Ejecucion de SP
$result =$mysqli->query("CALL SP_ObtenerIdAturoPorNombreApellidos(@nombre_,@apellidos_)");
if(!$result) die("CALL failed: (" . $mysqli->errno . ") " . $mysqli->error);

if($result->num_rows > 0) 
{
while($row = $result->fetch_object())
{

 $idAutor =$row->id;
}
   
}
else {
    // No rows returned
}

	$result->close();
$mysqli->next_result();	$result->close();
$mysqli->next_result();
return $idAutor;//


}



function ObtenerMuseos($mysqli){

$result = $mysqli->query("CALL SP_ObtenerMuseos()");
if(!$result) die("CALL failed: (" . $mysqli->errno . ") " . $mysqli->error);

$Museos = array();
 
if($result->num_rows > 0) 
{

    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $Museo['id']  = $row["id"];
        $Museo['nombre'] = $row["Nombre"];
     array_push($Museos,$Museo);
    }
}
else {
    // No rows returned
}
return json_encode($Museos);

}


function InsertarCatalogo_Autor($mysqli,$idAutor, $idCatalogo){

$mysqli->query("SET @idAutor_= " . "'" . $mysqli->real_escape_string($idAutor) . "'");
$mysqli->query("SET @idCatalogo_= " . "'" . $mysqli->real_escape_string($idCatalogo) . "'");
$mysqli->query("SET @idInsertado= 0");
 //Ejecucion de SP
$result =$mysqli->query("CALL SP_InsertarCatalogo_Autor(@idAutor_, @idCatalogo_,@idInsertado)");
if(!$result) die("CALL failed: (" . $mysqli->errno . ") " . $mysqli->error);
//Ejecucion de parametros de salida
if (!($res = $mysqli->query("SELECT @idInsertado AS idInsertado")));
$row = $res->fetch_assoc();
return $row ['idInsertado'] ;
}


//Insertar autor
function InsertarAutor($mysqli,$nombre,$apellidos){


//Llenado de Parametros
$mysqli->query("SET @nombre_  = " . "'" . $mysqli->real_escape_string($nombre) . "'");
$mysqli->query("SET @apellidos_   = " . "'" . $mysqli->real_escape_string($apellidos) . "'");
$mysqli->query("SET @idInsertado= 0");

 //Ejecucion de SP
$result =$mysqli->query("CALL SP_InsertarAutor(@nombre_, @apellidos_,@idInsertado)");

if(!$result) die("CALL failed: (" . $mysqli->errno . ") " . $mysqli->error);
//Ejecucion de parametros de salida

if (!($res = $mysqli->query("SELECT @idInsertado AS idInsertado")));
$row = $res->fetch_assoc();
return $row ['idInsertado'] ;


}
//Se inserta el catalogo
function InsertaCatalogo($mysqli,$objRequest,$cadena)
{
echo 'Paso';
$idUsuario=$objRequest['Catalogo']['idUsuario'];
$titulo=$objRequest['Catalogo']['titulo'];
$fecha=$objRequest['Catalogo']['fecha'];
$resumen=$objRequest['Catalogo']['resumen'];
$ebook=$objRequest['Catalogo']['ebook'];
$rutaPdf=$objRequest['Catalogo']['rutaPdf'];
$idMuseo=$objRequest['Catalogo']['idMuseo'];
$publicado=$objRequest['Catalogo']['publicado'];
$paginas=$cadena;
//Seteo de parametro
$mysqli->query("SET @titulo_  = " . "'" . $mysqli->real_escape_string($titulo) . "'");
$mysqli->query("SET @fecha_   = " . "'" . $mysqli->real_escape_string($fecha) . "'");
$mysqli->query("SET @resumen_  = " . "'" . $mysqli->real_escape_string($resumen) . "'");
$mysqli->query("SET @ebook_  = " . "'" . $mysqli->real_escape_string($ebook) . "'");
$mysqli->query("SET @paginas_   = " . "'" . $cadena. "'");
$mysqli->query("SET @rutaPdf_  = " . "'" . $mysqli->real_escape_string($rutaPdf) . "'");
$mysqli->query("SET @idMuseo_  = " . "'" . $mysqli->real_escape_string($idMuseo) . "'");
$mysqli->query("SET @publicado_   = " . "'" . $mysqli->real_escape_string($publicado) . "'");
$mysqli->query("SET @idUsuario_  = " . "'" . $mysqli->real_escape_string($idUsuario) . "'");
$mysqli->query("SET @idInsertado= 0");
 //Ejecucion de SP

$result =$mysqli->query("CALL SP_InsertarCatalogo(@titulo_, @fecha_, @resumen_,@ebook_,@paginas_,@rutaPdf_,@idMuseo_,@publicado_,@idUsuario_,@idInsertado)");
if(!$result) die("CALL failed: (" . $mysqli->errno . ") " . $mysqli->error);
//Ejecucion de parametros de salida
if (!($res = $mysqli->query("SELECT @idInsertado AS idInsertado")));
$row = $res->fetch_assoc();

if(!$result) die("CALL failed: (" . $mysqli->errno . ") " . $mysqli->error);

   return $row ['idInsertado'] ;
}


?>