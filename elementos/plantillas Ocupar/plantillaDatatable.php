
 <button  onclick="borrarSeleccion()" class="Eliminar">Eliminar Selec fila de toda la tabla</button>
       
        <button  onclick="editar()" class="Agregar">editar</button>
        <button  onclick="Agregar()" class="Agregar">Agregar</button>
         <button  onclick="seleccionarTODO()" class="obtener">Select/NoSelect</button>


    <table id="example" class="table table display" style="width:100%">
    <thead>
        <tr id="1">
            <th>name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>
            <th>Start date</th>
            <th>Salary</th>
        </tr>
    </thead>
    <tbody>
        <tr id="2">
            <td>44444444444444</td>
            <td>System Architect</td>
            <td>Edinburgh</td>
            <td>61</td>
            <td>2011/04/25</td>
            <td>$320,800</td>
        </tr>
        <tr id="3">
            <td>rrrrrrrrrrrrrr</td>
            <td>4fesfwfew</td>
            <td>Edinburgh</td>
            <td>22</td>
            <td>2012/03/29</td>
            <td>$433,060</td>
        </tr>
         <tr id="4">
            <td>4tttttttttt</td>
            <td>Senior Javascript Developer</td>
            <td>Edinburgh</td>
            <td>22</td>
            <td>2012/03/29</td>
            <td>$433,060</td>
        </tr>
         <tr id="5">
            <td>5</td>
            <td>Senior Javascript Developer</td>
            <td>Edinburgh</td>
            <td>22</td>
            <td>2012/03/29</td>
            <td>$433,060</td>
        </tr>
         <tr id="6">
            <td>6</td>
            <td>Senior Javascript Developer</td>
            <td>Edinburgh</td>
            <td>22</td>
            <td>2012/03/29</td>
            <td>$433,060</td>
        </tr>
         <tr id="7">
            <td>7</td>
            <td>Senior Javascript Developer</td>
            <td>Edinburgh</td>
            <td>22</td>
            <td>2012/03/29</td>
            <td>$433,060</td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <th>name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>
            <th>Start date</th>
            <th>Salary</th>
        </tr>
    </tfoot>
</table>
   
<script type="text/javascript">

 $.unblockUI();



    var myTable = $('#example').DataTable({
        "destroy":true,   
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
                 "sProcessing":"Procesando...",
            },
            //para usar los botones   
            responsive: "true",
            dom: 'Bfrtilp',       
            buttons:[ 
          {
            extend:    'excelHtml5',
            text:      '<i class="fas fa-file-excel"></i> ',
            titleAttr: 'Exportar a Excel',
            className: 'btn btn-success'
          },
          {
            extend:    'pdfHtml5',
            text:      '<i class="fas fa-file-pdf"></i> ',
            titleAttr: 'Exportar a PDF',
            className: 'btn btn-danger'
          },
          {
            extend:    'print',
            text:      '<i class="fa fa-print"></i> ',
            titleAttr: 'Imprimir',
            className: 'btn btn-info'
          },
        ]         
        });



//  inicio el array y el selector (total)
var arrayContieneLosElementosAEliminar =[];
var selector=0;



//  selecciono particular o grupal, agrego en un array 

$('#example tbody').on('click', 'tr', function () {
        
        // selecciona en datatable
         $(this).toggleClass('selected');

  

   
    // obtengo los valores
    var dataFila = myTable.row( this ).data();
    //verifico con el dato si esta dentro del array, busco y si tiene indice
    index = arrayContieneLosElementosAEliminar.indexOf(dataFila[0]);
    // verifico si posee indice no puede dar -1
    if (index > -1) {
        // elimino el elemento seleccionado con el indice encontrado
        arrayContieneLosElementosAEliminar.splice(index, 1);
    }else{
        // agrego elemento al array
        arrayContieneLosElementosAEliminar.push(dataFila[0]);

    }
console.log(arrayContieneLosElementosAEliminar); 


} );

//  fin seleccion particular o grupal

//  seleccinar total
function seleccionarTODO () {

    //  selecciono y selecciono todo, reinicio el array y agrego los elementos nuevamente...

    if ((selector % 2) == 0) {
             $("tr").addClass(" odd selected");
            arrayContieneLosElementosAEliminar=[];

            myTable.rows().data().each(function (value) {
                var dataFila_total= value[0];
                arrayContieneLosElementosAEliminar.push(dataFila_total);
            });

    }else{

            $("tr").removeClass(" odd selected");
            
            myTable.rows().data().each(function (value) {
                var dataFila_total= value[0];
                arrayContieneLosElementosAEliminar=[];
            });
    }

selector++;

console.log(arrayContieneLosElementosAEliminar); 


}

//  fino selecciono total


//  eliminar lo seleccionado

function borrarSeleccion () {
  
        myTable.rows('.selected').remove().draw();
}

// fin de eliminar seleccionado



//  agregar una fila

function Agregar () {

   myTable.row.add([1,2,3,4,5,6]).draw();

}

function editar () {


// saber el numero de fila y luego editar
       numero= myTable.rows( '.selected' )[0][0]

       myTable.row(":eq("+numero+")").data([id,usuario,password]);

 
   myTable.row(":eq(1)").data([1222,2,3,4,5,6]);
   myTable.row(":eq(4)").data([1222,2,3,4,5,6]);


}

//  fin de agregar














$('#button').click( function () {

        alert( myTable.rows('.selected').data().length +' row(s) selected' );
} );





    












/*

Codigo para utilizar


 var myTable = $('#example').DataTable();


var arrayContieneLosElementosAEliminar =[];


    $('#example tbody').on('click', 'tr', function () {
        
// selecciona en datatable
         $(this).toggleClass('selected');

// obtengo los valores
    var dataFila = myTable.row( this ).data();
//verifico con el dato si esta dentro del array, busco y si tiene indice
    index = arrayContieneLosElementosAEliminar.indexOf(dataFila[0]);
// verifico si posee indice no puede dar -1
    if (index > -1) {
        // elimino el elemento seleccionado con el indice encontrado
        arrayContieneLosElementosAEliminar.splice(index, 1);
    }else{
        // agrego elemento al array
        arrayContieneLosElementosAEliminar.push(dataFila[0]);

    }


    console.log(arrayContieneLosElementosAEliminar); 


} );








// cantidad de elemento seleccionado

myTable.rows('.selected').data().length


// Remover todo lo seleccionado

 myTable.rows('.selected').remove().draw();

 // agregar filas

  myTable.row.add([1,2,3,4,5,6]).draw();




SELECT UNO A UNO

$('#example tbody').on('click', 'tr', function () {


 if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }


}











*/    

</script>



