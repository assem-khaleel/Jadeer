<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\asiinp;

/**
 * Description of asiinp_3_procedures_6
 *
 * @author laith
 */
class Asiinp_3_Procedures_6 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '3.6 Possible outcomes of the procedure and expiry';
    protected $link_view = true;

    public function init()
    {
        parent::init();

            $this->set_info();
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'Accreditation is for a limited time period. A first accreditation with one of the aforementioned seals is valid for five years; subsequent renewal is valid for seven years. <br/> <br/>'
            . 'Moreover, the calculation of validity periods is always based on the rules of the body granting the seal. <br/> <br/>'
            . 'The time limits applicable in the individual case are notified to the higher education institution together with the letter of confirmation on the outcome of the accreditation procedure. <br/> <br/>'
            . 'An accreditation procedure may have the following outcomes: <br/> <br/>'
            . '<table border ="0">'
            . '<tr>'
            . '<td>Model I  <br/>(where the final decision is taken by the ASIIN Accreditation Commission, see 3.1)'
            . '<ul> '
            . '<li>ASIIN seal</li>'
            . '<li>Subject-related label</li>'
            . '<li>Seal of German Accreditation Council</li>'
            . '</ul></td>'
            . '<td>'
            . '<ul>'
            . '<li>Unconditional accreditation for the full accreditation period.</li>'
            . '<li>Accreditation with reservations, i.e. with requirements and thus for a shorter period of validity than the maximum permitted by the accreditation procedure. In this case, there are certain requirements that must be met by a due date. If the requirements are met on time, the accreditation is extended to cover the full period allowed. The fulfilment of the requirements is checked and evaluated by the review team and the responsible Technical Committee(s) and ascertained by the Accreditation Commission. The rules of the respective owner of a seal relating to the imposition of requirements are also applied. If necessary, the ASIIN office will provide detailed information on the conditions to be applied.</li>'
            . '<li>The procedure is suspended (“procedure-loop”): the Accreditation Commission may suspend an accreditation procedure once if the procedure revealed that requirements remain unfulfilled but the applicant institution can, nonetheless, be expected to resolve the issues during the suspension period. When deciding to suspend the procedure, the Accreditation Commission also stipulates the conditions to be met for resumption.The decision to suspend the procedure may be taken at the request of the institution or on the initiative of ASIIN. If the resumption of a procedure requires an additional visit, the applicant may have to meet extra costs. The rules of the respective owner of a seal relating to the suspension of a procedure are also applied. If necessary, the ASIIN office will provide detailed information on the conditions to be applied.</li>'
            . '<li>Accreditation may be refused if the requirements for the award of a seal are not sufficiently met. In this case, the German Accreditation Council will be informed if its seal was applied for. The rules of the respective owner of a seal relating to the refusal of accreditation are also applied. If necessary, the ASIIN office will provide detailed information on the conditions to be applied.</li>'
            . '</ul>'
            . '</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Model II  <br/> (where the final decision is taken by a third-party institution, see 3.1.)'
            . '<ul> '
            . '<li>national accreditation, e.g. Switzerland Netherlands</li>'
            . '</ul></td>'
            . '<td>'
            . '<ul>'
            . '<li>ASIIN submits a recommendation for the decision on accreditation to the respective national decision-making body; this may involve requirements or suspension.</li>'
            . '<li>The responsible decision-making body may specify different/further outcomes for an accreditation procedure according to national requirements.</li>'
            . '</ul></td>'
            . '</tr>'
            . '<tr>'
            . '<td>Model III <br/>(final decision on ASIIN seal or subject-related labels taken by ASIIN + final decision on national accreditation by third-party body, see 3.1.)</td>'
            . '<td>Combination of model I and II (see above)</td>'
            . '</tr>'
            . '</table>'
            . ' <br/><b>Appeal</b> <br/> <br/>The institution immediately affected by an accreditation decision by ASIIN’s Accreditation Commission may file an appeal against the decision; appeals are dealt with by ASIIN’s special appeals committee. The submission of an appeal is subject to deadlines. Information on the requirements, procedure and deadlines can be obtained from the ASIIN office or on the web page (www.asiin.de). <br/> <br/>'
            . '<b>Procedure for fulfilment of requirements</b> <br/> <br/>'
            . '<table border ="0">'
            . '<tr>'
            . '<td>1. Proof that requirements are met</td>'
            . '<td>HEI</td>'
            . '<td>'
            . '<ul>'
            . '<li>Submission by HEI of evidence that requirements have been met within the time limit as notified by ASIIN.</li>'
            . '</ul></td>'
            . '</tr>'
            . '<tr>'
            . '<td>2. Decision<br/>  '
            . '<ul>'
            . '<li>Recommendation by peers</li>'
            . '<li>Recommendation of Technical Committees</li>'
            . '<li>Decision by the Accreditation Commission</li>'
            . '<li>Notification and publication</li>'
            . '</ul></td>'
            . '<td>'
            . '<ul style=" list-style-type:none;">'
            . '<li></li>'
            . '<li>ASIIN</li> <br/>'
            . '<li>ASIIN</li> <br/>'
            . '<li>ASIIN</li> <br/>'
            . '<li>ASIIN and HEI</li> <br/>'
            . '</ul></td>'
            . '<td>'
            . '<ul>'
            . '<li>Assessment by peers of whether requirements are met and, where appropriate, questions to HEI.</li>'
            . '<li>Recommendation by review team for decision on the extension of accreditation to the full period.</li>'
            . '<li>Comments by Technical Committee(s) in charge with recommendation for decision on the extension of accreditation.</li>'
            . '<li>Model I: Decision by the ASIIN Accreditation Commission for Degree Programmes on fulfilment of requirements and extension of accreditation and, where appropriate, on the award of the seal(s) applied for.</li>'
            . '<li>Model II: Adoption by the ASIIN Accreditation Commission for Degree Programmes of report on compliance with requirements and submission of recommendation for decision to the third-party body responsible for national accreditation according to the country in which the HEI is situated.</li>'
            . '<li>Model III: Combination of model I and II.</li>'
            . '<li>Notification of decision to the HEI.</li>'
            . '<li>In the case of a positive decision, the documents/authorisations containing the extension to use a seal are issued to the HEI.</li>'
            . '<li>Notification of the decision to the owners of any other seals applied for (e.g. the German Accreditation Council).</li>'
            . '<li>Publication of the results of compliance with the requirements and/or removal of requirements from the website in accordance with ESG requirements.</li>'
            . '</ul></td>'
            . '</tr>'
            . '</table>'
            . ' <br/> <br/><b>Procedure relating to suspension and resumption of a procedure</b> <br/> <br/>'
            . '<table border ="0">'
            . '<tr>'
            . '<td>Resumption of the procedure</td>'
            . '<td>HEI</td>'
            . '<td>'
            . '<ul>'
            . '<li>Submission by HEI of evidence that conditions transmitted with the suspension decision have been met by the HEI within the time limit as notified by ASIIN.</li>'
            . '</ul></td>'
            . '</tr>'
            . '<tr>'
            . '<td>2. Decision<br/> '
            . '<ul>'
            . '<li>Recommendation by peers</li>'
            . '<li>Recommendation of Technical Committees</li>'
            . '<li>Decision by the Accreditation Commission</li>'
            . '<li>Notification and publication</li>'
            . '</ul></td>'
            . '<td>'
            . '<ul style=" list-style-type:none;">'
            . '<li></li>'
            . '<li>ASIIN</li> <br/>'
            . '<li>ASIIN</li> <br/>'
            . '<li>ASIIN</li> <br/>'
            . '<li>ASIIN and HEI</li> <br/>'
            . '</ul></td>'
            . '<td>'
            . '<ul>'
            . '<li>Assessment by peers of whether conditions are met and, where appropriate, questions to HEI.</li>'
            . '<li>Recommendation of review team for decision on resumption of the procedure and accreditation and/or award of the seal(s) applied for.</li>'
            . '<li>Comments by Technical Committee(s) in charge with recommendation for decision on resumption of the procedure and accreditation and/or award of the seal(s) applied for.</li>'
            . '<li>Model I: Decision by the ASIIN Accreditation Commission for Degree Programmes on fulfilment of requirements and extension of accreditation and, where appropriate, on the award of the seal(s) applied for.</li>'
            . '<li>Model II: Adoption by the ASIIN Accreditation Commission for Degree Programmes of report on resumption of the procedure and submission of recommendation to the external body responsible for national accreditation according to the country in which the HEI is situated.</li>'
            . '<li>Model III: Combination of model I and II.</li>'
            . '<li>Notification of decision to the HEI.</li>'
            . '<li>Handover of the accreditation report (final version) to the HEI and, if positive, any certificates/authorisations to use a seal.</li>'
            . '<li>Transmission of the accreditation report (final version) to the owners of any other seals applied for (e.g. the German Accreditation Council).</li>'
            . '<li>Publication of a summary and the accreditation report on the website in accordance with ESG requirements.</li>'
            . '</ul></td>'
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
