<?php
////////////////////////////////////////////////////////
// DATABASE.PHP
////////////////////////////////////////////////////////
 error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
  mysql_connect("localhost", "root", "") or
  die("Could not connect: " . mysql_error());
  mysql_select_db("notaris");
// Encodes a YYYY-MM-DD into a MM-DD-YYYY string
if($_GET['op']==grouptransaksi){   
    include 'view/wrapper.php';
    if ($_POST['simpan']) {
        $_GET['act']='add';
    }
}
if($_GET['act'] == "get")
{
	$sql = "select * from grouptransaksi where id_grouptr = '".$_GET["id_grouptr"]."'";	
	$result = mysql_query($sql);	
	$rows = mysql_num_rows($result);
	$arr = array();
	while($obj = mysql_fetch_object($result))  
	{  
		$arr[] = $obj;  
	}
		$jsonresult = json_encode($arr);
		echo '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
}

else if($_GET['act'] == "edit")
{

//        $f = $_POST['f'];
//        $str="'".implode("','",$f)."'";
	//move_uploaded_file ($_FILES['file_dokumentasi']['tmp_name'],"artikel/".$_FILES['file_dokumentasi']['name']);	
	$sql = "update grouptransaksi set nm_grouptr = '".$_POST["nm_grouptr"]."',pb_grouptr ='".$_POST["pb_grouptr"]."'where id_grouptr='".$_POST["id_grouptr"]."'";	
//	mysql_query("delete from grouptransaksi where id_grouptr='".$_POST["id_grouptr"]."'");
//        $sql = "insert into grouptransaksi(`id_grouptr`,`nm_grouptr`,`pb_grouptr`) values('null',".$str.")";
        mysql_query($sql) or die(mysql_error());	
	echo "{success:true}";

}

else if($_GET['act'] == "add")

{
      //move_uploaded_file($_FILES['file_dokumentasi']['tmp_name'],"artikel/".$_FILES['file_dokumentasi']['name']);
    if ($_POST['simpan']) {
          $f = $_POST['f'];
          $str="'".implode("','",$f)."'";
	  //$sql_query = mysql_query("INSERT INTO grouptransaksi(`id_grouptr`,`nm_grouptr`,`pb_grouptr`) VALUES('null','".$_POST["nm_grouptr"]."','".$_POST["pb_grouptr"]."')");
          $sql=mysql_query("insert into grouptransaksi(`id_grouptr`,`nm_grouptr`,`pb_grouptr`) values('null',".$str.")");
          if ($sql)
                    {
                    echo "{success:true}";
                } 
                    else
                    {
                    echo "{success: false, errors: { reason: 'upload failed!!' }}";
                }
                
    }
    include 'view/wrapper.php';
}

else if(isset($_POST["del"]))
{
		$sql = "delete from grouptransaksi where id_grouptr ='".$_POST["del"]."'";	
		mysql_query($sql) or die(mysql_error());
		mysql_close();
}

else if((isset($_POST['act'])) == "cari")
{
   $idgroup = $_POST['id_grouptransaksi'];
   $nmgroup = $_POST['nm_grouptransaksi'];
   $pbgroup = $_POST['pb_grouptransaksi'];
   $query = "SELECT * FROM grouptransaksi WHERE id_grouptr LIKE '%".$idgroup."%'";
   if($nmgroup != ''){
      $query .= " AND nm_grouptr LIKE '%".$nmgroup."%'";
   };
   if($pbgroup != ''){
      $query .= " AND pb_grouptr = '".$pbgroup."'";
   };
 
   $result = mysql_query($query);
   $nbrows = mysql_num_rows($result);  
   if($nbrows>0){
    while($rec = mysql_fetch_array($result)){
            // render the right date format  
      $arr[] = $rec;
    }
    $jsonresult = json_encode($arr);
    echo '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
   } else {
    echo '({"total":"0", "results":""})';
   }
}

else{
    $query = "SELECT * FROM grouptransaksi";
	$result = mysql_query($query);
	$nbrows = mysql_num_rows($result);	
	if($nbrows>0){
		while($rec = mysql_fetch_array($result)){
                        // render the right date format
			//$rec['tgldaftar']=codeDate($rec['tgldaftar']);
			$arr[] = $rec;
		}
		$jsonresult = json_encode($arr);
		echo '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
	} else {
		echo '({"total":"0", "results":""})';
	}
}
function codeDate ($date) {
	$tab = explode ("-", $date);
	$r = $tab[1]."/".$tab[2]."/".$tab[0];
	return $r;
}
?>
