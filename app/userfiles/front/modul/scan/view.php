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

if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    // Start QR code scanner
    html5QrCode.start({ facingMode: { exact: "environment" } }, config, onScanSuccess, onScanError)
    .catch(err => {
        console.error('Failed to start QR code scanner:', err);
    });
} else {
    alert("Camera access is not supported on this browser.");
}

 const html5QrCode = new Html5Qrcode("reader");
         
            const continueScan = () => {
              
              
            };
            const qrCodeSuccessCallback = (decodedText, decodedResult) => {
             

            };


            const config = {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            };

            html5QrCode.start({
                facingMode: "environment"
            }, config, qrCodeSuccessCallback);
</script>