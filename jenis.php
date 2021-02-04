<?php 
include "config/koneksi.php";
include "library/oop.php";

$go = new oop();
$tabel = 'jenis';
$field = array('jenis' => @$_POST['jenis']);
$redirect = '?menu=jenis';

if(isset($_POST['jenis'])){
    $go->simpan($con, $tabel,$field, $redirect);
}
?>
<form method="post">
    <div class="form-group">
        <label for="jenis">Jenis</label>
        <input type="text" name="jenis" class="form-control">      
    </div>
    <br>
    <button type="submit" class="btn btn-primary">SIMPAN</button>
</form>