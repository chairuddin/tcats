   <a href="#" onclick="window.history.back();" class="text-black"
      ><header
        class="position-fixed z-3 top-0 w-100 d-flex justify-content-start align-items-baseline gap-2 pt-3 px-3"
      >
        <p class="icon"><i class="icon fa-solid fa-angle-left fa-lg"></i></p>
        <p class="teks">Notifikasi</p>
      </header></a
    >
    <main>
      <ul class="list-group">
         <?php foreach($data as $i =>$notifikasi):?>
        <li class="list-group-item">
          <img class="profil" src="<<<TEMPLATE_URL>>>/asset/image/pp.jpg" alt="" /> <?=$data['title']?>
        </li>
       <?php endforeach;?>
      </ul>
    </main>