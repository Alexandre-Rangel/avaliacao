<?php
include('../includes/db.php');
$title = $_POST['title'];



?>  


							 <?php 
							 
							 

$GetList = "SELECT ID,ID_USU,URL,DATA_T,HORA_T, ID_URL, STATUS_URL, RETORNO FROM robo INNER JOIN t_url ON t_url.ID = robo.ID_URL WHERE ID_USU = $title";

$GetListCategory = mysqli_query($mysqli,$GetList);
							 
							 while($col = mysqli_fetch_assoc($GetListCategory)){ 
							 
							 
							 $Data = $col['DATA_T'];
							 $Hora = $col['HORA_T'];
							 $STATUS_URL = $col['STATUS_URL'];
							 $URL = $col['URL'];
							$RETORNO = $col['RETORNO'];	 

$dataP = explode('-', $Data);
$dataParaExibir = $dataP[2].'/'.$dataP[1].'/'.$dataP[0];							 
							 
							 
							 $Exibe = "$Hora - $dataParaExibir";
							 
							 ?>
							<tr>
							<td><?php echo $col['URL'];?></td>
							<td><?php echo $col['STATUS_URL'];?></td>
							<td><?php echo $Exibe;?></td>
								
						
							
							<td colspan="2" class="notification">
							<a href="#Detalhar<?php echo $col['ID'];?>" class="" data-toggle="modal"><span class="btn btn-info btn-xs glyphicon glyphicon-edit " data-toggle="tooltip" data-placement="left" title="" data-original-title="<?php echo $EditAccount; ?>">Detalhar</span></a>

							<a href="#EditCat<?php echo $col['ID'];?>" class="" data-toggle="modal"><span class="btn btn-primary btn-xs glyphicon glyphicon-edit " data-toggle="tooltip" data-placement="left" title="" data-original-title="<?php echo $EditAccount; ?>">Alterar</span></a>
								<a href="#DeleteCat<?php echo $col['ID'];?>"  data-toggle="modal"><span class=" glyphicon glyphicon-trash btn btn-primary btn-xs btn-danger" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo $DeleteAccounts; ?>">Excluir</span></a>			
							</td>
							</tr>
	                		  
