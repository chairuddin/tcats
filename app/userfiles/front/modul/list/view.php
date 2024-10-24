  <main class="wrapper">
    <div class="container">
      <form class="search-kompetensi d-flex justify-content-center" action="" method="GET">
        <div class="search-box input-group">
          <input
            type="text"
            class="form-control"
            placeholder="Cari kompetensi"
            aria-label="Username"
            aria-describedby="basic-addon1"
            name="keyword"
            value="<?=$_REQUEST['keyword']?>"
          />
          <button type="submit" class="input-group-text" id="basic-addon1"
            >Search</i
          ></button>
        </div>
      </form>
      <div class="row">
        <?php if(count($course_sub)>0 ) : ?>
          <?php foreach($course_sub as $cs => $data): ?>
            <div class="col-12 col-lg-4 mb-4">
              <div class="kompetensi wrap mx-auto d-flex flex-column justify-content-center" onclick="window.location.href='<?php echo fronturl("kompetensi/".md5($data['id']));?>'">
                <img src="<?=$data['image']?>" alt="" class="gambar" />
                <div class="title-kompetensi">
                   <h6 class="mb-0"><?=$data['title']?></h6>
                </div>
              </div>
            </div>
          <?php endforeach;?>
      </div>
      <?php else :?>
        <div class="col-12 ">
              <div class="justify-content-center" >
               
                <div class="alert alert-warning">
                  Data tidak ditemukan
                </div>
              </div>
            </div>
      <?php endif?>
  </div>
</main>
<?php $custom_back_url=fronturl();?>   
<?php $config_top_bar=2; ?>