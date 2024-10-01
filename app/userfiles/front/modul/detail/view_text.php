<a href="#" onclick="window.history.back();" class="text-black"
      ><header
        class="position-fixed z-3 top-0 w-100 d-flex justify-content-start align-items-baseline gap-2 pt-3 px-3"
      >
        <p class="icon"><i class="icon fa-solid fa-angle-left fa-lg"></i></p>
        <p class="teks"><?=$detail['title']?></p>
      </header></a>
      
<?php if($detail['type']=='text'):?>
<div class="main mb-5">
<?=$detail['content'];?>
</div>
<?php endif;?>


