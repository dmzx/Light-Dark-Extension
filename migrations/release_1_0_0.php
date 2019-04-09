<?php
/**
*
* @package phpBB Extension - Light-Dark Extension
* @copyright (c) 2019 dmzx - https://www.dmzx-web.net & martin - https://www.martins-phpbb.com
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\lightdark\migrations;

class release_1_0_0 extends \phpbb\db\migration\migration
{
	public function update_data()
	{
		return array(
			// Add configs
			array('config.add', array('lightdark_enable', 0)),
			array('config.add', array('lightdark_version', '1.0.0')),
			// Add ACP module
			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_LIGHTDARK_TITLE',
			)),
			array('module.add', array(
				'acp',
				'ACP_LIGHTDARK_TITLE',
				array(
					'module_basename'	=> '\dmzx\lightdark\acp\acp_lightdark_module',
					'modes'				=> array('configuration'),
				),
			)),
		);
	}

	public function update_schema()
	{
		return array(
			'add_columns'	=> array(
				$this->table_prefix . 'users'	=> array(
					'lightdark_status'	=> array('BOOL', 1),
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_columns'	=> array(
				$this->table_prefix . 'users'	=> array(
					'lightdark_status',
				),
			),
		);
	}
}
