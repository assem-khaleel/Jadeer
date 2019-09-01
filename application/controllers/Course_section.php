<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Layout $layout
 * @property Breadcrumbs $breadcrumbs
 * @property CI_Input $input
 * @property CI_Config $config
 * @property Orm_Course $course
 * Class Course_Section
 */
class Course_Section extends MX_Controller
{

    /**
     * View Params
     * @var array
     */
    private $view_params = array();
    private $course = NULL;

    public function __construct()
    {
        parent::__construct();

        Orm_User::check_logged_in();
    }

    public function init() {

        $course_id = (int)$this->input->get_post('course_id');

        $this->course = Orm_Course::get_instance($course_id);

        if (!$this->course->get_id()) {
            Validator::set_error_flash_message(lang('Error: Please try again'));
            redirect('/course');
        }

        $this->view_params['sub_menu'] = 'settings/sub_menu';
        $this->view_params['sub_tab'] = 'course';
        $this->view_params['menu_tab'] = 'settings';

        $this->breadcrumbs->push(lang('Settings'), '/settings');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Course Section'),
            'icon' => 'fa fa-flask'
        ), true);

        $this->view_params['course'] = $this->course;
    }

    private function get_list(){
        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array('course_id' => $this->course->get_id());
        if (!empty($fltr['semester_id'])) {
            $filters['semester_id'] = (int)$fltr['semester_id'];
        }
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $sections = Orm_Course_Section::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Course_Section::get_count($filters));
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['sections'] = $sections;
        $this->view_params['fltr'] = $fltr;

    }
    public function index()
    {

        $this->init();

        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'settings-course_section');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Course Section'),
            'icon' => 'fa fa-flask',
            'link_attr' => 'href="/course_section/create?course_id= '.$this->course->get_id().'"',
            'link_icon' => 'plus',
            'link_title' =>  lang('Create').' '.lang('Course Section')
        ), true);

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Courses'), '/course');
        $this->breadcrumbs->push(htmlfilter($this->course->get_name()) , '/course_section?course_id=' . $this->course->get_id());
        
        $this->get_list();
        $this->layout->view('/course_section/list', $this->view_params);
    }

    public function filter($course_id){

        $this->init();

        if ($this->input->is_ajax_request()) {
            $this->get_list();
            $this->load->view('/course_section/data_table?course_id='.$course_id, $this->view_params);
        } else {
            $this->index();
        }
    }

    public function create()
    {
        $this->init();

        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'settings-course_section');

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Courses'), '/course');
        $this->breadcrumbs->push(htmlfilter($this->course->get_name()) , '/course_section?course_id=' . $this->course->get_id());
        $this->breadcrumbs->push(lang('Create').' '.lang('Section'), '/course_section/create');

        $this->view_params['section'] = new Orm_Course_Section();
        $this->layout->view('/course_section/create_edit', $this->view_params);
    }

    public function save()
    {
        $this->init();

        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'settings-course_section');

        $id = $this->input->post('id');
        $section_no = $this->input->post('section_no');
        $teacher_ids = $this->input->post('teacher_ids');
        $semester_id = $this->input->post('semester_id');
        $campus_id = $this->input->post('campus_id');

        $section_obj = Orm_Course_Section::get_instance($id);
        $section_obj->set_course_id($this->course->get_id());
        $section_obj->set_semester_id($semester_id);
        $section_obj->set_campus_id($campus_id);
        $section_obj->set_section_no($section_no);

        Validator::required_field_validator('section_no', $section_no, lang('Please Enter Section No.'));
        Validator::not_empty_field_validator('semester_id', $semester_id,  lang('Please Select Semester'));
        Validator::not_empty_field_validator('campus_id', $campus_id,  lang('Please Select Campus'));
        Validator::required_array_validator('teacher_ids', $teacher_ids,  lang('Please Select at lest one Teacher'));

        if($teacher_ids) {
            foreach ($teacher_ids as $key => $teacher_id) {
                Validator::not_empty_field_validator('teacher_id', $teacher_id,  lang('Please Select Teacher'), $key);
            }
        }

        if (Validator::success()) {
            $section_obj->save();

            foreach ($teacher_ids as $teacher_id) {
                $section_teacher = Orm_Course_Section_Teacher::get_one(array('section_id' => $section_obj->get_id(), 'user_id' => $teacher_id));
                $section_teacher->set_section_id($section_obj->get_id());
                $section_teacher->set_user_id($teacher_id);
                $section_teacher->save();
            }

            foreach (array_diff($section_obj->get_teacher_ids(), $teacher_ids) as $teacher_id) {
                $delete_section_teacher = Orm_Course_Section_Teacher::get_one(array('section_id' => $section_obj->get_id(), 'user_id' => $teacher_id));
                $delete_section_teacher->delete();
            }

            Validator::set_success_flash_message(lang('Successfully Saved'));
            redirect('/course_section?course_id=' . $this->course->get_id());
        }

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Courses'), '/course');
        $this->breadcrumbs->push(htmlfilter($this->course->get_name()) , '/course_section?course_id=' . $this->course->get_id());
        $this->breadcrumbs->push(lang('Create').' '.lang('Section'), '/course_section/create');

        $this->view_params['section'] = $section_obj;
        $this->view_params['teacher_ids'] = $teacher_ids;
        $this->layout->view('/course_section/create_edit', $this->view_params);
    }

    public function edit($id)
    {
        $this->init();

        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'settings-course_section');

        $section = Orm_Course_Section::get_instance($id);

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Courses'), '/course');
        $this->breadcrumbs->push(htmlfilter($this->course->get_name()) , '/course_section?course_id=' . $this->course->get_id());
        $this->breadcrumbs->push(lang('Edit').' '.lang('Section'), '/section/edit/' . $id);

        $this->view_params['section'] = $section;
        $this->view_params['teacher_ids'] = $section->get_teacher_ids();
        $this->layout->view('/course_section/create_edit', $this->view_params);
    }

    /**
     * @param $id
     */
    public function manage($id)
    {
        $this->init();

        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'settings-course_section');
        if( License::get_instance()->check_module('room_management',true) && Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'room_management-list')== true){
            Modules::load('room_management');
        }

        $section = Orm_Course_Section::get_instance($id);

        if($this->input->method() == 'post') {

            $extra_params = $this->input->post('extra_params');
            $room_id = $this->input->post('room_id');

            if(!is_array($extra_params)) {
                $extra_params = array();
            }

            foreach ($extra_params as $param_name => $param) {
                if($param_name == 'schedule') {
                    foreach ($param as $day => $date){
                        Validator::required_field_validator($day.'_from', $date['from'], lang('Required Field'));
                        Validator::required_field_validator($day.'_to', $date['to'], lang('Required Field'));

                        Validator::date_range_validator($day.'_to', $date['from'], $date['to'], lang('To date greater than from date'));
                    }
                }
            }

            $section->set_extra_params($extra_params);
            $section->set_room_id($room_id);

            if(Validator::success()) {
                $section->save();

                Validator::set_success_flash_message(lang('Successfully Saved'));
                redirect('/course_section?course_id=' . $this->course->get_id());
            }

        }

        $this->view_params['section'] = $section;
        $this->layout->view('/course_section/manage', $this->view_params);
    }
    public function get_room_by_type(){
        if(!License::get_instance()->check_module('room_management',true) && Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'room_management-list')== true){
            redirect('/');
        }

        Modules::load('room_management');

        $type = intval($this->input->get('type'));

        $list = Orm_Rm_Room_Management::get_all(['room_type'=>$type]);

        if(!$this->input->is_ajax_request()) {
            return $list;
        }
        $options = '<option value="">' . lang('All Room') . '</option>';
        if ($list) {
            foreach ($list as $option) {
                $num =$option->get_room_number();
                $col_name =$option->get_college_obj()->get_name();
                $options .= '<option value="' . $option->get_id() . '">' . htmlfilter($option->get_name()) . '</option>';
            }
        }
        $html = '';
            $html .= $options;
        json_response(array('status' => true,'html' =>$html));
    }
    public function get_room_info(){
        if(!License::get_instance()->check_module('room_management',true) && Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'room_management-list')== true){
            redirect('/');
        }

        Modules::load('room_management');

        $room_id = intval($this->input->get('room_id'));

        $list = Orm_Rm_Room_Management::get_instance($room_id);

                $num =$list->get_room_number();
                $col_name =$list->get_college_obj()->get_name();

        json_response(array('status' => true,'col_name' =>$col_name,'num' =>$num));
    }

    public function delete($id)
    {
        $this->init();

        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'settings-course_section');

        $obj = Orm_Course_Section::get_instance($id);

        if ($obj->get_id()) {
            $obj->delete();
        }

        Validator::set_success_flash_message(lang('Successfully Deleted'), true);
        redirect('/course_section');
    }

    public function students($id) {

        $this->init();

        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'settings-course_section');


        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Course Section'),
            'icon' => 'fa fa-flask',
            'link_attr' => 'href="/course_section/add_student/'.$id.'?course_id='.$this->course->get_id().'" data-toggle="ajaxModal"',
            'link_icon' => 'plus',
            'link_title' => lang('Add').' '.lang('Student')
        ), true);

        $section_obj = Orm_Course_Section::get_instance($id);

        if(!$section_obj->get_id()) {
            redirect('/course_section');
        }
        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array(
            'section_id' => $id
        );

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $students = Orm_Course_Section_Student::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Course_Section_Student::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['students'] = $students;
        $this->view_params['fltr'] = $fltr;
        $this->view_params['section'] = $section_obj;

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Courses'), '/course');
        $this->breadcrumbs->push(htmlfilter($this->course->get_name()) , '/course_section?course_id=' . $this->course->get_id());

        $this->layout->view('/course_section/students', $this->view_params);
    }


    public function add_student($id) {

        $this->init();

        $section_obj = Orm_Course_Section::get_instance($id);

        if(!$section_obj->get_id()) {
            exit('<script>location.href="/course_section";</script>');
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $user_id = (int)$this->input->post('user_id');

            Validator::not_empty_field_validator('user_id', $user_id, lang('Invalid Student'));

            if(Validator::success()) {
                $student_obj = Orm_Course_Section_Student::get_one(array('user_id' => $user_id, 'section_id' => $id));
                $student_obj->set_user_id($user_id);
                $student_obj->set_section_id($id);
                $student_obj->save();

                json_response(array('status' => true));

            }
        }

        $this->view_params['section'] = $section_obj;

        $html = $this->load->view('/course_section/add_student', $this->view_params, true);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    public function student_delete($student_id) {

        $this->init();

        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'settings-course_section');

        $obj = Orm_Course_Section_Student::get_instance($student_id);

        $section_id = $obj->get_section_id();

        if ($obj->get_id()) {
            $obj->delete();
        }

        Validator::set_success_flash_message(lang('Successfully Deleted'), true);
        redirect("/course_section/students/{$section_id}?course_id={$this->course->get_id()}");

    }

    public function get_sections($by = 'course')
    {

        if(!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/');
        }

        switch ($by) {
            case 'course':
                $course_id = intval($this->input->post('course_id'));
                $semester_id = intval($this->input->post('semester_id')) ?: Orm_Semester::get_active_semester_id();
                $list = Orm_Course_Section::get_all(array('course_id' => $course_id, 'semester_id' => $semester_id));
                break;

            default:
                $list = array();
                break;
        }

        $options = '<option value="">' . lang('All Section') . '</option>';
        if ($list) {
            foreach ($list as $option) {
                $options .= '<option value="' . $option->get_id() . '">' . htmlfilter($option->get_name()) . '</option>';
            }
        }

        $html = '';
        if (boolval($this->input->post('option_only'))) {
            $html .= $options;
        } else {

            $html .= '<div class="form-group">';
            $html .= '<label class="control-label">' . lang('Section') . '</label>';
            $html .= "<select name='section_id' class='form-control'>";
            $html .= $options;
            $html .= '</select>';
            $html .= '</div>';

        }

        exit($html);
    }
}
