<?php
/**
*
* @package phpBB Extension - Light-Dark Extension
* @copyright (c) 2019 dmzx - https://www.dmzx-web.net & martin - https://www.martins-phpbb.com
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\lightdark\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use phpbb\user;
use phpbb\db\driver\driver_interface as db_interface;
use phpbb\config\config;
use phpbb\template\template;
use phpbb\controller\helper;
use phpbb\request\request_interface;

class main_listener implements EventSubscriberInterface
{
	/** @var user */
	protected $user;

	/** @var db_interface */
	protected $db;

	/** @var config */
	protected $config;

	/** @var template */
	protected $template;

	/** @var helper */
	protected $helper;

	/** @var request_interface */
	protected $request;

	/**
	 * Constructor
	 *
	 * @param user				$user
	 * @param db_interface		$db
	 * @param config			$config
	 * @param template			$template
	 * @param helper			$helper
	 * @param request_interface	$request
	 *
	 */
	public function __construct(
		user $user,
		db_interface $db,
		config $config,
		template $template,
		helper $helper,
		request_interface $request
	)
	{
		$this->user 		= $user;
		$this->db 			= $db;
		$this->config 		= $config;
		$this->template 	= $template;
		$this->helper 		= $helper;
		$this->request 		= $request;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.page_header' 							=> 'page_header',
			'core.ucp_prefs_personal_data'				=> 'ucp_prefs_get_data',
			'core.ucp_prefs_personal_update_data'		=> 'ucp_prefs_set_data',
		);
	}

	function page_header($event)
	{
		if ($this->config['lightdark_enable'])
		{
			$this->user->add_lang_ext('dmzx/lightdark', 'common');

			$this->template->assign_vars(array(
				'S_LIGHTDARK_ENABLE' 	=> $this->config['lightdark_enable'],
				'S_LIGHTDARK_DARK' 	=> $this->user->data['lightdark_status'] ? false : true,
				'U_LIGHTDARK_CLOSE'	=> $this->helper->route('dmzx_lightdark_controller', array(
					'hash' => generate_link_hash('close_lightdark')
				)),
			));
		}
	}

	public function ucp_prefs_get_data($event)
	{
		$this->user->add_lang_ext('dmzx/lightdark', 'common');

		$event['data'] = array_merge($event['data'], array(
			'lightdark_ucp_index_enable'	=> $this->request->variable('lightdark_ucp_index_enable', (int) $this->user->data['lightdark_status']),
		));

		if (!$event['submit'])
		{
			$this->template->assign_vars(array(
				'S_UCP_LIGHTDARK_INDEX'		=> $event['data']['lightdark_ucp_index_enable'],
				'S_LIGHTDARK_CLOSE' 		=> $this->config['lightdark_close'],
			));
		}
	}

	public function ucp_prefs_set_data($event)
	{
		$event['sql_ary'] = array_merge($event['sql_ary'], array(
			'lightdark_status' => $event['data']['lightdark_ucp_index_enable'],
		));
	}
}
