<?php
////////////////////////////////////////////////////////
// DATABASE.PHP
////////////////////////////////////////////////////////
 error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
  mysql_connect("localhost", "root", "") or
  die("Could not connect: " . mysql_error());
  mysql_select_db("notaris");
if($_GET['op']==pemohon){   
    include 'view/wrapper.php';
    if ($_POST['simpan']) {
        $_GET['act']='add';
    }
}
// Encodes a YYYY-MM-DD into a MM-DD-YYYY string
if($_GET["act"] == "get")
{
	$sql = "select * from pemohon where idpemohon = '".$_GET["idpemohon"]."'";	
	$result = mysql_query($sql);	
	$rows = mysql_num_rows($result);
	$arr = array();
        $i = 0;
        if($rows>0){
	while($rec = mysql_fetch_array($result)){
                        // render the right date format
			//$rec['tgldaftar']=codeDate($rec['tgldaftar']);
			//$arr = $rec;
                        $arr[] = $rec;
                        //echo $i;
                        $info = json_decode($arr[$i]['infopemohon'], true);
                        $fusion = array_merge($arr[$i],$info);
                        $ar[] = (json_encode($fusion));
                        $i++;
		}
                $list = implode(",",$ar);
		echo '({"total":"'.$rows.'","results":['.$list.']})'; //ono kurung
	} else {
		echo '({"total":"0", "results":""})';
	}
}

else if($_GET["act"] == "edit")
{


	//move_uploaded_file ($_FILES['file_dokumentasi']['tmp_name'],"artikel/".$_FILES['file_dokumentasi']['name']);	
	$f = $_POST['f'];
        $j = json_encode($f);
        $sql = "update pemohon set idpemohon='".$_POST["idpemohon"]."', idgrouppemohon = '".$_POST['idgrouppemohon']."',tgldaftarpemohon = '".$_POST["tgldaftarpemohon"]."',infopemohon='".$j."',pbpemohon='".$_POST['pbpemohon']."' where idpemohon='".$_POST["idpemohon"]."'";	
	mysql_query($sql) or die(mysql_error());	
	echo "{success:true}";

}

else if($_GET['act'] == "add")

{
    $f = $_POST['f'];
    $idgrouppemohon = $f['grouppemohon'];
    $tgldaftar = $f['tgldaftar'];
    $j = json_encode($f);
    //if ($_POST['simpan']) {
        $sql = "INSERT INTO pemohon (idpemohon, idgrouppemohon, tgldaftarpemohon, infopemohon, pbpemohon) VALUES ('null','".$idgrouppemohon."','".$tgldaftar."','".$j."','1')";
        $sql_query = mysql_query($sql);
        if ($sql_query)
	  {
          echo "{success:true}";
      } 
	  else
	  {
           echo "{success: false, errors: { reason: 'upload failed!!' }}";
      }
      
      
        $sql_lastid = "SELECT LAST_INSERT_ID()";
        $id = mysql_query($sql_lastid) or die(mysql_error());
        while ($row = mysql_fetch_array($id)) {
            $last_id = $row[0];
        }
        $sql = "delete from tbl_index where tipe='pemohon' and id='".$last_id."'";
        mysql_query($sql) or die(mysql_error());
        foreach ($indexconfig['pemohon'] as $v) {
            $sql = "insert into tbl_index (tipe,id,kode,isi) values ('pemohon','".$last_id."','".$v."','".$f[$v]."')";
            mysql_query($sql) or die(mysql_error());
        //}
    }
}

else if(isset($_POST["del"]))
{
		$sql = "delete from pemohon where idpemohon ='".$_POST["del"]."'";	
		mysql_query($sql) or die(mysql_error());
		mysql_close();
}
else if((isset($_POST['act'])) == "cari")
{
$tipe1 = $_POST['tipedata1'];
$data1 = $_POST['data1'];
//$tipe2 = $_POST['tipedata2'];
//$data2 = $_POST['data2'];
$sql = "SELECT * FROM tbl_index WHERE tipe='pemohon' and kode='".$tipe1."' and isi='".$data1."'";
$data = mysql_query($sql) or die(mysql_error());
if (mysql_num_rows($data)>0) {
    while ($row = mysql_fetch_array($data)) {
        $id = $row['id'];
    }
    $sql = "SELECT * FROM pemohon WHERE idpemohon='".$id."'";
    $result = mysql_query($sql) or die(mysql_error());
    $nbrows = mysql_num_rows($result);  
   $i=0;
	if($nbrows>0){
		while($rec = mysql_fetch_array($result)){
                        // render the right date format
			//$rec['tgldaftar']=codeDate($rec['tgldaftar']);
			//$arr = $rec;
                        $arr[] = $rec;
                        //echo $i;
                        $info = json_decode($arr[$i]['infopemohon'], true);
                        $fusion = array_merge($arr[$i],$info);
                        $ar[] = (json_encode($fusion));
                        $i++;
		}
                $list = implode(",",$ar);
		echo '({"total":"'.$nbrows.'","results":['.$list.']})'; //ono kurung
	} else {
		echo '({"total":"0", "results":""})';
	}
}
}
else{
     $query = "SELECT * FROM pemohon";
	$result = mysql_query($query);
	$nbrows = mysql_num_rows($result);
        $i=0;
	if($nbrows>0){
		while($rec = mysql_fetch_array($result)){
                        // render the right date format
			//$rec['tgldaftar']=codeDate($rec['tgldaftar']);
			//$arr = $rec;
                        $arr[] = $rec;
                        //echo $i;
                        $info = json_decode($arr[$i]['infopemohon'], true);
                        $fusion = array_merge($arr[$i],$info);
                        $ar[] = (json_encode($fusion));
                        $i++;
		}
                $list = implode(",",$ar);
		echo '({"total":"'.$nbrows.'","results":['.$list.']})'; //ono kurung
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
