<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 25/07/18
 * Time: 10:54 ص
 */

class Report extends MX_Controller
{
    /**
     * View Params
     * @var array => the array pf data that will send to views
     */
    private $view_params = array();

    /**
     * Report constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if (!License::get_instance()->check_module('report', true)) {
            show_404();
        }

        Orm_User::check_logged_in();
        Orm_User::check_permission(array(
            Orm_User::USER_STAFF,
            Orm_User::USER_FACULTY),
            false, 'report-list');


        $this->breadcrumbs->push(lang('Report'), '/report');


        $this->view_params['page_header'] = $this->load->view('/common/page_header', array(
            'title' => lang('Report'),
            'icon' => 'fa fa-flag',
        ), true);

    }


    /**
     *index function will make you go to 2 pages if you choose to select a course then you  will go to course Controller else you will go to program Controller
     * you must to know that this Module mapped with Four Module
     * 1. Curriculum Mapping Modle to get Information for Both Program and Course
     * 2. Assessment Metrics Module to get the assessment Metrics that Built for Course and Program
     * 3. Assessment Loop that created for course or program depends on CLO,PLO, or program Objective
     * 4. PRogram Tree Module to get the relation for program Information's together
     */
    public function index()
    {
        if (!License::get_instance()->check_module('curriculum_mapping')) {
            show_404();
        }
        Modules::run('curriculum_mapping');

        if(Orm_User::has_role_type(Orm_Role::ROLE_NOT_ADMIN)) {
            echo Modules::run('report/course_report/index');
        } else {
            echo Modules::run('report/program_report/index');
        }


    }

}