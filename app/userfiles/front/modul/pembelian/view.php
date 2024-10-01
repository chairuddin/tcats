 <a href="#" onclick="window.history.back();" class="text-black"
      ><header
        class="position-fixed z-3 top-0 w-100 d-flex justify-content-start align-items-baseline gap-2 pt-3 px-3"
      >
        <p class="icon"><i class="icon fa-solid fa-angle-left fa-lg"></i></p>
        <p class="teks">Pembelian</p>
      </header></a
    >

    <main class="d-flex justify-content-center align-items-center flex-column">
        <?php foreach($product as $i => $info):?>
            <div
        class="m-2 rounded"
        style="
          width: 95%;
          background-color: rgb(235, 225, 225);
          box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px,
            rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
        "
      >
        <div class="w-90 d-flex justify-content-start align-items-center">
          <div class="image">
            <img src="<<<TEMPLATE_URL>>>/asset/image/buku.png" alt="buku" width="100px" />
          </div>
          <div>
            <p class="m-0 fw-bold" style="color: orangered"><?=$info['title'];?></p>
            <p class="m-0 fw-bold"><?=$info['subtitle'];?></p>
            <p class="m-0 text-decoration-line-through text-secondary-emphasis">
              <?=$info['price_promo'];?>
            </p>
            <h3 class="fw-bold t-h" style="color: orangered"><?=$info['price'];?></h3>
          </div>
        </div>
        <div>
          <div class="d-flex justify-content-around">
           <?php if($info['is_paid']==0): ?>      
            <button
              class="btn rounded-pill w-100 m-2"
              type="button"
              data-bs-toggle="offcanvas"
              data-bs-target="#offcanvasBottom<?=$info['id'];?>"
              aria-controls="offcanvasBottom"
              style="background-color: orangered; color: white"
            >
              <p class="m-0">Lihat Benefit</p>
            </button>
            <button
              class="btn rounded-pill w-100 m-2"
              type="button"
              data-bs-toggle="offcanvas"
              data-bs-target="#offcanvasBottom<?=$info['id'];?>"
              aria-controls="offcanvasBottom"
              style="color: white; background-color: rgb(26, 26, 219)"
            >
              <p class="m-0">Beli</p>
            </button>
            <?php endif;?>
            <?php if($info['is_paid']==1): ?>   
            <?php
            $url_category=fronturl('?category='.md5($info['category_id']).'#idx1');
            ?>
             <button
              class="btn rounded-pill w-100 m-2"
              type="button"
              onclick="window.location.href='<?=$url_category?>'"
              style="color: white; background-color: rgb(26, 26, 219)"
            >
              <p class="m-0">Belajar</p>
             <?php endif;?>
          </div>
        </div>
      </div>
        <?php endforeach;?>
    </main>

     <?php foreach($product as $i => $info):?>
    <div
      class="offcanvas offcanvas-bottom"
      tabindex="-1"
      id="offcanvasBottom<?=$info['id'];?>"
      aria-labelledby="offcanvasBottomLabel"
      style="height: 75%"
    >
     
      <div class="offcanvas-body p-0">
        <div class="m-2 rounded" style="width: 95%">
          <div class="w-100 d-flex justify-content-start align-items-center">
            <div class="image">
              <img src="<<<TEMPLATE_URL>>>/asset/image/buku.png" alt="buku" width="100px" />
            </div>
            <div>
              <p class="m-0 fw-bold" style="color: orangered">
                <?=$info['title']?>
              </p>
              <p class="m-0 fw-bold"> <?=$info['title']?></p>
              <p
                class="m-0 text-decoration-line-through text-secondary-emphasis"
              >
                 <?=$info['price_promo']?>
              </p>
              <h3 class="fw-bold t-h" style="color: orangered"><?=$info['price']?></h3>
            </div>
          </div>
       
        </div>
         <div class="d-block m-5">
               <?=$info['content']?>  
            </div>
        <div class="d-flex justify-content-center">
          <button
            class="btn btn-offcanvas rounded-pill w-50 mx-auto position-absolute right-50% left-50%"
            style="
              bottom: 20px;
              background-color: rgb(239, 232, 232);
              color: purple;
              box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1),
                0px 4px 8px rgba(0, 0, 0, 0.2);
              border: none;
              border-radius: 40%;
            "
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasBottom"
            aria-controls="offcanvasBottom"
          >
            <p class="m-0" onclick="beli('<?=$info['id']?>')">Beli</p>
          </button>
        </div>
      </div>
    </div>
    <?php endforeach;?>
<?php
$pembayaran_url=fronturl('pembayaran');
$script_js .=<<<end
<script>
function beli(product_id) {

    $.ajax({
                url: '$api_kInsertPembelian', 
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    token: '$auth_token',
                    product_id: product_id
                }),
                success: function(parsedJson) {
                  console.log(parsedJson);
                    if (parsedJson.success == '1') {
                       window.location.href='$pembayaran_url/'+parsedJson.md5;
                    } else {
                        resolve(0);
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                    reject(0);
                }
            });
}
</script>
end;

?>    