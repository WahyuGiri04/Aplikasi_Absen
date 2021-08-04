<?php
	include '../../../koneksi.php';

	$kelas = $_POST['kelas'];
 
	echo "<option value=''>Pilih Angkatan</option>";
 
    $sql = $koneksi->query("SELECT * FROM tb_kelas WHERE nama_kelas = '$kelas'");
    while($data_kelas = $sql->fetch_assoc()){
        echo "<option value='" . $data_kelas['angkatan'] . "'> ". $data_kelas['angkatan']. "</option>";
    }
?>