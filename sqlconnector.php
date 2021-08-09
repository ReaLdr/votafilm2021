
<?php
// $serverName = "145.0.40.72";
// $connectionInfo = array( "Database"=>"votafilmfest2020", "UID"=>"user1", "PWD"=>"u53r1", "ReturnDatesAsStrings" =>"true");


$serverName = "145.0.40.70";
$connectionInfo = array( "Database"=>"votafilmfest2021", "UID"=>"votafilmfest2021_db", "PWD"=>"Hydia68%#", "ReturnDatesAsStrings" =>"true");

$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
    //echo "Conexión establecida en: $serverName || votafilmfest2021.<br />";
}else{
     echo "Conexión no se pudo establecer.<br />";
     die( print_r( sqlsrv_errors(), true));
}

define("BD_USUARIOS","usuarios2021");
define("BD_PARTICIPANTES","participantes2021");
?>
