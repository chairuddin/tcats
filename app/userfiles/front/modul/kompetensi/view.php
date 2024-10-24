     <div class="container">
        <div class="card mb-4 mb-lg-5">
            <div class="card-body">
                <h5 class="card-title"><?=$course_sub_data['title']?></h5>
                <img src="<?=$course_sub_data['image']?>" class="img-fluid mb-3 img-detail" alt="Irrigation System">
                <?=$course_sub_data['content'];?>

                <div class="clearfix"> </div>
                <?php if($pengajuan_aktif):?>
                    <div class="d-md-flex alert alert-warning d-flex align-items-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                        <div>
                            Anda sudah mengajukan ujian ulang dan menunggu persetujuan dari Admin.
                        </div>
                    </div>
                <?php endif;?>
                <div class="d-md-flex justify-content-between mt-3 footer-detail">
                    <?php if($pretest_done):?>
                    <a href="<?php echo fronturl("result/$md5_pretest_quiz_done_id")?>" class="btn btn-info"><i class="fas fa-file-alt"></i> Pre test Result</a>
                    <?php else:?>
                    <a href="<?php echo fronturl("detail/$md5_pretest_id")?>" class="btn btn-success"><i class="fas fa-file-alt"></i> Take - Pre Test</a>
                    <?php endif;?>
                    <?php if($posttest_done):?>
                    <a href="<?php echo fronturl("result/$md5_posttest_quiz_done_id")?>" class="btn btn-info mt-4 mt-md-0" ><i class="fas fa-file-alt"></i> Post Test Result</a>
                    <?php else:?>
                    <a href="<?php echo fronturl("detail/$md5_posttest_id")?>" class="btn btn-success mt-4 mt-md-0"><i class="fas fa-file-alt"></i> Take - Post Test</a>
                    <?php endif;?>
                    <?php if($posttest_done and !$is_competent and !$pengajuan_aktif):?>
                    <a href="<?php echo fronturl("retake/$md5_posttest_quiz_done_id")?>" class="btn btn-success mt-4 mt-md-0" ><i class="fas fa-file-alt"></i> Retake - Post Test</a>
                    <?php endif?>
                
                </div>
            </div>
        </div>
    </div>
    <?php $custom_back_url=fronturl("list/".md5($course_id));?>   
    <?php $config_top_bar=2; ?>