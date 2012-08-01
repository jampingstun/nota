<?php


//  echo      '<div class="span9">';
if (isset($_SESSION['username'])) {
$op = $_GET['op'];
$fileinc = strtolower($op).'.php';
include 'view/header.php';
include 'view/menu.php';
        if (file_exists('view/'.$fileinc)) {

                include 'view/'.$op.'.php';
        }
        else{
            include 'view/home.php';
        }
include 'view/footer.php';
} else {
    include 'controller/login.php';
}

//       echo '</div>
//    </div>
//</div>';


?>
