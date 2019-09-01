<?php

/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 01/06/17
 * Time: 03:37 م
 */
class Category extends MX_Controller
{
    private $view_params;
    private $course_id;
    private $type;
    private $can_manage;

    /**
     * Category constructor.
     */
    public function __construct()
    {
        parent::__construct();

        Orm_User::check_logged_in();
        if (!License::get_instance()->check_module('portfolio_course', true)) {
            show_404();
        }
        if( !Orm_User::check_credential(array(Orm_User::USER_FACULTY,Orm_User::USER_STAFF), false, 'portfolio_course-manage')) {
           redirect('/portfolio_course');
        }
        //variables
        $type= $this->input->get('type');

        $this->course_id = $this->input->get('course_id');
        $this->type= $type;

        //Breadcrume

        $this->breadcrumbs->push(lang('Portfolio Course'), '/portfolio_course');
        $this->breadcrumbs->push(lang($this->type).' '.lang('Management'), '/portfolio_course/'.$this->type.'?id='.$this->course_id);
        $this->breadcrumbs->push(lang('Category'), '/portfolio_course/category?type='. $this->type.'&course_id='.  $this->course_id);

        //variables will send to the view

        $this->view_params['course_id']= $this->course_id;
        $this->view_params['type']= $this->type;


        $header_params = [
            'title' => lang('Category Settings'),
            'icon' => 'fa fa-cog'
        ];

        if( Orm_User::check_credential(array(Orm_User::USER_FACULTY,Orm_User::USER_STAFF), false, 'portfolio_course-manage')) {
            $header_params['link_attr']  = 'href="/portfolio_course/forms/add_edit_custom_menu/'. $this->type.'?id='. $this->course_id.'" data-toggle="ajaxModal"';
            $header_params['link_icon'] = 'plus';
            $header_params['link_title'] = lang('Add').' '.lang('Category');
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', $header_params, true);
    }

    /**
     * this function category list
     * @return string the call function
     */
    public function category_list(){
        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');
        $fltr = $this->input->get_post('fltr');

        if (!$page) {
            $page = 1;
        }

        $filters = array('course_id'=> $this->course_id,'level'=>$this->type);

        if (!empty($fltr['keyword'])) {
            $filters['keyword'] = trim($fltr['keyword']);
        }

        $custom_menus = Orm_Pc_Category::get_all($filters,$page,$per_page);

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Pc_Category::get_count($filters));

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['fltr'] = $fltr;
        $this->view_params['categories'] = $custom_menus;
    }

    /**
     *this function index
     * @return string the html view
     */
    public function index(){
        $this->category_list();
        $this->layout->view('portfolio_course/forms/category_list', $this->view_params);
    }

    /**
     *this function filter
     * @return string the html view
     */
    public function filter() {
        if ($this->input->is_ajax_request()) {
            $this->category_list();
            $this->load->view('portfolio_course/forms/category_table', $this->view_params);
        } else {
            $this->index();
        }
    }


}