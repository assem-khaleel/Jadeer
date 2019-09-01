<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\asiinp;

/**
 * Description of asiinp_3_procedures_4
 *
 * @author laith
 */
class Asiinp_3_Procedures_4 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '3.4 Principles for the selection of peers';
    protected $link_view = true;

    public function init()
    {
        parent::init();

            $this->set_info();
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'ASIIN asks the higher education institution to state the ideal expertise profile for the group of peers. ASIIN’s Accreditation Commission decides who will be nominated for a given procedure based on the recommendation of the responsible Technical Committee(s), and appoints the peers. <br/> <br/>'
            . '<b>The group of peers</b> <br/> <br/>'
            . 'For a single accreditation, the group of peers is normally composed of: <br/>'
            . '<ul type="circle">'
            . '<li>2-3 full-time professors (university, university of applied sciences and, if applicable, university of cooperative education)</li>'
            . '<li>1 industry representative</li>'
            . '<li>1 student</li>'
            . '</ul>'
            . 'For cluster accreditations, the group of peers is expanded in accordance with the needs of the subject matter. <br/>'
            . 'In all cases, the group of peers should: <br/>'
            . '<ul type="circle">'
            . '<li>Include members who are able to understand the subject matter of the programme or programmes under review;</li>'
            . '<li>Include members who understand the needs of stakeholders in the particular programme concerned and incorporate them into their evaluation;</li>'
            . '<li>If possible, include peers experienced in accreditation as well as auditors who are new to the field;</li>'
            . '<li>If the degree programmes under consideration are offered by higher education institutions with a special form of organisation (e.g. universities of cooperative education or privately run institutions), include members who have experience at this type of institution.</li>'
            . '</ul>'
            . 'In some cases, members of ASIIN committees involved in the accreditation procedure may serve as peers as part of the agency’s internal quality assurance mechanisms. <br/> <br/>'
            . '<b>Auditors with a background in higher education should:</b> <br/> <br/>'
            . '<ul type="circle">'
            . '<li>Have proven subject expertise;</li>'
            . '<li>Be able to demonstrate their activities in the subject area;</li>'
            . '<li>Ideally: have experience in accreditation or evaluation, teaching experience at a higher education institution, international experience, experience in the administration of higher education institutions.</li>'
            . '</ul>'
            . '<b>Auditors with a professional background should:</b> <br/> <br/>'
            . '<ul type="circle">'
            . '<li>Have proven subject expertise;</li>'
            . '<li>Have experience with direct responsibility for employing graduates in a professional setting;</li>'
            . '<li>Ideally: have experience in accreditation or evaluation, teaching experience at a higher education institution, international experience, experience in the administration of higher education institutions.</li>'
            . '</ul>'
            . '<b>Auditors from the student body should:</b> <br/> <br/>'
            . '<ul type="circle">'
            . '<li>Be actively studying a subject relevant to the accreditation procedure;</li>'
            . '<li>Be able to reflect on the experience of studying, while not having significantly exceeded the normal time taken to complete a degree;</li>'
            . '<li>Be familiar with Bachelor’s and Master’s level programmes.</li>'
            . '</ul>'
            . 'For Germany, students nominated by the Student Accreditation Pool are considered during the selection process of the student representative. <br/>'
            . '<b>Persons excluded from the nomination as peer:</b> <br/> <br/>'
            . '<ul type="circle">'
            . '<li>Persons who are in the process of applying to the institution under review.</li>'
            . '<li>Academic colleagues whose publications or projects are principally produced in cooperation with teaching staff from the institution under review.</li>'
            . '<li>People who work at the institution under review and/or have a dependent relationship to it.</li>'
            . '<li>Generally, professors from the same federal state or region.</li>'
            . '</ul>'
            . '<b>Preparation of peers</b> <br/> <br/>'
            . 'The agency offers regular seminars/workshops for auditors and committee members to prepare them for the task and to reflect on their understanding of their role and update their knowledge of the auditing process. The agency expects its peers to make use of these opportunities or similar offers provided by other agencies. <br/> <br/>'
            . '<b>Confidentiality and impartiality</b> <br/> <br/>'
            . 'Before participating in an audit, every peer must sign a confidentiality and impartiality declaration. The applicants are informed of the composition of the auditing team. If bias is suspected, the higher education institution may request the substitution of peers. The relevant Technical Committee handles this type of requests. <br/>');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
