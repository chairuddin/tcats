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
              <h1 class="title-header">Kategori kompetensi</h1>
          </div>
          <?php foreach($courses as $cs => $data): ?>
            <div class="col-12 col-lg-4 mb-4">
              <div class="kompetensi kategori-kompetensi wrap mx-auto d-flex flex-column justify-content-center" onclick="window.location.href='<?php echo fronturl("list/".md5($data['id']));?>'">
                <img src="<?=$data['thumbnail']?>" alt="" class="gambar" />
                <div class="title-kompetensi">
                   <h6 class="mb-0"><?=$data['title']?></h6>
                </div>
              </div>
            </div>
          <?php endforeach;?>
      </div>
  </div>
</main>

    <?php $config_top_bar=1; ?>