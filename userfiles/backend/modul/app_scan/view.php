<div class="box-content" id="ujian_realtime">
	<div class="card  card-navy">
		  <div class="card-header border-0">
			<h3 class="card-title">Scan</h3>
		  </div>
		  <div class="card-body table-responsive">
				<div id="reader" width="600px"></div>
		  </div>
	</div>
</div>

<?php
$url_data=backendurl("$modul/data?category_id=$category_id&is_paid=$action");

$script_js.=<<<END

<script>
 const html5QrCode = new Html5Qrcode("reader");
            var nextScan = 1;

            const continueScan = () => {
                nextScan = 1;
                $('.ticket_details').html("Menunggu scan tiket...");
            };
            const qrCodeSuccessCallback = (decodedText, decodedResult) => {
                // if (nextScan === null || moment().isSameOrAfter(nextScan)) {
                if (nextScan === 1) {
                    
                }

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
END;
?>