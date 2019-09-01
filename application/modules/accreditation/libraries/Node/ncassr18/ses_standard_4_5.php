<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ses_standard_4_5
 *
 * @author ahmadgx
 */
class Ses_Standard_4_5 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '4.5 Educational Assistance for Students';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_4_5_1('');
            $this->set_4_5_2('');
            $this->set_4_5_3('');
            $this->set_4_5_4('');
            $this->set_4_5_5('');
            $this->set_4_5_6('');
            $this->set_4_5_7('');
            $this->set_4_5_8('');
            $this->set_4_5_9('');
            $this->set_4_5_10('');
            $this->set_4_5_11('');
            $this->set_4_5_12('');
            $this->set_4_5_13('');
            $this->set_4_5_14('');
            $this->set_4_5_15('');

            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Effective systems must be in place for assisting student learning through academic advice, study facilities, monitoring student progress, encouraging high performing students and provision of assistance when needed by individuals.</strong>'
            . ' <br/> <br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed ');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_4_5_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_5_1', $value);
        $property->set_description('4.5.1 Teaching staff are available at sufficient scheduled times for consultation and advice to students. (This must be confirmed, not assumed because times have been scheduled)');
        $this->set_property($property);
    }

    public function get_4_5_1()
    {
        return $this->get_property('4_5_1')->get_value();
    }

    public function set_4_5_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_5_2', $value);
        $property->set_description('4.5.2 Teaching resources (including staffing, learning resources and equipment, and clinical or other field placements) are sufficient to ensure achievement of the intended learning outcomes.');
        $this->set_property($property);
    }

    public function get_4_5_2()
    {
        return $this->get_property('4_5_2')->get_value();
    }

    public function set_4_5_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_5_3', $value);
        $property->set_description('4.5.3 If arrangements for student academic counselling and advice include electronic communications through email or other means the effectiveness of those processes is evaluated through processes such as analysis of response times and student evaluations.');
        $this->set_property($property);
    }

    public function get_4_5_3()
    {
        return $this->get_property('4_5_3')->get_value();
    }

    public function set_4_5_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_5_4', $value);
        $property->set_description('4.5.4 Adequate tutorial assistance is provided to ensure understanding and ability to apply learning.');
        $this->set_property($property);
    }

    public function get_4_5_4()
    {
        return $this->get_property('4_5_4')->get_value();
    }

    public function set_4_5_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_5_5', $value);
        $property->set_description('4.5.5 Appropriate preparatory and orientation mechanisms are provided to prepare students for study in a higher education environment.  Particular attention is given to preparation for the language of instruction, self-directed learning, and bridging programs if necessary for students transferring to the institution with credit for previous studies. Preparatory studies must not be counted within the credit hour requirements for programs.');
        $this->set_property($property);
    }

    public function get_4_5_5()
    {
        return $this->get_property('4_5_5')->get_value();
    }

    public function set_4_5_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_5_6', $value);
        $property->set_description('4.5.6 Preparatory studies are not  counted within the credit hour requirements for the program.');
        $this->set_property($property);
    }

    public function get_4_5_6()
    {
        return $this->get_property('4_5_6')->get_value();
    }

    public function set_4_5_7($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_5_7', $value);
        $property->set_description('4.5.7 If the language of instruction in the program is not Arabic, action is taken to ensure that language skills are adequate for instruction in that language when students begin their studies.  (This may be done through language training prior to admission to the program.  Language skills expected on entry should be benchmarked against other highly regarded institutions with the objective of skills at least comparable to minimum requirements for admission of international students in universities in countries where that language is the native language. The benchmarking process should involve testing of at least a representative sample of students on major recognized language tests)');
        $this->set_property($property);
    }

    public function get_4_5_7()
    {
        return $this->get_property('4_5_7')->get_value();
    }

    public function set_4_5_8($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_5_8', $value);
        $property->set_description('4.5.8 If preparatory programs are outsourced to other providers the institution accepts responsibility for ensuring the necessary standards are met and entry requirements to the program are maintained.');
        $this->set_property($property);
    }

    public function get_4_5_8()
    {
        return $this->get_property('4_5_8')->get_value();
    }

    public function set_4_5_9($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_5_9', $value);
        $property->set_description('4.5.9 Systems are in place for monitoring and coordinating student workload');
        $this->set_property($property);
    }

    public function get_4_5_9()
    {
        return $this->get_property('4_5_9')->get_value();
    }

    public function set_4_5_10($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_5_10', $value);
        $property->set_description('4.5.10 The progress of individual students is monitored and assistance and/or counselling provided to those facing difficulties.');
        $this->set_property($property);
    }

    public function get_4_5_10()
    {
        return $this->get_property('4_5_10')->get_value();
    }

    public function set_4_5_11($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_5_11', $value);
        $property->set_description('4.5.11 Year to year progression rates and program completion rates are monitored, and action taken to help any categories or types of students needing help');
        $this->set_property($property);
    }

    public function get_4_5_11()
    {
        return $this->get_property('4_5_11')->get_value();
    }

    public function set_4_5_12($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_5_12', $value);
        $property->set_description('4.5.12 Feedback on performance by students and results of assessments is given promptly to students and accompanied by mechanisms for providing assistance if needed');
        $this->set_property($property);
    }

    public function get_4_5_12()
    {
        return $this->get_property('4_5_12')->get_value();
    }

    public function set_4_5_13($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_5_13', $value);
        $property->set_description('4.5.13 Adequate facilities are provided for private study with access to computer terminals and other necessary equipment');
        $this->set_property($property);
    }

    public function get_4_5_13()
    {
        return $this->get_property('4_5_13')->get_value();
    }

    public function set_4_5_14($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_5_14', $value);
        $property->set_description('4.5.14 Teaching staff are familiar with the support services available in the institution for students, and refer them to appropriate sources of assistance when required');
        $this->set_property($property);
    }

    public function get_4_5_14()
    {
        return $this->get_property('4_5_14')->get_value();
    }

    public function set_4_5_15($value)
    {
        $property = new \Orm_Property_Rank_Applicable('4_5_15', $value);
        $property->set_description('4.5.15 The adequacy of arrangements for assistance to students is periodically assessed through processes that include, but are not limited to, feedback from students');
        $this->set_property($property);
    }

    public function get_4_5_15()
    {
        return $this->get_property('4_5_15')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('4_5_1');
        $property->add_property_name('4_5_2');
        $property->add_property_name('4_5_3');
        $property->add_property_name('4_5_4');
        $property->add_property_name('4_5_5');
        $property->add_property_name('4_5_6');
        $property->add_property_name('4_5_7');
        $property->add_property_name('4_5_8');
        $property->add_property_name('4_5_9');
        $property->add_property_name('4_5_10');
        $property->add_property_name('4_5_11');
        $property->add_property_name('4_5_12');
        $property->add_property_name('4_5_13');
        $property->add_property_name('4_5_14');
        $property->add_property_name('4_5_15');
        $this->set_property($property);
    }

    public function get_overall_assessment()
    {
        return $this->get_property('overall_assessment')->get_value();
    }

    public function set_comment($value)
    {
        $property = new \Orm_Property_Textarea('comment', $value);
        $property->set_description('Comment');
        $this->set_property($property);
    }

    public function get_comment()
    {
        return $this->get_property('comment')->get_value();
    }

    public function set_priorities_for_improvement($value)
    {
        $property = new \Orm_Property_Textarea('priorities_for_improvement', $value);
        $property->set_description('Priorities For Improvement');
        $this->set_property($property);
    }

    public function get_priorities_for_improvement()
    {
        return $this->get_property('priorities_for_improvement')->get_value();
    }

    public function set_independent_opinion($value)
    {
        $property = new \Orm_Property_Rank('independent_opinion', $value);
        $property->set_description('Independent Opinion');
        $this->set_property($property, true);
    }

    public function get_independent_opinion()
    {
        return $this->get_property('independent_opinion')->get_value();
    }

    public function set_independent_opinion_comment($value)
    {
        $property = new \Orm_Property_Textarea('independent_opinion_comment', $value);
        $property->set_description('Comment');
        $this->set_property($property, true);
    }

    public function get_independent_opinion_comment()
    {
        return $this->get_property('independent_opinion_comment')->get_value();
    }

}
