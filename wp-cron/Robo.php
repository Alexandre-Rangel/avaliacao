<?php
date_default_timezone_set('America/Sao_Paulo');
$dbuser="u715969733_root";	
$dbpassword = "Root1234"; 			
$dbname = "u715969733_bd"; 		
$dbhost="mysql.hostinger.com.br";

$mysqli = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);

$GetList = "SELECT ID,ID_USU,URL from t_url ";

$GetListCategory = mysqli_query($mysqli,$GetList);
							 
							 while($col = mysqli_fetch_assoc($GetListCategory)){ 
							 
						$ID =  $col['ID'];
						$ID_USU =  $col['ID_USU'];
						$URL =  $col['URL'];
						
						

$responseHeaders = get_headers($URL, 1);




				
$campo1 = $responseHeaders[0];
if ($campo1 != '') 
{
$Rcampo1 = 'On Line';
}	else
{
$Rcampo1 = 'Off Line';
}	

$Data_Atual = date("d-m-Y");


         $dataP = explode('-', $Data_Atual);
    $Data = $dataP[2].'-'.$dataP[1].'-'.$dataP[0];



$Hora = date('H:i:s');



	$sql="UPDATE robo SET DATA_T = ?,HORA_T = ? ,STATUS_URL = ?,RETORNO = ?  WHERE ID_URL = $ID";

		if($statement = $mysqli->prepare($sql)){
			//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
			$statement->bind_param('ssss',$Data,$Hora,$Rcampo1,$campo1);	
			$statement->execute();



		}




							 }					
						
						
						