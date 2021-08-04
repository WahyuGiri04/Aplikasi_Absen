<?php
	include '../../../koneksi.php';

	$prodi = $_POST['prodi'];
 
	echo "<option value=''>Pilih Kelas</option>";
 
    $sql = $koneksi->query("SELECT * FROM tb_kelas WHERE id_prodi = '$prodi'");
    while($data_kelas = $sql->fetch_assoc()){
        echo "<option value='" . $data_kelas['nama_kelas'] . "'>" . $data_kelas['nama_kelas'] ."</option>";
    }
?>