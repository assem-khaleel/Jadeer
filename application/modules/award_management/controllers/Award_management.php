<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Config $config
 * Class Award_management
 */
class Award_management extends MX_Controller
{

    private $view_params = array();
    private $logged_user;

    public function __construct()
    {

        parent::__construct();

        Orm_User::check_logged_in();

        $this->logged_user = Orm_User::get_logged_user();

        if (!License::get_instance()->check_module('award_management', true)) {
            show_404();
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Award Management'),
            'icon' => 'fa fa-list'
        ), true);



        $this->view_params['menu_tab'] = 'award_management';

        $this->breadcrumbs->push(lang('Award Management'), '/award_management');

    }

    /**Award General List
     * get filters and all awards from table with pagination too
     *
     */
    private function get_list()
    {
        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        if (!empty($fltr['institution'])) {
            $filters['level'] = Orm_Wa_Award::INSTITUTION_LEVEL;
        }
        if (!empty($fltr['college_id']) && $fltr['college_id'] > 0) {
            $filters['level'] = Orm_Wa_Award::COLLEGE_LEVEL;
            $filters['level_id'] = $fltr['college_id'];
        }
        if (!empty($fltr['program_id']) && $fltr['program_id'] > 0) {
            $filters['level'] = Orm_Wa_Award::PROGRAM_LEVEL;
            $filters['level_id'] = $fltr['program_id'];
        }
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }
        if ($this->logged_user->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {
            $filters['level'] = Orm_Wa_Award::COLLEGE_LEVEL;
            $filters['level_id']=$this->logged_user->get_college_id();
        }

        if ($this->logged_user->has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
            $filters['level'] = Orm_Wa_Award::PROGRAM_LEVEL;
            $filters['level_id']=$this->logged_user->get_program_id();
        }
        if (!$this->logged_user->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)) {
            $filters['user_id'] = $this->logged_user->get_id();
        }

        if ($this->logged_user->has_role_type(Orm_Role::ROLE_NOT_ADMIN)) {
            $filters['winner_id'] =$this->logged_user->get_id();
            $filters['candidate_id']= $this->logged_user->get_id();
        }

        $awards = Orm_Wa_Award::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Wa_Award::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['awards'] = $awards;
        $this->view_params['fltr'] = $fltr;
    }

    /**Award index page
     * index page that get all lists of awards from get_list function above and render them in list view
     *
     */
    public function index()
    {
        if (Orm_User::has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN) || Orm_User::has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN) || Orm_User::has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {

            if (Orm_User::check_credential([Orm_User_Faculty::class, Orm_User_Staff::class], false, 'award_management-manage')) {
                $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                    'link_attr' => 'href="/award_management/add_edit" data-toggle="ajaxModal"',
                    'link_title' => lang('Add New'),
                    'link_icon' => 'plus'
                ), true);
            }
        }

        if (Orm_User::get_logged_user()->get_class_type() == Orm_User_Student::class) {
            $this->winner();

        } else {
            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'menu_view' => 'award_management/sub_menu',
                'menu_params' => array('type' => 'settings')
            ), true);
            $this->get_list();

            $this->layout->view('list', $this->view_params);
        }
    }
    /**Award index page
     *
     * filter request if it's ajax will render it in data_table view  else that wool redirect it to index page
     *
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


    /**Award add_edit page
     * function to open ajax window for add or edit  awards
     *

     */
    public function add_edit($id = 0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'award_management-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }
        $award = Orm_Wa_Award::get_instance($id);

        if ($id != 0 && !$award->get_id()) {
            Validator::set_error_flash_message('The resource you requested does not exist!');
            redirect('/');
        }

        if ($this->logged_user->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {


            if (empty($this->logged_user->get_college_id())) {

                Validator::set_error_flash_message(lang('College not exist'));
                exit('<script>window.location.reload();</script>');

            }

        } elseif ($this->logged_user->has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN) || $this->logged_user->has_role_type(Orm_Role::ROLE_NOT_ADMIN)) {

            if (!$this->logged_user->get_college_id()) {

                Validator::set_error_flash_message(lang('College not exist'));
                exit('<script>window.location.reload();</script>');


            } elseif (!$this->logged_user->get_program_id()) {

                Validator::set_error_flash_message(lang('Program not exist'));
                exit('<script>window.location.reload();</script>');
            }
        }

        $this->view_params['award'] = $award;
        $this->view_params['user_login'] = $this->logged_user;
        $this->load->view('add_edit', $this->view_params);
    }
    /**Award save function
     * check for inputs and validation and if validation is success will save it
     *
    */

    public function save()
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'award_management-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        $id = (int)$this->input->post('id');
        $level = intval($this->input->post('level'));
        $college_id = intval($this->input->post('college_id'));
        $department_id = intval($this->input->post('department_id'));
        $program_id = intval($this->input->post('program_id'));
        $name_en = $this->input->post('name_en');
        $name_ar = $this->input->post('name_ar');
        $description_en = $this->input->post('description_en');
        $description_ar = $this->input->post('description_ar');
        $date = $this->input->post('date');
        $created_by = intval(Orm_User::get_logged_user()->get_id());

        $award = Orm_Wa_Award::get_instance($id);

        Validator::not_empty_field_validator('name_en', $name_en, lang('Error: This field is required'));

        Validator::not_empty_field_validator('name_ar', $name_ar, lang('Error: This field is required'));

        Validator::required_field_validator('level', $level, lang('Required Filed'));
        Validator::in_array_validator('level', $level, array_keys(Orm_Wa_Award::get_levels()), lang('Required Filed'));

        Validator::not_empty_field_validator('description_en', $description_en, lang('Error: This field is required'));
        Validator::not_empty_field_validator('description_ar', $description_ar, lang('Error: This field is required'));
        Validator::not_empty_field_validator('date', $date, lang('Error: This field is required'));
        Validator::not_empty_field_validator('created_by', $created_by, lang('Error: This field is required'));

        $level_id = 0;

        switch ($level) {

            case Orm_Wa_Award::COLLEGE_LEVEL:

                Validator::not_empty_field_validator('college_id', $college_id, lang('Required Filed'));

                $level_id = $college_id;
                break;

            case Orm_Wa_Award::PROGRAM_LEVEL:

                Validator::not_empty_field_validator('college_id', $college_id, lang('Required Filed'));
                Validator::not_empty_field_validator('department_id', $department_id, lang('Required Filed'));
                Validator::not_empty_field_validator('program_id', $program_id, lang('Required Filed'));

                $level_id = $program_id;
                break;
        }

        $award->set_name_en($name_en);
        $award->set_name_ar($name_ar);
        $award->set_description_ar($description_ar);
        $award->set_description_en($description_en);
        $award->set_date($date ?: '0000-00-00');
        $award->set_created_by($created_by);
        $award->set_level($level);
        $award->set_level_id($level_id);

        if (Validator::success()) {

            $award->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));
            json_response(['status' => true]);
        }
        $this->view_params['award'] = $award;

        json_response(['status' => false, 'html' => $this->load->view('add_edit', $this->view_params, true)]);

    }

    /** delete award
     * delete award from database if award ahs id and shouldn't has winner
    */
    public function delete($id)
    {
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'award_management-manage');

        $award = Orm_Wa_Award::get_instance($id);

        if (!($award && $award->get_id())) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        Modules::load('candidate_user');

        $candidate = Orm_Wa_Candidate_User::get_count(array('award_id' => $id));

        if ($candidate != 0) {
            Validator::set_error_flash_message(lang("This Award has candidate user, You Can't remove it"));
            exit();
        }
        Modules::load('winner_award');

        $winner = Orm_Wa_Winner_Award::get_count(array('award_id' => $id));

        if ($winner != 0) {
            Validator::set_error_flash_message(lang("This Award has winner user, You Can't remove it"));
            exit();
        }
        if ($award->delete()) {
            Validator::set_success_flash_message(lang('Successful Delete'));
            exit();
        }

        Validator::set_error_flash_message(lang('Record has not Deleted'));
    }

    /* End Award General List */

    /**Award Winner List
     *  get list of all winners after filtering them
     */

    private function get_winner()
    {
        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();


        if ( Orm_User::has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {
            $filters['level'] =  Orm_Wa_Award::COLLEGE_LEVEL;
            $filters['level_id']=Orm_User::get_logged_user()->get_college_id();
        }

        if ( Orm_User::has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
            $filters['level'] =  Orm_Wa_Award::PROGRAM_LEVEL;
            $filters['level_id']=Orm_User::get_logged_user()->get_program_id();

        }

        if (Orm_User::get_logged_user()->get_class_type() == Orm_User_Student::class ) {
            $filters['user_id'] = $this->logged_user->get_id();

        }

        if ($this->logged_user->has_role_type(Orm_Role::ROLE_NOT_ADMIN)) {
            $filters['user_id'] = $this->logged_user->get_id();
        }


        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $winner_awards = Orm_Wa_Winner_Award::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Wa_Winner_Award::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['winner_awards'] = $winner_awards;
        $this->view_params['fltr'] = $fltr;
    }

    /**Award Winner page
     *  rendering all winners in list winner page
     */

    public function winner()
    {
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'menu_view' => 'award_management/sub_menu',
            'menu_params' => array('type' => 'winner')
        ), true);

        $this->get_winner();

        $this->layout->view('list_winner', $this->view_params);
    }

    /**Award Winner page
     *  if request is ajax render it in winner_data_table
     */

    public function filterWinner()
    {
        if ($this->input->is_ajax_request()) {
            $this->get_winner();
            $this->load->view('winner_data_table', $this->view_params);
        } else {
            $this->index();
        }

    }

    /**Award Winner add_delete page
     *  add edit winner to add winner or edit it
     */

    public function add_edit_winner($id = 0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'award_management-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }


        $candidates_award = Orm_Wa_Candidate_User::get_all(['award_id'=>$id]);
        $winner_award = Orm_Wa_Award::get_instance($id);

        if ($id != 0 && !$winner_award->get_id()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        $this->view_params['candidates_award'] = $candidates_award;
        $this->view_params['winner_award'] = $winner_award;
        $this->load->view('add_edit_current_winner', $this->view_params);
    }

    /**delete Winner deleteWinner page
     *  delete winner if exist
     */

    public function deleteWinner($id)
    {
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'award_management-manage');
        $awardWinner = Orm_Wa_Winner_Award::get_instance($id);

        if (!($awardWinner && $awardWinner->get_id())) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }
        if (($awardWinner->get_received() == 1)) {
            Validator::set_error_flash_message(lang("This winner has received award , You Can't remove it"));
            exit();
        }

        if ($awardWinner->delete()) {
            Validator::set_success_flash_message(lang('Successful Delete'));
            exit();
        }

        Validator::set_error_flash_message(lang('Record has not Deleted'));
    }

    /** save winner to database
     *  save winner in database if exceed all validations
     */

    public function save_old_winner()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF,
                Orm_User::USER_FACULTY)
            , false, 'award_management-manage');


        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        $id = $this->input->post('id');
        $user_ids = $this->input->post('user_ids');

        $received = $this->input->post('receive');
        $awardWinner = Orm_Wa_Winner_Award::get_instance($id);


        if ($user_ids) {

            $vals = array_count_values($user_ids);
            if (count($vals) != count($user_ids)) {

                Validator::set_error('user_ids', lang('Please Select 2 different Users'));
            }
            foreach ($user_ids as $key => $user_id) {
                Validator::not_empty_field_validator('user_id', $user_id, lang('Please Select Users'), $key);
            }

        }

        Modules::load('wa_winner_award');
        foreach ($user_ids as $key => $user_id) {
            $winner = Orm_Wa_Winner_Award::get_count(array('user_id' => $user_id, 'award_id' => $id));
            if ($winner != 0) {
                Validator::set_error('user_ids', lang('This user already has won this award'));
            }
        }
        if (Validator::success()) {
            foreach ($user_ids as $key => $user_id) {
                $manager = Orm_Wa_Winner_Award::get_one(array('award_id' => $id, 'user_id' => $user_id));
                $manager->set_award_id($id);
                $manager->set_user_id($user_id);
                $manager->set_received($received[$key] ? 1 : 0);
                $manager->save();

                Orm_Notification::send_notification(
                    $this->logged_user->get_id(),
                    $user_id,
                    Orm_Notification_Template::AWARD_WINNER,
                    Orm_Notification::TYPE_AWARD_WINNER,
                    array(

                        '%node_name%',
                        '%sender_name%',
                        '%body%'
                    )
                );

            }

            Validator::set_success_flash_message(lang('Successfully Saved'));
            json_response(['status' => true]);
        }
        $this->view_params['user_ids'] = $user_ids;
        $this->view_params['winner_award'] = $awardWinner;
        json_response(['status' => false, 'html' => $this->load->view('add_edit_old_winner', $this->view_params, true)]);
    }

    public function save_current_winner()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF,
                Orm_User::USER_FACULTY)
            , false, 'award_management-manage');


        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        $id = $this->input->post('id');
        $user_ids = $this->input->post('user_ids');

        $received = $this->input->post('receive');
        $awardWinner = Orm_Wa_Winner_Award::get_instance($id);
        $candidates_award = Orm_Wa_Candidate_User::get_all(['award_id'=>$id]);
        $winner_award = Orm_Wa_Award::get_instance($id);

        if ($user_ids) {

            $vals = array_count_values($user_ids);
            if (count($vals) != count($user_ids)) {

                Validator::set_error('user_ids', lang('Please Select 2 different Users'));
            }
            foreach ($user_ids as $key => $user_id) {
                Validator::not_empty_field_validator('user_id', $user_id, lang('Please Select Users'), $key);
            }

        }

        Modules::load('wa_winner_award');
        foreach ($user_ids as $key => $user_id) {
            $winner = Orm_Wa_Winner_Award::get_count(array('user_id' => $user_id, 'award_id' => $id));
            if ($winner != 0) {
                Validator::set_error('user_ids', lang('This user already has won this award'));
            }
        }
        if (Validator::success()) {
            foreach ($user_ids as $key => $user_id) {
                $manager = Orm_Wa_Winner_Award::get_one(array('award_id' => $id, 'user_id' => $user_id));
                $manager->set_award_id($id);
                $manager->set_user_id($user_id);
                $manager->set_received($received[$key] ? 1 : 0);
                $manager->save();

                Orm_Notification::send_notification(
                    $this->logged_user->get_id(),
                    $user_id,
                    Orm_Notification_Template::AWARD_WINNER,
                    Orm_Notification::TYPE_AWARD_WINNER,
                    array(

                        '%node_name%',
                        '%sender_name%',
                        '%body%'
                    )
                );

            }

            Validator::set_success_flash_message(lang('Successfully Saved'));
            json_response(['status' => true]);
        }


        $this->view_params['candidates_award'] = $candidates_award;
        $this->view_params['winner_award'] = $winner_award;
        $this->view_params['user_ids'] = $user_ids;
        $this->view_params['winner_award'] = $awardWinner;
        json_response(['status' => false, 'html' => $this->load->view('add_edit_current_winner', $this->view_params, true)]);
    }
    /** user_list pagination
     *  pagination to display users in pages
     */

    public function user_list()
    {
        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $filters = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }
        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $user = Orm_User::get_logged_user();
        if ($user->has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
            $filters['program_id'] = $user->get_program_id();
        }
        if ($user->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {
            $filters['college_id'] =$user->get_college_id();
        }
        $pager->set_total_count(Orm_User_Faculty::get_count($filters));
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['facilities'] = Orm_User_Faculty::get_all($filters, $page, $per_page);
        $this->layout->view('award_management/add_edit_winner', $this->view_params);
    }
    /* End Award Winner List */

    /* Award candidate List */

    /** candidate page index
     *  display award candidates in this page and get all information from get_candidate function
     */

    public function candidate()
    {
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'menu_view' => 'award_management/sub_menu',
            'menu_params' => array('type' => 'candidate')
        ), true);

        $this->get_candidate();

        $this->layout->view('list_candidate', $this->view_params);
    }

    /**Award index page
     * filter request if it's ajax will render it in candidate_data_table view else that will redirect it to index page
     *
     */

    public function filterCandidate()
    {
        if ($this->input->is_ajax_request()) {
            $this->get_candidate();
            $this->load->view('candidate_data_table', $this->view_params);
        } else {
            $this->index();
        }
    }

    /**get_candidate function
     * get all candidates after filter them depending on many permissions
     */
    private function get_candidate()
    {
        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        if (Orm_User::get_logged_user()->get_class_type() == Orm_User_Faculty::class && $this->logged_user->has_role_type(Orm_Role::ROLE_NOT_ADMIN)) {
            $filters = array('level' => Orm_Wa_Award::COLLEGE_LEVEL, 'level_id' => Orm_User::get_logged_user()->get_college_id());
        }

        if ($this->logged_user->get_role_obj()->get_admin_level() === Orm_Role::ROLE_NOT_ADMIN) {
            $filters['user_id'] = $this->logged_user->get_id();
        }

        if ( Orm_User::has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) {
            $filters['level'] =  Orm_Wa_Award::COLLEGE_LEVEL;
            $filters['level_id']=Orm_User::get_logged_user()->get_college_id();
        }

        if ( Orm_User::has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
            $filters['level'] =  Orm_Wa_Award::PROGRAM_LEVEL;
            $filters['level_id']=Orm_User::get_logged_user()->get_program_id();

        }

        if (Orm_User::get_logged_user()->get_class_type() == Orm_User_Student::class ) {
            $filters['user_id'] = $this->logged_user->get_id();

        }

        if ($this->logged_user->has_role_type(Orm_Role::ROLE_NOT_ADMIN)) {
            $filters['user_id'] = $this->logged_user->get_id();
        }

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $candidate_user = Orm_Wa_Candidate_User::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Wa_Candidate_User::get_count($filters));
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['candidate_user'] = $candidate_user;
        $this->view_params['fltr'] = $fltr;
    }

    /**add_edit_candidate
     * get all candidates after filter them depending on many permissions
     */
    public function add_edit_candidate($id = 0)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'award_management-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }
        $candidate_award = Orm_Wa_Award::get_instance($id);
        if ($id != 0 && !$candidate_award->get_id()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        $this->view_params['candidate_award'] = $candidate_award;
        $this->load->view('add_edit_candidate', $this->view_params);
    }

    /**delete candidate
     * delete candidate if it's exist
     */
    public function deleteCandidate($id)
    {
        Orm_User::check_permission([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'award_management-manage');

        $awardCandidate = Orm_Wa_Candidate_User::get_instance($id);
        $awardWinner=Orm_Wa_Winner_Award::get_count(['user_id'=>$awardCandidate->get_user_id(),'award_id'=>$awardCandidate->get_award_id()]);

        if ($awardWinner != 0):
            Validator::set_error_flash_message(lang('Record can not be Deleted').' ' .lang('This record assigned as a winner'));
            exit();
        endif;

        if (!($awardCandidate && $awardCandidate->get_id())) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect('/');
        }

        if ($awardCandidate->delete()) {
            Validator::set_success_flash_message(lang('Successful Delete'));
            exit();
        }

        Validator::set_error_flash_message(lang('Record has not Deleted'));
    }


    /**save candidate
     * save candidate after exceeding all validations
     */
    public function save_candidate()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF,
                Orm_User::USER_FACULTY)
            , false, 'award_management-manage');

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        $id = $this->input->post('id');
        $user_ids = $this->input->post('user_ids');

        $candidateAward = Orm_Wa_Candidate_User::get_instance($id);
        if ($user_ids) {

            $vals = array_count_values($user_ids);
            if (count($vals) != count($user_ids)) {

                Validator::set_error('user_ids', lang('Please Select 2 different Users'));
            }

            foreach ($user_ids as $key => $user_id) {
                Validator::not_empty_field_validator('user_id', $user_id, lang('Please Select Users'), $key);
            }
        }
        Modules::load('wa_candidate_user');
        foreach ($user_ids as $key => $user_id) {
            $candidate = Orm_Wa_Candidate_User::get_count(array('user_id' => $user_id, 'award_id' => $id));
            if ($candidate != 0) {
                Validator::set_error('user_ids', lang('This user already has candidate this award'));
            }
        }
        if (Validator::success()) {

            foreach ($user_ids as $user_id) {
                $manager = Orm_Wa_Candidate_User::get_one(array('award_id' => $id, 'user_id' => $user_id));
                $manager->set_award_id($id);
                $manager->set_user_id($user_id);
                $manager->save();

                Orm_Notification::send_notification(
                    $this->logged_user->get_id(),
                    $user_id,
                    Orm_Notification_Template::AWARD_CANDIDATE,
                    Orm_Notification::TYPE_AWARD_CANDIDATE,
                    array(

                        '%node_name%',
                        '%sender_name%',
                        '%body%'
                    )
                );

            }

            Validator::set_success_flash_message(lang('Successfully Saved'));
            json_response(['status' => true]);
        }
        $this->view_params['user_ids'] = $user_ids;
        $this->view_params['candidate_award'] = $candidateAward;
        json_response(['status' => false, 'html' => $this->load->view('add_edit_candidate', $this->view_params, true)]);
    }

    /** candidate list function
     * render all candidates in candidate_data_table
    */
    public function candidate_list()
    {
        $this->load->view('candidate_data_table', $this->view_params);
    }

    /* End Award candidate List */

    /** view function for specify who will see pages
     * it's page to filter and specify permissions for users who can modify or see the module
     */

    public function view($id)
    {
        if (!Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'award_management-list')) {
            Orm_User::check_permission(array(Orm_User::USER_STUDENT), true);
        } else {
            Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'award_management-list');
        }

        if (Orm_User::check_credential([Orm_User_Staff::class, Orm_User_Faculty::class], false, 'award_management-report')) {
            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'link_attr' => 'href="/award_management/pdf/' . $id . '"',
                'link_title' => lang('PDF'),
                'link_icon' => 'file-pdf-o'
            ), true);
        }


        $this->breadcrumbs->push(lang('View') . ' ' . Orm_Wa_Award::get_instance($id)->get_name(), '/award_management/view/' . $id);

        if (isset($id)) {
            $award = Orm_Wa_Award::get_instance($id);

            if (!$award->get_id()) {
                Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
                redirect('/');
            }

            $this->view_params['award'] = $award;

            $this->layout->view('view', $this->view_params);
        } else {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

    }

    /** pdf page
     * print awards in pdf page , if success print pdf and redirect it to the parent page else that validation error
     */
    public function pdf($id)
    {
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'award_management-report');

        $Award = Orm_Wa_Award::get_instance($id);
        if (isset($id)) {
            if ($Award->get_id()) {
                $Award->generate_pdf();
            }

            redirect($this->input->server('HTTP_REFERER'));
        } else {
            Validator::set_error_flash_message(lang('Operation not allowed!'));
            redirect('/');
        }

    }

}