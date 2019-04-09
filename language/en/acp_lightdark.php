<?php
/**
*
* @package phpBB Extension - Light-Dark Extension
* @copyright (c) 2019 dmzx - https://www.dmzx-web.net & martin - https://www.martins-phpbb.com
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters for use
// ’ » “ ” …

$lang = array_merge($lang, array(
	'LIGHTDARK_SAVED'				=> 'Light-Dark Configuration Saved',
	'LIGHTDARK_CONFIG_TITLE'		=> 'Light-Dark Configuration',
	'LIGHTDARK_ENABLE'				=> 'Light-Dark Enable',
	'LIGHTDARK_ENABLE_EXPLAIN'		=> 'Enable the Light-Dark.',
	'LIGHTDARK_RESET'				=> 'All Light-Dark reset',
	'LIGHTDARK_RESET_EXPLAIN'		=> 'Reset all members to light version.',
	'LIGHTDARK_RESET_CONFIRM'		=> 'Confirm reset',
	'LIGHTDARK_RESET_BUTTON'		=> 'Reset all members',
));
