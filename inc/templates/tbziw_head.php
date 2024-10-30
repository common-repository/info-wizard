<?php
/*
Author: Nigel Cruce
Author URI: http://www.terabytz.com
Project: Info Wizard
License: GPL v3

Copyright 2013 Nigel Cruce, Terabytz  (email : nigelcruce@terabytz.com)

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/
//#####################################################################//
/**
 * Info Wizard Display Header Functions
 * @file    tbziw_head.php
 * @author  Nigel Cruce (nigelcruce@terabytz.com)
 *
 */

//#####################################################################//
/**
 * Admin Menu Header
 * @param $title
 * @return void
 */
function tbziw_admin_menu_head($title)
{
    echo '<div class="wrap"><h2>' . $title . '</h2>';
    echo '<a name="tbziw_top"></a>';
    echo '<div class="metabox-holder"><div style="float:left; width:48%;" class="inner-sidebar1">';
}

function tbziw_admin_menu_top()
{
    echo '<tr><td><hr><a href="#tbziw_top">Top</a><br></td></tr>';
}
//#####################################################################//
/**
 * Header
 * @return void
 */
function tbziw_general_head()
{
    echo '';
}

//#####################################################################//
/**
 * Body/Section Splitter
 * @return void
 */
function tbziw_admin_split_sections()
{
    echo '<tr><td><hr><a href="#tbziw_top">Top</a><br></td></tr>';
}

?>