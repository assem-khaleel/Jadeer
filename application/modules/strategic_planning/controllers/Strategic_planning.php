<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Mazen Dabet
 * Date: 10/1/15
 * Time: 11:30 AM
 */

/**
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * @property Breadcrumbs $breadcrumbs
 * Class Manager
 */
class Strategic_Planning extends MX_Controller
{

    /**
     * View Params
     * @var array
     */
    private $view_params = array();

    /**
     * Strategic_Planning constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if(!License::get_instance()->check_module('strategic_planning')) {
            show_404();
        }

        Orm_User::check_logged_in();

        Modules::load('kpi');

        $this->view_params['menu_tab'] = 'strategic_planning';
        $this->view_params['menu_header'] = '<h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-sitemap page-header-icon"></i>&nbsp;&nbsp;' . lang('Strategic Planning') . '</h1></i>';

        $this->view_params['type'] = 'vision_mission';

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Strategic Planning'),
            'icon' => 'fa fa-road'
        ), true);

        $this->layout->add_javascript('https://www.google.com/jsapi', false);
        $this->layout->add_javascript('/assets/jadeer/js/period.js');
    }

    /**
     *this function index
     * @return string the html view
     * default controller action
     */
    public function index()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'strategic_planning-list');

        $per_page = $this->config->item('per_page');
        $page = (int)$this->input->get_post('page');

        if (!$page) {
            $page = 1;
        }

        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_page($page);
        $pager->set_per_page($per_page);
        $pager->set_total_count(Orm_Sp_Strategy::get_count(['parent_id'=>0]));

        $this->view_params['pager'] = $pager->render(true);

        $strategies = Orm_Sp_Strategy::get_all(['parent_id'=>0], $page, $per_page, ['id desc']);

        $header_array = array(
            'title' => lang('Strategic Planning'),
            'icon' => 'fa fa-road'
        );

        $header_array['link_attr'] = 'data-toggle="ajaxModal" href="/strategic_planning/generate"';
        $header_array['link_title'] = lang('Generate Strategy');
        $header_array['link_icon'] = 'plus';


        $this->view_params['page_header'] = $this->load->view('/common/page_header', $header_array, true);

        $this->breadcrumbs->push(lang('Strategic Planning'), '/strategic_planning');

        $this->view_params['strategies'] = $strategies;
        $this->layout->view('list', $this->view_params);

       // $this->details();
    }

    /**
     * this function details by its id
     * @param int $id the id of the details to be viewed
     * @return string the html view
     */
    public function details($id = 0)
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'strategic_planning-list');

        $fltr = $this->input->get_post('fltr');

        Orm_User::get_logged_user()->get_filters($fltr);

        if ($id) {
            $strategy = Orm_Sp_Strategy::get_instance($id);
        } else {
            $strategy = Orm_Sp_Strategy::get_active_strategy();
            if (!empty($fltr)) {
                if (!empty($fltr['program_id'])) {
                    $strategy = Orm_Sp_Strategy::get_one(array('strategy_id' => $strategy->get_id(), 'item_class' => 'Orm_Sp_Strategy_Program', 'item_id' => $fltr['program_id']));
                } elseif (!empty($fltr['college_id'])) {
                    $strategy = Orm_Sp_Strategy::get_one(array('strategy_id' => $strategy->get_id(), 'item_class' => 'Orm_Sp_Strategy_College', 'item_id' => $fltr['college_id']));
                } elseif (!empty($fltr['unit_id'])) {
                    $strategy = Orm_Sp_Strategy::get_one(array('strategy_id' => $strategy->get_id(), 'item_class' => 'Orm_Sp_Strategy_Unit', 'item_id' => $fltr['unit_id']));
                }
            }
        }

        $header_array = array(
            'title' => lang('Strategic Planning') . ' - ' . lang('Dashboard') ,
            'icon' => 'fa fa-road'
        );

//        if ($this->input->method(true) !== 'POST') {
//            $header_array['link_attr'] = 'data-toggle="ajaxModal" href="/strategic_planning/generate"';
//            $header_array['link_title'] = lang('Generate Strategy');
//        }
        $this->view_params['page_header'] = $this->load->view('/common/page_header', $header_array, true);

        $this->breadcrumbs->push(lang('Strategic Planning'), '/strategic_planning');
        $this->breadcrumbs->push(lang('Details'), '/strategic_planning/details/'.$id);

        $this->view_params['strategy'] = $strategy;
        $this->layout->view('manager/details/main', $this->view_params);
    }

    /**
     * this function show by its id
     * @param int $id the id of the show to be viewed
     * @return string the html view
     */
    public function show($id)
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'strategic_planning-list');

        $strategy = Orm_Sp_Strategy::get_instance($id);
        $this->view_params['strategy'] = $strategy;
        echo $this->load->view('manager/show', $this->view_params, true);
    }

    /**
     * this function basic info by its id
     * @param int $id the id of the basic info to be viewed
     * @return string the html view
     */
    public function basic_info($id = 0)
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'strategic_planning-list');

        $fltr = $this->input->get_post('fltr');

        if ($id) {
            $strategy = Orm_Sp_Strategy::get_instance($id);
        } else {
            $strategy = Orm_Sp_Strategy::get_active_strategy();
            if (!empty($fltr)) {
                if (!empty($fltr['program_id'])) {
                    $strategy = Orm_Sp_Strategy::get_one(array('strategy_id' => $strategy->get_id(), 'item_class' => Orm_Sp_Strategy_Program::class, 'item_id' => $fltr['program_id']));
                } elseif (!empty($fltr['college_id'])) {
                    $strategy = Orm_Sp_Strategy::get_one(array('strategy_id' => $strategy->get_id(), 'item_class' => Orm_Sp_Strategy_College::class, 'item_id' => $fltr['college_id']));
                } elseif (!empty($fltr['unit_id'])) {
                    $strategy = Orm_Sp_Strategy::get_one(array('strategy_id' => $strategy->get_id(), 'item_class' => Orm_Sp_Strategy_Unit::class, 'item_id' => $fltr['unit_id']));
                }
            }
        }

        if (empty($strategy) || !$strategy->get_id()) {
            Validator::set_error_flash_message(lang('Error : Please try Again'));
            redirect('/strategic_planning');
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Strategic Planning') . ' - ' . lang('Main') ,
            'icon' => 'fa fa-road',
        ), true);

        $this->breadcrumbs->push(lang('Developmental Planning'), '/strategic_planning');

        $this->view_params['strategy'] = $strategy;
        $this->view_params['sp_view_content'] = 'manager/basic_info';
        $this->layout->view('sp_layout', $this->view_params);
    }

    /**
     *this function hierarchy
     * @return string the html view
     */
    public function hierarchy()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'strategic_planning-list');

        $this->breadcrumbs->push(lang('Strategic Planning'), '/strategic_planning');

        $this->view_params['strategy_id'] = $this->input->get_post('strategy_id');

        if ($this->input->is_ajax_request()) {

            switch ($this->input->get_post('type')) {
                case 'item':
                    $this->load->view('manager/hierarchy/item', $this->view_params);
                    break;
            }

        } else {
            $this->layout->view('manager/hierarchy/view', $this->view_params);
        }
    }

    /**
     *this function generate
     * @redirect success or error
     */
    public function generate()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'strategic_planning-list');

        if (!$this->input->post()) {
            $strategy = new Orm_Sp_Strategy();
            $this->view_params['strategy'] = $strategy;
            $this->load->view('manager/generate', $this->view_params);
        } else {
            $desc_en = $this->input->post('desc_en');
            $desc_ar = $this->input->post('desc_ar');
            $start_year = $this->input->post('start_year');
            $year = $this->input->post('for_year');

            Validator::integer_field_validator('start_year', $year, lang('Year is not valid'));
            Validator::integer_field_validator('for_year', $year, lang('Year is not valid'));

            $active_strategy = Orm_Sp_Strategy::get_active_strategy();
            if ($year <= $active_strategy->get_year()) {
                Validator::set_error('for_year', lang('Year is not valid'));
            }

            if ($start_year >= $year) {
                Validator::set_error('start_year', lang('Year is not valid'));
                Validator::set_error('for_year', lang('Year is not valid'));
            }

            if(Orm_Sp_Strategy::get_count(['parent_id'=>0, 'between_year'=> $year, 'or_between_year'=>$start_year])){
                Validator::set_error('start_year', lang('There is an exist strategic plan cover this period'));
                Validator::set_error('for_year', lang('There is an exist strategic plan cover this period'));
            }

            $obj = new Orm_Sp_Strategy_Institution();
            $obj->set_start_year($start_year);
            $obj->set_year($year);
            $obj->set_title_en(Orm_Institution::get_university_name('english'));
            $obj->set_title_ar(Orm_Institution::get_university_name('arabic'));
            $obj->set_description_ar($desc_ar);
            $obj->set_description_en($desc_en);

            if (Validator::success()) {

                $id = $obj->save();

                $obj->set_strategy_id($id);
                $obj->generate();
                $obj->build_parent_tree();

                json_response(array('error' => FALSE));
            } else {
                $this->view_params['strategy'] = $obj;
                json_response(array('error' => true, 'html' => $this->load->view('manager/generate', $this->view_params, true)));
            }
        }
    }

    /**
     *this function regenerate
     * @return string the html view
     */
    public function regenerate() {
        $active_strategy = Orm_Sp_Strategy::get_active_strategy();
        if ($active_strategy->get_id()) {
            $institution = Orm_Sp_Strategy_Institution::get_one(['strategy_id' => $active_strategy->get_strategy_id()]);
            $institution->generate();
            $institution->build_parent_tree();
        }

        redirect($this->input->server('HTTP_REFERER'));
    }

    /**
     *this function edit vision
     * @return string the html view
     */
    public function edit_vision()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'strategic_planning-list');

        $id = $this->input->get('id');
        $item = Orm_Sp_Strategy::get_instance($id);
        $this->view_params['vision'] = $item;
        $this->load->view('manager/edit_vision', $this->view_params);
    }

    /**
     *this function integrate mission
     * @return string the html view
     */
    public  function integrate_mission()
    {
        $id = $this->input->post('id');
        $item = Orm_Sp_Strategy::get_instance($id);

        $item->set_mission_en($item->get_item_obj()->get_mission_en());
        $item->set_mission_ar($item->get_item_obj()->get_mission_ar());
        $item->save();

        $this->view_params['mission'] = $item;
        $this->load->view('manager/edit_mission', $this->view_params);
    }

    /**
     *this function integrate vision
     * @return string the html view
     */
    public  function integrate_vision()
    {
        $id = $this->input->post('id');
        $item = Orm_Sp_Strategy::get_instance($id);

        $item->set_vision_en($item->get_item_obj()->get_vision_en());
        $item->set_vision_ar($item->get_item_obj()->get_vision_ar());
        $item->save();

        $this->view_params['vision'] = $item;
        $this->load->view('manager/edit_vision', $this->view_params);
    }

    /**
     *this function edit mission
     * @return string the html view
     */
    public function edit_mission()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'strategic_planning-list');

        $id = $this->input->get('id');
        $item = Orm_Sp_Strategy::get_instance($id);
        $this->view_params['mission'] = $item;
        $this->load->view('manager/edit_mission', $this->view_params);
    }

    /**
     * this function save mission
     * @redirect success or error
     */
    public function save_mission()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'strategic_planning-list');

        $id = (int)$this->input->post('id');
        $title_ar = $this->input->post('title_arabic');
        $title_en = $this->input->post('title_english');

        // validation
        Validator::required_field_validator('title_arabic', $title_ar, lang('field required'));
        Validator::required_field_validator('title_english', $title_en, lang('field required'));

        $item = Orm_Sp_Strategy::get_instance($id);
        $item->set_mission_ar($title_ar);
        $item->set_mission_en($title_en);

        if (Validator::success()) {
            $item->save();

            Validator::set_success_flash_message(lang('Mission Successfully Saved'));
            json_response(array('error' => FALSE));
        }
        $this->view_params['mission'] = $item;
        json_response(array('error' => TRUE, 'html' => $this->load->view('manager/edit_mission', $this->view_params, true)));
    }

    /**
     * this function save vision
     * @redirect success or error
     */
    public function save_vision()
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'strategic_planning-list');

        $id = (int)$this->input->post('id');
        $title_ar = $this->input->post('title_arabic');
        $title_en = $this->input->post('title_english');

        // validation
        Validator::required_field_validator('title_arabic', $title_ar, lang('field required'));
        Validator::required_field_validator('title_english', $title_en, lang('field required'));

        $item = Orm_Sp_Strategy::get_instance($id);
        $item->set_vision_ar($title_ar);
        $item->set_vision_en($title_en);

        if (Validator::success()) {
            $item->save();

            Validator::set_success_flash_message(lang('Vision Successfully Saved'));
            json_response(array('error' => FALSE));
        }
        $this->view_params['vision'] = $item;
        json_response(array('error' => TRUE, 'html' => $this->load->view('manager/edit_vision', $this->view_params, true)));
    }
    /**
     * this function delete by its id
     * @param int $id the id of the delete to be viewed
     * @redirect success or error
     */
    public function delete($id)
    {
        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'strategic_planning-list');

        $item = Orm_Sp_Strategy::get_instance($id);

        if ($item->get_id()) {
            $item->delete();
        }
        Validator::set_success_flash_message(lang('Activity removed successfully'));
        redirect('/strategic_planning');
    }

    /**
     * this function kpis
     * @return string the html view
     */
    public function kpis() {

        $fltr = $this->input->get_post('fltr');
        $strategy = Orm_Sp_Strategy::get_active_strategy();

        if (!empty($fltr)) {
            if (!empty($fltr['program_id'])) {
                $strategy = Orm_Sp_Strategy::get_one(array('strategy_id' => $strategy->get_id(), 'item_class' => 'Orm_Sp_Strategy_Program', 'item_id' => $fltr['program_id']));
            } elseif (!empty($fltr['college_id'])) {
                $strategy = Orm_Sp_Strategy::get_one(array('strategy_id' => $strategy->get_id(), 'item_class' => 'Orm_Sp_Strategy_College', 'item_id' => $fltr['college_id']));
            } elseif (!empty($fltr['unit_id'])) {
                $strategy = Orm_Sp_Strategy::get_one(array('strategy_id' => $strategy->get_id(), 'item_class' => 'Orm_Sp_Strategy_Unit', 'item_id' => $fltr['unit_id']));
            }
        }

        $this->view_params['strategy'] = $strategy;
        $this->layout->view('manager/details/kpis', $this->view_params);
    }
}