<div class="row">
	<div class="col-md-6"></div>
	<div class="col-md-2"></div>
	<div class="col-md-4" style="text-align: center; font-size: 14px;font-family: sans-serif;margin-top: 1%;">
		<b>
			<?php  include '../../connections/connection_db.php';
			date_default_timezone_set('Asia/Jakarta');
			$query=mysqli_query($con,"select * from user where status_user='1'");
			$user=mysqli_fetch_array($query);
			$ttd=$user['nama'];
			$nip=$user['nip'];

			?>
			<p>Banjarmasin, <?php echo date('d-m-Y'); ?> </p>
			<p style="margin-bottom: 70px;">KABAG PEMERINTAHAN</p>
			<p><u><?php echo $ttd; ?></u><br>NIP. <?php echo $nip; ?></p>
		</b>
	</div>
</div>
</div>
<script src="../assets/jquery/dist/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>
</html>