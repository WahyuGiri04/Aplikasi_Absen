<!DOCTYPE html>
<html>
<head>
    <title>maribelajarcoding.com</title>
</head>
<body>
    <div align="center">
        <h2>Generate File QRCode</h2>
        <form method="POST">
            <table>
                <tr>
                    <td valign="top">Content</td>
                    <td><input type="text" name="content" id="content"></td>
                </tr>
                <tr>
                    <td valign="top"></td>
                    <td><input type="submit" name="simpan" value="Generate"></td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['simpan'])) {

            include "phpqrcode/qrlib.php"; 

            $tempdir = "temp/"; //Nama folder tempat menyimpan file qrcode
            if (!file_exists($tempdir)) //Buat folder bername temp
            mkdir($tempdir);

            //isi qrcode jika di scan
            $codeContents = $_POST['content'];
            //nama file qrcode yang akan disimpan
            $namaFile=$_POST['content'].".png";
            //ECC Level
            $level=QR_ECLEVEL_H;
            //Ukuran pixel
            $UkuranPixel=10;
            //Ukuran frame
            $UkuranFrame=4;

            QRcode::png($codeContents, $tempdir.$namaFile, $level, $UkuranPixel, $UkuranFrame); 

            echo '<img src="'.$tempdir.$namaFile.'" />';  
        }

        ?>
        <br>
        <a href="https://www.maribelajarcoding.com" target="_blank">maribelajarcoding.com</a>
    </div>
</body>
</html>