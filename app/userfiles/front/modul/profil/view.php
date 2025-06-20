
    <div class="container d-flex flex-column align-items-center">
        <div class="text-center rounded mt-4" style="padding: 10px;">
            <img src="<?=fileurl('asset/icon-orang-png-6.png')?>" alt="Placeholder Image" class="img-fluid rounded-circle" style="width: 200px; height: 200px;">
        </div>

        <div class="text-center mb-4">
            <div class="name-profile"><?=$fullname ?></div>
            <div class="email-profile"><?php echo $username;?> / <?=$organization_unit?></div>
            <div class="d-flex align-items-center justify-content-center">
            <div class="toggle-button" onclick="toggleDetails()" style="padding:0 15px 5px 15px;">
                <i class="fas fa-chevron-down"></i>
            </div>
            </div>
        </div>

        <div class="details" style="padding:0 0 30px 0;display:none;">
            <table class="table">
                <tr><td>Email</td><td>:&nbsp;</td><td><?=$email?></td></tr>
                <tr><td>Position</td><td>:&nbsp;</td><td><?=$position_code?> - <?=$position?></td></tr>
                <tr><td>Supervisor 1</td><td>:&nbsp;</td><td><?=$direct_supervisor_indeks?> - <?=$direct_supervisor_name?></td></tr>
                <tr><td>Supervisor 2</td><td>:&nbsp;</td><td><?=$second_supervisor_indeks?> - <?=$second_supervisor_name?></td></tr>
                <tr><td>Manager</td><td>:&nbsp;</td><td><?=$manager_indeks?> - <?=$manager_name?></td></tr>
            </table>
        </div>
        
        
        
        <div class="list-kompetensi">
            <?php foreach($quiz_done as $i => $data): ?>
            <div class="kompetensi-box d-md-flex justify-content-between align-items-start" onclick="window.location.href='<?=fronturl('result/'.$data['md5_quiz_done_id'])?>'">
                <div class=" d-flex justify-content-start align-items-center mb-0 w-100">
                    <div class="d-flex flex-column align-items-start">
                        <h5 class="mb-0 fw-bold"><?=$data['title']?></h5>
                       
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-start mx-lg-3 mb-3 ">
                    <i class="fa-solid fa-bell me-2 mt-1"></i>
                    <?php if( $data['avg_score']>=$data['kkm'] ): ?>
                        <p class="mb-0 fw-bold text-success text-nowrap">Competent</p>
                    <?php else: ?>
                        <p class="mb-0 fw-bold text-danger text-nowrap">Not Competent</p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach;?>
            <!--
            <div class="kompetensi-box d-md-flex justify-content-between align-items-start">
                <div class=" d-flex justify-content-start align-items-center mb-0 w-100">
                    <div class="d-flex flex-column align-items-start">
                        <h5 class="mb-0 fw-bold">Operator Engine Irrigator</h5>
                     
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-start mx-lg-3 mb-3 ">
                    <i class="fa-solid fa-bell me-2 mt-1"></i>
                    <p class="mb-0 fw-bold text-danger text-nowrap">Not Competent</p>
                </div>
            </div>
            -->
        </div>
        <?php if(count($quiz_done)>0):?>
		<?php echo $paginator->createLinks(); ?>
        <?php endif;?>
        

    </div>
    <script>
           function toggleDetails() {
            const details = document.querySelector('.details');
            const arrow = document.querySelector('.toggle-button i');

            if (details.style.display === 'none' || details.style.display === '') {
                details.style.display = 'block';
                arrow.classList.replace('fa-chevron-down', 'fa-chevron-up');
            } else {
                details.style.display = 'none';
                arrow.classList.replace('fa-chevron-up', 'fa-chevron-down');
            }
            }
        </script>
<?php $config_top_bar=2; ?>
        