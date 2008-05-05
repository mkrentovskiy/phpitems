<?
	header("Content-Type: text/html; charset=utf-8");

	include "objects/file.php";	
	include "objects/txtfile.php";	
	include "objects/pattern.php";	
	
	$lang = "locale";

	$s = '';	
	$s .= "<font class='title'>Установка CAT2</font><br><br>";
	if($cat_opt > 0) {
		//
		if(file_exists('config') || mkdir('config','1777')) {
			copy("install/$lang.php","config/locale.php");
			$s .= "Локализация установлена...<br>";

			$pl = new Pattern("install/locale_project.php");
			$pl->reset();
			$pl->addHash('CAT_M_TITLE', $cat_m_title);
			$pl->addHash('CAT_M_COMMENT', $cat_m_comment);
			$pl->makeDataCode();
			$pl->outDataCodeToFile("config/locale_project.php");
			$s .= "Параметры проекта сохранены...<br>";

			if(mysql_connect($cat_db_host,$cat_db_user,$cat_db_password)) {

	 			$r = mysql_db_query($cat_db_name,"show tables");
				if($r == 0) $s .= "<font color='#ff0000'>".mysql_error()."</font><br>";
				for($i = 0; $i < mysql_num_rows($r); $i++) {
					$str = mysql_fetch_row($r);
					$t = $str[0];
					$p = mysql_db_query($cat_db_name,"show columns from $t");
					for($j = 0; $j < mysql_num_rows($p); $j++) {
						$st = mysql_fetch_array($p);
						$md[$t][$j] = $st[Field];					
					};
					$mt[$i] = $t;
				};				
				$s .= "Сканирование базы завершено...<br>";

				$dump = file("install/create.sql");
				for($i = 0; $i < count($dump); $i++) {
					if(strlen($dump[$i]) > 0) {					
	 					$r = @mysql_db_query($cat_db_name,$dump[$i]);
						if($r == 0) $s .= "<font color='#ff0000'>".mysql_error()."</font><br>";
					};
				};				
				$s .= "Создание служебных таблиц произведено...<br>";

				for($i = 0; $i < count($mt); $i++) {
					$t = $mt[$i];
					@mysql_db_query($cat_db_name,"insert into cat_tables values('$t',1,'admin','TabCommon','$t','$i')");
					for($j = 0; $j < count($md[$t]); $j++) {
						$f = $md[$t][$j];
						@mysql_db_query($cat_db_name,"insert into cat_domains values(0,'$f','$f','','DomTitle','',0,1,0,0,'$t','',$j,32)");
					};
				};				
				$s .= "Импортирование структуры базы завершено...<br>";


				$pl = new Pattern("install/config.php");
				$pl->reset();
				$pl->addHash('CAT_DB_HOST', $cat_db_host);
				$pl->addHash('CAT_DB_USER', $cat_db_user);
				$pl->addHash('CAT_DB_PASSWORD', $cat_db_password);
				$pl->addHash('CAT_DB_NAME', $cat_db_name);
				$pl->makeDataCode();
				$pl->outDataCodeToFile("config/config.php");
				$s .= "Файл кофигурации создан...<br>";
				$s .= "Процесс установки завершен. <a href='index.php'>Войдите в систему под пользователем admin и паролем admin</a> и поменяйте пароль.<br>";
			} else $s .= "<font color='#ff0000'>Ошибка доступа к базе</font><br>";
		} else $s .= "<font color='#ff0000'>Ошибка создания каталога</font><br>";

		
	} else {
		$s .= "<table border='0' cellpadding='2' cellspacing='1' width='100%' class='pt9'>";
		$s .= "<form action='index.php?cat_opt=1' method='post'>";
		$s .= "<tr><td class='einfo' align='right' width='50%'>";
		$s .= "<b>Название проекта</b>";
		$s .= "</td><td class='eedit' align='left' width='50%'>";
		$s .= "<input type='text' name='cat_m_title' size='32' maxlength='255'>";
		$s .= "</td></tr>";
		$s .= "<tr><td class='einfo' align='right' width='50%'>";
		$s .= "<b>Комментарий</b>";
		$s .= "</td><td class='eedit' align='left' width='50%'>";
		$s .= "<input type='text' name='cat_m_comment' size='32' maxlength='255' value='Система управления сайтом'>";
		$s .= "</td></tr>";
		$s .= "<tr><td class='einfo' align='right' width='50%'>";
		$s .= "<b>Сервер баз данных</b>";
		$s .= "</td><td class='eedit' align='left' width='50%'>";
		$s .= "<input type='text' name='cat_db_host' size='32' maxlength='255' value='localhost'>";
		$s .= "</td></tr>";
		$s .= "<tr><td class='einfo' align='right' width='50%'>";
		$s .= "<b>Пользователь СУБД</b>";
		$s .= "</td><td class='eedit' align='left' width='50%'>";
		$s .= "<input type='text' name='cat_db_user' size='32' maxlength='255' value='root'>";
		$s .= "</td></tr>";
		$s .= "<tr><td class='einfo' align='right' width='50%'>";
		$s .= "<b>Пароль</b>";
		$s .= "</td><td class='eedit' align='left' width='50%'>";
		$s .= "<input type='text' name='cat_db_password' size='32' maxlength='255' value=''>";
		$s .= "</td></tr>";
		$s .= "<tr><td class='einfo' align='right' width='50%'>";
		$s .= "<b>База данных</b>";
		$s .= "</td><td class='eedit' align='left' width='50%'>";
		$s .= "<input type='text' name='cat_db_name' size='32' maxlength='255'>";
		$s .= "</td></tr>";
		$s .= "<tr><td align='center' colspan='2'>";
		$s .= "<input type='submit' class='sub' value='Установить'>";
		$s .= "</td></tr></form>";			
		$s .= "</table>";	
	};


	$p = new Pattern("misc/install.html");
	$p->reset();

	$p->addHash('CONTENT', $s);

	$p->makeDataCode();
	$p->outDataCodeToStd();		 

?>