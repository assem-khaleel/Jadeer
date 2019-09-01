<?php

/**
 * @property Layout $layout
 * @property CI_Input $input
 * @property Breadcrumbs $breadcrumbs
 * @property CI_Config $config
 * Class Forms
 */
class Forms extends MX_Controller
{

    private $view_params;
    private $can_manage;
    private $course_id;

    /**
     * Forms constructor.
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

        $custom_menus = Orm_Pc_Category::get_all(['course_id'=>$this->course_id,'deleted'=>'0','level'=>$this->input->get('level')]);

        $this->view_params['custom_menus'] = $custom_menus;
        
        $this->can_manage = Orm_Course::get_instance($this->course_id)->can_manage();
        $this->view_params['can_manage'] = $this->can_manage;
        $this->view_params['course_id'] = intval($this->course_id);

        $this->layout->add_javascript('/assets/jadeer/js/jquery.iframe-transport.js');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Portfolio') . ' - ' . htmlfilter(Orm_Course::get_instance($this->course_id)->get_name()),
            'icon' => 'fa fa-book',
            'menu_view' => 'portfolio_course/sub_menu',
            'menu_params' => array('type' => $this->input->get('level'), 'id' => $this->input->get('id')),
        ), true);

        if( Orm_User::check_credential(array(Orm_User::USER_FACULTY,Orm_User::USER_STAFF), false, 'portfolio_course-manage')){
            if ($this->can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) {
                $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                    'link_attr' => 'href="/portfolio_course/category?type='.$this->input->get('level').'&course_id='.$this->course_id.'"',
                    'link_icon' => 'cogs',
                    'link_title' => lang('Settings')
                ), true);
            }
        }

        $this->breadcrumbs->push(lang('Portfolio Course'), '/portfolio_course');
        $this->breadcrumbs->push($this->input->get('level').' '.lang('Management'), '/portfolio_course/'.$this->input->get('level'));
    }

    /**
     *this function index
     * @return string the html view
     */
    public function index()
    {
        $this->_custom_menu($this->course_id);
    }

    /**
     * this function _custom_menu
     * @return string the call function
     */
    private function _custom_menu()
    {
        $this->view_params['active'] = $this->input->get('catid');
        $this->view_params['cat'] = $this->input->get('catid');
        $this->view_params['level'] = $this->input->get('level');
        $this->view_params['course_id'] = $this->course_id;
        $this->view_params['fields']= Orm_Pc_Syllabus_Fields::get_all(['course_id'=>$this->course_id,'category_id'=>$this->input->get('catid'),'deleted'=>'0','display'=>'1']);
        $this->view_params['fieldsvalue'] = Orm_Pc_Syllabus_Fields_Value::get_all(['course_id'=>$this->course_id,'category_id'=>$this->input->get('catid'),'deleted'=>'0'],0,0);
        $this->layout->view('portfolio_course/forms/custom_category', $this->view_params);
    }
    /**
     * this function edit by its level and id
     * @param int $level the level of the edit to be viewed
     * @param int $id the id of the edit to be viewed
     * @redirect success or error
     */
    public function edit($level, $id = 0){
          
                $this->_add_custom_menu($level, $id);
    }
    /**
     * this function_add_custom_menu by its level and id
     * @param string $level the level of the add custom menu to be call function controller
     * @param int $id the id of the _assignment add custom menu to be call function controller
     * @redirect success or error
     */
    private function _add_custom_menu($level, $id) {

            $syllabus_field_obj = Orm_Pc_Syllabus_Fields_Value::get_instance($id);
        if ($this->can_manage) {
            if ($this->input->method() == 'post') {

                $category_id = $this->input->get('cat');
                $course_id = $this->input->get('id');
                $fields_value = $this->input->post();
                $create_date = date('Y-m-d H:i:s');
                $update_date = date('Y-m-d H:i:s');
                $created_by=Orm_User::get_logged_user()->get_id();
                $updated_by='';

                $fields=Orm_Pc_Syllabus_Fields::get_all(['course_id'=>$this->course_id,'category_id'=>$this->input->get('cat'),'required'=>'1','deleted'=>'0'],0,0);

                foreach ($fields as $key => $value) {
                    if(isset($fields_value['field'.$value->get_id()]))
                    Validator::not_empty_field_validator('field'.$value->get_id(), $fields_value['field'.$value->get_id()], lang('Please enter').' '.$value->get_title());
                    
                    elseif(isset($_FILES['field'.$value->get_id()]) && !isset(unserialize($syllabus_field_obj->get_value())['field'.$value->get_id()]))
                    Validator::not_empty_field_validator('field'.$value->get_id(), $_FILES['field'.$value->get_id()]['name'], lang('Please enter').' '.$value->get_title());
                    elseif(!isset(unserialize($syllabus_field_obj->get_value())['field'.$value->get_id()]))               
                    Validator::set_error ('field'.$value->get_id(), lang('Please enter').' '.$value->get_title());
                    elseif($value->get_field_type()!='file' && !isset($fields_value['field'.$value->get_id()]))
                    Validator::set_error ('field'.$value->get_id(), lang('Please enter').' '.$value->get_title());
                    
                    
                }
  
                if(isset($_FILES) && !empty($_FILES)) {
                    foreach ($_FILES as $key => $value) {
                        if (isset($value['name']) && !empty($value['name'])) {
                            $file = $this->_attach($key);
                            $fields_value[$key] = $file;
                        } elseif (isset(unserialize($syllabus_field_obj->get_value())[$key])) {
                            $fields_value[$key] = unserialize($syllabus_field_obj->get_value())[$key];
                        }
                    }
                }
                $syllabus_field_obj->set_id($id);
                $syllabus_field_obj->set_category_id($category_id);
                $syllabus_field_obj->set_course_id($course_id);
                $syllabus_field_obj->set_value(serialize($fields_value));
                $syllabus_field_obj->set_create_date($create_date);
                $syllabus_field_obj->set_created_by($created_by);

                if (Validator::success())
                    {
                    $syllabus_field_obj->save();
                    json_response(array('status' => true));
                }
                
            }
        } else {
            Validator::set_error_flash_message(lang('Permission Denied'));
        }

        $this->view_params['syllabus_field_obj']=$syllabus_field_obj;
        $this->view_params['fields']= Orm_Pc_Syllabus_Fields::get_all(['course_id'=>$this->course_id,'category_id'=>$this->input->get('cat'),'deleted'=>'0'],0,0);
        $this->view_params['level'] = $level;
        $this->view_params['course_id'] = $this->course_id;
        $this->view_params['cat']=$this->input->get('cat');
        $html = $this->load->view('portfolio_course/forms/add_edit_syllabus', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
    }
    /**
     * this function delete by its level and id
     * @param string $level the level of the delete to be viewed
     * @param int $id the id of the delete to be viewed
     * @redirect success or error
     */
    public function delete($level = '', $id = 0){
        if ($this->can_manage) {
            if($level != '' && $id) {
                
                switch ($level) {
                    case 'custom_menu_value':
                        $virtual_deleteObj = Orm_Pc_Syllabus_Fields_Value::get_one(['id' => (int) $id]);
                        break;

                    default:
                        $virtual_deleteObj = Orm_Pc_Category::get_one(['id' => (int) $id]);
                        break;
                }
                
                if (isset($virtual_deleteObj))
                {   
                    $virtual_deleteObj->set_deleted('1');
                    $virtual_deleteObj->save();
                }
               
            } else {
                Validator::set_error_flash_message(lang('Illegal Inputs'));
            }
        } else {
            Validator::set_error_flash_message(lang('Permission Denied'));
        }

        echo json_encode(['path'=>'/portfolio_course/'.$level.'?id='.$this->course_id]);
    }

    /**
     * this function add_edit_custom_menu by its level and id
     * @param string $level the level of the add edit custom menu to be viewed
     * @param int $id the id of the add edit custom menu to be viewed
     * @redirect success or error
     */
    public function add_edit_custom_menu($level, $id = 0){

        if (!$this->can_manage) {
            die('<script>window.location.reload();</script>');
        }
        $category_obj = Orm_Pc_Category::get_instance($id);
        $field_obj =  Orm_Pc_Syllabus_Fields::get_all(['category_id'=>$id,'course_id'=>$this->input->get('id'),'deleted'=>'0']);
        $this->view_params['level'] = $level;
        if (!$this->input->post()) {
            $this->view_params['category_obj'] = $category_obj;
            $this->view_params['field_obj'] = $field_obj;
            $this->view_params['course_id'] = $this->input->get('id');
            $this->load->view('forms/add_category', $this->view_params);
        } else {
            $title_en = $this->input->post('title_en');
            $title_ar = $this->input->post('title_ar');
            $desc_en = $this->input->post('desc_en');
            $desc_ar = $this->input->post('desc_ar');
            $custom = $this->input->post('custom');
                     
            if(isset($custom) && !empty($custom)){
            $fields=[];
            $fids=[];
            $field_obj=[];
            foreach ($custom as $key => $value) {
            $fields[$key]['title_en']= $value['title_en'];
            Validator::not_empty_field_validator("custom[ $key][title_en]", $value['title_en'], lang('Please enter Text').' ( '.lang('English').' ) ');
            $fields[$key]['title_ar']= $value['title_ar'];
            Validator::not_empty_field_validator("custom[ $key][title_ar]", $value['title_ar'], lang('Please enter Text').' ( '.lang('Arabic').' ) ');
            $fields[$key]['type']= $value['type'];
            Validator::not_empty_field_validator("custom[ $key][type]", $value['type'], lang('Please Select Field Type'));
            $fields[$key]['required']= isset($value['required']) ? '1':'0';
            $fields[$key]['display']= isset($value['display']) ? '1':'0';
            $fields[$key]['value']=isset($value['checkboxvalue']) ? $value['checkboxvalue'] :'';

            if($value['type']=='checkbox')    
            {
                Validator::not_empty_field_validator("custom[$key][checkboxvalue]", $value['checkboxvalue'], lang('Please enter options'));
          
                if (strpos($value['checkboxvalue'], ',') == false) 
                        Validator::set_error("custom", lang('Please enter your options separated by comma'));
            }
            $fields[$key]['id']= $value['id'];
            $fids[]=$value['id'];
            }

            }

                Validator::not_empty_field_validator('title_en', $title_en, lang('Please enter Title') .' ( '.lang('English').' ) ');
                Validator::not_empty_field_validator('title_ar', $title_ar, lang('Please enter Title') .' ( '.lang('Arabic').' ) ');
                Validator::not_empty_field_validator('description_en', $desc_en, lang('Please enter Description') .' ( '.lang('English').' ) ');
                Validator::not_empty_field_validator('description_ar', $desc_ar, lang('Please enter Description').' ( '.lang('Arabic').' ) ');

                $create_date = date('Y-m-d H:i:s');

                $category_obj->set_title_en($title_en);
                $category_obj->set_title_ar($title_ar);
                $category_obj->set_description_en($desc_en);
                $category_obj->set_description_ar($desc_ar);
                $category_obj->set_level($level);
                $category_obj->set_deleted('0');
                $category_obj->set_create_date($create_date);
                $category_obj->set_created_by(Orm_User::get_logged_user()->get_id());
                $category_obj->set_course_id($this->course_id);


            if (Validator::success() && isset($fields) && !empty($fields)) {

                $id = $category_obj->save();
                $all_fields = Orm_Pc_Syllabus_Fields::get_all(['category_id'=>$id]);
                
                foreach ($all_fields as $key => $value) {
                    $value->set_deleted('1');
                    $value->save();
                }
                foreach ($fields as $key => $value) {
                $field_obj = Orm_Pc_Syllabus_Fields::get_instance($value['id']);
                $field_obj->set_category_id($id);
                $field_obj->set_title_en($value['title_en']);
                $field_obj->set_title_ar($value['title_ar']);
                $field_obj->set_field_type($value['type']);
                $field_obj->set_required($value['required']);
                $field_obj->set_display($value['display']);
                $field_obj->set_value($value['value']);
                $field_obj->set_deleted('0');     
                $field_obj->set_create_date($create_date);
                $field_obj->set_created_by(Orm_User::get_logged_user()->get_id());
                $field_obj->set_course_id($this->course_id);
                $field_obj->save();
                }
                json_response(array('status' => FALSE));

            } else {
                if(isset($fields) && !empty($fields))
                foreach ($custom as $key => $value) {
            $field_obj[$key] =  Orm_Pc_Syllabus_Fields::get_instance($value['id']);
            $field_obj[$key]->set_category_id($id);
            $field_obj[$key]->set_title_en($value['title_en']);
            $field_obj[$key]->set_title_ar($value['title_ar']);
            $field_obj[$key]->set_field_type($value['type']);
            $field_obj[$key]->set_value($value['checkboxvalue']);
            $field_obj[$key]->set_required(isset($value['required']) ? '1':'0');
            $field_obj[$key]->set_display(isset($value['display']) ? '1':'0');
                }
                
                
                
                Validator::set_error('custom', lang('You have to add at least one field.'));
                $this->view_params['category_obj'] = $category_obj;
                if(!isset($field_obj)){
                Validator::set_error_flash_message(lang('You have to add at least one field.'));
                json_response(array('status' => FALSE));
                }
            else {
                $this->view_params['field_obj'] = $field_obj;
                $this->view_params['course_id'] = $this->input->get('id');
                json_response(array('status' => true, 'html' => $this->load->view('forms/add_category', $this->view_params, true)));
            }

            }
        }

    }

    /**
     * this function _attach by its fieldName
     * @param string $fieldName the fieldName of the _attach to be viewed
     * @return string the call function
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

    /**
     * this function download by its id
     * @param int $id the id of the download to be viewed
     * @return string the call function
     */
    public function download($id){
        $file = Orm_Pc_Syllabus_Fields_Value::get_one(['id'=>$this->input->get('id')]);
        $fullPath = rtrim(FCPATH, '/') .unserialize($file->get_value())['field'.$id];
        $data = file_get_contents($fullPath);
        $this->load->helper('download');
        $filename = basename($fullPath);
        force_download($filename, $data);
    }
  
}