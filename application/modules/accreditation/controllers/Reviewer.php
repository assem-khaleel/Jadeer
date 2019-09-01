<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: ali
 * Date: 06/04/17
 * Time: 02:40 م
 */
class Reviewer extends MX_Controller
{
    /**
     * View Params
     * @var array
     */
    protected $view_params = array();

    protected $is_admin = false;

    public function __construct() {
        parent::__construct();

        if(!License::get_instance()->check_module('accreditation', true)) {
            show_404();
        }

        Orm_User::check_logged_in();

        $this->load->library('Node/Node_Autoloader');
        Node_Autoloader::register();

        $this->is_admin = !Orm_User::has_role_type(Orm_Role::ROLE_NOT_ADMIN);

        $this->view_params['is_admin'] = $this->is_admin;

        $this->view_params['menu_tab'] = 'reviewer';

    }

    protected function page_header($tab) {

        $view_params = array();
        $view_params['tab'] = $tab;
        $view_params['is_admin'] = $this->is_admin;

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Reviewer'),
            'icon' => 'fa fa-eye',
            'menu_view' => 'reviewer/tab_menu',
            'menu_params' => $view_params
        ), true);
    }

    public function index() {

        if($this->is_admin) {
            redirect('/accreditation/reviewer_internal');
        } elseif (Orm_Acc_Visit_Reviewer::can_manege(Orm_Acc_Visit_Reviewer::TYPE_PROGRAM) || Orm_Acc_Visit_Reviewer::can_manege(Orm_Acc_Visit_Reviewer::TYPE_INSTITUTION)) {
            redirect('/accreditation/reviewer_visit');
        } elseif (Orm_Acc_Pre_Visit_Reviewer::can_manege(Orm_Acc_Pre_Visit_Reviewer::TYPE_PROGRAM) || Orm_Acc_Pre_Visit_Reviewer::can_manege(Orm_Acc_Pre_Visit_Reviewer::TYPE_INSTITUTION)) {
            redirect('/accreditation/reviewer_pre_visit');
        } elseif (Orm_Acc_Independent_Reviewer::can_manege(Orm_Acc_Independent_Reviewer::TYPE_PROGRAM) || Orm_Acc_Independent_Reviewer::can_manege(Orm_Acc_Independent_Reviewer::TYPE_INSTITUTION)) {
            redirect('/accreditation/reviewer_independent');
        }

        $this->breadcrumbs->push(lang('Accreditations'), '/accreditation');
        $this->breadcrumbs->push(lang('Reviewer'), '/accreditation/reviewer');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Reviewer'),
            'icon' => 'fa fa-eye'
        ), true);

        $this->layout->view("reviewer/index", $this->view_params);

    }

}