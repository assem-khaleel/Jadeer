<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\asiinp;

/**
 * Description of asiinp_5_appendix_4
 *
 * @author laith
 */
class Asiinp_5_Appendix_4 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '5.4 Example form for Staff Handbook (1 page per person)';
    protected $link_view = true;

    public function init()
    {
        parent::init();

            $this->set_info();
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<table border="1">'
            . '<tr>'
            . '<td>Name</td>'
            . '<td>N.N.</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Post</td>'
            . '<td>Teaching area and designation</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Academic career</td>'
            . '<td>Initial academic appointment__________  Institution________  Year__________ <br/>Habilitation [German post-doctoral qualification]_________ Institution_________ Year________ <br/> (subject)______________ Institution_____________  Year__________ <br/>Doctorate (subject)____________ Institution_____________  Year__________ <br/>Undergraduate degree(subject)_____________</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Employment</td>'
            . '<td>Position_____________ Employer_______________ Period_____________</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Research and development projects over the last 5 years</td>'
            . '<td>Name of project or research focus <br/> Period and any other information <br/> Partners, if applicable <br/> Amount of financing</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Industry collaborations over the last 5 years</td>'
            . '<td>Project title _______ <br/> Partners__________</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Patents and proprietary rights</td>'
            . '<td>Title________________ Year_________________</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Important publications over the last 5 years</td>'
            . '<td>Selected recent publications from a total of approx. <br/>(give total number): <br/>Author(s) <br/>Title <br/>Any other information <br/>Publisher, place of publication, date of publication or name of periodical, volume, issue, page numbers</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Activities in specialist bodies over the last 5 years</td>'
            . '<td>Organisation___________ Role_____________ Period_____________ <br/> Membership without a specific role need not be mentioned</td>'
            . '</tr>'
            . '</table>');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
