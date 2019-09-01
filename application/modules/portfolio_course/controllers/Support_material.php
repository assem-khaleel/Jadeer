<?php

/**
 * @property Layout $layout
 * @property CI_Input $input
 * @property Breadcrumbs $breadcrumbs
 * @property CI_Config $config
 * Class Support Material
 */
class Support_Material extends MX_Controller
{

    private $view_params;
    private $can_manage;
    private $course_id;

    /**
     * Support_Material constructor.
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
        $this->breadcrumbs->push(lang('Support Material Management'), '/portfolio_course/support_material');

        $this->view_params['menu_tab'] = 'portfolio_course';

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Portfolio') . ' - ' . htmlfilter(Orm_Course::get_instance($this->course_id)->get_name()),
            'icon' => 'fa fa-book',
            'menu_view' => 'portfolio_course/sub_menu',
            'menu_params' => array('type' => 'support_material', 'id' => $this->input->get('id')),
        ), true);

        if( Orm_User::check_credential(array(Orm_User::USER_FACULTY,Orm_User::USER_STAFF), false, 'portfolio_course-manage')){
            if ($this->can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) {
                $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                    'link_attr' => 'href="/portfolio_course/category?type=support_material&course_id='.$this->course_id.'"',
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
        $this->view_params['active'] = 'support_material';
        $this->view_params['course_id'] = $this->course_id;
        
        $this->view_params['constructions'] = Orm_Pc_Support_Material::get_all(['course_id'=>$this->course_id, 'is_not_null'=>'construction_technique_file', 'semester_id'=>Orm_Semester::get_current_semester()->get_id()]);
        $this->view_params['equipments'] = Orm_Pc_Support_Material::get_all(['course_id'=>$this->course_id, 'is_not_null'=>'equipment_documentation_file', 'semester_id'=>Orm_Semester::get_current_semester()->get_id()]);
        $this->view_params['computerDocumentations'] = Orm_Pc_Support_Material::get_all(['course_id'=>$this->course_id, 'is_not_null'=>'computer_documentation_file', 'semester_id'=>Orm_Semester::get_current_semester()->get_id()]);
        $this->view_params['troubleshootingTips'] = Orm_Pc_Support_Material::get_all(['course_id'=>$this->course_id, 'is_not_null'=>'troubleshooting_tip_file', 'semester_id'=>Orm_Semester::get_current_semester()->get_id()]);
        $this->view_params['debuggingTips'] = Orm_Pc_Support_Material::get_all(['course_id'=>$this->course_id, 'is_not_null'=>'debugging_tip_file', 'semester_id'=>Orm_Semester::get_current_semester()->get_id()]);
        $this->view_params['addition'] = Orm_Pc_Support_Material::get_one(['course_id'=>$this->course_id, 'type'=>2, 'semester_id'=>Orm_Semester::get_current_semester()->get_id()]);
        $this->layout->view('portfolio_course/support_material/support', $this->view_params);
    }


    /**
     * this function delete
     * @redirect success or error
     */
    public function delete(){
        if ($this->can_manage) {
            $method = strtolower($this->input->method());
            if ($method == 'post') {
                $del = $this->input->post('del');
                Validator::not_empty_field_validator('del', $del, lang('Please select Manuals'));
                if (Validator::success()) {
                    if (count($del)) {
                        $this->load->helper("file");
                        $teachingMaterials = Orm_Pc_Support_Material::get_all(['in_id' => $del]);
                        foreach ($teachingMaterials as $teachingMaterial) {
                            $path = implode([
                                $teachingMaterial->get_computer_documentation_file(),
                                $teachingMaterial->get_construction_technique_file(),
                                $teachingMaterial->get_equipment_documentation_file(),
                                $teachingMaterial->get_troubleshooting_tip_file(),
                                $teachingMaterial->get_debugging_tip_file()
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
     * this function addEditAttachment by its fileType and support id
     * @param int $fileType the fileType of the addEditAttachment to be viewed
     * @param int $support_id the work support id of the addEditAttachment to be viewed
     * @redirect success or error
     */
    public function addEditAttachment($fileType, $support_id = 0){
        $support_obj = Orm_Pc_Support_Material::get_instance($support_id);

        if ($this->can_manage) {
            if ($this->input->method() === 'post') {
                $titleEN = $this->input->post('title_en');
                $titleAR = $this->input->post('title_ar');
                Validator::not_empty_field_validator('title_en', $titleEN, lang('Please enter File Title') .' ( '.lang('English').' ) ');
                Validator::not_empty_field_validator('title_ar', $titleAR, lang('Please enter File Title').' ( '.lang('Arabic').' ) ');

                $support_obj->set_course_id($this->course_id);
                $support_obj->set_file_name_en($titleEN);
                $support_obj->set_file_name_ar($titleAR);
                $support_obj->set_type(1);
                $support_obj->set_semester_id(Orm_Semester::get_current_semester()->get_id());
                switch ($fileType) {
                    case "construction":
                        $file = $this->_attach('construction_technique_file', $fileType, $support_obj->get_construction_technique_file());
                        if ($file) {
                            $support_obj->set_construction_technique_file($file);
                        }
                        break;
                    case "equipment":
                        $file = $this->_attach('equipment_documentation_file', $fileType, $support_obj->get_equipment_documentation_file());
                        if ($file) {
                            $support_obj->set_equipment_documentation_file($file);
                        }
                        break;
                    case "computerDocumentation":
                        $file = $this->_attach('computer_documentation_file', $fileType, $support_obj->get_computer_documentation_file());
                        if ($file) {
                            $support_obj->set_computer_documentation_file($file);
                        }
                        break;
                    case "troubleshootingTip":
                        $file = $this->_attach('troubleshooting_tip_file', $fileType, $support_obj->get_troubleshooting_tip_file());
                        if ($file) {
                            $support_obj->set_troubleshooting_tip_file($file);
                        }
                        break;
                    case "debugging":
                        $file = $this->_attach('debugging_tip_file', $fileType, $support_obj->get_debugging_tip_file());
                        if ($file) {
                            $support_obj->set_debugging_tip_file($file);
                        }
                        break;
                }

                if (Validator::success()) {
                    $support_obj->save();
                    json_response(array('status' => true));
                }
            }
        } else {
            Validator::set_error_flash_message(lang('Permission Denied'));
        }

        $this->view_params['support_obj'] = $support_obj;
        $this->view_params['fileType'] = $fileType;
        $html = $this->load->view('portfolio_course/support_material/add_edit_attachment', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }

    }


    /**
     * this function addEditAddition by its support id
     * @param int $support_id the support id of the addEditAddition to be viewed
     * @redirect success or error
     */
    public function addEditAddition($support_id = 0){
        $support_obj = Orm_Pc_Support_Material::get_instance($support_id);
        if ($this->can_manage) {
            if ($this->input->method() === 'post') {

                $addtionEN = $this->input->post('addition_en');
                $addtionAR = $this->input->post('addition_ar');
//                Validator::not_empty_field_validator('addition_en', $addtionEN, lang('Please enter Additions and Revisions').' '.lang('English'));
//                Validator::not_empty_field_validator('addition_ar', $addtionAR, lang('Please enter Additions and Revisions').' '.lang('Arabic'));

                $support_obj->set_course_id($this->course_id);
                $support_obj->set_addition_en($addtionEN);
                $support_obj->set_addition_ar($addtionAR);
                $support_obj->set_type(2);
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
        $html = $this->load->view('portfolio_course/support_material/add_edit_addition', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }


    /**
     * this function download by its id and fileType
     * @param int $id the id of the download to be viewed
     * @param int $fileType the fileType of the download to be viewed
     * @return string the call function
     */
    public function download($id, $fileType){
        $supportMaterialsObj = Orm_Pc_Support_Material::get_one(['id'=>$id]);
        $path='';
        switch ($fileType){
            case "construction":
                $path = $supportMaterialsObj->get_construction_technique_file();
                break;
            case "equipment":
                $path = $supportMaterialsObj->get_equipment_documentation_file();
                break;
            case "computerDocumentation":
                $path = $supportMaterialsObj->get_computer_documentation_file();
                break;
            case "troubleshootingTip":
                $path = $supportMaterialsObj->get_troubleshooting_tip_file();
                break;
            case "debugging":
                $path = $supportMaterialsObj->get_debugging_tip_file();
                break;
        }
        $this->_download($path);
        redirect('/portfolio_course/support_material?id='.$this->course_id);
    }


    /**
     * this function _attach by its fieldName and fileType and exist file
     * @param string $fieldName the fieldName of _attach to be function call
     * @param string $fileType the fileType of _attach to be function call
     * @param string $exist_file the exist file of _attach to be function call
     * @return null|string
     */
    private function _attach($fieldName, $fileType, $exist_file){

        Uploader::validator($fieldName,true, $exist_file);

        $file_name = $fieldName.'-'.time();
        $file = Uploader::do_process($fieldName, "/files/portfolio_course/support_material/{$fileType}/{$file_name}");

        return $file;
    }


    /**
     * this function _download by its path to be viewed
     * @param int $path the path of the _download to be viewed
     * @return string the download Projects view
     */
    private function _download($path){
        $fullPath = rtrim(FCPATH, '/') .$path;
        $data = file_get_contents($fullPath);
        $this->load->helper('download');
        $filename = basename($fullPath);
        force_download($filename, $data);
    }

}