<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Layout $layout
 * @property Breadcrumbs $breadcrumbs
 * @property CI_Input $input
 * Class Recommendation_Type
 */
class Recommendation_Type extends MX_Controller
{
	/**
	 * View Params
	 * @var array
	 */
	private $view_params = array();

    /**
     * Recommendation_Type constructor.
     */
    public function __construct()
	{
		parent::__construct();

		Orm_User::check_logged_in();

        if(!License::get_instance()->check_module('strategic_planning', true)) {
            show_404();
        }

		if (!Orm_User::has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN))
		{
			Validator::set_success_flash_message(lang('No Permission'));
			redirect('/strategic_planning');
		}

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Strategic Planning') . ' - ' . lang('Recommendation Types') ,
            'icon' => 'fa fa-road'
        ), true);

        $this->view_params['menu_tab'] = 'strategic_planning';

		$this->breadcrumbs->push(lang('Developmental Planning'), '/strategic_planning');
		$this->breadcrumbs->push(lang('Action Plan'), '/strategic_planning/recommendation_type');
	}

    /**
     *this function index
     * @return string the html view
     * default controller action
     */
    public function index()
	{
		$this->items();
	}
    /**
     * this function items by its to buffer
     * @param bool $to_buffer the to buffer of the items to be viewed
     * @return mixed the html view
     */
    public function items($to_buffer = false)
	{
		$this->view_params['types'] = Orm_Sp_Recommendation_Type::get_all();

		if($to_buffer) {
			return $this->load->view('recommendation_type/list', $this->view_params, true);
		} else {
			$this->layout->view('recommendation_type/list', $this->view_params);
		}
	}

    /**
     * this function add edit by its id
     * @param int $id the id of the add edit to be viewed
     * @return string the html view
     */
    public function add_edit($id = 0)
	{
		$this->view_params['type'] = Orm_Sp_Recommendation_Type::get_instance($id);
		$this->load->view('recommendation_type/add_edit', $this->view_params);
	}

    /**
     * this function save
     * @redirect success or error
     */
    public function save()
	{
		$id = $this->input->post('id');
		$title_ar = $this->input->post('title_ar');
		$title_en = $this->input->post('title_en');
		$code = $this->input->post('code');

		// validation
		Validator::required_field_validator('title_en', $title_en, lang('Invalid Title').'('.lang('English').')');
		Validator::required_field_validator('title_ar', $title_ar, lang('Invalid Title').'('.lang('Arabic').')');
		Validator::required_field_validator('code', $code, lang('Invalid code!'));

		$item = Orm_Sp_Recommendation_Type::get_instance($id);
		$item->set_title_en($title_en);
		$item->set_title_ar($title_ar);
		$item->set_code($code);

		if (Validator::success())
		{
			$item->save();

			json_response(array('error' => false, 'html' => $this->items(true)));
		}

		$this->view_params['type'] = $item;
		json_response(array('error' => true, 'html' => $this->load->view('recommendation_type/add_edit', $this->view_params, true)));
	}

    /**
     * this function delete by its id
     * @param int $id the id of the delete to be viewed
     * @redirect success or error
     */
    public function delete($id = 0)
	{
		$item = Orm_Sp_Recommendation_Type::get_instance($id);

		if ($item->get_id()) {
			$item->delete();
		}

		json_response(array('html' => $this->items(true)));
	}

}