<?php

/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 12/19/16
 * Time: 9:16 AM
 *
 */
class Program_objective extends MX_Controller
{
    private $view_params = array();
    private $program = NULL;

    public function __construct()
    {
        parent::__construct();

        Orm_User::check_logged_in();
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-program');

        $program_id = (int)$this->input->get_post('program_id');

        $this->program = Orm_Program::get_instance($program_id);

        if (!$this->program->get_id()) {
            Validator::set_error_flash_message(lang('Error: Please try again'));
            redirect('/program');
        }
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Program Objectives') . ' : ' . htmlfilter($this->program->get_name()),
            'icon' => 'fa fa-gears'
        ), true);

        $this->view_params['sub_menu'] = 'settings/sub_menu';
        $this->view_params['sub_tab'] = 'program';
        $this->view_params['menu_tab'] = 'settings';
        $this->breadcrumbs->push(lang('Settings'), '/settings');

        $this->view_params['object'] = $this->program;
    }

    public function index()
    {
        // add breadcrumbs
        $this->breadcrumbs->push(lang('Programs'), '/program');
        $this->breadcrumbs->push(htmlfilter($this->program->get_name()), '/program_objective?program_id=' . $this->program->get_id());

        $html = '<div class="col-md-9 col-lg-10">';
        $html .= $this->program->draw_objectives();
        $html .= '</div></div>';

        $this->layout->content_as_html(true)->view($html,$this->view_params);
    }
}