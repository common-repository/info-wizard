=== Plugin Name ===
Author: Nigel Cruce
Author URI: http://www.terabytz.com
Contributors: nigelcruce
Tags: page, wizard, plugin
Requires at least: 3.0
Tested up to: 3.5
Stable tag: trunk
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html

Displays questions and choices, which are logically tied to 
results or additional sections of questions and choices.

== Description ==

This plugin displays questions and choices, which on submit may display a 
message for specific choices or more questions and choices.

Questions are broken into sections; each section logically leads from previous 
sections except section '0', which will always be displayed first.

Questions each have one or more choices, each choice can be linked to a 
"result" or a "section" or both or neither.

Results are formatted chunks of html that are displayed in the order triggered 
by choices.  Results can cumulate on each section from previous sections.

Choices are displayed radio buttons.  Choices may be detailed, for example to 
introduce a section, or simple "yes, no, I don't know"

Developer Website: http://www.terabytz.com

Plugin Support: http://www.terabytz.com/info-wizard

== Installation ==

1. Activate the plugin through the 'Plugins' menu in WordPress
2. Look for new template named "Info_Wizard"
3. Add a new page using new template

Alternative/Advanced
1. Activate the plugin through the 'Plugins' menu in WordPress
2. Copy the theme's main template (e.g. page.php), and name it something else, 
    e.g. Info_Wizard.php
3. Place `<?php tbziw_executetemplate($page_id) ?>` in the custom template
4. Add a new page using custom template

Place `<?php tbziw_executetemplate($page_id) ?>` in a custom template

== Frequently Asked Questions ==

What makes this different from other WordPress plugins?

There were no plugins I could find that allowed a question and answer format 
that provided for a logical flow.  The idea spawned from a civic 
hack-a-thon with hackforchange.

== Screenshots ==

== Changelog ==

= 1.2.5 =
* Fixed bug where quesiton delete and update not working

= 1.2.4 =
* Added a list of questions as shortcut
* Fixed bug where question html not showing
* Added tables for configurations, next major release

= 1.2.3 =
* Changed order of Admin data entry, placing *new* first in list
* Changed data entry format, created templates for data entry
* Modified data import to be easier to update existing data

= 1.2.2 =
* Add code documentation
* Fixed issue with reset of templates
* Added section dropdown

= 1.2.1 =
* Fixed issue in add/save of objects

= 1.2.0 =
* First public release

= 1.1.0 =
* Beta release without client data
* Enabled editing by default
* Added example data

= 1.0.4 =
* Pre-Beta release with client data

= 1.0.3 =
* Fixed issues with layout
* Added automatic push of template

= 1.0.2 =
* Reworked display to use "templates"

= 1.0.1 =
* Modifications to layout handling
* moved to OO structure

= 1.0.0 =
* Alpha release
* Added admin features

= 0.0.9 =
* Pre-alpha
