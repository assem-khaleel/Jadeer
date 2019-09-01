<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/30/17
 * Time: 12:12 PM
 */

class Orm_Unit_Admin extends Orm_Unit {

    protected $class_type = __CLASS__;

    public function draw_parents() {
        $html = '';
        $html .= "<div class='form-group'>";
        $html .= "<label class='control-label' for='parent_id'> ".lang('Parent Unit')." </label>";
        $html .= "<select name='parent_id' id='parent_id' class='form-control'>";
        foreach (Orm_Unit::get_all(array('not_id' => $this->get_id())) as $unit) {
            $selected = $unit->get_id() == $this->get_parent_id() ? 'selected="selected"' : '';
            $html .= "<option value='".$unit->get_id()."' " . $selected . ">" . htmlfilter($unit->get_name()) . "</option>";
        }
        $html .= "</select>";
        $html .= "</div>";

        return $html;
    }
}