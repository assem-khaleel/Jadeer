<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends MX_Controller
{

    /**
     * View Params
     * @var array
     */
    private $view_params = array();

    public function __construct()
    {
        parent::__construct();

        Orm_User::check_logged_in();
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'settings-item');

        $this->view_params['sub_menu'] = 'settings/sub_menu';
        $this->view_params['sub_tab'] = 'item';
        $this->view_params['menu_tab'] = 'settings';
        $this->breadcrumbs->push(lang('Settings'), '/settings');

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Item'),
            'icon' => 'fa fa-tasks'
        ), true);

    }

    public function index()
    {

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Item'),
            'icon' => 'fa fa-tasks',
            'link_attr' => 'href="/item/create"',
            'link_icon' => 'plus',
            'link_title' => lang('Create').' '.lang('Item')
        ), true);


        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array();
        if (!empty($fltr['criteria_id'])) {
            $filters['criteria_id'] = (int)$fltr['criteria_id'];
        }
        
        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $items = Orm_Item::get_all($filters, $page, $per_page,array('i.code'));

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Item::get_count($filters));

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Item'), '/item');

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['items'] = $items;
        $this->view_params['fltr'] = $fltr;

        $this->layout->view('/item/list', $this->view_params);
    }

    public function create()
    {
        // add breadcrumbs
        $this->breadcrumbs->push(lang('Item'), '/item');
        $this->breadcrumbs->push(lang('Add').' '.lang('Item'), '/item/create');

        $this->view_params['item'] = new Orm_Item();
        $this->layout->view('/item/create_edit', $this->view_params);
    }

    public function save()
    {
        // post data
        $id = (int)$this->input->post('id');
        $item_title = $this->input->post('title');
        $item_code = $this->input->post('code');
        $criteria_id = (int)$this->input->post('criteria_id');

        //get instances object
        $obj = Orm_Item::get_instance($id);
        $obj->set_title($item_title);
        $obj->set_code($item_code);
        $obj->set_criteria_id($criteria_id);

        //validation errors
        Validator::required_field_validator('code', $item_code, lang('Please Enter Item Code'));
        Validator::required_field_validator('title', $item_title, lang('Please Enter Item Title'));
        Validator::database_unique_field_validator($obj, 'title', 'title', $item_title, lang('Unique Field'));
        Validator::not_empty_field_validator('criteria_id', $criteria_id, lang('Please Select Criteria'));

        //check validation
        if (Validator::success()) {
            $obj->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));
            redirect('/item');
        }

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Item'), '/item');
        $this->breadcrumbs->push(lang('Add').' '.lang('Item'), '/item/create');

        // parameter
        $this->view_params['item'] = $obj;
        $this->layout->view('/item/create_edit', $this->view_params);
    }

    public function edit($id)
    {

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Item'), '/item');
        $this->breadcrumbs->push(lang('Edit').' '.lang('Item'), '/item/edit/' . $id);

        $this->view_params['item'] = Orm_Item::get_instance($id);
        $this->layout->view('/item/create_edit', $this->view_params);
    }

    public function delete($id)
    {
        $obj = Orm_Item::get_instance($id);

        if ($obj->get_id()) {
            $obj->delete();
        }

        Validator::set_success_flash_message(lang('Successfully Deleted'), true);
        redirect('/item');
    }

}
