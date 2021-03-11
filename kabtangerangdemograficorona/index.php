<?php 
// require "functions.php";
//koneksi ke database
 $conn = mysqli_connect("localhost","root","","kabtangcorona");
?>

<?php
$kelurahan = [ 
        //"point_ODP"=>"blue",
        "batas_kecamatan"=>"aqua",
        "batas_desa"=>"aqua"
                 
];
?>


<!DOCTYPE html>
<html>
    <head>
            <meta charset='utf-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <title>Peta Demografi Kependudukan Kabupaten Tangerang</title>
        <!-- Bootstrap -->
            <link href="css/bootstrap.min.css" rel="stylesheet">
            <link href="css/style.css" rel="stylesheet">

            <link href='http://fonts.googleapis.com/css?family=Lakki+Reddy|Rockwell' rel="stylesheet" type="text/css">
        <!--  Include Leaflet CSS file in the head section of your document -->
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
            integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
            crossorigin=""/>
        <!--  Include Leaflet CSS Panel Layers Master -->
            <link rel="stylesheet" href="assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.css" />
        <!--  Include Leaflet CSS Coordinate Control Bar -->
            <link rel="stylesheet" href="assets/js/leaflet-coordinates-master/dist/Leaflet.Coordinates-0.1.5.css"/>
        <!--  Include Leaflet CSS Zoom Bar -->
            <link rel="stylesheet" type="text/css" href="assets/js/L.Control.ZoomBar-master/src/L.Control.ZoomBar.css"/>

            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link rel="stylesheet" href="assets/js/BeautifyMarker-master/leaflet-beautify-marker-icon.css">
            
        <!-- Make sure the map container has a defined height, for example by setting it in CSS: --> 
            <style>
                #mapid { height: 89vh; }

                .icon {
                display: inline-block;
                margin: 2px;
                height: 16px;
                width: 16px;
                background-color: #ccc;
                }

                #getZoomButton {
                position: absolute;
                top: 18px;
                left: 20px;
                z-index: 1001; }
       
                .info { 
                    padding: 6px 8px; 
                    font: 12px/14px Arial, Helvetica, sans-serif; 
                    background: white; background: rgba(255,255,255,0.8); 
                    box-shadow: 0 0 15px rgba(0,0,0,0.2); 
                    border-radius: 5px;
                    } 
                
                .info h4 { margin: 0 0 5px; color: #777; }
            </style>            
        </head>
    

<body>
     <!-- Start Navigation -->
     <nav class="navbar navbar-inverse navbar-fixed-top">
               <!-- Start Brand and toggle get grouped for better mobile display-->
               <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <!--<a class="navbar-brand" href="index.php"> <img class="navbar-brand-image" src="images/logodiskominfokab.png"> Peta Sebaran Covid 19 Kabupaten Tangerang </a>  -->
               <a class="navbar-brand" href="index.php"> <img class="navbar-brand-image" src="images/logodiskominfokab.png" > Peta Demografi Kependudukan Kabupaten Tangerang</a> 
              </div>
            <!-- End Brand and toggle get grouped for better mobile display-->
            <!-- Start Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                 
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <div id="jam-analog" ></div>
                </ul>
              </div>
            <!-- End Collect the nav links, forms, and other content for toggling-->
          </nav>
        <!-- End Navigation-->

        <div class="container-fluid">
            <!-- Start Form -->
              <div class="row">
                <!-- Start Map -->
                <div class="col-md-12-offset-4">

                <!-- Put a div element with a certain id where you want your map to be: -->
                    <div id="mapid"></div>
                </div>
                <!-- End Map -->
            </div>
            <!-- End Form -->


    <!-- Load Leaflet Javasript from CDN -->
        <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="
        sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
        crossorigin=""></script>
    <!-- Load Esri Leaflet Javascript from CDN -->
        <script src="https://unpkg.com/esri-leaflet@2.3.3/dist/esri-leaflet.js"
        integrity="sha512-cMQ5e58BDuu1pr9BQ/eGRn6HaR6Olh0ofcHFWe5XesdCITVuSBiBZZbhCijBe5ya238f/zMMRYIMIIg1jxv4sQ=="
        crossorigin=""></script>
    <!-- Load Leaflet Javascript Plugin Coordinate Control Bar -->
        <script type="text/javascript" src="assets/js/leaflet-coordinates-master/dist/Leaflet.Coordinates-0.1.5.min.js"></script>
    <!-- Load Leaflet Javascript Plugin Panel Layer Master -->
        <script src="assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js"></script> 
    <!-- Load Leaflet Javascript  Plugin Zoom Bar -->
        <script type="text/javascript" src="assets/js/L.Control.ZoomBar-master/src/L.Control.ZoomBar.js"></script>
    <!-- Load Leaflet Javascript  Plugin-AJAX -->
        <script src="assets/js/leaflet.ajax.js"></script>
    <!-- Load Leaflet Javascript Plugin-BeautifyMarker -->
        <script src="assets/js/BeautifyMarker-master/leaflet-beautify-marker-icon.js"></script>

<!-- Load Map and Variable Leaflet -->
    <script type="text/javascript" >
    // Set variable Mymap 
       // var mymap = L.map('mapid').setView([-6.406,106.32], 9);
        var mymap = L.map('mapid',{
            minZoom: 1,
            maxZoom: 17,
            zoomControl: false}).
            setView([-6.1950,106.5528], 11);



            // mymap.createPane('labels');
            // // This pane is above markers but below popups
            // mymap.getPane('labels').style.zIndex = 650;
            // // Layers in this pane are non-interactive and do not obscure mouse/touch events
            // mymap.getPane('labels').style.pointerEvents = 'none';	mymap.createPane('labels');
            // // This pane is above markers but below popups
            // mymap.getPane('labels').style.zIndex = 650;
            // // Layers in this pane are non-interactive and do not obscure mouse/touch events
            // mymap.getPane('labels').style.pointerEvents = 'none';



    


         
    // Layer Open Street Map 
        var layerkita = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', { // definisikan maps ke variable layer kita
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
        }) ;
        mymap.addLayer(layerkita);
        
    // Layer ESRI World Imagery
        var Esri_WorldImagery = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
        });
        mymap.addLayer(Esri_WorldImagery);
        
      var Esri_DarkGray =  L.esri.basemapLayer('DarkGray').addTo(mymap);   


    //  Layer OSM Carto DB
        var Stadia_AlidadeSmoothDark = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
        });
        mymap.addLayer(Stadia_AlidadeSmoothDark);

        
    // control that shows state info on hover
        var info = L.control();

        info.onAdd = function (mymap) {
            this._div = L.DomUtil.create('div', 'info');
            this.update();
            return this._div;
        };

        info.update = function (props) {
            this._div.innerHTML = '<h4><b>DEMOGRAFI KEPENDUDUKAN WILAYAH</b></h4>' +  (props ?
            'DESA : <b>'+ props.DESA_KEL + '</b> <br />KECAMATAN : <b>'+ props.KECAMATAN + '</b><br />LUAS WILAYAH : <b>' + props.LUAS_KM2 + ' m<sup>2</sup></b><br />JUMLAH PENDUDUK LAKI-LAKI (2015) : <b>' + props.DPL_2015 + ' ORANG </b><br />JUMLAH PENDUDUK PEREMPUAN (2015) : <b>' + props.DPP_2015 + ' ORANG </b><br />JUMLAH PENDUDUK TOTAL (2015) : <b>' + props.JM_DPP2015 + ' ORANG </b><br />SEX RATIO : <b>' + props.SEX_RATIO + '</b><br />KEPADATAN PENDUDUK : <b>' + props.KEP_PEND + ' JIWA/KM2 </b><br /> KLASIFIKASI : <b>' + props.KLS_DES_KO + '</b><br />'


                : '<b>DEKATKAN MOUSE UNTUK MELIHAT<b>');
        };
        info.addTo(mymap);

    // Highlight Feature
       function highlightFeature(e) {
		var layer = e.target;

		layer.setStyle({
			weight: 3,
			color: 'gold',
			dashArray: '',
			fillOpacity: 0.55
		});

		if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
			layer.bringToFront();
		}

		info.update(layer.feature.properties);
	    }


        
    // Zomm Feature
        function zoomToFeature(e) {
            mymap.fitBounds(e.target.getBounds());
        }

        function onEachFeature(feature, layer) {
            layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
                click: zoomToFeature
            });
        }

    // Create Pop Up
        function popUp(f,l){
            var out = [];
                if (f.properties){
                    out.push('DESA/KELURAHAN'+" : "+f.properties['DESA_KEL']);
                    out.push('KECAMATAN'+" : "+f.properties['KECAMATAN']);
                    l.bindPopup(out.join("<br />"));
                    } 
        }
    </script>

    <!-- Panel Layers -->
        <script type="text/javascript">
            function iconByName(name) {
                return '<i class="icon" style="background-color:'+name+';border-radius:50%"></i>';
            }
            function featureToMarker(feature, latlng) {
                return L.marker(latlng, {
                    icon: L.divIcon({
                        className: 'marker-'+feature.properties.amenity,
                        html: iconByName(feature.properties.amenity),
                        iconUrl: '../images/markers/'+feature.properties.amenity+'.png',
                        iconSize: [25, 41],
                        iconAnchor: [12, 41],
                        popupAnchor: [1, -34],
                        shadowSize: [41, 41]
                    })
                });
            }

        // Definition Base Layers
            var baseLayers = [
                {  
                    name: "Open Street Map",
                    layer: layerkita
                },
                {
                    name: "ESRI World Imagery",
                    layer: Esri_WorldImagery
                },
                {
                    name: "ESRI DarkGray",
                    layer: Esri_DarkGray
                },
                {  
                name: "Stadia Alidade Smooth Dark",
                    layer: Stadia_AlidadeSmoothDark
                },
            ];

        // Definition Layers in Panel Layers
            <?php
                    foreach ($kelurahan as $key => $value){  ?>

                // Give Colour to Polygon
                var myStyle<?=$key?> = {
                    "color": "<?=$value?>",
                    "weight": 1,
                    "dashArray": '3',
                    "opacity": 0.55
                };

                // Reset Feature
                function resetHighlight(e) {
                    var layer = e.target;
                    layer.setStyle({
                        weight: 1,
                        fillOpacity: 0.2,
                        color: "<?=$value?>",
                        dashArray: '3'
                    });
                info.update();
                }

            <?php
                    $arrayKel[]='{
                        name: "'.str_replace('_',' ',$key).'",
                        icon: iconByName("'.$value.'"),
                        layer: new L.GeoJSON.AJAX(["assets/geojson/'.$key.'.geojson"],{
                            onEachFeature:onEachFeature 
                            ,style: myStyle'.$key.'
                            ,pointToLayer: featureToMarker})
                            .addTo(mymap) 
                    }';
                } 
            ?>

            var overLayers = [
                <?=implode (',', $arrayKel);?>
            ];
            var panelLayers = new L.Control.PanelLayers(baseLayers, overLayers,{
            collapsibleGroups: true,
            position:'topleft'
            });
            mymap.addControl(panelLayers);

        // Definition Coordinate Control Bar
            //add standard controls
            //	L.control.coordinates().addTo(mymap);
            //add configured controls
            
            L.control.coordinates({
                position:"bottomright",
                decimals:4,
                decimalSeperator:",",
                labelTemplateLat:"Latitude: {y}",
                labelTemplateLng:"Longitude: {x}"
            }).addTo(mymap);

            //  L.control.coordinates({
            //		position:"topright",
            //		useDMS:true,
            //		labelTemplateLat:"N {y}",
            //		labelTemplateLng:"E {x}",
            //		useLatLngOrder:true
            //	}).addTo(mymap);
            L.control.scale().addTo(mymap);

        </script>

        <script type="text/javascript">
                // Implementation: Set native zoomControl option to false!
                //                 ZoomBar uses the initial map view as the home position.
                //
        
                var zoom_bar = new L.Control.ZoomBar({position: 'topleft'}).addTo(mymap);
                L.tileLayer(
                    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', 
                    {maxZoom: 11}).addTo(mymap);
                
                function getCenterAndZoom(){
                //    console.log("Lat: "+mymap.getCenter().lat);
                //    console.log("Lon: "+mymap.getCenter().lng);
                //    console.log("Zoom: "+mymap.getZoom());
                    alert("Lat: "+mymap.getCenter().lat+"\nLon: "+mymap.getCenter().lng+"\nZoom: "+mymap.getZoom());
                }
        </script>

        <script>
            // Icon with Plugin-BeautifyMarker
                    // options1 = {
                    // icon: 'ambulance'
                    // , borderColor: 'Red'
                    // , textColor: 'Red'
                    // , innerIconStyle: 'font-size:12px;padding-top:1px;'
                    // };
                    options1 = {
                    iconShape: 'circle-dot'
                    , borderWidth: 4
                    , borderColor: 'red'};
                   // query
                   <?php 
                    $result = mysqli_query($conn, "SELECT * FROM covid19_terkonfirmasi");
                    $js = '';

                    while($row = mysqli_fetch_assoc($result)){
                        //$js .= 'L.marker([106.456589, -6.192498]).addTo(mymap)';
                        $js .= 'L.marker(['.$row['LONGITUDE'].', '.$row['LATITUDE'].'],{ icon: L.BeautifyIcon.icon(options1), draggable: false }).addTo(mymap).bindPopup("DESA/KELURAHAN : <b>'.$row['DESA_KELURAHAN'].'</b> <br>  TERKONFIRMASI (+) <b>: '.$row['TERKONFIRMASI'].'</b> ORANG");';
                    }
                    // menampilkan script js hasil dari looping diatas
                    echo $js;
                    ?>
                    var popup = L.popup();

                    options = {
                    iconShape: 'circle-dot'
                    , borderWidth: 4
                    , borderColor: 'blue'};
                    
                     <?php 
                    $result2 = mysqli_query($conn, "SELECT * FROM covid19_ODP");
                    $js2 = '';

                    while($row2 = mysqli_fetch_assoc($result2)){
                        //$js .= 'L.marker([106.456589, -6.192498]).addTo(mymap)';
                        $js2 .= 'L.marker(['.$row2['LONGITUDE'].', '.$row2['LATITUDE'].'],{ icon: L.BeautifyIcon.icon(options), draggable: false }).addTo(mymap).bindPopup("DESA/KELURAHAN : <b>'.$row2['DESA_KELURAHAN'].'</b> <br>  ODP <b>: '.$row2['ODP'].'</b> ORANG");';
                    }
                    // menampilkan script js hasil dari looping diatas
                    echo $js2;
                    ?>
                      var popup = L.popup();

                    options = {
                    iconShape: 'circle-dot'
                    , borderWidth: 4
                    , borderColor: 'yellow'};

                    <?php 
                            $result3 = mysqli_query($conn, "SELECT * FROM covid19_PDP");
                            $js3 = '';

                            while($row3 = mysqli_fetch_assoc($result3)){
                                //$js .= 'L.marker([106.456589, -6.192498]).addTo(mymap)';
                                $js3 .= 'L.marker(['.$row3['LONGITUDE'].', '.$row3['LATITUDE'].'],{ icon: L.BeautifyIcon.icon(options), draggable: false }).addTo(mymap).bindPopup("DESA/KELURAHAN : <b>'.$row3['DESA_KELURAHAN'].'</b> <br>  PDP <b>: '.$row3['PDP'].'</b> ORANG");';
                            }
                            // menampilkan script js hasil dari looping diatas
                            echo $js3;
                            ?>
                            var popup = L.popup();

                            options = {
                        iconShape: 'circle-dot'
                    , borderWidth: 4
                    , borderColor: 'black'};

                    <?php 
                            $result3 = mysqli_query($conn, "SELECT * FROM covid19_Meninggal");
                            $js3 = '';

                            while($row3 = mysqli_fetch_assoc($result3)){
                                //$js .= 'L.marker([106.456589, -6.192498]).addTo(mymap)';
                                $js3 .= 'L.marker(['.$row3['LONGITUDE'].', '.$row3['LATITUDE'].'],{ icon: L.BeautifyIcon.icon(options), draggable: false }).addTo(mymap).bindPopup("DESA/KELURAHAN : <b>'.$row3['DESA_KELURAHAN'].'</b> <br>  PDP <b>: '.$row3['MENINGGAL'].'</b> ORANG");';
                            }
                            // menampilkan script js hasil dari looping diatas
                            echo $js3;
                        ?>
                            var popup = L.popup();
                </script>

    <!-- Moment.js Clock -->
    <script>
		const clock = document.getElementById('jam-analog');
		setInterval(() => {
        const now = moment();
        const humanReadable = now.format('D-MM-Y hh:mm:ss A')
        clock.textContent = humanReadable
       /* console.log(humanReadable); */
      }, 1000);
	</script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Clock Moment JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
</body>
</html>