<!doctype html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="<?=$current_path?>/html/style/style.css">
	<title>新しいメール</title>
</head>
<body>
	<h2>createMail</h2>
	<div>
		<form action="<?=$current_page?>/sendMail">
			<div>あて先：　</div>
			  <input type="radio" value="all">全員
			  <input type="radio" value="out">出勤者
			  <input type="radio" value="ind">個別
<?php 
/* test data 挿入
INSERT INTO out_date (terminal_id,out_date,in_out) VALUES ('1608','2019-01-06','1');
INSERT INTO out_date (terminal_id,out_date,in_out) VALUES ('1662','2019-01-06','1');
INSERT INTO out_date (terminal_id,out_date,in_out) VALUES ('2661','2019-01-06','0');
INSERT INTO out_date (terminal_id,out_date,in_out) VALUES ('3670','2019-01-06','0');
INSERT INTO out_date (terminal_id,out_date,in_out) VALUES ('4782','2019-01-06','1');
 */
echo '<div class="out_list">';
foreach ($data['oids'] as $oid) {

	echo '<input type="checkbox" value="' . $oid . '">' . $data['terminals'][$oid];
}
echo '</div>';

?>
			<div>タイトル：　<input type="text" name="title"></div>
			<div>本文：　<input type="text" name="body"></div>
			<input type="submit">
		</form>
	</div>
</body>
</html>
