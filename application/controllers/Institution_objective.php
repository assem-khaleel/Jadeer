<?php

/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 12/19/16
 * Time: 9:16 AM
 */
class Institution_objective extends MX_Controller
{
    private $view_params = array();
    private $institution = NULL;

    public function __construct()
    {
        parent::__construct();

        Orm_User::check_logged_in();
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-institution');


        $this->institution = Orm_Institution::get_one();

        if (!$this->institution->get_id()) {
            Validator::set_error_flash_message(lang('Error: Please try again'));
            redirect('/institution');
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Institution Objectives'),
            'icon' => 'fa fa-gear',
            'link_attr' => 'href="/settings/institution"',
            'link_title' => lang('Institution Account')
        ), true);

        $this->view_params['sub_menu'] = 'settings/sub_menu';
        $this->view_params['sub_tab'] = 'institution';
        $this->view_params['menu_tab'] = 'settings';
        $this->breadcrumbs->push(lang('Settings'), '/settings');
        $this->breadcrumbs->push(lang('Institutions'), 'settings/institution');

        $this->view_params['object'] = $this->institution;
    }

    public function index()
    {

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Objectives'), '/institution/objective');

        $html = '<div class="col-md-9 col-lg-10">';
        $html .= $this->institution->draw_objectives();
        $html .= '</div></div>';

        $this->layout->content_as_html(true)->view($html, $this->view_params);

    }
}