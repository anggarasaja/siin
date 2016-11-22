@extends('layouts.dashboard')
@push('styles')
    {!! Html::style('css/fullcalendar.min.css'); !!}
    <style type="text/css">
  .chart-legend li span{
      display: inline-block;
      width: 12px;
      height: 12px;
      margin-right: 5px;
  }
  .chart-legend li{
      list-style-type: none;
  }
</style>
@endpush
@push('scripts-head')
  {!! Html::script('js/fullcalendar.min.js'); !!}
  {!! Html::script('vendors/Chart.js/dist/Chart.min.js'); !!}
@endpush
@push('scripts')
    
    <script type="text/javascript">
      var option = {
            responsive: true,
            tooltips: {
              callbacks: {
                label: function(tooltipItem, data) {
                  var allData = data.datasets[tooltipItem.datasetIndex].data;
                  var tooltipLabel = data.labels[tooltipItem.index];
                  var tooltipData = allData[tooltipItem.index];
                  var total = 0;
                  for (var i in allData) {
                    total += allData[i];
                  }
                  var tooltipPercentage = Math.round((tooltipData / total) * 100);
                  return tooltipLabel + ': ' + tooltipPercentage + '%';
                }
              }
            }
          }
  $(document).ready(function() {
    $('#fullcalendar').fullCalendar({
    });
    $.ajax({
      url: "/chart/getBentukLembaga",
      method: "GET",
      success: function(data) {
        result = jQuery.parseJSON(data);
        var ctx = document.getElementById("bentukLembaga");
        var mybarChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: result.label,
            datasets: [{
              label: 'Total Unit Litbang',
              backgroundColor: "#26B99A",
              data: result.data
            }]
          },

          options: {
            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero: true
                }
              }],
              xAxes: [{
                ticks: {
                  autoSkip: false,
                  maxRotation: 40 
                }
              }]
            }
          }
        });
      },
      error: function(data) {
        console.log(data);
      }
    });

    $.ajax({
      url: "/chart/getFokusBidang",
      method: "GET",
      success: function(data) {
        result = jQuery.parseJSON(data);
        var ctx = document.getElementById("fokusBidang");
        var mybarChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: result.label,
            datasets: [{
              label: 'Total Unit Litbang',
              backgroundColor: "#26B99A",
              data: result.data
            }]
          },

          options: {
            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero: true
                }
              }],
              xAxes: [{
                ticks: {
                  autoSkip: false,
                  maxRotation: 40 
                }
              }]
            }
          }
        });
      },
      error: function(data) {
        console.log(data);
      }
    });

    $.ajax({
      url: "/chart/getLembagaInduk",
      method: "GET",
      success: function(data) {
        result = jQuery.parseJSON(data);
        var ctx = document.getElementById("lembagaInduk");
        var mybarChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: result.label,
            datasets: [{
              label: 'Total Unit Litbang',
              backgroundColor: "#26B99A",
              data: result.data
            }]
          },

          options: {
            scales: {
              yAxes: [{
                ticks: {
                  // beginAtZero: true
                }
              }],
              xAxes: [{
                ticks: {
                  autoSkip: false,
                  maxRotation: 90,
                  minRotation:90
                }
              }]
            }
          }
        });
      },
      error: function(data) {
        console.log(data);
      }
    });

    $.ajax({
      url: "/chart/getKategoriLembaga",
      method: "GET",
      success: function(data) {
        result = jQuery.parseJSON(data);
        var ctx = document.getElementById("mybarChart");
        var mybarChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: result.label,
            datasets: [{
              label: 'Total Unit Litbang',
              backgroundColor: "#26B99A",
              data: result.data
            }]
          },

          options: {
            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero: true
                }
              }],
              xAxes: [{
                ticks: {
                  autoSkip: false,
                  maxRotation: 40 
                }
              }]
            }
          }
        });
      },
      error: function(data) {
        console.log(data);
      }
    });


    $.ajax({
      url: "/chart/getTrl",
      method: "GET",
      success: function(data) {
        result = jQuery.parseJSON(data);
        var ctx = document.getElementById("pieChart");
        var data = {
          datasets: [{
            data: result.persentage,
            backgroundColor: result.color,
            label: 'TRL' // for legend
          }],
          labels: result.name
        };
        var pieChart = new Chart(ctx, {
          data: data,
          type: 'pie',
          options: option
        });
      },
      error: function(data) {
        console.log(data);
      }
    });
    $.ajax({
      url: "/chart/getPUI",
      method: "GET",
      success: function(data) {
        result = jQuery.parseJSON(data);
        var ctx = document.getElementById("piePUI");
        var data = {
          datasets: [{
            data: result.persentage,
            backgroundColor: result.color,
            label: 'PUI' // for legend
          }],
          labels: result.name
        };
        var pieChart = new Chart(ctx, {
          data: data,
          type: 'pie',
          options: option
        });
      },
      error: function(data) {
        console.log(data);
      }
    });
    $.ajax({
      url: "/chart/getBidPel",
      method: "GET",
      success: function(data) {
        result = jQuery.parseJSON(data);
        var ctx = document.getElementById("pieBidang");
        var data = {
          datasets: [{
            data: result.persentage,
            backgroundColor: result.color,
            label: 'PUI' // for legend
          }],
          labels: result.name
        };
        var pieChart = new Chart(ctx, {
          data: data,
          type: 'pie',
          options: option
        });
      },
      error: function(data) {
        console.log(data);
      }
    });
  });
  //     // Bar chart
  // Chart.defaults.global.tooltips = {
  // //   enabled: false
  //     enabled: true,
  //       bodyFontSize: 12,
  // };
  
  
  
    </script>
@endpush


@section('content')
<div class="">
  <div class="row top_tiles">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-university"></i></div>
        <div class="count">{{$totalAll}}</div>
        <h3>Total Integrasi</h3>
        <p>Monitoring Data Integrasi Lembaga</p>
      </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-check-square-o"></i></div>
          <div class="count">{{$totalActive}}</div>
        <h3>Integrasi Aktif</h3>
        <p>Monitoring Data Integrasi Aktif</p>
      </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon" style="top: 16px;right: 48px;"><i class="fa fa-remove"></i></div>
        <div class="count">{{$totalNotActive}}</div>
        <h3>Integrasi Nonaktif</h3>
        <p>Monitoring Data Integrasi Nonaktif</p>
      </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-users"></i></div>
        <div class="count">{{$totalUser}}</div>
        <h3>Total Pengguna</h3>
        <p>Monitoring Data Pengguna</p>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Pusat Unggulan IPTEK</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_title">
              <h2>Unit LitBang berdasarkan Lembaga Induk</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <canvas id="lembagaInduk"></canvas>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_title">
              <h2>Unit LitBang berdasarkan Kategori Lembaga</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <canvas id="mybarChart"></canvas>
            </div>
          </div> 
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_title">
              <h2>Produk Berdasarkan TRL</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <canvas id="pieChart"></canvas>
              <!-- <div id="js-legend" class="chart-legend"></div> -->
            </div>
          </div>    
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_title">
              <h2>Unit LitBang berdasarkan Bentuk Kelembagaan</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <canvas id="bentukLembaga"></canvas>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_title">
              <h2>Lembaga Yang ditetapkan sebagai PUI</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <canvas id="piePUI"></canvas>
              <!-- <div id="js-legend" class="chart-legend"></div> -->
            </div>
          </div>    
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_title">
              <h2>Unit LitBang berdasarkan Fokus Bidang</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <canvas id="fokusBidang"></canvas>
            </div>
          </div>
                      

        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>PDII - LIPI</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="x_title">
              <h2>Artikel Ilmiah Berdasarkan Bidang Penelitian</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <canvas id="pieBidang"></canvas>
            </div>`
          </div>  
          
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
