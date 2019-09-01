<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of accreditation
 *
 * @author qanah
 */
class Checker extends CI_Controller
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

        foreach(Orm_Cron_Job::get_all(array('is_released' => 0)) as $job) {

            switch ($job->get_schedule()) {
                case Orm_Cron_Job::SCHEDULE_DAILY:
                    $this->log("JOB : Released ({$job->get_job()})");
                    exec('php ' . FCPATH . 'index.php cli ' . $job->get_job());
                    $this->log("JOB : Finished ({$job->get_job()})");

                    $job->set_date_released(date('Y-m-d H:i:s'));
                    $job->save();
                    break;
                case Orm_Cron_Job::SCHEDULE_WEEKLY:
                    if (date('w') == 6) {
                        $this->log("JOB : Released ({$job->get_job()})");
                        exec('php ' . FCPATH . 'index.php cli ' . $job->get_job());
                        $this->log("JOB : Finished ({$job->get_job()})");

                        $job->set_date_released(date('Y-m-d H:i:s'));
                        $job->save();
                    }
                    break;
                case Orm_Cron_Job::SCHEDULE_MONTHLY:
                    if (date("Y-m-d") == date("Y-m-t")) {
                        $this->log("JOB : Released ({$job->get_job()})");
                        exec('php ' . FCPATH . 'index.php cli ' . $job->get_job());
                        $this->log("JOB : Finished ({$job->get_job()})");

                        $job->set_date_released(date('Y-m-d H:i:s'));
                        $job->save();
                    }
                    break;
                case Orm_Cron_Job::SCHEDULE_SEMESTER:
                    if (date("Y-m-d") == Orm_Semester::get_active_semester()->get_end()) {
                        $this->log("JOB : Released ({$job->get_job()})");
                        exec('php ' . FCPATH . 'index.php cli ' . $job->get_job());
                        $this->log("JOB : Finished ({$job->get_job()})");

                        $job->set_date_released(date('Y-m-d H:i:s'));
                        $job->save();
                    }
                    break;
                default:
                    $this->log("JOB : Released ({$job->get_job()})");
                    exec('php ' . FCPATH . 'index.php cli ' . $job->get_job());
                    $this->log("JOB : Finished ({$job->get_job()})");

                    $job->set_is_released(1);
                    $job->set_date_released(date('Y-m-d H:i:s'));
                    $job->save();
                    break;
            }
        }
    }

    private function log($text){
        echo $text . ' ' . date('Y-m-d H:i:s') . "\n";
    }

}