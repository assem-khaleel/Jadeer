<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ssr_h_standard_4_kpi
 *
 * @author ahmadgx
 */
class Ssr_H_Standard_4_Kpi extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'KPI';
    protected $link_pdf = true;

    function init()
    {
        parent::init();
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $standard = 4;
        $standard_obj = \Orm_Standard::get_one(['code' => 4]);

        $children = array();

        if(\License::get_instance()->check_module('kpi') && \Modules::load('kpi')) {

            $program_node = $this->get_parent_program_node();

            $KPIs = \Orm_Kpi::get_all(array('standard_id' => $standard_obj->get_id(), 'college_id' => $program_node->get_parent_college_node()->get_item_id()));
            if ($KPIs) {
                foreach ($KPIs as $kpi) {

                    $info = $kpi->get_info(\Orm_Kpi_Detail::TYPE_PROGRAM, array('college_id' => $program_node->get_parent_college_node()->get_item_id(), 'program_id' => $program_node->get_item_id()));

                    $kpi_obj = new Kpi();
                    $kpi_obj->set_standard($standard);
                    $kpi_obj->set_kpi_id($kpi->get_id());
                    $kpi_obj->set_name("KPI {$info['code']}");
                    $kpi_obj->set_kpi_info($kpi->get_title());
                    $kpi_obj->set_kpi_ref_num($info['code']);
                    $kpi_obj->set_actual($info['actual_benchmarks']);
                    $kpi_obj->set_target($info['target_benchmarks']);
                    $kpi_obj->set_internal($info['internal_benchmarks']);
                    $kpi_obj->set_external($info['external_benchmarks']);
                    $kpi_obj->set_new_target($info['new_benchmarks']);
                    $children[] = $kpi_obj;
                }
            }
        } else {
            $kpi_1 = new kpi();
            $kpi_1->set_name('KPI S4.1');
            $kpi_1->set_kpi_info('7. Ratio of students to teaching staff.(Based on full time equivalents)');
            $kpi_1->set_kpi_ref_num('S4.1');
            $children[] = $kpi_1;

            $kpi_2 = new kpi();
            $kpi_2->set_name('KPI S4.2');
            $kpi_2->set_kpi_info('8. Students overall rating on the quality of their courses.(Average rating of students on a five point scale on overall evaluation of courses.)');
            $kpi_2->set_kpi_ref_num('S4.2');
            $children[] = $kpi_2;

            $kpi_3 = new kpi();
            $kpi_3->set_name('KPI S4.3');
            $kpi_3->set_kpi_info('9. Proportion of teaching staff with verified doctoral qualifications.');
            $kpi_3->set_kpi_ref_num('S4.3');
            $children[] = $kpi_3;

            $kpi_4 = new kpi();
            $kpi_4->set_name('KPI S4.4');
            $kpi_4->set_kpi_info('Retention Rate; <br/> 10. Percentage of students entering programs who successfully complete first year.');
            $kpi_4->set_kpi_ref_num('S4.4');
            $children[] = $kpi_4;

            $kpi_5 = new kpi();
            $kpi_5->set_name('KPI S4.5');
            $kpi_5->set_kpi_info('Graduation Rate for Undergraduate Students: <br/> 11. Proportion of students entering undergraduate programs who complete those programs in minimum time. ');
            $kpi_5->set_kpi_ref_num('S4.5');
            $children[] = $kpi_5;

            $kpi_6 = new kpi();
            $kpi_6->set_name('KPI S4.6');
            $kpi_6->set_kpi_info('Graduation Rates for Post Graduate Students: <br/> 12. Proportion of students entering post graduate programs who complete those programs in specified time');
            $kpi_6->set_kpi_ref_num('S4.6');
            $children[] = $kpi_6;

            $kpi_7 = new kpi();
            $kpi_7->set_name('KPI S4.7');
            $kpi_7->set_kpi_info('13.  Proportion of graduates from undergraduate programs who within six months of graduation are: <br/>(a) employed  <br/>(b) enrolled in further study <br/>(c) not seeking employment or further study.');
            $kpi_7->set_kpi_ref_num('S4.7');
            $children[] = $kpi_7;
        }

        $annexes = new Annexes_List();
        $annexes->set_standard($standard);
        $annexes->set_name("List of Annexes for standard {$standard}");
        $children[] = $annexes;

        return $children;
    }

}
