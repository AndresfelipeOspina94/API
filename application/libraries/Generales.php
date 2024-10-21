<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generales {

    var $html;

    /**
     * Constructor
     *
     * @access	public
     * @param	array	initialization parameters
     */
    function Generales($params = array())
    {
        $this->CI =& get_instance();
        $this->CI->load->helper('url');
        $this->CI->load->library('session');
        $this->CI->config->item('base_url');
        $this->CI->load->library('email');
    }

	// --------------------------------------------------------------------
	/**
	 * Set html
	 * @param	array
	 * @access	public
	 * @return	bool
	 */
	public function email2ClienteCuestionario($datos = NULL, $html)
	{
    // print_r($datos->cliente['emailprincipal']);
    //-------------
    $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_port' => 465,
        'smtp_user' => 'cesarosorio.ie@gmail.com',
        'smtp_pass' => 'Ac1dl0v3',
        'mailtype'  => 'html',
        'charset'   => 'iso-8859-1'
    );
    $this->CI->load->library('email', $config);

    $this->CI->email->from('cesarosorio.ie@gmail.com', 'Btraining');
    $this->CI->email->to($datos->cliente['emailprincipal']);
    // $this->CI->email->cc('another@another-example.com');
    // $this->CI->email->bcc('them@their-example.com');

    $this->CI->email->subject('Email Test');
    $this->CI->email->message($html);
    $this->CI->email->set_newline("\r\n");
    if ($this->CI->email->send()) {
        echo 'Your email was sent, thanks chamil.';
    } else {
        show_error($this->CI->email->print_debugger());
    }
    // return TRUE;
    // print_r($html);
	}
}

/* End of file Html2pdf.php */
