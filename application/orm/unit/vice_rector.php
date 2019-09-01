<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/30/17
 * Time: 12:12 PM
 */

class Orm_Unit_Vice_Rector extends Orm_Unit {

    protected $class_type = __CLASS__;

    public function draw_parents() {
        $html = '';
        $html .= "<div class='form-group'>";
        $html .= "<label class='control-label' for='parent_id'> ".lang('Parent Unit')." </label>";
        $html .= "<select name='parent_id' id='parent_id' class='form-control'>";
        foreach (Orm_Unit_Rector::get_all(array('class_type' => Orm_Unit_Rector::class, 'not_id' => $this->get_id())) as $rectors) {
            $selected = $rectors->get_id() == $this->get_parent_id() ? 'selected="selected"' : '';
            $html .= "<option value='".$rectors->get_id()."' " . $selected . ">" . htmlfilter($rectors->get_name()) . "</option>";
        }
        $html .= "</select>";
        $html .= "</div>";

        $html .= "<div class='form-group'>";
        $html .= "<label class='control-label' for='is-academic'> ".lang('Academic Unit')." </label>";
        $html .= "<div>";
        $html .= "<label class='radio-inline'>";
        $html .= "<input type='radio' name='academic_unit' id='is-academic' value='0' " . ($this->get_is_academic() == self::UNIT_NONE_ACADEMIC ? 'checked="checked"' : '') . ">" . lang('No');
        $html .= "</label>";
        $html .= "<label class='radio-inline'>";
        $html .= "<input type='radio' name='academic_unit' id='is-academic' value='1' " . ($this->get_is_academic() == self::UNIT_ACADEMIC ? 'checked="checked"' : '') . ">" . lang('Yes');
        $html .= "</label>";
        $html .= "</div>";
        $html .= "</div>";

        return $html;
    }
}