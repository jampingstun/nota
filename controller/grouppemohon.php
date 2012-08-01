<?php
////////////////////////////////////////////////////////
// DATABASE.PHP
////////////////////////////////////////////////////////
 error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
  mysql_connect("localhost", "root", "") or
  die("Could not connect: " . mysql_error());
  mysql_select_db("notaris");
// Encodes a YYYY-MM-DD into a MM-DD-YYYY string
if($_GET['op']==grouppemohon){   
    include 'view/wrapper.php';
    if ($_POST['simpan']) {
        $_GET['act']='add';
    }
}  
if($_GET['act'] == "get")
{
	$sql = "select * from grouppemohon where id_grouppemohon = '".$_GET["id_grouppemohon"]."'";	
	$result = mysql_query($sql);	
	$rows = mysql_num_rows($result);
	$arr = array();
	while($obj = mysql_fetch_object($result))  
	{  
		$arr[] = $obj;  
	}
		$jsonresult = json_encode($arr);
		echo '({"total":"'.$rows.'","results":'.$jsonresult.'})';
}

else if($_GET['act'] == "edit")
{

//        $f = $_POST['f']; 
//        $str="'".implode("','",$f)."'";
	//move_uploaded_file ($_FILES['file_dokumentasi']['tmp_name'],"artikel/".$_FILES['file_dokumentasi']['name']);	
	$sql = "update grouppemohon set nm_grouppemohon = '".$_POST["nm_grouppemohon"]."',pb_grouppemohon ='".$_POST["pb_grouppemohon"]."'where id_grouppemohon='".$_POST["id_grouppemohon"]."'";	
//	mysql_query("delete from grouppemohon where id_grouppemohon='".$_POST["id_grouppemohon"]."'");
//        $sql = "insert into grouppemohon(`id_grouppemohon`,`nm_grouppemohon`,`pb_grouppemohon`) values('null',".$str.")";
        mysql_query($sql) or die(mysql_error());	
	echo "{success:true}";

}

else if($_GET['act'] == "add")

{
      //move_uploaded_file($_FILES['file_dokumentasi']['tmp_name'],"artikel/".$_FILES['file_dokumentasi']['name']);
    if ($_POST['simpan']) {
    $f = $_POST['f']; 
    $str="'".implode("','",$f)."'";
    //echo $str;
    //$sql_query = mysql_query("INSERT INTO grouppemohon(`id_grouppemohon`,`nm_grouppemohon`,`pb_grouppemohon`) VALUES('null','".$_POST["nm_grouppemohon"]."','".$_POST["pb_grouppemohon"]."')");
    $sql=mysql_query("insert into grouppemohon(`id_grouppemohon`,`nm_grouppemohon`,`pb_grouppemohon`) values('null',".$str.")");
    //echo "{$sql}";
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
		$sql = "delete from grouppemohon where id_grouppemohon ='".$_POST["del"]."'";	
		mysql_query($sql) or die(mysql_error());
		mysql_close();
}

else if((isset($_POST['act'])) == "cari")
{
   $idgroup = $_POST['id_grouppemohon'];
   $nmgroup = $_POST['nm_grouppemohon'];
   $pbgroup = $_POST['pb_grouppemohon'];
   $query = "SELECT * FROM grouppemohon WHERE id_grouppemohon LIKE '%".$idgroup."%'";
   if($nmgroup != ''){
      $query .= " AND nm_grouppemohon LIKE '%".$nmgroup."%'";
   };
   if($pbgroup != ''){
      $query .= " AND pb_grouppemohon = '".$pbgroup."'";
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
    $query = "SELECT * FROM grouppemohon";
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
