<?php 
include "config/koneksi.php";
include "library/oop.php";

$go = new oop();
$tabel = 'jenis';
$field = array('jenis' => @$_POST['jenis']);
$redirect = '?menu=jenis';
@$where = "jenisID = $_GET[id]";

if(isset($_POST['jenis'])){
    $go->simpan($con, $tabel,$field, $redirect);
}
if(isset($_GET['hapus'])){
    $go->hapus($con, $tabel, $where, $redirect);
}
if(isset($_GET['edit'])){
    $edit = $go->edit($con, $tabel, $where);
}
if(isset($_POST['update'])){
    $go->ubah($con, $tabel,  $field, $where, $redirect);
}

?>
<form method="post">
    <div class="form-group">
        <label for="jenis">Jenis</label>
        <input type="text" name="jenis" class="form-control" value = "<?php echo @$edit['jenis']?>">      
    </div>
    <br>
    <?php if(@$_GET ['id']==""){ ?>
            <input type="submit" name="simpan" value="SIMPAN" class="btn btn-primary">
		<?php }else { ?>
			<input type="submit" name="update" value="UPDATE" class="btn btn-success">
		<?php } ?>
</form>
<br>

<table id="example" class="display" style="width:100%">
		<thead>
			<tr>
				<th>NO</th>
				<th>Jenis</th>
				<th>aksi</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		<?php
			$a = $go->tampil($con, $tabel);
			$no = 0;
			if($a == ""){
				echo "<tr> <td align='center'>No Record<td/></tr>";
			}else{
			foreach($a as $r){
			$no++;
		?>			
			<tr>
				<td><?php echo $no ?></td>
				<td><?php echo $r['jenis'] ?></td>
				<td><a class="btn btn-primary" href="?menu=jenis&hapus&id=<?php echo $r['janisID'] ?>"onclick="return confirm('Hapus Data <?php echo $r['jenis'] ?>?')">Hapus</a></td>
				<td><a class="btn btn-success" href="?menu=jenis&edit&id=<?php echo $r['jenisID']?>">Edit</a></td>
			</tr>
		<?php } }?>
	</tbody>
</table>