<?php
/**
*
* @package phpBB Extension - Light-Dark Extension
* @copyright (c) 2019 dmzx - https://www.dmzx-web.net & martin - https://www.martins-phpbb.com
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\lightdark\acp;

class acp_lightdark_info
{
	function module()
	{
		return array(
			'filename'	=> 'dmzx\lightdark\acp\acp_lightdark_module',
			'title'		=> 'ACP_CAT_LIGHTDARK',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'configuration'	=> array('title' => 'ACP_LIGHTDARK_CONFIG', 'auth' => 'ext_dmzx/lightdark && acl_a_board', 'cat' => array('ACP_CAT_DOT_MODS')),
			),
		);
	}
}
