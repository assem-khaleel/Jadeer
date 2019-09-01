<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 11/19/15
 * Time: 2:11 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');
//defined('MODULES_ONLY') OR exit('No direct script access allowed');

/**
 * @property CI_Input $input
 * @property Layout $layout
 * Class Strategic_Planning_Dashboard
 */
class Strategic_Planning_Dashboard extends MX_Controller {

    private $view_params;

    /**
     * Strategic_Planning_Dashboard constructor.
     */
    public function __construct() {
        parent::__construct();

        if(!License::get_instance()->check_module('strategic_planning', true)) {
            show_404();
        }

        Modules::load('kpi');

        Orm_User::check_logged_in();
        
        $this->layout->add_javascript('https://www.google.com/jsapi', false);
    }
    /**
     * this function index by its id
     * @param int $id the id of the index to be viewed
     * @return string the html view
     */
    public function index($id = 0) {

        Orm_User::check_permission(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, 'strategic_planning-list');
        $this->layout->add_javascript('/assets/jadeer/js/period.js');

        $fltr = $this->input->get_post('fltr');

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
        if ($this->input->method(true) !== 'POST') {
            $header_array['link_attr'] = 'data-toggle="ajaxModal" href="/strategic_planning/generate"';
            $header_array['link_icon'] = 'plus';
            $header_array['link_title'] = lang('Generate Strategy');
        }

        $this->view_params['page_header'] = $this->load->view('/common/page_header', $header_array, true);


        $this->view_params['strategy'] = $strategy;
        $this->load->view('strategic_planning/manager/hierarchy/front_dashboard', $this->view_params);

    }
    /**
     * this function view objective by its objective id
     * @param int $objective_id the objective id of the view objective to be viewed
     * @return string the html view
     */
    public function view_objective($objective_id) {

        $this->view_params['objective'] = Orm_Sp_Objective::get_instance($objective_id);
        $this->load->view('strategic_planning/manager/hierarchy/view', $this->view_params);

    }
}