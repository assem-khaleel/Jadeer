<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Sp_Strategy_Institution extends Orm_Sp_Strategy {

    protected $item_class = __CLASS__;

    public function add_college(Orm_College $college)
    {

        $obj = new Orm_Sp_Strategy_College();
        $obj->set_strategy_id($this->get_strategy_id());
        $obj->set_year($this->get_year());
        $obj->set_parent_id($this->get_id());
        $obj->set_title_en($college->get_name_en());
        $obj->set_title_ar($college->get_name_ar());
        $obj->set_item_id($college->get_id());
        $obj->generate();

        return $obj;
    }

    public function add_unit(Orm_Unit $unit)
    {

        $obj = new Orm_Sp_Strategy_Unit();
        $obj->set_strategy_id($this->get_strategy_id());
        $obj->set_year($this->get_year());
        $obj->set_parent_id($this->get_id());
        $obj->set_title_en($unit->get_name_en());
        $obj->set_title_ar($unit->get_name_ar());
        $obj->set_item_id($unit->get_id());
        $obj->generate();

        return $obj;
    }

    /**
     * @return Orm_Sp_Strategy
     */
    public function get_children_strategies()
    {

        foreach (Orm_College::get_all() as $college) {
            $this->add_college($college);
        }

        foreach (Orm_Unit::get_all() as $unit) {
            $this->add_unit($unit);
        }

        return array();
    }

    /**
     * @return Orm_Institution
     */
    public function get_item_obj() {
        return Orm_Institution::get_instance();
    }

}