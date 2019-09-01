<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * @property Breadcrumbs $breadcrumbs
 * Class Dashboard
 */
class Setup extends MX_Controller
{

    /**
     * View Params
     * @var array
     */
    private $view_params = array();

    /**
     * Setup constructor.
     */
    public function __construct()
    {
        parent::__construct();

        Orm_User::check_logged_in();
        $this->view_params['menu_tab'] = 'dashboard_setup';

        $this->breadcrumbs->push(lang('General Info'), '/setup');

        switch (Orm_User::get_logged_user()->get_institution_role()) {
            case Orm_Role::ROLE_INSTITUTION_ADMIN:
                $name = Orm_Institution::get_university_name()?:lang('University Name not set');
                break;

            case Orm_Role::ROLE_COLLEGE_ADMIN:
                $collegeId = Orm_User::get_logged_user()->get_college_id();
                $name = Orm_College::get_instance($collegeId)->get_name()?:lang('College Name not set');
                break;

            case Orm_Role::ROLE_PROGRAM_ADMIN:
                $programId = Orm_User::get_logged_user()->get_program_id();
                $name = Orm_Program::get_instance($programId)->get_name()?:lang('Program Name not set');
                break;
            default:
                if (Orm_User::get_logged_user()->get_program_id()) {
                    $name = Orm_User::get_logged_user()->get_program_obj()->get_name()?:lang('Program Name not set');
                } elseif (Orm_User::get_logged_user()->get_college_id()) {
                    $name = Orm_User::get_logged_user()->get_college_obj()->get_name()?:lang('College Name not set');
                } else {
                    $name = Orm_Institution::get_university_name()?:lang('University Name not set');
                }

        }
     
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('General Info').' - '. $name,
            'icon' => 'fa fa-info'
        ), true);

        if(!Orm_Setup::check_can_access_setup()) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            redirect('/dashboard');
        }
    }

    public function index()
    {
        switch (Orm_User::get_logged_user()->get_institution_role()) {
            case Orm_Role::ROLE_INSTITUTION_ADMIN:
                $id_check = Orm_Institution::get_university_name();
                $type_of_data = 'University';
                break;

            case Orm_Role::ROLE_COLLEGE_ADMIN:
                $id_check = Orm_User::get_logged_user()->get_college_id();
                $type_of_data = 'College';
                break;

            case Orm_Role::ROLE_PROGRAM_ADMIN:
                $id_check = Orm_User::get_logged_user()->get_program_id();
                $type_of_data = 'Program';
                break;
            default:
                if (Orm_User::get_logged_user()->get_program_id()) {
                    $id_check = Orm_User::get_logged_user()->get_program_obj()->get_id();
                    $type_of_data = 'Program';
                } elseif (Orm_User::get_logged_user()->get_college_id()) {
                    $id_check = Orm_User::get_logged_user()->get_college_obj()->get_id();
                    $type_of_data = 'College';
                } else {
                    $id_check = Orm_Institution::get_university_name();
                    $type_of_data = 'University';
                }

        }
        $this->view_params['id_check'] = $id_check;
        $this->view_params['type_of_data'] = $type_of_data;
        
        $this->view_params['setup'] = Orm_Setup::get_instance();
        $this->layout->view('/setup/index', $this->view_params);
    }

    /**
     * @param $class_type
     * @param $type_id
     */
    public function mission_add_edit($class_type, $type_id)
    {
        if(!Orm_User::check_credential(array(Orm_User_Staff::class, Orm_User_Faculty::class), false, 'setup-mission')) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            exit('<script>location.href="/dashboard";</script>');
        }

        if (in_array($class_type, array(
            Orm_Unit_Rector::class,
            Orm_Unit_Vice_Rector::class,
            Orm_Unit_College::class,
            Orm_Unit_Admin::class,
        ))) {
            $class_type = Orm_Unit::class;
        }

        /** @var $class_type Orm_Institution | Orm_Unit | Orm_College | Orm_Program */

        if(!in_array($class_type, array(
            Orm_Institution::class,
            Orm_Unit::class,
            Orm_College::class,
            Orm_Program::class
        ))) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            exit('<script>location.href="/dashboard";</script>');
        }

        $this->view_params['object'] = $class_type::get_instance($type_id);
        $this->load->view('setup/mission/add_edit', $this->view_params);
    }

    public function mission_save()
    {
        if(!Orm_User::check_credential(array(Orm_User_Staff::class, Orm_User_Faculty::class), false, 'setup-mission')) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            json_response(array('error' => TRUE, 'html' => '<script>location.href="/dashboard";</script>'));
        }

        $id = (int)$this->input->post('id');
        $class_type = $this->input->post('class_type');

        if (in_array($class_type, array(
            Orm_Unit_Rector::class,
            Orm_Unit_Vice_Rector::class,
            Orm_Unit_College::class,
            Orm_Unit_Admin::class,
        ))) {
            $class_type = Orm_Unit::class;
        }

        /** @var $class_type Orm_Institution | Orm_Unit | Orm_College | Orm_Program */

        if(!in_array($class_type, array(
            Orm_Institution::class,
            Orm_Unit::class,
            Orm_College::class,
            Orm_Program::class
        ))) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            json_response(array('error' => TRUE, 'html' => '<script>location.href="/dashboard";</script>'));
        }

        $title_ar = $this->input->post('title_arabic');
        $title_en = $this->input->post('title_english');

        // validation
        Validator::required_field_validator('title_arabic', $title_ar, lang('field required'));
        Validator::required_field_validator('title_english', $title_en, lang('field required'));

        $item = $class_type::get_instance($id);
        $item->set_mission_ar($title_ar);
        $item->set_mission_en($title_en);

        if (Validator::success() && $item->get_id()) {
            $item->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));
            json_response(array('error' => FALSE));
        }

        $this->view_params['object'] = $item;

        json_response(array('error' => TRUE, 'html' => $this->load->view('setup/mission/add_edit', $this->view_params, true)));
    }

    /**
     * @param $class_type
     * @param $type_id
     */
    public function vision_add_edit($class_type, $type_id)
    {
        if(!Orm_User::check_credential(array(Orm_User_Staff::class, Orm_User_Faculty::class), false, 'setup-vision')) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            exit('<script>location.href="/dashboard";</script>');
        }

        if (in_array($class_type, array(
            Orm_Unit_Rector::class,
            Orm_Unit_Vice_Rector::class,
            Orm_Unit_College::class,
            Orm_Unit_Admin::class,
        ))) {
            $class_type = Orm_Unit::class;
        }

        /** @var $class_type Orm_Institution | Orm_Unit | Orm_College | Orm_Program */

        if(!in_array($class_type, array(
            Orm_Institution::class,
            Orm_Unit::class,
            Orm_College::class,
            Orm_Program::class
        ))) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            exit('<script>location.href="/dashboard";</script>');
        }

        $this->view_params['object'] = $class_type::get_instance($type_id);
        $this->load->view('setup/vision/add_edit', $this->view_params);
    }

    public function vision_save()
    {
        if(!Orm_User::check_credential(array(Orm_User_Staff::class, Orm_User_Faculty::class), false, 'setup-vision')) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            json_response(array('error' => TRUE, 'html' => '<script>location.href="/dashboard";</script>'));
        }

        $id = (int)$this->input->post('id');
        $class_type = $this->input->post('class_type');

        if (in_array($class_type, array(
            Orm_Unit_Rector::class,
            Orm_Unit_Vice_Rector::class,
            Orm_Unit_College::class,
            Orm_Unit_Admin::class,
        ))) {
            $class_type = Orm_Unit::class;
        }

        /** @var $class_type Orm_Institution | Orm_Unit | Orm_College | Orm_Program */

        if(!in_array($class_type, array(
            Orm_Institution::class,
            Orm_Unit::class,
            Orm_College::class,
            Orm_Program::class
        ))) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            json_response(array('error' => TRUE, 'html' => '<script>location.href="/dashboard";</script>'));
        }

        $title_ar = $this->input->post('title_arabic');
        $title_en = $this->input->post('title_english');

        // validation
        Validator::required_field_validator('title_arabic', $title_ar, lang('field required'));
        Validator::required_field_validator('title_english', $title_en, lang('field required'));

        $item = $class_type::get_instance($id);
        $item->set_vision_ar($title_ar);
        $item->set_vision_en($title_en);

        if (Validator::success() && $item->get_id()) {
            $item->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));
            json_response(array('error' => FALSE));
        }

        $this->view_params['object'] = $item;

        json_response(array('error' => TRUE, 'html' => $this->load->view('setup/vision/add_edit', $this->view_params, true)));
    }

    /**
     * @param $class_type
     * @param $type_id
     * @param int $id
     */
    public function goal_add_edit($class_type, $type_id, $id = 0) {

        if(!Orm_User::check_credential(array(Orm_User_Staff::class, Orm_User_Faculty::class), false, 'setup-goal')) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            exit('<script>location.href="/dashboard";</script>');
        }

        if (in_array($class_type, array(
            Orm_Unit_Rector::class,
            Orm_Unit_Vice_Rector::class,
            Orm_Unit_College::class,
            Orm_Unit_Admin::class,
        ))) {
            $class_type = Orm_Unit::class;
        }

        /** @var $class_type Orm_Institution | Orm_Unit | Orm_College | Orm_Program */

        if(!in_array($class_type, array(
            Orm_Institution::class,
            Orm_Unit::class,
            Orm_College::class,
            Orm_Program::class
        ))) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            exit('<script>location.href="/dashboard";</script>');
        }

        /** @var $class_type_goal Orm_Institution_Goal | Orm_Unit_Goal | Orm_College_Goal | Orm_Program_Goal */
       //
         $class_type_goal = "{$class_type}_Goal";

        $object = $class_type::get_instance($type_id);
        $goal   = $class_type_goal::get_instance($id);

        if($this->input->method() == 'post') {
            $title_ar = $this->input->post('title_arabic');
            $title_en = $this->input->post('title_english');

            // validation
            Validator::required_field_validator('title_arabic', $title_ar, lang('field required'));
            Validator::required_field_validator('title_english', $title_en, lang('field required'));

            $goal->set_reference_id($object->get_id());
            $goal->set_title_ar($title_ar);
            $goal->set_title_en($title_en);

            if (Validator::success() && $object->get_id()) {
                $goal->save();

                Validator::set_success_flash_message(lang('Successfully Saved'));
                exit('<script>window.location.reload();</script>');
            }
        }

        $this->view_params['object'] = $object;
        $this->view_params['goal'] = $goal;

        $this->load->view('setup/goal/add_edit', $this->view_params);
    }

    /**
     * @param $class_type
     * @param $type_id
     * @param $id
     */
    public function goal_delete($class_type, $type_id, $id) {

        if(!Orm_User::check_credential(array(Orm_User_Staff::class, Orm_User_Faculty::class), false, 'setup-goal')) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            redirect('/dashboard');
        }

        if (in_array($class_type, array(
            Orm_Unit_Rector::class,
            Orm_Unit_Vice_Rector::class,
            Orm_Unit_College::class,
            Orm_Unit_Admin::class,
        ))) {
            $class_type = Orm_Unit::class;
        }

        /** @var $class_type Orm_Institution | Orm_Unit | Orm_College | Orm_Program */

        if(!in_array($class_type, array(
            Orm_Institution::class,
            Orm_Unit::class,
            Orm_College::class,
            Orm_Program::class
        ))) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            redirect('/dashboard');
        }

        /** @var $class_type_goal Orm_Institution_Goal | Orm_Unit_Goal | Orm_College_Goal | Orm_Program_Goal */
        $class_type_goal = "{$class_type}_Goal";

        $object = $class_type::get_instance($type_id);
        $goal   = $class_type_goal::get_instance($id);

        if($object->get_id() && $goal->get_id()) {
            $goal->delete();

            Validator::set_success_flash_message(lang('Successfully Deleted'));
        }

        redirect($this->input->server('HTTP_REFERER'));
    }

    /**
     * @param $class_type
     * @param $type_id
     * @param int $id
     */
    public function objective_add_edit($class_type, $type_id, $id = 0) {

        if(!Orm_User::check_credential(array(Orm_User_Staff::class, Orm_User_Faculty::class), false, 'setup-objective')) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            exit('<script>location.href="/dashboard";</script>');
        }

        if (in_array($class_type, array(
            Orm_Unit_Rector::class,
            Orm_Unit_Vice_Rector::class,
            Orm_Unit_College::class,
            Orm_Unit_Admin::class,
        ))) {
            $class_type = Orm_Unit::class;
        }

        /** @var $class_type Orm_Institution | Orm_Unit | Orm_College | Orm_Program */

        if(!in_array($class_type, array(
            Orm_Institution::class,
            Orm_Unit::class,
            Orm_College::class,
            Orm_Program::class
        ))) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            exit('<script>location.href="/dashboard";</script>');
        }

        /** @var $class_type_objective Orm_Institution_Objective | Orm_Unit_Objective | Orm_College_Objective | Orm_Program_Objective */
        $class_type_objective = "{$class_type}_Objective";

        $object = $class_type::get_instance($type_id);
        $objective   = $class_type_objective::get_instance($id);

        if($this->input->method() == 'post') {
            $title_ar = $this->input->post('title_arabic');
            $title_en = $this->input->post('title_english');

            // validation
            Validator::required_field_validator('title_arabic', $title_ar, lang('field required'));
            Validator::required_field_validator('title_english', $title_en, lang('field required'));

            $objective->set_reference_id($object->get_id());
            $objective->set_title_ar($title_ar);
            $objective->set_title_en($title_en);

            if (Validator::success() && $object->get_id()) {
                $objective->save();

                Validator::set_success_flash_message(lang('Successfully Saved'));
                exit('<script>window.location.reload();</script>');
            }
        }

        $this->view_params['object'] = $object;
        $this->view_params['objective'] = $objective;

        $this->load->view('setup/objective/add_edit', $this->view_params);
    }

    /**
     * @param $class_type
     * @param $type_id
     * @param $id
     */
    public function objective_delete($class_type, $type_id, $id) {

        if(!Orm_User::check_credential(array(Orm_User_Staff::class, Orm_User_Faculty::class), false, 'setup-objective')) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            redirect('/dashboard');
        }

        if (in_array($class_type, array(
            Orm_Unit_Rector::class,
            Orm_Unit_Vice_Rector::class,
            Orm_Unit_College::class,
            Orm_Unit_Admin::class,
        ))) {
            $class_type = Orm_Unit::class;
        }

        /** @var $class_type Orm_Institution | Orm_Unit | Orm_College | Orm_Program */

        if(!in_array($class_type, array(
            Orm_Institution::class,
            Orm_Unit::class,
            Orm_College::class,
            Orm_Program::class
        ))) {
            Validator::set_error_flash_message(lang("Error: You Don't have Permission"));
            redirect('/dashboard');
        }

        /** @var $class_type_objective Orm_Institution_Objective | Orm_Unit_Objective | Orm_College_Objective | Orm_Program_Objective */
        $class_type_objective = "{$class_type}_Objective";

        $object = $class_type::get_instance($type_id);
        $objective   = $class_type_objective::get_instance($id);

        if($object->get_id() && $objective->get_id()) {
            $objective->delete();

            Validator::set_success_flash_message(lang('Successfully Deleted'));
        }

        redirect($this->input->server('HTTP_REFERER'));
    }
}