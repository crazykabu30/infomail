/**
 * @return {Boolean} 
 */
var checkMailto = function () 
{
	var elems = document.getElementsByName('radio');
	var radio = '';
	for (i=0;i<elems.length;i++) {
		if (elems[i].checked) {radio = elems[i].value;}
	}
	if (radio=='') {
		return false;
	}
	if (radio=='all') {
		// 処理なし
	} else {
		var str = radio + '_list';
		elems = document.getElementById(str).children;
		var isChecked = false;
		for (j=0;j<elems.length;j++) {
			if (elems[j].checked) {isChecked = true;}
		}
		if (isChecked) {
			// 処理なし
		} else {
			return false;
		}
	}
	return true;
}
/**
 * @return {Boolean} 
 */
var checkTextarea = function (id) 
{
	if (document.getElementById(id).value == '') {
		return false;
	}
	return true;
}
/**
 * @return {Boolean} 
 */
var checkInput = function ()
{
	if (checkMailto()) {
		// 処理なし
	} else {
		alert('あて先を選択してください。');
		return false;
	}
	if (checkTextarea('title')) {
		// 処理なし
	} else {
		alert('タイトルを入力してください。');
		return false;
	}
	if (checkTextarea('body')) {
		// 処理なし
	} else {
		alert('本文を入力してください。');
		return false;
	}
	return true;
}
