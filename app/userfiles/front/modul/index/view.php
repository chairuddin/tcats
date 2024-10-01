  <main class="wrapper">
      <div class="d-flex justify-content-center">
        <div class="search-box input-group mb-3 w-75">
          <span class="input-group-text" id="basic-addon1"
            ><i class="fa-solid fa-magnifying-glass" style="color: #000000"></i
          ></span>
          <input
            type="text"
            class="form-control"
            placeholder="Search..."
            aria-label="Username"
            aria-describedby="basic-addon1"
          />
        </div>
      </div>
      <?php foreach($course_sub as $cs => $data): ?>
      <div class="kompetensi wrap w-75 mx-auto d-flex flex-column justify-content-center" onclick="window.location.href='<?php echo fronturl("kompetensi/".md5($data['id']));?>'">
        <img src="<?=$data['image']?>" alt="" class="gambar" />
        <div class="d-flex flex-row mt-2 mb-5">
           <h6 class=""><?=$data['title']?></h6>
        </div>
      </div>
      <?php endforeach;?>
    </main>

    <?php $config_top_bar=1; ?>