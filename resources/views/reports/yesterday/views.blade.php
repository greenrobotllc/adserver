<div class="row" data-name="yesterday">
            
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>{{$total_views_yesterday}}</h3>
                  <p>Total Views Yesterday</p>
                </div>
                
                <div class="icon">
                  <i class="ion ion-ios-glasses-outline"></i>
                </div>
               
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>{{$total_adsense_views_yesterday}}</h3>
                  <p>Total Adsense Views Yesterday</p>
                </div>
                
                <div class="icon">
                  <i class="fa fa-google"></i>
                </div>
               
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-blue">
                <div class="inner">
                  <h3>{{$total_lsm_views_yesterday}}</h3>
                  <p>Total LSM Views Yesterday</p>
                </div>
                
                <div class="icon">
                  <i class="fa fa-circle-o-notch"></i>
                </div>
               
              </div>

            </div><!-- ./col -->
             <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-orange">
                <div class="inner">
                  <h3>{{$total_other_views_yesterday}}</h3>
                  <p>Total Other Views Yesterday</p>
                </div>
                
                <div class="icon">
                  <i class="fa fa-asterisk"></i>
                </div>
               
              </div>

            </div><!-- ./col -->          
<div class="col-md-12">
                       <div id="mapdivyesterday" style="width: 100%; height: 400px; background: currentColor"></div> 
            </div>        
          </div>
<script type="text/javascript">
  var mapData = <?=$LSMmapJsonYesterday?>;
        var map;
      var minBulletSize = 3;
      var maxBulletSize = 70;
      var min = Infinity;
      var max = -Infinity;

      AmCharts.theme = AmCharts.themes.black;

      // get min and max values
      for (var i = 0; i < mapData.length; i++) {
        var value = mapData[i].value;
        if (value < min) {
          min = value;
        }
        if (value > max) {
          max = value;
        }
      }

      // build map
      AmCharts.ready(function() {
        map = new AmCharts.AmMap();
        map.projection = "winkel3";

        map.addTitle("Ad RPM Map Yesterday", 14);
        // map.addTitle("source: Gapminder", 11);
        map.areasSettings = {
          unlistedAreasColor: "#FFFFFF",
          unlistedAreasAlpha: 0.1
        };
        map.imagesSettings = {
          balloonText: "<span style='font-size:14px;'><b>[[title]]</b>: [[value]]</span>",
          alpha: 0.6
        }

        var dataProvider = {
          mapVar: AmCharts.maps.worldLow,
          images: []
        }

        // create circle for each country

        // it's better to use circle square to show difference between values, not a radius
        var maxSquare = maxBulletSize * maxBulletSize * 2 * Math.PI;
        var minSquare = minBulletSize * minBulletSize * 2 * Math.PI;

        // create circle for each country
        for (var i = 0; i < mapData.length; i++) {
          var dataItem = mapData[i];
          var value = dataItem.value;
          // calculate size of a bubble
          var square = (value - min) / (max - min) * (maxSquare - minSquare) + minSquare;
          if (square < minSquare) {
            square = minSquare;
          }
          var size = Math.sqrt(square / (Math.PI * 2));
          var id = dataItem.code;

          dataProvider.images.push({
            type: "circle",
            width: size,
            height: size,
            color: dataItem.color,
            longitude: latlong[id].longitude,
            latitude: latlong[id].latitude,
            title: dataItem.name,
            value: value
          });
        }



        // the following code uses circle radius to show the difference
        /*
        for (var i = 0; i < mapData.length; i++) {
          var dataItem = mapData[i];
          var value = dataItem.value;
          // calculate size of a bubble
          var size = (value - min) / (max - min) * (maxBulletSize - minBulletSize) + minBulletSize;
          if (size < minBulletSize) {
            size = minBulletSize;
          }
          var id = dataItem.code;

          dataProvider.images.push({
            type: "circle",
            width: size,
            height: size,
            color: dataItem.color,
            longitude: latlong[id].longitude,
            latitude: latlong[id].latitude,
            title: dataItem.name,
            value: value
          });
        }*/



        map.dataProvider = dataProvider;

        map.write("mapdivyesterday");
      });
</script>          