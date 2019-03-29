function init()
{
	
}

function tileUpdate(evt) {
  var node = evt.target || evt.srcElement;
  if (node.name == 'on') {
    node.value = "OFF";
  }
}

function toggleHighlight(on)
{
  var el = document.getElementById('weather');

  el.style['display'] = on ? 'block' : 'none';
}

// toggleHighlight(true);  // turn on
// toggleHighlight(false); // turn off
