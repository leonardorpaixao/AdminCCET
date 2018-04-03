<?php
	$bd = mysql_connect('localhost', 'root', 'Eu<3DC0MP');
	mysql_select_db('prodap', $bd);
	mysql_set_charset('utf8');
	mysql_query("SELECT @chave:='".md5('prodap')."'");
?>
