<?php include_once '../../assets/kop_surat.php';
include '../../connections/connection_db.php';?>
<?php
$id = $_GET['no_surat_show'];
$sql = mysqli_query($con, "select surat_masuk.no_surat,surat_masuk.tgl_surat,surat_masuk.pengirim,surat_masuk.perihal,file.nama_file,file.tgl_masuk,disposisi.catatan,disposisi.tgl, GROUP_CONCAT(penerima SEPARATOR  ' & ') as penerima from disposisi inner join surat_masuk inner join file on surat_masuk.no_surat=disposisi.no_surat and surat_masuk.no_surat=file.no_surat where disposisi.no_surat='$id' GROUP BY disposisi.no_surat order by disposisi.tgl;");
while ($d = mysqli_fetch_array($sql)) {
	$tgl_masuk = tgl_indo(date('D, d-m-Y', strtotime($d['tgl_masuk'])));
	$tgl_surat = tgl_indo(date('D, d-m-Y', strtotime($d['tgl_surat'])));
	$tgl_verif = tgl_indo(date('D, d-m-Y H:i', strtotime($d['tgl'])));
	$tgl_ttd = date('d-m-Y', strtotime($d['tgl']));
	?>
	<div class="row">
		<div class="col-md-12">
			<center>
				<u>
					<h3>LEMBAR DISPOSISI</h3>
				</u>
				<h5>No Surat : <?php echo $d['no_surat'] ?></h5>
			</center>
		</div>
	</div>
	<div class="row" style="margin-top: 2%">
		<div class="col-md-12">
			<div class="main-card mb-3 card-shadow-info border card border-dark">
				<div class="card-body border-warning">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th width="15%">Pengirim</th>
								<td width="1%">:</td>
								<td><?php echo $d['pengirim']; ?></td>
								<th width="15%">Diterima Tanggal</th>
								<td width="1%">:</td>
								<td><?php echo $tgl_masuk; ?></td>
							</tr>
							<tr>
								<th width="15%">Tanggal Surat</th>
								<td width="1%">:</td>
								<td><?php echo $tgl_surat ?></td>
								<th width="15%">Tanggal Diverifikasi</th>
								<td width="1%">:</td>
								<td><?php echo $tgl_verif ?></td>
							</tr>
						</thead>
					</table>
					<label><strong>Perihal :</strong></label>
					<div class="form-group">
						<input type="text" class="form-control" value="<?php echo $d['perihal'] ?>">
					</div>
					<label><strong>Kepada Sodara :</strong></label>
					<div class="form-group">
						<input type="text" class="form-control" value="<?php echo $d['penerima'] ?>">
					</div>
					<div class="form-group">
						<label><strong>Catatan :</strong></label>
						<textarea class="form-control" style="font-size: larger; color: blue"><?php echo $d['catatan']; ?></textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>


<div class="row">
	<div class="col-md-6"></div>
	<div class="col-md-2"></div>
	<div class="col-md-4" style="text-align: center; font-size: 14px;font-family: sans-serif;margin-top: 1%;">
		<b>
			<?php include '../../connections/connection_db.php';
			date_default_timezone_set('Asia/Jakarta');
			$query = mysqli_query($con, "select * from user where name='kabag'");
			$user = mysqli_fetch_array($query);
			$ttd = $user['nama'];
			$nip = $user['nip'];

			?>
			<p>Banjarmasin, <?php echo tgl_indo(date('D d-m-Y',strtotime($tgl_ttd))) ?> </p>
			<p style="margin-bottom: 70px;">KABAG PEMERINTAHAN</p>
			<p><u><?php echo $ttd; ?></u><br>NIP. <?php echo $nip; ?></p>
		</b>
	</div>
</div>
</div>
<script src="../../assets/jquery/dist/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>

</html>
<script> window.print(); </script>