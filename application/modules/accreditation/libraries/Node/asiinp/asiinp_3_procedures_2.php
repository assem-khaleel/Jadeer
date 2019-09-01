<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\asiinp;

/**
 * Description of asiinp_3_procedures_2
 *
 * @author laith
 */
class Asiinp_3_Procedures_2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '3.2 Sequence of the procedure';
    protected $link_view = true;

    public function init()
    {
        parent::init();

            $this->set_info();
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'The sequence of an accreditation procedure can be subdivided as follows: <br/>'
            . '<table border ="0">'
            . '<tr>'
            . '<td colspan="3"><b>1. Preparation</b></td>'
            . '</tr>'
            . '<tr>'
            . '<td>request</td>'
            . '<td>HEI</td>'
            . '<td>'
            . '<ul>'
            . '<li>A request is submitted to the ASIIN Office (accreditation request and a curricular overview which clearly states the content of the programme or programmes).</li>'
            . '<li>Form: electronic using the “Accreditation Request” form (www.asiin.de)</li>'
            . '<li>Required information: even in the case of an informal request, information such as the name(s) of the programme(s), type of degree, number of semesters, the seal(s) being applied for, any particularities, proposed responsibility of the ASIIN Technical Committees, proposed peer profiles, contact details is required.</li>'
            . '</ul>'
            . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Preparation of proposal</td>'
            . '<td>ASIIN</td>'
            . '<td>'
            . '<ul>'
            . '<li>The responsibility of ASIIN/its respective Technical Committees and the applicable procedure model and type are determined (see 3.1).</li>'
            . '<li>Where significant divergence from the applicable criteria is apparent, the Accreditation Commission for Degree Programmes must decide whether and on what terms a proposal can be issued; where necessary, the ASIIN office provides information on the criteria applied in this regard.</li>'
            . '<li>The number and profile of peers required as well as the overall length of visits are determined by the competent Technical Committee(s).</li>'
            . '<li>Calculation and forwarding of proposal, including a proposed timetable for the procedure, by the ASIIN office.</li>'
            . '</ul>'
            . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Acceptance of proposal/conclusion of contract</td>'
            . '<td>ASIIN and HEI</td>'
            . '<td>'
            . '<ul>'
            . '<li>'
            . 'Contract concluded by means of acceptance of the proposal by the HEI and, if desired, by means of a separate contract.'
            . '</li>'
            . '</ul>'
            . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td colspan="3"><b>2. Assessment</b></td>'
            . '</tr>'
            . '<tr>'
            . '<td>Pre-assessment</td>'
            . '<td>HEI and ASIIN</td>'
            . '<td>'
            . '<ul>'
            . '<li>Presentation of self-assessment report (or draft, if preferred) by the HEI.</li>'
            . '<li>Formal pre-assessment of the draft self- assessment report by the ASIIN office.</li>'
            . '<li>(Optional) preliminary discussions at the ASIIN office.</li>'
            . '<li>Submission of final self-evaluation report by the HEI.</li>'
            . '</ul>'
            . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Review team</td>'
            . '<td>ASIIN</td>'
            . '<td>'
            . '<ul>'
            . '<li>Nomination and appointment of the review team (ASIIN office, Technical Committees and Accreditation Commission).</li>'
            . '</ul>'
            . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Visit</td>'
            . '<td>ASIIN and HEI</td>'
            . '<td>'
            . '<ul>'
            . '<li>Scheduling and preparation of the visit.</li>'
            . '<li>Assessment of the self-assessment report by the peers and the ASIIN office.</li>'
            . '<li>Feedback by the peers of initial impressions, any additional requirements and any preparatory questions for the HEI to the ASIIN office.</li>'
            . '<li>According to the procedure type and country in which the HEI is located, preparatory meetings or a teleconference among the review team or involving the HEI might be necessary; where necessary, the ASIIN office provides information on the criteria applied in this regard.</li>'
            . '<li>Confirmation of date, including agenda, for the visit to the HEI.</li>'
            . '<li>On-site visit to HEI carried out (review team and ASIIN representative(s)); one peer assumes the role of team spokesperson.</li>'
            . '</ul>'
            . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Reporting</td>'
            . '<td>ASIIN</td>'
            . '<td>'
            . '<ul>'
            . '<li>Submission of accreditation report (status version of the peers after the visit) to the HEI to be checked for factual errors and commented on</li>'
            . '</ul>'
            . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td colspan="3"><b>3. Decision</b></td>'
            . '</tr>'
            . '<tr>'
            . '<td>Recommendation of peers</td>'
            . '<td>HEI</td>'
            . '<td>'
            . '<ul>'
            . '<li>Final assessment by the peers with a recommendation for the decision on accreditation.</li>'
            . '</ul>'
            . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Recommendation of Technical Committees</td>'
            . '<td>ASIIN</td>'
            . '<td>'
            . '<ul>'
            . '<li>Comments by relevant Technical Committee(s) with recommendation for the decision on accreditation.</li>'
            . '</ul>'
            . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Decision of the Accreditation Commission</td>'
            . '<td>ASIIN</td>'
            . '<td>'
            . '<ul>'
            . '<li>Model I: Decision by the ASIIN Accreditation Commission for Degree Programmes on accreditation and, if relevant for each case, on the award of the seal(s) applied for.</li>'
            . '<li>Model II: Adoption of report and recommendation by the ASIIN Accreditation Commission for Degree Programmes for the decision to be submitted to the competend external national accreditation body, depending on the country in which the HEI is located.</li>'
            . '</ul>'
            . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Notification and publication</td>'
            . '<td>ASIIN and HEI</td>'
            . '<td>'
            . '<ul>'
            . '<li>Notification of the decision to the HEI.</li>'
            . '<li>Transmission of the accreditation report (final version) to the HEI and, if positive, any certificates/authorisations for the use of a seal</li>'
            . '<li>Transmission of the accreditation report (final version) to the owners of any additional seals applied for (e.g. to the German Accreditation Council).</li>'
            . '<li>Publication of a summary and of the accreditation report on the website in accordance with the requirements of the ESG.</li>'
            . '</ul>'
            . '</td>'
            . '</tr>'
            . '</table>'
        );
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
