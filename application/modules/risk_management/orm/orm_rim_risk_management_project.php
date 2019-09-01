<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Rim_Risk_Management_Project extends Orm_Rim_Risk_Management {

    protected $type = __CLASS__;

    public function __construct(){
        parent::__construct();

        Modules::load('strategic_planning');
    }
    /** draw propriteies for this type(project management)
     */
    public function draw_properties() {
        echo Orm::get_ci()->load->view('types/project/properties', array('risk_management' => $this), true);
    }
    /** ajax for this specific type to render it as ajax
     */
    public function ajax() {
        echo Orm::get_ci()->load->view('types/project/ajax', array('risk_management' => $this), true);
    }
    /** get title of this project type
     */
    public function get_type_title() {
        $obj = Orm_Sp_Project::get_instance($this->get_type_id());
        return $obj->get_id() ? $obj->get_title() : lang('Source Deleted');
    }
    /** draw pdf file and get title of it
     */
    public function draw($pdf=false) {

        return htmlfilter($this->get_type_title());
    }

}

