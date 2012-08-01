<?php
$f = $_GET['f'];
$sql = "SELECT * FROM tbl_index WHERE tipe='".$f['tipe']."' and kode='".$f['kode']."' and isi='".$f['isi']."'";
$data = mysql_query($sql) or die(mysql_error());
if (mysql_num_rows($data)>0) {
    while ($row = mysql_fetch_array($data)) {
        $id = $row['id'];
        echo $id;
    }
    $sql = "SELECT * FROM ".$f['tipe']." WHERE id".$f['tipe']."='".$id."'";
    $result = mysql_query($sql) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        print_r(json_decode($row['infopemohon'],true));
    }
}
else {
    echo "data tidak ditemukan";
}  
?>
