<div align="center"><img src="img/logo_footer.gif" width="150"/></div><br/><br/>    <?foreach ($menu as $key => $val) {    echo '<a href="?p=' . $key . '">' . $val[0] . '</a><br>';}    ?><br/><a href="?exit=1">Выход</a>