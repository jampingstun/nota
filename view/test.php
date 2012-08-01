<?
    foreach ($data as $row) {
        $info = json_decode($row['infopemohon'],true);
        echo $row['kode'].' '.$info['nama'].' '.$row['idpemohon'].'<br />';
    }
?>