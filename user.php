<?php
include "config/koneksi.php";
include "library/oop.php";


$go = new oop();
$tabel = 'login';
$field = array(
    'username' => @$_POST['username'],
    'password' => base64_encode(@$_POST['password']) );
    
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
if(isset($_POST['update'])){
	$go->ubah($con, $tabel,  $field, $where, $redirect);
}


?>

<form method='post'>
	<table align="center">
		<tr>
			<td>Username</td>
			<td>:</td>
			<td><input type="text" name="username" value="<?php echo @$edit['username']?>"></td>
		</tr>
		<tr>
			<td>Password</td>
			<td>:</td>
			<td><input type="text" name="password" value="<?php echo base64_decode(@$edit['password'])?>"></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>
				<?php if(@$_GET ['id']==""){ ?>
				<input type="submit" name="simpan" value="SIMPAN">
			<?php }else{ ?>
				<input type="submit" name="update" value="UPDATE">
			<?php } ?>
			</td>         
		</tr>
	</table>

	<table align="center" border="1">
		<tr>
			<td>NO</td>
			<td>Username</td>
			<td>Password</td>
			<td colspan="2">aksi</td>
		</tr>
		<?php
			$a = $go->tampil($con, $tabel);
			$no = 0;
			if($a == ""){
				echo "<tr> <td colspan='5' align='center'>No Record<td/></tr>";
			}else{
			foreach($a as $r){
			$no++;
		?>
		<tr>
			<td><?php echo $no ?></td>
			<td><?php echo $r['username'] ?></td>
			<td><?php echo $r['password'] ?></td>
			<td><a href="?menu=user&hapus&id=<?php echo $r['id'] ?>"onclick="return confirm('Hapus Data <?php echo $r['username'] ?>?')">Hapus</a></td>
			<td><a href="?menu=user&edit&id=<?php echo $r['id']?>">Edit</a></td>

		</tr>
		<?php } }?>
	</table>
</form>