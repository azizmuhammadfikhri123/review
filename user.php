<?php

include "config/koneksi.php";
include "library/oop.php";


$go = new oop();
$tabel = 'login';
$field = array(
    'username' => @$_POST['username'],
    'password' => base64_encode(@$_POST['password'] ));
    
@$redirect = '?menu=user';
@$where = "id = $_GET[id]";

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

<form method='post'>

<table align="center">
    <tr>
        <td>Username</td>
        <td>:</td>
        <td><input class="form-control me-2" type="text" name="username" value="<?php echo @$edit['username'] ?>"></td>
    </tr>
    <tr>
        <td>Password</td>
        <td>:</td>
        <td><input class="form-control me-2" type="text" name="password" value="<?php echo base64_decode(@$edit['password']) ?>"></td>
    </tr>
        <tr>
        <td></td>
        <td></td>
        <td>
            <?php if(@$_GET['id']=="") { ?>
            <input class="btn btn-primary" type="submit" name="simpan" value="SIMPAN">
            <?php }else{ ?>
            <input class="btn btn-success" type="submit" name="ubah" value="UPDATE">
            <?php } ?>
        </td>
    </tr>
</table>
</form>

<br>
 
<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>NO</th>
            <th>Username</th>
            <th>password</th>
            <th>Aksi</th>
            <th></th>

        </tr>
    </thead>
    <tbody>

        <?php
            $a = $go->tampil($con, $tabel);
            $no = 0;

            if($a == ""){
                echo "<tr><td colspan='5' align='center'>No Record</td></tr>";
            } else {

            foreach($a as $r){
            $no++;
        ?>
        <tr>
            <td><?php echo $no ?></td>
            <td><?php echo $r['username'] ?></td>
            <td><?php echo $r['password'] ?></td>
            <td><a class="btn btn-warning" href="?menu=user&edit&id=<?php echo $r['id'] ?>">Edit</a></td>
            <td><a class="btn btn-danger" href="?menu=user&hapus&id=<?php echo $r['id'] ?>" onclick="return confirm('Hapus data <?php echo $r['username'] ?> ?')">Hapus</a></td>
        </tr>
        <?php }  } ?>

    </tbody>
</table>