<?php 

/**
 * Logging Access Site Class
 *
 * @category	Logging
 */
class LogAccessSite
{
	
	private $_ci;

	protected $log_path = "";
	protected $date_fmt = 'Y-m-d H:i:s';
	protected $enabled	= TRUE;


	public function __construct()
	{
		$this->_ci = & get_instance();

		$this->log_path = APPPATH . "logs/access/";

		if ( ! is_dir($this->log_path) OR ! is_really_writable($this->log_path))
		{
			$this->enabled = FALSE;
		}
	}

	public function logAcess()
	{
		if ($this->enabled === FALSE)
		{
			return FALSE;
		}

		$filepath = $this->log_path . 'log-'.date('Y-m-d').'.txt';
		
		$message  = '';

		if ( ! file_exists($filepath))
		{
			$message .= "DATE|USER_ID|IP_ADDRESS|USER_AGENT|LINK|CLASS_METHOD\n";
		}

		if ( ! $fp = @fopen($filepath, FOPEN_WRITE_CREATE))
		{
			return FALSE;
		}

		$this->_ci->load->library('session');

		$message .= date($this->date_fmt) . "|";
		$message .= ($this->_ci->session->userdata('user_id') != "" ? $this->_ci->session->userdata('user_id') : "0") . "|";
		$message .= $_SERVER['REMOTE_ADDR'] . "|";
		$message .= $this->_ci->input->user_agent() . "|";
		$message .= $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . "|";
		$message .= $this->_ci->router->class . "::" . $this->_ci->router->method . "\n";


		flock($fp, LOCK_EX);
		fwrite($fp, $message);
		flock($fp, LOCK_UN);
		fclose($fp);

		@chmod($filepath, FILE_WRITE_MODE);
		return TRUE;
	}
}