var turnVisible = function (ids) 
{
	if (ids==null) {
		return false;
	}
	if (typeof ids === 'string' || ids instanceof String) {
		ids = [ids];
	}
	for (i=0;i<ids.length;i++) {
		var elem = document.getElementById(ids[i]);
		if (elem.style.display == 'none') {
			elem.style.display = 'block';
		}
	}
	return;
}
var turnUnvisible = function (ids) 
{
	if (ids==null) {
		return false;
	}
	if (typeof ids === 'string' || ids instanceof String) {
		ids = [ids];
	}
	for (i=0;i<ids.length;i++) {
		var elem = document.getElementById(ids[i]);
		if (elem.style.display == 'block') {
			elem.style.display = 'none';
		}
	}
	return;
}
