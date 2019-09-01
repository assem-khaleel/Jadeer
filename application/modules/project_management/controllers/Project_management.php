<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Config $config
 * Class Project_management
 */

/**
 * Class Project_management
 * Two types of project to manage
 * - Strategic plan projects type = 0
 * - Customized projects type = 1
 */
class Project_management extends MX_Controller {

    private $view_params = array();
    private $current_id;
    private $user_class;
    public function __construct() {

        parent::__construct();

        Orm_User::check_logged_in();

        if(!License::get_instance()->check_module('project_management', true)) {
            show_404();
        }

        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'project_management-list');

        Modules::load('strategic_planning');

        $this->current_id = Orm_User::get_logged_user_id();
        $this->user_class = Orm_User::get_instance($this->current_id)->get_class_type();

        $this->breadcrumbs->push(lang('Project Management'), '/project_management');

        $this->view_params['sub_menu'] = 'project_management/sub_menu';
        $this->view_params['menu_tab'] = 'project_management';
        $this->view_params['type'] = "0";
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Project Management'),
            'icon' => 'fa fa-tasks',
        ), true);
    }

    /** index page for project management and redirect it to strategic projects or customized  depending on authorization
     * render it in home view
    */
    public function index() {

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');

        if (!$page) {
            $page = 1;
        }

        if (Orm_User::has_role_teacher()){
            Validator::set_error_flash_message(lang("You Havn't Permissions to enter page"));
            redirect('project_management/assigned_sub_phases');
        }

        if($this->user_class == "Orm_User_Staff"){
            $user_unit = Orm_User_Staff::get_instance($this->current_id)->get_unit_id();
            $userRoleObj = Orm_User::get_instance($this->current_id)->get_role_obj();

            if($userRoleObj->get_admin_level() == 5){
                $action_plans = Orm_Sp_Action_Plan::get_all(['has_project' => true]);
            }else{
                $action_plans = Orm_Sp_Action_Plan::get_all(['responsible_id_in' => [$user_unit ,0]]);
            }
            $action_plans_ids = [];
            foreach ($action_plans as $action_plan){

                if($action_plan->get_responsible_id() != 0){
                    $action_plans_ids[] = $action_plan->get_id();
                }elseif($userRoleObj->get_admin_level() == 5){
                    $action_plans_ids[] = $action_plan->get_id();
                }
            }
            $fillter = ['action_plan_id_in' => $action_plans_ids] ;
            $sp_projects  = Orm_Sp_Project::get_all($fillter, $page , $per_page);
            $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
            $pager->set_page($page);
            $pager->set_per_page($per_page);
            $pager->set_total_count(Orm_Sp_Project::get_count($fillter));
            $this->view_params['pager'] = $pager->render(true);
        }else{
            //faculty users can't manage strategic plan projects because they are not related to unit
            $sp_projects = '';
        }

        $this->view_params['projects'] = $sp_projects;

        $this->layout->view('home',$this->view_params);
    }

    /** list customized projects i have depending on user authorization if admin will enter else will get user_id
     *  render it in list view
    */
    public function customized_projects(){

        if(Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'project_management-manage')){
            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'link_attr' => 'href="/project_management/create_project" data-toggle="ajaxModal"',
                'link_icon' => 'plus',
                'link_title' => lang('Create new project')
            ), true);
        }

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');


        if (!$page) {
            $page = 1;
        }

        if (Orm_User::has_role_teacher()){
            Validator::set_error_flash_message(lang("You Havn't Permissions to enter page"));
            redirect('project_management/assigned_sub_phases');
        }
        $filters = array();
        if (!empty($fltr['project'])) {
            $filters = array('name' => Orm_Pm_Project::FETCH_OBJECTS);
        }

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $userRoleObj = Orm_User::get_instance($this->current_id)->get_role_obj();

        if($userRoleObj->get_admin_level() == Orm_Role::ROLE_INSTITUTION_ADMIN){
            $customizedProjects  = Orm_Pm_Project::get_all($filters , $page , $per_page);
        }else{
            $customizedProjects  = Orm_Pm_Project::get_all(['responsible_id' => $this->current_id] , $page , $per_page,$filters);
        }

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Sp_Project::get_count());


        $this->view_params['projects'] = $customizedProjects;
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['type'] = "1";
        $this->view_params['fltr']=$fltr;
        $this->layout->view('list',$this->view_params);
    }

    /** filter customized project from the above function
     * render it in home view
    */
    public function filterCustomized()
    {
            $this->customized_projects();
            $this->load->view('home', $this->view_params);
    }

    /** manage two types of phases that belong under two projects depending on type
     * render it in manage_phases view
    */
    public function manage_phases(){
        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url_path = parse_url($actual_link , PHP_URL_PATH);
        $path_element = explode("/", $url_path);
        $project_id = (isset($path_element[3]))?$path_element[3]:0; //get project id from url
        $type = (isset($path_element[4]))?$path_element[4]:0; //get project type from url

         Orm_Pm_Project::end_date(Orm_Pm_Project::get_instance($project_id)->get_end_date());

        if($type == '0'){
            $project = Orm_Sp_Project::get_instance($project_id);
            if($project->get_id() == 0){
                Validator::set_error_flash_message(lang("There's no project!"));
                redirect('/');
            }
        }elseif($type == '1'){
            $project = Orm_Pm_Project::get_instance($project_id);
            if($project->get_id() == 0){
                Validator::set_error_flash_message(lang("There's no project!"));
                redirect('/');
            }
        }else{
            Validator::set_error_flash_message(lang("There's no type of project belong to your request!"));
            redirect('/');
        }

        if(Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'project_management-manage')){
            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'link_attr' => 'href="/project_management/add_edit?project_id='.$project_id.'&project_type='.$type.'" data-toggle="ajaxModal"',
                'link_icon' => 'plus',
                'link_title' => lang('Create new phase')
            ), true);
        }else{
            Validator::set_error_flash_message(lang("Permission denied"));
            redirect('/');
        }

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');

        if (!$page) {
            $page = 1;
        }

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Pm_Project_Phase::get_count(['project_id' => $project->get_id() , 'project_type' =>$type]));

        $phases = Orm_Pm_Project_Phase::get_all(['project_id' => $project->get_id() , 'project_type' =>$type], $page , $per_page);
        $this->view_params['phases'] = $phases;
        $this->view_params['project'] = $project;
        $this->view_params['type'] = $type;
        $this->view_params['pager'] = $pager->render(true);
        $this->breadcrumbs->push(lang('Manage phases'), '/project_management/manage_phases');
        $this->layout->view('manage_phases' , $this->view_params);
    }

    /** add phases or edit if exist depending on project type
     * render it in add_edit view
    */
    public function add_edit($phase_id = 0){
        $check_credential =  Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY ), false, 'project_management-manage');
        if(!$check_credential){
            Validator::set_error_flash_message(lang('Error: Permission Denied!'));
            exit('<script>document.location.href="/";</script>');
        }

        if(!$this->input->is_ajax_request()){
            Validator::set_error_flash_message(lang('Bad request please try again!'));
            exit('<script>document.location.href="/";</script>');
        }
        $project_id = $this->input->get('project_id');
        $project_type = $this->input->get('project_type');

        if($project_type == '0'){
            $project = Orm_Sp_Project::get_instance($project_id);

            if($project->get_id() == 0){
                Validator::set_error_flash_message(lang("There's no project!"));
                redirect('/');
            }
        }elseif($project_type == '1'){
            $project = Orm_Pm_Project::get_instance($project_id);
            if($project->get_id() == 0){
                Validator::set_error_flash_message(lang("There's no project!"));
                redirect('/');
            }
        }else{
            Validator::set_error_flash_message(lang("There's no type of project belong to your request!"));
            redirect('/');
        }
        $phase = Orm_Pm_Phase::get_instance($phase_id);

        if($phase_id != 0){
            if($phase->get_id() != 0){
                $data['phase'] = $phase;
            }else{
                Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
                exit('<script>document.location.href="/";</script>');
            }
        }else{
            $data['phase'] = $phase;
        }

        $data['project_id'] = $project_id;
        $data['project_type'] = $project_type;
        $data['phase_id'] = $phase_id;

        $this->load->view('add_edit',$data);
    }

    /** save project depending onm project type
     * render json response
    */
    public function save(){
        $check_credential =  Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'project_management-manage');
        if(!$check_credential){
            Validator::set_error_flash_message(lang('Error: Permission Denied!'));
            exit('<script>document.location.href="/";</script>');
        }
        if(!$this->input->is_ajax_request()){
            Validator::set_error_flash_message(lang('Bad request please try again!'));
            exit('<script>document.location.href="/";</script>');
        }
        $title_en = $this->input->post('title_en');
        $title_ar = $this->input->post('title_ar');
        $desc_en = $this->input->post('desc_en');
        $desc_ar = $this->input->post('desc_ar');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $project_id = $this->input->post('project_id');
        $project_type = $this->input->post('project_type');
        $phase_id = $this->input->post('phase_id');

        /* Validator Start*/
        Validator::required_field_validator('title_en',$title_en,lang('Invalid phase name') . ' ( ' . lang('English').' ) ');
        Validator::required_field_validator('title_ar',$title_ar,lang('Invalid phase name') . ' ( ' . lang('Arabic').' ) ');

        Validator::date_format_validator('start_date', $start_date, lang('Required Start Date'));
        Validator::date_format_validator('end_date', $end_date, lang('Required End Date'));
        /*Validator End*/

        $phase = Orm_Pm_Phase::get_instance($phase_id);

        $phase->set_title_en($title_en);
        $phase->set_title_ar($title_ar);
        $phase->set_desc_en($desc_en);
        $phase->set_desc_ar($desc_ar);
        $phase->set_start_date($start_date);
        $phase->set_end_date($end_date);

        if($project_type == 0){
            $project = Orm_Sp_Project::get_instance($project_id);
        }else{
            $project = Orm_Pm_Project::get_instance($project_id);
        }

        if($start_date < $project->get_start_date()) {
            Validator::set_error('start_date', lang('Start Date must be on or after') . ' ' . $project->get_start_date());
        }

        if($start_date > $project->get_end_date()) {
            Validator::set_error('start_date', lang('Start Date must be on or before') . ' ' . $project->get_end_date());
        }
        if($end_date < $project->get_start_date()) {
            Validator::set_error('end_date', lang('End Date must be on or before') . ' ' . $project->get_start_date());
        }

        if($end_date > $project->get_end_date()) {
            Validator::set_error('end_date', lang('End Date must be on or before') . ' ' . $project->get_end_date());
        }
        if($end_date < $start_date && $end_date < $project->get_end_date()){
            Validator::set_error('end_date', lang('End Date must be on or after') . ' ' . $start_date);
        }
        if($phase->get_id() != 0){
            $phase_subPhases = Orm_Pm_Sub_Phase::get_all(['phase_id' => $phase->get_id()]);
            foreach ($phase_subPhases as $phase_subPhase){
                if($start_date > $phase_subPhase->get_start_date()) {
                    Validator::set_error('start_date', lang('This phase has sub-phase/s with start date less than selected date'));
                }
                if($end_date < $phase_subPhase->get_end_date()) {
                    Validator::set_error('end_date', lang('This phase has sub-phase/s with end date bigger than selected date'));
                }
            }
        }
        if(Validator::success()){
            $phase_id = $phase->save();
            $project_phase = Orm_Pm_Project_Phase::get_one(['phase_id' => $phase_id , 'project_id' => $project_id]);
            if($project_phase->get_id() == 0){
                $project_phase->set_phase_id($phase_id);
                $project_phase->set_project_id($project_id);
                $project_phase->set_project_type($project_type);
                $project_phase->save();
            }
            Validator::set_success_flash_message(lang('Project Saved Successfully'));
            json_response(array('error' => FALSE));
        }
        $this->view_params['phase'] = $phase;
        $this->view_params['project_id'] = $project_id;
        $this->view_params['project_type'] = $project_type;
        $this->view_params['phase_id'] = $phase_id;
        json_response(array('error' => true, 'html' => $this->load->view('add_edit', $this->view_params, true)));
    }

    /** delete sub phase for customized projects if exist
    */
    public function delete_phase($phase_id = 0){
        $check_credential =  Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'project_management-manage');
        if(!$check_credential){
            Validator::set_error_flash_message(lang('Error: Permission Denied!'));
            exit('<script>document.location.href="/";</script>');
        }
        if(!$this->input->is_ajax_request()){
            Validator::set_error_flash_message(lang('Bad request please try again!'));
            exit('<script>document.location.href="/";</script>');
        }
        $phase = Orm_Pm_Phase::get_instance($phase_id);
        $project_phase = Orm_Pm_Project_Phase::get_one(['phase_id' => $phase_id]);
        $sub_phase=Orm_Pm_Sub_Phase::get_count(['phase_id'=>$phase_id]);
        if($sub_phase == 0) {
            if ($phase->get_id() != 0) {
                $phase->delete();
                $project_phase->delete();
                Validator::set_success_flash_message(lang('Deleted Successfully'));
            }
        }else{
            Validator::set_error_flash_message(lang('Delete related Sub Phase First'));
        }

    }

    /** create project after validation
     * render it in add_edit_project
    */
    public function create_project($project_id = 0){
        $check_credential =  Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'project_management-manage');
        if(!$check_credential){
            Validator::set_error_flash_message(lang('Error: Permission Denied!'));
            exit('<script>document.location.href="/";</script>');
        }
        if(!$this->input->is_ajax_request()){
            Validator::set_error_flash_message(lang('Bad request please try again!'));
            exit('<script>document.location.href="/";</script>');
        }

        Orm_Pm_Project::end_date(Orm_Pm_Project::get_instance($project_id)->get_end_date());

        if($project_id != 0){
            $project = Orm_Pm_Project::get_instance($project_id);
            if($project->get_id() != 0){
                $data['project'] = $project;
            }else{
                Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
                exit('<script>document.location.href="/";</script>');
            }
        }else{
            $project = Orm_Pm_Project::get_instance($project_id);
            $data['project'] = $project;
        }
        $this->load->view('add_edit_project' , $data);
    }
    /** save project after creation it and validate it
     * back with json response
    */
    public function save_project(){
        $check_credential =  Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'project_management-manage');
        if(!$check_credential){
            Validator::set_error_flash_message(lang('Error: Permission Denied!'));
            exit('<script>document.location.href="/";</script>');
        }

        if(!$this->input->is_ajax_request()){
            Validator::set_error_flash_message(lang('Bad request please try again!'));
            exit('<script>document.location.href="/";</script>');
        }
        $title_en = $this->input->post('title_en');
        $title_ar = $this->input->post('title_ar');
        $desc_en = $this->input->post('desc_en');
        $desc_ar = $this->input->post('desc_ar');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $budget = $this->input->post('budget');
        $resources = $this->input->post('resources');
        $project_id = $this->input->post('project_id');

        /* Validator Start*/
        Validator::required_field_validator('title_en',$title_en,lang('Invalid phase name') . ' ( ' . lang('English').' ) ');
        Validator::required_field_validator('title_ar',$title_ar,lang('Invalid phase name') . ' ( ' . lang('Arabic').' ) ');

        Validator::date_format_validator('start_date', $start_date, lang('Required Start Date'));
        Validator::date_format_validator('end_date', $end_date, lang('Required End Date'));
        Validator::numeric_field_validator('budget', $budget, lang('Budget should hold a numeric value'));
        /*Validator End*/

        $project = Orm_Pm_Project::get_instance($project_id);

        $project->set_title_en($title_en);
        $project->set_title_ar($title_ar);
        $project->set_desc_en($desc_en);
        $project->set_desc_ar($desc_ar);
        $project->set_start_date($start_date);
        $project->set_end_date($end_date);
        $project->set_budget($budget);
        $project->set_resources($resources);
        $project->set_responsible_id($this->current_id);

        if($project->get_id() != 0){
            $phasesArray = [];
            $projectPhases = Orm_Pm_Project_Phase::get_all(['project_id' => $project->get_id()]);
            foreach ($projectPhases as $projectPhase){
                $phasesArray[] = $projectPhase->get_phase_id();
            }
            $phases = Orm_Pm_Phase::get_all(['in_id' => $phasesArray]);
            foreach ($phases as $phase){
                if($start_date > $phase->get_start_date()) {
                    Validator::set_error('start_date', lang('This project has phase/s with start date less than selected date'));
                }
                if($end_date < $phase->get_end_date()) {
                    Validator::set_error('end_date', lang('This project has phase/s with end date bigger than selected date'));
                }
            }
        }

        if($end_date < $start_date){
            Validator::set_error('end_date', lang('End Date must be on or after') . ' ' . $start_date);
        }

        (!empty($budget))?:0;
        if($budget < 0){
            Validator::set_error('budget', lang('The budget value can not be less than 0'));
        }
        if(Validator::success()){
            $project->save();
            Validator::set_success_flash_message(lang('Project Saved Successfully'));
            json_response(array('error' => FALSE));
        }
        $this->view_params['project'] = $project;
        json_response(array('error' => true, 'html' => $this->load->view('add_edit_project', $this->view_params, true)));
    }
    /** delete project and check if has no phases delete
     *
    */
    public function delete_project($projrct_id = 0 ,$type = 1){
        $check_credential =  Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'project_management-manage');
        if(!$check_credential){
            Validator::set_error_flash_message(lang('Error: Permission Denied!'));
            exit('<script>document.location.href="/";</script>');
        }
        if(!$this->input->is_ajax_request()){
            Validator::set_error_flash_message(lang('Bad request please try again!'));
            exit('<script>document.location.href="/";</script>');
        }

        $project = Orm_Pm_Project::get_instance($projrct_id);

        $phase=Orm_Pm_Project_Phase::get_count(['project_id'=>$projrct_id]);
        if($phase == 0) {
            if ($project->get_id() != 0) {
             $project->delete();
            }
            Validator::set_success_flash_message(lang('Deleted Successfully'));

            }else{
            Validator::set_error_flash_message(lang('Delete related Phase First'));

        }

    }
    /** manage sub phases and see who has authorization to access sub phases
     * render in manage_subPhases view
    */
    public function manage_sub_phases(){

        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url_path = parse_url($actual_link , PHP_URL_PATH);
        $path_element = explode("/", $url_path);
        $phase_id = (isset($path_element[3]))?$path_element[3]:0; //get phase id from url
        $project_id = (isset($path_element[4]))?$path_element[4]:0; //get project id from url
        $type = (isset($path_element[5]))?$path_element[5]:0; //get project type from url

        if(Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'project_management-manage')){
            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'link_attr' => 'href="/project_management/add_edit_sub_phase/'.$phase_id.'/0" data-toggle="ajaxModal"',
                'link_icon' => 'plus',
                'link_title' => lang('Create new sub-phase')
            ), true);
        }else{
            Validator::set_error_flash_message(lang("Permission Denied"));
            redirect('/');
        }

        if($type == '0'){
            $project = Orm_Sp_Project::get_instance($project_id);

            if($project->get_id() == 0){
                Validator::set_error_flash_message(lang("There's no project!"));
                redirect('/');
            }
        }elseif($type == '1'){
            $project = Orm_Pm_Project::get_instance($project_id);
            if($project->get_id() == 0){
                Validator::set_error_flash_message(lang("There's no project!"));
                redirect('/');
            }
        }else{
            Validator::set_error_flash_message(lang("There's no type of project belong to your request!"));
            redirect('/');
        }

        $phase = Orm_Pm_Phase::get_instance($phase_id);

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');

        if (!$page) {
            $page = 1;
        }

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Pm_Sub_Phase::get_count(['phase_id' => $phase_id]));

        $phases = Orm_Pm_Sub_Phase::get_all(['phase_id' => $phase_id], $page , $per_page);

        $this->view_params['sub_phases'] = $phases;
        $this->view_params['phase'] = $phase;
        $this->view_params['project'] = $project;
        $this->view_params['type'] = $type;
        $this->view_params['pager'] = $pager->render(true);

        $this->breadcrumbs->push(lang('Manage phases'), '/project_management/manage_phases/'.$project_id.'/'.$type);
        $this->breadcrumbs->push(lang('Manage sub-phases'), '/project_management/manage_sub_phases');

        $this->layout->view('manage_subPhases',$this->view_params);
    }
    /** add or edit sub phase for phases if exit
     * render it in add_edit_sub_phase view
    */
    public function add_edit_sub_phase($phase_id = 0 , $sub_phase_id = 0 , $isEditedByResponsible = false){
        $check_credential =  Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'project_management-manage');

        if(!$check_credential){
            Validator::set_error_flash_message(lang('Error: Permission Denied!'));
            exit('<script>document.location.href="/";</script>');
        }
        if(!$this->input->is_ajax_request()){
            Validator::set_error_flash_message(lang('Bad request please try again!'));
            exit('<script>document.location.href="/";</script>');
        }
        $sub_phase = Orm_Pm_Sub_Phase::get_instance($sub_phase_id);
        if($sub_phase_id != 0 ){
            if($sub_phase->get_id() == 0){
                Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
                exit('<script>document.location.href="/";</script>');
            }
        }
        $phase_idObj = Orm_Pm_Phase::get_instance($phase_id)->get_id();
        if($phase_id != 0){
            if($phase_idObj == 0){
                Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
                exit('<script>document.location.href="/";</script>');
            }
        }

        $data['phase'] = $sub_phase;
        $data['phase_id'] = $phase_idObj;
        if($isEditedByResponsible){
            $data['edited_by_responsible'] = true;
        }
        $this->load->view('add_edit_sub_phase' , $data);
    }
    /** save sub-phase after make a validation
     * back with json response
    */
    public function save_sub_phase($editedByResponsible = false){
        $check_credential =  Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'project_management-manage');
        if(!$check_credential){
            Validator::set_error_flash_message(lang('Error: Permission Denied!'));
            exit('<script>document.location.href="/";</script>');
        }
        if(!$this->input->is_ajax_request()){
            Validator::set_error_flash_message(lang('Bad request please try again!'));
            exit('<script>document.location.href="/";</script>');
        }
        $title_en = $this->input->post('title_en');
        $title_ar = $this->input->post('title_ar');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $desc_en = $this->input->post('desc_en');
        $desc_ar = $this->input->post('desc_ar');
        $phase_id = $this->input->post('phase_id');
        $sub_phase_id = $this->input->post('sub_phase_id');
        $responsible_id = $this->input->post('user_ids');
        ($sub_phase_id)?:0;

        /* Validator Start*/
        Validator::required_field_validator('title_en',$title_en,lang('Invalid sub-phase name') . ' ( ' . lang('English').' ) ');
        Validator::required_field_validator('title_ar',$title_ar,lang('Invalid sub-phase name') . ' ( ' . lang('Arabic').' ) ');
        Validator::required_field_validator('user_ids',$title_ar,lang('Invalid sub-phase responsible'));

        Validator::date_format_validator('start_date', $start_date, lang('Required Start Date'));
        Validator::date_format_validator('end_date', $end_date, lang('Required End Date'));
        /*Validator End*/

        $phaseObj = Orm_Pm_Phase::get_instance($phase_id);

        if($start_date < $phaseObj->get_start_date()) {
            Validator::set_error('start_date', lang('Start Date must be on or after') . ' ' . $phaseObj->get_start_date());
        }

        if($start_date > $phaseObj->get_end_date()) {
            Validator::set_error('start_date', lang('Start Date must be on or before') . ' ' . $phaseObj->get_end_date());
        }
        if($end_date < $phaseObj->get_start_date()) {
            Validator::set_error('end_date', lang('End Date must be on or before') . ' ' . $phaseObj->get_end_date());
        }

        if($end_date > $phaseObj->get_end_date()) {
            Validator::set_error('end_date', lang('End Date must be on or before') . ' ' . $phaseObj->get_end_date());
        }
        if($end_date < $start_date && $end_date < $phaseObj->get_end_date()){
            Validator::set_error('end_date', lang('End Date must be on or after') . ' ' . $start_date);
        }

        $sub_phase = Orm_Pm_Sub_Phase::get_instance($sub_phase_id);

        $sub_phase->set_title_en($title_en);
        $sub_phase->set_title_ar($title_ar);
        $sub_phase->set_start_date($start_date);
        $sub_phase->set_end_date($end_date);
        $sub_phase->set_desc_en($desc_en);
        $sub_phase->set_desc_ar($desc_ar);
        $sub_phase->set_phase_id($phase_id);
        $sub_phase->set_responsible($responsible_id);
        if($editedByResponsible){
            $sub_phase->set_is_complete($this->input->post('progress'));
        }
        if(Validator::success()){
            $sub_phase->save();

            Validator::set_success_flash_message(lang('Saved Successfully'));
            json_response(array('error' => FALSE));
        }
        $this->view_params['phase'] = $sub_phase;
        $this->view_params['phase_id'] = $phase_id;
        if($editedByResponsible){
            $this->view_params['edited_by_responsible'] = true;
        }
        json_response(array('error' => true, 'html' => $this->load->view('add_edit_sub_phase', $this->view_params, true)));

    }
    /** delete sub phase if exist
    */
    public function delete_sub_phase($sub_phase_id = 0){
        $check_credential =  Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'project_management-manage');
        if(!$check_credential){
            Validator::set_error_flash_message(lang('Error: Permission Denied!'));
            exit('<script>document.location.href="/";</script>');
        }
        if(!$this->input->is_ajax_request()){
            Validator::set_error_flash_message(lang('Bad request please try again!'));
            exit('<script>document.location.href="/";</script>');
        }
        $sub_phase = Orm_Pm_Sub_Phase::get_instance($sub_phase_id);
        if($sub_phase->get_id() != 0){
            $sub_phase->delete();
        }else{
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            exit('<script>document.location.href="/";</script>');
        }
        Validator::set_success_flash_message(lang('Deleted Successfully'));
    }
    /** draw charts for the project depending on project type
     *
    */
    public function display_project_chart($project_id = 0 , $type , $is_pdf = false){
        $check_credential =  Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'project_management-report');
        if(!$check_credential){
            Validator::set_error_flash_message(lang('Error: Permission Denied!'));
            if($is_pdf){
                exit('<script>document.location.href="/";</script>');
            }else{
                redirect('/');
            }
        }
        if($type == '0'){
            $project = Orm_Sp_Project::get_instance($project_id);

            if($project->get_id() == 0){
                Validator::set_error_flash_message(lang("There's no project!"));
                redirect('/');
            }
        }elseif($type == '1'){
            $project = Orm_Pm_Project::get_instance($project_id);
            if($project->get_id() == 0){
                Validator::set_error_flash_message(lang("There's no project!"));
                redirect('/');
            }
        }else{
            Validator::set_error_flash_message(lang("There's no type of project belong to your request!"));
            redirect('/');
        }
        $this->view_params['type'] = $type;

        $this->layout->add_javascript('/assets/jadeer/js/gantt-master/codebase/dhtmlxgantt.js');
        $this->layout->add_stylesheet('/assets/jadeer/js/gantt-master/codebase/dhtmlxgantt.css');

        $this->breadcrumbs->push(lang('Display Project Progress'), '/project_management/display_project_chart/'.$project_id.'/'.$type);

        $fillter = ['project_id' => $project_id , 'project_type' => $type];

        $phasesAndSubphases = Orm_Pm_Phase::gantt_chart_data($fillter);
        $days = json_decode($phasesAndSubphases);
        $days = $days->data[0]->duration;
        $this->view_params['data'] = $phasesAndSubphases;
        $this->view_params['project'] = $project;
        $this->view_params['days'] = $days;
        if($is_pdf == true){
            Orm::get_ci()->layout->content_as_html(true);
            Orm::get_ci()->layout->set_layout('layout_pdf');
            Orm::get_ci()->layout->add_javascript('https://code.jquery.com/jquery-2.2.4.min.js' , false);
            Orm::get_ci()->layout->add_javascript('/assets/jadeer/js/gantt-master/codebase/dhtmlxgantt.js');

            $content = Orm::get_ci()->load->view('project_management/display_project_chart_pdf', $this->view_params, true);

            $html = Orm::get_ci()->layout->view($content,array(),true);
            return $html;
        }else{
            $this->layout->view('display_project_chart' , $this->view_params);
        }
    }

    /** check user if can export project report as pdf page
    */
    public function export_as_pdf($project_id = 0 , $type){
        if(Orm_Pm_Project::check_if_can_generate_report()){
            $report_content = $this->display_project_chart($project_id , $type , true);
            return Orm_Pm_Project::generate_pdf($project_id , $type , $report_content);
        }else{
            Validator::set_error_flash_message(lang('Error: Permission Denied!'));
            redirect('/');
        }
    }
    /** list sunphases depending on user role
     * render it in list_sub_phase view
    */
    public function assigned_sub_phases(){
        $this->view_params['type'] = 2;
        $fillter = ['responsible' => $this->current_id];
        $this->breadcrumbs->push(lang('Assigned sub-phases'), '/project_management/assigned_sub_phases');

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');

        $fltr = $this->input->get_post('fltr');

        if (!empty($fltr['keyword'])) {
            $fillter['keyword'] = trim($fltr['keyword']);
        }

        if (!$page) {
            $page = 1;
        }

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Pm_Sub_Phase::get_count($fillter));

        $assignToMePhases = Orm_Pm_Sub_Phase::get_all($fillter , $page , $per_page);
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['assignToMePhases'] = $assignToMePhases;
        $this->view_params['fltr']=$fltr;
        $this->layout->view('list_sub_phase' , $this->view_params);
    }

    /** filter sub-phases and get it from the above function
     * render it in assigned_to_me_phases view
    */
    public function filtersubPhase(){
        $this->assigned_sub_phases();
        $this->load->view('assigned_to_me_phases', $this->view_params);
    }

}