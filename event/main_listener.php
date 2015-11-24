<?php
namespace secondsparrow\recaptcha\event;

require(__DIR__.'/../vendor/recaptcha-1.1.2/src/autoload.php');

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class main_listener implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'               => 'load_language_on_setup',
			'core.ucp_register_data_before' => 'on_data_register_before',
			'core.ucp_register_data_after'  => 'on_data_register_after',
		);
	}

	protected $config;
	protected $helper;
	protected $request;
	protected $template;
	protected $user;

	public function __construct(
	        \phpbb\config\config $config,
	        \phpbb\controller\helper $helper,
	        \phpbb\request\request $request,
	        \phpbb\template\template $template,
	        \phpbb\user $user)
	{
		$this->config = $config;
		$this->helper = $helper;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
	}

	public function load_language_on_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'secondsparrow/recaptcha',
			'lang_set' => 'common',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	public function on_data_register_before($event)
	{
		$this->template->assign_vars(array(
			'S_SECONDSPARROW_RECAPTCHA_SITE_KEY' =>
			    $this->config['secondsparrow_recaptcha_site_key'],
		));

		$event['data'] = array_merge($event['data'], array(
			'g-recaptcha-response' =>
			    $this->request->variable('g-recaptcha-response', ''),
		));
	}

	public function on_data_register_after($event)
	{
		if ($event['submit'])
		{
		    if (empty($event['data']['g-recaptcha-response']))
		    {
    			$array = $event['error'];
    			$array[] = $this->user->lang['RECAPTCHA_FAILED'];
    			$event['error'] = $array;
		    }
		    else
		    {
		        $secretKey = $this->config['secondsparrow_recaptcha_secret_key'];
		        $recaptcha = new \ReCaptcha\ReCaptcha($secretKey);
		        $recaptchaResponse = $recaptcha->verify(
		            $event['data']['g-recaptcha-response'],
		            $this->request->server('REMOTE_ADDR', ''));
                if ($recaptchaResponse->isSuccess() == false)
                {
        			$array = $event['error'];
    			    $array[] = $this->user->lang['RECAPTCHA_FAILED'];
        			$event['error'] = $array;
                }
		    }
		}
	}
}
