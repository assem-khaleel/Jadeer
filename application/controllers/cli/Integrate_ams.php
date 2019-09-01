<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 *
 */

/**
 * Description of accreditation
 *
 * @author qanah
 */
class Integrate_Ams extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();

        if(!is_cli())
        {
            exit('No direct script access allowed');
        }
    }

    public function index() {

        Modules::load('accreditation');

        $ams_logs = Orm_Ams_Log::get_all(array('is_released' => 0));

        if($ams_logs) {

            $index = 0;
            $data = array();
            foreach($ams_logs as $ams_log) {
                $index++;

                $data[$index]['type'] = $ams_log->get_type();
                $data[$index]['forms'] = array();

                foreach($ams_log->get_forms() as $form_key) {

                    $plan_id = null;
                    if (strpos(strtolower($form_key), 'course-') === 0) {
                        $form_keys = explode('-', $form_key);
                        $plan_id = $form_keys[1];
                        $form_id = $form_keys[2];
                    } else {
                        $form_id = $form_key;
                    }

                    $form = Orm_Node::get_instance($form_id);
                    $ams_form = $form->generate_ams_form();

                    if(!is_null($plan_id)) {

                        $plan = Orm_Program_Plan::get_instance($plan_id);

                        $program_obj = $plan->get_program_obj();
                        $college_obj = $program_obj->get_department_obj()->get_college_obj();

                        $ams_form['program'] = array('id' => $program_obj->get_id(), 'name' => $program_obj->get_name('english'));
                        $ams_form['college'] = array('id' => $college_obj->get_id(), 'name' => $college_obj->get_name('english'));
                    }

                    $data[$index]['forms'][] = $ams_form;
                }
            }

            //print_r($data);die;

            $time = time();
            $file_path = FCPATH . "files_ams/push";
            if (!is_dir($file_path)) {
                mkdir($file_path, 0777, true);
            }

            file_put_contents("{$file_path}/{$time}.json", json_encode($data));
        }

    }

}