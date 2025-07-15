function createPost() {
	var articlediv = document.getElementById('article');
	var articlelnk = document.getElementById('articlelnk');
	if (articlediv.style.display == 'none' || articlelnk.style.display == 'block'){
		articlediv.style.display = 'block';
		articlelnk.style.display = 'none';
	} else {
		articlediv.style.display = 'none';
		articlelnk.style.display = 'block';
	}
}

function maptoggle() {
	var selection = document.getElementById('category').value;
	var mapdiv = document.getElementById('googleMap');
	var eventdiv = document.getElementById('eventDiv');
	if (selection != 2) {
		mapdiv.style.display = 'none'
		eventdiv.style.display = 'none'
	} else {
		mapdiv.style.display = 'block'
		eventdiv.style.display = 'block'
	}
}