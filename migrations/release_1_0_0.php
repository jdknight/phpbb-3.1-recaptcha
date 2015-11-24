<?php
namespace secondsparrow\recaptcha\migrations;

class release_1_0_0 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['secondsparrow_recaptcha_site_key']);
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v310\alpha2');
	}

	public function update_data()
	{
		return array(
			array('config.add', array('secondsparrow_recaptcha_site_key', "")),
			array('config.add', array('secondsparrow_recaptcha_secret_key', "")),

			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_SECONDSPARROW_RECAPTCHA_TITLE'
			)),
			array('module.add', array(
				'acp',
				'ACP_SECONDSPARROW_RECAPTCHA_TITLE',
				array(
					'module_basename'	=> '\secondsparrow\recaptcha\acp\main_module',
					'modes'				=> array('settings'),
				),
			)),
		);
	}
}
