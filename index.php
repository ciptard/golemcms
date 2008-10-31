<?php

/**
   Golem CMS - The Rock Solid CMS. <http://darrin.roenfanz.info/golemcms>
   Copyright (C) 2008 Darrin Roenfanz <darrin@roenfanz.info>

   This program is free software: you can redistribute it and/or modify
   it under the terms of the GNU Affero General Public License as
   published by the Free Software Foundation, either version 3 of the
   License, or (at your option) any later version.

   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU Affero General Public License for more details.

   You should have received a copy of the GNU Affero General Public License
   along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

//  Constants  ---------------------------------------------------------------

define('GOLEM_ROOT', dirname(__FILE__));
define('CORE_ROOT', GOLEM_ROOT.'/core');

#define('APP_PATH', CORE_ROOT.'/app');

//  Init  --------------------------------------------------------------------

require GOLEM_ROOT.'/config.php';

define('BASE_URL', URL_PUBLIC . (USE_MOD_REWRITE ? '': '?'));

// if you have installed frog and see this line, you can comment it or delete it :)
if ( ! defined('DEBUG')) { header('Location: install/'); exit(); }

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS , DB_NAME);


// run everything!
#require APP_PATH.'/admin/main.php';
