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
**/

/**
   Simple 404 Not Found file display
 */

header("HTTP/1.0 404 Not Found");
header("Status: 404 Not Found");

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head>
<title>404 Not Found</title>
</head><body>
<h1>Not Found</h1>
<p>The requested URL was not found on this server.</p>
<hr>
<address><a href="http://darrin.roenfanz.info/golemcms">GolemCMS</a> The Rock Solid CMS!</address>
</body></html>