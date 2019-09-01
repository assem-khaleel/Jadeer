<?php
/**
 * Created by PhpStorm.
 * User: ahmadgx
 * Date: 02/12/15
 * Time: 02:05 م
 */

namespace Node\ncai14;


class Inst_Prof_Table_1 extends \Orm_Node{

    protected $class_type = __CLASS__;
    protected $name = 'Table1. Institutional Performance Indicators';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;
    protected $link_send_to_review = true;
    protected $orientation = 'landscape';

    public function init()
    {
        parent::init();

        $this->set_inst_performance(array());
    }



    /*
  * Table 1.  Institutional Performance Indicators
  */

    public function set_inst_performance($value){

        $property = new \Orm_Property_Table_Dynamic('inst_performance', $value);

        $code = new \Orm_Property_Text('code');
        $code->set_description('Code');
        $code->set_width(100);
        $property->add_property($code);

        $indicator = new \Orm_Property_Textarea('indicator');
        $indicator->set_description('Indicator');
        $indicator->set_enable_tinymce(false);
        $indicator->set_width(400);
        $property->add_property($indicator);

        $value = new \Orm_Property_Text('value');
        $value->set_description('Value');
        $value->set_width(100);
        $property->add_property($value);
        $this->set_property($property);

    }
    public function get_inst_performance(){
        return $this->get_property('inst_performance')->get_value();
    }

    public function header_actions(&$actions = array()) {

        if ($this->check_if_editable()) {
            if(\License::get_instance()->check_module('kpi')) {
                $actions[] = array(
                    'class' => 'btn',
                    'title' => '<i class="fa fa-database"></i> ' . lang('Integration'),
                    'extra' => 'onclick="integration(this, ' . $this->get_id() . ');" ' . data_loading_text(true) . ' title="Extraction of data from other modules"'
                );
            }
        }

        return parent::header_actions($actions);
    }

    public function integration_processes() {
        parent::integration_processes();

        if(\License::get_instance()->check_module('kpi') && \Modules::load('kpi')) {
            $kpis = \Orm_Kpi::get_all(array('category_id' => \Orm_Kpi::KPI_ACCREDITATION));

            $indicators = array();
            foreach ($kpis as $i => $kpi) {

                $info = $kpi->get_info(\Orm_Kpi_Detail::TYPE_INSTITUTION, array('academic_year' => $this->get_year()));

                $indicators[$i]['code'] = $kpi->get_code();
                $indicators[$i]['indicator'] = $kpi->get_title();
                $indicators[$i]['value'] = $info['actual_benchmarks'];
            }
            $this->set_inst_performance($indicators);
            $this->save();
        }
    }



}