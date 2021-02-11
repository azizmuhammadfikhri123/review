<?php

include "config/koneksi.php";
include "library/oop.php";

$go = new oop();
$tabel = 'product';
$tanggal = date('Y-m-d');
$field = array('nama' => @$_POST['nama'],
                'jenisID' => @$_POST['jenis'],
                'foto' => 'foto.jpg',
                'tglInput' => $tanggal,
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
        <input type="text" name="nama" class="form-control" value="<?php echo @$edit['jenis'] ?>">
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
            <th>Jenis</th>
            <th>Aksi</th>
            <th></th>

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
            <td><?php echo $r['jenis'] ?></td>
            <td><a class="btn btn-danger" href="?menu=jenis&edit&id=<?php echo $r['jenisID'] ?>">Edit</a></td>
            <td><a class="btn btn-success" href="?menu=jenis&hapus&id=<?php echo $r['jenisID'] ?>" onclick="return confirm('Hapus data <?php echo $r['jenis'] ?> ?')">Hapus</a></td>
        </tr>
            <?php }  } ?>

    </tbody>
</table>