<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Strategic_Planning
 **/
class Strategic_Planning extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!is_cli()) {
            exit('No direct script access allowed');
        }
    }

    public function index()
    {
        $this->activities_history();
        $this->project_history();
        $this->action_plan_history();
        $this->initiative_history();
        $this->objective_history();
        $this->goal_history();
        $this->strategy_history();
        $this->kpi_history();
    }

    private function activities_history() {

        Modules::load('strategic_planning');

        foreach (Orm_Sp_Activity::get_all() as $item) {
            $sp = new Orm_Sp_Activity_History();
            $sp->set_activity_id($item->get_id());
            $sp->set_date(date('Y-m-d'));
            $sp->set_lead($item->get_lead());
            $sp->set_lag($item->get_lag());
            $sp->save();
        }
    }

    private function project_history() {

        Modules::load('strategic_planning');

        foreach (Orm_Sp_Project::get_all() as $item) {
            $sp = new Orm_Sp_Project_History();
            $sp->set_project_id($item->get_id());
            $sp->set_date(date('Y-m-d'));
            $sp->set_lead($item->get_lead());
            $sp->set_lag($item->get_lag());
            $sp->save();
        }
    }

    private function action_plan_history() {

        Modules::load('strategic_planning');

        foreach (Orm_Sp_Action_Plan::get_all() as $item) {
            $sp = new Orm_Sp_Action_Plan_History();
            $sp->set_action_plan_id($item->get_id());
            $sp->set_date(date('Y-m-d'));
            $sp->set_lead($item->get_lead());
            $sp->set_lag($item->get_lag());
            $sp->save();
        }
    }

    private function initiative_history() {

        Modules::load('strategic_planning');

        foreach (Orm_Sp_Initiative::get_all() as $item) {
            $sp = new Orm_Sp_Initiative_History();
            $sp->set_initiative_id($item->get_id());
            $sp->set_date(date('Y-m-d'));
            $sp->set_lead($item->get_lead());
            $sp->set_lag($item->get_lag());
            $sp->save();
        }
    }

    private function objective_history() {

        Modules::load('strategic_planning');

        foreach (Orm_Sp_Objective::get_all() as $item) {
            $sp = new Orm_Sp_Objective_History();
            $sp->set_objective_id($item->get_id());
            $sp->set_date(date('Y-m-d'));
            $sp->set_lead($item->get_lead());
            $sp->set_lag($item->get_lag());
            $sp->save();
        }
    }

    private function goal_history() {

        Modules::load('strategic_planning');

        foreach (Orm_Sp_Goal::get_all() as $item) {
            $sp = new Orm_Sp_Goal_History();
            $sp->set_goal_id($item->get_id());
            $sp->set_date(date('Y-m-d'));
            $sp->set_lead($item->get_lead());
            $sp->set_lag($item->get_lag());
            $sp->save();
        }
    }

    private function strategy_history() {

        Modules::load('strategic_planning');

        foreach (Orm_Sp_Strategy::get_all() as $item) {
            $sp = new Orm_Sp_Strategy_History();
            $sp->set_strategy_id($item->get_id());
            $sp->set_date(date('Y-m-d'));
            $sp->set_lead($item->get_lead());
            $sp->set_lag($item->get_lag());
            $sp->save();
        }
    }


    private function kpi_history() {

        Modules::load('strategic_planning');

        foreach (Orm_Sp_Kpi::get_all() as $item) {
            $sp = new Orm_Sp_Kpi_History();
            $sp->set_kpi_id($item->get_id());
            $sp->set_date(date('Y-m-d'));
            $sp->set_band($item->get_band());
            $sp->save();
        }
    }
}