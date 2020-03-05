@section('platform')
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
          print "['Web', ".$web."],";
          print "['Facebook', ".$facebook."],";
          print "['Whatsapp ', ".$whatsapp."],";
          print "['Telegram', ".$telegram."],";
        ?>
      ]);
      
      var opciones = {
        is3D:true,
        colors:['#ef6c00', '#3b5998', '#25d366', '#0088cc'],
        fontSize: 15,
        fontName: "Slabo 27px",
        pieSliceText: 'percentage',
        slices: { 0: {offset: 0.1},
                  1: {offset: 0.1},
                  2: {offset: 0.1},
                  3: {offset: 0.1},
        },
        sliceVisibilityThreshold: 0,        
        chartArea: {width: '92%', height: '100%'},
        height:350
      };

      var chart = new google.visualization.PieChart(document.getElementById('platform'));
      chart.draw(data, opciones);
    }
    </script>
  </head>
  <body>
    <div class="mx-auto" id="platform" style="width:500px;"></div>
  </body>
</html>
@endsection