<?php

/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 05/03/17
 * Time: 03:13 م
 */
defined('BASEPATH') OR exit('No direct script access allowed');


class Policies_procedures extends MX_Controller
{

    private $view_params = array();
    /** @var \Orm_User_Staff | Orm_User_Faculty */
    private $logged_user;

    function __construct()
    {
        parent::__construct();

        if (!License::get_instance()->check_module('policies_procedures', true)) {
            show_404();
        }

        Orm_User::check_logged_in();

        Orm_Policies_Procedures::check_if_can_view();

        $this->logged_user = Orm_User::get_logged_user();

        $this->layout->add_javascript('/assets/jadeer/js/add_more.js');
        $this->layout->add_javascript('/assets/jadeer/js/jquery.iframe-transport.js');
        $this->layout->add_javascript('/assets/jadeer/js/tinymce/tinymce.min.js', false);

        //
        //menu_tab
        //

        $this->view_params['menu_tab'] = 'policies_procedures';
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Policies & Procedures'),
            'icon' => 'fa fa-list'
        ), true);

        $this->breadcrumbs->push(lang('Policies & Procedures'), '/policies_procedures');
    }
    /** list all procedures after check it
    */
    public function get_list()
    {
        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');
        $this->logged_user = Orm_User::get_logged_user();

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        /*
         * unit_id for program,college,university real id,
         * unit_type [0->university, 1->college, 2->program]
         */

        if (!empty($fltr['institution']) && $fltr['institution'] == 1) {
            $filters['unit_type'] = Orm_Policies_Procedures::UNIT_INSTITUTION_LEVEL;
        }
        if (!empty($fltr['college_id']) && $fltr['college_id'] > 0) {
            $filters['unit_type'] = Orm_Policies_Procedures::UNIT_COLLEGE_LEVEL;
            $filters['unit_id'] = $fltr['college_id'];
        }
        if (!empty($fltr['program_id']) && $fltr['program_id'] > 0) {
            $filters['unit_type'] = Orm_Policies_Procedures::UNIT_PROGRAM_LEVEL;
            $filters['unit_id'] = $fltr['program_id'];
          
        }
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        if ($this->logged_user->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {

            $filters['in_unit_type'] = array(Orm_Policies_Procedures::UNIT_PROGRAM_LEVEL,Orm_Policies_Procedures::UNIT_COLLEGE_LEVEL);
            $filters['in_unit_id'] = array_merge(array_column(Orm_Program::get_model()->get_all(['college_id' => $this->logged_user->get_college_id()], 0, 0, [], Orm::FETCH_ARRAY), 'id'),array($this->logged_user->get_college_id()));

        }

        if ($this->logged_user->has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
            $filters['unit_type'] = Orm_Policies_Procedures::UNIT_PROGRAM_LEVEL;
            $filters['unit_id'] = $this->logged_user->get_program_id();

        }


        if($this->logged_user->get_class_type() == Orm_User::USER_STUDENT){
            $obj = Orm_Policies_Procedures::get_all($filters, $page, $per_page,array('unit_id'));
        }else{
            $obj = Orm_Policies_Procedures::get_all($filters, $page, $per_page);
        }
        
        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Policies_Procedures::get_count($filters));
        $check = $pager->get_total_count() / 10;
        if ($check <= 1 && $page != 1) {
            redirect('/policies_procedures/');
        }

        $this->view_params['items'] = $obj;
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;
    }

    /** index page it's dashboard page and not allowed student to access it and invoke get list function above
    */
    public function index()
    {

        if (Orm_Policies_Procedures::check_if_can_add() && $this->logged_user->get_class_type() != Orm_User::USER_STUDENT) {
            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'link_attr' => 'href="/policies_procedures/add"',
                'link_icon' => 'plus',
                'link_title' => lang('Add New')
            ), true);
        }


        $this->get_list();

        $this->layout->view('policies_procedures/items', $this->view_params);

    }

    /** filter request if it's ajax request get list and render to data table else render to index
    */
    public function filter()
    {
        if ($this->input->is_ajax_request()) {
            $this->get_list();
            $this->load->view('data_table', $this->view_params);
        } else {
            $this->index();
        }
    }


    /** add procedures and policies depending on user role
    */
    public function add()
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'policies_procedures-manage');
        
        $this->breadcrumbs->push(lang('Add') . ' ' . lang('Policies & Procedures'), '/policies_procedures/add_edit');

        if($this->logged_user->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)){

            if(empty($this->logged_user->get_college_id())){

                Validator::set_error_flash_message(lang('College not exist'));
                redirect('/policies_procedures');

            }else{
                $this->view_params['logged_user'] = $this->logged_user;
                $this->view_params['policy'] = new Orm_Policies_Procedures();
                $this->layout->view('policies_procedures/add_edit', $this->view_params);
            }

        }elseif($this->logged_user->has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN) || $this->logged_user->has_role_type(Orm_Role::ROLE_NOT_ADMIN)){
            if(empty($this->logged_user->get_college_id())){

                Validator::set_error_flash_message(lang('College not exist'));
                redirect('/policies_procedures');

            }elseif( empty($this->logged_user->get_program_id())){

                Validator::set_error_flash_message(lang('Program not exist'));
                redirect('/policies_procedures');

            }else{
                $this->view_params['logged_user'] = $this->logged_user;
                $this->view_params['policy'] = new Orm_Policies_Procedures();
                $this->layout->view('policies_procedures/add_edit', $this->view_params);
            }
        }else{

            $this->view_params['logged_user'] = $this->logged_user;
            $this->view_params['policy'] = new Orm_Policies_Procedures();
            $this->layout->view('policies_procedures/add_edit', $this->view_params);
        }
    }


    /** edit policies if exist
     * @param $id
     */
    public function edit($id=0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false,
            'policies_procedures-manage');


        $policy = Orm_Policies_Procedures::get_instance($id);

        if(!$policy->get_id()){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        if (!$policy->check_if_can_modify($this->logged_user)) {
            Validator::set_error_flash_message(lang('Permissions Denied'));
            redirect('/policies_procedures');
        }

        $this->breadcrumbs->push(lang('Edit') . ' ' . lang('Policies & Procedures'), '/policies_procedures/add_edit/' . $id);

        if($this->logged_user->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)){

            if(empty($this->logged_user->get_college_id())){

                Validator::set_error_flash_message(lang('College not exist'));
                redirect('/policies_procedures');

            }else{
                $this->view_params['policy'] = $policy;
                $this->view_params['user_ids'] = $policy->get_manager_ids();
                $this->view_params['logged_user'] = $this->logged_user;
                $this->layout->view('policies_procedures/add_edit', $this->view_params);
            }

        }elseif($this->logged_user->has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN) || $this->logged_user->has_role_type(Orm_Role::ROLE_NOT_ADMIN)){
            if(empty($this->logged_user->get_college_id())){

                Validator::set_error_flash_message(lang('College not exist'));
                redirect('/policies_procedures');

            }elseif( empty($this->logged_user->get_program_id())){

                Validator::set_error_flash_message(lang('Program not exist'));
                redirect('/policies_procedures');

            }else{
                $this->view_params['policy'] = $policy;
                $this->view_params['user_ids'] = $policy->get_manager_ids();
                $this->view_params['logged_user'] = $this->logged_user;
                $this->layout->view('policies_procedures/add_edit', $this->view_params);
            }
        }else{

            $this->view_params['policy'] = $policy;
            $this->view_params['user_ids'] = $policy->get_manager_ids();
            $this->view_params['logged_user'] = $this->logged_user;
            $this->layout->view('policies_procedures/add_edit', $this->view_params);
        }

      
    }


    /**  save policy and procedures after validation
    */
    public function save()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF,
                Orm_User::USER_FACULTY)
            , false, 'policies_procedures-manage');

        $id = $this->input->post('id');
        $unit_type = intval($this->input->post('unit_type'));
        $college_id = intval($this->input->post('college_id'));
        $department_id = intval($this->input->post('department_id'));
        $program_id = intval($this->input->post('program_id'));
        $manager_ids = $this->input->post('user_ids');
        $title_en = $this->input->post('title_en');
        $title_ar = $this->input->post('title_ar');
        $desc_en = $this->input->post('desc_en');
        $desc_ar = $this->input->post('desc_ar');


        $policy = Orm_Policies_Procedures::get_instance($id);


        /*
         * Validator
         */

        Validator::required_array_validator('user_ids', $manager_ids, lang('Please Select at least one Manager'));
        Validator::required_field_validator('title_en', $title_en, lang('Invalid Title') . ' ( ' . lang('English') . ' ) ');
        Validator::required_field_validator('title_ar', $title_ar, lang('Invalid Title') . ' ( ' . lang('Arabic') . ' ) ');
        Validator::database_unique_field_validator($policy, 'title_en', 'title_en', $title_en, lang('Unique Field'));
        Validator::database_unique_field_validator($policy, 'title_ar', 'title_ar', $title_ar, lang('Unique Field'));


        if ($manager_ids) {

            $vals = array_count_values($manager_ids);
            if (count($vals) != count($manager_ids)) {

                Validator::set_error('user_ids', lang('Please Select 2 different Users'));
            }

            foreach ($manager_ids as $key => $manager_id) {
                Validator::not_empty_field_validator('user_id', $manager_id, lang('Please Select Manager'), $key);
            }
        }

        $unit_id = 0;

        switch ($unit_type) {

            case Orm_Policies_Procedures::UNIT_COLLEGE_LEVEL:

                Validator::not_empty_field_validator('college_id', $college_id, lang('Please Select College'));

                $unit_id = $college_id;
                break;

            case Orm_Policies_Procedures::UNIT_PROGRAM_LEVEL:

                Validator::not_empty_field_validator('college_id', $college_id, lang('Please Select College'));
                Validator::not_empty_field_validator('department_id', $department_id, lang('Please Select Department'));
                Validator::not_empty_field_validator('program_id', $program_id, lang('Please Select Program'));

                $unit_id = $program_id;
                break;
        }


        $policy->set_unit_id($unit_id);
        $policy->set_unit_type($unit_type);
        $policy->set_title_en($title_en);
        $policy->set_title_ar($title_ar);
        $policy->set_desc_en($desc_en);
        $policy->set_desc_ar($desc_ar);
        $policy->set_creator_id($this->logged_user->get_id());


        if (Validator::success()) {
            $policy->save();

            foreach ($manager_ids as $manager_id) {
                $manager = Orm_Policies_Procedures_Managers::get_one(array('policy_id' => $policy->get_id(), 'manager_id' => $manager_id));
                $manager->set_policy_id($policy->get_id());
                $manager->set_manager_id($manager_id);
                $manager->save();
            }

            foreach (array_diff($policy->get_manager_ids(), $manager_ids) as $manager_id) {
                $delete_manager = Orm_Policies_Procedures_Managers::get_one(array('policy_id' => $policy->get_id(), 'manager_id' => $manager_id));
                $delete_manager->delete();
            }

            Validator::set_success_flash_message(lang('Successfully Saved'));
            redirect('/policies_procedures');
        }

        if ($id == 0) {
            $this->breadcrumbs->push(lang('Add') . ' ' . lang('Policies & Procedures'), '/policies_procedures/add_edit');
        } else {
            $this->breadcrumbs->push(lang('Edit') . ' ' . lang('Policies & Procedures'), '/policies_procedures/add_edit/' . $id);
        }

        $this->view_params['logged_user'] = $this->logged_user;
        $this->view_params['policy'] = $policy;
        $this->view_params['user_ids'] = $manager_ids;
        $this->layout->view('policies_procedures/add_edit', $this->view_params);

    }

    /** delete policies and procedures if exist
    */
    public function delete($id)
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'policies_procedures-manage');

        $policy = Orm_Policies_Procedures::get_instance($id);

        if (!$policy->get_id()) {
            Validator::set_error_flash_message('The resource you requested does not exist!');
            redirect('/');
        }
        if(isset($id)){
            if ($policy->get_id()) {
                $policy->delete();
                Validator::set_success_flash_message(lang('Successful Delete'));
            }
        }else{
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

    }

/** manage and list procedures that can modify on it if it's defined
*/
    public function manage($id)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false,
            'policies_procedures-manage');

        if(isset($id)){
            $this->breadcrumbs->push(lang('Manage') . ' ' . Orm_Policies_Procedures::get_instance($id)->get_title(), '/policies_procedures/manage/' . $id);

            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'title' => lang('Policies & Procedures'),
                'icon' => 'fa  fa-list'
            ), true);

            $obj = Orm_Policies_Procedures::get_instance($id);

            if (!$obj->check_if_can_modify($this->logged_user)) {
                Validator::set_error_flash_message(lang('Permissions Denied'));
                redirect('/policies_procedures');
            }

            if(!$obj->get_id()){
                Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
                redirect('/');
            }

            $this->view_params['item'] = $obj;
            $this->layout->view('policies_procedures/list', $this->view_params);
        }else{
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }


    }


    /** update policy form depending on specific data
    */
    public function update_information($role_id, $type)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false,
            'policies_procedures-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

         if(isset($role_id) && isset($type)) {
            if ($type != 'responsible' || $type != 'contact') {
                $policy = Orm_Policies_Procedures::get_instance($role_id);

                if(!$policy->get_id()){
                    Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
                    redirect('/');
                }

                $this->view_params['policy'] = $policy;
                $this->load->view('policies_procedures/policies_form/' . $type, $this->view_params);

            } else {

                Validator::set_error_flash_message(lang('Operation not allowed!'));
                redirect('/');
            }
        }else {

            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }


    }


    /** save your update function above  and save it depending on types of procedures
    */
    public function save_update($type)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false,
            'policies_procedures-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        $id = $this->input->post('id');

        if (isset($id) ) {

            $statement_en = $this->input->post('statement_en');
            $statement_ar = $this->input->post('statement_ar');

            $definitions_en = $this->input->post('definitions_en');
            $definitions_ar = $this->input->post('definitions_ar');

            $audience_en = $this->input->post('audience_en');
            $audience_ar = $this->input->post('audience_ar');

            $reason_en = $this->input->post('reason_en');
            $reason_ar = $this->input->post('reason_ar');

            $compliance_en = $this->input->post('compliance_en');
            $compliance_ar = $this->input->post('compliance_ar');

            $regulations_en = $this->input->post('regulations_en');
            $regulations_ar = $this->input->post('regulations_ar');

            $history_en = $this->input->post('history_en');
            $history_ar = $this->input->post('history_ar');

            $procedures_en = $this->input->post('procedures_en');
            $procedures_ar = $this->input->post('procedures_ar');

            $standard_en = $this->input->post('standard_en');
            $standard_ar = $this->input->post('standard_ar');


            $policy = Orm_Policies_Procedures::get_instance($id);
            /* Sta*/

            if ($statement_en != '' || $statement_ar != '') {
                Validator::required_field_validator('statement_en', $statement_en, lang('You must insert this Field'));
                Validator::required_field_validator('statement_ar', $statement_ar, lang('You must insert this Field'));

            }
            if ($definitions_en != '' || $definitions_ar != '') {
                Validator::required_field_validator('definitions_en', $definitions_en, lang('You must insert this Field'));
                Validator::required_field_validator('definitions_ar', $definitions_ar, lang('You must insert this Field'));

            }
            if ($audience_en != '' || $audience_ar != '') {
                Validator::required_field_validator('audience_en', $audience_en, lang('You must insert this Field'));
                Validator::required_field_validator('audience_ar', $audience_ar, lang('You must insert this Field'));

            }
            if ($reason_en != '' || $reason_ar != '') {
                Validator::required_field_validator('reason_en', $reason_en, lang('You must insert this Field'));
                Validator::required_field_validator('reason_ar', $reason_ar, lang('You must insert this Field'));

            }
            if ($compliance_en != '' || $compliance_ar != '') {
                Validator::required_field_validator('compliance_en', $compliance_en, lang('You must insert this Field'));
                Validator::required_field_validator('compliance_ar', $compliance_ar, lang('You must insert this Field'));

            }
            if ($regulations_en != '' || $regulations_ar != '') {
                Validator::required_field_validator('regulations_en', $regulations_en, lang('You must insert this Field'));
                Validator::required_field_validator('regulations_ar', $regulations_ar, lang('You must insert this Field'));

            }
            if ($history_en != '' || $history_ar != '') {
                Validator::required_field_validator('history_en', $history_en, lang('You must insert this Field'));
                Validator::required_field_validator('history_ar', $history_ar, lang('You must insert this Field'));

            }
            if ($procedures_en != '' || $procedures_ar != '') {
                Validator::required_field_validator('procedures_en', $procedures_en, lang('You must insert this Field'));
                Validator::required_field_validator('procedures_ar', $procedures_ar, lang('You must insert this Field'));

            }
            if ($standard_en != '' || $standard_ar != '') {
                Validator::required_field_validator('standard_en', $standard_en, lang('You must insert this Field'));
                Validator::required_field_validator('standard_ar', $standard_ar, lang('You must insert this Field'));

            }

            switch ($type) {
                case 'statement':
                    $policy->set_statement_en($statement_en);
                    $policy->set_statement_ar($statement_ar);
                    break;
                case 'definition':
                    $policy->set_definitions_en($definitions_en);
                    $policy->set_definitions_ar($definitions_ar);
                    break;
                case 'audience':
                    $policy->set_audience_en($audience_en);
                    $policy->set_audience_ar($audience_ar);
                    break;
                case 'reason':
                    $policy->set_reason_en($reason_en);
                    $policy->set_reason_ar($reason_ar);
                    break;
                case 'compliance':
                    $policy->set_compliance_en($compliance_en);
                    $policy->set_compliance_ar($compliance_ar);
                    break;

                case 'regulations':
                    $policy->set_regulations_en($regulations_en);
                    $policy->set_regulations_ar($regulations_ar);
                    break;
                case 'history':
                    $policy->set_history_en($history_en);
                    $policy->set_history_ar($history_ar);
                    break;
                case 'procedures':
                    $policy->set_procedures_en($procedures_en);
                    $policy->set_procedures_ar($procedures_ar);
                    break;
                case  'standards':
                    $policy->set_standard_en($standard_en);
                    $policy->set_standard_ar($standard_ar);
                    break;
            }

            if (Validator::success()) {
                Validator::set_success_flash_message(lang('Successfully Saved'));
                json_response(['success' => true, 'id' => $policy->save()]);
            }

            $this->view_params['policy'] = $policy;
            $this->view_params['type'] = $type;
            $html = $this->load->view('policies_procedures/policies_form/' . $type, $this->view_params, true);

            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                json_response(array('status' => false, 'html' => $html));
            } else {
                echo $html;
            }
        } else {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }


    }

    /** set responsbilites for policies depending on policy id and type of policy and save it
     * it will render in policies_form
    */
    public function add_edit_response($policy_id, $type)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false,
            'policies_procedures-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        $policy = Orm_Policies_Procedures::get_instance($policy_id);

        if(!$policy->get_id()){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        if (isset($policy_id) && isset($type) ) {
            $responsibilities = array();
            $old_responsibility_ids = array();


            foreach (Orm_Policies_Procedures_Responsible::get_all(array('policies_id' => $policy_id)) as $key => $response) {

                $old_responsibility_ids[] = $response->get_id();
                $responsibilities[$key]['id'] = $response->get_id();
                $responsibilities[$key]['policies_id'] = $response->get_policies_id();
                $responsibilities[$key]['role'] = $response->get_role();
                $responsibilities[$key]['responsibilities'] = $response->get_responsibilities();


            }

            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $roles = $this->input->post('roles');

                Validator::required_array_validator('roles', $roles, lang('Please add at least one Role & Responsible'));

                if ($roles) {
                    foreach ($roles as $key => $role) {
                        if (isset($role['id'])) {
                            Validator::required_field_validator('required_role_' . ($key ? $key : '0'), $role['role'], lang('Required Fields Missing'));
                            Validator::required_field_validator('required_responsibilities_' . ($key ? $key : '0'), $role['responsibilities'], lang('Required Fields Missing'));
                        }
                    }
                }


                if ($roles && Validator::success()) {

                    $deleted_roles = array_diff($old_responsibility_ids, array_column($roles, 'id'));
                    if ($deleted_roles) {
                        foreach ($deleted_roles as $old_responsibility_id) {
                            $role_obj = Orm_Policies_Procedures_Responsible::get_one(array('id' => intval($old_responsibility_id), 'policies_id' => $policy_id));
                            $role_obj->delete();
                        }
                    }

                    foreach ($roles as $role) {

                        $role_id = isset($role['id']) ? $role['id'] : 0;
                        $role_role = isset($role['role']) ? $role['role'] : '';
                        $role_response = isset($role['responsibilities']) ? $role['responsibilities'] : '';

                        if ($role_role && $role_response) {
                            $role_obj = Orm_Policies_Procedures_Responsible::get_one(array('id' => intval($role_id), 'policies_id' => $policy_id));
                            $role_obj->set_policies_id($policy_id);
                            $role_obj->set_role($role_role);
                            $role_obj->set_responsibilities($role_response);
                            $role_obj->save();
                        }
                    }
                    Validator::set_success_flash_message(lang('Successfully Saved'));
                    json_response(array('status' => true));
                }

                if (Validator::success()) {
                    json_response(array('status' => true));
                } else {
                    $this->view_params['policy_id'] = $policy_id;
                    $this->view_params['type'] = $type;
                    $this->view_params['roles'] = $roles;
                    json_response(array('status' => false, 'html' => $this->load->view('policies_procedures/policies_form/' . $type, $this->view_params, true)));
                }
            }

            $this->view_params['policy_id'] = $policy_id;
            $this->view_params['type'] = $type;
            $this->view_params['roles'] = $responsibilities;

            $html = $this->load->view('policies_procedures/policies_form/' . $type, $this->view_params, true);

            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                json_response(array('status' => false, 'html' => $html));
            } else {
                echo $html;
            }

        } else {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }
    }

    /** add contact for policy depending on policy id and typeof policy
     *render it in policies view
    */
    public function add_edit_contact($policy_id, $type)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false,
            'policies_procedures-manage');


        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }
        if (isset($policy_id) && isset($type)) {
            $policy = Orm_Policies_Procedures::get_instance($policy_id);

            if(!$policy->get_id()){
                Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
                redirect('/');
            }

            $contacts = array();
            $old_contacts_id = array();


            foreach (Orm_Policies_Procedures_Contacts::get_all(array('policies_id' => $policy_id)) as $key => $contact) {

                $old_contacts_id[] = $contact->get_id();
                $contacts[$key]['id'] = $contact->get_id();
                $contacts[$key]['policies_id'] = $contact->get_policies_id();
                $contacts[$key]['subject'] = $contact->get_title();
                $contacts[$key]['contact_name'] = $contact->get_contact_name();
                $contacts[$key]['phone'] = $contact->get_phone();
                $contacts[$key]['mail'] = $contact->get_mail();

            }

            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $contact_def_en = $this->input->post('contact_def_en');
                $contact_def_ar = $this->input->post('contact_def_ar');
                $contacts = $this->input->post('contacts');

                $policy->set_contact_def_en($contact_def_en);
                $policy->set_contact_def_ar($contact_def_ar);

                Validator::required_field_validator('contact_def_en', $contact_def_en, lang('Required Fields Missing'));
                Validator::required_field_validator('contact_def_ar', $contact_def_ar, lang('Required Fields Missing'));
                Validator::required_array_validator('contacts', $contacts, lang('Please add at least one Contact'));

                if ($contacts) {
                    foreach ($contacts as $key => $contact) {
                        if (isset($contact['id'])) {
                            Validator::required_field_validator('required_subject_' . ($key ? $key : '0'), $contact['subject'], lang('Required Fields Missing'));
                            Validator::required_field_validator('required_name_' . ($key ? $key : '0'), $contact['contact_name'], lang('Required Fields Missing'));

                            Validator::required_field_validator('required_phone_' . ($key ? $key : '0'), $contact['phone'], lang('Required Fields Missing'));
                            Validator::numeric_field_validator('required_phone_' . ($key ? $key : '0'), $contact['phone'], lang('Invalid Phone Number'));

                            Validator::required_field_validator('required_mail_' . ($key ? $key : '0'), $contact['mail'], lang('Required Fields Missing'));
                            Validator::email_field_validator('required_mail_' . ($key ? $key : '0'), $contact['mail'], lang('Error: Invalid Email'));
                        }


                    }
                }


                if ($contacts && Validator::success()) {
                    $policy->save();

                    $deleted_contacts = array_diff($old_contacts_id, array_column($contacts, 'id'));
                    if ($deleted_contacts) {
                        foreach ($deleted_contacts as $deleted_contact_id) {
                            $contact_obj = Orm_Policies_Procedures_Contacts::get_one(array('id' => intval($deleted_contact_id), 'policies_id' => $policy_id));
                            $contact_obj->delete();
                        }
                    }

                    foreach ($contacts as $contact) {

                        $contact_id = isset($contact['id']) ? $contact['id'] : 0;
                        $contact_subject = isset($contact['subject']) ? $contact['subject'] : 0;
                        $contact_name = isset($contact['contact_name']) ? $contact['contact_name'] : 0;
                        $contact_phone = isset($contact['phone']) ? $contact['phone'] : 0;
                        $contact_mail = isset($contact['mail']) ? $contact['mail'] : 0;


                        if ($contact_subject && $contact_name && $contact_phone && $contact_mail) {
                            $contact_obj = Orm_Policies_Procedures_Contacts::get_one(array('id' => intval($contact_id), 'policies_id' => $policy_id));
                            $contact_obj->set_policies_id($policy_id);
                            $contact_obj->set_title($contact_subject);
                            $contact_obj->set_contact_name($contact_name);
                            $contact_obj->set_phone($contact_phone);
                            $contact_obj->set_mail($contact_mail);
                            $contact_obj->save();
                        }
                    }
                    Validator::set_success_flash_message(lang('Successfully Saved'));
                    json_response(array('status' => true));
                }

                if (Validator::success()) {
                    json_response(array('status' => true));
                } else {
                    $this->view_params['policy'] = $policy;
                    $this->view_params['policy_id'] = $policy_id;
                    $this->view_params['type'] = $type;
                    $this->view_params['contacts'] = $contacts;
                    json_response(array('status' => false, 'html' => $this->load->view('policies_procedures/policies_form/' . $type, $this->view_params, true)));
                }
            }

            $this->view_params['policy'] = $policy;
            $this->view_params['policy_id'] = $policy_id;
            $this->view_params['type'] = $type;
            $this->view_params['contacts'] = $contacts;

            $html = $this->load->view('policies_procedures/policies_form/' . $type, $this->view_params, true);

            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                json_response(array('status' => false, 'html' => $html));
            } else {
                echo $html;
            }
        } else {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }
    }


    /** view files of policies that attached
    */
    public function view_files($policy_id)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false,
            'policies_procedures-manage');

        if(isset($policy_id)){


            $policy =  Orm_Policies_Procedures::get_instance($policy_id);

            if(!$policy->get_id()){
                Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
                redirect('/');
            }

        $this->breadcrumbs->push(lang('Manage') . ' ' .$policy->get_title(), '/policies_procedures/manage/' . $policy_id);
        $this->breadcrumbs->push(lang('View') . ' ' . lang('Files for') . ' ' .$policy->get_title(), '/policies_procedures/view_files/' . $policy_id);

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Policies & Procedures'),
            'icon' => 'fa  fa-list'
        ), true);

            if (Orm_Policies_Procedures::check_if_can_add()) {
                $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                    'link_attr' => 'data-toggle="ajaxModal" href="/policies_procedures/get_form_file/' . $policy_id . '/forms"',
                    'link_icon' => 'plus',
                    'link_title' => lang('Add New')
                ), true);
            }

            $per_page = $this->config->item('per_page');
            $page = (int)$this->input->get_post('page');
            $fltr = $this->input->get_post('fltr');

            if (!$page) {
                $page = 1;
            }

            $filters = array('policy_id' => $policy_id);

            if (!empty($fltr['keyword'])) {
                $filters['keyword'] = trim($fltr['keyword']);
            }

            $policy_files = Orm_Policies_Procedures_Files::get_all($filters, $page, $per_page);



            $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
            $pager->set_page($page);
            $pager->set_per_page($per_page);
            $pager->set_total_count(Orm_Policies_Procedures_Files::get_count($filters));

            $this->view_params['pager'] = $pager->render(true);
            $this->view_params['fltr'] = $fltr;
            $this->view_params['files'] = $policy_files;
            $this->view_params['policy'] = Orm_Policies_Procedures::get_instance($policy_id);

            $this->layout->view('policies_procedures/file_list', $this->view_params);

        }else{
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }
    }


    /** get form file that filled above and save it in the correct path
     * render it to the same view with parameters
    */
    public function get_form_file($policy_id, $type, $form_id = 0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false,
            'policies_procedures-manage');

        $policy = Orm_Policies_Procedures::get_instance($policy_id);


        if(!$policy->get_id()){
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }


        if (isset($policy_id) && isset($type)){
            $form_file = Orm_Policies_Procedures_Files::get_instance($form_id);

            if ($this->input->server('REQUEST_METHOD') == 'POST') {

                $form_en = $this->input->post('form_en');
                $form_ar = $this->input->post('form_ar');

                $form_file->set_policy_id($policy_id);
                $form_file->set_form_name_ar($form_ar);
                $form_file->set_form_name_en($form_en);


                //validation errors
                Validator::required_field_validator('form_en', $form_en, lang('Please Enter Form Name') . ' ( ' . lang('English') . ' ) ');
                Validator::required_field_validator('form_ar', $form_ar, lang('Please Enter Form Name') . ' ( ' . lang('Arabic') . ' ) ');

                Uploader::validator('file_path', true, $form_file->get_file_path());

                $file_name = 'file_path-' . time();
                $file = Uploader::do_process('file_path', "/files/policies_procedures/forms/{$file_name}");

                if ($file) {
                    $form_file->set_file_path($file);
                }

                if (Validator::success()) {

                    $form_file->save();

                    Validator::set_success_flash_message(lang('Successfully Saved'));
                    json_response(array('status' => true));

                } else {
                    $this->view_params['form_file'] = $form_file;
                    $this->view_params['policy_id'] = $policy_id;
                    json_response(array('status' => false, 'html' => $this->load->view('policies_procedures/policies_form/' . $type, $this->view_params, true)));
                }
            }

            $this->view_params['form_file'] = $form_file;
            $this->view_params['policy_id'] = $policy_id;

            $html = $this->load->view('policies_procedures/policies_form/' . $type, $this->view_params, true);

            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                json_response(array('status' => false, 'html' => $html));
            } else {
                echo $html;
            }
        }else{
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }


    }


    /** download file attached
     * redirect  this function to manage function
     */
    public function download_file($policy_id)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false,
            'policies_procedures-report');

        $policy_file = Orm_Policies_Procedures_Files::get_instance($policy_id);

        $fullPath = rtrim(FCPATH, '/') .$policy_file->get_file_path();
        $data = file_get_contents($fullPath);
        $this->load->helper('download');
        $filename = basename($fullPath);
        force_download($filename, $data);
        redirect('policies_procedures/manage/' . $policy_id);
//
//
//        $policy_file = Orm_Policies_Procedures_Files::get_instance($policy_id);
//        $fullPath = rtrim(FCPATH, '/') . $policy_file->get_file_path();
//        $data = file_get_contents($fullPath);
//
//        $this->load->helper('download');
//
//        $filename = basename($fullPath);
//        force_download($filename, $data);

    }


    /** remove file that attached depending on id
     * redirect it to parent page
     */
    public function remove_file($id)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'policies_procedures-manage');

        $form_file = Orm_Policies_Procedures_Files::get_instance($id);

        if (!$form_file->get_id()) {
            Validator::set_error_flash_message('The resource you requested does not exist!');
            redirect('/');
        }

        if ($form_file->get_id()) {
            $form_file->delete();
        }

        Validator::set_success_flash_message(lang('Successfully Deleted'), true);
        redirect('/policies_procedures/i/' . $form_file->get_policy_id());
    }



    /** view the specific procedure
     * render it in the view page
    */
    public function view($id)
    {

        if(isset($id)){
            $this->breadcrumbs->push(lang('View') . ' ' . Orm_Policies_Procedures::get_instance($id)->get_title(), '/policies_procedures/view/' . $id);


            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'title' => lang('Policies & Procedures'),
                'icon' => 'fa  fa-list'
            ), true);

//        if (Orm_Policies_Procedures::check_if_can_generate_report()) {
//
//            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
//                'link_attr' => ' href="/policies_procedures/downloadpdf/' . $id . '"',
//                'link_title' => lang('Print')
//            ), true);
//        }

            $obj = Orm_Policies_Procedures::get_instance($id);


            if(!$obj->get_id()){
                Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
                redirect('/');
            }

            $this->view_params['policy'] = $obj;
            $this->layout->view('view', $this->view_params);
        }else{
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

    }

/** generate pdf file for procedure
*/
    public function downloadpdf($id)
    {
        if(Orm_Policies_Procedures::check_if_can_generate_report()){
            $policy = Orm_Policies_Procedures::get_instance($id);

            if(!$policy->get_id()){
                Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
                redirect('/');
            }

            $policy->generate_pdf($id);
        }else{
            Validator::set_error_flash_message(lang('Permissions Denied'));
            redirect('/');
        }


    }


}