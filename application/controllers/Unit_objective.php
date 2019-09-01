<?php

/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 12/19/16
 * Time: 9:16 AM
 *
 */
class Unit_objective extends MX_Controller
{
    private $view_params = array();
    private $unit = NULL;

    public function __construct()
    {
        parent::__construct();

        Orm_User::check_logged_in();
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-unit');

        $unit_id = (int)$this->input->get_post('unit_id');

        $this->unit = Orm_Unit::get_instance($unit_id);

        if (!$this->unit->get_id()) {
            Validator::set_error_flash_message(lang('Error: Please try again'));
            redirect('/unit');
        }
        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Unit Objectives') . ' : ' . htmlfilter($this->unit->get_name()),
            'icon' => 'fa fa-university'
        ), true);

        $this->view_params['sub_menu'] = 'settings/sub_menu';
        $this->view_params['sub_tab'] = 'unit';
        $this->view_params['menu_tab'] = 'settings';
        $this->breadcrumbs->push(lang('Settings'), '/settings');

        $this->view_params['object'] = $this->unit;
    }

    public function index()
    {
        // add breadcrumbs
        $this->breadcrumbs->push(lang('Units'), '/unit');
        $this->breadcrumbs->push(htmlfilter($this->unit->get_name()), '/unit_objective?unit_id=' . $this->unit->get_id());

        $html = '<div class="col-md-9 col-lg-10">';
        $html .= $this->unit->draw_objectives();
        $html .= '</div></div>';

        $this->layout->content_as_html(true)->view($html,$this->view_params);

    }
}