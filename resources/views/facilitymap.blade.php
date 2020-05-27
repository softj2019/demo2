<?php

use Illuminate\Support\Facades\DB;

$name = DB::table('facilities')->pluck('name')->toArray();
$location = DB::table('facilities')->pluck('location')->toArray();

echo "조회설비수".count($location);
dd($location);
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<title>관리시스템</title>
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-touch-fullscreen" content="yes">
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="css/all.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=gsy0xmamko"></script>
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpclientId=gsy0xmamko&submodules=geocoder"></script>
</head>
<body>
<div id="map" style="width:100%;height:1080px;"></div>
</body>
</html>

<script>
var faname = new Array();
var falocation = new Array();

faname = <?php echo json_encode($name); ?>;
falocation = <?php echo json_encode($location); ?>;
alert faname;
function addCommas(x) {
	return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
    
function searchAddressToCoordinate(address,i) {
	
	naver.maps.Service.geocode({
		address: address
	}, function(status, response) {
		if (status === naver.maps.Service.Status.ERROR) {
			global_status=false;
			//return alert('Something Wrong!');
		}

		var item = response.result.items[0];
		var addrType = item.isRoadAddress ? '[도로명 주소]' : '[지번 주소]';
		var point = new naver.maps.Point(item.point.x, item.point.y);

		//logic 
		callbackFunc(item,addrType,point,i);

	});
}

var map = new naver.maps.Map('map', {
    center: new naver.maps.LatLng(35.2084443, 126.8785993),
    zoom: 3
});

var markerContent = new Array();
var htmlMarker = new Array();
var elHtmlMarker = new Array();

// 2. HTML 마커
for (var i=0; i<falocation.length; i++) {
	searchAddressToCoordinate(falocation[i],i);
}
function callbackFunc(item,addrType,point,i){
	
	markerContent[i] = [
		'<div style="position:absolute;">',
			'<div class="infowindow" style="display:none;position:absolute;width:220px;top:-46px;left:-100px;background-color:white;z-index:1;border:1px solid black;margin:0;padding:0;">',
				'<a href="#" class="spmc btn_clear">'+faname[i]+'</a>',
				'<div style="margin: 0px; padding: 0px; width: 0px; height: 0px; position: absolute; border-width: 24px 10px 0px; border-style: solid; border-color: rgb(51, 51, 51) transparent; border-image: initial; pointer-events: none; box-sizing: content-box !important; transform-origin: right bottom 0px; transform: skewX(0deg); bottom: -25px; left: 100px;"></div>',
				'<div style="margin: 0px; padding: 0px; width: 0px; height: 0px; position: absolute; border-width: 24px 10px 0px; border-style: solid; border-color: rgb(255, 255, 255) transparent; border-image: initial; pointer-events: none; box-sizing: content-box !important; transform-origin: right bottom 0px; transform: skewX(0deg); bottom: -22px; left: 100px;"></div>',
			'</div>',
			'<div class="pin_s" style="cursor: pointer; width: 22px; height: 30px;">',
				'<img src="kogasiconmap.png" alt="" style="margin: 0px; padding: 0px; border: 0px solid transparent; display: block; max-width: none; max-height: none; -webkit-user-select: none; position: absolute; width: 22px; height: 30px; left: 0px; top: 0px;">',
				'<div class="pins_s_tooltip" style="display:none;width:150px;height:20px;position:absolute;top:5px;left:25px;background-color:white;"></div>',
			'</div>',
		'</div>'
	].join(''),
	htmlMarker[i] = new naver.maps.Marker({
		position: new naver.maps.LatLng(point),
		map: map,
		icon: {
			content: markerContent[i],
			size: new naver.maps.Size(22, 30),
			anchor: new naver.maps.Point(11, 30)
		}
	}),
	elHtmlMarker[i] = htmlMarker[i].getElement();

	$(elHtmlMarker).load('facility-map', function(e) {
	    $(elHtmlMarker).find('.infowindow').show();
	});

	$(elHtmlMarker).on('click', 'img', function(e) {
	    $(elHtmlMarker).find('.infowindow').show();
	});

/*	$(elHtmlMarker).on('mouseenter', 'img', function(e) {
	    $(elHtmlMarker).find('.pins_s_tooltip').show();
	});

	$(elHtmlMarker).on('mouseout', 'img', function(e) {
	    $(elHtmlMarker).find('.pins_s_tooltip').hide();
	});*/

	$(elHtmlMarker).on('click', 'a.btn_clear', function(e) {
	    $(elHtmlMarker).find('.infowindow').hide();
	});
}
</script>

