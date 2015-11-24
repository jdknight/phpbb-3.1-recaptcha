<?php
namespace secondsparrow\recaptcha\acp;

class main_module
{
	var $u_action;

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $cache, $request;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		$user->add_lang('acp/common');
		$this->tpl_name = 'recaptcha_body';
		$this->page_title = $user->lang('ACP_SECONDSPARROW_RECAPTCHA_TITLE');
		add_form_key('secondsparrow/recaptcha');

		if ($request->is_set_post('submit'))
		{
			if (!check_form_key('secondsparrow/recaptcha'))
			{
				trigger_error('FORM_INVALID');
			}

			$config->set('secondsparrow_recaptcha_site_key',   $request->variable('secondsparrow_recaptcha_site_key', ""));
			$config->set('secondsparrow_recaptcha_secret_key', $request->variable('secondsparrow_recaptcha_secret_key', ""));

			trigger_error($user->lang('ACP_SECONDSPARROW_RECAPTCHA_SETTING_SAVED') . adm_back_link($this->u_action));
		}

		$template->assign_vars(array(
			'U_ACTION'                             => $this->u_action,
			'S_SECONDSPARROW_RECAPTCHA_SITE_KEY'   => $config['secondsparrow_recaptcha_site_key'],
			'S_SECONDSPARROW_RECAPTCHA_SECRET_KEY' => $config['secondsparrow_recaptcha_secret_key'],
		));
	}
}
