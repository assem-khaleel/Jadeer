<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\asiinp;

/**
 * Description of asiinp_5_appendix_1
 *
 * @author laith
 */
class Asiinp_5_Appendix_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '5.1 Documentation: organisation and composition of an accreditation application';
    protected $link_view = true;

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_explain('');
            $this->set_attachment('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'An accreditation application is essentially made up of a self-assessment and documentation that show how the requirements for accreditation are met. <br/> ASIIN has a model outline of an accreditation application which is available from the agency’s office on request. In terms of its logic, the self-assessment should be structured in accordance with the requirements for the accreditation of degree programmes. <br/> It is also important to provide certain formal details for each programme: <br/>'
            . '<table border ="1">'
            . '<tr>'
            . '<td>Programme designation in the locallanguage</td>'
            . '<td width="50%"></td>'
            . '</tr>'
            . '<tr>'
            . '<td>Programme designation in English</td>'
            . '<td></td>'
            . '</tr>'
            . '<tr>'
            . '<td>Language of instruction</td>'
            . '<td></td>'
            . '</tr>'
            . '<tr>'
            . '<td>Contact person</td>'
            . '<td></td>'
            . '</tr>'
            . '<tr>'
            . '<td>- Email</td>'
            . '<td></td>'
            . '</tr>'
            . '<tr>'
            . '<td>- Phone</td>'
            . '<td></td>'
            . '</tr>'
            . '<tr>'
            . '<td>- Fax</td>'
            . '<td></td>'
            . '</tr>'
            . '<tr>'
            . '<td>Web page</td>'
            . '<td></td>'
            . '</tr>'
            . '</table>'
            . ' <br/>The documentation provided to demonstrate that the requirements for accreditation are met should generally consist of documents that are actually used within the institution, rather than being specially produced for the accreditation procedure. This type of documentation includes: <br/>'
            . '<ul type="circle">'
            . '<li>Current versions of descriptions of the programme objectives and intended learning outcomes, the curriculum presentation, or the module handbook, as they are currently published and used (even if only internally);</li>'
            . '<li>Regulations that organise the programme and define the rights and obligations of students;</li>'
            . '<li>Examples of degree certificates and diploma supplements;</li>'
            . '<li>Proof of sufficient teaching capacity;</li>'
            . '<li>Staff handbook (i.e. profiles of teaching staff);</li>'
            . '<li>Overview of changes since the last accreditation;</li>'
            . '<li>Information about how recommendations from the previous accreditation were dealt with;</li>'
            . '<li>Statement of the students’ view of the programme;</li>'
            . '<li>Data on outcomes (e.g. results of tests and examinations, graduate surveys, student surveys, studies of subsequent employment) and evaluations of student numbers, drop-out rate, intake numbers, foreign students;</li>'
            . '<li>Where appropriate, the results of external evaluations during the accreditation period which take into account modularisation, the granting of credit points, mobility, the effects of any gender or diversity policies;</li>'
            . '<li>The results of internal evaluations, i.e. the results of the institution’s internal quality management, results control or internal process quality control;</li>'
            . '<li>Accreditation report from prior accreditations (if not carried out by ASIIN);</li>'
            . '<li>Any cooperation agreements;</li>'
            . '<li>Any relevant committee decisions;</li>'
            . '<li>The Ministry’s opinion, if applicable.</li>'
            . '</ul>');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_explain($value)
    {
        $property = new \Orm_Property_Textarea('explain', $value);
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_explain()
    {
        return $this->get_property('explain')->get_value();
    }

    public function set_attachment($value)
    {
        $property = new \Orm_Property_Upload('attachment', $value);
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_attachment()
    {
        return $this->get_property('attachment')->get_value();
    }

}
