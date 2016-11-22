@extends('layouts.app')

@push('styles')
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
  .carousel-title {
    padding: 5% 0;
  }
</style>
@endpush
@push('scripts-head')
  {!! Html::script('vendors/Chart.js/dist/Chart.min.js'); !!}
@endpush
@section('content')

  <section id="main-slider" class="main-slider carousel slide" data-ride="carousel">

   <!-- Wrapper for slides -->
   <div class="carousel-inner" role="listbox">
    <div class="item item-1 active">
      <img src="{{URL::asset('img/slider/1.jpg')}}">
      <div class="carousel-caption">
        <div class="slider-icon hidden-xs">
         <img src="{{URL::asset('img/Logo_SIIN_white.png')}}" style="max-width: 150px">
       </div><!-- /.slider-icon -->
       <h3 class="carousel-title"> Sistem Informasi IPTEK Nasional</h3>
     </div><!-- /.carousel-caption -->
   </div>

   <div class="item item-2">
    <img src="{{URL::asset('img/slider/2.jpg')}}">
    <div class="carousel-caption">  
        <div class="slider-icon hidden-xs">
         <a href="http://www.dikti.go.id/"><img src="{{URL::asset('img/kemenristekdikti_white.png')}}" alt="Site Logo" style="max-width: 100px"></a>
       </div>
      <h3 class="carousel-title"> Sistem Informasi IPTEK Nasional</h3>
    </div>
  </div>
</div>

<!-- Controls -->
<a class="left carousel-control" href="#main-slider" role="button" data-slide="prev">
  <i class="fa fa-angle-left"></i>
</a>
<a class="right carousel-control" href="#main-slider" role="button" data-slide="next">
  <i class="fa fa-angle-right"></i>
</a>

</section><!-- /#main-slider -->

<section id="latest-post" class="latest-post">
  <div class="container">
    <div class="post-area">
      <div class="post-area-top text-center">
        <h2 class="post-area-title">Pusat Unggulan Iptek</h2>
        <!-- <p class="title-description">Vestibulum auctor dapibus nequ</p> -->
      </div><!-- /.post-area-top -->

      <div class="row">
        <div class="latest-posts">
          <div class="col-sm-12">
            <div class="item">
              <article class="post type-post">
                <div class="post-content">
                  <h2 class="entry-title">Unit LitBang berdasarkan Lembaga Induk</h2> 
                    <canvas id="lembagaInduk"></canvas>
                </div><!-- /.post-content -->
              </article>
            </div><!-- /.item -->
          </div>
          <div class="row">
              <div class="col-sm-6">
                <div class="item">
                  <article class="post type-post">
                    <div class="post-content">
                      <h4 class="entry-title">Unit LitBang berdasarkan Kategori Lembaga</h4> 
                        <canvas id="mybarChart"></canvas>
                    </div><!-- /.post-content -->
                  </article>
                </div><!-- /.item -->
              </div>
             <div class="col-sm-6">
                <div class="item">
                  <article class="post type-post">
                    <div class="post-content">
                      <h2 class="entry-title">Unit LitBang berdasarkan Bentuk Kelembagaan</h2> 
                        <canvas id="bentukLembaga"></canvas>
                    </div><!-- /.post-content -->
                  </article>
                </div><!-- /.item -->
              </div> 
          </div>
           
            <div class="row">
                
            
            <div class="col-sm-6">
                <div class="item">
                  <article class="post type-post">
                    <div class="post-content">
                      <h2 class="entry-title">Produk berdasarkan Technology Readiness Level</h2> 
                        <canvas id="pieChart"></canvas>
                    </div><!-- /.post-content -->
                  </article>
                </div><!-- /.item -->
              </div>
            <div class="col-sm-6">
              <div class="item">
                <article class="post type-post">
                  <div class="post-content">
                    <h2 class="entry-title">Unit LitBang berdasarkan Tahun Penetapan PUI</h2> 
                      <canvas id="piePUI"></canvas>
                  </div>
                </article>
              </div><!-- /.item -->
            </div>

              
          </div>
          <div class="row">
                
            <div class="col-sm-12">
              <div class="item">
                <article class="post type-post">
                  <div class="post-content">
                    <h2 class="entry-title">Unit LitBang berdasarkan Fokus Bidang</h2> 
                      <canvas id="fokusBidang"></canvas>
                  </div><!-- /.post-content -->
                </article>
              </div><!-- /.item -->
            </div>
                      
          </div>
      </div><!-- /.latest-posts -->
    </div><!-- /.row -->
  </div><!-- /.post-area -->
</div><!-- /.container -->
</section><!-- /#latest-post -->  
</section><!-- /#main-slider -->

<section id="latest-post" class="latest-post">
  <div class="container">
    <div class="post-area">
      <div class="post-area-top text-center">
        <h2 class="post-area-title">PDII - LIPI</h2>
        <!-- <p class="title-description">Vestibulum auctor dapibus nequ</p> -->
      </div><!-- /.post-area-top -->

      <div class="row">
        <div class="latest-posts">
          <div class="col-sm-12">
            <div class="item">
              <article class="post type-post">
                <div class="post-content">
                  <h2 class="entry-title">Artikel Ilmiah Berdasarkan Bidang Penelitian</h2> 
                    <canvas id="pieBidang"></canvas>
                </div><!-- /.post-content -->
              </article>
            </div><!-- /.item -->
          </div>
 
      </div><!-- /.latest-posts -->
    </div><!-- /.row -->
  </div><!-- /.post-area -->
</div><!-- /.container -->
</section><!-- /#latest-post -->  
@endsection
@push('scripts')
<script type="text/javascript">
  var option = {
            legend:{
              position:'bottom',
              fullWidth:false,

            },
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
          options: option,
        });
      },
      error: function(data) {
        console.log(data);
      }
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
              backgroundColor: "#107FC9",
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
              backgroundColor: "#107FC9",
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
              backgroundColor: "#107FC9",
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
              backgroundColor: "#107FC9",
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
          options: option,
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
});
</script>
@endpush