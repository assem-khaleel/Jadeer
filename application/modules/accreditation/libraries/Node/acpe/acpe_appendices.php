<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\acpe;

/**
 * Description of acpe_appendices
 *
 * @author ahmadgx
 */
class Acpe_Appendices extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Appendices';
    protected $link_pdf = true;
    protected $link_view = true;
    protected $link_edit = true;

    public function init()
    {
        parent::init();

            $this->set_appendix_1('');
            $this->set_appendix_1_attach('');
            $this->set_appendix_2('');
            $this->set_appendix_2_attach('');
            $this->set_appendix_3('');
            $this->set_appendix_3_attach('');
    }

    public function set_appendix_1()
    {
        $property = new \Orm_Property_Fixedtext('appendix_1', '<strong>Appendix 1 Required Elements of the Didactic Doctor of Pharmacy Curriculum</strong>'
            . ' <br/> <br/>The following didactic content areas and associated learning expectations are viewed as central to a contemporary, high-quality pharmacy education and are incorporated at an appropriate breadth and depth in the required didactic Doctor of Pharmacy curriculum. Where noted, content areas may be addressed in the pre-professional curriculum (i.e., as requirements for admission). Required content areas may be delivered within individual or integrated courses, and may involve multiple disciplines.'
            . ' <br/> <br/>This appendix was purposely written at the level of broad learning outcomes. It was constructed to provide statements of concepts and understandings essential for pharmacists to master, rather than a list of required topics to cover in the didactic curriculum. The goal is to ensure that critical areas of learning are included in the curricula of all programs without dictating how the lessons are structured, organized, or delivered.'
            . ' <br/> <br/>The clear expectation embedded within Appendix 1 is that students will develop the comprehensive knowledge base required to be ‘practice ready’ and that they will be able to retain, recall, build upon, and apply that knowledge to deliver quality patient care in a variety of entry-level practice settings.'
            . ' <br/> <br/><strong>NOTE:</strong>The topics under each Science category are organized in alphabetical order. <br/> <br/>'
            . '<strong>Biomedical Sciences</strong>(may be addressed in the pre-professional curriculum) <br/>'
            . '<ins>Biochemistry</ins>'
            . '<ul>'
            . '<li>Structure, properties, biological functions, applicable kinetics, and metabolic fate of macromolecules essential to life (proteins, lipids, carbohydrates, and nucleic acids). Application of these concepts to identify endogenous targets for drug therapy and rational drug design strategies.</li>'
            . '</ul>'
            . '<ins>Biostatistics</ins>'
            . '<ul>'
            . '<li>Appropriate use of commonly employed statistical tests, management of data sets, and the evaluation of the validity of conclusions generated based on the application of those tests to the data sets.</li>'
            . '</ul>'
            . '<ins>Human Anatomy</ins>'
            . '<ul>'
            . '<li>Structure of major human body systems at the cellular, tissue, organ, and system level.</li>'
            . '</ul>'
            . '<ins>Human Physiology</ins>'
            . '<ul>'
            . '<li>Homeostatic function and normal response reactions across the lifespan of non-diseased human cells, organs, and systems.</li>'
            . '</ul>'
            . '<ins>Immunology</ins>'
            . '<ul>'
            . '<li>Human immune system components, innate and adaptive immune responses to infection, injury and disease, and augmentation of the human immune system to prevent disease.</li>'
            . '</ul>'
            . '<ins>Medical Microbiology</ins>'
            . '<ul>'
            . '<li>Structure, function, and properties of microorganisms (bacteria, viruses, parasites, and fungi) responsible for human disease, and rational approaches to their containment or eradication.</li>'
            . '</ul>'
            . '<ins>Pathology/Pathophysiology</ins>'
            . '<ul>'
            . '<li>Basic principles, mechanisms, functional changes and metabolic sequelae of human disease impacting cells, organs, and systems.</li>'
            . '</ul>'
            . '<br/><br/><strong>Pharmaceutical Sciences</strong> <br/>'
            . '<ins>Clinical Chemistry</ins>'
            . '<ul>'
            . '<li>Application of clinical laboratory data to disease state management, including screening, diagnosis, progression, and treatment evaluation.</li>'
            . '</ul>'
            . '<ins>Extemporaneous Compoundin</ins>'
            . '<ul>'
            . '<li>Preparation of sterile and non-sterile prescriptions which are pharmaceutically accurate regarding drug product and dose, free from contamination, and appropriately formulated for safe and effective patient use. Analysis of the scientific principles and quality standards upon which these compounding requirements are based.</li>'
            . '</ul>'
            . '<ins>Medicinal Chemistry</ins>'
            . '<ul>'
            . '<li>Chemical basis of drug action and behavior in vivo and in vitro, with an emphasis on pharmacophore recognition and the application of physicochemical properties, structure-activity relationships, intermolecular drug-receptor interactions and metabolism to therapeutic decision-making.</li>'
            . '</ul>'
            . '<ins>Pharmaceutical Calculations</ins>'
            . '<ul>'
            . '<li>Mastery of mathematical skills required to accurately prepare prescriptions (including extemporaneously compounded dosage forms) that are therapeutically sound and safe for patient use. Calculation of patient-specific nutritional and drug dosing/delivery requirements.</li>'
            . '</ul>'
            . '<ins>Pharmaceutics/Biopharmaceutics</ins>'
            . '<ul>'
            . '<li>Physicochemical properties of drugs, excipients, and dosage forms important to the rational design and manufacture of sterile and non-sterile products. Application of physical chemistry and dosage form science to drug stability, delivery, release, disposition, pharmacokinetics, therapeutic effectiveness, and the development of quality standards for drug products.</li>'
            . '</ul>'
            . '<ins>Pharmacogenomics/genetics</ins>'
            . '<ul>'
            . '<li>Genetic basis for disease and individual differences in metabolizing enzymes, transporters, and other biochemicals impacting drug disposition and action that underpin the practice of personalized medicine.</li>'
            . '</ul>'
            . '<ins>Pharmacokinetics</ins>'
            . '<ul>'
            . '<li>Mathematical determination of the rate of drug movement from one therapeutic or physiologic compartment to another. Application of physicochemical and kinetic principles and parameters to therapeutically important issues, such as drug delivery, disposition, therapeutic effectiveness, and beneficial or adverse interactions in general and specific populations.</li>'
            . '</ul>'
            . '<ins>Pharmacology</ins>'
            . '<ul>'
            . '<li>Pharmacodynamics, mechanisms of therapeutic and adverse drug actions and interactions, lifespan-dependent variations in physiology or biochemistry that impact drug action and effectiveness, and application of these principles to therapeutic decision-making.</li>'
            . '</ul>'
            . '<ins>Toxicology</ins>'
            . '<ul>'
            . '<li>Pharmacodynamics, mechanisms, prevention, and treatment of the toxic effects of drugs and poisons, including poisons associated with bioterrorism.</li>'
            . '</ul>'
            . '<br/><br/><strong>Social/Administrative/Behavioral Sciences</strong> <br/>'
            . '<ins>Cultural Awareness</ins>'
            . '<ul>'
            . '<li>Exploration of the potential impact of cultural values, beliefs, and practices on patient care outcomes.</li>'
            . '</ul>'
            . '<ins>Ethics</ins>'
            . '<ul>'
            . '<li>Exploration of approaches for resolving ethical dilemmas in patient care, with an emphasis on moral responsibility and the ability to critically evaluate viable options against the needs of patients and other key stakeholders.</li>'
            . '</ul>'
            . '<ins>Healthcare Systems</ins>'
            . '<ul>'
            . '<li>Examination of U.S. health systems and contemporary reimbursement models in which patient-centered and/or population-based care is provided and paid for, and how social, political, economic, organizational, and cultural factors influence providers’ ability to ensure patient safety and deliver coordinated interprofessional care services.</li>'
            . '</ul>'
            . '<ins>History of Pharmacy</ins>'
            . '<ul>'
            . '<li>Exploration of the evolution of pharmacy as a distinct profession, the transition from a focus on the drug to a focus on the patient and the drug (including pharmacist-provided patient care), and major milestones and contributors in the evolution of pharmacy.</li>'
            . '</ul>'
            . '<ins>Pharmacoeconomics</ins>'
            . '<ul>'
            . '<li>Application of economic principles and theories to the provision of cost-effective pharmacy products and services that optimize patient-care outcomes, particularly in situations where healthcare resources are limited.</li>'
            . '</ul>'
            . '<ins>Pharmacoepidemiology</ins>'
            . '<ul>'
            . '<li>Cause-and-effect patterns of health and disease in large populations that advance safe and effective drug use and positive care outcomes within those populations.</li>'
            . '</ul>'
            . '<ins>Pharmacy Law and Regulatory Affairs</ins>'
            . '<ul>'
            . '<li>Federal and appropriate state-specific statutes, regulations, policies, executive orders, and court decisions that regulate the practice of pharmacy, including the mitigation of prescription drug abuse and diversion</li>'
            . '</ul>'
            . '<ins>Practice Management</ins>'
            . '<ul>'
            . '<li>Application of sound management principles (including operations, information, resource, fiscal, and personnel) and quality metrics to advance patient care and service delivery within and between various practice settings</li>'
            . '</ul>'
            . '<ins>Professional Communication</ins>'
            . '<ul>'
            . '<li>Analysis and practice of verbal, non-verbal, and written communication strategies that promote effective interpersonal dialog and understanding to advance specific patient care, education, advocacy, and/or interprofessional collaboration goals. Exploration of technology-based communication tools and their impact on healthcare delivery, healthcare information, and patient empowerment.</li>'
            . '</ul>'
            . '<ins>Professional Development/Social and Behavioral Aspects of Practice</ins>'
            . '<ul>'
            . '<li>Development of professional self-awareness, capabilities, responsibilities, and leadership. Analysis of contemporary practice roles and innovative opportunities, and inculcation of professional attitudes, behaviors, and dispositions.</li>'
            . '</ul>'
            . '<ins>Research Design</ins>'
            . '<ul>'
            . '<li>Evaluation of research methods and protocol design required to conduct valid and reliable studies to test hypotheses or answer research questions, and to appropriately evaluate the validity and reliability of the conclusions of published research studies.</li>'
            . '</ul>'
            . '<br/> <br/><strong>Clinical Sciences</strong> <br/>'
            . '<ins>Clinical Pharmacokinetics</ins>'
            . '<ul>'
            . '<li>Application of basic pharmacokinetic principles and mathematical models to calculate safe and effective doses of drugs for individual patients, and adjust therapy as appropriate through the monitoring of drug concentration in biological fluids.</li>'
            . '</ul>'
            . '<ins>Health Informatics</ins>'
            . '<ul>'
            . '<li>Effective and secure design and use of electronic and other technology-based systems, including electronic health records, to capture, store, retrieve, and analyze data for use in patient care, and confidentially/legally share health information in accordance with federal policies.</li>'
            . '</ul>'
            . '<ins>Health Information Retrieval and Evaluation</ins>'
            . '<ul>'
            . '<li>Critical analysis and application of relevant health sciences literature and other information resources to answer specific patient-care and/or drug-related questions and provide evidence-based therapeutic recommendations to healthcare providers or, when appropriate, the public.</li>'
            . '</ul>'
            . '<ins>Medication Dispensing, Distribution and Administration</ins>'
            . '<ul>'
            . '<li>Preparation, dispensing and administration of prescriptions, identification and prevention of medication errors and interactions, maintaining and using patient profile systems and prescription processing technology and/or equipment, and ensuring patient safety. Educating about appropriate medication use and administration.</li>'
            . '</ul>'
            . '<ins>Natural Products and Alternative and Complementary Therapies</ins>'
            . '<ul>'
            . '<li>Evidence-based evaluation of the therapeutic value, safety, and regulation of pharmacologically active natural products and dietary supplements. Cultural practices commonly selected by practitioners and/or patients for use in the promotion of health and wellness, and their potential impact on pharmacotherapy.</li>'
            . '</ul>'
            . '<ins>Patient Assessment</ins>'
            . '<ul>'
            . '<li>Evaluation of patient function and dysfunction through the performance of tests and assessments leading to objective (e.g., physical assessment, health screening, and lab data interpretation) and subjective (patient interview) data important to the provision of care.</li>'
            . '</ul>'
            . '<ins>Patient Safety</ins>'
            . '<ul>'
            . '<li>Analysis of the systems- and human-associated causes of medication errors, exploration of strategies designed to reduce/eliminate them, and evaluation of available and evolving error-reporting mechanisms.</li>'
            . '</ul>'
            . '<ins>Pharmacotherapy</ins>'
            . '<ul>'
            . '<li>Evidence-based clinical decision making, therapeutic treatment planning, and medication therapy management strategy development for patients with specific diseases and conditions that complicate care and/or put patients at high risk for adverse events. Emphasis on patient safety, clinical efficacy, pharmacogenomic and pharmacoeconomic considerations, and treatment of patients across the lifespan.</li>'
            . '</ul>'
            . '<ins>Public Health</ins>'
            . '<ul>'
            . '<li>Exploration of population health management strategies, national and community-based public health programs, and implementation of activities that advance public health and wellness, as well as provide an avenue through which students earn certificates in immunization delivery and other public health-focused skills.</li>'
            . '</ul>'
            . '<ins>Self-Care Pharmacotherapy</ins>'
            . '<ul>'
            . '<li>Therapeutic needs assessment, including the need for triage to other health professionals, drug product recommendation/selection, and counseling of patients on non-prescription drug products, non-pharmacologic treatments and health/wellness strategies.</li>'
            . '</ul>');

        $property->set_group('appendix_1');
        $this->set_property($property);
    }

    public function get_appendix_1()
    {
        return $this->get_property('appendix_1')->get_value();
    }

    public function set_appendix_1_attach($value)
    {
        $property = new \Orm_Property_Upload('appendix_1_attach', $value);
        $property->set_group('appendix_1');
        $this->set_property($property);
    }

    public function get_appendix_1_attach()
    {
        return $this->get_property('appendix_1_attach')->get_value();
    }

    public function set_appendix_2()
    {
        $property = new \Orm_Property_Fixedtext('appendix_2', '<strong>Appendix 2 Expectations within the APPE Curriculum</strong> <br/> <br/>'
            . '<strong>Builds on IPPE.</strong>  APPE follows IPPE, which is designed to progressively develop the professional insights and skills necessary to advance into responsibilities in APPE. Colleges and schools use a variety of IPPE delivery mechanisms to ensure students are ready to meet the expectations of APPE. IPPE involves interaction with practitioners and patients to advance patient welfare in authentic practice settings, and provides exposure to both medication distribution systems and high-quality, interprofessional, team-based patient care. <br/> <br/>'
            . '<strong>APPE curriculum.</strong>  APPE ensures that students have multiple opportunities to perform patient-centered care and other activities in a variety of settings. Experiences are in-depth, structured, and comprehensive in the aggregate, and carefully coordinated with other components of the PharmD curriculum. Collectively, APPE hones the practice skills, professional judgment, behaviors, attitudes and values, confidence, and sense of personal and professional responsibility required for each student to practice independently and collaboratively in an interprofessional, team-based care environment. <br/> <br/>'
            . '<strong>Learning outcomes.</strong>  General and experience-specific learning outcomes are established for all APPEs. Learning outcomes identify the competencies to be achieved, expected patient populations (if applicable), level of student responsibility, and the setting needed for the outcomes to be met. Learning outcomes for each experience are mapped to the professional practice competencies outlined in the Standards, as well as to any additional competencies developed by the school or college. <br/> <br/>'
            . '<strong>Assessment.</strong>  Colleges and schools assess student achievement of APPE competencies within their assessment plans using reliable, validated assessments. Formative feedback related to specific performance criteria is provided to students throughout the experience. At a minimum, performance competence is documented midway through the experience and at its completion. <br/> <br/>'
            . '<strong>Learning activities.</strong>  The APPE curriculum, in the aggregate, includes but is not limited to: (1) direct patient care, (2) interprofessional interaction and practice, (3) medication dispensing, distribution, administration, and systems management, and (4) professional development. Examples of possible activities within these broad areas are listed in the Guidance document. <br/> <br/>'
            . '<strong>Interprofessional interaction.</strong>  The need for interprofessional interaction is paramount to successful treatment of patients. Colleges and schools provide pharmacy students the opportunity to gain interprofessional skills using a variety of mechanisms including face-to-face interactions in clinical settings or in real-time telephonic or video-linked interactions. Regardless of the methods used, students demonstrate those interprofessional skills articulated in Standard 11 <br/> <br/>'
            . '<strong>Direct patient care focus.</strong>  The majority of student time in APPE is focused on the provision of direct patient care to both inpatients and outpatients. APPE is of sufficient length to permit continuity of care of individual patients and documentation of achievement of competencies associated with the APPE curriculum. <br/> <br/>'
            . '<strong>Practice settings.</strong>  Students demonstrate competence within four main practice types: community, ambulatory care, general medicine, and health system pharmacy. Colleges and schools draft competency statements for each type of setting along with appropriate assessment plans. <br/> <br/>'
            . '<strong>Ambulatory care.</strong>  Ambulatory care pharmacy practice is the provision of integrated, accessible health care services by pharmacists who are accountable for addressing medication needs, developing sustained partnerships with patients, and practicing in the context of family and community. The ambulatory care setting involves interprofessional communication and collaboration to provide acute and chronic patient care that can be accomplished outside the inpatient setting <br/> <br/>'
            . '<strong>Blended environments.</strong>  The literature documents that the demarcations between various types of pharmacy practice are blurring. A specific APPE may involve skill-development activities in more than one of the four required practice settings (i.e., the ‘blending’ of two or more of the four required practice types within one APPE). In addition, ‘longitudinal’ experiences may exist where students participate in more than one of the four required APPEs within the same institution (i.e., taking a general medicine APPE, an ambulatory care APPE, and a health system pharmacy APPE in the same hospital). The key is that a college or school documents how its APPE program is balanced between the four required practice areas and how all program outcomes, student performance competencies, and ACPE standards are met. <br/> <br/>'
            . '<strong>Elective APPE.</strong>  Elective rotations allow students to explore areas of professional interest and/or expand their understanding of professional opportunities. Elective APPE may include a maximum of two experiences without a patient care focus.');
        $property->set_group('appendix_2');
        $this->set_property($property);
    }

    public function get_appendix_2()
    {
        return $this->get_property('appendix_2')->get_value();
    }

    public function set_appendix_2_attach($value)
    {
        $property = new \Orm_Property_Upload('appendix_2_attach', $value);
        $property->set_group('appendix_2');
        $this->set_property($property);
    }

    public function get_appendix_2_attach()
    {
        return $this->get_property('appendix_2_attach')->get_value();
    }

    public function set_appendix_3()
    {
        $property = new \Orm_Property_Fixedtext('appendix_3', '<strong>Appendix 3 Required Documentation for Standards and Key Elements 2016</strong>'
            . ' <br/> <br/>To provide evidence of achievement of the standards and key elements, colleges and schools provide, at a minimum, the following outcomes data and documentation. Many of these documents are embedded within the Assessment and Accreditation Management System (AAMS) system (co-developed and managed by the American Association of Colleges of Pharmacy and ACPE), while others are created by individual colleges and schools to be shared with ACPE at appropriate times during the quality improvement process (e.g., within self-study submissions or during site visits). As noted below, an individual document may be used for multiple standards. Colleges and schools are encouraged to develop additional documentation processes to meet their mission-specific quality assurance needs.'
            . ' <br/> <br/><strong>Standard 1 – Foundational Knowledge</strong>'
            . '<ul><li>Student academic performance throughout the program (e.g., progression rates, academic probation rates, attrition rates)</li>'
            . '<li>Annual performance of students nearing completion of the didactic curriculum on the Pharmacy Curriculum Outcomes Assessment (PCOA) - an assessment of knowledge of the essential content areas identified in Appendix 1</li>'
            . '<li>Performance of graduates (passing rate) on NAPLEX</li>'
            . '<li>Performance of graduates in the various NAPLEX competency areas</li>'
            . '<li>Performance of graduates on Multistate Pharmacy Jurisprudence Examination (MPJE) and/or other state required law examination</li></ul>'
            . '<strong>Standard 2 – Essentials for Practice and Care</strong><ul><li>Outcome data from assessments summarizing overall student achievement of relevant didactic, IPPE, and APPE learning objectives</li></ul>'
            . '<strong>Standard 3 – Approach to Practice and Care</strong>'
            . '<ul><li>Examples of student participation in Interprofessional Education activities (didactic, simulation, experiential)</li>'
            . '<li>Outcome data from assessments summarizing overall student achievement of relevant didactic, IPPE, and APPE learning objectives</li>'
            . '<li>Outcome data from assessments summarizing overall student participation in Interprofessional Education activities</li>'
            . '<li>Examples of curricular and co-curricular experiences made available to students to document developing competence in affective domain-related expectations of Standard 3</li>'
            . '<li>Outcome data from assessments of student achievement of problem-solving and critical thinking capabilities</li>'
            . '<li>Outcome data from assessments of students’ ability to communicate professionally, advocate for patients, and educate others</li>'
            . '<li>Outcome data from assessments of students’ demonstration of cultural awareness and sensitivity.</li></ul>'
            . '<strong>Standard 4 – Personal and Professional Development</strong>'
            . '<ul><li>Outcome data from assessments summarizing students’ overall achievement of relevant didactic, IPPE, and APPE learning objectives</li>'
            . '<li>Examples of curricular and co-curricular experiences made available to students to document developing competence in affective domain-related expectations of Standard 4</li>'
            . '<li>Outcome data from assessments summarizing students’ overall achievement of professionalism, leadership, self-awareness, and creative thinking expectations</li>'
            . '<li>Description of tools utilized to capture students’ reflections on personal/professional growth and development</li>'
            . '<li>Description of processes by which students are guided to develop a commitment to continuous professional development and to self-directed lifelong learning</li></ul>'
            . '<strong>Standard 5 – Eligibility and Reporting Requirements</strong>'
            . '<ul><li>Legal authority to offer/award the Doctor of Pharmacy degree</li>'
            . '<li>Documents verifying institutional accreditation</li>'
            . '<li>Accreditation reports identifying deficiencies (if applicable)</li>'
            . '<li>University organizational chart</li>'
            . '<li>Description of level of autonomy of the college or school</li></ul>'
            . '<strong>Standard 6 – College or School Vision, Mission, and Goals</strong>'
            . '<ul><li>Vision, mission, and goal statements (college, school, parent institution, department/division)</li>'
            . '<li>Outcome data from assessments summarizing the extent to which the college or school is achieving its vision, mission, and goals</li></ul>'
            . '<strong>Standard 7 – Strategic Plan</strong>'
            . '<ul><li>Strategic planning documents, including a description of the process through which the strategic plan was developed.</li>'
            . '<li>Outcome data from assessments summarizing the implementation of the strategic plan</li></ul>'
            . '<strong>Standard 8 - Organization and Governance</strong>'
            . '<ul><li>Curriculum vitae of the dean and others on the administrative leadership team</li>'
            . '<li>Organization chart of the college or school</li>'
            . '<li>Responsibilities of dean and other administrative leadership team members</li>'
            . '<li>Faculty governance documents (by-laws, policies, procedures, etc.)</li>'
            . '<li>List of committees and designated charges</li>'
            . '<li>Evidence of faculty participation in university governance</li>'
            . '<li>Policies and procedures related to system failures, data security and backup, and contingency planning</li>'
            . '<li>Outcome data from assessments (e.g., AACP faculty, preceptor, graduating student and alumni surveys) summarizing the effectiveness of the organizational structure and governance</li></ul>'
            . '<strong>Standard 9 – Organizational Culture</strong>'
            . '<ul><li>Policies describing expectations of faculty, administrators, students, and staff behaviors</li>'
            . '<li>Examples of intra/interprofessional and intra/interdisciplinary collaboration</li>'
            . '<li>Affiliation agreements for purposes of research, teaching, or service (if applicable)</li>'
            . '<li>Outcome data from AACP faculty and graduating student surveys related to collaboration, morale, professionalism, etc.</li></ul>'
            . '<strong>Standard 10 - Curriculum Design, Delivery, and Oversight</strong>'
            . '<ul><li>Description of curricular and degree requirements, including elective didactic and experiential expectations</li>'
            . '<li>All required and elective didactic and experiential course syllabi</li>'
            . '<li>Mapping of required curricular content and experiential education expectations to individual courses</li>'
            . '<li>Curriculum vitae of faculty teaching within the curriculum</li>'
            . '<li>A tabular display of courses, faculty members assigned to each course and their role, and credentials supporting the teaching assignments</li>'
            . '<li>List of Curriculum Committee (or equivalent) members with position/affiliation within college/school</li>'
            . '<li>List of charges, assignments, and accomplishments of Curriculum Committee over the last 1–3 years</li>'
            . '<li>Examples of tools (e.g., portfolios) used by students to document self-assessment of, and reflection on, learning needs, plans and achievements, and professional growth and development</li>'
            . '<li>Sample documents used by faculty, preceptors, and students to evaluate learning experiences and provide formative and/or summative feedback</li>'
            . '<li>Policies related to academic integrity</li>'
            . '<li>Policies related to experiential learning that ensures compliance with Key Element 10.15</li>'
            . '<li>Examples of instructional methods used by faculty and the extent of their employment to:'
            . '<ul><li>Actively engage learners</li>'
            . '<li>Integrate and reinforce content across the curriculum</li>'
            . '<li>Provide opportunity for mastery of skills</li>'
            . '<li>Instruct within the experiential learning program</li>'
            . '<li>Stimulate higher-order thinking, problem-solving, and clinical-reasoning skills</li>'
            . '<li>Foster self-directed lifelong learning skills and attitudes</li>'
            . '<li>Address/accommodate diverse learning styles</li>'
            . '<li>Incorporate meaningful interprofessional learning opportunities</li></ul></li></ul>'
            . '<strong>Standard 11 - Interprofessional Education (IPE)</strong>'
            . '<ul><li>Vision, mission, and goal statements related to IPE</li>'
            . '<li>Statements addressing IPE and practice contained within student handbooks and/or catalogs</li>'
            . '<li>Relevant syllabi for required and elective didactic and experiential education courses that incorporate elements of IPE to document that concepts are reinforced throughout the curriculum and that IPE-related skills are practiced at appropriate times during pre-APPE</li>'
            . '<li>Student IPPE and APPE evaluation data documenting extent of exposure to interprofessional, team-based patient care</li>'
            . '<li>Outcome data from assessments summarizing students’ overall achievement of expected interprofessional educational outcomes in the pre-APPE and APPE curriculum</li></ul>'
            . '<strong>Standard 12 - Pre-APPE Curriculum</strong>'
            . '<ul><li>Description of curricular and degree requirements, including elective didactic and experiential expectations</li>'
            . '<li>A tabular display of courses, faculty members assigned to each course and their role, and credentials supporting the teaching assignments</li>'
            . '<li>Curriculum maps documenting breadth and depth of coverage of Appendix 1 content and learning expectations in the professional (and, if appropriate, preprofessional) curriculum</li>'
            . '<li>Examples of curricular and co-curricular experiences made available to students to document developing competence in affective domain-related expectations of Standards 3 and 4</li>'
            . '<li>Outcome data from assessments of student preparedness to progress to APPE (e.g., comprehensive assessments of knowledge, skills, and competencies)</li>'
            . '<li>Description of the IPPE learning program and its goals, objectives, and time requirements</li>'
            . '<li>List of simulation activities and hours counted within the IPPE 300 hour requirement</li>'
            . '<li>IPPE course syllabi including general and rotation-specific learning objectives and extent of IPE exposure</li>'
            . '<li>IPPE student and preceptor manuals</li>'
            . '<li>IPPE student and preceptor assessment tools</li>'
            . '<li>IPPE preceptor recruitment and training manuals and/or programs</li>'
            . '<li>List of active preceptors with credentials and practice site</li>'
            . '<li>Outcome data from assessments summarizing overall student achievement of Pre-APPE educational outcomes</li></ul>'
            . '<strong>Standard 13 – APPE Curriculum</strong>'
            . '<ul><li>Overview of APPE curriculum (duration, types of required and elective rotations, etc.)</li>'
            . '<li>APPE course syllabi including general and experience-specific learning objectives</li>'
            . '<li>APPE student and preceptor manuals</li>'
            . '<li>APPE student and preceptor assessment tools</li>'
            . '<li>Preceptor recruitment and training manuals and/or programs</li>'
            . '<li>List of active preceptors with credentials and practice site</li>'
            . '<li>Student APPE evaluation data documenting extent of exposure to diverse patient populations and interprofessional, team-based patient care</li>'
            . '<li>Outcome data from assessments summarizing students’ overall achievement of APPE educational outcomes</li></ul>'
            . '<strong>Standard 14 - Student Services</strong>'
            . '<ul><li>Organizational chart depicting Student Services unit and responsible administrators</li>'
            . '<li>Synopsis of curriculum vitae of Students Services administrative officer(s) and staff</li>'
            . '<li>Student Handbook and/or Catalog (college, school or university), and copies of additional information distributed to students regarding student service elements (financial aid, health insurance, etc.)</li>'
            . '<li>Copies of policies that ensure nondiscrimination and access to allowed disability accommodations</li>'
            . '<li>Results from AACP graduating student survey</li>'
            . '<li>Student feedback on the college/school’s self-study</li></ul>'
            . '<strong>Standard 15 - Academic Environment</strong>'
            . '<ul><li>Student Handbook and/or Catalog (college, school, or university), and copies of additional information distributed to students regarding the academic environment</li>'
            . '<li>URL or link to program information on college or school’s website</li>'
            . '<li>Copy of student complaint policy related to college or school adherence to ACPE standards</li>'
            . '<li>Number and nature of student complaints related to college or school adherence to ACPE standards (inspection of the file by evaluation teams during site visits)</li>'
            . '<li>List of committees involving students with names and professional years of current student members</li>'
            . '<li>College or school’s code of conduct (or equivalent) addressing professional behavior</li></ul>'
            . '<strong>Standard 16 – Admissions</strong>'
            . '<ul><li>Organizational chart depicting Admissions unit and responsible administrator(s)</li>'
            . '<li>Enrollment data for the past five years by year; and by branch campus or pathway (if applicable)</li>'
            . '<li>Enrollment projections for the next five years</li>'
            . '<li>Pharmacy College Aptitude Test (PCAT) scores (mean, maximum, and minimum), if required, for the past three admitted classes</li>'
            . '<li>GPA scores (mean, maximum, and minimum) for preprofessional coursework for the past three admitted classes</li>'
            . '<li>GPA scores (mean, maximum, and minimum) for preprofessional science courses for the past three admitted classes</li>'
            . '<li>Comparisons of PCAT scores and preprofessional GPAs with peer schools for last admitted three admitted classes</li>'
            . '<li>List of admission committee members with name and affiliation</li>'
            . '<li>Policies and procedures regarding the admissions process including selection of admitted students, transfer of credit, and course waiver policies</li>'
            . '<li>Professional and technical standards for school, college, and/or university (if applicable)</li>'
            . '<li>List of preprofessional requirements for admission into the professional program</li>'
            . '<li>Copies of instruments used during the admissions process including interview evaluation forms and assessment of written and oral communication</li>'
            . '<li>Section of Student Handbook and/or Catalog (college, school, or university) regarding admissions</li>'
            . '<li>Link to websites (or documentation of other mechanisms) that provide to the public information on required indicators of quality</li></ul>'
            . '<strong>Standard 17 – Progression</strong>'
            . '<ul><li>Policies and procedures regarding student progression, early intervention, academic probation, remediation, missed course work or credit, leaves of absence, dismissal, readmission, due process, and appeals</li>'
            . '<li>Section of Student Handbook and/or Catalog (college, school, or university) regarding student progression</li>'
            . '<li>Student progression and academic dismissal data for the last three admitted classes</li>'
            . '<li>Correlation analysis of admission variables and academic performance</li></ul>'
            . '<strong>Standard 18 – Faculty and Staff – Quantitative Factors</strong>'
            . '<ul><li>Organizational chart depicting all full-time faculty by department/division</li>'
            . '<li>List of full-time staff in each department/division and areas of responsibility</li>'
            . '<li>ACPE documents (e.g., resource report) related to number of full-time and part-time faculty</li>'
            . '<li>List of faculty turnover for the past five years by department/division with reasons for departure</li>'
            . '<li>Description of coursework mapped to full-time and part-time faculty teaching in each course</li>'
            . '<li>Results from AACP faculty survey regarding adequacy of quantitative strength of faculty and staff</li></ul>'
            . '<strong>Standard 19 – Faculty and Staff – Qualitative Factors</strong>'
            . '<ul><li>Curriculum vitae of faculty and professional staff</li>'
            . '<li>List of active research areas of faculty and an aggregate summary of faculty publications/presentations over the past three years.</li>'
            . '<li>Procedures employed to promote a conceptual understanding of contemporary practice, particularly among non-pharmacist faculty</li>'
            . '<li>Policies and procedures related to faculty recruitment, performance review, promotion, tenure (if applicable), and retention</li>'
            . '<li>Faculty Handbook</li>'
            . '<li>Data from AACP faculty survey regarding qualitative faculty factors</li></ul>'
            . '<strong>Standard 20 - Preceptors</strong>'
            . '<ul><li>List of active preceptors with credentials and practice site</li>'
            . '<li>Number, percentage of required APPE precepted by non-pharmacists categorized by type of experience.</li>'
            . '<li>Description of practice sites (location, type of practice, student/preceptor ratios)</li>'
            . '<li>Policies and procedures related to preceptor recruitment, orientation, development, performance review, promotion, and retention</li>'
            . '<li>Examples of instruments used by preceptors to assess student performance</li>'
            . '<li>Curriculum vitae of administrator(s) responsible for overseeing the experiential education component of the curriculum</li>'
            . '<li>Description of the structure, organization and administrative support of the Experiential Education office (or equivalent)</li>'
            . '<li>Results from AACP preceptor surveys</li></ul>'
            . '<strong>Standard 21 – Physical Facilities and Educational Resources</strong>'
            . '<ul><li>Floor plans for college or school’s facilities and descriptions of the use(s) of available space</li>'
            . '<li>Description of shared space and how such space promotes interprofessional interaction</li>'
            . '<li>Analysis of the quantity and quality of space available to the program and plans to address identified inadequacies.</li>'
            . '<li>Documentation of Association for Assessment and Accreditation of Laboratory Animal Care (AAALAC) or other nationally recognized accreditation of animal care facilities, if applicable</li>'
            . '<li>Results from AACP faculty, alumni, and graduating student surveys related to facilities</li>'
            . '<li>Description of educational resources available to faculty, preceptors, and students (library, internet access, etc.)</li></ul>'
            . '<strong>Standard 22 – Practice Facilities</strong>'
            . '<ul><li>Description of practice sites (location, type of practice, student:preceptor ratios) and involvement in IPPE, APPE, or both</li>'
            . '<li>Policies and procedures related to site selection, recruitment, and assessment</li>'
            . '<li>Examples of quality improvements made to improve student learning outcomes as a result of site/facility assessment</li>'
            . '<li>Examples of affiliation agreements between college/school and practice sites (all agreements will be reviewed during site visits)</li>'
            . '<li>ACPE IPPE and APPE Capacity Charts</li></ul>'
            . '<strong>Standard 23 – Financial Resources</strong>'
            . '<ul><li>Detailed budget plan as defined by AACP (previous, current, and subsequent years)</li>'
            . '<li>Description of college or school’s budgetary processes</li>'
            . '<li>In-state and out-of-state tuition compared to peer schools</li>'
            . '<li>Results from AACP faculty survey regarding adequacy of financial resources</li></ul>'
            . '<strong>Standard 24 – Assessment Elements for Section I</strong>'
            . '<ul><li>College or school’s curriculum assessment plan(s)</li>'
            . '<li>Description of formative and summative assessments of student learning and professional development used by college or school</li>'
            . '<li>Description of standardized and comparative assessments of student learning and professional development used by college or school</li>'
            . '<li>Description of how the college or school uses information generated within the curriculum assessment plan(s) to advance quality within its Doctor of Pharmacy program</li></ul>'
            . '<strong>Standard 25 – Assessment Elements for Section II</strong>'
            . '<ul><li>College or school’s program assessment plan(s)</li>'
            . '<li>Description of how the college or school uses information generated by assessments related to its organizational effectiveness, mission and goals, didactic curriculum, experiential learning program, co-curriculum activities, and interprofessional education to advance overall programmatic quality</li></ul>');
        $property->set_group('appendix_3');
        $this->set_property($property);
    }

    public function get_appendix_3()
    {
        return $this->get_property('appendix_3')->get_value();
    }

    public function set_appendix_3_attach($value)
    {
        $property = new \Orm_Property_Upload('appendix_3_attach', $value);
        $property->set_group('appendix_3');
        $this->set_property($property);
    }

    public function get_appendix_3_attach()
    {
        return $this->get_property('appendix_3_attach')->get_value();
    }

}
