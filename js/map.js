var map;
			
function initMap(){
	var latitude = 51.88736338693454;
	var longitude = -2.0875431308738426;
	var latLng = new google.maps.LatLng(latitude, longitude);
	map = new google.maps.Map(document.getElementById("googleMap"), {
		center: latLng,
		zoom: 17
	});

	var marker;

	function placeMarker(location) {
		if (marker) {
			marker.setPosition(location);
		} else {
			marker = new google.maps.Marker({
				position: location,
				map: map
			});
		}
	}
	
	google.maps.event.addListener(map,'click',function(event) {
		placeMarker(event.latLng);
		document.getElementById("latitude").value = event.latLng.lat();
		document.getElementById("longtitude").value = event.latLng.lng();
	});
}



function postMap(){
	var latitude = +(document.getElementById("latitude").innerHTML);
	var longitude = +(document.getElementById("longitude").innerHTML);
	var latLng = new google.maps.LatLng(latitude, longitude);
	map = new google.maps.Map(document.getElementById("googleMap2"), {
		center: latLng,
		zoom: 17
	});
	var marker = new google.maps.Marker({
		position: latLng,
		map: map
	});
	map.setOptions({draggable: false});
}