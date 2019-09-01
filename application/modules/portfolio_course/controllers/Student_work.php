<?php

/**
 * @property Layout $layout
 * @property CI_Input $input
 * @property Breadcrumbs $breadcrumbs
 * @property CI_Config $config
 * Class Student Work
 */
class Student_Work extends MX_Controller
{

    private $view_params;
    private $can_manage;
    private $course_id;

    /**
     * Student_Work constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->course_id = $this->input->get('id');
        if(intval($this->course_id) ==0) {
            Validator::set_error_flash_message(lang('Course not found'));
            redirect('/portfolio_course');
        }
        
        $this->can_manage = Orm_Course::get_instance($this->course_id)->can_manage();
        $this->view_params['can_manage'] = $this->can_manage;
        $this->view_params['course_id'] = intval($this->course_id);

        Orm_User::check_logged_in();
        if (!License::get_instance()->check_module('portfolio_course', true)) {
            show_404();
        }
    
        $this->layout->add_javascript('/assets/jadeer/js/jquery.iframe-transport.js');
        $this->breadcrumbs->push(lang('Portfolio Course'), '/portfolio_course');
        $this->breadcrumbs->push(lang('Student Work Management'), '/portfolio_course/student_work');

        $this->view_params['menu_tab'] = 'portfolio_course';
        $this->view_params['active'] = 'student_work';
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Portfolio') . ' - ' . htmlfilter(Orm_Course::get_instance($this->course_id)->get_name()),
            'icon' => 'fa fa-book',
            'menu_view' => 'portfolio_course/sub_menu',
            'menu_params' => array('type' => 'student_work', 'id' => $this->input->get('id')),
          
        ), true);

        if( Orm_User::check_credential(array(Orm_User::USER_FACULTY,Orm_User::USER_STAFF), false, 'portfolio_course-manage')){
            if ($this->can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) {
                $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                    'link_attr' => 'href="/portfolio_course/category?type=student_work&course_id='.$this->course_id.'"',
                    'link_icon' => 'cogs',
                    'link_title' => lang('Settings')
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
        $this->view_params['level'] = $this->course_id;
        $this->view_params['course_id'] = $this->course_id;
        $projects = Orm_Pc_Student_Work::get_all(['course_id'=>$this->course_id, 'type'=>1]);
        $this->view_params['projects'] = $projects;
        $this->view_params['guideline'] = Orm_Pc_Student_Work::get_one(['course_id'=>$this->course_id, 'type'=>2]);

        $this->layout->view('portfolio_course/student_work/student_work', $this->view_params);
    }


    /**
     * this function deleteProjects
     * @redirect success or error
     */
    public function deleteProjects(){

        if ($this->can_manage) {
            $method = strtolower($this->input->method());
            $del = [];
            if ($method == 'post') {
                $del = $this->input->post('del');
                Validator::not_empty_field_validator('del', $del, lang('Please select Projects'));
                if (Validator::success()) {
                    if (count($del)) {
                        $this->load->helper("file");
                        $projects = Orm_Pc_Student_Work::get_all(['in_id' => $del]);
                        foreach ($projects as $project) {
                            $path = $project->get_student_project_file();
                            $status = $project->delete();
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
     * this function addEditWork by its type and id
     * @param int $type the type of the addEditWork to be viewed
     * @param int $work_id the work id of the addEditWork to be viewed
     * @redirect success or error
     */
    public function addEditWork($type, $work_id = 0){
        $work_obj = Orm_Pc_Student_Work::get_instance($work_id);
        if ($this->can_manage) {
            if ($this->input->method() === 'post') {
                $titleEN = $this->input->post('title_en');
                $titleAR = $this->input->post('title_ar');

                Validator::not_empty_field_validator('title_en', $titleEN, lang('Please enter Text').' ( '.lang('English').' ) ');
                Validator::not_empty_field_validator('title_ar', $titleAR, lang('Please enter Text').' ( '.lang('Arabic').' ) ');

                $work_obj->set_course_id($this->course_id);
                $work_obj->set_type($type);

                switch ($type){
                    case 1:
                        $work_obj->set_title_en($titleEN);
                        $work_obj->set_title_ar($titleAR);
                        $file = $this->_attach('student_project_file', $work_obj->get_student_project_file());
                        if ($file) {
                            $work_obj->set_student_project_file($file);
                        }
                        break;
                    case 2:
                        $work_obj->set_grading_guideline_en($titleEN);
                        $work_obj->set_grading_guideline_ar($titleAR);
                        break;
                }
                if (Validator::success()) {
                    $work_obj->save();
                    json_response(array('status' => true));
                }
            }
        } else {

            Validator::set_error_flash_message(lang('Permission Denied'));
        }

        $this->view_params['work_obj'] = $work_obj;
        $this->view_params['type'] = $type;
        $html = $this->load->view('portfolio_course/student_work/add_edit', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }


    /**
     * this function downloadProjects by its id to be viewed
     * @param int $id the id of the downloadProjects to be viewed
     * @return string the download Projects view
     */
    public function downloadProjects($id){
        $projects = Orm_Pc_Student_Work::get_one(['id'=>$id]);
        $fullPath = rtrim(FCPATH, '/') .$projects->get_student_project_file();
        $data = file_get_contents($fullPath);
        $this->load->helper('download');
        $filename = basename($fullPath);
        force_download($filename, $data);
        redirect('/portfolio_course/student_work?id='.$this->course_id);
    }

    /**
     * this function _attach by its fieldName and file
     * @param string $fieldName the fieldName of the _attach to be viewed
     * @param string $file the file of the _attach to be viewed
     * @return string the call function
     */
    private function _attach($fieldName, $file){

        Uploader::validator($fieldName,true, $file);

        $file_name = $fieldName.'-'.time();
        $file = Uploader::do_process($fieldName, "/files/portfolio_course/student_work/{$file_name}");

        return $file;
    }


}