<?php
    //koneksi databse
    $server="localhost";
    $user="root";
    $pass="";
    $db="dbsmk";
    $koneksi=mysqli_connect($server,$user,$pass,$db)or die(mysql_error($koneksi));

    // jika tombol simpan ditekan
    if(isset($_POST['bsimpan'])) {
        // ambil data dari form
        if ($_GET['page'] == "edit") {
            $id_sis = $_GET['id'];
            $nis = $_POST['tnis'];
            $nama = $_POST['tnama'];
            $alamat = $_POST['talamat'];
            $produktif = $_POST['tproduktif'];
            
            // validasi input
            if(empty($nis) || empty($nama) || empty($alamat) || empty($produktif)) {
                echo "<script>alert('Data tidak boleh kosong');</script>";
            } else {
                // query untuk mengupdate data ke database
                $edit = mysqli_query($koneksi, "UPDATE tsis SET 
                            nis = '$nis', 
                            nama = '$nama', 
                            alamat = '$alamat', 
                            produktif = '$produktif' 
                            WHERE id_sis = $id_sis
                        ");
                
                if($edit) {
                    echo "<script>alert('Data berhasil diedit'); window.location='index.php';</script>";
                } else {
                    echo "<script>alert('Data gagal diedit');</script>";
                }           
            }
        } else {
            $nis = $_POST['tnis'];
            $nama = $_POST['tnama'];
            $alamat = $_POST['talamat'];
            $produktif = $_POST['tproduktif'];
    
            // validasi input
            if(empty($nis) || empty($nama) || empty($alamat) || empty($produktif)){
                echo "<script>alert('Data tidak boleh kosong');</script>";
            } else {
                // query untuk menyimpan data ke database
                $simpan = mysqli_query($koneksi, "INSERT INTO tsis (nis, nama, alamat, produktif) VALUES ('$nis', '$nama', '$alamat', '$produktif')");
                if($simpan){
                    echo "<script>alert('Data berhasil disimpan'); window.location='index.php';</script>";
                } else {
                    echo "<script>alert('Data gagal disimpan');</script>";
                }
            }
        }
    }

    // jika tombol edit/hapus ditekan
    if(isset($_GET['page'])){
        // jika memilih page edit
        if($_GET['page'] == "edit"){
            $id_sis = $_GET['id'];
            $tampil = mysqli_query($koneksi, "SELECT * from tsis where id_sis='$id_sis'");
            $data = mysqli_fetch_array($tampil);
            if($data){
                $vnis = $data['nis'];
                $vnama = $data['nama'];
                $valamat = $data['alamat'];
                $vproduktif = $data['produktif'];
            }
        }
        // jika memilih page hapus
        else if($_GET['page'] == "hapus"){
            $id_sis = $_GET['id'];
            $hapus = mysqli_query($koneksi, "DELETE from tsis where id_sis='$id_sis'");
            if($hapus){
                echo "<script>alert('Data berhasil dihapus'); window.location='index.php';</script>";
            } else {
                echo "<script>alert('Data gagal dihapus');</script>";
            }
        }
    }

   
?>

<!-- view -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud </title>
    <link rel ="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>

<div class="container">

<h1 class="text-center">Absensi CRUD   Baru</h1>
<h2 class="text-center">SMK DHARMA AGUNG PASEH</h2>
<!-- awal  form-->
<div class="card mt-3">
  <div class="card-header bg-primary text-white">
    FORM INPUT DATA MAHASISWA
  </div>
  <div class="card-body">
    <form method="post" action="">
        <div class="form-group">
            <label >NIS</label>
            <input type="text" name="tnis" value ="<?=@$vnis?>" class="form-control" placeholder="Input NIS Anda Disini" required>
        </div>
        <div class="form-group">
            <label >NAMA </label>
            <input type="text" name="tnama" value="<?=@$vnama?>" class="form-control" placeholder="Input NAMA Anda Disini" required>
        </div>
        <div class="form-group">
            <label >ALAMAT</label>
            <textarea class="form-control" name="talamat" placeholder="Input ALAMAT Anda Disini" required ><?=@$valamat?></textarea>
        </div>
        <div class="form-group">
            <label >Program  keahlian</label>
            <select class="form-control" name="tproduktif"placeholder="Pilih Produktif" require>
                <option value="<?=@$vproduktif?>"><?=@$vproduktif?></option>
                <option value="TKJ">TKJ</option>
                <option value="TBSM">TBSM</option>
                <option value="AKUN">AKUNTANSI</option>
            </select>
         </div>
        <Button type="submit" class="btn btn-success" name="bsimpan">simpan</Button>
        <Button type="reset" class="btn btn-danger" name="breset">reset</Button>
    </form>
    </div>
    <!-- akhir form -->

    <!-- awal tabel -->
<div class="card mt-3">
  <div class="card-header bg-primary text-white">
    Data Siswa SMK Dharma Agung 
  </div>
     <div class="card-body">
        <table class="table tabel-bordered table-striped">
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Program Keahlian</th>
                <th>Aksi</th>
            </tr>
            <?php
                $no = 1;
                $tampil = mysqli_query($koneksi, "SELECT * from tsis order by id_sis desc");
                while ($data = mysqli_fetch_array($tampil)) :
            ?>
            <tr>
                <td><?=$no++;?></td>
                <td><?=$data['nis']?></td>
                <td><?=$data['nama']?></td>
                <td><?=$data['alamat']?></td>
                <td><?=$data['produktif']?></td>
                <td>
                    <a href="?page=edit&id=<?=$data['id_sis']?>" class="btn btn-warning">Edit</a>
                    <a href="?page=hapus&id=<?=$data['id_sis']?>" onclick="return confirm('apakah akan meghapus data ini ?')" class="btn btn-danger">hapus</a>
                </td>

            </tr>
            <?php endwhile; ?>

        </table>
    </div>
  </div>
</div>
<!-- akhir tabel -->

</div>

<script type="text/javascript" src="js/boostrap.min.js"></script> 
</body>
</html>

