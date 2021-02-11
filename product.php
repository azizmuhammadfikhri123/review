<?php

include "config/koneksi.php";
include "library/oop.php";

$go = new oop();
$tabel = 'product';
$tanggal = date('Y-m-d');
$field = array('nama' => @$_POST['nama'],
                'jenisID' => @$_POST['jenis'],
                'foto' => 'foto.jpg',
                'tglinput' => $tanggal,
                'ket' => @$_POST['ket'] );

$redirect = '?menu=product';


@$where = "productID = $_GET[id]";

if(isset($_POST['simpan'])){
    $go->simpan($con, $tabel, $field, $redirect);
}

if(isset($_GET['hapus'])){
    $go->hapus($con, $tabel, $where, $redirect);
}

if(isset($_GET['edit'])){
    $edit = $go->edit($con, $tabel, $where);
}

if(isset($_POST['ubah'])){
    $go->ubah($con, $tabel, $field, $where, $redirect);
}

?>

<form method="post">

    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control" value="<?php echo @$edit['nama'] ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Jenis</label>
        <select name="jenis" class="form-control">
            <option></option>

            <?php 
                $sql = mysqli_query($con, "SELECT * FROM jenis");
                while($r=mysqli_fetch_assoc($sql)){
            ?>
            <option value="<?php echo $r['jenisID'] ?>"><?php echo $r['jenis'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Foto</label>
        <input type="file" name="foto" class="form-control" value="<?php echo @$edit['foto'] ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Keterangan</label>
        <input type="textarea" name="ket" class="form-control" value="<?php echo @$edit['ket'] ?>">
    </div>

        <?php if(@$_GET['id']=="") { ?>
        <input class="btn btn-primary" type="submit" name="simpan" value="SIMPAN">
        <?php }else{ ?>
        <input class="btn btn-success" type="submit" name="ubah" value="UPDATE">
        <?php } ?>
</form>

<br>

<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>NO</th>
            <th>Nama</th>
            <th>jenis</th>
            <th>Foto</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>

        <?php
            $a = $go->tampil($con, $tabel);
            $no = 0;

            if($a == ""){
                echo "<tr><td>No Record</td></tr>";
            } else {

            foreach($a as $r){
            $no++;
        ?>
        <tr>
            <td><?php echo $no ?></td>
            <td><?php echo $r['product'] ?></td>
            <td><a class="btn btn-danger" href="?menu=product&edit&id=<?php echo $r['productID'] ?>">Edit</a></td>
            <td><a class="btn btn-success" href="?menu=product&hapus&id=<?php echo $r['productID'] ?>" onclick="return confirm('Hapus data <?php echo $r['product'] ?> ?')">Hapus</a></td>
            <td></td>
            <td></td>
        </tr>
            <?php }  } ?>

    </tbody>
</table>