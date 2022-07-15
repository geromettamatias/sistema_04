
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


   
</figure>






<script type="text/javascript">
$('#imagenProceso').hide();
      $('#cargaCiclo').hide();
      $('#IMAGENCARGANDO').hide();
$(document).ready(function(){



 boto=3;

        $.ajax({
            url: "modulos/estadistica/elementos/crud.php",
            type: "POST",
            data: {boto:boto},
            dataType: "json",
            success: function(res){


                console.log (res);
              
                cate=res[0];

            notasNegativo=res[1];

            notasPositivo=res[2];

            cantidadDesap=res[3];
            cantidadAprobad=res[4];

            cantidadInscripto=res[5];

            curso=res[6];

<?php
session_start();
$tipoGrafico=$_SESSION['tipoGrafico'];
$cursoSe=$_SESSION['cursoSe'];
$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 

$columnaSEle=$_SESSION['columnaSEle'];

?>

              toastr.info('Total de Alumnos Matriculados: '+cantidadInscripto+'; en el curso: '+curso+'; Corresponde: <?php echo $columnaSEle ?>; Ciclo Lectivo: <?php echo $cicloLectivo ?>');

            
            notasNegativoF=[];

            for(let i=0; i<=cate.length-1; i++){

               notasNegativoF.push({ name: cate[i], y: notasNegativo[i] });


            }

            notasPositivoF=[];

            for(let i=0; i<=cate.length-1; i++){

               notasPositivoF.push({ name: cate[i], y: notasPositivo[i] });


            }


             cantidadDesapF=[];

            for(let i=0; i<=cate.length-1; i++){

               cantidadDesapF.push({ name: cate[i], y: cantidadDesap[i] });


            }

             cantidadAprobadF=[];

            for(let i=0; i<=cate.length-1; i++){

               cantidadAprobadF.push({ name: cate[i], y: cantidadAprobad[i] });


            }


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

<?php

             
if ($tipoGrafico=='TIPO DE GRAFICO POR COLUMNA') {  ?>


Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'APROVADOS Y DESAPROBADOS, cantidad de Alumnos: '+cantidadInscripto+ '- Curso: '+curso+' - Corresponde: <?php echo $columnaSEle ?>- Ciclo Lectivo: <?php echo $cicloLectivo ?>'
    },
   subtitle: {
        text: 'Source: eetn16@gmail.com'
    },
    xAxis: {
        categories: cate,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'CANTIDAD',

        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.0f} C/U</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Total de Desaprovados',
        data: cantidadDesap
    },{
        name: 'Total de Aprobados',
        data: cantidadAprobad
    },{
        name: 'Nota más Baja',
        data: notasNegativo
    },{
        name: 'Nota más Alta',
        data: notasPositivo
    }]
});






<?php }else if($tipoGrafico=='TIPO DE GRAFICO POR BARRA'){  ?>


Highcharts.chart('container', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'APROVADOS Y DESAPROBADOS, cantidad de Alumnos: '+cantidadInscripto+ '- Curso: '+curso+' - Corresponde: <?php echo $columnaSEle ?>- Ciclo Lectivo: <?php echo $cicloLectivo ?>'
    },
    subtitle: {
        text: 'Source: eetn16@gmail.com'
    },
    xAxis: {
        categories: cate,
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'CANTIDAD',
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
        name: 'C/DESA',
        data: cantidadDesap
    },{
        name: 'C/APR',
        data: cantidadAprobad
    },{
        name: 'N/BAJA',
        data: notasNegativo
    },{
        name: 'N/ALTA',
        data: notasPositivo
    }]
});
     



<?php  }else{   ?>




divCantidad='';

for(let i=0; i<=cate.length-1; i++){

    divCantidad='<div id="container'+cate[i]+'"></div> <hr>'+ divCantidad;
}

$('#container').html(divCantidad);

for(let i=0; i<=cate.length-1; i++){



  asignatura=cate[i];

            cantidadInscripto=res[5];



    cantidadDesapAsignatura=cantidadDesap[i];
    cantidadAprobadAsignatura=cantidadAprobad[i];


    porsentajeAprovados= (cantidadAprobadAsignatura*100)/cantidadInscripto;
    porsentajeDesaprovado= (cantidadDesapAsignatura*100)/cantidadInscripto;



Highcharts.chart('container'+asignatura, {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },

    title: {
        text: 'ESTADISTICA DE LA ASIGNATURA '+asignatura+'; de un total '+cantidadInscripto+' alumnos inscriptos- Curso: '+curso+'- Corresponde: <?php echo $columnaSEle ?>- Ciclo Lectivo: <?php echo $cicloLectivo ?>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
    series: [{
        type: 'pie',
        name: 'Browser share',
        data: [
            {
                name: 'Aprobados: '+cantidadAprobadAsignatura+'c/u - '+porsentajeAprovados+'%',
                y: porsentajeAprovados,
                sliced: true,
                selected: true
            },
            ['Desaprobados: '+cantidadDesapAsignatura+'c/u - '+porsentajeDesaprovado+'%', porsentajeDesaprovado]
        ]

    }]
});


   }         



<?php }  ?>



               
}
});







         
     });











</script>