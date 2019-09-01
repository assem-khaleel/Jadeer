<?php

/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 12/19/16
 * Time: 9:16 AM
 *
 */
class College_objective extends MX_Controller
{
    private $view_params = array();
    private $college = NULL;

    public function __construct()
    {
        parent::__construct();

        Orm_User::check_logged_in();
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-college');

        $college_id = (int)$this->input->get_post('college_id');

        $this->college = Orm_College::get_instance($college_id);

        if (!$this->college->get_id()) {
            Validator::set_error_flash_message(lang('Error: Please try again'));
            redirect('/college');
        }

        $this->view_params['sub_menu'] = 'settings/sub_menu';
        $this->view_params['sub_tab'] = 'college';
        $this->view_params['menu_tab'] = 'settings';
        $this->breadcrumbs->push(lang('Settings'), '/settings');
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('College Objectives') . ' : ' . htmlfilter($this->college->get_name()),
            'icon' => 'fa fa-suitcase'
        ), true);
        $this->view_params['object'] = $this->college;
    }

    public function index()
    {

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Colleges'), '/college');
        $this->breadcrumbs->push(htmlfilter($this->college->get_name()), '/college_objective?college_id=' . $this->college->get_id());

        $html = '<div class="col-md-9 col-lg-10">';
        $html .= $this->college->draw_objectives();
        $html .= '</div></div>';

        $this->layout->content_as_html(true)->view($html,$this->view_params);
    }
}