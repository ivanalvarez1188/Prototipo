<?php  
	header("Access-Control-Allow-Origin: *");
	require("../config/database.php");


/*Ejemplo peticions de cada funcion
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
  "funcion": "ObtenerCatalogoPorId",
	"idCatalogo": "57"
}';


$request3='{
  "funcion": "ObtenerCatalogosPublicados",
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

$request6= '{"funcion": "EliminarAutor",
	"Catalogo": {
		"id":"103",
		"nombreAutor":"Jo",
		"apellidosAutor":"DOe"		
    }   

}';


*/

//$objRequest =  json_decode($_POST["request"],true);

$json = file_get_contents('php://input');

$objRequest = json_decode($json,true);

//$objRequest['Catalogo']['paginas'];


switch ($objRequest['funcion']) {
  case 'ObtenerMuseos':
	ObtenerMuseos($mysqli,$objRequest);
    break;
	case 'ObtenerCatalogosGuardados':
	ObtenerCatalogosGuardados($mysqli,$objRequest['Catalogo']['idUsuario']);
    break;
	case 'ObtenerMuseos':
	ObtenerMuseos($mysqli,$objRequest);
    break;
	case 'CrearCatalogo':
	CrearCatalogo($mysqli,$objRequest,$json);
    break;
	case 'ObtenerCatalogosPublicados':
	ObtenerCatalogosPublicados($mysqli);
    break;
  case 'objRequest':
  	CrearCatalogo($mysqli,$objRequest,$json);
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
		
  default:
    

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

echo '1';
return;
}

function ObtenerCatalogo($mysqli,$idCatalogo){
$Resultado;
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
		
				
			
			//	$Catalogo['Catalogo']['titulo']  = $row["titulo"];
			//	$Catalogo['Catalogo']['resumen'] = $row["resumen"];
			//	$Catalogo['Catalogo']['ebook'] = $row["ebook"];
				}
			
			//$b='[{"id":0,"Page":"<form id=\"DynamicBox\" data-bind=\"submit: SavePage\">","TempId":"","Params":[{"name":"tittle","value":"HELLO"},{"name":"description","value":"z"}]}]';
				//$b=	$row["paginas"];
				//$c=json_decode($b,true);
				//$Catalogo['Catalogo']['Paginas']=$b;
				//echo $Catalogo['Catalogo']['paginas'] ;
					//echo $row["paginas"];
	
			//	$Catalogo['Catalogo']['publicado'] = $row["publicado"];
				//$Catalogo['Catalogo']['idCatalogo'] = $row["idCatalogo"];
				//$Catalogo['Catalogo']['idUsuario'] = $row["idUsuario"];
				//$Catalogo['Catalogo']['rutaPdf'] = $row["ruta"];
				//$Catalogo['Catalogo']['Autor'][$i]['nombre']=$row["nombreAutor"];
				//$Catalogo['Catalogo']['Autor'][$i]['apellidos']=$row["apellidosAutor"];
	
    // array_push($Catalogos,$Catalogo);
			$Resultado=$row["paginas"];
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
		
	echo $Resultado;
	return;
}
function CrearCatalogo($mysqli,$objRequest,$json){
//Se verifica que autores se deben insertar y se procede a insertarlos recorer cada uno.
//Se inserta el autor en caso de ser necesario
//$mysqli->autocommit(FALSE);

	$idCatalogo=InsertaCatalogo($mysqli,$objRequest,$json);

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

echo $idCatalogo;
return;
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

echo json_encode($Catalogos);//
return;

}
function ObtenerCatalogosPublicados($mysqli){

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
return;//

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
echo json_encode($Museos);
return;

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
function InsertaCatalogo($mysqli,$objRequest,$json)
{

$idUsuario=$objRequest['Catalogo']['idUsuario'];
$titulo=$objRequest['Catalogo']['titulo'];
$fecha=$objRequest['Catalogo']['fecha'];
$resumen=$objRequest['Catalogo']['resumen'];
$ebook=$objRequest['Catalogo']['ebook'];
$rutaPdf=$objRequest['Catalogo']['rutaPdf'];
$idMuseo=$objRequest['Catalogo']['idMuseo'];
$publicado=$objRequest['Catalogo']['publicado'];
$paginas=$objRequest['Catalogo']['paginas'];

//Seteo de parametro
$mysqli->query("SET @titulo_  = " . "'" . $mysqli->real_escape_string($titulo) . "'");
$mysqli->query("SET @fecha_   = " . "'" . $mysqli->real_escape_string($fecha) . "'");
$mysqli->query("SET @resumen_  = " . "'" . $mysqli->real_escape_string($resumen) . "'");
$mysqli->query("SET @ebook_  = " . "'" . $mysqli->real_escape_string($ebook) . "'");
$mysqli->query("SET @paginas_   = " . "'" .$json. "'");
$mysqli->query("SET @rutaPdf_  = " . "'" . $mysqli->real_escape_string($rutaPdf) . "'");
$mysqli->query("SET @idMuseo_  = " . "'" . $mysqli->real_escape_string($idMuseo) . "'");
$mysqli->query("SET @publicado_   = " . "'" . $mysqli->real_escape_string($publicado) . "'");
$mysqli->query("SET @idUsuario_  = " . "'" . $mysqli->real_escape_string($idUsuario) . "'");
$mysqli->query("SET @idInsertado= 0");
 //Ejecucion de SP

$result =$mysqli->query("CALL SP_InsertarCatalogo(@titulo_, @fecha_, @resumen_,@ebook_,@paginas_,@rutaPdf_,@idMuseo_,@publicado_,@idUsuario_,@idInsertado)");
//Ejecucion de parametros de salida
if (!($res = $mysqli->query("SELECT @idInsertado AS idInsertado")));
$row = $res->fetch_assoc();

if(!$result) die("CALL failed: (" . $mysqli->errno . ") " . $mysqli->error);

   return $row ['idInsertado'] ;
}


?>