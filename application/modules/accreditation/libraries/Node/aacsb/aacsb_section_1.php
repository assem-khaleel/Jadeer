<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb;

/**
 * Description of aacsb_section_1
 *
 * @author laith
 */
class Aacsb_Section_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'SECTION 1: ELIGIBILITY CRITERIA FOR AACSB INTERNATIONAL ACCOUNTING ACCREDITATION';
    protected $link_pdf = true;
    protected $link_view = true;


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
        $childrens[] = new Aacsb_Section_1_part_1();
        $childrens[] = new Aacsb_Section_1_Part_2();

        return $childrens;
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'Eligibility criteria serve three purposes. First, the eligibility criteria specify a series of core values and guiding principles that AACSB believes are important. Accounting academic units must demonstrate a commitment to these values and guiding principles in order to achieve and continue AACSB accounting accreditation. Second, they provide a foundation for peer review by defining the scope of review; establishing an agreement about the accounting accreditation entity to be reviewed; and determining that entity’s organization and support in the context of accounting education, as well as its connections to business and management education. Third, eligibility criteria address certain basic characteristics that bear on the quality of accounting and business degree programs, research, and other activities. These characteristics must be present before an applicant can be reviewed for initial accounting accreditation or for the continuation of accounting accreditation. Unless an applicant can describe itself transparently as an entity delivering accounting education and research, and show that it has the structure and capacity to deliver and sustain high-quality accounting education and intellectual contributions, it is not ready to be evaluated against the standards. <br/> <br/>'
            . 'For initial applicants, alignment with these eligibility criteria is viewed as the first step in the accreditation process. As such, the documentation an accounting academic unit provides in response to the criteria is a signal of its commitment to the underlying core values outlined in the criteria and its likelihood of achieving accreditation in a reasonable period. Eligibility criteria are thus the basis for the eligibility application. <br/> <br/>'
            . 'Once an accounting academic unit achieves AACSB accounting accreditation, it will continue to be evaluated for adherence to the eligibility criteria to determine whether changes in its strategy could affect its ability to continue to fulfill its mission.');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
