<?php
////////////////////////////////////////////////////////
// DATABASE.PHP
////////////////////////////////////////////////////////
 error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
  mysql_connect("localhost", "root", "") or
  die("Could not connect: " . mysql_error());
  mysql_select_db("notaris");
// Encodes a YYYY-MM-DD into a MM-DD-YYYY string
if($_GET['op']==transaksi){   
    include 'view/wrapper.php';   
}
if($_GET['act'] == "get")
{
	$sql = "select * from transaksi where id_transaksi = '".$_GET["id_transaksi"]."'";	
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


	//move_uploaded_file ($_FILES['file_dokumentasi']['tmp_name'],"artikel/".$_FILES['file_dokumentasi']['name']);	
	$sql = "update transaksi set tglmasuk = '".$_POST["tglmasuk"]."',id_pemohon = '".$_POST["id_pemohon"]."',id_grouptr ='".$_POST["id_grouptr"]."',
            judul='".$_POST["judul"]."',jmlberkas='".$_POST["jmlberkas"]."', status='".$_POST["status"]."',jmlberkasselesai='".$_POST["jmlberkasselesai"]."',harga='".$_POST["harga"]."',sudahbayar='".$_POST["sudahbayar"]."',
                tglselesai='".$_POST["tglselesai"]."' where id_transaksi='".$_POST["id_transaksi"]."'";	
	mysql_query($sql) or die(mysql_error());	
	echo "{success:true}";

}

else if($_GET['act'] == "add")

{
      //move_uploaded_file($_FILES['file_dokumentasi']['tmp_name'],"artikel/".$_FILES['file_dokumentasi']['name']);	 
     $f = $_POST['f'];
     $stat = $_POST['status'];
     $byr = $_POST['sudahbayar'];
     if($stat==''){
         $stat='0';
     }
     if($byr==''){
         $byr='0';
     }
          
      $str="'".implode("','",$f)."'";
	  //$sql_query = mysql_query("INSERT INTO transaksi(`id_transaksi`,`tglmasuk`,`id_pemohon`,`id_grouptr`,`judul`,`jmlberkas`,`status`,`jmlberkasselesai`,`harga`,`sudahbayar`,`tglselesai`) VALUES('null','".$_POST["tglmasuk"]."','".$_POST["id_pemohon"]."','".$_POST["id_grouptr"]."','".$_POST["judul"]."','".$_POST["jmlberkas"]."','".$_POST["status"]."','".$_POST["jmlberkasselesai"]."','".$_POST["harga"]."','".$_POST["sudahbayar"]."','".$_POST["tglselesai"]."')");
            $sql_query = mysql_query("INSERT INTO transaksi(`id_transaksi`,`tglmasuk`,`id_pemohon`,`id_grouptr`,`judul`,`jmlberkas`,`jmlberkasselesai`,`harga`,`tglselesai`,`status`,`sudahbayar`) VALUES('null',".$str.",".$stat.",".$byr.")");
            if ($sql_query)
                    {
                    echo "{success:true}";
                } 
                    else
                    {
                    echo "{success: false, errors: { reason: 'upload failed!!' }}";
                }
       $f['nm'] = $str;
                
}

else if(isset($_POST["del"]))
{
		$sql = "delete from transaksi where id_transaksi ='".$_POST["del"]."'";	
		mysql_query($sql) or die(mysql_error());
		mysql_close();
}

else if((isset($_POST['act'])) == "cari")
{
$tipe1 = $_POST['tipedata1'];
$data1 = $_POST['data1'];
$tipe2 = $_POST['tipedata2'];
$data2 = $_POST['data2'];
   $query = "SELECT * FROM transaksi WHERE id_grouptr LIKE '%".$idgroup."%'";
   if($data1 != ''){
      $query .= " AND ".$tipe1." LIKE '%".$data1."%'";
   };
   if($data2 != ''){
       $query .= " AND ".$tipe2." LIKE '%".$data2."%'";
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
    $query = "SELECT * FROM transaksi";
	$result = mysql_query($query);
	$nbrows = mysql_num_rows($result);	
	if($nbrows>0){
		while($rec = mysql_fetch_array($result)){
                        // render the right date format
			$rec['tgldaftar']=codeDate($rec['tgldaftar']);
                        $rec['tglselesai']=codeDate($rec['tglselesai']);
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
	$r = $tab[1]."-".$tab[2]."-".$tab[0];
	return $r;
}

?>
