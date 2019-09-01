<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb;

/**
 * Description of aacsb_section_2__accounting_learning_teaching
 *
 * @author laith
 */
class Aacsb_Section_2_Accounting_Learning_Teaching extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'ACCOUNTING LEARNING AND TEACHING';
    protected $link_view = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {


        $childrens = array();
        $childrens[] = new Aacsb_Section_2_Accounting_Learning_Teaching_Standard_A5();
        $childrens[] = new Aacsb_Section_2_Accounting_Learning_Teaching_Standard_A6();
        $childrens[] = new Aacsb_Section_2_Accounting_Learning_Teaching_Standard_A7();

        return $childrens;
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'High-quality accounting academic units have processes for determining degree program learning goals that are relevant and appropriate, as well as processes for designing and delivering curricula to maximize the potential for students to achieve the learning goals and succeed as professional accountants. Subsequently, these units have systems in place to assess whether learning goals have been met. If learning goals are not met, these units have systems in place to address deficiencies and improve. The first standard in this section addresses these processes. <br/> <br/>'
            . 'If curriculum management processes are working well, the peer review team expects to observe a number of general characteristics or attributes of the curriculum:'
            . '<ul>'
            . '<li>Curricula address general content areas—skills and knowledge—that would normally be included in the type of degree program under consideration. While most skill areas are likely to remain consistently important over time, knowledge areas are likely to be more dynamic as accounting, business, and management theory and practice change over time. Normally, the foundational skills and knowledge supporting other business degree programs also support accounting degree programs.</li>'
            . '<li>Curricula facilitate and encourage active student engagement in learning. In addition to time accounting students spend on tasks related to readings, course participation, knowledge development, projects, and assignments, they engage in experiential and active learning designed to improve skills and the application of knowledge.</li>'
            . '<li>Curricula facilitate and encourage frequent, productive student-student and student-faculty interaction designed to achieve learning goals. Successful teaching and learning demand high levels of interaction between learners, as well as between teachers and learners.</li>'
            . '<li>Educational programs are structured to ensure consistent, high-quality education for the same degree programs regardless of differences and changes in technology, delivery modes, and locations. This commitment to consistent high quality is especially important in light of pressures to shorten degrees and time for learning, interaction, engagement, and skill and knowledge development.</li>'
            . '</ul>'
            . '<br/> <br/>The standards in this section address these critical areas of teaching/learning that makes an impact.');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
