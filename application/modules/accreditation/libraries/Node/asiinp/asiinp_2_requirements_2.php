<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\asiinp;

/**
 * Description of asiinp_2_requirments_2
 *
 * @author laith
 */
class Asiinp_2_Requirements_2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '2.2 General requirements for the accreditation of degree programmes';
    protected $link_view = true;
    protected $orientation = 'landscape';

    public function init()
    {
        parent::init();

            $this->set_info();
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'The following table lists the General Requirements for the accreditation of degree programmes. <br/> <br/>'
            . 'The table shows the requirements that need to be met to gain a certain seal. Regardless of the country in which ASIIN carries out an accreditation procedure, the ASIIN seal is always awarded based on the European Standards and Guidelines (ESG). To this end, the table first shows the overlap between the requirements for granting the ASIIN seal with those of the ESG (columns 1 and 2). The ASIIN Criteria correspond to the ESG or even exceed them. The present document quotes the standards in full, but only excerpts are quoted from the associated guidelines in the ESG where this helps to explain the standards. <br/> <br/>'
            . 'In column 3, the requirements of the German Accreditation Council for granting its seal are placed in relation to the first two sets of criteria. Some of these correspond, but in part, they must also be considered in their own right if the Accreditation Council’s seal is to be granted (only relevant for German degree programmes). This third column is only applicable to those cases where the Accreditation Council’s seal has been requested and where it is permissible to grant it. If the Higher Education Institution applies solely for the seal of the German Accreditation Council, only column 3 is relevant. <br/> <br/>'
            . 'For accreditation procedures in other countries or legal jurisdictions, in some cases other national requirements may be included within ASIIN’s process as needed after consultation with the higher education institution commissioning the accreditation. In such cases, the contents of column 3 are replaced by the applicable requirements. In order to attain the ASIIN seal solely under private law, only columns 1 and 2 are applicable. <br/> <br/>'
            . 'The table is designed to be readable in both directions, showing the points where the three criteria sets agree.'
            . '<table border ="1">'
            . '<tr>'
            . '<td colspan="3" >The ASIIN seal</td>'
            . '<td>Accreditation Council (AC) seal</td>'
            . '</tr>'
            . '<tr>'
            . '<td colspan="2">ASIIN requirements</td>'
            . '<td>(Corresponding) European Standards and Guidelines (ESG)</td>'
            . '<td>(Corresponding) requirements of the Accreditation Council (Germany)</td>'
            . '</tr>'
            . '<tr>'
            . '<td>1</td>'
            . '<td colspan="3">THE DEGREE PROGRAMME: CONCEPT, CONTENT & IMPLEMENTATION</td>'
            . '</tr>'
            . '<tr>'
            . '<td>1.1</td>'
            . '<td><b>Objectives and learning outcomes of a degree programme (intended qualifications profile)</b><br/>The objectives and learning outcomes of the degree programme (i.e. the intended qualifications profile) are described in a brief and concise way. They are well-anchored, binding and easily accessible to the public, i.e. to students, teaching staff and anyone else interested. <br/>The aims and learning outcomes: <br/> &#10142; reflect the level of academic qualification aimed at 6 and are equivalent to the learning outcome examples described in the respective ASIIN Subject-Specific Criteria (SSC); <br/> &#10142; are viable and valid; <br/> &#10142; are analysed on a regular basis and developed further if necessary. <br/> The intended qualifications profile allows the students to take up an occupation which corresponds to their qualification (professional classification). <br/> The relevant stakeholders were included in the process of formulating and further developing the objectives and learning outcomes. <br/> [Documentation/supporting records: guidelines, website, Diploma Supplement, student handbooks, alumni surveys etc.] </td>'
            . '<td><b>ESG 1.2:</b> <br/> Institutions should have formal mechanisms for the approval, periodic review and monitoring of their programmes and awards. [...] The quality assurance of programmes and awards are expected to include: development and publication of explicit	intended learning outcomes; [...] regular feedback from employers, labour market representatives and other relevant organisations; participation of students in quality assurance activities. <br/> <b>ESG 1.3:</b> <br/> tudents should be assessed using published criteria, regulations and procedures which are applied consistently. [...] Student assessment procedures are expected to be designed to measure the achievement of the intended learning outcomes and other programme objectives. [...] <br/> <b>ESG 1.6:</b> <br/> Institutions should ensure that they collect, analyse and use relevant information for the effective management of their programmes of study and other activities. [...] The quality-related information systems required by individual institutions will depend to some	extent on local circumstances, but it is at least expected to cover: [...] employability of	graduates [...]  <br/> <b>ESG 1.7:</b> <br/> Institutions should regularly publish up to date, impartial and objective information, both quantitative and qualitative, about the programmes and awards they are offering. [...] In fulfilment of their public role, higher education institutions have a responsibility 	to provide information about [...] the 	intended learning outcomes. [...] </td>'
            . '<td><b>2.1 Qualification Objectives of the Study Programme Concept</b> <br/> <br/> The study programme concept orients itself towards qualification objectives. These comprise of technical and interdisciplinary aspects, particularly <br/> &#10142; scientific or artistic qualification, <br/> &#10142; competence to take up a qualified employment, <br/> &#10142; competence for involvement in society, <br/> &#10142; and personality development. <br/> <br/> <b>2.2 Conceptual Integration of the Study Programme in the System of Studies</b> <br/> The study programme complies with (1) the requirements of the Framework of Qualification for German Degrees of 21 April 2005 in the respective valid version,</td>'
            . '</tr>'
            . '<tr>'
            . '<td>1.2</td>'
            . '<td><b>Title of the degree programme</b> <br/> The degree programme title reflects the intended aims and learning outcomes as well as, fundamentally, the main course language. [Documentation/supporting records: guidelines, website, Diploma Supplement etc.]</td>'
            . '<td></td>'
            . '<td></td>'
            . '</tr>'
            . '<tr>'
            . '<td>1.3</td>'
            . '<td> <b>Curriculum</b> <br/> The curriculum allows the students to achieve the intended learning outcomes in order to obtain the degree. <br/> <br/> The overall objectives and intended learning outcomes for the degree programme are systematically substantiated and updated in its individual modules 7 . It is clear which knowledge, skills and competences students will acquire in each module.  <br/> <br/> [Documentation/supporting records: guidelines, curricular overview, module/objectives matrix, website, student handbooks etc.] </td>'
            . '<td> <b>ESG 1.2:</b> <br/> Institutions should have formal mechanisms for the approval, periodic review and monitoring of their programmes and awards. [...] The quality assurance of programmes and awards are expected to include: [...] careful attention to curriculum and programme design and content [...] </td>'
            . '<td> <b>2.3 Study Programme Concept</b> <br/> The study programme concept covers the imparting of specialised knowledge and inter-disciplinary knowledge as well as of technical procedural and generic competences. </td>'
            . '</tr>'
            . '<tr>'
            . '<td>1.4</td>'
            . '<td>In terms of admission, the requirements and procedures are binding, transparent and the same for all applicants. The admission requirements are structured in a way that supports the students in achieving the learning outcomes. There are clear rules as to how individual admission requirements that have not been fulfilled can be compensated. A lack of previous knowledge must, however, never be compensated at the expense of degree quality. [Documentation/supporting records: guidelines, website, student handbooks etc.]</td>'
            . '<td></td>'
            . '<td>2.2 Conceptual Integration of the Study Programme in the System of Studies The study programme complies with (1) the requirements of the Framework of Qualification for German Degrees of 21 April 2005 in the respective valid version, (2) the requirements of the Common Structural Guidelines of the Länder for the Accreditation for Bachelor and Masters Study Programmes of 10 October 2003 in the respective valid version, [A 2. Admission requirements and transitions] 2.3 Study Programme Concept [...] It lays down the admission requirements and if necessary an adequate selection procedure [...] 2.4 Academic Feasibility The academic feasibility of the study programme is ensured through: Î consideration of the expected entry qualifications [...]</td>'
            . '</tr>'
            . '<tr>'
            . '<td>2</td>'
            . '<td colspan="3">THE DEGREE PROGRAMME: STRUCTURES, METHODS AND IMPLEMENTATION</td>'
            . '</tr>'
            . '<tr>'
            . '<td>2.1</td>'
            . '<td> <b>Structure and modules</b> <br/>All degree programmes must be divided into modules. Each module is a sum of teaching and learning whose contents are concerted. With its choice of modules, the structure ensures that the learning outcomes can be reached and allows students to define an individual focus and course of study (student mobility, work experience etc.).The curriculum is structured in a way to allow students to complete the degree without exceeding the regular course duration. The modules have been adapted to the requirements of the degree programme. They ensure that each module objectives helps to reach both the qualification level and the overall intended learning outcomes. All working practice intervals or internships are well-integrated into the curriculum, and the higher education institution vouches for their quality in terms of relevance, content and structure. There are rules for recognising achievements and competences acquired outside the higher education institution. They render the transition between higher education institutions easier and ensure that the learning outcomes are reached at the level aimed at 8 . [Documentation/supporting records: guidelines, module descriptions, student handbooks, student progression statistics etc.] </td>'
            . '<td> <b>ESG 1.2:</b> <br/> Institutions should have formal mechanisms for the approval, periodic review and monitoring of their programmes and awards. [...] The quality assurance of programmes and awards are expected to include: [...] careful attention to [...] programme design and content; specific needs of different modes of delivery (e.g. full time, part-time, distance learning, e-learning) and types of higher education (e.g. academic, vocational, professional) [...]</td>'
            . '<td> <b>2.2 Conceptual Integration of the Study Programme in the System of Studies</b> <br/> The study programme complies with [...] (2) the requirements of the Common Structural Guidelines of the Länder for the Accreditation for Bachelor and Masters Study Programmes of 10 October 2003 in the respective valid version, [A 7. Modularisation, mobility and credit point system; Framework guidelines for the introduction of credit point systems and the modularisation of study courses] <br/><b>2.3 Study Programme Concept</b> <br/>[...] It is built up coherently in the combination of the individual modules with regard to the formulated qualification objectives and provides adequate forms of teaching and learning. Possibly planned practical components are so organised that credit points (ECTS) can be acquired. [...] It lays down the [...] rules for both the recognition of credits achieved at other higher education institutions in accordance with the Lisbon Recognition Convention as well as externally achieved credits. Regulations are provided for compensating disadvantages of handicapped students. Possibly planned mobility windows are integrated in the curriculum. The organisation of studies ensures the implementation of the study programme concept <br/><b>2.4 Academic Feasibility</b> <br/>The academic feasibility of the study programme is ensured through: [...] <br/> &#10142; an appropriate curriculum design [...] </td>'
            . '</tr>'
            . '<tr>'
            . '<td>2.2</td>'
            . '<td> <b>Work load and credits</b> <br/> The estimated time budgets are realistic enough to enable students to complete the degree without exceeding the regular course duration. Structure-related peaks in the work load have been avoided. A credit point system oriented on the amount of work required from students has been devised 9 . The work load comprises both attendance-based learning and self-study. This includes all compulsory elements of the degree. [Documentation/supporting records: module descriptions, work load surveys and analyses etc.]</td>'
            . '<td></td>'
            . '<td> <b>2.2 Conceptual Integration of the Study Programme in the System of Studies</b> <br/> The study programme complies with [...] (2) the requirements of the Common Structural Guidelines of the Länder for the Accreditation for Bachelor and Masters Study Programmes of 10 October 2003 in the respective valid version [Framework guidelines for the introduction of credit point systems and the modularisation of study courses] <br/> <b>2.4 Academic Feasibility</b> The academic feasibility of the study programme is ensured through: [...]  <br/> &#10142; the information on the student workload, which is checked for plausibility (or, in the case of the first accreditation, estimated according to empirical values), [...]</td>'
            . '</tr>'
            . '<tr>'
            . '<td>2.3</td>'
            . '<td><b>Teaching methodology</b> <br/> The teaching methods and instruments used support the students in achieving the learning outcomes. The degree programme is designed to be well-balanced between attendance-based earning and self-study. Familiarising the students with independent academic research and writing plays a vital role in the programme. [Documentation/supporting records: module descriptions etc.]</td>'
            . '<td></td>'
            . '<td></td>'
            . '</tr>'
            . '<tr>'
            . '<td>2.4</td>'
            . '<td><b>Support and assistance</b> <br/> There are resources available to provide individual assistance, advice and support for all students. The allocated advice and guidance (both technical and general) on offer assist the students in achieving the learning outcomes and in completing the course within the scheduled time. [Documentation/supporting records: consultation concepts, student handbooks etc.]</td>'
            . '<td><b>ESG 1.5:</b> <br/> Institutions should ensure that the resources available for the support of student learning are adequate and appropriate for each programme offered. [...] Learning resources and other support mechanisms should be readily accessible to students, designed with their needs in mind and responsive to feedback from those who use the services provided. Institutions should routinely monitor, review and improve the effectiveness of the support services available to their students.</td>'
            . '<td><b>2.4 Academic Feasibility</b> <br/> The academic feasibility of the study programme is ensured through: [...]  <br/>&#10142 corresponding offers of support as well as  <br/>&#10142 technical and interdisciplinary course guidance. [...]</td>'
            . '</tr>'
            . '<tr>'
            . '<td>3</td>'
            . '<td colspan="3">EXAMS: SYSTEM, CONCEPT AND ORGANISATION</td>'
            . '</tr>'
            . '<tr>'
            . '<td>3.1</td>'
            . '<td> Exams 10 are devised to individually measure to which extent students have reached the learning outcomes defined. Exams are structured to cover all of the intended learning outcomes (knowledge, skills and competences). Exams are module-related and offer students continuous feedback on their progress in developing competences. The degree programme comprises a thesis/dissertation or final project which ensures that students work on a set task independently and at the level aimed for. For each module, a form of assessment (including suitable alternatives, if any) has been defined. There are mechanisms in place which ensure that all students learn the details of what is required in order to pass the module (pre-examination elements, assignments etc.) no later than at the start of the module. Rules have been defined for re-sits, disability compensation measures, illness and other mitigating circumstances etc. The number and distribution of the exams ensure that both the exam load and preparation times are adequate. All exams are organised in a way which avoids delays to student progression caused by deadlines, exam correction times, re-sits etc. All exams are marked using transparent criteria. There are mechanisms in place which ensure that exams marked by different examiners are comparable. The higher education institution vouches for the quality in terms of relevance, content and structure of all student assignments completed outside the institution. [Documentation/supporting records: guidelines, inspection of exams, work placement and project reports, examination minutes, theses/dissertations etc.]</td>'
            . '<td><b>ESG 1.3:</b> <br/> Students should be assessed using published criteria, regulations and procedures which are applied consistently [...] Student assessment procedures are expected to: be designed to measure the achievement of the intended learning outcomes and other programme objectives; be appropriate for their purpose, whether diagnostic, formative or summative; have clear and published criteria for marking; be undertaken by people who understand the role of assessment in the progression of students towards the achievement of the knowledge and skills associated with their intended qualification; where possible, not rely on the judgements of single examiners; take account of all the possible consequences of examination regulations; have clear regulations covering student absence, illness and other mitigating circumstances; ensure that assessments are conducted securely in accordance with the institution’s stated procedures; be subject to administrative verification checks to ensure the accuracy of the procedures. In addition, students should be clearly informed about the assessment strategy being used for their programme, what examinations or other assessment methods they will be subject to, what will be expected of them, and the criteria that will be applied to the assessment of their performance.</td>'
            . '<td><b>2.2 Conceptual Integration of the Study Programme in the System of Studies</b> <br/> The study programme complies with [...] (2) the requirements of the Common Structural Guidelines of the Länder for the Accreditation for Bachelor and Masters Study Programmes of 10 October 2003 in the respective valid version [Framework guidelines for the introduction of credit point systems and the modularisation of study courses] <br/> <b>2.4 Academic Feasibility</b><br/> The academic feasibility of the study programme is ensured through: [...] frequency and organisation of examination, which is adequate and has a reasonable workload [...] <b>2.4 Academic Feasibility</b> <br/> The interests of handicapped students will be taken into consideration.  <br/><b>2.5 Examination System</b> The examinations serve the purpose of determining, whether the formulated qualification objectives have been accomplished. They are module-related as well as knowledge and competence oriented. Every module, as a rule, concludes with an examination covering the entire module. Compensating disadvantages of handicapped students with regard to time-related and formal guidelines in the studies as well as in the final performance tests and those during the studies is ensured. The examination regulations were subjected to legal verification.</td>'
            . '</tr>'
            . '<tr>'
            . '<td>4</td>'
            . '<td colspan="3">RESOURCES</td>'
            . '</tr>'
            . '<tr>'
            . '<td>4.1</td>'
            . '<td><b>Staff</b> <br/> The composition, scientific orientation and qualification of the teaching staff team are suitable for sustaining the degree. There are sufficient staff resources available for: <br/> &#10142; providing assistance and advice to students <br/> &#10142; administrative tasks The research and development activities carried out by the teaching staff are in line with and support the level of academic qualification aimed at. [Documentation/supporting records: staff descriptions, overview of research and development activities]</td>'
            . '<td><b>ESG 1.4:</b> <br/> Institutions should have ways of satisfying themselves that staff involved with the teaching of students are qualified and competent to do so. They should be available to those undertaking external reviews, and commented upon in reports. [...]</td>'
            . '<td><b>2.7 Facilities</b> <br/> The adequate implementation of the study programme is ensured with regard to the qualitative and quantitative facilities with regard to personnel [...]. In this interdependence with other study programmes is taken into account. [...]</td>'
            . '</tr>'
            . '<tr>'
            . '<td>4.2</td>'
            . '<td><b>Staff development</b> <br/> Staff development There are offers and support mechanisms available for teaching staff who wish to further develop their professional and teaching skills. [Documentation: staff overview etc.]</td>'
            . '<td></td>'
            . '<td><b>2.7 Facilities</b> <br/> [...] Measures for a personnel development and qualification are available.</td>'
            . '</tr>'
            . '<tr>'
            . '<td>4.3</td>'
            . '<td><b>Funds and equipment</b> <br/> The available funds and equipment form a sound and solid basis for the degree programme including:  <br/>&#10142; guaranteed funds  <br/>&#10142; sufficient and high-quality infrastructure  <br/>&#10142; solid, binding rules for all internal and external cooperations <br/> [Documentation: cooperation agreements, overview of funds and equipment etc.]</td>'
            . '<td><b>ESG 1.5:</b> <br/>Institutions should ensure that the resources available for the support of student learning are adequate and appropriate for each programme offered.[...] Learning resources and other support mechanisms should be readily accessible to students, designed with their needs in mind and responsive to feedback from those who use the services provided. [...]  <br/><b>ESG 1.2:</b> <br/>Institutions should have formal mechanisms for the approval, periodic review and monitoring of their programmes and awards. [...] The quality assurance of programmes and awards are expected to include: [...] availability of appropriate learning resources; formal programme approval procedures by a body other than that teaching the programme [...]</td>'
            . '<td><b>2.6 Programme-related Co-operations</b> <br/>The Higher Education Institution ensures the implementation and the quality of the study programme concept, if other organisations are involved or commissioned by the former to carry out parts of the study programme. A written record is kept of the extent and nature of existing co-operations with other higher education institutions, companies and other organisations as well as for any agreements upon which the co-operation is based. <br/> <b>2.7 Facilities</b> <br/> The adequate implementation of the study programme is ensured with regard to the qualitative and quantitative facilities with regard to [...] material and space. In this interdependence with other study programmes is taken into account. [...] </td>'
            . '</tr>'
            . '<tr>'
            . '<td>5</td>'
            . '<td colspan="3">TRANSPARENCY AND DOCUMENTATION</td>'
            . '</tr>'
            . '<tr>'
            . '<td>5.1</td>'
            . '<td><b>Module descriptions</b> <br/> The module descriptions are accessible to all students and teaching staff and contain the following:  <br/>&#10142; module identification code  <br/>&#10142; person(s) responsible for each module  <br/>&#10142; teaching method(s) and work load  <br/>&#10142; credit points  <br/>&#10142; intended learning outcomes  <br/>&#10142; module content  <br/>&#10142; planned use/applicability  <br/>&#10142; admission and examination requirements  <br/>&#10142; form(s) of assessment and details  <br/>explaining how the module mark is calculated  <br/>&#10142; recommended literature  <br/>&#10142; date of last amendment made [Documents: module descriptions]</td>'
            . '<td rowspan="2"><b>ESG 1.7:</b> <br/> Institutions should regularly publish up to date, impartial and objective information, both quantitative and qualitative, about the programmes and awards they are offering.</td>'
            . '<td><b>2.2 Conceptual Integration of the Study Programme in the System of Studies</b> <br/> The study programme complies with [...] (2) the requirements of the Common Structural Guidelines of the Länder for the Accreditation for Bachelor and Masters Study Programmes of 10 October 2003 in the respective valid version [Framework guidelines for the introduction of credit point systems and the modularisation of study courses]</td>'
            . '</tr>'
            . '<tr>'
            . '<td>5.2</td>'
            . '<td><b>Diploma and Diploma Supplement</b> <br/> Shortly after graduation, a diploma or degree certificate is issued together with a Diploma Supplement printed in English. These documents provide information on the students qualifications profile and individual performance as well as the classification of the degree programme with regard to its applicable education system. The individual modules and the grading procedure on which the final mark is based are explained in a way which is clear for third parties. In addition to the final mark, statistical data as set forth in the ECTS Users Guide is included to allow readers to categorise the individual result/degree. [Documentation/supporting records: sample diploma, specific (course-related) English Diploma Supplement, transcript of records etc.]</td>'
            . '<td><b>2.2 Conceptual Integration of the Study Programme in the System of Studies</b> <br/> The study programme complies with [...] (2) the requirements of the Common Structural Guidelines of the Länder for the Accreditation for Bachelor and Masters Study Programmes of 10 October 2003 in the respective valid version [A 6. Designation of qualifications/degrees]</td>'
            . '</tr>'
            . '<tr>'
            . '<td>5.3</td>'
            . '<td><b>Relevant rules</b> <br/>The rights and duties of both the higher education institution and students are clearly defined and binding (guidelines, statutes etc.). All relevant course-related information is available in the language of the degree programme and accessible for anyone involved. [Documentation/supporting records: guidelines etc.]</td>'
            . '<td><b>ESG 1.3:</b> <br/>Students should be assessed using published criteria, regulations and procedures which are applied consistently. [...] Student assessment procedures are expected to: [...] take account of all the possible consequences of examination regulations; [...] be subject to administraive verification checks to ensure the accuracy of the procedures. [...]</td>'
            . '<td><b>2.8 Transparency and Documentation</b> <br/>The study programme, course of study, examination requirements and the prerequisites for admittance including the regulations for compensating disadvantages of handicapped students are documented and published.</td>'
            . '</tr>'
            . '<tr>'
            . '<td>6</td>'
            . '<td colspan="3">QUALITY MANAGEMENT: QUALITY ASSESSMENT AND DEVELOPMENT</td>'
            . '</tr>'
            . '<tr>'
            . '<td></td>'
            . '<td>The programme is subject to regular internal quality assessment procedures aiming at continuous improvement. All responsibilities and mechanisms defined for the purposes of continued development are binding. Students and other stakeholders take part in the quality assurance process. The outcomes and all measures derived are made known to anyone involved. All methods employed and data analysed are suitable for the purpose and used to continue improving the degree programme, especially with a view to identifying and resolving weaknesses. To this end, the information they provide includes:  <br/>- whether the intended learning outcomes required to obtain the degree have been achieved;  <br/>- the academic feasibility of the degree programme;  <br/>- student mobility (abroad, where applicable);  <br/>- how the qualifications profile is accepted on the labour market;  <br/>- the effect of measures in use to avoid unequal treatment at the higher education institution (if any). [Documentation/supporting records: results obtained in internal and external evaluations, statistical data regarding new students, graduates, etc., statistics about alumni ]</td>'
            . '<td><b>ESG 1.1:</b> <br/> Institutions should have a policy and associated procedures for the assurance of the quality and standards of their programmes and awards. They should also commit themselves explicitly to the development of a culture which recognises the importance of quality, and quality assurance, in their work. To achieve this, institutions should develop and implement a strategy for the continuous enhancement of quality. The strategy, policy and procedures should have a formal status and be publicly available. They should also include a role for students and other stakeholders. [...]The policy statement is expected to include: [...] the responsibilities of departments, schools, faculties and other organizational units and individuals for the assurance of quality; [...] <br/> ESG 1.2: <br/>Institutions should have formal mechanisms for the approval, periodic review and monitoring of their programmes and awards. [...] The quality assurance of programmes and awards are expected to include: [...] regular periodic reviews of programmes (including external panel members); [...] participation of students in quality assurance activities. <br/><b>ESG 1.6:</b> <br/>Institutions should ensure that they collect, analyse and use relevant information for the effective management of their programmes of study and other activities. [...] The quality-related information systems required by individual institutions will depend to some extent on local circumstances, but it is at least expected to cover: student progression and success rates; employability of graduates; students’ satisfaction with their programmes; effectiveness of teachers; profile of the student population; learning resources available and their costs; the institution’s own key performance indicators.[...]</td>'
            . '<td><b>2.4 Academic Feasibility</b> <br/> The interests of handicapped students will be taken into consideration.  <br/><b>2.8 Transparency and Documentation</b> <br/> The study programme, course of study, examination requirements and the prerequisites for admittance including the regulations for compensating disadvantages of handicapped students are documented and published.</td>'
            . '</tr>'
            . '<tr>'
            . '<td></td>'
            . '<td colspan="3">OTHER REQUIREMENTS</td>'
            . '</tr>'
            . '<tr>'
            . '<td></td>'
            . '<td></td>'
            . '<td></td>'
            . '<td><b>2.2 Conceptual Integration of the Study Programme in the System of Studies</b> <br/> The study programme complies with (1) the requirements of the Framework of Qualification for German Degrees of 21 April 2005 in the respective valid version, (2) the requirements of the Common Structural Guidelines of the Länder for the Accreditation for Bachelor and Master’s Study Programmes of 10 October 2003 in the respective valid version, [especially  <br/> &#10142; A 1. Structure and duration of studies  <br/> &#10142; A 3. Profiles of the study courses  <br/> &#10142; A 4. Consecutive Master’s study courses and Master’s study courses providing further education  <br/> &#10142; A 5. Qualifications/Degrees  <br/> &#10142; A 6. Designation of qualifications/degrees] (3) Länder-specific structural guidelines for the accreditation for Bachelor’s and Master’s study programmes, (4) the binding interpretation and summary of (1) to (3) by the Accreditation Council. <br/> <b>2.10 Study Programmes with a Special Profile Demand</b> <br/> Study programmes with a special profile demand have special requirements. The afore-mentioned criteria and rules of procedure have to be applied under consideration of these requirements. <br/><b> 2.11 Gender Justice and Equal Opportunities</b> <br/> The concepts of the Higher Education Institution for gender justice and for the promotion of equal opportunities of students in special situations such as students having health impairments, students having children, foreign students, students with migration background and/or from so-called educationally disadvantaged classes are implemented at the level of the study programme</td>'
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
