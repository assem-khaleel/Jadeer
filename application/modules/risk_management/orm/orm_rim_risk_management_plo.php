<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Rim_Risk_Management_Plo extends Orm_Rim_Risk_Management {

    protected $type = __CLASS__;

    public function __construct(){
        parent::__construct();

        Modules::load('curriculum_mapping');
    }
    /** draw propriteies for this type(plo management)
     */
    public function draw_properties() {
        echo Orm::get_ci()->load->view('types/plo/properties', array('risk_management' => $this), true);
    }
    /** ajax for this specific type to render it as ajax
     */
    public function ajax() {
        echo Orm::get_ci()->load->view('types/plo/ajax', array('risk_management' => $this), true);
    }
    /** get title of this plo type
     */
    public function get_type_title() {
        $obj = Orm_Cm_Program_Learning_Outcome::get_instance($this->get_type_id());
        return $obj->get_id() ? $obj->get_text() : lang('Source Deleted');
    }
    /** draw pdf file and get title of it
     */
    public function draw($pdf=false) {

        return htmlfilter($this->get_type_title());
    }

}

