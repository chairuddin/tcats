  <main class="wrapper" id="dashboar-page">
    <div class="container">
      <!--
      <form class="search-kompetensi d-flex justify-content-center" action="">
        <div class="search-box input-group">
          <input
            type="text"
            class="form-control"
            placeholder="Cari kompetensi"
            aria-label="Username"
            aria-describedby="basic-addon1"
          />
          <button type="submit" class="input-group-text" id="basic-addon1"
            >Search</i
          ></button>
        </div>
      </form>
-->
      <div class="row justify-content-center">
          <div class="col-12 col-md-4 mb-4">
              <div class="d-flex flex-column justify-content-center">
                  <a href="<?php echo fronturl('scan');?>" class="text-decoration-none text-white d-flex justify-content-center align-items-center">
                    <div class="border bg-primary rounded text-center w-100 p-4 dashboard-item" >
                      <i class="fa-solid fa-chart-pie" style="font-size: 32px"></i><br/>
                      <p class="m-0 fw-medium mt-3">Competency Card Scan [QR Scan]</p>
                    </div>
                  </a>
              </div>
          </div>
          <div class="col-12 col-md-4 mb-4">
              <div class="d-flex flex-column justify-content-center">
                  <a href="<?php echo fronturl('index');?>" class="text-decoration-none text-white d-flex justify-content-center align-items-center">
                    <div class="border bg-primary rounded text-center w-100 p-4 dashboard-item" >
                      <i class="fa-solid fa-chart-pie" style="font-size: 32px"></i><br/>
                      <p class="m-0 fw-medium mt-3">Uji Kompetensi</p>
                    </div>
                  </a>
              </div>
          </div>


      </div>
  </div>
</main>

    <?php $config_top_bar=1; ?>