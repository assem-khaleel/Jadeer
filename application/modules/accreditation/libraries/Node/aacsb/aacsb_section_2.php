<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb;

/**
 * Description of aacsb_section_2
 *
 * @author laith
 */
class Aacsb_Section_2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'SECTION 2: STANDARDS FOR ACCOUNTING ACCREDITATION';
    protected $link_pdf = true;
    protected $link_view = true;
    protected $link_edit = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_basis();
            $this->set_guide();
            $this->set_textarea1('');
            $this->set_textarea2('');
            $this->set_textarea3('');
            $this->set_textarea4('');
            $this->set_textarea5('');
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {


        $childrens = array();
        $childrens[] = new Aacsb_Section_2_Accounting_Academic_Units();
        $childrens[] = new Aacsb_Section_2_Accounting_Units_Participants();
        $childrens[] = new Aacsb_Section_2_Accounting_Learning_Teaching();
        $childrens[] = new Aacsb_Section_2_Accounting_Professional();

        return $childrens;
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>INTRODUCTION</strong> <br/> <br/>'
            . 'AACSB accounting accreditation is an extension of AACSB’s business accreditation process. As such, these standards for separate AACSB accounting accreditation follow a similar structure as the business standards and, where possible, do not duplicate business standards that are addressed in the business school review. However, if the accounting academic unit has unique policies, outcome expectations, etc., incremental documentation may be needed to highlight these factors. But, where possible, the business school should make every effort to provide sufficient detail in its own accreditation documentation to avoid the need for incremental documentation from the accounting academic unit. <br/> <br/>'
            . 'Recognizing the interrelationship between the business and accounting standards, these standards are organized into the following two categories: <br/> <br/>'
            . '<ul type="circle"><li>Applicable business standards that apply to AACSB accounting accreditation reviews and that are normally addressed as part of the AACSB business review process. Separate or unique documentation is not required unless there is some unique attribute, policy, outcome, etc., that should be identified for the accounting academic unit. If the accounting academic unit relies on the business school documentation for its accreditation review, such documentation must be sufficiently detailed to allow an assessment of the accounting academic unit’s alignment with the selected business standards. If such an analysis is not possible, a separate response from the accounting academic unit is necessary.</li>'
            . '<li>Unique accounting standards relate to those factors that distinguish accounting education, its link to the accounting profession, and the role and responsibilities the accounting profession must assume as it serves the public interest. Furthermore, these unique standards should reflect those attributes that are consistent with the evolution of the practice of accounting as a learned profession similar to law and medicine.</li></ul>'
            . '<br/>The remainder of the document details the Standards for AACSB accounting accreditation as outlined above.');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_basis()
    {
        $property = new \Orm_Property_Fixedtext('basis', '<strong>Basis for Judgment</strong> <br/>'
            . '<ul type="circle"><li>With the exceptions in the “Guidance for Documentation” noted below, the accounting academic unit may refer the accounting peer review team to the business school accreditation review for documentation regarding the above-stated standards if the documentation is applicable and provides sufficient detail to analyze the accounting academic unit. If the documentation does not have sufficient detail for any individual standard, the accounting academic unit should provide separate documentation. Examples of areas that could require separate documentation for the accounting academic unit are described below in the Guidance for Documentation.</li>'
            . '<li>In collegiate environments, students, faculty, administrators, professional staff, and practitioners interact and collaborate as a community. Regardless of the delivery mode for degree programs, accounting academic units should provide an environment supporting interaction and engagement among students, administrators, faculty, professional staff, and practitioners.</li>'
            . '<li>Collegiate environments are characterized by the involvement of faculty and professional staff in governance and university service. Accounting academic units must show that governance processes include the input of and engagement with faculty and professional staff.</li></ul>');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_basis()
    {
        return $this->get_property('basis')->get_value();
    }

    public function set_guide()
    {
        $property = new \Orm_Property_Fixedtext('guide', '<strong>Guidance for Documentation</strong>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_guide()
    {
        return $this->get_property('guide')->get_value();
    }

    public function set_textarea1($value)
    {
        $property = new \Orm_Property_Textarea('textarea1', $value);
        $property->set_description('For business standards 4, 6, and 7, report only supporting documentation that is unique to the accounting academic unit and is not reported in sufficient detail in the business school report (e.g., the accounting academic unit controls student selection, admissions, and progression for its graduate programs and the details are not evident in the supporting business school documentation).');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea1()
    {
        return $this->get_property('textarea1')->get_value();
    }

    public function set_textarea2($value)
    {
        $property = new \Orm_Property_Textarea('textarea2', $value);
        $property->set_description('For Standard 4, document student placement results in the last five years or since the last accounting accreditation review, and provide examples of successful graduates of the accounting academic unit’s accounting degree programs, but only if this information is not addressed in sufficient detail in the business school review documentation.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea2()
    {
        return $this->get_property('textarea2')->get_value();
    }

    public function set_textarea3($value)
    {
        $property = new \Orm_Property_Textarea('textarea3', $value);
        $property->set_description('For Standards 9, 10, 11, and 12 report only supporting documentation that is unique to the accounting academic unit and not included in sufficient detail in the business school report (e.g., student-faculty interaction activities, curricula, strategies, or improvements that are unique to the accounting profession).');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea3()
    {
        return $this->get_property('textarea3')->get_value();
    }

    public function set_textarea4($value)
    {
        $property = new \Orm_Property_Textarea('textarea4', $value);
        $property->set_description('For Standard 13, summarize accounting students’ academic and professional engagement and experiential learning activities, as well as the ways these activities are integrated into the learning experiences as detailed in degree program curricula, but only if this information is not addressed in the business school review documentation.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea4()
    {
        return $this->get_property('textarea4')->get_value();
    }

    public function set_textarea5($value)
    {
        $property = new \Orm_Property_Textarea('textarea5', $value);
        $property->set_description('For Standard 14, report only unique accounting academic unit activities that are not identifiable in the business school review documentation.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea5()
    {
        return $this->get_property('textarea5')->get_value();
    }

}
