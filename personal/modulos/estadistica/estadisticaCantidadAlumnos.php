

<style type="text/css">
.highcharts-figure, .highcharts-data-table table {
    min-width: 360px; 
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
  font-family: Verdana, sans-serif;
  border-collapse: collapse;
  border: 1px solid #EBEBEB;
  margin: 10px auto;
  text-align: center;
  width: 100%;
  max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
  font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

</style>

<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
        Cantidad de Alumnos de cada Ciclo.
    </p>
</figure>


<script type="text/javascript">
$('#imagenProceso').hide();
      $('#cargaCiclo').hide();
$(document).ready(function(){

        boto=1;

        $.ajax({
            url: "modulos/estadistica/elementos/crud.php",
            type: "POST",
            data: {boto:boto},
            success: function(res){


                console.log(res);


            ciclos=[];
            matricula=[];

          
            cantidadCicloMatricula = res.split('||');
           
            for (var i = cantidadCicloMatricula.length - 1; i >= 0; i--) {
              
                matriculaCiclo=(cantidadCicloMatricula[i]);



                matriculaC = matriculaCiclo.split(';');
                
                cicloF=parseInt(matriculaC[0], 10);
                ciclos.push(cicloF);
                matriculaCF=parseInt(matriculaC[1], 10);
                matricula.push(matriculaCF);


            }

    
            console.log()
          
            toastr.info('Matricula de Alumnos de cada ciclos');


     



  // A point click event that uses the Renderer to draw a label next to the point
// On subsequent clicks, move the existing label instead of creating a new one.
Highcharts.addEvent(Highcharts.Point, 'click', function () {
    if (this.series.options.className.indexOf('popup-on-click') !== -1) {
        const chart = this.series.chart;
        const date = Highcharts.dateFormat('%A, %b %e, %Y', this.x);
        const text = `<b>${date}</b><br/>${this.y} ${this.series.name}`;

        const anchorX = this.plotX + this.series.xAxis.pos;
        const anchorY = this.plotY + this.series.yAxis.pos;
        const align = anchorX < chart.chartWidth - 200 ? 'left' : 'right';
        const x = align === 'left' ? anchorX + 10 : anchorX - 10;
        const y = anchorY - 30;
        if (!chart.sticky) {
            chart.sticky = chart.renderer
                .label(text, x, y, 'callout',  anchorX, anchorY)
                .attr({
                    align,
                    fill: 'rgba(0, 0, 0, 0.75)',
                    padding: 10,
                    zIndex: 7 // Above series, below tooltip
                })
                .css({
                    color: 'white'
                })
                .on('click', function () {
                    chart.sticky = chart.sticky.destroy();
                })
                .add();
        } else {
            chart.sticky
                .attr({ align, text })
                .animate({ anchorX, anchorY, x, y }, { duration: 250 });
        }
    }
});


Highcharts.chart('container', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'ESTADISTICA CANTIDAD ALUMNOS MATRICULADOS POR CICLOS'
    },
    subtitle: {
        text: 'Source: eetn16@gmail.com'
    },
    xAxis: {
        categories: ciclos,
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Escalas (CANTIDAD)',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' C/U'
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: false,
        borderWidth: 1,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'Matricula',
        data: matricula
    }]
});
              
            


               
            }
        });







         
     });









 $.unblockUI();

</script>