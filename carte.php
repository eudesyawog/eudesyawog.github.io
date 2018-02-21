<script>
document.title ="Carte interactive des photographies";
$('#menuspan').html('&#9776;').text(); 
</script>

<!--Leaflet and Plugins CSS-->
<link rel="stylesheet" type="text/css" href="leaflet-1.3.1/leaflet.css"/>
<link rel="stylesheet" type="text/css" href="leaflet-1.3.1/leaflet.defaultextent.css"/> <!--Default Extent CSS-->
<link rel="stylesheet" type="text/css" href="leaflet-1.3.1/L.Control.Sidebar.css" >		<!--Sidebar CSS-->

<script src="leaflet-1.3.1/leaflet.js"></script>
<script src="leaflet-1.3.1/leaflet.defaultextent.js"></script> <!--Default Extent JS-->
<script src="leaflet-1.3.1/L.Control.Sidebar.js"></script> <!--Sidebar JS-->

<!--GeoJSON data from database-->
<?php
if ($getlang == "fr" || $lang == "fr")
{
echo '<script src="getGeoJSON.php?lang=fr"></script>';
}
elseif ($getlang == "es" || $lang == "es")
{
echo '<script src="getGeoJSON.php?lang=es"></script>';
}
?>

<style>
#footer{display:none;}

.arrow-left{display:none;}

body { background:none; display:inline; margin-top:25px; overflow: hidden; }

#map { position:absolute; top:0; bottom:0; width:100%; z-index:-1;}
	
#menuspan{
	z-index:-1;
	margin:5px;
	padding:9px;
	display:inline;
	background-color:rgba(255,255,255,0.7);
	border-bottom-left-radius: 2px;
	border-bottom-right-radius: 2px;
	}
	
.popup {
text-align:center;
}

.popup p {
	font-size:22px;
	font-family:'Montserrat Alternates';
	}
.popup h2 {
	font-size:25px;
	font-family:'Montserrat Alternates';
	}
.popup h3 {
	font-size:22px;
	font-family:'Montserrat Alternates';
	}
.popup h4 {
	font-size:17px;
	font-family:'Montserrat Alternates';
	}

#sidebar{ color:white; z-index:-1;
}

.leaflet-top.leaflet-left{
	top:47px;
}



#pic{border-radius:8px;
}

#pic:focus{
outline:none;
}

#streetview {
color: white; 
}

.lb-caption{
font-family:Arial;
font-size:1.5rem;
}

.mfp-with-zoom .mfp-container,
.mfp-with-zoom.mfp-bg {
  opacity: 0;
  -webkit-backface-visibility: hidden;
  /* ideally, transition speed should match zoom duration */
  -webkit-transition: all 0.3s ease-out;
  -moz-transition: all 0.3s ease-out;
  -o-transition: all 0.3s ease-out;
  transition: all 0.3s ease-out;
}

.mfp-with-zoom.mfp-ready .mfp-container {
    opacity: 1;
}
.mfp-with-zoom.mfp-ready.mfp-bg {
    opacity: 0.8;
}

.mfp-with-zoom.mfp-removing .mfp-container,
.mfp-with-zoom.mfp-removing.mfp-bg {
  opacity: 0;
}

.legend.leaflet-control{
	font-family:'Montserrat Alternates';
	font-size:15px;
	background:rgba(255,255,255,0.7);
	box-shadow: 0 0 15px rgba(0,0,0,0.2);
    border-radius: 5px;
	width:auto;
	margin-bottom:0;
	line-height:1.5rem;
}
.legend.leaflet-control i{
	width: 22px;
	height: 22px;
	border-radius: 11px;
	border-color:rgba(10,10,10,0.7);
	border-style: solid;
    border-width: 3px;
	float:left;
	margin-right: 8px;
	margin-left: 5px;
	opacity: 0.8;
	
}

@media only screen and (max-device-width: 640px) {	
	.legend.leaflet-control{
		margin-bottom:36px;
	}
}
</style>

<div id="map"></div>
<div id="sidebar"></div>

<!--Map Script -->
<script>
//Some variables
var LienGalerie = "http://193.55.175.126/mexico85/?page=galerie#group-",
falseColor ="#ff5050",
trueColor="#6600cc";

//Map & BaseMaps

var map = L.map('map', {
			maxZoom: 18,
			minZoom: 12,
			maxBounds: [//south west
						[19.6099340338, -98.8486566173],
						//north east
						[19.2407934088, -99.3947146394]],
			}).setView([19.42, -99.15], 13,{defaultExtentControl: true});

var Stamen_TonerLite = L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/toner-lite/{z}/{x}/{y}.{ext}', {
	attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
	subdomains: 'abcd',
	minZoom: 0,
	maxZoom: 18,
	ext: 'png'
}).addTo(map);

var Hydda_Full = L.tileLayer('https://{s}.tile.openstreetmap.se/hydda/full/{z}/{x}/{y}.png', {
	maxZoom: 18,
	attribution: 'Tiles courtesy of <a href="http://openstreetmap.se/" target="_blank">OpenStreetMap Sweden</a> &mdash; Map data &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
});

var Esri_WorldTopoMap = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}', {
	attribution: 'Tiles &copy; Esri &mdash; Esri, DeLorme, NAVTEQ, TomTom, Intermap, iPC, USGS, FAO, NPS, NRCAN, GeoBase, Kadaster NL, Ordnance Survey, Esri Japan, METI, Esri China (Hong Kong), and the GIS User Community'
});

//Control Default Extent & Layer Switch
L.control.defaultExtent().addTo(map);	

var baseMaps = {
	'Stamen Toner Lite': Stamen_TonerLite,
	'OpenStreetMap':Hydda_Full,
	'Esri WorldTopoMap':Esri_WorldTopoMap
}	
layersSwitch=L.control.layers(baseMaps).setPosition("topleft").addTo(map);

chargerGeoJSON();

//Legend
var Legend =L.control({position: 'bottomleft'});
Legend.onAdd = function (map) {
    var div = L.DomUtil.create('div', 'legend');
        div.innerHTML +='<i style="background:'+trueColor+';"></i> <?php echo $xml->legend_cor->$lang;?>' +'<br> ' +  
					    '<i style="background:'+falseColor+';"></i> <?php echo $xml->legend_approx->$lang;?> ';
    return div; 
};
Legend.addTo(map);

//Functions

function chargerGeoJSON(){
	
	$.getJSON("getJSON.php",function(data) {
        $.each(data, function(id,pj) {
			var mexico = L.geoJSON(photos,{
				style:function(feature) {
						switch (feature.properties.precisionloc) {
						case '0': return {fillColor: falseColor};
						case '1': return {fillColor: trueColor};
						  }
						},
				pointToLayer: function(feature, latlng) { 
									return L.circleMarker(latlng,{
											radius : 10,
											weight: 3,
											color : "rgba(10,10,10,0.7)",
											opacity:0.8,
											fillOpacity: 0.8});}, 
				filter : function (feature,layer) {
					if (feature.properties.photojournaliste == pj.photojournaliste) // Filter on var GeoJSON 
						return true; },
				onEachFeature:onEachFeature});
				
				map.addLayer(mexico);
				
			layersSwitch.addOverlay(mexico, pj.photojournaliste);
		});
	});
};	

function onEachFeature(feature, layer) {
	
	layer.on("click", function(e){
	if (e.target.feature.properties.precisionloc==0){
		$("#sidebar").css("background","rgba(30,0,0,.7)");
		$("#sidebar").on("mouseenter","#streetview", function(){
			$(this).css("color", falseColor);
			}); 
		$("#sidebar").on("mouseleave","#streetview", function(){
			$(this).css("color", "white");
			});
		var precisionloc=' (<?php echo $xml->precisionloc->$lang;?>)';
		}
	else if (e.target.feature.properties.precisionloc==1){
		$("#sidebar").css("background","rgba(20,0,20,.7)");
		$("#sidebar").on("mouseover","#streetview", function(){
			$(this).css("color", trueColor);
			}); 
		$("#sidebar").on("mouseout","#streetview", function(){
			$(this).css("color", "white");
			});
		var precisionloc='';
		}

	imageContent = '<div class="image">' +
                              '<a class="magnific" href="'+feature.properties.repertoire+'/'+feature.properties.nom_photo+'"'+
							  '"><img id="pic" src="'+feature.properties.repertoire +'/thumb_200/'+feature.properties.nom_photo.substr(0, feature.properties.nom_photo.length-4)+
							  '_200.jpg" alt="'+ feature.properties.titre +'"/>'+'</a></div>';
							
	var slidebarContent =  '<div class="popup">' +
                            '<br><h2><b>' + feature.properties.titre + '</b></h2><br>' +
                            '<div class="imageshow">' +
                                imageContent +
                            '</div>' +
							'<div class="metadata">' +
								'<br><h4>'+feature.properties.description+'</h4><br>'+
								'<h3> <?php echo $xml->auteur_g->$lang;?> <h4>'+feature.properties.photojournaliste+'</h4><br> <h3><?php echo $xml->date_g->$lang;?><h4>'+feature.properties.date_photo+'</h4></h3>'+
								'<br><h3><?php echo $xml->adresse_g->$lang;?> '+precisionloc+'</h3><h4>'+feature.properties.adresse+'</h4><br><br>'+
                     			'<h3><a id="streetview" href="'+feature.properties.street_view+'" target="_blank">&gt <?php echo $xml->pano_g->$lang;?></a></h3>' +
								'<h3><a id="streetview" href="'+LienGalerie+feature.properties.ordre+'" target="_blank">&gt <?php echo $xml->galerie_g->$lang;?></a></h3>'+
					
                            '</div>'+
                        '</div>';
		
	$('#sidebar').html(slidebarContent);
	
	var sidebar = L.control.sidebar('sidebar', {
        position: 'right',
		closeButton: true
		});

    map.addControl(sidebar);
	
	setTimeout(function () {
            sidebar.show();
        }, 500);
		
	map.on('click', function () {
            sidebar.hide();
        });
	
	$("#sidebar").on("click","a.left", function(){
		console.log(e.target.feature.properties.ordre);
		
		});	
	
	$("#sidebar").on("click","a.right", function(){
		console.log("clicked");
		});
		
	});	
	
	$("#sidebar").on("mouseenter","a.magnific", function(){
			$(this).magnificPopup({
			  type:'image',
			  
			  mainClass: 'mfp-with-zoom',
			  zoom: {
				enabled: true, // By default it's false, so don't forget to enable it
				duration: 300, // duration of the effect, in milliseconds
				easing: 'ease-in-out', // CSS transition easing function
				opener: function(openerElement) {
				return openerElement.is('img') ? openerElement : openerElement.find('img');
				}
			  }
			});
		});
		
};
</script>