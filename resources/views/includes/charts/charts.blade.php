<script>var options = {
    chart: {
        height: 300,
        type: 'pie',
    }, 
    series: [@foreach($expenseHeads as $key => $accountHead) {{ $accountHead['amount'] }}{{ $loop->last ? '' : ',' }} @endforeach],
    
    labels: [@foreach($expenseHeads as $key => $accountHead) '{{ $accountHead['name'] }}'{{ $loop->last ? '' : ',' }} @endforeach],
    colors: [@foreach($expenseHeads as $key => $accountHead) '{{ \AccountHelper::randomColor() }}'{{ $loop->last ? '' : ',' }} @endforeach],
    legend: {
        show: false,
        position: 'bottom',
        horizontalAlign: 'center',
        verticalAlign: 'middle',
        floating: false,
        fontSize: '14px',
        offsetX: 0,
        offsetY: -10
    },
    responsive: [{
        breakpoint: 600,
        options: {
            chart: {
                height: 210
            },
            legend: {
                show: false
            },
        }
    }]
  
  }
  
  var chart = new ApexCharts(
    document.querySelector("#apex_pie1"),
    options
  );
  
  chart.render();
  
  
  var options = {
    chart: {
        height: 380,
        type: 'bar',
        toolbar: {
            show: false
        }
    },
    plotOptions: {
        bar: {
            horizontal: true,
        }
    },
    dataLabels: {
        enabled: true
    },
    series: [{
        data: [@foreach($data as $key => $product) {{ $product['totalSalesQnty'] }}{{ $loop->last ? '' : ',' }} @endforeach],
    }],
    colors: [@foreach($expenseHeads as $key => $accountHead) '{{ \AccountHelper::randomColor() }}'{{ $loop->last ? '' : ',' }} @endforeach],
    xaxis: {
        categories: [@foreach($data as $key => $product) '{{ $product['product_name'] }}'{{ $loop->last ? '' : ',' }} @endforeach],
    },
    states: {
        hover: {
            filter: 'none'
        }
    },
    grid: {
        borderColor: '#f1f3fa'
    }
}

 var chart = new ApexCharts(
    document.querySelector("#apex_bar1"),
    options
 )
 ;

 chart.render();
  
  
  


  var options = {
  chart: {
      height: 320,
      type: 'donut',
  }, 
  series: [{{ $todayOverview[0]['income']}}, {{$todayOverview[0]['sales']}},{{$todayOverview[0]['purchases']}},{{$todayOverview[0]['expense']}}],
  legend: {
      show: true,
      position: 'bottom',
      horizontalAlign: 'center',
      verticalAlign: 'middle',
      floating: false,
      fontSize: '14px',
      offsetX: 0,
      offsetY: -10
  },
  labels: ["Income", "Sales", "Purhcases", "Expenses"],
  colors: ["#2a9965", "#232f5b","#f06a6c", "#f1e299"],
  responsive: [{
      breakpoint: 600,
      options: {
          chart: {
              height: 240
          },
          legend: {
              show: false
          },
      }
  }],
  fill: {
      type: 'gradient'
  }
}

var chart = new ApexCharts(
  document.querySelector("#apex_pie2"),
  options
);

chart.render();

  
  </script>