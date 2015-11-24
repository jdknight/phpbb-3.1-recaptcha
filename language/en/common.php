<?php
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'ACP_SECONDSPARROW_RECAPTCHA_TITLE'                       => 'reCAPTCHA Module',
	'ACP_SECONDSPARROW_RECAPTCHA'                             => 'Settings',
	'ACP_SECONDSPARROW_RECAPTCHA_SITE_KEY'                    => 'reCAPTCHA Site Key:',
	'ACP_SECONDSPARROW_RECAPTCHA_SECRET_KEY'                  => 'reCAPTCHA Secret Key:',
	'ACP_SECONDSPARROW_RECAPTCHA_OPEN_GOOGLE_RECAPTCHA_ADMIN' => 'open Google reCAPTCHA admin',
	'ACP_SECONDSPARROW_RECAPTCHA_SETTING_SAVED'               => 'Settings have been saved successfully!',
	'RECAPTCHA_FAILED'                                        => 'reCAPTCHA check has failed.',
));
