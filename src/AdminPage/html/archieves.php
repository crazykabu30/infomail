<!doctype html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="<?=$current_path?>/html/style/style.css">
	<title>過去のお知らせ</title>
</head>
<body>
	<h2>過去のお知らせ</h2>
	<table>
		<tr>
			<th>日付</th><th>件名</th>
		</tr>

<?php
foreach (array_keys($data) as $key) {
	echo <<< EOT
<tr>
	<td>{$data[$key]['date']}</td>
	<td><a href="{$current_path}/index.php/detail?id={$key}">{$data[$key]['title']}</a></td>
</tr>
EOT;
}
?>
	</table>

	<!-- ページャ -->

</body>
</html>
