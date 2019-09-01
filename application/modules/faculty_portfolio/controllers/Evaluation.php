<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/17/16
 * Time: 11:13 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Breadcrumbs $breadcrumbs
 * @property Layout $layout
 * @property CI_Input $input
 * @property CI_Config $config
 * Class Evaluation
 */
class Evaluation extends MX_Controller
{

    private $view_params = array();

    /**
     * Evaluation constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if (!License::get_instance()->check_module('faculty_portfolio', true)) {
            show_404();
        }

        Orm_User::check_logged_in();

        $this->breadcrumbs->push(lang('Faculty Portfolio'), '/faculty_portfolio');

        $this->view_params['menu_tab'] = 'faculty_portfolio';

        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Faculty Portfolio'),
            'icon' => 'fa fa-university',
            'link_attr' => 'href="/user/profile"'
        ), true);
    }

    /**
     * this function info by its buffer and user id
     * @param bool $buffer the buffer of the info to be viewed
     * @param int $user_id the user id of the info to be viewed
     * @return mixed the html view
     */
    public function info($user_id = 0, $buffer = false) {

            if(!$user_id) {
                $user_id = Orm_User::get_logged_user_id();
            }

            $this->view_params['sub_menu'] = 'menu';
            $this->view_params['user_id'] = $user_id;
            $this->view_params['active'] = "evaluation";
        if ($this->input->is_ajax_request()) {
            if ($buffer) {
                return $this->load->view("faculty_portfolio/evaluation/list", $this->view_params, true);
            } else {
                $this->load->view("faculty_portfolio/evaluation/list", $this->view_params);
            }
        } else {
            $this->layout->view("faculty_portfolio/evaluation/list", $this->view_params);
        }
    }

    /**
     * this function manage score by its to user id and tab id and row id and col id
     * @param int $user_id the user id of the manage score to be viewed
     * @param int $tab_id the tab id of the manage score to be viewed
     * @param int $row_id the row id of the manage score to be viewed
     * @param int $col_id the col id of the manage score to be viewed
     * @redirect success or error
     */
    public function manage_score($user_id, $tab_id, $row_id, $col_id){

        $logged_id = Orm_User::get_logged_user_id();
        $academic_year = Orm_Semester::get_active_semester()->get_year();

        $evaluation_obj = Orm_Fp_Evaluation::get_one([
            'academic_year'  => $academic_year,
            'user_id'        => $user_id,
            'eva_tab_id'     => $tab_id,
            'eva_tab_row_id' => $row_id,
            'eva_tab_col_id' => $col_id
        ]);

        $score = 0;
        $peer_id = 0;
        $supervisor_id = 0;
        $title = 'Score';

        if($logged_id == $evaluation_obj->get_user_id()) {

            $title = 'Avg. Personal Assessed Score';
            $score = $evaluation_obj->get_user_score();
            $peer_id = $evaluation_obj->get_peer_id();
            $supervisor_id = $evaluation_obj->get_supervisor_id();

        } elseif($logged_id == $evaluation_obj->get_peer_id()) {

            $title = 'Avg. Peer Assessed Score';
            $score = $evaluation_obj->get_peer_score();

        } elseif($logged_id == $evaluation_obj->get_supervisor_id()) {

            $title = 'Avg. Supervisor Assessed Score';
            $score = $evaluation_obj->get_supervisor_score();

        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $score = $this->input->post('score');
            $peer_id = intval($this->input->post('peer_id'));
            $supervisor_id = intval($this->input->post('supervisor_id'));

            Validator::numeric_field_validator('score', $score, lang('required field'));
            Validator::greater_than_validator('score', floatval($score), 101, lang('Invalid Value'));
            Validator::less_than_validator('score', floatval($score), -1, lang('Invalid Value'));

            $evaluation_obj->set_academic_year($academic_year);
            $evaluation_obj->set_user_id($user_id);
            $evaluation_obj->set_level(1);
            $evaluation_obj->set_eva_tab_id($tab_id);
            $evaluation_obj->set_eva_tab_row_id($row_id);
            $evaluation_obj->set_eva_tab_col_id($col_id);

            if($logged_id == $evaluation_obj->get_user_id()) {

                Validator::not_empty_field_validator('peer_id', $peer_id, lang('required field'));
                Validator::not_empty_field_validator('supervisor_id', $supervisor_id, lang('required field'));

                $evaluation_obj->set_user_score(floatval($score));
                $evaluation_obj->set_peer_id($peer_id);
                $evaluation_obj->set_supervisor_id($supervisor_id);


            } elseif($logged_id == $evaluation_obj->get_peer_id()) {

                $evaluation_obj->set_peer_score(floatval($score));

            } elseif($logged_id == $evaluation_obj->get_supervisor_id()) {

                $evaluation_obj->set_supervisor_score(floatval($score));

            }

            if(Validator::success()) {

                $evaluation_obj->save();

                json_response(array('status' => true, 'html' => $this->info($user_id, true)));
            }
        }

        $this->view_params['title']          = $title;
        $this->view_params['score']          = $score;

        $this->view_params['user_id']        = $user_id;
        $this->view_params['peer_id']        = $peer_id;
        $this->view_params['supervisor_id']  = $supervisor_id;

        $this->view_params['tab_id']     = $tab_id;
        $this->view_params['tab_row_id'] = $row_id;
        $this->view_params['tab_col_id'] = $col_id;


        $html = $this->load->view('faculty_portfolio/evaluation/manage_score', $this->view_params, true);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => $html));
        } else {
            echo $html;
        }

    }
}