  <main class="wrapper">
    <div class="container">

      <div class="row">
          <div class="col-12 mb-4">
              <div id="reader" width="600px"></div>
          </div>
          
      </div>
  </div>
</main>

<?php $config_top_bar=1; ?>

<script src="<?php echo $kUrl;?>/panel/template2/plugins/html5-qrcode/html5-qrcode.min.js" type="text/javascript"></script>    
<script>
//window.location.href='http://localhost/ukomggf/app/profil/ff65889ed601360360342f68c2c8c336'

const html5QrCode = new Html5Qrcode("reader");

if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {    

            const qrCodeSuccessCallback = (decodedText, decodedResult) => {
                //window.location.href='http://localhost/ukomggf/app/profil/ff65889ed601360360342f68c2c8c336'
                fetch('<?=fronturl("api_scan_member")?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ code: decodedText })
                })
                .then(response => response.json())
                .then(data => {
                    //alert(response); //
                    if (data.success) {
                        // Redirect to another page if the API returns success
                    //    window.location.href = '<?=fronturl("profil/")?>'+data.member_id;
                    } else {
                        alert('Invalid QR code');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            };

            function qrCodeErrorCallback(errorMessage) {
                // Handle scan failure, no need to alert every error
                console.warn(`QR Code scan error: ${errorMessage}`);
              }
                
            const config = {
                fps: 15,
                qrbox: {
                    width: 300,
                    height: 300
                }
            };

            html5QrCode.start({
                facingMode: "environment"
            }, config, qrCodeSuccessCallback, qrCodeErrorCallback);
} else {
    alert("Camera access is not supported on this browser.");
}


            
</script>