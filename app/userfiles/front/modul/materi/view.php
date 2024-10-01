<a href="#" onclick="window.history.back();" class="text-black"
      ><header
        class="position-fixed z-3 top-0 w-100 d-flex justify-content-start align-items-baseline gap-2 pt-3 px-3"
      >
        <p class="icon"><i class="icon fa-solid fa-angle-left fa-lg"></i></p>
        <p class="teks">Materi</p>
      </header></a
    >
    
    <div class="main todo-timeline mb-5">
      <div class="row">
        <ul class="v-timeline">
        <?php foreach($data as $i =>$materi):?>
          <li class="col">
            <span class="<?php echo count($data)==($i+1)?'v-timeline-iconn':'v-timeline-icon'; ?>"></span>
            <a href="<?=fronturl('detail/'.md5($materi['id'])); ?>" class="text-decoration-none"
              ><span class="pl-30 top-bold-label text-decoration-none text-dark"
                ><?=$materi['title']?>aaaaaaaaaaa</span
              ></a
            >
             
          </li>
          <?php endforeach;?>
        </ul>
      </div>
    </div>