<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 2/29/16
 * Time: 5:13 PM
 */

/**
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * Class Manual
 */
class Manual extends MX_Controller {

    /**
     * View Params
     * @var array
     */
    private $view_params = array();

    public function __construct()
    {
        parent::__construct();

        Orm_User::check_logged_in();

        $this->view_params['menu_tab'] = 'manual';

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Manual'),
            'icon' => 'fa fa-link'
        ), true);

    }

    public function index()
    {

        if (Orm_User::has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)) {
            $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
                'title' => lang('Manual'),
                'icon' => 'fa fa-link',
                'link_attr' => 'href="/manual/add_edit"',
                'link_icon' => 'plus',
                'link_title' => lang('Add').' '.lang('Manual')
            ), true);
        }

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');

        if (!$page) {
            $page = 1;
        }

        $manuals = Orm_Manual::get_all(array(), $page, $per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Manual::get_count(array()));

        // add breadcrumbs
        $this->breadcrumbs->push(lang('Manual'), '/manual');

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['manuals'] = $manuals;

        $this->layout->view('/manual/list', $this->view_params);
    }

    public function add_edit($id = 0)
    {
        // add breadcrumbs
        $this->breadcrumbs->push(lang('Manual'), '/manual');
        $this->breadcrumbs->push(lang('Add').' '.lang('Manual'), '/manual/add_edit');

        $this->view_params['manual'] = Orm_Manual::get_instance($id);
        $this->layout->view('/manual/add_edit', $this->view_params);
    }

    public function save()
    {
        // post data
        $id = (int)$this->input->post('id');
        $label_en = $this->input->post('label_en');
        $label_ar = $this->input->post('label_ar');
        $link_en = $this->input->post('link_en');
        $link_ar = $this->input->post('link_ar');

        //get instances object
        $obj = Orm_Manual::get_instance($id);
        $obj->set_label_arabic($label_ar);
        $obj->set_label_english($label_en);
        $obj->set_link_arabic($link_ar);
        $obj->set_link_english($link_en);

        //validation errors
        Validator::required_field_validator('label_en', $label_en, lang('Please Enter Manual Label').' '.lang('Arabic'));
        Validator::required_field_validator('label_ar', $label_ar, lang('Please Enter Manual Label').' '.lang('English'));
        Validator::database_unique_field_validator($obj, 'label_arabic', 'label_ar', $label_ar, lang('Unique Field'));
        Validator::database_unique_field_validator($obj, 'label_english', 'label_en', $label_en, lang('Unique Field'));
        Validator::required_field_validator('link_en', $link_en, lang('Please Enter Manual Link').' '.lang('English'));
        Validator::required_field_validator('link_ar', $link_ar, lang('Please Enter Manual Link').' '.lang('Arabic'));

        //check validation
        if (Validator::success()) {
            $obj->save();

            Validator::set_success_flash_message(lang('Successfully Saved'));
            redirect('/manual');
        }

        // parameter
        $this->view_params['manual'] = $obj;
        $this->layout->view('/manual/add_edit', $this->view_params);
    }

    public function delete($id)
    {

        $obj = Orm_Manual::get_instance($id);

        if ($obj->get_id()) {
            $obj->delete();
        }

        Validator::set_success_flash_message(lang('Successfully Deleted'), true);
        redirect('/manual');
    }
}
