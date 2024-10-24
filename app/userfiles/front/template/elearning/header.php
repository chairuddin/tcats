<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Uji Kompetensi GGF</title>
    <link rel="shortcut icon" href="<?=fronturl();?>favicon.png"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?=fronturl();?>/userfiles/front/template/elearning/asset/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?=fronturl();?>/userfiles/front/template/elearning/asset/css/style.css?v=<?php echo rand(); ?>" />
    <style>
      .nav-link {
        border-bottom: 2px solid transparent;
      }
      .nav-link.active {
        border-bottom: 2px solid #39d425;
        color: #39d425;
      }
      #myTab {
        -ms-overflow-style: none; /* IE and Edge */
        scrollbar-width: none; /* Fireox */
      }
      #myTab::-webkit-scrollbar {
        display: none; /* Chrome, Safari, Opera */
      }
    </style>
  </head>
  <body>
  <?php if($config_top_bar==1) :?> 
  <header class="bungkusan bg-primary position-fixed top-0 align-items-center">
      <a href="<?=fronturl();?>" class="white-logo">
          <img 
              src="<?=fileurl('asset/logo-white.png')?>"
              alt=""
              width="px"
              height="40px"
            />
      </a>
     <div class="container d-flex justify-content-between align-items-center">
          <div class="d-flex flex-row profile-block" onclick="window.location.href='<?=fronturl('profil')?>'">
            <img
              src="<?=fileurl('asset/icon-orang-png-6.png')?>"
              alt=""
              width="px"
              height="27px"
              class=""
            />
            <p class="text-header text-white ms-2 mb-0"><?php echo $auth_data['username'];?> / <?php echo $auth_data['organization_unit'];?></p>
          </div>
          
          <div class="btn-group">
              <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa-solid fa-bars fs-4 px-2 py-2" style="color: #ffffff"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end">
                <button class="dropdown-item" type="button" onclick="window.location.href='<?=fronturl('profil')?>'">Profile</button>
                <button class="dropdown-item" type="button" onclick="window.location.href='<?=fronturl('logout')?>'">Logout</button>
              </div>
            </div>
     </div>
    </header>
  <?php endif;?>

  <?php if($config_top_bar==2) :?> 
  <header class="bungkusan bg-primary position-fixed top-0">
      <a href="<?=fronturl();?>" class="white-logo">
      <img 
          src="<?=fileurl('asset/logo-white.png')?>"
          alt=""
          width="px"
          height="40px"
        />
        </a>
     <div class="container d-flex justify-content-between align-items-center">
         <div class="d-flex align-items-center">
             
            <a <?=$custom_back_url!=""?'href="'.$custom_back_url.'"':'onclick="history.back()"';?> class="d-flex align-items-center text-white text-decoration-none gap-2 ms-1 me-3">
                <i class="fa-solid fa-chevron-left"></i>
              </a>
              <div class="d-flex flex-row profile-block" onclick="window.location.href='<?=fronturl('profil')?>'">
                <img
                  src="<?=fileurl('asset/icon-orang-png-6.png')?>"
                  alt=""
                  width="px"
                  height="27px"
                  class=""
                />
                <p class="text-header text-white ms-2 mb-0"><?php echo $auth_data['username'];?> / <?=$auth_data['organization_unit']?></p>
              </div>
         </div>
              
              <div class="btn-group">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa-solid fa-bars fs-4 px-2 py-2" style="color: #ffffff"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <button class="dropdown-item" type="button" onclick="window.location.href='<?=fronturl('profil')?>'">Profile</button>
                    <button class="dropdown-item" type="button" onclick="window.location.href='<?=fronturl('logout')?>'">Logout</button>
                  </div>
                </div>
        </div>
    
    </header>
  <?php endif;?>

  <?php if($hide_bottom_bar!==1 and false) :?>
    <nav
      class="nav bg-primary w-100 p-2 position-fixed bottom-0 border-top border-2 z-3"
    >
      <div class="d-flex justify-content-around w-100">
        <a
          href="/"
          class="book d-flex flex-column justify-content-center align-items-center text-decoration-none gap-2"
          style="color: white"
        >
          <i class="fa-solid fa-magnifying-glass"></i>
          <p class="m-0" style="font-size: 12px">Search</p>
        </a>

        <a
          href="transaksi.html"
          class="bag d-flex flex-column justify-content-center align-items-center text-decoration-none gap-2"
        >
          <i class="fa-solid fa-heart" style="color: #000000"></i>
          <p class="m-0" style="font-size: 12px; color: black">Saved</p>
        </a>

        <a
          href="pembelihan.html"
          class="wallet d-flex flex-column justify-content-center align-items-center text-decoration-none gap-2"
        >
          <i class="fa-solid fa-sliders" style="color: #000000"></i>
          <p class="m-0" style="font-size: 12px; color: black">Filter</p>
        </a>
      </div>
    </nav>
    <?php endif;?>

		<!-- Header -->
		