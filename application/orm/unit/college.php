<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/30/17
 * Time: 12:12 PM
 */

class Orm_Unit_College extends Orm_Unit {

    protected $class_type = __CLASS__;

    public function draw_parents() {
        $html = '';
        $html .= "<div class='form-group'>";
        $html .= "<label class='control-label' for='parent_id'> ".lang('Parent Unit')." </label>";
        $html .= "<select name='parent_id' id='parent_id' class='form-control'>";
        foreach (Orm_College::get_all() as $college) {
            $selected = $college->get_id() == $this->get_parent_id() ? 'selected="selected"' : '';
            $html .= "<option value='".$college->get_id()."' " . $selected . ">" . htmlfilter($college->get_name()) . "</option>";
        }
        $html .= "</select>";
        $html .= "</div>";

        return $html;
    }
}