<a href="#" onclick="window.history.back();" class="text-black"
      ><header
        class="position-fixed z-3 top-0 w-100 d-flex justify-content-start align-items-baseline gap-2 pt-3 px-3"
      >
        <p class="icon"><i class="icon fa-solid fa-angle-left fa-lg"></i></p>
        <p class="teks">Transaksi</p>
      </header></a
    >

    <main class="d-flex justify-content-center align-items-center flex-column">
    <?php foreach($data as $i =>$transaksi):?>
      <div class="card m-1" style="width: 95%">
        <div
          class="card-body p-3 w-90"
          style="background-color: rgb(209, 220, 255); color: rgb(21, 21, 122)"
        >
          <div class="d-flex justify-content-between align-items-center gap-3">
            <p class="fw-bold m-0"><?=$transaksi['title']?></p>
            <p class="fw-bold m-0" style="color: orangered"><?=$transaksi['total']?></p>
          </div>
          <div class="d-flex justify-content-between align-items-center gap-3">
            <p class="m-0"><?=$transaksi['subtitle']?></p>
            <p class="m-0"><?php echo ($transaksi['is_paid']==1?'Berhasil':'Belum Bayar');?></p>
          </div>
        </div>
      </div>
      <?php endforeach;?>
    
    </main>