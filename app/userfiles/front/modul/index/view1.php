<div
      class="info-pengguna w-90 m-3 d-flex align-items-center p-2 bg-white rounded"
    >
   
      <div class="image m-2">
        <img
          src="<<<TEMPLATE_URL>>>/asset/image/pp.jpg"
          alt="profile"
          width="50px"
          height="50px"
          class="rounded-circle"
        />
      </div>

      <div class="w-100 d-flex flex-column justify-content-center">
        <p class="mb-1 name"><?=$auth_data['fullname']?></p>
        <div
          class="progress"
          role="progressbar"
          aria-label="Basic example"
          aria-valuenow="25"
          aria-valuemin="0"
          aria-valuemax="100"
        >
          <div class="progress-bar" style="width: 10%"></div>
        </div>
        <div class="point d-flex align-items-center mt-2">
          <div class="diamond d-flex align-items-baseline me-2">
            <i class="fa-regular fa-gem" style="color: #5f9ece"></i>
            <p class="me-1 point mb-0">10</p>
          </div>
          <div class="coint-point d-flex justify-content-between w-100">
            <div class="coin d-flex align-items-baseline">
              <i class="fa-solid fa-database" style="color: #ffd43b"></i>
              <p class="point mb-0">10</p>
            </div>
            <p class="exp mb-0">20 XP</p>
          </div>
        </div>
      </div>
    </div>

    <header>
      <div
        id="carouselAutoplaying"
        class="carousel slide"
        data-bs-ride="carousel"
      >
        
        <div class="carousel-inner rounded">
        <?php $i=1;?>
         <?php foreach($slide_show['slideshow'] as $slide => $link_slide):?>
          <div class="carousel-item <?php echo $i==1?'active':'';?>">
            <img
              src="<?=$slide?>"
              class="d-block w-100"
              alt="<?=$link_slide?>"
            />
          </div>
          <?php $i++;?>
          <?php endforeach;?>
         
        </div>
        <button
          class="carousel-control-prev"
          type="button"
          data-bs-target="#carouselAutoplaying"
          data-bs-slide="prev"
        >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button
          class="carousel-control-next"
          type="button"
          data-bs-target="#carouselAutoplaying"
          data-bs-slide="next"
        >
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </header>

    <main>
      <div
        class="h-100 bg-white p-1"
        style="border-radius: 30px 30px 1px 1px; width: 95%; margin: auto"
      >
        <a href="<?=fronturl('filter')?>" id="idx1" class="text-decoration-none text-dark"
          ><div class="d-flex justify-content-between align-items-center p-3">
            <div class="text">
              <p class="m-0 fw-500">Program Studi</p>
              <p class="m-0"><?=$category_name_selected?></p>
            </div>
            <div class="see-all">
              <i class="fa-solid fa-angle-right fa-lg"></i>
            </div></div
        ></a>

        <div class="tabs m-2'">
          <div class="mx-3" style="border-bottom: 1px solid gray">
            <div
              class="gap-3 mx-3"
              id="myTab"
              role="tablist"
              style="overflow-x: auto; white-space: nowrap; display: flex"
            >
            <?php foreach($courses as $i =>$course):?>
              <button
                class="nav-link <?=$i==0?'active':''?>"
                id="home-tab"
                data-bs-toggle="tab"
                data-bs-target="#target_<?=$i?>"
                type="button"
                role="tab"
                aria-controls="buku-1000-soal"
                aria-selected="true"
              >
                <p><?=$course['title']?></p>
              </button>
              <?php endforeach;?>
            </div>
          </div>
          <!-- ISI BUKU BUKU -->
        <?php foreach($courses as $i =>$course):?>
          <div class="tab-content" id="myTabContent">
            <div
              class="tab-pane fade show <?=$i==0?'active':''?>"
              id="target_<?=$i?>"
              role="tabpanel"
              aria-labelledby="isi_<?=$course['title']?>"
              tabindex="0"
            >
              <div class="my-4 overflow-scroll">
                <div class="row my-4">
                <?php foreach($course_sub as $x =>$sub_data):?>
                <?php if($sub_data['course_id']==$course['id']):?>
                  <a
                    href="<?=fronturl('materi/'.md5($sub_data['id']))?>"
                    class="col text-decoration-none materi"
                    style="color: darkgray"
                    ><div
                      class="book d-flex flex-column justify-content-center align-items-center"
                    >
                      <p class="m-0"><i class="fa-solid fa-book fa-2xl"></i></p>
                      <br />
                      <p class="text-black"><?=$sub_data['title']?></p>
                    </div></a>
                 <?php endif;?>    
                 <?php endforeach;?>
                 
                </div>
               
              </div>
            </div>
            <?php endforeach;?>
            

          </div>
        </div>
      </div>
    </main>
    
<?php
/*
$script_js .=<<<END
<script>

$.ajax({
    url: '$api_kInfoUrl',
    type: 'GET',
    dataType: 'json',
    success: function(response) {
        console.log(response);
        // For example, you could loop through the users and display them on the page
   
    },
    error: function(xhr, status, error) {
        console.error('Error fetching users:', error);
    }
});

</script>
END;
*/

?>