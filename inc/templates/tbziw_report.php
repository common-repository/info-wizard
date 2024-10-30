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
 * Wizard Display of final Report, This is meant to be customized
 * @file    tbziw_report.php
 * @author  Nigel Cruce (nigelcruce@terabytz.com)
 *
 */

//#####################################################################//
/**
 * Wizard Report Header
 * @param $page_id
 * @return void
 */
function tbziw_report_head($page_id)
{
    ?>
<style type="text/css">
    .tbziwreport p {
        margin: .5em 0 .5em 0
    }
</style>
        <table>
            <thead>
            <th>&nbsp;</th>
            </thead>
            <tbody>
                <tr>
                    <td>&nbsp;</td>
                </tr>
    <?php
}

//#####################################################################//
/**
 * Wizard Report Body
 * @param $page_id
 * @param $response_lookup
 * @return void
 */
function tbziw_report($page_id, $response_lookup)
{
    tbziw_report_head($page_id);
    ?>

    <?php foreach ($response_lookup as $pkey => $tbziw_report_item) { ?>

<tr>
    <td>
        <table>
            <tr>
                <td>
                    <table>
                        <tr>
                            <td>
                                <b><?php echo $tbziw_report_item[2]; ?> &nbsp;</b>
                            </td>
                        <tr>
                        </tr>
                        <td>
                            <i><b><?php echo $tbziw_report_item[0]; ?> &nbsp;</b></i>
                        </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="tbziwreport">
                        <?php echo $tbziw_report_item[1]; ?> &nbsp;
                    </div>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
        </table>
    </td>
</tr>

    <?php } ?>

    <?php
    tbziw_report_foot($page_id);
}

//#####################################################################//
/**
 * Wizard Report Footer
 * @param $page_id
 * @return void
 */
function tbziw_report_foot($page_id)
{
    ?>

<tr>
    <td>&nbsp;</td>
</tr>
            </tbody>
            <tfoot>
            <th>&nbsp;</th>
            </tfoot>
        </table>
<?php
}

?>
