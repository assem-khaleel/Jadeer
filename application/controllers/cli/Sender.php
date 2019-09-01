<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 9/11/17
 * Time: 12:09 PM
 */

class Sender extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if(!is_cli())
        {
            exit('No direct script access allowed');
        }
    }

    public function mail() {

        $directory = FCPATH . 'files/jobs/email/';
        $files = scandir($directory);
        foreach ($files as $file) {

            $json_file = $directory . $file;
            if (file_exists($json_file)) {

                $content = file_get_contents($json_file);
                $emails = json_decode($content, true);
                foreach ($emails as $email) {
                    if (!empty($email['sender_name']) && !empty($email['sender_email']) && !empty($email['receiver_name']) && !empty($email['receiver_email']) && !empty($email['subject']) && !empty($email['body'])) {
                        $this->send_email($email['sender_name'],$email['sender_email'],$email['receiver_name'],$email['receiver_email'], $email['subject'], $email['body']);
                    }
                }

                unlink($json_file);
            }
        }

    }

    public function sms() {

        $directory = FCPATH . 'files/jobs/sms/';

        $files = scandir($directory);
        foreach ($files as $file) {

            $json_file = $directory . $file;
            if (file_exists($json_file)) {

                $content = file_get_contents($json_file);
                $smss = json_decode($content, true);
                foreach ($smss as $sms) {
                    if (!empty($sms['receiver_phone']) && !empty($sms['message'])) {
                        $this->send_sms($sms['receiver_phone'], $sms['message']);
                    }
                }

                unlink($json_file);
            }
        }

    }

    private function send_email($sender_name, $sender_email, $receiver_name, $receiver_email, $subject, $body) {

        $this->load->library('email');
        $this->email->clear(TRUE);

        $config = array();
        $config['mailtype'] = 'html';

        if($this->config->item('smtp_enabled')) {
            $config['protocol'] = 'smtp';
            $config['smtp_host'] = $this->config->item('smtp_host');            // Specify main and backup SMTP servers
            $config['smtp_user'] = $this->config->item('smtp_username');        // SMTP username
            $config['smtp_pass'] = $this->config->item('smtp_password');        // SMTP password
            $config['smtp_port'] = $this->config->item('smtp_port');            // TCP port to connect to
        }

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->set_crlf( "\r\n" );
        $this->email->to($receiver_email);

        if($this->config->item('smtp_enabled')) {
            $this->email->from($config['smtp_user'], $sender_name);
        } else {
            $this->email->from($sender_email, $sender_name);
        }

        $this->email->subject($subject);
        $this->email->message($body);
        $this->email->send();
    }

    private function send_sms($receiver_phone, $message) {

        $gateway = Orm::get_ci()->config->item('sms_gateway');
        $number = trim($receiver_phone);
        $message = trim($message);

        if (($gateway != '') && ($number != '') && ($message != '')) {
            //IMPORTANT
            $number = htmlentities(urlencode($number));
            $message = htmlentities(urlencode($message));
            //IMPORTANT

            $gateway_placeholders = array(
                '%NUMBER%',
                '%MESSAGE%'
            );

            $gateway_placeholders_replacement = array(
                $number,
                $message
            );

            $url = str_replace($gateway_placeholders, $gateway_placeholders_replacement, $gateway);

            //echo $url;
            @file_get_contents($url);
        }
    }
}