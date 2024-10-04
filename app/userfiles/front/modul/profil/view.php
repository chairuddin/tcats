
    <div class="container d-flex flex-column align-items-center">
        <div class="text-center rounded mt-4" style="padding: 10px;">
            <img src="<?=fileurl('asset/icon-orang-png-6.png')?>" alt="Placeholder Image" class="img-fluid rounded-circle" style="width: 200px; height: 200px;">
        </div>

        <div class="text-center mb-4">
            <div class="name-profile"><?=$fullname ?></div>
            <div class="email-profile"><?php echo $auth_data['username'];?></div>
            <div class="d-flex align-items-center justify-content-center">
                <p class="mb-0 fs-5"><?=$jurusan ?></p>
            </div>
        </div>
        
        

        <div class="list-kompetensi">
            <div class="kompetensi-box d-md-flex justify-content-between align-items-start">
                <div class=" d-flex justify-content-start align-items-center mb-0 w-100">
                    <div class="d-flex flex-column align-items-start">
                        <h5 class="mb-0 fw-bold">Operator Engine Irrigator</h5>
                        <p class="text-muted">Kompetensi 1</p>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-start mx-lg-3 mb-3 ">
                    <i class="fa-solid fa-bell me-2 mt-1"></i>
                    <p class="mb-0 fw-bold text-success text-nowrap">Competent</p>
                </div>
            </div>
            <div class="kompetensi-box d-md-flex justify-content-between align-items-start">
                <div class=" d-flex justify-content-start align-items-center mb-0 w-100">
                    <div class="d-flex flex-column align-items-start">
                        <h5 class="mb-0 fw-bold">Operator Engine Irrigator</h5>
                        <p class="text-muted">Kompetensi 1</p>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-start mx-lg-3 mb-3 ">
                    <i class="fa-solid fa-bell me-2 mt-1"></i>
                    <p class="mb-0 fw-bold text-danger text-nowrap">Not Competent</p>
                </div>
            </div>
        </div>

    </div>

<?php $config_top_bar=2; ?>