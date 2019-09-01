<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of Ses_Standard_2_8
 *
 * @author user
 */
class Ses_Standard_2_8 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '2.8 Associated Companies and Controlled Entities';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_2_8_1('');
            $this->set_2_8_2('');
            $this->set_2_8_3('');
            $this->set_2_8_4('');
            $this->set_2_8_5('');
            $this->set_2_8_6('');
            $this->set_overall_assessment('');
            $this->set_comment('');
            $this->set_priorities_for_improvement('');
            $this->set_independent_opinion('');
            $this->set_independent_opinion_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>Special Note</strong><br/><br/>The term Controlled Entity is intended to include all arrangements where an institution has established a company, institute or other organization to provide services, academic or technical programs or carry out other activities. It includes, for example, a campus elsewhere in Saudi Arabia or in another country, one or more community colleges, an institute to provide a preparatory year program, companies established to undertake commercial development of patents or research findings, or companies established to provide services such as student or faculty housing or food or IT services.<br/><br/>In all such cases the parent institution (the college or university) must accept ultimate responsibility for what is done and have effective mechanisms for oversight of the quality of activities. Educational organizations such as a community college or a preparatory year program might also undergo separate accreditation, but a self-study of the parent institution and an external review of it for accreditation will consider whether the details of standard 2.8 are met and the extent to which the quality of the controlled entity is maintained and effectively supervised.<br/><br/><strong>2.8 If institutions establish or control subsidiary corporations for matters such as service provision, publications, or development of intellectual property the institution must maintain effective policy oversight, accountability and risk management processes.</strong><br/><br/>The level of compliance with this standard is judged by the extent to which the following good practices are followed.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_2_8_1($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_8_1', $value);
        $property->set_description('2.8.1 The functions of the controlled entities are appropriate for and consistent with the charter and mission of the institution.');
        $this->set_property($property);
    }

    public function get_2_8_1()
    {
        return $this->get_property('2_8_1')->get_value();
    }

    public function set_2_8_2($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_8_2', $value);
        $property->set_description('2.8.2 The administrative and financial relationship between the controlled entities and the institution are clearly specified.');
        $this->set_property($property);
    }

    public function get_2_8_2()
    {
        return $this->get_property('2_8_2')->get_value();
    }

    public function set_2_8_3($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_8_3', $value);
        $property->set_description(' 2.8.3 Reporting mechanisms are established that ensure that the governing body has effective oversight of the purposes, functions, and activities of the controlled entities');
        $this->set_property($property);
    }

    public function get_2_8_3()
    {
        return $this->get_property('2_8_3')->get_value();
    }

    public function set_2_8_4($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_8_4', $value);
        $property->set_description('2.8.4 Audited financial reports on the financial affairs of the controlled entities are reviewed regularly by the relevant committee of the governing body.');
        $this->set_property($property);
    }

    public function get_2_8_4()
    {
        return $this->get_property('2_8_4')->get_value();
    }

    public function set_2_8_5($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_8_5', $value);
        $property->set_description('2.8.5 Administrative arrangements and planning mechanisms for activities of the controlled entity should provide for adequate risk assessment including protection for the institution against financial or legal liabilities.');
        $this->set_property($property);
    }

    public function get_2_8_5()
    {
        return $this->get_property('2_8_5')->get_value();
    }

    public function set_2_8_6($value)
    {
        $property = new \Orm_Property_Rank_Applicable('2_8_6', $value);
        $property->set_description('2.8.6 In any arrangement under which an institution contracts out to another organization the provision of services to students or to future students (eg. a preparatory year program) the service contract should include requirements to meet all relevant quality standards. (The institution will be held responsible for ensuring the standards are met.)');
        $this->set_property($property);
    }

    public function get_2_8_6()
    {
        return $this->get_property('2_8_6')->get_value();
    }

    public function set_overall_assessment($value)
    {
        $property = new \Orm_Property_Overall_Assessment('overall_assessment', $value);
        $property->set_description('Overall Assessment');

        $property->set_node($this);
        $property->add_property_name('2_8_1');
        $property->add_property_name('2_8_2');
        $property->add_property_name('2_8_3');
        $property->add_property_name('2_8_4');
        $property->add_property_name('2_8_5');
        $property->add_property_name('2_8_6');

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
