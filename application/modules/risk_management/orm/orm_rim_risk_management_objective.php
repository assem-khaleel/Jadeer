<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Rim_Risk_Management_Objective extends Orm_Rim_Risk_Management {

    protected $type = __CLASS__;

    /** draw propriteies for this type(objective management)
     */
    public function draw_properties() {
        echo Orm::get_ci()->load->view('types/objective/properties', array('risk_management' => $this), true);
    }
    /** ajax for this specific type to render it as ajax
     */
    public function ajax() {
        echo Orm::get_ci()->load->view('types/objective/ajax', array('risk_management' => $this), true);
    }
    /** get title of this objective type
     */
    public function get_type_title() {

        /** @var Orm_Institution_Objective $class_type */
        $class_type = '';
        switch($this->get_level_type()){
            case $this::RISK_INSTITUTION_LEVEL:
                $class_type = Orm_Institution_Objective::class;
                break;

            case $this::RISK_COLLEGE_LEVEL:
                $class_type = Orm_College_Objective::class;
                break;

            case $this::RISK_PROGRAM_LEVEL:
                $class_type = Orm_Program_Objective::class;
                break;

            case $this::RISK_UNIT_LEVEL:
                $class_type = Orm_Unit_Objective::class;
                break;
        }

        if (class_exists($class_type)) {
            $item_object = $class_type::get_instance($this->get_type_id());

            if ($item_object->get_id()) {
                return $item_object->get_title();
            }
        }

        return lang('Source Deleted');
    }
    /** draw pdf file and get title of it
     */
    public function draw($pdf=false) {
        return htmlfilter($this->get_type_title());
    }
}

