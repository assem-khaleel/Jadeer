<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Sp_Strategy_Program extends Orm_Sp_Strategy {

    protected $item_class = __CLASS__;

    /**
     * @return Orm_Program
     */
    public function get_item_obj() {
        return Orm_Program::get_instance($this->get_item_id());
    }

}