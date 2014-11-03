<?php  
	header("Access-Control-Allow-Origin: *");


$mysqli = new mysqli("localhost", "silvercv_user2", "{SC;GzkR?}GO","silvercv_RetoCatalogarte");
if(!$mysqli) {die('Could not connect: ' . mysql_error());
return;
}



$request2='{
  "funcion": "ObtenerCatalogoPorId",
	"idCatalogo": "57"
}';


$request3='{
  "funcion": "ObtenerCatalogosPublicadosPorAutor",
	"Catalogo": {
		"idUsuario":3
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

$request6= '{"funcion": "EliminarAutor",
	"Catalogo": {
		"id":"103",
		"nombreAutor":"Jo",
		"apellidosAutor":"DOe"		
    }   

}';





$json = file_get_contents('php://input');

$objRequest = json_decode($request3,true);



switch ($objRequest['funcion']) {
  case 'ObtenerCatalogosPublicadosPorAutor':
	ObtenerCatalogosPublicadosPorAutor($mysqli,$objRequest['Autor']);
    break;

  default:
    

}

function ObtenerCatalogosPublicadosPorAutor($mysqli,$idUsuario){

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





?>