<?php  
	header("Access-Control-Allow-Origin: *");
	//$array = json_decode($_POST["json"]);

$mysqli = new mysqli("localhost", "silvercv_user2", "{SC;GzkR?}GO","silvercv_RetoCatalogarte");
if(!$mysqli) {die('Could not connect: ' . mysql_error());
return;
}



$request= '{"funcion": "IngresoUsuario",
	"Usuario": {
		"usuario":"editor1 arte Mod",
		"password":"editor1"			
    }   

}';


$request2= '{"funcion": "AgregarCatalogoFavorito",
	"Us_Catalogo": {
		"idCatalogo":3,
		"idUsuario":1			
    }   

}';


$objRequest = json_decode($request2,true);
switch ($objRequest['funcion']) {
  case 'IngresoUsuario':
		IngresoUsuario($mysqli,$objRequest['Usuario']['usuario'],$objRequest['Usuario']['password']);
    break;	
  case 'AgregarCatalogoFavorito':
  	echo	' el di insertado es '.AgregarCatalogoFavorito($mysqli,$objRequest['Us_Catalogo']['idUsuario'],$objRequest['Us_Catalogo']['idCatalogo']);
  	break;
		
  default:
    

}
function IngresoUsuario($mysqli,$user,$password){

//Seteo de parametro
$mysqli->query("SET @user_  = " . "'" . $mysqli->real_escape_string($user) . "'");
$mysqli->query("SET @pass_  = " . "'" . $mysqli->real_escape_string($password) . "'");
 //Ejecucion de SP
$result =$mysqli->query("CALL SP_IngresoUsuario(@user_,@pass_)");
if(!$result) die("CALL failed: (" . $mysqli->errno . ") " . $mysqli->error);
$Usuario;
if($result->num_rows > 0) 
{
while($row = $result->fetch_object())
{

 $Usuario['nombre'] =$row->Nombre;
  $Usuario['apellidos'] =$row->Apellidos;
   $Usuario['perfil'] =$row->Perfil;
}
   
}
else {

    // No rows returned
}
return json_encode($Usuario);

	$result->close();
$mysqli->next_result();
return $idAutor;//

}

function AgregarCatalogoFavorito($mysqli,$idUsuario,$idCatalogo){
echo $idUsuario.$idCatalogo;
//Seteo de parametro
$mysqli->query("SET @idUsuario_= " . "'" . $mysqli->real_escape_string($idUsuario) . "'");
$mysqli->query("SET @idCatalogo_= " . "'" . $mysqli->real_escape_string($idCatalogo) . "'");
$mysqli->query("SET @idInsertado= 0");
 //Ejecucion de SP
 

$result =$mysqli->query("CALL SP_AgregarCatalogoFavorito(@idCatalogo_, @idUsuario_,@idInsertado)");
if(!$result) die("CALL failed: (" . $mysqli->errno . ") " . $mysqli->error);
//Ejecucion de parametros de salida
if (!($res = $mysqli->query("SELECT @idInsertado AS idInsertado")));
$row = $res->fetch_assoc();
if(!$result) die("CALL failed: (" . $mysqli->errno . ") " . $mysqli->error);

   return $row ['idInsertado'] ;
}

?>