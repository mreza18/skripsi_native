<?php 
include '../../connections/connection_db.php';
session_start();
date_default_timezone_set('Asia/Jakarta');
function sendMessage($telegram_id, $text, $secret_token) {

	$url = "https://api.telegram.org/bot" . $secret_token . "/sendMessage?parse_mode=markdown&chat_id=" . $telegram_id;
	$url = $url . "&text=" . urlencode($text);
	$ch = curl_init();
	$optArray = array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true
	);
	curl_setopt_array($ch, $optArray);
	$result = curl_exec($ch);
	curl_close($ch);
}


if (isset($_REQUEST['submit'])) {
	$no_br=$_POST['no_surat'];
	$tgl=date("Y-m-d H:i:s");
	$catatan=$_POST['catatan'];
	$penerima=$_POST['penerima'];
	$perihal=$_POST['perihal'];
	$jumlah_dipilih = count($penerima);
	$secret_token = "1070076828:AAFr7XYh55CSvb5A6NUIyUfKU2_XdrgFVnk";
	$diteruskan=(count($_POST['penerima'])>0)?implode(' & ', $_POST['penerima']):"";

	

	$query_del=mysqli_query($con,"delete from disposisi where no_surat='$no_br'");
	if ($query_del) {
		for($x=0;$x<$jumlah_dipilih;$x++){
			$query=mysqli_query($con,"insert into disposisi values ('','$no_br','$penerima[$x]','$catatan','$tgl','0','0000-00-00 00:00:00') ");
			$user=mysqli_query($con,"select id_telegram from user where name='$penerima[$x]'");
			while ($us=mysqli_fetch_array($user)) {
				$telegram_id=$us['id_telegram'];
			}
			$text='#-- *Pemberitahuan Disposisi* --#
			Nomor Surat : *'.$no_br.'*,
			Tentang : *'.$perihal.'*,
			Catatan dari Kabag : *'.$catatan.'*,
			Kepada : *'.$penerima[$x].'* 
			#-- no-reply --# ';
			$send[$x]=sendMessage($telegram_id, $text, $secret_token);
		}

		$querysm=mysqli_query($con,"update surat_masuk set status='1' where no_surat='$no_br'");
		$_SESSION['success']='<div class="alert alert-success alert-dismissible fade show" role="alert">
		Berhasil mengedit data No. '.$no_br.' !!!
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
		</div>';
		echo "<script>window.location.href='../disposisi.php'</script>";
	} else {
		$_SESSION['failed']='<div class="alert alert-danger alert-dismissible fade show" role="alert">
		Gagal
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
		</div>';
		echo "<script>window.location.href='../disposisi.php'</script>";
	}
}



?>