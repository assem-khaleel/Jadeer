<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Sp_Strategy_College extends Orm_Sp_Strategy {

    protected $item_class = __CLASS__;

    public function add_program(Orm_Program $program)
    {

        $obj = new Orm_Sp_Strategy_Program();
        $obj->set_strategy_id($this->get_strategy_id());
        $obj->set_year($this->get_year());
        $obj->set_parent_id($this->get_id());
        $obj->set_title_en($program->get_name_en());
        $obj->set_title_ar($program->get_name_ar());
        $obj->set_item_id($program->get_id());
        $obj->generate();

        return $obj;
    }

    /**
     * @return Orm_Sp_Strategy
     */
    public function get_children_strategies()
    {

        foreach (Orm_Program::get_all(array('college_id' => $this->get_item_id())) as $program) {
            $this->add_program($program);
        }

        return array();
    }

    /**
     * @return Orm_College
     */
    public function get_item_obj() {
        return Orm_College::get_instance($this->get_item_id());
    }
}