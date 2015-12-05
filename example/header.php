<?php
    // FOR DEBUG - REMOVE ME
    // error_reporting(E_ALL);
    // ini_set('display_errors', '1');

    date_default_timezone_set('America/New_York');
    global $dbh; // Scope issues forced me to declare dbh is a global but hand it around to the library and other includes

      require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'model'.DIRECTORY_SEPARATOR . 'product.class.php');
    require_once (dirname(__FILE__).DIRECTORY_SEPARATOR. 'sql_conn_dev.php');
    // require_once("../../../sql_conn.php");
    require_once (dirname(__FILE__).DIRECTORY_SEPARATOR.'lib_project1.php');
 require_once (dirname(__FILE__).DIRECTORY_SEPARATOR.'validate.php');
    
    session_start();
    $sessionid = session_id();
    // Solution from StackExchange - http://stackoverflow.com/questions/3177364/destroy-php-session-on-page-leaving
    
    if (isset($_SESSION['previous'])) {
        // previous is only set on the admin panel, if admin leaves, turn off editing flag
        if (basename($_SERVER['PHP_SELF']) != $_SESSION['previous']) {
            unset($_SESSION['editing']);

        }
    }

    $loginStatus;
    // Check for a login only if it is on the admin page
    if (basename($_SERVER['PHP_SELF']) == "admin.php") {
        if(isset($_POST['loginSubmit'])){
            $cleanUsr = sanitizeInput($_POST['loginName']);
            $cleanPwd = sanitizeInput($_POST['loginPass']);
            if(checkLogin($cleanUsr, $cleanPwd, $dbh)){
                $_SESSION['adminLogin'] = "$cleanUsr";
            }else{
                $loginStatus = "Invalid Login, please try again";
            }
        }

        if(!empty($_SESSION['adminLogin'])){
            header('Location: admin_panel.php');
            exit;
        }
    }

    // session_destroy();

?>

<!doctype html>
<html>
    <head>
        <title><?php echo $pageName; ?> - The Store Store</title>
        <meta charset='utf-8' />
        <link rel="stylesheet" href="./css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="./css/style.css" />
        <?php
            // load any page specific stylesheets as needed
            if(isset($stylesheets)){
                foreach($stylesheets as $sheet){
                    echo '<link rel="stylesheet" type="text/css" href="./css/'. $sheet .'" />'; 
                }
            }
        ?>
    </head>
    
    <body>
    
        <div id="wrap">
            <div class="container">
                <div class="header">
                <h1> Welcome to the Store Store!</h1>

                <!-- Nav Menu -->
                <nav>
                    <ul class="nav" role="menu">
                        <li><a href="./index.php">Home</a></li>
                        <li><a href="./cart.php">Cart</a></li>
                        <li><a href="./admin.php">Admin</a></li>
                    </ul>
                </nav> 
                </div>
        
        
    
    
