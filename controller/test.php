<?
	$exe = $_GET['exe'];
	$view = $_GET['op'];
	switch ($exe) {
		case 'delete' :
                    include 'view/'.$view.'-delete.php';
		break;
		case 'edit' : 
			if ($_POST['SSUBMIT']) {
				// sql untuk insert
					
			} else {
				// ambil data di sql nya
				$id = $_GET['id'];
				// sql
				$row = array('nama'=>'abc','alamat'=>'asdassd');
				$f = $row;
			}
			include 'view/'.$view.'-add.php';
		break;
		case 'add' :
			$f = $_POST['f'];
			if ($_POST['SSUBMIT']) {
				// sql untuk insert
				print_r($f);
			}
                        
                        $sql = "delete from tbl_index where tipe='pemohon' and id='".$last_id."'";
                        foreach ($indexconfig['pemohon'] as $v) {
                            $sql = "insert into tbl_index (tipe,id,kode,isi) values ('pemohon','".$last_id."','".$v."','".$f[$v]."')";
                        }
		
			include 'view/'.$view.'-add.php';
		break;
		default:
                        $data = array();
                        $whr = '';
                        if ($_GET['tipecari']!="") $whr.="  and i.kode='".$_GET['tipecari']."'";
                        if ($_GET['cari']!="") $whr.="  and i.isi like '%".$_GET['cari']."%'";
                        $sql = "select * from pemohon p,tbl_index i 
                                where i.id=p.idpemohon and i.tipe='pemohon' 
                                ".$whr." group by p.idpemohon";
                        $res = mysql_query($sql) or die(mysql_error());
                        while ($row=mysql_fetch_array($res)) $data[] = $row;
                        include 'view/'.$view.'.php';
		break;
	}
?>