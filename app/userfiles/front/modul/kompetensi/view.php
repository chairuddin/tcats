     <div class="container">
        <div class="card mb-4 mb-lg-5">
            <div class="card-body">
                <h5 class="card-title"><?=$course_sub_data['title']?></h5>
                <img src="<?=$course_sub_data['image']?>" class="img-fluid mb-3 img-detail" alt="Irrigation System">
                <?=$course_sub_data['content'];?>
                <div class="d-md-flex justify-content-between mt-3 footer-detail">
                    <?php if($pretest_done):?>
                    <a href="<?php echo fronturl("result/$md5_pretest_quiz_done_id")?>" class="btn btn-info"><i class="fas fa-file-alt"></i> Pre test Result</a>
                    <?php else:?>
                    <a href="<?php echo fronturl("detail/$md5_pretest_id")?>" class="btn btn-success mt-4 mt-md-0"><i class="fas fa-file-alt"></i> Take - Pre Test</a>
                    <?php endif;?>
                    <?php if($posttest_done):?>
                    <a href="<?php echo fronturl("result/$md5_posttest_quiz_done_id")?>" class="btn btn-info" ><i class="fas fa-file-alt"></i> Post Test Result</a>
                    <?php else:?>
                    <a href="<?php echo fronturl("detail/$md5_posttest_id")?>" class="btn btn-success mt-4 mt-md-0"><i class="fas fa-file-alt"></i> Take - Post Test</a>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>

    <?php $config_top_bar=2; ?>