<!doctype html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="<?=$current_path?>/html/style/style.css">
	<script src="<?=$current_path?>/html/js/turnVisible.js"></script>
	<script src="<?=$current_path?>/html/js/turnChecked.js"></script>
	<script src="<?=$current_path?>/html/js/checkInput.js"></script>
	<!-- link rel="shortcut icon" href="" -->
	<title>新しいメール</title>
</head>
<body>
<script>	
var postForm = function () 
{
	if (checkInput()) {
		var form = document.forms.mailContent;
		form.submit();
		return true;
	}
	return false;
}
</script>
	<h2>新しいメール</h2>
	<div>
		<form method="post" name="mailContent" id="mail_content" action="<?=$current_page?>/confirm">
			<div>あて先：</div>
<input type="radio" name="radio" value="all" onclick="turnUnvisible(['out_list','ind_list']);turnChecked(['out-checkbox']);turnUnchecked(['ind-checkbox']);">全員
<input type="radio" name="radio" value="out" onclick="turnVisible('out_list');turnUnvisible('ind_list');turnUnchecked('ind-checkbox');">出勤者
<input type="radio" name="radio" value="ind" onclick="turnVisible('ind_list');turnUnvisible('out_list');turnChecked('out-checkbox');">個別
<?php 
/* test data 挿入
INSERT INTO out_date (terminal_id,out_date,in_out) VALUES ('1608','2019-01-15','1');
INSERT INTO out_date (terminal_id,out_date,in_out) VALUES ('1662','2019-01-15','1');
INSERT INTO out_date (terminal_id,out_date,in_out) VALUES ('2661','2019-01-15','0');
INSERT INTO out_date (terminal_id,out_date,in_out) VALUES ('3670','2019-01-15','0');
INSERT INTO out_date (terminal_id,out_date,in_out) VALUES ('4782','2019-01-15','1');
 */
// 全員（非表示）
echo '<div id="all_list">';
foreach ($data['terminals'] as $id) {
	echo '<input name="all[]" type="checkbox" value="' . $id . '" checked="checked" style="display:none">';
}
echo '</div>';
// 出勤者
echo '<div id="out_list" style="display:none">';
foreach ($data['oids'] as $oid) {
	echo '<input name="out[]" class="out-checkbox" type="checkbox" value="' . $oid . '" checked="true">' . $data['terminals'][$oid];
}
echo '</div>';
// 個別
echo '<div id="ind_list" style="display:none">';
foreach ($data['oids'] as $oid) {
	echo '<input name="ind[]" class="ind-checkbox" type="checkbox" value="' . $oid . '">' . $data['terminals'][$oid];
}
echo '</div>';
?>
			<p>タイトル</p>
			<textarea id="title" name="mail-title" class="mail-title" cols="50" rows="1"></textarea>
			<p>本文</p>
			<textarea id="body" name="mail-body" class="mail-body" cols="50" rows="5"></textarea>
			<br>
			<button type="button" onclick="postForm();">決定</button>
		</form>
	</div>
</body>
</html>
