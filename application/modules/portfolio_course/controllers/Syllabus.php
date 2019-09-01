<?php

/**
 * @property Layout $layout
 * @property CI_Input $input
 * @property Breadcrumbs $breadcrumbs
 * @property CI_Config $config
 * Class Syllabus
 */
class Syllabus extends MX_Controller
{

    private $view_params;
    private $can_manage;
    private $course_id;

    /**
     * Syllabus constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->course_id = $this->input->get('id');
        if(intval($this->course_id) == 0) {
            Validator::set_error_flash_message(lang('Course not found'));
            redirect('/portfolio_course');
        }

        Orm_User::check_logged_in();
        if (!License::get_instance()->check_module('portfolio_course', true)) {
            show_404();
        }

        $this->breadcrumbs->push(lang('Portfolio Course'), '/portfolio_course');
        $this->breadcrumbs->push(lang('Syllabus Management'), '/portfolio_course/syllabus');

        $this->view_params['menu_tab'] = 'portfolio_course';
        $this->can_manage = Orm_Course::get_instance($this->course_id)->can_manage();
        $this->view_params['can_manage'] = $this->can_manage;
        $this->view_params['course_id'] = intval($this->course_id);

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Portfolio') . ' - ' . htmlfilter(Orm_Course::get_instance($this->course_id)->get_name()),
            'icon' => 'fa fa-book',
            'menu_view' => 'portfolio_course/sub_menu',
            'menu_params' => array('type' => 'syllabus', 'id' => $this->input->get('id')),
        ), true);

        if( Orm_User::check_credential(array(Orm_User::USER_FACULTY,Orm_User::USER_STAFF), false, 'portfolio_course-manage')){
            if ($this->can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) {
                $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                    'link_attr' => 'href="/portfolio_course/category?type=syllabus&course_id='.$this->course_id.'"',
                    'link_icon' => 'cogs',
                    'link_title' => lang('Category Settings')
                ), true);
            }
        }

    }

    /**
     *this function index
     * @return string the html view
     */
    public function index()
    {
        $level = $this->input->get('level');
            switch ($level){
            case "instructor_info":
                $this->_instructor_info($level);
                break;
            case "required_material":
                $this->_required_material($level);
                break;
            case "course_desc":
                $this->_course_desc($level);
                break;
            case "course_calender":
                $this->_course_calender($level);
                break;
            case "course_policies":
                $this->_course_policies($level);
                break;
            case "available_support":
                $this->_available_support($level);
                break;
            default:
                $this->_catalog_info($this->course_id);
                break;
        }
    }

    /**
     * this function _catalog_info by its level
     * @param string $level the level of _catalog_info to be function call
     * @return null|string
     */
    private function _catalog_info($level)
    {
        $sections = Orm_Course_Section::get_all(['course_id'=>$this->course_id, 'semester_id'=>Orm_Semester::get_active_semester()->get_id()]);
        $course = Orm_Course::get_instance($this->course_id);

        $this->view_params['level'] = $level;
        $this->view_params['active'] = 'catalog_info';
        $this->view_params['course'] = $course;
        $this->view_params['sections'] = $sections;
        $this->view_params['course_id'] = $this->course_id;
        $this->layout->view('portfolio_course/syllabus/catalog', $this->view_params);
    }

    /**
     * this function _instructor_info by its level
     * @param string $level the level of _instructor_info to be function call
     * @return null|string
     */
    private function _instructor_info($level)
    {
        $faculty = Orm_Course_Section_Teacher::get_all(['course_id'=>$this->course_id, 'semester_id' => Orm_Semester::get_active_semester()->get_id()]);
        $faculty_members=[];

        foreach ($faculty as $vsl)
        {
            $faculty_members[$vsl->get_user_id()] = $vsl;
        }

        $this->view_params['faculty'] = $faculty_members;
        $this->view_params['active'] = $level;
        $this->view_params['course_id'] = $this->course_id;
        $this->view_params['level'] = $level;
        $this->layout->view('portfolio_course/syllabus/instructor', $this->view_params);

    }

    /**
     * this function _required_material by its level
     * @param string $level the level of _required_material to be function call
     * @return null|string
     */
    private function _required_material($level)
    {

        $this->view_params['materialTypes'] = Orm_Pc_Material::get_types();
        $this->view_params['level'] = $level;
        $this->view_params['active'] = $level;
        $this->view_params['course_id'] = $this->course_id;
        $this->layout->view('portfolio_course/syllabus/required_material', $this->view_params);

    }

    /**
     * this function _course_desc by its level
     * @param string $level the level of _course_desc to be function call
     * @return null|string
     */
    private function _course_desc($level)
    {
        if (License::get_instance()->check_module('curriculum_mapping') && Modules::load('curriculum_mapping')) {
            $clo = Orm_Cm_Course_Learning_Outcome::get_all(['course_id'=>$this->course_id]);
            $assessment_method = Orm_Cm_Course_Assessment_Method::get_all(['course_id'=>$this->course_id]);

            $this->view_params['active'] = $level;
            $this->view_params['level'] = $level;
            $this->view_params['assessment_method'] = $assessment_method;
            $this->view_params['clo'] = $clo;
            $this->view_params['course_id'] = $this->course_id;
            $this->layout->view('portfolio_course/syllabus/course_desc', $this->view_params);
        } else {
            $this->_catalog_info($level);
        }
    }


    /**
     * this function _course_calender by its level
     * @param string $level the level of _course_calender to be function call
     * @return null|string
     */
    private function _course_calender($level)
    {
        $this->view_params['active'] = $level;
        $this->view_params['level'] = $level;
        $this->view_params['course_id'] = $this->course_id;
        $this->layout->view('portfolio_course/syllabus/course_calender', $this->view_params);
    }

    /**
     * this function _course_policies by its level
     * @param string $level the level of _course_policies to be function call
     * @return null|string
     */
    private function _course_policies($level)
    {
        $this->view_params['active'] = $level;
        $this->view_params['level'] = $level;
        $this->view_params['course_id'] = $this->course_id;
        $this->view_params['policy'] = Orm_Pc_Course_Policies::get_one(['course_id'=>$this->course_id]);
        $this->layout->view('portfolio_course/syllabus/course_policies', $this->view_params);

    }

    /**
     * this function _available_support by its level
     * @param string $level the level of _available_support to be function call
     * @return null|string
     */
    private function _available_support($level)
    {
        $this->view_params['course_id'] = $this->course_id;
        $this->view_params['active'] = $level;
        $this->view_params['level'] = $level;

        $this->layout->view('portfolio_course/syllabus/available_support', $this->view_params);
    }


    /**
     * this function edit by its level and id
     * @param int $level the level of the edit to be viewed
     * @param int $id the id of the edit to be viewed
     * @redirect success or error
     */
    public function edit($level, $id = 0){

        switch ($level){
            case "instructor_info":
                $this->_edit_instructor_info($level, $id);
                break;
            case "required_material":
                $this->_edit_required_material($level, $id);
                break;
            case "course_calender":
                $this->_edit_course_calender_topic($level, $id);
                break;
            case "course_policies":
                $this->_edit_course_policies($level, $id);
                break;
            case "available_support":
                $this->_edit_available_support($level, $id);
                break;
        }
    }

    /**
     * this function _edit_instructor_info by its level
     * @param string $level the level of edit instructor info to be function call
     * @redirect success or error
     */
    private function _edit_instructor_info($level, $id) {
        $instructor_obj = Orm_Pc_Instructor_Information::get_instance($id);
        $section = intval($this->input->get('section'));
        $faculty = intval($this->input->get('faculty'));
        if ($section && $faculty && $this->can_manage) {
            if ($this->input->method() === 'post') {

                $location = $this->input->post('location');
                $hours    = $this->input->post('hours');

                $instructor_obj->set_office_hours($hours);
                $instructor_obj->set_office_location($location);
                $instructor_obj->set_faculty_id($faculty);
                $instructor_obj->set_section_id($section);


                $instructor_obj->save();
                json_response(array('status' => true));
            }
        } else {
            Validator::set_error_flash_message(lang('Permission Denied'));
        }
        $this->view_params['instructor_obj'] = $instructor_obj;
        $this->view_params['level'] = $level;
        $this->view_params['section'] = $section;
        $this->view_params['faculty'] = $faculty;
        $html = $this->load->view('portfolio_course/syllabus/add_edit_instructor', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }

    }


    /**
     * this function _edit_required_material by its level and id
     * @param string $level the level of _edit_required_material to be function call
     * @param string $id the id of _edit_required_material to be function call
     * @redirect success or error
     */
    private function _edit_required_material($level, $id) {
        $material_obj = Orm_Pc_Material::get_instance($id);
        if ($this->can_manage) {
            if ($this->input->method() === 'post') {

                $title_en       = $this->input->post('title_en');
                $title_ar       = $this->input->post('title_ar');
                $description_en = $this->input->post('description_en');
                $description_ar = $this->input->post('description_ar');
                $materialType   = $this->input->post('material_type');
                $author         = $this->input->post('author');
                $releaseDate    = $this->input->post('release_date');
                $edition        = $this->input->post('edition');
                $publisher      = $this->input->post('publisher');
                $place          = $this->input->post('place');

                Validator::not_empty_field_validator('title_en', $title_en, lang('Please enter Text').' ( '.lang('English').' ) ');
                Validator::not_empty_field_validator('title_ar', $title_ar, lang('Please enter Text').' ( '.lang('Arabic').' ) ');
                Validator::not_empty_field_validator('material_type', $materialType, lang('Please Select Material Type'));

                if (Validator::success()) {
                    $material_obj->set_title_en($title_en);
                    $material_obj->set_title_ar($title_ar);
                    $material_obj->set_description_en($description_en);
                    $material_obj->set_description_ar($description_ar);
                    $material_obj->set_material_type($materialType);
                    $material_obj->set_author($author);
                    $material_obj->set_release_date($releaseDate);
                    $material_obj->set_edition($edition);
                    $material_obj->set_publisher($publisher);
                    $material_obj->set_material_location($place);
                    $material_obj->set_course_id($this->course_id);
                    $material_obj->set_semester_id(Orm_Semester::get_current_semester()->get_id());

                    $material_obj->save();
                    json_response(array('status' => true));
                }
            }
        } else {
            Validator::set_error_flash_message(lang('Permission Denied'));
        }

        $this->view_params['material_obj'] = $material_obj;
        $this->view_params['level'] = $level;
        $this->view_params['materialTypes'] = Orm_Pc_Material::get_types();
        $html = $this->load->view('portfolio_course/syllabus/add_edit_required_material', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    /**
     * this function _edit_course_calender_topic by its level and id
     * @param string $level the level of _edit course calender topic to be function call
     * @param string $id the id of _edit course calender topic to be function call
     * @redirect success or error
     */
    private function _edit_course_calender_topic($level, $id) {
        $calender_obj = Orm_Pc_Topic::get_instance($id);
        if ($this->can_manage) {
            if ($this->input->method() === 'post') {
                $title_en       = $this->input->post('title_en');
                $title_ar       = $this->input->post('title_ar');
                $description_en = $this->input->post('desc_en');
                $description_ar = $this->input->post('desc_ar');
                $start          = $this->input->post('start');
                $end            = $this->input->post('end');

                Validator::not_empty_field_validator('title_en', $title_en, lang('Please enter Title').' ( '.lang('English').' ) ');
                Validator::not_empty_field_validator('title_ar', $title_ar, lang('Please enter Title').' ( '.lang('Arabic').' ) ');

                if (Validator::success()) {
                    Validator::date_format_validator('start', $start, lang('Please enter start Date'));
                    Validator::date_format_validator('end', $end, lang('Please enter end Date'));

                    if (Validator::success()) {
                        Validator::date_range_validator('end', $start, $end, lang('End Date should be after Start Date'));
                    }
                    elseif($start=='' && $end==''){
                        Validator::clear();
                    }
                }

                if (Validator::success()) {
                    $calender_obj->set_title_en($title_en);
                    $calender_obj->set_title_ar($title_ar);
                    $calender_obj->set_description_en($description_en);
                    $calender_obj->set_description_ar($description_ar);
                    $calender_obj->set_start_date($start);
                    $calender_obj->set_end_date($end);
                    $calender_obj->set_course_id($this->course_id);
                    $calender_obj->set_semester_id(Orm_Semester::get_current_semester()->get_id());
                    $calender_obj->save();
                    json_response(array('status' => true));
                }
            }
        } else {
            Validator::set_error_flash_message(lang('Permission Denied'));
        }

        $this->view_params['calender_obj'] = $calender_obj;
        $this->view_params['level'] = $level;
        $html = $this->load->view('portfolio_course/syllabus/add_edit_course_calender', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }


    /**
     * this function _edit_course_policies by its level and id
     * @param string $level the level of _edit course policies to be function call
     * @param string $id the id of _edit course policies to be function call
     * @redirect success or error
     */
    private function _edit_course_policies($level, $id){
        $policies_obj = Orm_Pc_Course_Policies::get_instance($id);
        $dataType = $this->input->get('dataType');
        if ($dataType && $this->can_manage) {
            if ($this->input->method() === 'post') {
                $title_en = $this->input->post('title_en');
                $title_ar = $this->input->post('title_ar');
//                Validator::not_empty_field_validator('title_en', $title_en, lang('Please enter Text').' '.lang('English'));
//                Validator::not_empty_field_validator('title_ar', $title_ar, lang('Please enter Text').' '.lang('Arabic'));
                $policies_obj->set_course_id($this->course_id);
                $policies_obj->set_semester_id(Orm_Semester::get_current_semester()->get_id());
                switch ($dataType) {
                    case "Grading":
                        $policies_obj->set_grading_en($title_en);
                        $policies_obj->set_grading_ar($title_ar);
                        break;
                    case "Attendance":
                        $policies_obj->set_attendance_en($title_en);
                        $policies_obj->set_attendance_ar($title_ar);
                        break;
                    case "Lateness":
                        $policies_obj->set_lateness_en($title_en);
                        $policies_obj->set_lateness_ar($title_ar);
                        break;
                    case "participation":
                        $policies_obj->set_class_participation_en($title_en);
                        $policies_obj->set_class_participation_ar($title_ar);
                        break;
                    case "MissedExam":
                        $policies_obj->set_missed_exam_en($title_en);
                        $policies_obj->set_missed_exam_ar($title_ar);
                        break;
                    case "MissedAssignment":
                        $policies_obj->set_missed_assignment_en($title_en);
                        $policies_obj->set_missed_assignment_ar($title_ar);
                        break;
                    case "dishonesty":
                        $policies_obj->set_academic_dishonesty_en($title_en);
                        $policies_obj->set_academic_dishonesty_ar($title_ar);
                        break;
                    case "plagiarism":
                        $policies_obj->set_academic_plagiarism_en($title_en);
                        $policies_obj->set_academic_plagiarism_ar($title_ar);
                        break;
                }

                if (Validator::success()) {
                    $policies_obj->save();
                    json_response(array('status' => true));
                }
            }
        } else {
            Validator::set_error_flash_message(lang('Permission Denied'));
        }

        $this->view_params['policies_obj'] = $policies_obj;
        $this->view_params['level'] = $level;
        $this->view_params['dataType'] = $dataType;
        $html = $this->load->view('portfolio_course/syllabus/add_edit_course_policies', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }

    }


    /**
     * this function _edit_available_support by its level and id
     * @param string $level the level of _edit available support to be function call
     * @param string $id the id of _edit available support to be function call
     * @redirect success or error
     */
    private function _edit_available_support($level, $id) {
        $support_obj = Orm_Pc_Support_Service::get_instance($id);

        if ($this->can_manage) {
            if ($this->input->method() === 'post') {
                $title_en = $this->input->post('title_en');
                $title_ar = $this->input->post('title_ar');
                Validator::not_empty_field_validator('title_en', $title_en, lang('Available Support service').' ('.lang('English').')');
                Validator::not_empty_field_validator('title_ar', $title_ar, lang('Available Support service').' ('.lang('Arabic').')');
                $support_obj->set_available_support_service_en($title_en);
                $support_obj->set_available_support_service_ar($title_ar);
                $support_obj->set_course_id($this->course_id);
                $support_obj->set_semester_id(Orm_Semester::get_current_semester()->get_id());
                if (Validator::success()) {
                    $support_obj->save();
                    json_response(array('status' => true));
                }
            }
        } else {
            Validator::set_error_flash_message(lang('Permission Denied'));
        }

        $this->view_params['support_obj'] = $support_obj;
        $this->view_params['level'] = $level;
        $html = $this->load->view('portfolio_course/syllabus/add_edit_available_support', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }

    /**
     * this function delete by its level and id
     * @param string $level the level of the delete to be viewed
     * @param int $id the support id of the delete to be viewed
     * @redirect success or error
     */
    public function delete($level = '', $id = 0){
        if ($this->can_manage) {
            if($level != '' && $id) {
                switch ($level) {
                    case "required_material":
                        $deleteObj = Orm_Pc_Material::get_one(['id' => $id]);
                        break;
                    case "course_calender":
                        $deleteObj = Orm_Pc_Topic::get_one(['id' => $id]);
                        break;
                    case "available_support":
                        $deleteObj = Orm_Pc_Support_Service::get_one(['id' => $id]);
                        break;
                    default:
                        redirect('/portfolio_course/syllabus?id=' . $this->course_id . '&level=' . $level);
                        break;
                }
                if (isset($virtual_deleteObj))
                {   $virtual_deleteObj->set_deleted('1');
                    $virtual_deleteObj->save();
                }
                if (isset($deleteObj))
                    $deleteObj->delete();
            } else {
                Validator::set_error_flash_message(lang('Illegal Inputs'));
            }
        } else {
            Validator::set_error_flash_message(lang('Permission Denied'));
        }

        redirect('/portfolio_course/syllabus?id='.$this->course_id.'&level='.$level);
    }
    /**
     * this function _attach by its fieldName
     * @param string $fieldName the fieldName of _attach to be function call
     * @return null|string
     */
    private function _attach($fieldName){
        $this->load->library('Uploader');
        Uploader::common_validator($fieldName, $fieldName);
        Uploader::zero_size_validator($fieldName, $fieldName, lang('File not found.'));
        Uploader::max_size_validator($fieldName, $fieldName, $this->config->item('upload_max_size'), lang('File exceeds maximum allowed size.'));
        Uploader::mime_type_validator($fieldName, $fieldName, $this->config->item('upload_allow'), lang('File type not allowed.'));

        $file = Uploader::get_file_name($fieldName, '/files/portfolio_course/student_work/', false);

        $full_path = rtrim(FCPATH, '/') . $file;
        Uploader::move_file_to($fieldName, $full_path);
        return $file;
    }
    
}