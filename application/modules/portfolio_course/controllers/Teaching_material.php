<?php

/**
 * @property Layout $layout
 * @property CI_Input $input
 * @property Breadcrumbs $breadcrumbs
 * @property CI_Config $config
 * Class Teaching Material
 */
class Teaching_Material extends MX_Controller
{

    private $view_params;
    private $can_manage;
    private $course_id;

    /**
     * Teaching_Material constructor.
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
        $this->breadcrumbs->push(lang('Teaching Material Management'), '/portfolio_course/teaching_material');

        $this->view_params['menu_tab'] = 'portfolio_course';

        $this->can_manage = Orm_Course::get_instance($this->course_id)->can_manage();
        $this->view_params['can_manage'] = $this->can_manage;
        $this->view_params['course_id'] = intval($this->course_id);

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Portfolio') . ' - ' . htmlfilter(Orm_Course::get_instance($this->course_id)->get_name()),
            'icon' => 'fa fa-book',
            'menu_view' => 'portfolio_course/sub_menu',
            'menu_params' => array('type' => 'teaching_material', 'id' => $this->input->get('id')),
         
        ), true);

        if(Orm_User::check_credential(array(Orm_User::USER_FACULTY,Orm_User::USER_STAFF), false, 'portfolio_course-manage')){
            if ($this->can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) {
                $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                    'link_attr' => 'href="/portfolio_course/category?type=teaching_material&course_id='.$this->course_id.'"',
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
        $this->view_params['active'] = 'teaching_material';
        $this->view_params['course_id'] = $this->course_id;
        
        $manuals = Orm_Pc_Teaching_Material::get_all(['course_id'=>$this->course_id, 'type'=>1]);
        $this->view_params['manuals'] = $manuals;
        $this->view_params['lectureNote'] = Orm_Pc_Teaching_Material::get_one(['course_id'=>$this->course_id, 'type'=>2]);
        $this->view_params['additions'] = Orm_Pc_Teaching_Material::get_one(['course_id'=>$this->course_id, 'type'=>3]);
        $this->layout->view('portfolio_course/teaching_material/teaching', $this->view_params);
    }


    /**
     * this function deleteManuals
     * @redirect success or error
     */
    public function deleteManuals(){
        if ($this->can_manage) {
            $method = strtolower($this->input->method());
            $del = [];
            if ($method == 'post') {
                $del = $this->input->post('del');
                Validator::not_empty_field_validator('del', $del, lang('Please select Manuals'));
                if (Validator::success()) {
                    if (count($del)) {
                        $this->load->helper("file");
                        $teachingMaterials = Orm_Pc_Teaching_Material::get_all(['in_id' => $del]);
                        foreach ($teachingMaterials as $teachingMaterial) {
                            $path = $teachingMaterial->get_course_manual_file();
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
//        redirect('/portfolio_course/teaching_material?id='.$this->course_id);
    }

    /**
     * this function downloadManuals by its id
     * @param int $id the id of downloadManuals to be viewed
     * @redirect file
     */
    public function downloadManuals($id){
        $manuals = orm_pc_teaching_material::get_one(['id'=>$id]);
        $fullPath = rtrim(FCPATH, '/') .$manuals->get_course_manual_file();
        $data = file_get_contents($fullPath);
        $this->load->helper('download');
        $filename = basename($fullPath);
        force_download($filename, $data);
        redirect('/portfolio_course/teaching_material?id='.$this->course_id);
    }


    /**
     * this function addEditMaterial by its type and material id
     * @param string $type the type of addEditMaterial to be function call
     * @param int $material_id the material id of addEditMaterial to be function call
     * @redirect success or error
     */
    public function addEditMaterial($type, $material_id = 0){
        $material_obj = Orm_Pc_Teaching_Material::get_instance($material_id);
        if ($this->can_manage) {
            if ($this->input->method() === 'post') {
                $titleEN = $this->input->post('title_en');
                $titleAR = $this->input->post('title_ar');
                Validator::not_empty_field_validator('title_en', $titleEN, lang('Please enter Text').' ( '.lang('English').' ) ');
                Validator::not_empty_field_validator('title_ar', $titleAR, lang('Please enter Text').' ( '.lang('Arabic').' ) ');

                $material_obj->set_course_id($this->course_id);
                $material_obj->set_type($type);

                switch ($type){
                    case 1:
                        $material_obj->set_course_manual_title_en($titleEN);
                        $material_obj->set_course_manual_title_ar($titleAR);

                        $file = $this->_attach('course_manual_file', $material_obj->get_course_manual_file());
                        if ($file) {
                            $material_obj->set_course_manual_file($file);
                        }

                        break;
                    case 2:
                        $material_obj->set_lecture_note_en($titleEN);
                        $material_obj->set_lecture_note_ar($titleAR);
                        break;
                    case 3:
                        $material_obj->set_addition_en($titleEN);
                        $material_obj->set_addition_ar($titleAR);
                        break;
                }
                if (Validator::success()) {
                    $material_obj->save();
                    json_response(array('status' => true));
                }
            }
        } else {

            Validator::set_error_flash_message(lang('Permission Denied'));
        }

        $this->view_params['material_obj'] = $material_obj;
        $this->view_params['type'] = $type;
        $html = $this->load->view('portfolio_course/teaching_material/add_edit', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }


    /**
     * this function _attach by its fieldName and file
     * @param string $fieldName the fieldName of _attach to be function call
     * @param string $file the file of _attach to be function call
     * @return null|string
     */
    private function _attach($fieldName, $file) {
        Uploader::validator($fieldName,true, $file);


        $file_name = $fieldName.'-'.time();
        $file = Uploader::do_process($fieldName, "/files/portfolio_course/teaching_material/{$file_name}");

        return $file;
    }


}