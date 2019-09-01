<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 08/11/17
 * Time: 11:53
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Assigned extends MX_Controller
{
    private $view_params = array();

    /**
     * Assigned constructor.
     */
    public function __construct() {
        parent::__construct();

        if(!License::get_instance()->check_module('rubrics', true)) {
            show_404();
        }

        Orm_User::check_logged_in();

       // Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY, Orm_User::USER_STUDENT], false, 'rubrics-list');

        $this->breadcrumbs->push(lang('Rubrics'), '/rubrics');


        $this->view_params['menu_tab'] = 'rubrics';
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Rubrics'),
            'icon' => 'fa fa-file'
        ), true);
    }

    /**
     *this function index
     * @return string the html view
     * default controller action
     */
    public function index() {

        $vars = [
            'title'     => lang('Assigned To Me'),
            'icon'      => 'fa fa-file',
            'menu_view' => 'rubrics/sub_menu',
            'list'      => 'assigned'
        ];


        $this->view_params['page_header'] = $this->load->view('/common/page_header', $vars, true);

        $this->breadcrumbs->push(lang('Assigned To Me'), '/rubrics/assigned');


        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_per_page($this->config->item('per_page'));
        $pager->set_page((int)$this->input->get_post('page')?: 1);
        $pager->set_total_count(Orm_Rb_Rubrics::get_count(['less_start_date'=>time(), 'greater_end_date'=>time()]));

        $this->view_params['pager'] = $pager->render(true);

        $this->view_params['rubrics'] = array_filter(Orm_Rb_Rubrics::get_all(['less_start_date'=>time(), 'greater_end_date'=>time()]),
            function ($rubric) {
                /** @var Orm_Rb_Rubrics $rubric */

                return $rubric->check_invitation();
        });

        $this->layout->view('assigned_list', $this->view_params);
    }
    /**
     * this function answer by its rubric id
     * @param int $rubric_id the rubric id of the answer to be viewed
     * @redirect success or error
     */
    public function answer($rubric_id){

        $rubric = Orm_Rb_Rubrics::get_instance($rubric_id);

        $vars = [
            'title'     => lang('Assigned To Me'),
            'icon'      => 'fa fa-file'
        ];

        $this->view_params['page_header'] = $this->load->view('/common/page_header', $vars, true);

        $this->breadcrumbs->push(lang('Assigned To Me'), '/rubrics/assigned');

        $user_id = $this->input->get_post('user_id');

        if (!$rubric->get_id()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect(base_url('/'));
        }

        if (!$rubric->check_invitation()) {
            Validator::set_error_flash_message(lang('Permissions Denied'));
            redirect(base_url('/'));
        }

        if($rubric->get_rubric_class()==Orm_Rb_Rubrics_User::class) {
            $user_id = $rubric->get_extra_data();
        }
        elseif($rubric->get_rubric_class()==Orm_Rb_Rubrics_Service::class) {
            $user_id = 0;
        }

        $this->breadcrumbs->push(lang('Preview'), '/rubrics/assigned/answer/'.$rubric_id);

        $this->view_params['rubric'] = $rubric;


        if($this->input->server('REQUEST_METHOD')=='POST') {

            $answers = (array) $this->input->post('answer');

            $skills = Orm_Rb_Skills::get_all(['rubrics_id'=>$rubric_id]);


            $answers = array_filter($answers, function($scale_id) use($rubric_id){
                $scale = Orm_Rb_Scale::get_instance($scale_id);

                if($scale->get_id() && $scale->get_rubrics_id()==$rubric_id){
                    return true;
                }

                return false;
            });

            if(Orm_Rb_Skills::get_count(['rubrics_id'=>$rubric_id])!=count($answers)) {
                foreach($skills as $skill) {
                    if(!array_key_exists($skill->get_id(), $answers)){
                        Validator::set_error('skill_'.$skill->get_id(), lang('You miss answer this skill'));
                    }
                }
            }

            if(Validator::success()){

                foreach ($skills as $skill) {
                    $result = Orm_Rb_Result::get_one([
                        'rubric_id' => $rubric_id,
                        'user_id'   => $user_id,
                        'evaluator' => Orm_User::get_logged_user_id(),
                        'skill_id'  => $skill->get_id()
                    ]);

                    switch ($rubric->get_rubric_class()) {
                        case 'Orm_Rb_Rubrics_Course':
                            if (!$user_id) {
                                Validator::set_error_flash_message(lang('Please Select a Student!'));
                                redirect(base_url('/rubrics/assigned/answer/' . $rubric->get_id()));
                            }
                            break;
                        }

                    $result->set_rubric_id($rubric_id);
                    $result->set_evaluator(Orm_User::get_logged_user_id());
                    $result->set_user_id($user_id);
                    $result->set_semester_id(Orm_Semester::get_active_semester_id());
                    $result->set_skill_id($skill->get_id());
                    $result->set_scale_id($answers[$skill->get_id()]);
                    $result->save();
                }

                Validator::set_success_flash_message(lang('Answer Saved Successfully'));
            }
        }

        if(!isset($answers)){
            $answers=[];
            foreach (Orm_Rb_Result::get_all(['rubric_id'=>$rubric_id, 'user_id'=>$user_id, 'evaluator'=>Orm_User::get_logged_user_id()]) as $result){
                $answers[$result->get_skill_id()] = $result->get_scale_id();
            }
        }

        $this->view_params['answers'] = $answers;

        $this->layout->view('answer', $this->view_params);

    }
    /**
     * this function get students by its section id
     * @param int $section_id the section id of the get students to be viewed
     * @return string the html view
     */
    public function get_students($section_id=0) {

        $section = Orm_Course_Section::get_instance($section_id);

        $user_select='<option value="">'.lang('Select Student').'</option>';

        foreach($section->get_students() as $student) {
            $user_select .= "<option value='{$student->get_user_id()}'>{$student->get_user_obj()->get_full_name()}</option>\n";
        }

        echo  $user_select;
    }

}