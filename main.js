/* randomise background colour */
window.addEventListener('load',function() {
	var hue = Math.floor(Math.random()*360);
	document.body.style.backgroundColor = 
		"hsl(" + hue.toString(10) + ", 44%, 43%)";
} ,false);
