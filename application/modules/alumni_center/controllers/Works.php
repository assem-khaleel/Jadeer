<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Layout $layout
 * @property Breadcrumbs $breadcrumbs
 * @property CI_Input $input
 * @property CI_Config $config
 * Class Alumni_Works
 */
class Works extends MX_Controller {

    private $view_params = array();
    private $user;

    public function __construct() {
        parent::__construct();

        if(!License::get_instance()->check_module('alumni_center', true)) {
            show_404();
        }

        Orm_User::check_logged_in();

        $user_id = $this->input->get_post('user_id');
        $this->user = Orm_User::get_instance($user_id);

        $allow = array(
            Orm_User::USER_ALUMNI,
            Orm_User::USER_EMPLOYER,
        );

        if (!in_array($this->user->get_class_type(), $allow)) {
            Validator::set_error_flash_message(lang('Invalid Type'));
            redirect('/alumni_center');
        }

        if (!$this->user->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/alumni_center');
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Alumni Center'),
            'icon' => 'fa fa-graduation-cap'
        ), true);
        $this->view_params['user'] = $this->user;
        $this->view_params['menu_tab'] = 'alumni_center';

        $this->breadcrumbs->push(lang('Alumni Center'), '/alumni_center');

    }

    /**
     * Index function will display lists of works for alumni user  and return view for alumni user
     *
     * */

    public function index() {

        $page_header = array(
            'title' => lang('Alumni Center'),
            'icon' => 'fa fa-graduation-cap'
        );

        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'alumni-list');
        $per_page = $this->config->item('per_page');

        $page = (int) $this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = is_array($fltr) ? $fltr : array();

        if ($this->user->get_class_type() == Orm_User::USER_ALUMNI) {
            $page_header['link_attr'] = 'href="/alumni_center/works/create_edit?user_id='.$this->user->get_id().'"';
            $page_header['link_title'] = lang('Add').' '.lang('work');

            $filters['alumni_id'] = $this->user->get_id();
        } else {
            $filters['employer_id'] = $this->user->get_id();
        }

        $items = Orm_Alumni_Work::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Alumni_Work::get_count($filters));

        $this->breadcrumbs->push(lang('Work List'), '/alumni_center/works?user_id='.$this->user->get_id());

        // set view parameters
        $this->view_params['items'] = $items;
        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['page_header'] = $this->load->view('/common/page_header', $page_header, true);
        $this->layout->view('alumni_center/works/list', $this->view_params);
    }

    /**
     * create works for alumni user and rendering it in view
     */
    public function create_edit() {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'alumni-manage');
        $id = $this->input->get('id');

        $this->view_params['work'] = Orm_Alumni_Work::get_instance($id);

        $this->breadcrumbs->push(lang('Work List'), '/alumni_center/works?user_id='.$this->user->get_id());
        $this->breadcrumbs->push($id ? lang('Edit').' '.lang('work') : lang('Add').' '.lang('work'), '/alumni_center/works/create_edit');

        $this->layout->view('alumni_center/works/create_edit', $this->view_params);
    }

    /**
     *save works lists for alumni  and redirect it to header
     */

    public function save() {

        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'alumni-manage');
        //
        // get request parameters
        //
        $id = $this->input->post('id');
        $alumni_id = $this->input->post('alumni_id');
        $employer_id = $this->input->post('employer_id');
        $position = $this->input->post('position');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        $start_date = strtotime($start_date);
        $end_date = strtotime($end_date);
        //
        // validation
        //
        Validator::required_field_validator('employer_id', $employer_id, lang('Please Select  Employer'));
        Validator::required_field_validator('position', $position, lang('Invalid Position'));
        Validator::required_field_validator('start_date', $start_date, lang('Invalid Start Date'));
        Validator::required_field_validator('end_date', $end_date, lang('Invalid End Date'));

        $work = Orm_Alumni_Work::get_instance($id);

        if ($this->user->get_class_type() == Orm_User::USER_ALUMNI) {
            $work->set_alumni_id($this->user->get_id());
            $work->set_employer_id($employer_id);
        } else {
            $work->set_alumni_id($alumni_id);
            $work->set_employer_id($this->user->get_id());
        }

        $work->set_start_date($start_date);
        $work->set_end_date($end_date);
        $work->set_position($position);
        $work->set_created_by(Orm_User::get_logged_user()->get_id());

        if (Validator::success()) {
            $work->save();

            Validator::set_success_flash_message(lang('Work Successfully Saved'));
            redirect('/alumni_center/works?user_id=' . $this->user->get_id());
        }

        $this->view_params['work'] = $work;
        $this->layout->view('alumni_center/works/create_edit', $this->view_params);
    }

    /**
     * delete item action
     * delete works if exist and redirect it to header
     */
    public function delete() {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'alumni-manage');
        $id = $this->input->get('id');
        $work = Orm_Alumni_Work::get_instance($id);

        if ($work->get_id()) {
            if ($this->user->get_class_type() == Orm_User::USER_ALUMNI) {
                if($work->get_alumni_id() == $this->user->get_id()){
                    $work->delete();
                    Validator::set_success_flash_message(lang('Works Removed Successfully'));
                }
            } else {
                if($work->get_employer_id() == $this->user->get_id()){
                    $work->delete();
                    Validator::set_success_flash_message(lang('Works Removed Successfully'));
                }
            }
        }

        redirect('/alumni_center/works?user_id=' . $this->user->get_id());
    }

}
