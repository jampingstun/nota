<?php
////////////////////////////////////////////////////////
// DATABASE.PHP
////////////////////////////////////////////////////////
  mysql_connect("localhost", "root", "") or
  die("Could not connect: " . mysql_error());
  mysql_select_db("notaris");
  $query = "SELECT * FROM pemohon";
	$result = mysql_query($query);
	$nbrows = mysql_num_rows($result);	
	if($nbrows>0){
		while($rec = mysql_fetch_array($result)){
                        // render the right date format
			//$rec['tgldaftar']=codeDate($rec['tgldaftar']);
			//$arr = $rec;
                        $arr[] = $rec;
		}
                $info = json_decode($arr[0]['infopemohon'], true);
                $fusion = array_merge($arr[0],$info);
		$jsonresult = json_encode($fusion);
                $_GET["act"] = "default";
		echo '({"total":"'.$nbrows.'","results":['.$jsonresult.']})'; //ono kurung
	} else {
		echo '({"total":"0", "results":""})';
	}
// Encodes a YYYY-MM-DD into a MM-DD-YYYY string
if($_GET["act"] == "get")
{
	$sql = "select * from dokumentasi where id_dokumentasi = '".$_GET["id_dokumentasi"]."'";	
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

else if($_GET["act"] == "edit")
{


	move_uploaded_file ($_FILES['file_dokumentasi']['tmp_name'],"artikel/".$_FILES['file_dokumentasi']['name']);	
	$sql = "update pemohon set id_pemohon='".$_POST["id_pemohon"]."', file_dokumentasi = '".$_FILES['file_dokumentasi']['name']."',tanggal_dokumentasi = '".$_POST["tanggal_dokumentasi"]."' where id_dokumentasi='".$_POST["id_dokumentasi"]."'";	
	mysql_query($sql) or die(mysql_error());	
	echo "{success:true}";

}

else if($_GET["act"] == "add")

{
      move_uploaded_file($_FILES['file_dokumentasi']['tmp_name'],"artikel/".$_FILES['file_dokumentasi']['name']);	 
      
	  $sql_query = mysql_query("INSERT INTO dokumentasi (`id_dokumentasi`,`judul_dokumentasi`,`tanggal_dokumentasi`,`file_dokumentasi`) VALUES ('null','".$_POST["judul_dokumentasi"]."','".$_POST["tanggal_dokumentasi"]."','".$_FILES['file_dokumentasi']['name']."')");
      
	  if ($sql_query)
	  {
          echo "{success:true}";
      } 
	  else
	  {
           echo "{success: false, errors: { reason: 'upload failed!!' }}";
      }
}

else if(isset($_POST["del"]))
{
		$sql = "delete from transaksi where id_transaksi ='".$_POST["del"]."'";	
		mysql_query($sql) or die(mysql_error());
		mysql_close();
}
function codeDate ($date) {
	$tab = explode ("-", $date);
	$r = $tab[1]."/".$tab[2]."/".$tab[0];
	return $r;
}
?>
