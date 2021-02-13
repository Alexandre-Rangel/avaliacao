<?php
$campo = $_GET['campo'];

$tipo = $_GET['tipo'];


$url = $campo;

if (filter_var($url, FILTER_VALIDATE_URL)) {
  $Situacao = 'On';
} else {
  $Situacao = 'Off';
}


if ($tipo == 'verifica_url')
{

$json = array();	 

   $dados = array(
    'STATUS' => "$Situacao",
	'url' => "$url"
  );
$json = $dados;

  
      echo json_encode($json);
}

   

   

?>

