@section('column')
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(column);

    function column() {
      var data = google.visualization.arrayToDataTable([
        ['Action', 'Llamadas'],
        <?php            
            $datosSaldo = array();
            $datosPlan = array();
            $datosPaquete = array();
            $datosFactura = array();
            $datosPromocion = array();            

            for($i=0; $i<count($actions); $i++){
            if($actions[$i]=='saldo'){
                array_push($datosSaldo, $actions[$i]);  
            }                    
            }

            for($i=0; $i<count($actions); $i++){
            if($actions[$i]=='plan'){
                array_push($datosPlan, $actions[$i]);
            }
            }

            for($i=0; $i<count($actions); $i++){
            if($actions[$i]=='paquete'){
                array_push($datosPaquete, $actions[$i]);
            }
            }

            for($i=0; $i<count($actions); $i++){
            if($actions[$i]=='factura'){
                array_push($datosFactura, $actions[$i]);  
            }                    
            }

            for($i=0; $i<count($actions); $i++){
            if($actions[$i]=='promocion'){
                array_push($datosPromocion, $actions[$i]);  
            }                    
            }
            
            print "['Saldo', ".count($datosSaldo)."],";
            print "['Plan', ".count($datosPlan)."],";
            print "['Paquete', ".count($datosPaquete)."],";
            print "['Factura', ".count($datosFactura)."],";
            print "['Promoción', ".count($datosPromocion)."],";
        ?>
        ]);

      var opciones = {
        colors: ['orange'],
        fontSize: 15,
        fontName: "Slabo 27px",
        animation: {"startup": true, "duration": 800, "easing": "inAndOut"},
        titleTextStyle: { 
          color: "gray",
          fontSize: 20,
          italic: false 
        },
        legend: {position: 'none'},
        chartArea: {height: '85%'},
        bar: {groupWidth: "10%"},
        axisTitlesPosition: "none",
        hAxis: {
          title: 'Actions',
          titleTextStyle: {color:'gray', fontSize:15, fontName:"Slabo 27px", bold:true, italic:false},
          textPosition: "out",
          textStyle: {color:"#90A4AE", fontSize:14, fontName:"Nunito", bold:false, italic:false}
        },
        vAxis: {
          title: 'Porcentaje',
          titleTextStyle: {color:'gray', fontSize:15, fontName:"Slabo 27px", bold:true, italic:false},
          textStyle: {color:"#90A4AE", fontSize:14, fontName:"Nunito", bold:false},
          gridlines: {color:'#CFD8DC', count:4},
          format: '#\'%\'',       
        },
        height: 350
      };

      var chart = new google.visualization.ColumnChart(document.getElementById("column"));
      chart.draw(data, opciones);
    }
    </script>
  </head>
  <body>
    <div id="column"></div>
  </body>
</html>
@endsection

@section('piechart3D')
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(piechart3D);

    function piechart3D() {
      var data = google.visualization.arrayToDataTable([
        ['Action', 'Llamadas'],
        <?php
          print "['Saldo', ".count($datosSaldo)."],";
          print "['Plan', ".count($datosPlan)."],";
          print "['Paquete', ".count($datosPaquete)."],";
          print "['Factura', ".count($datosFactura)."],";
          print "['Promoción', ".count($datosPromocion)."],";
        ?>
      ]);
      
      var opciones = {
        is3D:true,
        colors:['#9966FF', '#0000FF', '#FF3399', '#99FFFF', '#66CC00'],
        fontSize: 15,
        fontName: "Slabo 27px",     
        legend: {position: 'labeled', textStyle: {fontSize: 13}},        
        pieSliceText: 'value',
        sliceVisibilityThreshold: 0,        
        chartArea: {width: '100%', height: '85%'},
        height:350
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart3D'));
      chart.draw(data, opciones);
    }
    </script>
  </head>
  <body>
    <div class="mx-auto" style="width:450px">
      <div id="piechart3D"></div>
    </div>
  </body>
</html>
@endsection

@section('efectividad')
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(piechart3D);

    function piechart3D() {
      var data = google.visualization.arrayToDataTable([
        ['Action', 'Llamadas'],
        <?php                        
            $Efectiva = $et*100/count($calls->pluck('session')->unique());
            $NoEfectiva = 100-$Efectiva;
            print "['Efectivas', ".$Efectiva."],";
            print "['No Efectivas', ".$NoEfectiva."],";
        ?>
      ]);
      
      var opciones = {
        is3D:true,
        colors:['#03A9F4', '#E91E63'],
        fontSize: 15,
        fontName: "Slabo 27px",
        pieStartAngle: 40,        
        legend: {position: 'labeled', textStyle: {fontSize: 13}},        
        pieSliceText: 'value',
        sliceVisibilityThreshold: 0,        
        chartArea: {width: '100%', height: '85%'},
        height:350
      };

      var chart = new google.visualization.PieChart(document.getElementById('efectividad'));
      chart.draw(data, opciones);
    }
    </script>
  </head>
  <body>
    <div class="mx-auto" style="width:450px">
      <div id="efectividad"></div>
    </div>
  </body>
</html>
@endsection
