<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Role
 * @property Breadcrumbs breadcrumbs
 * @property Layout layout
 */
class Role extends MX_Controller {

    private $view_params = array();

    public function __construct() {
        parent::__construct();

        //
        // Orm_User
        //
        Orm_User::check_logged_in();
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-role');

        $this->view_params['sub_menu'] = 'settings/sub_menu';
        $this->view_params['sub_tab'] = 'role';
        $this->view_params['menu_tab'] = 'settings';
        $this->breadcrumbs->push(lang('Settings'), '/settings');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Role'),
            'icon' => 'fa fa-suitcase',
            'link_attr' => 'href="/role/create_edit" data-toggle="ajaxModal"',
            'link_icon' => 'plus',
            'link_title' => lang('Create Role')
        ), true);

        $this->layout->add_javascript('/assets/jadeer/js/jstree/jstree.min.js');
        $this->layout->add_stylesheet('/assets/jadeer/js/jstree/themes/proton/style.min.css');
    }

    /**
     * default controller action
     */
    public function index() {

        $per_page = $this->config->item('per_page');

        $page = (int) $this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();

        // process
        $items = Orm_Role::get_all($filters, $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Role::get_count($filters));

        $this->breadcrumbs->push(lang('Role'), '/role');

        // set view parameters
        $this->view_params['items'] = $items;
        $this->view_params['pager'] = $pager->render(true);
        $this->layout->view('role/list', $this->view_params);
    }

    /**
     * create new item action
     */
    public function create_edit() {
        $id = $this->input->get('id');

        $this->view_params['role'] = Orm_Role::get_instance($id);
        $this->load->view('role/create_edit', $this->view_params);
    }

    /**
     * save item action (add/edit actions)
     */
    public function save() {
        // get request parameters
        $id = (int) $this->input->post('id');
        $name = $this->input->post('name');
        $admin_level = (int) $this->input->post('admin_level');
        $credentials = (array) $this->input->post('credentials');
        $item = Orm_Role::get_instance($id);
        // validation
        Validator::required_field_validator('name', $name, lang('Invalid role name!'));
        Validator::database_unique_field_validator($item, 'name', 'name', $name, lang('Unique Field'));

        // Load config file
        $this->load->config('acl');
        // Get breadcrumbs display options
        $acl_map = $this->config->item('map');

        foreach ($credentials as $key => $credential) {
            $acl = explode('-', $credential);
            $module = isset($acl[0]) ? $acl[0] : '';
            $permission = isset($acl[1]) ? $acl[1] : '';

            if (!isset($acl_map[$module][$permission])) {
                unset($credentials[$key]);
            }
        }


        $item->set_name($name);
        $item->set_admin_level($admin_level);
        $item->set_credential(array_values($credentials));

        if (Validator::success()) {
            $item->save();

            Validator::set_success_flash_message(lang('Role Successfully Saved'));
            json_response(array('error' => false));
        }

        $this->view_params['role'] = $item;
        json_response(array('error' => true, 'html' => $this->load->view('role/create_edit', $this->view_params, true)));
    }

    /**
     * delete item action
     */
    public function delete() {
        $id = $this->input->get('id');

        if (Orm_User_Faculty::get_count(array('role_id' => $id)) || Orm_User_Staff::get_count(array('role_id' => $id))) {
            Validator::set_error_flash_message(lang('Cannot remove the selected Role because it has a users with that role'));
            exit('<script>window.location.reload();</script>');
        }

        $item = Orm_Role::get_instance($id);
        $item->delete();

        Validator::set_success_flash_message(lang('Role removed successfully'));
    }

}
