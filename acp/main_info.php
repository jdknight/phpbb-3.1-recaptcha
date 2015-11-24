<?php
namespace secondsparrow\recaptcha\acp;

class main_info
{
	function module()
	{
		return array(
			'filename'	=> '\secondsparrow\recaptcha\acp\main_module',
			'title'		=> 'ACP_SECONDSPARROW_RECAPTCHA_TITLE',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'settings'	=> array('title' => 'ACP_SECONDSPARROW_RECAPTCHA', 'auth' => 'ext_secondsparrow/recaptcha && acl_a_board', 'cat' => array('ACP_SECONDSPARROW_RECAPTCHA_TITLE')),
			),
		);
	}
}
