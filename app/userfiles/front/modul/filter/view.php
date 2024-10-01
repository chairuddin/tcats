 <a href="<?=fronturl()?>" class="text-black"
      ><header
        class="position-fixed z-3 top-0 w-100 d-flex justify-content-between align-items-baseline gap-2 pt-3 px-3"
      >
        <div class="d-flex align-items-baseline gap-2">
          <p class="icon"><i class="icon fa-solid fa-angle-left fa-lg"></i></p>
          <p class="teks">Program Studi</p>
        </div>
        <p class="icon">
          <i class="fa-solid fa-magnifying-glass fa-lg"></i>
        </p></header
    ></a>
    <?php foreach($category as $category_title => $zero): ?>
    <div class="main d-flex justify-content-between align-items-center">
      <p class="m-0 profesi"><?=$category_title?></p>
      <p class="m-0 profesi"><?=count($sub_category[$category_title])?></p>
    </div>

    <div class="d-flex flex-wrap">
      <?php foreach($sub_category[$category_title] as $sub_category_id => $sub_data): ?>
      <a href="<?=fronturl("?category=".md5($sub_data['id']))?>#idx1" class="btn rounded-pill"><?=$sub_data['title']?></a>
      <?php endforeach;?>
    </div>
    <?php endforeach;?>