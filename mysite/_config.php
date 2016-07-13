<?php

global $project;
$project = 'mysite';

global $databaseConfig;
$databaseConfig = array(
	"type" => 'MySQLDatabase',
	"server" => 'localhost',
	"username" => 'strangeq_usr',
	"password" => 'HuMn@f7r4lL',
	"database" => 'strangeq_main',
	"path" => '',
);

// Set the site locale
i18n::set_locale('en_US');