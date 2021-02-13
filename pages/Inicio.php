
<?php session_start();

// Cek Active Link
function ActiveClass($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri)
        echo 'class="active"';
}
		
		//check already login
		if (!isset($_SESSION['UserId'])) {
			header ('Location: login.php');
			exit;
		}

		// Logout
		if (isset($_GET['action'])) {
			$action = $_GET['action'];
			if ($action == 'logout') {
				session_destroy();
				header('Location: login.php');
			}
		}



 //Link to page
if (isset($_GET['page']) && $_GET['page'] == 'siteSettings') {
            $page = 'siteSettings';
        } else if (isset($_GET['page']) && $_GET['page'] == 'AssetReport') {
            $page = "AssetReport";
        } else if (isset($_GET['page']) && $_GET['page'] == 'ManageBudget') {
            $page = "ManageBudget";
        } else if (isset($_GET['page']) && $_GET['page'] == 'ManageIncomeCategory') {
            $page = "ManageIncomeCategory";
        } 
		
        else{
            $page = 'dashboard';
        }


		
	
require_once dirname(__FILE__) . '\includes\db.php';

//Get Header


	//echo('bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb');
include('includes/header.php'); 


//set global message notification
$msgBox	="";

if (file_exists('pages/'.$page.'.php')) {
            // Load the Page
            include('pages/'.$page.'.php');
        } else {
            // Else Display an Error
          
            echo '
                    <div class="wrapper">
                        <h3>Err</h3>
                        <div class="alertMsg default">
                            <i class="icon-warning-sign"></i> The page "'.$page.'" could not be found.
                        </div>
                    </div>
                ';
        }

        include('includes/footer.php');
  

?>



