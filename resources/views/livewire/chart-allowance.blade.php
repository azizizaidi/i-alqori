<div>
@if(auth()->user()->roles->contains(1) || auth()->user()->roles->contains(2))
<div x-data="{ chart: null }" x-init="">
  <h1>Jumlah Elaun Guru</h1>
  <hr>

  <div class="m-auto">
    <div class="">
        <label for="year">Pilih Tahun:</label>
        <select id="yearSelect" onchange="updateChart()">
            <option value="">Pilih Tahun</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
        </select>
    </div>

    <div class="col-lg-10">
      <div class="card text-grey bg-white rounded-3 shadow p-1">
        <div class="body">
          <canvas id="myChart" class="chartjs" data-height="400" height="500" style="display: block; box-sizing: border-box; height: 400px; width: 592.8px;" width="741"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>
@endif

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0/dist/chartjs-plugin-datalabels.min.js"></script>
<script>



var alwjan22 = <?php echo $reportclasses->where('month',null)->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwfeb22 = <?php echo $reportclasses->where('month','02-2022')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwmar22 = <?php echo $reportclasses->where('month','03-2022')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwapr22 = <?php echo $reportclasses->where('month','04-2022')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwmay22 = <?php echo $reportclasses->where('month','05-2022')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwjun22 = <?php echo $reportclasses->where('month','06-2022')->whereNull('deleted_at')->sum('allowance') ?? ''?>;
var alwjul22 = <?php echo $reportclasses->where('month','07-2022')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwogs22 = <?php echo $reportclasses->where('month','08-2022')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwsep22 = <?php echo $reportclasses->where('month','09-2022')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwoct22 = <?php echo $reportclasses->where('month','10-2022')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwnov22 = <?php echo $reportclasses->where('month','11-2022')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwdec22 = <?php echo $reportclasses->where('month','12-2022')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwjan23 = <?php echo $reportclasses->where('month','01-2023')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwfeb23 = <?php echo $reportclasses->where('month','02-2023')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwmar23 = <?php echo $reportclasses->where('month','03-2023')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwapr23 = <?php echo $reportclasses->where('month','04-2023')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwmay23 = <?php echo $reportclasses->where('month','05-2023')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwjun23 = <?php echo $reportclasses->where('month','06-2023')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwjul23 = <?php echo $reportclasses->where('month','07-2023')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwogs23 = <?php echo $reportclasses->where('month','08-2023')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwsep23 = <?php echo $reportclasses->where('month','09-2023')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwoct23 = <?php echo $reportclasses->where('month','10-2023')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwnov23 = <?php echo $reportclasses->where('month','11-2023')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwdec23 = <?php echo $reportclasses->where('month','12-2023')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwjan24 = <?php echo $reportclasses->where('month','01-2024')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwfeb24 = <?php echo $reportclasses->where('month','02-2024')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwmar24 = <?php echo $reportclasses->where('month','03-2024')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwapr24 = <?php echo $reportclasses->where('month','04-2024')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwmay24 = <?php echo $reportclasses->where('month','05-2024')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwjun24 = <?php echo $reportclasses->where('month','06-2024')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwjul24 = <?php echo $reportclasses->where('month','07-2024')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwogs24 = <?php echo $reportclasses->where('month','08-2024')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwsep24 = <?php echo $reportclasses->where('month','09-2024')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwoct24 = <?php echo $reportclasses->where('month','10-2024')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwnov24 = <?php echo $reportclasses->where('month','11-2024')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwdec24 = <?php echo $reportclasses->where('month','12-2024')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwjan25 = <?php echo $reportclasses->where('month','01-2025')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwfeb25 = <?php echo $reportclasses->where('month','02-2025')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwmar25 = <?php echo $reportclasses->where('month','03-2025')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwapr25 = <?php echo $reportclasses->where('month','04-2025')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwmay25 = <?php echo $reportclasses->where('month','05-2025')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwjun25 = <?php echo $reportclasses->where('month','06-2025')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwjul25 = <?php echo $reportclasses->where('month','07-2025')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwogs25 = <?php echo $reportclasses->where('month','08-2025')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwsep25 = <?php echo $reportclasses->where('month','09-2025')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwoct25 = <?php echo $reportclasses->where('month','10-2025')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwnov25 = <?php echo $reportclasses->where('month','11-2025')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;
var alwdec25 = <?php echo $reportclasses->where('month','12-2025')->whereNull('deleted_at')->sum('allowance') ?? ''; ?>;


// Define the chart data and options

var chartData = {
    labels: ['Januari', 'Februari', 'Mac', 'April', 'Mei', 'Jun', 'Julai', 'Ogos', 'September', 'Oktober', 'November','Disember'],
    datasets: [{
      backgroundColor: 'rgba(255, 99, 71, 1)',
      borderColor: 'rgba(255, 108, 49, 0.3)',
      data: [],
      label: 'Jumlah Elaun(RM)',
    }]
  };

var chartOptions = {
  responsive: true,
  maintainAspectRatio: false,
  legend: {
    display: true,
  },
  scales: {
    yAxes: [{ ticks: { min: 0, max: 3000 } }],
    xAxes: [{
      ticks: {
        maxRotation: 45,
        minRotation: 45
      },
      categoryPercentage: 0.5, // Adjust this value to increase space between groups
      barPercentage: 0.5       // Adjust this value to control the bar width
    }]
  },
  plugins: {
    datalabels: {
      anchor: 'end',
      align: 'end',
      color: 'black',
      font: {
        weight: 'bold'
      },
      formatter: function(value, context) {
        return 'RM' + value;
      },
      display: function(context) {
        return window.innerWidth >= 768; // Hide labels on screens smaller than 768px
      }
    }
  }
};

// Create an empty chart instance
var chart = new Chart(document.getElementById('myChart'), {
  type: 'bar', // Change this line to 'bar'
  data: chartData,
  options: chartOptions,
  plugins: [ChartDataLabels] // Add this line to enable the datalabels plugin
});

// Function to update the chart based on the selected year
function updateChart() {
  var selectedYear = document.getElementById('yearSelect').value;
  var feeData = [];
  var allowanceData = [];

  // Retrieve the data for the selected year
  switch (selectedYear) {
    case '2022':
      
      allowanceData = [alwjan22,alwfeb22,alwmar22, alwapr22, alwmay22, alwjun22, alwjul22, alwogs22, alwsep22, alwoct22, alwnov22, alwdec22];
      break;
    case '2023':
      
      allowanceData =[alwjan23,alwfeb23,alwmar23,alwapr23,alwmay23,alwjun23,alwjul23,alwogs23,alwsep23,alwoct23,alwnov23,alwdec23];
      break;
    case '2024':
    
      allowanceData = [alwjan24,alwfeb24,alwmar24, alwapr24, alwmay24, alwjun24,alwjul24,alwogs24,alwsep24,alwoct24,alwnov24,alwdec24];
      break;
      case '2025':
    
    allowanceData = [alwjan25,alwfeb25,alwmar25, alwapr25, alwmay25, alwjun25,alwjul25,alwogs25,alwsep25,alwoct25,alwnov25,alwdec25];
    break;
    default:
      // Handle default case or show an error message
      break;
  }

  // Update the chart data

  chart.data.datasets[0].data = allowanceData;
  chart.update();
}

</script>

</div>
