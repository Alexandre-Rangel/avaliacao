
<?php session_start();
//require_once dirname(__FILE__) . '\includes\Funcoes.php';
// Cek Active Link

	function ActiveClass($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri)
        echo 'class="active"';
}
	$yy = $_SESSION['UserId'];


	
		//check already login
		if (!isset($_SESSION['UserId'])) {
			header ('Location: Login.php');
			exit;
		}else
		{
			$page = 'teste';
		}

		// Logout
		if (isset($_GET['action'])) {
			$action = $_GET['action'];
			if ($action == 'logout') {
				session_destroy();
				header('Location: Login.php');
			}
		}





if (isset($_GET['page']) && $_GET['page'] == 'Inicio') {
            $page = 'Inicio';
        } else if (isset($_GET['page']) && $_GET['page'] == 'b') {
            $page = "b";
        } else if (isset($_GET['page']) && $_GET['page'] == 'teste.php') {
            $page = "teste";
        } else if (isset($_GET['page']) && $_GET['page'] == 'teste2') {
            $page = "teste2";
        } 
        else{
          //  $page = 'oo';
        }


$msgBox	="";

if (file_exists('pages/'.$page.'.php')) {
            // Load the Page
            include('pages/'.$page.'.php');
        } else {
            // Else Display an Error
          
            echo '
                    <div class="wrapper">
                        <h3>Error</h3>
                        <div class="alertMsg default">
                            <i class="icon-warning-sign"></i> The page  "'.$page.$yy.'" could not be found.
                        </div>
                    </div>
                ';
        }


  

?>



