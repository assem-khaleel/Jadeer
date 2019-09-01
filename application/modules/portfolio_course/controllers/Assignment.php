<?php

/**
 * @property Layout $layout
 * @property CI_Input $input
 * @property Breadcrumbs $breadcrumbs
 * @property CI_Config $config
 * Class Assignment
 */
class Assignment extends MX_Controller
{

    private $view_params;
    private $can_manage;
    private $course_id;

    /**
     * Assignment constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->course_id = $this->input->get('id');
        if(intval($this->course_id) ==0) {
            Validator::set_error_flash_message(lang('Course not found'));
            redirect('/portfolio_course');
        }

        Orm_User::check_logged_in();
        if (!License::get_instance()->check_module('portfolio_course', true)) {
            show_404();
        }

        $this->layout->add_javascript('/assets/jadeer/js/jquery.iframe-transport.js');

        $this->breadcrumbs->push(lang('Portfolio Course'), '/portfolio_course');
        $this->breadcrumbs->push(lang('Assignment & Exams Management'), '/portfolio_course/assignment');

        $this->view_params['menu_tab'] = 'portfolio_course';

        $this->can_manage = Orm_Course::get_instance($this->course_id)->can_manage();

        $this->view_params['can_manage'] = $this->can_manage;
        $this->view_params['course_id'] = intval($this->course_id);

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Portfolio') . ' - ' . htmlfilter(Orm_Course::get_instance($this->course_id)->get_name()),
            'icon' => 'fa fa-book',
            'menu_view' => 'portfolio_course/sub_menu',
            'menu_params' => array('type' => 'assignment', 'id' => $this->input->get('id')),

        ), true);

        if( Orm_User::check_credential(array(Orm_User::USER_FACULTY,Orm_User::USER_STAFF), false, 'portfolio_course-manage')){
            if ($this->can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) {
                $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                    'link_attr' => 'href="/portfolio_course/category?type=assignment&course_id='.$this->course_id.'"',
                    'link_icon' => 'cogs',
                    'link_title' => lang('Settings')
                ), true);
            }
        }
    }

    /**
     * this function index
     * @return string the html view
     */
    public function index()
    {
        $level = $this->input->get('level');
            switch ($level){
            case "format_info":
                $this->_format_info($level);
                break;
            default:
                $this->_assignment_info('assignment_info');
        }
    }

    /**
     * this function _assignment info by its level
     * @param string $level the level of the _assignment info to be call function controller
     * @return string the call function
     */
    private function _assignment_info($level)
    {
        $this->view_params['active'] = $this->input->get('catid');
        $this->view_params['cat'] = $this->input->get('catid');
        //$this->view_params['level'] = $this->input->get('level');
        $this->view_params['course_id'] = $this->course_id;
        $this->view_params['fields']= Orm_Pc_Syllabus_Fields::get_all(['course_id'=>$this->course_id,'category_id'=>$this->input->get('catid'),'deleted'=>'0','display'=>'1']);
        $this->view_params['fieldsvalue'] = Orm_Pc_Syllabus_Fields_Value::get_all(['course_id'=>$this->course_id,'category_id'=>$this->input->get('catid'),'deleted'=>'0'],0,0);

        
        
        $this->view_params['level'] = $level;
        $this->view_params['assTypes'] = Orm_Pc_Assignment::get_types();
        $this->view_params['assignments'] = Orm_Pc_Assignment::get_all(['course_id'=>$this->course_id, 'semester_id'=>Orm_Semester::get_active_semester()->get_id()]);
        $this->layout->view('portfolio_course/assignment/assignment', $this->view_params);
    }

    /**
     * this function _format info by its level
     * @param string $level the level of the _format info to be call function controller
     * @return string the call function
     */
    private function _format_info($level)
    {
        $this->view_params['assignments'] =     Orm_Pc_Format::get_all(['course_id'=>$this->course_id, 'is_not_null'=>'assignment_format_file', 'semester_id'=>Orm_Semester::get_active_semester()->get_id()]);
        $this->view_params['homeworks'] =       Orm_Pc_Format::get_all(['course_id'=>$this->course_id, 'is_not_null'=>'homework_format_file', 'semester_id'=>Orm_Semester::get_active_semester()->get_id()]);
        $this->view_params['laboratories'] =    Orm_Pc_Format::get_all(['course_id'=>$this->course_id, 'is_not_null'=>'lab_experiment_format_file', 'semester_id'=>Orm_Semester::get_active_semester()->get_id()]);
        $this->view_params['exercises'] =       Orm_Pc_Format::get_all(['course_id'=>$this->course_id, 'is_not_null'=>'class_exercise_format_file', 'semester_id'=>Orm_Semester::get_active_semester()->get_id()]);
        $this->view_params['level'] = $level;
        $this->view_params['active'] = $level;
        $this->layout->view('portfolio_course/assignment/format', $this->view_params);
    }

    /**
     * this function addEditFormat by its level and fileType and format id
     * @param string $level the level of the addEditFormat to be viewed
     *  @param string $fileType the ileType of the addEditFormat to be viewed
     * @param int $format_id the format id of the addEditFormat to be viewed
     * @redirect success or error
     */
    public function addEditFormat($level, $fileType, $format_id = 0){
        $formatObj = Orm_Pc_Format::get_instance($format_id);

        if ($this->can_manage) {
            if ($this->input->method() === 'post') {
                $titleEN = $this->input->post('title_en');
                $titleAR = $this->input->post('title_ar');

                Validator::not_empty_field_validator('title_en', $titleEN, lang('Please enter File Title') .' ( '.lang('English').' ) ');
                Validator::not_empty_field_validator('title_ar', $titleAR,lang('Please enter File Title').' ( '.lang('Arabic').' ) ');

                $formatObj->set_course_id($this->course_id);
                $formatObj->set_file_name_en($titleEN);
                $formatObj->set_file_name_ar($titleAR);
                switch ($fileType) {
                    case "assignment":
                        $file = $this->_attach('assignment_format_file', $fileType, $level, $formatObj->get_assignment_format_file());
                        if ($file) {
                            $formatObj->set_assignment_format_file($file);
                        }
                        break;
                    case "homework":
                        $file = $this->_attach('homework_format_file', $fileType, $level, $formatObj->get_homework_format_file());
                        if ($file) {
                            $formatObj->set_homework_format_file($file);
                        }
                        break;
                    case "laboratory":
                        $file = $this->_attach('lab_experiment_format_file', $fileType, $level, $formatObj->get_lab_experiment_format_file());
                        if ($file) {
                            $formatObj->set_lab_experiment_format_file($file);
                        }
                        break;
                    case "exercise":
                        $file = $this->_attach('class_exercise_format_file', $fileType, $level, $formatObj->get_class_exercise_format_file());
                        if ($file) {
                            $formatObj->set_class_exercise_format_file($file);
                        }
                        break;
                }
                if (Validator::success()) {
                    $formatObj->save();
                    json_response(array('status' => true));
                }
            }
        } else {

            Validator::set_error_flash_message(lang('Permission Denied'));
        }

        $this->view_params['format_obj'] = $formatObj;
        $this->view_params['fileType'] = $fileType;
        $this->view_params['level'] = $level;
        $html = $this->load->view('portfolio_course/assignment/add_edit_format', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }

    }
    /**
     * this function addEditAssignment by its level and assignment id
     * @param string $level the level of the addEditAssignment to be viewed
     * @param int $assignment_id the assignment id of the addEditAssignment to be viewed
     * @redirect success or error
     */
    public function addEditAssignment($level, $assignment_id = 0)
    {
        $assignmentObj = Orm_Pc_Assignment::get_instance($assignment_id);
        if ($this->can_manage) {
            if ($this->input->method() === 'post') {
                $title_en = $this->input->post('title_en');
                $title_ar = $this->input->post('title_ar');
                $desc_en = $this->input->post('desc_en');
                $desc_ar = $this->input->post('desc_ar');
                $type = $this->input->post('type');
                $start = $this->input->post('start');
                $end = $this->input->post('end');

                Validator::required_field_validator('title_en', $title_en, lang('Please enter Title').' ( '.lang('English').' ) ');
                Validator::required_field_validator('title_ar', $title_ar, lang('Please enter Title').' ( '.lang('Arabic').' ) ');
                Validator::required_field_validator('desc_en', $desc_en, lang('Please enter Description').' ( '.lang('English').' ) ');
                Validator::required_field_validator('desc_ar', $desc_ar, lang('Please enter Description').' ( '.lang('Arabic').' ) ');
                Validator::required_field_validator('type', $type, lang('Please enter Type'));
                Validator::required_field_validator('start', $start, lang('Please enter Start Date'));
                Validator::required_field_validator('end', $end, lang('Please enter End Date'));
                Validator::database_unique_field_validator($assignmentObj, 'title_en', 'title_en', $title_en, lang('Unique Field'));
                Validator::database_unique_field_validator($assignmentObj, 'title_ar', 'title_ar', $title_ar, lang('Unique Field'));
                Validator::date_range_validator('end', $start, $end, lang('End Date should be after Start Date'));

                $assignmentObj->set_title_en($title_en);
                $assignmentObj->set_title_ar($title_ar);
                $assignmentObj->set_description_en($desc_en);
                $assignmentObj->set_description_ar($desc_ar);
                $assignmentObj->set_type($type);
                $assignmentObj->set_start_date($start);
                $assignmentObj->set_end_date($end);
                $assignmentObj->set_course_id($this->course_id);

                $file = $this->_attach('file_path', 'assignment', $level, $assignmentObj->get_file_path());
                if ($file) {
                    $assignmentObj->set_file_path($file);
                }

                if (Validator::success()) {
                    $assignmentObj->save();
                    json_response(array('status' => true));
                }
            }
        }else{
            Validator::set_success_flash_message(lang('Permission Denied'));
        }
        $this->view_params['assignment_obj'] = $assignmentObj;
        $this->view_params['level'] = $level;
        $this->view_params['assTypes'] = Orm_Pc_Assignment::get_types();
        $html = $this->load->view('portfolio_course/assignment/add_edit_assignment', $this->view_params, true);

        if ($this->input->method() == 'post') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }


    /**
     * this function deleteFormatInfo by its level
     * @param string $level the level of the deleteFormatInfo to be viewed
     * @redirect success or error
     */
    public function deleteFormatInfo($level){
        if ($this->can_manage) {
            $method = strtolower($this->input->method());
            $del = [];
            if ($method == 'post') {
                $del = $this->input->post('del');
                Validator::not_empty_field_validator('del', $del, lang('Please select Manuals'));
                if (Validator::success()) {
                    if (count($del)) {
                        $this->load->helper("file");
                        $teachingMaterials = Orm_Pc_Format::get_all(['in_id' => $del]);
                        foreach ($teachingMaterials as $teachingMaterial) {
                            $path = implode([
                                $teachingMaterial->get_assignment_format_file(),
                                $teachingMaterial->get_homework_format_file(),
                                $teachingMaterial->get_lab_experiment_format_file(),
                                $teachingMaterial->get_class_exercise_format_file()
                            ]);
                            $status = $teachingMaterial->delete();
                            if ($status)
                                unlink(rtrim(FCPATH, '/') . $path);
                        }
                    }
                }
            }
        } else {
            Validator::set_error_flash_message(lang('Permission Denied'));
        }
    }

    /**
     * this function deleteAssignment by its level and assignment id
     * @param string $level the level of the deleteAssignment to be viewed
     * @param int $assignment_id the assignment id of the deleteAssignment to be viewed
     * @redirect success or error
     */
    public function deleteAssignment($level, $assignment_id){

        if ($this->can_manage) {
            $this->load->helper("file");
            $assignment = Orm_Pc_Assignment::get_one(['id' => $assignment_id]);
            $path = $assignment->get_file_path();
            $status = $assignment->delete();
            if ($status) {
                unlink(rtrim(FCPATH, '/') . $path);
            }
        } else {
            Validator::set_error_flash_message(lang('Permission Denied'));
        }

        redirect('/portfolio_course/assignment?id='.$this->course_id.'&level='.$level);
    }

    /**
     * this function download by its id and level and fileType
     * @param int $id the id of the download to be viewed
     * @param string $level the level of the download to be viewed
     * @param string $fileType the fileType of the download to be viewed
     * @redirect file
     */

    public function download($id, $level, $fileType){
        $path='';

        if($level == 'format_info') {
            $formatObj = Orm_Pc_Format::get_one(['id' => $id]);
            switch ($fileType) {
                case "assignment":
                    $path = $formatObj->get_assignment_format_file();
                    break;
                case "homework":
                    $path = $formatObj->get_homework_format_file();
                    break;
                case "laboratory":
                    $path = $formatObj->get_lab_experiment_format_file();
                    break;
                case "exercise":
                    $path = $formatObj->get_class_exercise_format_file();
                    break;
            }
        }elseif ($level == 'assignment_info'){
            $assignment = Orm_Pc_Assignment::get_one(['id' => $id]);
            $path = $assignment->get_file_path();
        }
        $this->_download($path);
        redirect('/portfolio_course/assignment?id='.$this->course_id.'&level='.$level);
    }

    /**
     * this function _attach by its fieldName and fileType and level and  file
     * @param string $fieldName the fieldName of the _attach to be call function controller
     * @param string $fileType the fileType of the _attach to be call function controller
     * @param string $level the level of the _attach to be call function controller
     * @param string $file the file of the _attach to be call function controller
     * @return string the call function
     */
    private function _attach($fieldName, $fileType, $level, $file){

        Uploader::validator($fieldName,true, $file);

        $file_name = $fieldName.'-'.time();
        $file = Uploader::do_process($fieldName, "/files/portfolio_course/assignment/{$level}/{$fileType}/{$file_name}");

        return $file;
    }


    /**
     * this function _download by its path
     * @param string $path the path of the _download to be call function controller
     * @return string the call function
     */
    private function _download($path){
        $fullPath = rtrim(FCPATH, '/') .$path;
        $data = file_get_contents($fullPath);
        $this->load->helper('download');
        $filename = basename($fullPath);
        force_download($filename, $data);
    }



}