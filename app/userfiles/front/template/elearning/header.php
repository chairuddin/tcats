<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Uji Kompetensi GGF</title>
    <link rel="stylesheet" href="<<<TEMPLATE_URL>>>/asset/css/style.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="shortcut icon" href="favicon.ico"/>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
      rel="stylesheet"
    />
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
  <header class="bungkusan bg-primary position-fixed top-0">
     
      <div class="d-flex flex-row pt-1">
        <img onclick="window.location.href='<?=fronturl('profil')?>'"
          src="https://clipground.com/images/icon-orang-png-6.png "
          alt=""
          width="px"
          height="27px"
          class=""
        />
        <p class="text-header text-white" style="font-size:17px"  onclick="window.location.href='<?=fronturl('profil')?>'"><?php echo $auth_data['username'];?></p>
      </div>
      <i class="fa-solid fa-bars fs-4 px-2 pt-2" style="color: #ffffff"></i>
    </header>
  <?php endif;?>

  <?php if($config_top_bar==2) :?> 
  <header class="bungkusan bg-primary position-fixed top-0">
    <a href="<?=fronturl('');?>" class="d-flex align-items-center text-white text-decoration-none gap-2">
        <i class="fa-solid fa-chevron-left"></i>
        <p class="m-0 fs-5 fw-medium">&nbsp;&nbsp;&nbsp;&nbsp;</p>
      </a>
      <i class="fa-solid fa-bars fs-4 px-2 pt-2" style="color: #ffffff"></i>
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
		