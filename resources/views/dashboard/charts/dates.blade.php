<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(line);

      function line() {
        var data = google.visualization.arrayToDataTable([
           ['Action', 'Llamadas'],
           <?php
           use Carbon\Carbon;
           //Array Auxiliar para impresion de grafica
           $f_print = array(); 
           //Array solo fechas
           $sbt_dates = array();
           foreach($dates as $sbt){
             array_push($sbt_dates, substr($sbt,0,10));
           }            
           //Filtro y me traigo fechas unicas
           $u_dates = array_unique($sbt_dates);          
           //Inicia Iteracion por gechas unicas 
           foreach($u_dates as $u){
           //Array aux para guardar fechas para su conteo
           $f_count = array();
           //Tomamos todos las fecha e iniciamos con las comparaciones
           foreach($dates as $d){
           $f = Carbon::create($d)->isoFormat('YYYY-MM-DD');
           if($u==$f){
             array_push($f_count, $f);
           }else{}
           }
           array_push($f_print, $f_count);
           }
           //Iteracion para hacer la impresion dinamica
           foreach($f_print as $singlef){
             if($singlef == end($f_print)){
               print "['$singlef[0]', ".count($singlef)."]";              
             }else{
               print "['$singlef[0]', ".count($singlef)."],";
             }
           }          
           ?>        
        ]);

        var opciones = {
          curveType: 'function',
          fontSize: 15,
          fontName: "Slabo 27px",
          animation: {"startup": true, "duration": 1500, "easing": "inAndOut"},
          backgroundColor: {fill:"none"},
          axisTitlesPosition: "none",
          legend: {position: 'none'},
          chartArea: {width: '95%', height: '80%', backgroundColor:{fill:"none"}},
          colors: ["#3333FF"],
          lineWidth: 8,
          pointSize: 15,
          hAxis: {textStyle: {color:"white", fontSize:14}},
          vAxis: {textStyle: {color:"white", fontSize:14},
                  gridlines: {count: 0},
                  baselineColor: 'none',
                  format: '#\'%\''
          },
          height: 350
        };

        var chart = new google.visualization.LineChart(document.getElementById('performance'));

        chart.draw(data, opciones);
      }
    </script>
  </head>
  <body>
    <div class="pl-6" id="performance"></div>
  </body>
</html>