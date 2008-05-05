DROP TABLE IF EXISTS cat_areas
CREATE TABLE cat_areas (id_area tinyint(3) unsigned NOT NULL auto_increment, area char(64) default NULL, pos tinyint(3) unsigned default NULL, UNIQUE KEY id_areas (id_area), KEY id_areas_2 (id_area), KEY pos (pos)) TYPE=MyISAM
INSERT INTO cat_areas VALUES (1,'Default',1)
DROP TABLE IF EXISTS cat_domains
CREATE TABLE cat_domains (id_domains int(6) unsigned NOT NULL auto_increment, name varchar(64) default NULL, title varchar(128) default NULL, comment text, object varchar(128) default NULL, r_table varchar(128) default NULL, is_key tinyint(1) unsigned default '0', is_on_list tinyint(1) unsigned default '0', is_on_select tinyint(1) unsigned default '0', is_parsed tinyint(1) unsigned default '0', in_table varchar(128) default NULL, addin text, pos tinyint(3) unsigned default NULL, param varchar(64) default NULL, UNIQUE KEY id_domains (id_domains), KEY id_domains_2 (id_domains), KEY pos (pos,name,in_table)) TYPE=MyISAM
DROP TABLE IF EXISTS cat_groups
CREATE TABLE cat_groups (ugroup char(32) NOT NULL default '', mod_table char(128) NOT NULL default '', is_show tinyint(1) unsigned default '0', is_edit tinyint(1) unsigned default '0', is_publish tinyint(1) unsigned default '0', is_limited tinyint(1) unsigned default '0', KEY login_2 (ugroup), KEY login (ugroup)) TYPE=MyISAM
INSERT INTO cat_groups VALUES ('admin','ModFileManager',1,1,0,0)
INSERT INTO cat_groups VALUES ('admin','ModBackup',1,1,1,0)
DROP TABLE IF EXISTS cat_log
CREATE TABLE cat_log (tmark datetime NOT NULL default '0000-00-00 00:00:00', object char(32) default NULL, user char(32) default NULL, event char(255) default '0', ip char(16) default NULL, KEY tmark (tmark)) TYPE=MyISAM
DROP TABLE IF EXISTS cat_tables
CREATE TABLE cat_tables (name char(128) NOT NULL default '', area tinyint(3) unsigned NOT NULL default '0', created_by char(32) default NULL, object char(64) default NULL, title char(255) default NULL, pos tinyint(3) unsigned NOT NULL default '0', PRIMARY KEY  (name), KEY area (area,pos)) TYPE=MyISAM
DROP TABLE IF EXISTS cat_users
CREATE TABLE cat_users (login char(32) NOT NULL default '', passwd char(32) NOT NULL default '', ugroup char(32) default NULL, person char(255) default NULL, email char(128) default NULL, is_system tinyint(1) unsigned default '0', is_control tinyint(1) unsigned default '0', is_info tinyint(1) unsigned default '0', UNIQUE KEY login (login), KEY login_2 (login)) TYPE=MyISAM
INSERT INTO cat_users VALUES ('admin','admin','admin','Administrator','webmaster@localhost',1,1,1)
