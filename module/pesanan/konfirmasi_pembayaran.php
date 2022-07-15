<?php

	$pesanan_id = $_GET['pesanan_id'];

?>

<div id="frame-keterangan-pembayaran">
	<p>Silahkan Lakukan pembayaran ke BANK BCA SYARIAH<br />
		Nomor Rekening :0670140011 a/n Muhammad Maulana Farabi .<br />
		Jika sudah, silahkan isi form dibawah ini untuk konfirmasi<br/>
		pembayaran anda</p>
</div>
<table class="table-list">



	<form action="<?php echo BASE_URL."module/pesanan/action.php?pesanan_id=$pesanan_id"; ?>"method="POST">
	
		<div class="element-form">
			<label>Nomor Rekening</label>
			<span><input type="text" name="nomor_rekening" / ></span>
		</div>
		
		<div class="element-form">
			<label>Nama Account</label>
			<span><input type="text" name="nama_account" / ></span>
		</div>
		
		<div class="element-form">
			<label>Tanggal Transfer (format : yyyy-mm-dd)</label>
			<span><input type="text" name="tanggal_transfer" / ></span>
		</div>
		
		<div class="element-form">
			<span><input type="submit" value="Konfirmasi" name="button" /></span>
		</div>

</table>