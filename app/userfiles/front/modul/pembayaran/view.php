 <a href="#" onclick="window.location.href='<?=fronturl();?>'" class="text-black"
      ><header
        class="position-fixed z-3 top-0 w-100 d-flex justify-content-start align-items-baseline gap-2 pt-3 px-3"
      >
        <p class="icon"><i class="icon fa-solid fa-angle-left fa-lg"></i></p>
        <p class="teks">Pembayaran</p>
      </header>
      </a>

    <main class="d-flex m-5 flex-column">
<br/><br/>        
<?php if($is_paid) { ?>
<p>Terima kasih <?php echo $customer['fullname'];?>,</p>
<p>Anda telah menyelesaikan pembelian <?php echo $d['title'];?></p>

<?php } ?>

<?php if(!$is_paid) { ?>
<p>Terima kasih <?php echo $customer['fullname'];?>,</p>
<p>Berikut ini adalah langkah-langkah untuk menyelesaikan pembelian <?php echo $d['title'];?></p>
<p>Jumlah yang ditransfer adalah [nominal],- + kode unik yang dipilih secara acak oleh sistem untuk identifikasi transfer yang Anda lakukan. Pastikan jumlah yang ditransfer tertera di bawah ini:</p>
<p><strong><?php echo currency($d['total'],'Rp ');?>,-</strong><br /><br />Dana ditransfer ke:<br />Nama :FERI ANDIKA<br />Bank : BRI<br />No rekening: 726201001719502<br />Bank : BNI<br />No Rekening : 0696972382</p>
<p>&nbsp;</p>
<p>Pastikan jumlah ditransfer sesuai nominal di atas. Ketidaksesuaian jumlah yang ditransfer dapat memperlambat proses verifikasi yang dilakukan oleh sistem kami. Setelah melakukan transfer, mohon mengirimkan bukti transfer beserta nama lengkap pengguna via WhatsApp ke nomor ini&nbsp;<br/>
<a href="https://wa.me/6285361466360">&nbsp;<img src="https://wifiukai.com/userfiles/file/web/media/source/580b57fcd9996e24bc43c543.png" alt="580b57fcd9996e24bc43c543" width="30" height="30" />0853 6146 6360</a>.</p>
<?php } ?>   
 
  
    </main>