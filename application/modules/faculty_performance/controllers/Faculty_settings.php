<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * Class Manager
 */
class Faculty_Settings extends MX_Controller
{
    /**
     * @var $view_params array => the array pf data that will send to views
     * @var $deadline int (deadline id active)
     */

    private $view_params = array();
    private $deadline = 0;

    /**
     * Faculty_Settings constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if (!License::get_instance()->check_module('faculty_performance', true)) {
            show_404();
        }

        Orm_User::check_logged_in();
        Orm_User::check_permission(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'faculty_performance-settings');

        $this->deadline = Orm_Fp_Forms_Deadline::get_current_deadline();

        $this->view_params['sub_menu'] = 'settings/sub_menu';
        $this->view_params['menu_tab'] = 'faculty_performance';
        $this->breadcrumbs->push(lang('Faculty Performance Settings'), '/faculty_performance/faculty_settings');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Faculty Performance'),
            'icon' => 'fa fa-university'
        ), true);

    }

    /**
     * show first page in faculty performance setting page (deadline main page)
     *@return object|string
     */
    public function index()
    {

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Faculty Performance Deadline'),
            'icon' => 'fa fa-university',
            'link_attr' => 'id="new_deadline"',
            'link_icon' => 'plus',
            'link_title' => lang('Create').' '.lang('Deadline')
        ), true);

        $this->view_params['menu_tab'] = 'faculty_settings';
        $this->view_params['active'] = "deadline";
        $this->view_params['deadlines']=Orm_Fp_Forms_Deadline::get_all();

        $this->layout->view('faculty_performance/deadlines', $this->view_params);
    }

    /**
     * save the deadline data that added or save the nea deadline
     * @redirect successful or error message
     */
    public function save(){

        $start=$this->input->get_post('start_date');
        $end=$this->input->get_post('end_date');
        $id=intval($this->input->get_post('id'));

        Validator::required_field_validator('start_date', $start, lang('Please Enter Start Date'));
        Validator::required_field_validator('end_date', $end, lang('Please Enter End Date'));

        
        $deadline= Orm_Fp_Forms_Deadline::get_instance($id);
        $deadline->set_start_date($start);
        $deadline->set_end_date($end);
        if($id==0){
            $deadline->time_check($start,$end);
        }else{
            $deadline->time_check($start,$end, $id);
        }
        if(Validator::success()){
            $deadline->save();
            Validator::set_success_flash_message(lang('Deadline successfully Saved'),true);
            json_response(['success' => true]);
        }

        json_response(array('success' => false, 'html'=>Validator::get_error_message('start_date').'<br>'.Validator::get_error_message('end_date')));
    }

    /**
     * get the form settings in faculty performance settings
     */
    public function settings(){

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Faculty Performance From'),
            'icon' => 'fa fa-university',
        ), true);

        $this->breadcrumbs->push(lang('Faculty Performance Form Settings'), '/faculty_performance/faculty_settings/settings');
        $this->view_params['menu_tab'] = 'faculty_settings';
        $this->view_params['sub_menu'] = 'settings/sub_menu';
        $this->view_params['active'] = "settings";
        $this->layout->view('faculty_performance/settings/settings', $this->view_params);
        
    }

    /**
     * remove deadline from system
     * @param $id
     */
    public function delete($id){

        $obj = Orm_Fp_Forms_Deadline::get_instance($id);
        $obj->soft_delete($id);

    }

    /**
     * get and prepare all data for type in faculty performance settings tab type
     */
    public function type(){

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Faculty Performance Type'),
            'icon' => 'fa fa-university',
        ), true);

        $this->breadcrumbs->push(lang('Faculty Performance Type Settings'), '/faculty_performance/faculty_settings/type/');

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');

        if (!$page) {
            $page = 1;
        }
        $filters = array();


        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Fp_Forms_Type::get_count($filters));
        $numItems = $pager->get_total_count()/ $pager->get_per_page() + ($pager->get_total_count()%$pager->get_per_page() >0 ?1:0);

        if($numItems<$page){
            $page = 1;
        }
        $pager->set_page($page);
        $types = Orm_Fp_Forms_Type::get_all($filters,$page,$per_page);
        $this->view_params['sum_rate'] = Orm_Fp_Forms_Rate::get_sum_by_deadline($this->deadline,0);
        $this->view_params['types'] = $types;
        $this->view_params['deadline_id'] = $this->deadline;
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['menu_tab'] = 'faculty_settings';
        $this->view_params['sub_menu'] = 'settings/sub_menu';
        $this->view_params['active'] = "type";
        $this->layout->view('faculty_performance/settings/type', $this->view_params);
    }

    /**
     * this function for adding new type in the sub-menu
     */
    public function add_type()
    {
        $this->view_params['performance'] = new Orm_Fp_Forms_Type();

        $this->view_params['deadline_id'] = $this->deadline;

        $this->load->view('faculty_performance/settings/add_type', $this->view_params);
    }


    /**
     * update the data for type
     * @param $id => type id
     */
    public function edit_type($id)
    {
        $type = Orm_Fp_Forms_Type::get_instance($id);
        $rate = Orm_Fp_Forms_Rate::get_type_instance($id);

        $this->view_params['performance'] = $type;
        $this->view_params['deadline_id'] = $this->deadline;

        $this->load->view('faculty_performance/settings/add_type', $this->view_params);

    }

    /**
     * save new type or updated data in old type that exist
     * @redirect successful or error message
     */
    public function save_type()
    {
        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('dashboard');
        }

        $id = $this->input->post('id');
        $type_name_en = $this->input->post('type_name_en');
        $type_name_ar = $this->input->post('type_name_ar');
        $rate = $this->input->post('rate');

        $sum_types = Orm_Fp_Forms_Rate::get_sum_by_deadline($this->deadline ,$id)+$rate;
        Validator::required_field_validator('type_name_en', $type_name_en, lang('Invalid Type Name').' '.lang('English'));
        Validator::required_field_validator('type_name_ar', $type_name_ar, lang('Invalid Type Name').' '.lang('Arabic'));
        Validator::required_field_validator('rate', $rate, lang('You must fill rate input'));
        if($rate != null){
            Validator::greater_than_validator('rate', 0, $rate, lang('Rate must be larger than 0'));
            Validator::less_than_validator('rate', 100, $rate, lang('Rate must be Less than or equal 100'));
            Validator::less_than_validator('rate', 100, $sum_types, lang('Total of rate type must be less than or equal 100'));
            Validator::numeric_field_validator('rate', $rate, lang('Rate must be Numeric'));
        }


        $obj = Orm_Fp_Forms_Type::get_instance($id);
        $obj->set_type_name_en($type_name_en);
        $obj->set_type_name_ar($type_name_ar);
        $obj->set_is_removable(1);
        $rating = Orm_Fp_Forms_Rate::get_type_instance($id);
        if (Validator::success()) {
            $obj->save();
            $rating->set_rate($rate);
            $rating->set_type_id($obj->get_id());
            $rating->set_deadline_id($this->deadline);
            $rating->save();
            Validator::set_success_flash_message(lang('Type Successfully Add'), true);

            json_response(['status' => true]);

        }
        $this->view_params['performance'] = $obj;
        $this->view_params['rate'] = $rating;
        $this->view_params['deadline_id'] = $this->deadline;
        $html = $this->load->view('faculty_performance/settings/add_type', $this->view_params, true);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }
        
    }


    /**
     * delete the type from the system
     * @param $id
     */
    public function remove_type($id)
    {
        $obj = Orm_Fp_Forms_Type::get_instance($id);
        $obj->soft_delete($id);
    }

    /**
     * get all forms that related to one type
     * @param $type => type id
     */
    public function forms($type){

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Faculty Performance From'),
            'icon' => 'fa fa-university',
        ), true);

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');

        if (!$page) {
            $page = 1;
        }
        $filters = array('type_id'=>$type);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Fp_Forms::get_count($filters));

        $numItems = $pager->get_total_count()/ $pager->get_per_page() + ($pager->get_total_count()%$pager->get_per_page() >0 ?1:0);

        if($numItems<$page){
            $page = 1;
        }

        $pager->set_page($page);
        $forms = Orm_Fp_Forms::get_all($filters,$page,$per_page);
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['forms'] = $forms;
        $this->view_params['sub_tab'] = $type;
        $this->view_params['active'] = "settings";
        $this->view_params['menu_tab'] = 'faculty_settings';
        $this->view_params['type'] = Orm_Fp_Forms_Type::get_instance($type);

        $this->layout->view('faculty_performance/settings/form', $this->view_params);

    }

    /**
     * hide the forms that will not add any data for it
     * @param $id => data id
     */
    public function hidden_form($id){

        $form = Orm_Fp_Forms::get_instance($id);
        $form->set_is_hidden(!$form->get_is_hidden());
        $form->save();

        if($form->get_is_hidden() == true){
            Validator::set_success_flash_message(lang('Form has been successfully hidden'),true);
            json_response(['success' => true]);
        }else{
            Validator::set_success_flash_message(lang('Form has been successfully displayed'),true);
            json_response(['success' => true]);
        }
        
    }

    /**
     * remove the forms that added by user to the system
     * @param $id
     */
    public function remove_form($id)
    {
        $obj = Orm_Fp_Forms::get_instance($id);
        $obj->soft_delete($id);
    }

    /**
     * add new forms for specific types or add new forms for it
     * @param $type => type id
     * @param $form_id => form id ( 0 => means that form not created before )
     */
    public function add_edit_form($type, $form_id)
    {

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('dashboard');
        }
        if (isset($form_id) && isset($type)) {
            $form = Orm_Fp_Forms::get_instance($form_id);
            $inputs = array();
            $old_inputs_id = array();


            foreach (Orm_Fp_Forms_Inputs::get_all(array('form_id' => $form_id)) as $key => $input) {

                $old_inputs_id[] = $input->get_id();
                $inputs[$key]['id'] = $input->get_id();
                $inputs[$key]['form_id'] = $input->get_form_id();
                $inputs[$key]['input_label_en'] = $input->get_input_label_en();
                $inputs[$key]['input_label_ar'] = $input->get_input_label_ar();

            }

            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $form_name_en = $this->input->post('form_name_en');
                $form_name_ar = $this->input->post('form_name_ar');
                $inputs = $this->input->post('inputs');

                $form->set_form_name_en($form_name_en);
                $form->set_form_name_ar($form_name_ar);
                $form->set_type_id($type);
                $form->set_type_id($type);
                $form->set_is_editable(1);

                Validator::required_field_validator('form_name_en', $form_name_en, lang('Required Fields Missing'));
                Validator::required_field_validator('form_name_ar', $form_name_ar, lang('Required Fields Missing'));
                Validator::required_array_validator('inputs', $inputs, lang('Please add at least one Input'));

                if ($inputs) {
                    foreach ($inputs as $key => $input) {
                        if (isset($input['id'])) {
                            Validator::required_field_validator('required_input_label_en_' . ($key ? $key : '0'), $input['input_label_en'], lang('Required Fields Missing'));
                            Validator::required_field_validator('required_input_label_ar_' . ($key ? $key : '0'), $input['input_label_ar'], lang('Required Fields Missing'));
                        }

                    }
                }
                if ($inputs && Validator::success()) {
                    $form->save();

                    $deleted_inputs = array_diff($old_inputs_id, array_column($inputs, 'id'));
                    if ($deleted_inputs) {
                        foreach ($deleted_inputs as $deleted_input_id) {
                            $inputt_obj = Orm_Fp_Forms_Inputs::get_one(array('id' => intval($deleted_input_id), 'form_id' => $form_id));
                            $inputt_obj->delete();
                        }
                    }

                    foreach ($inputs as $input) {

                        $input_id = isset($input['id']) ? $input['id'] : 0;
                        $input_label_en = isset($input['input_label_en']) ? $input['input_label_en'] : 0;
                        $input_label_ar = isset($input['input_label_ar']) ? $input['input_label_ar'] : 0;


                        if ($input_label_en && $input_label_ar) {
                            $contact_obj = Orm_Fp_Forms_Inputs::get_one(array('id' => intval($input_id), 'form_id' => $form_id));
                            $contact_obj->set_form_id($form->get_id());
                            $contact_obj->set_input_label_en($input_label_en);
                            $contact_obj->set_input_label_ar($input_label_ar);
                            $contact_obj->save();
                        }
                    }
                    Validator::set_success_flash_message(lang('Successfully Saved'));
                    json_response(array('status' => true));
                }

                if (Validator::success()) {
                    json_response(array('status' => true));
                } else {
                    $this->view_params['form'] = $form;
                    $this->view_params['inputs'] = $inputs;
                    $this->view_params['type'] = $type;
                    json_response(array('status' => false, 'html' => $this->load->view('faculty_performance/settings/add_form', $this->view_params, true)));
                }
            }

            $this->view_params['form'] = $form;
            $this->view_params['inputs'] = $inputs;
            $this->view_params['type'] = $type;

            $html = $this->load->view('faculty_performance/settings/add_form', $this->view_params, true);

            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                json_response(array('status' => false, 'html' => $html));
            } else {
                echo $html;
            }
        } else {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('dashboard');
        }
    }

    /**
     * get each one of types rate
     * @param $type_id
     */
    public function set_rate($type_id)
    {
        $rate = Orm_Fp_Forms_Rate::get_rate_by_type($type_id,$this->deadline);
        $this->view_params['rate'] = $rate;
        $this->view_params['type_id'] = $type_id;
        $this->load->view('faculty_performance/settings/set_rate', $this->view_params);
    }

    /**
     *save the rate value that set for forms type
     * @redirect successful or error message
     */
    public function save_rate()
    {
        $id = (int)$this->input->post('id');
        $type_id = (int)$this->input->post('type_id');
        $rate = $this->input->post('rate');
        $sum_types = Orm_Fp_Forms_Rate::get_sum_by_deadline($this->deadline ,$type_id)+$rate;
        Validator::greater_than_validator('rate', 0, $rate, lang('Rate must be larger than 0'));
        Validator::less_than_validator('rate', 100, $rate, lang('Rate must be Less than or equal 100'));
        Validator::less_than_validator('rate', 100, $sum_types, lang('Total of rate type must be less than or equal 100'));
        Validator::numeric_field_validator('rate', $rate, lang('Rate must be Numeric'));

        $rating = Orm_Fp_Forms_Rate::get_instance($id);
        $rating->set_type_id($type_id);
        $rating->set_deadline_id($this->deadline);
        $rating->set_rate($rate);

        if (Validator::success()) {
            $rating->save();

            Validator::set_success_flash_message(lang('Rate Added Successfully '), true);
            json_response(['success' => true]);
        }
        $this->view_params['rate'] = $rating;
        $this->view_params['type_id'] = $type_id;

        json_response(['success' => false, 'html' => Validator::get_error_message('rate')]);

    }

    /**
     * check if forms has result or not
     */
    public function check_result(){

        $form_id = $this->input->get_post('form_id');

        $result = (bool) Orm_Fp_Forms::get_result($form_id);
        if($result){
            Validator::set_error('input',  lang("This Form has a result,You can't Add any Input"));
        }
        json_response(['success'=>$result,'html' => Validator::get_error_message('input')]);

    }

}
