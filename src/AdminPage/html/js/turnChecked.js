var turnChecked = function (classes) 
{
	if (classes==null) {
		return false;
	}
	if (typeof classes === 'string' || classes instanceof String) {
		classes = [classes];
	}
	for (i=0;i<classes.length;i++) {
		var elem = document.getElementsByClassName(classes[i]);
		for (j=0;j<elem.length;j++) {
			if (elem[j].checked) {
				// 処理なし
			} else {
				elem[j].checked = true;
			}
		}
	}
	return;
}
var turnUnchecked = function (classes) 
{
	if (classes==null) {
		return false;
	}
	if (typeof classes === 'string' || classes instanceof String) {
		classes = [classes];
	}
	for (i=0;i<classes.length;i++) {
		var elem = document.getElementsByClassName(classes[i]);
		for (j=0;j<elem.length;j++) {
			if (elem[j].checked) {
				elem[j].checked = false;
			}
		}
	}
	return;
}
