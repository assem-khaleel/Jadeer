<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of report
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * @author ADwairi
 * @author Hamzah
 * @author Laith
 */
class Report extends MX_Controller
{
    private $view_params = array();

    //TODO please implement backend for this

    public function __construct()
    {
        parent::__construct();

        if (!License::get_instance()->check_module('examination', true)) {
            show_404();
        }

        Orm_User::check_logged_in();
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-list');
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-report');


        $this->breadcrumbs->push(lang('Examination'), '/examination');

        $this->view_params['menu_tab'] = 'examination';
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Report'),
            'icon' => 'fa fa-file-text-o',
            'menu_view' => 'examination/sub_menu',
            'menu_params' => array('type' => 'report')
        ), true);

    }

    /** draw report for exam depending on type of exam
     * render it in reports/dashboard view
    */
    public function show($exam_id=0) {

        $exam = Orm_Tst_Exam::get_instance($exam_id);

        if(!($exam && $exam->get_id()) || !($exam->get_total_question_marks() == $exam->get_fullmark() && $exam->get_fullmark())){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect($this->config->item('root_url'));

        }

        switch ($exam->get_type()) {
            case Orm_Tst_Exam::TYPE_QUIZ:
                $this->breadcrumbs->push(lang('Quiz'), '/examination/quiz');
                break;
            case Orm_Tst_Exam::TYPE_ASSIGNMENT:
                $this->breadcrumbs->push(lang('Assignment'), '/examination/assignments');
                break;
        }

        $this->view_params['exam_id'] = $exam_id;

        $this->breadcrumbs->push(lang('Report'), '/examination/report/'.$exam_id);

        $this->layout->add_javascript('/assets/jadeer/js/chart.bundle.min.js');
        $this->layout->view('reports/dashboard', $this->view_params);
    }

}
