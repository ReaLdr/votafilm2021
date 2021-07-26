
<?php
/*
$serverName = "WIN-5NTJ5NQD07F\SQLEXPRESS01"; //serverName\instanceName

// Puesto que no se han especificado UID ni PWD en el array  $connectionInfo,
// La conexión se intentará utilizando la autenticación Windows.
$connectionInfo = array( "Database"=>"votafilmfest","ReturnDatesAsStrings" =>"true");
//$conn = sqlsrv_connect( $serverName, $connectionInfo);
*/

///desarrollo
/*
$serverName = "145.0.40.72"; 
$connectionInfo = array( "Database"=>"votafilmfest2020", "UID"=>"user1", "PWD"=>"u53r1", "ReturnDatesAsStrings" =>"true");/**/


$serverName = "145.0.40.70"; 
$connectionInfo = array( "Database"=>"votafilmfest", "UID"=>"votafilm_db", "PWD"=>"f35tv0t4db", "ReturnDatesAsStrings" =>"true");/**/

$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
   // echo "Conexión establecida.<br />";
}else{
     echo "Conexión no se pudo establecer.<br />";
     die( print_r( sqlsrv_errors(), true));
}

define("BD_USUARIOS","usuarios2020");
define("BD_PARTICIPANTES","participantes2020");
?>