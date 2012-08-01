<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'config.php';
if(isset($_SESSION['username'])){
    echo '<a href= "index.php?op=logout">logout</a>';
    $_GET['op'] = 'pemohon';
    include 'view/wrapper.php';
}
$name = $_POST['username'];
$pass = $_POST['password'];
if(($name!='') && ($pass!='')){
$login = mysql_query("select username, password from user where
    (username='".mysql_real_escape_string($name)."') and (password='".mysql_real_escape_string($pass)."')") or die(mysql_error());
 if(mysql_num_rows($login)>0){
    $_SESSION['username'] = $_POST['username'];
    echo '<a href= "index.php?op=logout">logout</a>';
    $_GET['op'] = 'home';
    include 'view/wrapper.php';
 }
 else{
     echo 'anda tidak berhasil login';
 }
}
else{  
 include 'view/login.php';
}
?>
