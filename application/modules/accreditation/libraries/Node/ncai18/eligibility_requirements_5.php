<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of eligibility_requirements_5
 *
 * @author laith
 */
class Eligibility_Requirements_5 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '5. Administrative Policies and Procedures';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_attachment('');
            $this->set_comment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', ' The institution must have developed and made readily accessible to teaching and all other staff a complete set of administrative policies and regulations including terms of reference for major committees and responsibilities of teaching and administrative positions. These should be consistent with the requirements of Standard 2—Governance and Administration and other relevant standards dealing with teaching and administrative and support services. Committees or councils for which terms of reference and membership structure must be available include: <br/> <br/>'
            . '<ol type="a">'
            . '<li>University Council or Board of Trustees.</li>'
            . '<li>Any standing sub committees of the University Council or Board of Trustees.</li>'
            . '<li>Senior academic committees (including the academic council if applicable) responsible for oversight of and approval of programs or major program changes, research development, and graduate studies programs (if applicable).</li>'
            . '<li>Any standing sub committees of the senior academic committee.</li>'
            . '<li>Institutional quality committee. (Note that although it should be normal practice to have a single quality committee for all institutional activities, if separate committees have been established to oversee quality for academic functions and administrative functions the membership structure and terms of reference of both must be available, together with the committee responsible for coordinating the two sets of activities.)</li>'
            . '<li>Institutional requirements for college academic committees or councils and standing sub-committees</li>'
            . '<li>Institutional requirements for department academic committees or councils and standing sub-committees.</li>'
            . '</ol>');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_attachment($value)
    {
        $property = new \Orm_Property_Upload('attachment', $value);
        $property->set_description('Provide a list and a copy of the Institution policies, regulations and terms of reference');
        $this->set_property($property);
    }

    public function get_attachment()
    {
        return $this->get_property('attachment')->get_value();
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

}
