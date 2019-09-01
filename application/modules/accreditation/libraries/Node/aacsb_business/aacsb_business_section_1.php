<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb_business;

/**
 * Description of aacsb_business_section_1
 *
 * @author ahmadgx
 */
class Aacsb_Business_Section_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'SECTION 1: ELIGIBILITY CRITERIA FOR AACSB INTERNATIONAL ACCREDITATION';
    protected $link_pdf = true;
    protected $link_view = true;


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
        $childrens[] = new Aacsb_Business_Section_1_Part_1();
        $childrens[] = new Aacsb_Business_Section_1_Part_2();

        return $childrens;
    }

    public function set_introduction()
    {
        $property = new \Orm_Property_Fixedtext('introduction', 'The eligibility criteria serve two purposes—accordingly, they are organized into two parts. First, the eligibility criteria specify a series of core values that AACSB believes are important. Schools must demonstrate a commitment to and alignment with these values in order to achieve and continue AACSB accreditation. <br/> <br/>'
            . 'Second, these criteria provide a foundation for accreditation by defining the scope of review. They establish the basis for agreement about the entity to be considered and the way that entity is organized and supported in the context of business and management education. For this purpose, eligibility criteria also address certain basic characteristics that bear on the quality of business degree programs, research, and other activities. These characteristics must be present before an applicant is reviewed for initial accreditation or for that applicant to continue accreditation. An applicant for accreditation must be able to show that it has the structure and capacity to deliver and sustain high-quality management education and intellectual contributions. Unless it can do so transparently, it is not prepared to be evaluated against the standards. <br/> <br/>'
            . 'For initial applicants, alignment with these eligibility criteria is viewed as the first step in the accreditation process. As such, the documentation a school provides in response to the criteria is a signal of its commitment to the underlying core values outlined in the criteria and its likelihood of achieving accreditation in a reasonable period. Eligibility criteria are thus the basis for the eligibility application. <br/> <br/>'
            . 'Once a school achieves accreditation, members of the Accreditation Council continue to evaluate the school’s adherence to the eligibility criteria and determine whether changes in its strategy could affect its ability to continue to fulfill its mission.');
        $this->set_property($property);
    }

    public function get_introduction()
    {
        return $this->get_property('introduction')->get_value();
    }

}
