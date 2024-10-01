<div class="container">
      <h1 class="text-center mb-2">Competency Gap</h1>
      <div class="row justify-content-center">
        <canvas id="myChart" class="w-100 h-25"></canvas>
      </div>
    </div>
    <section class=" mx-4 mt-3" >
      <?php foreach($data_kd as $x =>$kd) : ?>
      <div>
        <h5>Competency <?=$x+1?></h5>
        <p><?=$kd['nama']?></p>
      </div>
      <?php endforeach; ?>
      <
    </section>
    <div class="m-3" style="display:none;">
      <button class="btn btn-primary w-100" onclick="history.back();">Back</button>
    </div>
    <!-- </section> -->


  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
  // Data for chart
  const data = {
    labels: [
      <?=$join_code?>
    ],
    datasets: [
      {
        label: "Percentage",
        data: [ <?=$join_score?>],
        backgroundColor: function (context) {
          const value = context.raw;
          const index = context.dataIndex;

          // Define thresholds for each bar
          const thresholds = [<?=$join_treshold?>];

          // Apply color based on threshold
          return value < thresholds[index] ? "red" : "lightgreen";
        },
        borderColor: function (context) {
          const value = context.raw;
          const index = context.dataIndex;

          // Define thresholds for each bar
          const thresholds = [<?=$join_treshold?>];

          // Apply border color based on threshold
          return value < thresholds[index] ? "darkred" : "green";
        },
        borderWidth: 1,
        borderRadius: 3,
      },
    ],
  };

  // Configuration for the chart
  const config = {
    type: "bar",
    data: data,
    options: {
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            // Display percentage values
            callback: function (value) {
              return value + "%";
            },
          },
        },
      },
      plugins: {
        tooltip: {
          callbacks: {
            // Show tooltip in percentage format
            label: function (tooltipItem) {
              return tooltipItem.raw + "%";
            },
          },
        },
      },
    },
  };

  // Initialize the chart
  const myChart = new Chart(document.getElementById("myChart"), config);
</script>

    
<?php $config_top_bar=2; ?>