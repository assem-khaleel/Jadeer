<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 6/30/15
 * Time: 12:05 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * @property CI_DB_query_builder $db
 * Class Respond
 */
class Respond extends MX_Controller
{

    private $view_params = array();
    private $evaluator_obj = null;
    /** @var Orm_Survey_Evaluation */
    private $evaluation_obj = null;
    /** @var Orm_Survey */
    private $survey_obj = null;
    /** @var Orm_User */
    private $user_obj = null;

    /**
     * Respond constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if(!License::get_instance()->check_module('survey', true)) {
            show_404();
        }

        $token = $this->input->get_post('token');
        $this->evaluator_obj = Orm_Survey_Evaluator::get_one(array('hash_code' => $token));

        if (!$this->evaluator_obj->get_id()) {
            $this->reject(lang('Your Link is inactive'));
        }

        $this->user_obj = $this->evaluator_obj->get_user_obj();
        $this->evaluation_obj = $this->evaluator_obj->get_survey_evaluation_obj();
        $this->survey_obj = $this->evaluation_obj->get_survey_obj();

        if (!($this->evaluation_obj->get_id() && $this->survey_obj->get_id() && $this->user_obj->get_id())) {
            $this->reject(lang('Your Link is inactive'));
        }

        if ($this->evaluator_obj->get_response_status()) {
            $this->reject(lang('You have already answered this survey.'));
        }

        $this->view_params['evaluator'] = $this->evaluator_obj;
        $this->view_params['evaluation'] = $this->evaluation_obj;
        $this->view_params['survey'] = $this->survey_obj;
        $this->view_params['user'] = $this->user_obj;

        $this->view_params['menu_tab'] = 'survey';

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Survey'),
            'icon' => 'fa fa-check-square'
        ), true);
    }

    /**
     * this function reject by its message
     * @param string $message the message of the reject to be call function
     * @return string the call function
     */
    private function reject($message)
    {
        Validator::set_error_flash_message($message);
        if (Orm_User::is_logged_in()) {
            redirect($this->input->server('HTTP_REFERER'));
        } else {
            redirect($this->config->item('root_url'));
        }
    }

    /**
     *this function index
     * @return string the html view
     */
    public function index()
    {

        $token = $this->input->get('token');

        $evaluator = Orm_Survey_Evaluator::get_one(['hash_code' => $token]);

        if(!(!$evaluator->get_response_status() && $evaluator->get_survey_evaluation_obj()->is_published())){
            Validator::set_error_flash_message(lang('Survey not Published'));
            redirect('/');
        }

        $this->layout->view('survey/respond/index', $this->view_params);
    }

    /**
     * this function save
     * @redirect success or error
     */
    public function save()
    {

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        $validator = true;
        $this->db->trans_begin();
        foreach ($this->survey_obj->get_pages() as $page) {
            /** @var $page Orm_Survey_Page */
            foreach ($page->get_questions() as $question) {
                $status = $question->save_user_response($this->evaluator_obj->get_id());

                if ($status == false) {
                    $validator = false;
                }
            }
        }

        if ($validator === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }

        if ($validator) {
            $this->evaluator_obj->set_response_status(1);
            $this->evaluator_obj->set_response_date(date('Y-m-d H:i:s'));
            $this->evaluator_obj->save(false);
        } else {
            $this->evaluator_obj->delete_response();
        }

        json_response(array('success' => $validator));
    }
}