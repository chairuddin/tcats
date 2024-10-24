    <?php if(!$pengajuan_aktif): ?>
    <div class="container">
        <div class="card mb-4 mb-lg-5">
            <div class="card-body">
                <h5 class="card-title">Pengajuan Ujian Ulang</h5>
                <div class="text-center"><b>Kompetensi : <?=$judul_kompetensi?></b></div>
                
                
            </div>
            <div class="d-md-flex justify-content-center mt-3 ">
              <a href="<?=fronturl("retake/$action?submit=1")?>" class="btn btn-success mt-4 mt-md-0"><i class="fas fa-file-alt" aria-hidden="true"></i> Ajukan Sekarang</a>
    
            </div>
            <p class="">&nbsp;</p>
            <?=$retake_message;?>
            <p class="">&nbsp;</p>
            
        </div>
    </div>
    <?php endif;?>

    <?php if($pengajuan_aktif): ?>
    <div class="container">
        <div class="card mb-4 mb-lg-5">
            <div class="card-body">
                <h5 class="card-title">Menunggu Persetujuan</h5>
                <div class="text-center" style="display:none;"><b>Kompetensi : <?=$judul_kompetensi?></b></div>
                <div class="text-center alert alert-success">
                
                <?=$retake_message_waiting;?>
                </div>
                
                
            </div>

            <p class="">&nbsp;</p>
           
            <p class="">&nbsp;</p>
            
        </div>
    </div>
    <?php endif;?>


<?php $custom_back_url=fronturl("kompetensi/".md5($id_kompetensi));?>   
<?php $config_top_bar=2; ?>