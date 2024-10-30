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
 * Admin Base Dashboard
 * @file    tbziw_base.php
 * @author  Nigel Cruce (nigelcruce@terabytz.com)
 *
 */

//#####################################################################//
/**
 * Display basic help details
 * @return void
 */
function tbziw_admin_base()
{
    tbziw_admin_menu_head('Info Wizard Admin');
    ?>
<tr>
    <td>
        <p>
            This plugin displays questions and choices, which on submit may display a message for specific choices or
            more questions and choices.
        </p>

        <p>
            Questions are broken into sections; each section logically leads from previous sections except section '0',
            which will always be displayed first.
        </p>

        <p>
            Questions each have one or more choices, each choice can be linked to a "result" or a "section" or both or
            neither.
        </p>

        <p>
            Results are formatted chunks of html that are displayed in the order triggered by choices. Results can
            accumulate on each section from previous sections.
        </p>

        <p>
            Choices are displayed radio buttons. Choices may be detailed, for example to introduce a section, or simple
            "yes, no, I don't know"
        </p>

        <p>
            Example: A question is setup with <b>section</b> set to 0, which makes the question (or questions) initially
            visible. Create three more questions, with sections 1,2,3. Create two responses.
        </p>

        <p>
            Now create four choices.
        </p>


        <ul>
            <li>The first choice set the question desired and check the "Sets Section" box, and add.</li>
            <li>The second choice set the question desired and check the "Sets Section" box, and add.</li>
            <li>The third choice set the question AND response desired and check both "Sets Section" and "Sets Results"
                boxes, and add.
            </li>
            <li>The fourth choice set the response desired and check "Sets Results" box, and add.</li>
        </ul>


        <p>
        The result will be that the first or second question take one to a different section, that will contain the
        questions that were setup for that section. The third question will take you yet another section, but this time
        you will see the response that was selected. The fourth question will land on a page that only contains the
        specified response.
        </p>

        <p>
            The logic was tested to 6 levels without performance impact, but larger responses will of course impact load
        </p>

        <ul>
            <li><b>Questions</b> - These are questions or statements preceding choices</li>
            <li><b>Choices</b> - These are the answers or multiple choices for a questions. Choices may provide directly
                for an answer or determine the next <b>section</b></li>
            <li><b>Response</b> - Responses are blocks of information that accumulate as sections are submitted, based
                on choices made.
            </li>
            <li><b>Sections</b> - Logic divisions of questions/choices</li>
        </ul>


    </td>
</tr>
<?php
    tbziw_admin_menu_footer();

}

?>
