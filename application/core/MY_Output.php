<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Output extends CI_Output {

    /**
     * Display Output
     *
     * All "view" data is automatically put into this variable by the controller class:
     *
     * $this->final_output
     *
     * This function sends the finalized output data to the browser along
     * with any server headers and profile data.  It also stops the
     * benchmark timer so the page rendering speed and memory usage can be shown.
     *
     * @access	public
     * @param 	string
     * @return	mixed
     */
    function _display($output = '') {

        $CI =& get_instance();

        if (!$CI->config->item('cache-output')) {
            $CI->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s', time()).' GMT');
            $CI->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            $CI->output->set_header("Cache-Control: post-check=0, pre-check=0", FALSE);
            $CI->output->set_header("Pragma: no-cache");
        }

        parent::_display($output);
    }
}

/* End of file MY_Output.php */
/* Location: ./application/core/MY_Output.php */