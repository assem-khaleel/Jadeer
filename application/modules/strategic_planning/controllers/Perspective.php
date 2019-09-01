<?php

/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 16/10/17
 * Time: 10:29 AM
 */

class Perspective extends MX_Controller
{
    private $view_params = [];

    /**
     * Recommendation constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if(!License::get_instance()->check_module('strategic_planning', true)) {
            show_404();
        }

        Orm_User::check_logged_in();
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'strategic_planning-list');
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'strategic_planning-manage');


        $this->view_params['menu_tab'] = 'strategic_planning';

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Manage Perspective'),
            'icon' => 'fa fa-road'
        ), true);

        $this->view_params['menu_tab'] = 'strategic_planning';
        $this->view_params['menu_header'] = '<h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-sitemap page-header-icon"></i>&nbsp;&nbsp;' . lang('Manage Perspective') . '</h1></i>';


        $this->breadcrumbs->push(lang('Strategic Planning'), '/strategic_planning');
    }

    /**
     *this function index
     * @return string the html view
     * default controller action
     */
    public function index() {

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Manage').' '.lang('Perspective'),
            'icon' => 'fa fa-road',
            'link_attr'  => 'href="/strategic_planning/perspective/add_edit" data-toggle="ajaxModal"',
            'link_title' => lang('Add New'),
            'link_icon'  => 'plus'
        ), true);

        $this->breadcrumbs->push(lang('Perspective'), '/strategic_planning/perspective');

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');

        if (!$page) {
            $page = 1;
        }

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Sp_Perspective::get_count());

        $this->view_params['pager'] = $pager->render(true);

        $this->view_params['perspectives'] = Orm_Sp_Perspective::get_all([], $page, $per_page, ['id desc']);

        $this->layout->view('perspective/list', $this->view_params);
    }

    /**
     * this function add edit by its id
     * @param int $id the id of the add edit to be viewed
     * @return string the html view
     */
    public function add_edit($id = 0)
    {
        $id = intval($id);

        $this->view_params['perspective'] = Orm_Sp_Perspective::get_instance(intval($id));

        $this->load->view('perspective/add_edit', $this->view_params);
    }
    /**
     * this function save
     * @redirect success or error
     */
    public function save()
    {
        $id = intval($this->input->post('id'));
        $text_en = $this->input->post('text_en');
        $text_ar = $this->input->post('text_ar');

        //get instances object
        $perspective = Orm_Sp_Perspective::get_instance($id);
        $perspective->set_name_en($text_en);
        $perspective->set_name_ar($text_ar);


        //validation errors
        Validator::required_field_validator('text_en', $text_en, lang('Please Enter perspective Text').' '.lang('English'));
        Validator::required_field_validator('text_ar', $text_ar, lang('Please Enter perspective Text').' '.lang('Arabic'));
        Validator::database_unique_field_validator($perspective, 'name_en', 'text_en', $text_en, lang('Unique Field'), null, ['name_en' => $text_en]);
        Validator::database_unique_field_validator($perspective, 'name_ar', 'text_ar', $text_ar, lang('Unique Field'), null, ['name_ar' => $text_ar]);


        if ($this->input->server('REQUEST_METHOD') == 'POST' && Validator::success()) {

            $perspective->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));
            json_response(array('status' => true));

        }

        $this->view_params['perspective'] = $perspective;

        json_response(array('status' => false, 'html' => $this->load->view('perspective/add_edit', $this->view_params, true)));
    }

    /**
     * this function delete by its id
     * @param int $id the id of the delete to be viewed
     * @redirect success or error
     */
    public function delete($id)
    {

        $obj = Orm_Sp_Perspective::get_instance($id);
        if ($obj->get_id() && $obj->can_delete()) {
            $obj->delete();
        }
        Validator::set_success_flash_message(lang('Successfully Deleted'), true);
    }
}