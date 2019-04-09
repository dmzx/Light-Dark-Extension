<?php
/**
*
* @package phpBB Extension - Light-Dark Extension
* @copyright (c) 2019 dmzx - https://www.dmzx-web.net & martin - https://www.martins-phpbb.com
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\lightdark\controller;

use phpbb\template\template;
use phpbb\user;
use phpbb\request\request_interface;
use phpbb\config\config;
use phpbb\log\log_interface;
use phpbb\db\driver\driver_interface as db_interface;

class admin_controller
{

	/** @var template */
	protected $template;

	/** @var user */
	protected $user;

	/** @var request_interface */
	protected $request;

	/** @var config */
	protected $config;

	/** @var log_interface */
	protected $log;

	/** @var db_interface */
	protected $db;

	/**
	* Constructor
	*
	* @param template		 		$template
	* @param user					$user
	* @param request_interface		$request
	* @param config					$config
	* @param log_interface			$log
	* @param db_interface			$db
	*
	*/
	public function __construct(
		template $template,
		user $user,
		request_interface $request,
		config $config,
		log_interface $log,
		db_interface $db
	)
	{
		$this->template 	= $template;
		$this->user 		= $user;
		$this->request 		= $request;
		$this->config 		= $config;
		$this->log 			= $log;
		$this->db			= $db;

		$this->user->add_lang_ext('dmzx/lightdark', 'acp_lightdark');
	}

	public function handle_config()
	{
		add_form_key('acp_lightdark');

		// Is the form being submitted to us?
		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key('acp_lightdark'))
			{
				trigger_error('FORM_INVALID');
			}

			// Set the options the user configured
			$this->set_options();

			// Add option settings change action to the admin log
			$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_LIGHTDARK_SAVED');

			trigger_error($this->user->lang['LIGHTDARK_SAVED'] . adm_back_link($this->u_action));
		}

		if ($this->request->is_set_post('lightdark_purge') && $this->request->variable('lightdark_purge_confirm', false) && check_form_key('acp_lightdark'))
		{
			$this->update_lightdark_status();

			$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_LIGHTDARK_TABLE_RESET', false, array($this->user->data['username']));
			trigger_error($this->user->lang('LIGHTDARK_RESET') . adm_back_link($this->u_action));
		}

		$this->template->assign_vars(array(
			'LIGHTDARK_ENABLE'		=> $this->config['lightdark_enable'],
			'LIGHTDARK_VERSION'		=> $this->config['lightdark_version'],
			'U_ACTION'				=> $this->u_action,
		));
	}

	protected function set_options()
	{
		$this->config->set('lightdark_enable', $this->request->variable('lightdark_enable', 0));
	}

	protected function update_lightdark_status()
	{
		$sql = 'UPDATE ' . USERS_TABLE . '
			SET lightdark_status = 1
			WHERE user_id = user_id';
		$this->db->sql_query($sql);

		return (bool) $this->db->sql_affectedrows();
	}

	public function set_page_url($u_action)
	{
		$this->u_action = $u_action;
	}
}
