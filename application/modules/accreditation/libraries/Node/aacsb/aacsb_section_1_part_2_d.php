<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb;

/**
 * Description of aacsb_section_1_part_2_D
 *
 * @author laith
 */
class Aacsb_Section_1_part_2_D extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard D';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_definitions();
            $this->set_basis();
            $this->set_guide();
            $this->set_textarea1('');
            $this->set_textarea2('');
            $this->set_textarea3('');
            $this->set_textarea4('');
            $this->set_textarea5('');
            $this->set_textarea6('');
            $this->set_textarea7('');
            $this->set_textarea8('');
            $this->set_textarea9('');
            $this->set_textarea10('');
            $this->set_info2();
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>An applicant for AACSB accounting accreditation must be a well-defined, established accounting academic unit that is part of or affiliated with an academic entity or business academic unit that is a member of AACSB in good standing, holds AACSB business accreditation, or is an applicant for AACSB business accreditation concurrently with the application for AACSB accounting accreditation. The academic entity may be defined as an institution authorized to award bachelor’s degrees or higher (in business and accounting) or a business academic unit within such an institution. [ACCOUNTING ACCREDITATION SCOPE AND AACSB MEMBERSHIP]</strong> <br/> <br/><strong>Definitions</strong>');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_definitions()
    {
        $property = new \Orm_Property_Fixedtext('definitions', '<ul type="circle"><li>An institution is a legal entity authorized to award bachelor’s degrees or higher.</li>'
            . '<li>An academic unit operates within an institution and may depend on the institution for authority to grant degrees.</li>'
            . '<li>A business academic unit is an academic unit in which business and management is the predominant focus across degree programs, research, and outreach activities.</li>'
            . '<li>An accounting academic unit is an academic unit in which accounting education is the predominant focus across degree programs, research, and outreach activities that are focused on preparing graduates for professional accounting careers (in industry, public accounting, government, or non-profit organizations) or for further graduate study (including preparation for accounting academic careers).</li></ul>');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_definitions()
    {
        return $this->get_property('definitions')->get_value();
    }

    public function set_basis()
    {
        $property = new \Orm_Property_Fixedtext('basis', '<strong>Basis for Judgment</strong> <br/>'
            . '<ul type="circle">'
            . '<li>The accounting academic unit is agreed upon through AACSB processes and meets the spirit and intent of the conditions and expectations as outlined in these eligibility criteria. The accounting academic unit seeking AACSB accounting accreditation must be approved well in advance (normally two years or more) of the onsite visit of the accreditation peer review team. If the accounting academic unit seeking AACSB accounting accreditation is part of or affiliated with an entity or business academic unit that holds AACSB business accreditation or is seeking business accreditation, the relationship of the accounting academic unit to the entity or business academic unit must be clear.</li>'
            . '<li>Within the approved accounting academic unit applying for AACSB accounting accreditation, the programmatic scope of accreditation (e.g., degree programs and other programmatic activities to be included in the AACSB review process and subject to alignment with accreditation standards) is agreed upon through AACSB processes and meets the spirit and intent of the conditions and expectations outlined in these eligibility criteria. Program inclusions and exclusions are approved well in advance (normally two years) of the onsite visit of the accreditation peer review team.</li>'
            . '<li>The accounting academic unit applying for accreditation agrees to use the AACSB accreditation brand and related statements about accreditation in its electronic and printed communications in accordance with AACSB policies and guidelines.</li>'
            . '</ul>');
        $property->set_group('section_2');
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
        $property->set_description('Describe the accounting academic unit’s relationship to the entity or business academic unit of which it is part, or describe its affiliation with a separate business academic unit that is seeking or holds AACSB business accreditation. Provide an organizational chart. Provide evidence that the accounting academic unit is predominantly focused on accounting education, research, and outreach');
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
        $property->set_description('An accounting academic unit may also be considered a business academic unit (see the AACSB Business Accreditation Standards) for accreditation purposes. In such cases, the accounting academic unit must seek business accreditation and may also seek separate accounting accreditation. Other organizational structures for accounting academic units will be considered on a case-by-case basis.');
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
        $property->set_description('Describe the accounting degree programs that the accounting academic unit is submitting for the accreditation review and identify any non-accounting degree programs that the unit offers. MBA programs that offer an accounting minor with up to four accounting classes that are not intended to prepare graduates for professional examinations licenses, or designations in accounting are not included in an AACSB accounting accreditation review. Such programs must be reviewed within the business accreditation review.');
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
        $property->set_description('List all degree programs in accounting offered elsewhere in the institution, including the academic unit responsible for delivering them.');
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
        $property->set_description('If the institution has multiple academic units that deliver accounting degree programs and one or more seeks AACSB accounting accreditation, each academic unit seeking accounting accreditation must demonstrate that their activities are clearly distinguished internally and externally from the activities of the rest of the institution, particularly the activities of other academic units that offer accounting degree programs that are not seeking AACSB accounting accreditation.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea5()
    {
        return $this->get_property('textarea5')->get_value();
    }

    public function set_textarea6($value)
    {
        $property = new \Orm_Property_Textarea('textarea6', $value);
        $property->set_description('AACSB recognizes national systems and local cultural contexts, as well as the regulatory environments in which an entity applying for accreditation operates. As a result, AACSB can vary the boundaries of what it considers traditional business and accounting subjects. AACSB will consider the definition of those boundaries in the local context in which the applicant entity operates. For AACSB to agree to vary its definition of a traditional business or accounting subject, the applicant must explain and document such variations within its local context.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea6()
    {
        return $this->get_property('textarea6')->get_value();
    }

    public function set_textarea7($value)
    {
        $property = new \Orm_Property_Textarea('textarea7', $value);
        $property->set_description('AACSB International must ensure that its brand is applied strictly and only to the agreed-upon entity applying for accreditation and the programs and programmatic activities included within the scope of its review. For that reason, the applicant must document its agreement and alignment with the following guidelines regarding the use of the AACSB International');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea7()
    {
        return $this->get_property('textarea7')->get_value();
    }

    public function set_textarea8($value)
    {
        $property = new \Orm_Property_Textarea('textarea8', $value);
        $property->set_description('In the case where the entity applying for business and accounting accreditation is a single business academic unit within an institution, the AACSB accreditation brand applies only to the single business academic unit and all business and management degree and accounting programs it is responsible for delivering. The AACSB accreditation brand cannot apply to the institution or to other (non-business) academic units or the accounting degree programs they offer.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea8()
    {
        return $this->get_property('textarea8')->get_value();
    }

    public function set_textarea9($value)
    {
        $property = new \Orm_Property_Textarea('textarea9', $value);
        $property->set_description('Applications for accreditation must be supported by the chief executive officer of the accounting academic unit, the chief executive officer of the business school applicant, and the chief academic officer of the institution regardless of the accreditation entity seeking AACSB accreditation. In all cases, the institution, business academic units, and accounting academic units agree to comply with AACSB policies that recognize entities that hold AACSB accounting accreditation. Applicants must clearly distinguish the programs they submit to the accounting accreditation review from other business academic units, accounting academic units, and other (non-business) academic units at their institutions that deliver accounting degree programs that do not hold AACSB accounting accreditation.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea9()
    {
        return $this->get_property('textarea9')->get_value();
    }

    public function set_textarea10($value)
    {
        $property = new \Orm_Property_Textarea('textarea10', $value);
        $property->set_description('For all AACSB-accredited entities, the list of degree programs included in the scope of accreditation review must be maintained continuously at AACSB. If the accounting academic unit that holds AACSB accounting accreditation introduces new programs, it may indicate that those programs are AACSB-accredited until the next maintenance of accounting accreditation review. It may not indicate that new accounting degree programs delivered by other (non-business/accounting) academic units are accredited prior to the next review. 3');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_textarea10()
    {
        return $this->get_property('textarea10')->get_value();
    }

    public function set_info2()
    {
        $property = new \Orm_Property_Fixedtext('info2', 'Hereafter, the term accounting academic unit refers to the unit that is under review for initial accounting accreditation or maintenance of AACSB accounting accreditation.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_info2()
    {
        return $this->get_property('info2')->get_value();
    }

}
