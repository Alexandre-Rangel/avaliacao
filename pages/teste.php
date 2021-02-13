<?php
session_start();

$UserId = $_SESSION['UserId'];
$Usuario = $_SESSION['Usuario'];
include('includes/db.php');


if ($UserId === '') {

    header('location: /index.php');
    exit;
}


if (isset($_POST['salvar'])) {



    $URL    = $mysqli->real_escape_string($_POST["URL"]);


    $sql = "INSERT INTO t_url (ID_USU,URL ) VALUES (?,?)";
    if ($statement = $mysqli->prepare($sql)) {
        //bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
        $statement->bind_param('ss', $UserId, $URL);
        $statement->execute();
    }
}

if (isset($_POST['Excluir'])) {
    $ID_DELETA = $_POST['ID_DELETA'];
    //echo("**************** $ID_DELETA ");
    $Delete = "DELETE FROM robo WHERE ID_URL = $ID_DELETA";
    $DeleteI = mysqli_query($mysqli, $Delete);

    $msgBox = alertBox('Exclusão Efetuada');
}


if (isset($_POST['Alterar'])) {
    $Alterar_id = $_POST['Alterar_id'];



    $Alterar_URL    = $mysqli->real_escape_string($_POST["Alterar_URL"]);

    $sql = "UPDATE t_url SET URL = ?  WHERE ID = $Alterar_id";
    if ($statement = $mysqli->prepare($sql)) {
        $statement->bind_param('s', $Alterar_URL);
        $statement->execute();
    }
}




$GetList = "SELECT ID,ID_USU,URL,DATA_T,HORA_T, ID_URL, STATUS_URL, RETORNO FROM robo INNER JOIN t_url ON t_url.ID = robo.ID_URL WHERE ID_USU = $UserId";

$GetListCategory = mysqli_query($mysqli, $GetList);

//$GetList = "
//SELECT ID,ID_USU,URL,DATA_T,HORA_T, ID_URL, STATUS_URL FROM robo INNER JOIN t_url ON t_url.ID = //robo.ID_URL WHERE ID_USU = $UserId";

//$GetListCategory = mysqli_query($mysqli,$GetList);



?>






<!doctype html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">




    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <style>
        .navbar-default {
            background-color: #b8e378;
            border-color: #09bef5;
        }
    </style>




    <div class="headmain">
        <div class="navbar-header">

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <img class="navbar-brand" src="https://www.widepay.com/tpl/themes/widepay/assets/images/logo-wide-pay.svg" alt="some text" width="172" height="77">


        </div>




        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">




            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <strong>
                        <font color="White" size="3"><?php echo "Usuário: $Usuario"; ?></font>
                    </strong> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="index.php?action=logout"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->
    </div>












    <nav class="navbar-default" id="navbar">
        <div class="container-fluid">

        </div>
    </nav>



</head>

<body class="text-center">
    </br>



    <div class="container">
        <div class="row">
            <div class="col-md-1">

                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#MyModal">Inserir URL </button>
            </div>
        </div>
    </div>

    <td colspan="2" class="notification">





        <table class="table table-bordered table-hover table-striped" id="menu_table">
            <thead>
                <tr>
                    <th class="text-left"><?php echo 'Url'; ?></th>
                    <th class="text-left"><?php echo "Status"; ?></th>
                    <th class="text-left"><?php echo "Data e Hora "; ?></th>

                    <th class="text-left"><?php echo $Action; ?></th>

                </tr>
            </thead>
            <tbody>

            <tbody id="listateste">

            </tbody>



            <?php


            while ($col = mysqli_fetch_assoc($GetListCategory)) {

                $ID = $col['ID'];
                $Data = $col['DATA_T'];
                $Hora = $col['HORA_T'];
                $STATUS_URL = $col['STATUS_URL'];
                $URL = $col['URL'];
                $RETORNO = $col['RETORNO'];

                $dataP = explode('-', $Data);
                $dataParaExibir = $dataP[2] . '/' . $dataP[1] . '/' . $dataP[0];


                $Exibe = "$Hora - $dataParaExibir";

            ?>
                <tr>
                    <td class="s_url"><?php echo $URL; ?> </td>
                    <td class="s_status"><?php echo $STATUS_URL; ?><?php ?></td>
                    <td><?php echo $Exibe; ?></td>



                    <td colspan="2" class="notification">
                        <a href="#Detalhar<?php echo $col['ID']; ?>" class="" data-toggle="modal"><span class="btn btn-info btn-xs glyphicon glyphicon-edit " data-toggle="tooltip" data-placement="left" title="" data-original-title="<?php echo $EditAccount; ?>">Detalhar</span></a>

                        <a href="#EditCat<?php echo $col['ID']; ?>" class="" data-toggle="modal"><span class="btn btn-primary btn-xs glyphicon glyphicon-edit " data-toggle="tooltip" data-placement="left" title="" data-original-title="<?php echo $EditAccount; ?>">Alterar</span></a>
                        <a href="#DeleteCat<?php echo $col['ID']; ?>" data-toggle="modal"><span class=" glyphicon glyphicon-trash btn btn-primary btn-xs btn-danger" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo $DeleteAccounts; ?>">Excluir</span></a>
                    </td>
                </tr>




                </tbody>

                <div class="modal fade" id="Detalhar<?php echo $col['ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel"><?php echo "$RETORNO"; ?></h4>
                            </div>
                            <div class="modal-body">

                                <?php echo "<a href='$URL'>Clique aqui para acessar</a>"; ?>

                            </div>
                            <div class="modal-footer">

                                <input type="hidden" name="ID_DELETA" value="<?php echo $col['ID']; ?>" />

                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>




                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>




                <div class="modal fade" id="DeleteCat<?php echo $col['ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="" method="post">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel"><?php echo 'Excluir esse URL?'; ?></h4>
                                </div>
                                <div class="modal-body">
                                    <?php echo $col['URL']; ?>
                                </div>
                                <div class="modal-footer">

                                    <input type="hidden" name="ID_DELETA" value="<?php echo $col['ID']; ?>" />
                                    <button type="input" name="Excluir" class="btn btn-primary">Excluir</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>



                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <!-- /.edit category -->
                <div class="modal fade" id="EditCat<?php echo $col['ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="" method="post">
                                <div class="modal-header">

                                    <h4 class="modal-title" id="myModalLabel">Alterar URL</h4>
                                    <!--nome de cima-->
                                </div>
                                <div class="modal-body">


                                    <div class="form-group col-lg-12">
                                        <input class="form-control" required name="Alterar_URL" i type="text" value="<?php echo $col['URL']; ?>">
                                    </div>




                                </div>
                                <div class="modal-footer">

                                    <input type="hidden" name="Alterar_id" value="<?php echo $col['ID']; ?>" />
                                    <button type="input" name="Alterar" class="btn btn-primary">Alterar</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->



            <?php } ?>

            <tfoot>
                <tr>
                    <th class="text-left"><?php echo 'Url'; ?></th>
                    <th class="text-left"><?php echo "Status"; ?></th>
                    <th class="text-left"><?php echo "Data e Hora "; ?></th>

                    <th class="text-left"><?php echo $Action; ?></th>
                </tr>
            </tfoot>
        </table>


        <div id="MyModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title">Inserir</h4>
                    </div>

                    <form action="" method="post">
                        <div class="modal-body">

                            <div class="form-group col-lg-12">
                                <input class="form-control" style="color:#ff0000;" placeholder="URL" required onblur="UrlValido(this,value)" name="URL" id="URL" type="text">
                            </div>




                        </div>
                        <div class="modal-footer">
                            <button type="input" name="salvar" class="btn btn-primary">Salvar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>















        <input class="form-control" value="<?php echo $UserId ?>" name="REF_ID" id="REF_ID" type="hidden">
</body>

<!-- Importando o jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- Importando o js do bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>



<script type="text/javascript">
    function UrlValido() {
        var str = document.getElementById("URL").value;
        var regex = new RegExp("^(http[s]?:\\/\\/(www\\.)?|ftp:\\/\\/(www\\.)?|www\\.){1}([0-9A-Za-z-\\.@:%_\+~#=]+)+((\\.[a-zA-Z]{2,3})+)(/(.)*)?(\\?(.)*)?");

        if (regex.test(str)) {
            document.getElementById("URL").style.color = "#8e8af7";

        } else {

            document.getElementById("URL").style.color = "#f00000";
            alert('URL Invalida');
            document.getElementById("URL").focus();
        }
    }
</script>






</html>