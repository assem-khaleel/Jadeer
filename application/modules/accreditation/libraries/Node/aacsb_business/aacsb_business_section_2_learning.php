<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb_business;

/**
 * Description of aacsb_business_section_2_learning
 *
 * @author ahmadgx
 */
class Aacsb_Business_Section_2_Learning extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'LEARNING AND TEACHING';
    protected $link_view = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_introduction('');
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        $childrens = array();
        $childrens[] = new Aacsb_Business_Section_2_Standard_8();
        $childrens[] = new Aacsb_Business_Section_2_Standard_9();
        $childrens[] = new aacsb_business_section_2_standard_10();
        $childrens[] = new aacsb_business_section_2_standard_11();
        $childrens[] = new aacsb_business_section_2_standard_12();

        return $childrens;
    }

    public function set_introduction()
    {
        $property = new \Orm_Property_Fixedtext('introduction', 'High-quality business schools have processes for determining for each degree program learning goals that are relevant and appropriate, as well as for designing and delivering curricula to maximize the potential for achieving the expected outcomes. Subsequently, these schools have systems in place to assess whether learning goals have been met. If learning goals are not met, these schools have processes in place to improve. The first standard in this section addresses these processes. <br/> <br/>'
            . 'If curriculum management processes are working well, the peer review team will expect to observe a number of general characteristics or attributes of the curriculum:'
            . '<ul>'
            . '<li>Curricula address general content areas—skills and knowledge—that would normally be included in the type of degree program under consideration. While most skill areas are likely to remain consistently important over time, knowledge areas are likely to be more dynamic as theory and practice of business and management changes over time.</li>'
            . '<li>Curricula facilitate and encourage active student engagement in learning. In addition to time on task related to readings, course participation, knowledge development, projects, and assignments, students engage in experiential and active learning designed to improve skills and the application of knowledge in practice is expected.</li>'
            . '<li>Curricula facilitate and encourage frequent, productive student-student and student-faculty interaction designed to achieve learning goals. Successful teaching and learning demand high levels of interaction between and among learners, as well as between and among teachers and learners.</li>'
            . '<li>Educational programs are structured to ensure consistent, high-quality education for the same degree programs regardless of differences and changes in technology and delivery modes. This commitment to consistent high quality is especially important in light of pressures to shorten time to degree completion, as well as to reduce the time allotted for learning, interaction, engagement, and skill development.</li>'
            . '</ul>'
            . ' <br/>The standards in this section address these critical areas of teaching and learning.');
        $this->set_property($property);
    }

    public function get_introduction()
    {
        return $this->get_property('introduction')->get_value();
    }

}
