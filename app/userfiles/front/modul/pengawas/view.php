  <main class="wrapper">
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
      <div class="row">
          <div class="col-12 mb-4">
          </div>
          <div class="d-flex flex-column justify-content-center gap-4" style="height:10vh">
              <a href="<?php echo fronturl('scan');?>" class="text-decoration-none text-white d-flex justify-content-center align-items-center mx-3">
                <div class="border d-flex align-items-center gap-3 p-4 w-100 bg-primary rounded" >
                  <i class="fa-solid fa-chart-pie" style="font-size: 32px"></i>
                  <p class="m-0 fw-medium">Competency Card Scan [QR Scan]</p>
                </div>
              </a>
          </div>

          <div class="d-flex flex-column justify-content-center gap-4" style="height:">
              <a href="<?php echo fronturl('index');?>" class="text-decoration-none text-white d-flex justify-content-center align-items-center mx-3">
                <div class="border d-flex align-items-center gap-3 p-4 w-100 bg-primary rounded" >
                  <i class="fa-solid fa-chart-pie" style="font-size: 32px"></i>
                  <p class="m-0 fw-medium">Uji Kompetensi</p>
                </div>
              </a>
          </div>


      </div>
  </div>
</main>

    <?php $config_top_bar=1; ?>