/* CHART SETTINGS */
(function($)
{
  'use strict';

  $(function() 
  {
    
    /* ULTIMAS MATRICULAS */
    if ($("#grafico-ultimas-matriculas").length) 
    {
      var currentChartCanvas = $("#grafico-ultimas-matriculas").get(0).getContext("2d");
      var currentChart = new Chart(currentChartCanvas, 
      {
        type: 'bar',
        data: 
        {
          labels: ["2025/26", "2026/27", "2027/28", "2028/29", "2029/30"],
          datasets: 
          [
            {
              label: 'Matriculados',
              data: [260, 380, 230, 400, 780],
              backgroundColor: '#392c70'
            },
            {
              label: 'Previstos',
              data: [480, 600, 510, 600, 1000],
              backgroundColor: '#d1cede'
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: true,
          layout: {
            padding: 
            {
              left: 0,
              right: 0,
              top: 20,
              bottom: 0
            }
          },
          scales: 
          {
            yAxes: [{
              gridLines: {
                drawBorder: false,
              },
              ticks: {
                stepSize: 250,
                fontColor: "#686868"
              }
            }],
            xAxes: [{
              stacked: true,
              ticks: {
                beginAtZero: true,
                fontColor: "#686868"
              },
              gridLines: {
                display: false,
              },
              barPercentage: 0.4
            }]
          },
          legend: {
            display: true
          },
          elements: {
            point: {
              radius: 0
            }
          },
          
        }
      });
    }

    /* ULTIMOS APROVEITAMENTOS */
    if ($('#grafico-ultimos-aproveitamentos').length) 
    {
      var lineChartCanvas = $("#grafico-ultimos-aproveitamentos").get(0).getContext("2d");
      var data = {
        labels: ["2025/26", "2026/27", "2027/28", "2028/29", "2029/30"],
        datasets: 
        [
          {
            label: 'Rendimento',
            data: [99.5, 97.8, 93.9, 87.7, 88.9],
            borderColor: ['#392c70'],
            borderWidth: 3,
            fill: false
          },
          {
            label: 'Aproveitamento',
            data: [87.9, 84.0, 88.3, 83.6, 65.1],
            borderColor: ['#04b76b'],
            borderWidth: 3,
            fill: false
          } ,
          {
            label: 'Abandono',
            data: [0.5, 2.2, 6.1, 12.3, 11.1],
            borderColor: ['#ff5e6d'],
            borderWidth: 3,
            fill: false
          },
        ]
      };
      var options = 
      {
        scales: 
        {
          yAxes: 
          [{
            gridLines: {drawBorder: false},
            ticks: 
            {
              stepSize: 20,
              fontColor: "#686868",
              callback: (value)=> value + '%'
            }
          }],
          xAxes: 
          [{
            display: true,
            gridLines: 
            {
              drawBorder: false
            }
          }]
        },
        tooltips: 
        {
          callbacks: 
          {
            label: function(tooltipItem, data) {
              let datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
              let value = tooltipItem.yLabel;
              return datasetLabel + ': ' + value + '%';
            }
          }
        },      
        legend: 
        {
          display: true,
          position:'bottom',
          labels: 
          {
            fontColor: '#1e1d1d',
            boxWidth: 12,
            padding: 15
          }
        },
        elements: 
        {
          point: {radius: 3}
        },
        stepsize: 1
      };
      
      var lineChart = new Chart(lineChartCanvas, 
      {
        type: 'line',
        data: data,
        options: options
      });
    }

    /* MATRICULA ACTUAL */
    if ($("#grafico-matricula-actual").length) 
    {
      var currentChartCanvas = $("#grafico-matricula-actual").get(0).getContext("2d");
      var currentChart = new Chart(currentChartCanvas, 
      {
        type: 'bar',
        data: 
        {
          labels: ["Matriculados", "Transferidos", "Desistidos", "Avaliados", "Aprovados"],
          datasets: 
          [
            {
              label: 'Matriculados',
              data: [260, 380, 230, 400, 780],
              backgroundColor: 
              [
                'rgb(80, 5, 220)',
                'rgba(255, 159, 64, 1)',
                'rgba(255,99,132,1)',
                'rgba(75, 192, 192, 1)',
                'rgb(24, 125, 1)'
              ]
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: true,
          layout: {
            padding: 
            {
              left: 0,
              right: 0,
              top: 20,
              bottom: 0
            }
          },
          scales: 
          {
            yAxes: [{
              gridLines: {
                drawBorder: false,
              },
              ticks: {
                stepSize: 250,
                fontColor: "#686868"
              }
            }],
            xAxes: [{
              stacked: true,
              ticks: {
                beginAtZero: true,
                fontColor: "#686868"
              },
              gridLines: {
                display: false,
              },
              barPercentage: 0.4
            }]
          },
          legend: {
            display: false
          },
          elements: {
            point: {
              radius: 0
            }
          },
        }
      });
      
    }

    /* APROVEITAMENTO ACTUAL */
    if ($('#grafico-aproveitamento-actual').length) 
    {
      var lineChartCanvas = $("#grafico-aproveitamento-actual").get(0).getContext("2d");
      var data = {
        labels: ["I Trimestre", "II Trimestre", "III Trimestre"],
        datasets: 
        [
          {
            label: 'Rendimento',
            data: [79.9, 87.7, 88.9],
            borderColor: ['#392c70'],
            borderWidth: 3,
            fill: false
          },
          {
            label: 'Aproveitamento',
            data: [70.3, 83.6, 65.1],
            borderColor: ['#04b76b'],
            borderWidth: 3,
            fill: false
          } ,
          {
            label: 'Abandono',
            data: [6.1, 12.3, 11.1],
            borderColor: ['#ff5e6d'],
            borderWidth: 3,
            fill: false
          },
        ]
      };
      var options = 
      {
        scales: 
        {
          yAxes: 
          [{
            gridLines: {drawBorder: false},
            ticks: 
            {
              stepSize: 20,
              fontColor: "#686868",
              callback: (value)=> value + '%'
            }
          }],
          xAxes: 
          [{
            display: true,
            gridLines: 
            {
              drawBorder: false
            }
          }]
        },
        tooltips: 
        {
          callbacks: 
          {
            label: function(tooltipItem, data) {
              let datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
              let value = tooltipItem.yLabel;
              return datasetLabel + ': ' + value + '%';
            }
          }
        },      
        legend: 
        {
          display: true,
          position:'bottom',
          labels: 
          {
            fontColor: '#1e1d1d',
            boxWidth: 12,
            padding: 15
          }
        },
        elements: 
        {
          point: {radius: 3}
        },
        stepsize: 1
      };
      
      var lineChart = new Chart(lineChartCanvas, 
      {
        type: 'line',
        data: data,
        options: options
      });
    }


  });
})(jQuery);