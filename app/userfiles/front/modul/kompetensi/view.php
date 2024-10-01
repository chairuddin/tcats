     <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?=$course_sub_data['title']?></h5>
                <img src="<?=$course_sub_data['image']?>" class="img-fluid mb-3" alt="Irrigation System">
                <?=$course_sub_data['content'];?>
                <div class="d-flex justify-content-between mt-3">
                    <?php if($pretest_done):?>
                    <a href="<?php echo fronturl("result/$md5_pretest_id")?>" class="btn btn-info"><i class="fas fa-file-alt"></i> Pre test Result</a>
                    <?php else:?>
                    <a href="<?php echo fronturl("detail/$md5_pretest_id")?>" class="btn btn-success"><i class="fas fa-file-alt"></i> Take - Pre Test</a>
                    <?php endif;?>
                    <?php if($posttest_done):?>
                    <a href="<?php echo fronturl("result/$md5_posttest_id")?>" class="btn btn-info" ><i class="fas fa-file-alt"></i> Post Test Result</a>
                    <?php else:?>
                    <a href="<?php echo fronturl("detail/$md5_posttest_id")?>" class="btn btn-success"><i class="fas fa-file-alt"></i> Take - Post Test</a>
                    <?php endif;?>
                </div>
                <br/><br/><br/><br/>
            </div>
        </div>
    </div>

    <?php $config_top_bar=2; ?>