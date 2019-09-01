<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'models/integration/integration_interface.php');

ini_set('max_execution_time', 0);
ini_set('memory_limit', '-1');
set_time_limit(0);


/**
 * @property CI_DB_query_builder $db
 * Class Kku
 *
 * @property Integration_model integration
 */

class Kku extends MX_Controller implements integration_interface
{

//    private $_soapSIS = "http://10.201.61.205:7003/KKU_AcademicSystemWS/KKU_AcademicSystemWS?WSDL";
//    private $_soapHR = "http://10.201.61.205:7003/KKU_HrWS/KKU_HrWS?WSDL";

    private $_soapSIS = "https://app-isv.kku.edu.sa:7503/KKU_AcademicSystemWS/KKU_AcademicSystemWS?WSDL";
    private $_soapHR = "https://app-isv.kku.edu.sa:7503/KKU_HrWS/KKU_HrWS?WSDL";

    public $retry = 0;


    public function __construct()
    {
        parent::__construct();

        if (!is_cli()) {
            exit('No direct script access allowed');
        }

        set_time_limit(0);
        ini_set("soap.wsdl_cache_enabled", 0);


        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $this->load->model('integration/integration_model', 'integration');

    }

    public function index()
    {

        $this->load->helper('hejri');


        $this->semesters();
        error_log('Semesters Done');

        $this->support_unit();
        error_log('Units Done');

        $this->campuses();
        error_log('Campuses Done');

        $this->colleges();
        error_log('Colleges Done');

        $this->departments();
        error_log('Departments Done');

        $this->degrees();
        error_log('Degrees Done');

        $this->programs();
        error_log('Programs Done');

        $this->courses();
        error_log('Courses Done');

        $this->student_statuses();
        error_log('Students Status Done');


        $this->faculty_members();
        error_log('Faculty Done');

        $this->staff_members();
        error_log('Staff Done');

        $this->student_members();
        error_log('Students Done');

        $this->inactive_student_members();
        error_log('Inactive Students Done');

//        $this->alumni_members();

        $semester_id = Orm_Semester::get_current_semester()->get_integration_id();

        $this->course_sections($semester_id);
        error_log('Course Sections Done');

        $this->course_students($semester_id);
        error_log('Course Students Done');

        $this->force_add_student_members();
        error_log('Students Forced Done');


    }

    public function semesters()
    {
        $result = $this->getSOUP('Semesters');

        $semesters = $this->check_data($result, 'semesterList');

        foreach($semesters as $semester) {

            $semester = array_merge([
                'semester'      => '',
                'semesterEnd'   => '',
                'semesterName'  => '',
                'semesterNameE' => '',
                'semesterStart' => '',
                'semesterYear'  => ''
            ], (array) $semester);

            $this->integration->semester(
                $semester['semester'],
                date('Y-m-d h:i:s',strtotime($semester['semesterStart']?:'1970-1-1')),
                date('Y-m-d h:i:s',strtotime($semester['semesterEnd']?:'1970-1-1')),
                date('Y-m-d h:i:s',strtotime($semester['semesterYear']?:0)),
                $semester['semesterNameE']?: $semester['semesterName'],
                $semester['semesterName']?: $semester['semesterNameE']
            );
        }
    }

    public function support_unit()
    {
        $result = $this->getSOUP('destination', ['destType'=>0], 'HR');

        $units = $this->check_data($result, 'destinationData');

        foreach($units as $row) {

            $row = array_merge([
                'categoryDesc'    => '',
                'categoryId'      => '',
                'destinationCode' => '',
                'destinationDesc' => ''
            ], (array) $row);

            if (isset($row['categoryId']) && $row['categoryId'] != 1) {
                $this->integration->support_unit(
                    $row['destinationCode'],
                    $row['destinationDesc'] ? : '',
                    $row['destinationDesc'] ? : '',
                    $this->get_unit_class_type($row['categoryId'])
                );
            }
        }

        $this->db->query("update unit set class_type = 'Orm_Unit_Rector' where integration_id = 4;");
        $this->db->query("update unit set is_academic = '1' where integration_id = 129;");
        $rectorate_unit  = Orm_Unit::get_one(['integration_id' => 4]);
        if ($rectorate_unit->get_id()) {
            $this->db->query("update unit set parent_id= {$rectorate_unit->get_id()} where integration_id != 4;");
        }
    }

    private function get_unit_class_type($category) {
        switch ($category) {
            case 1:
                return Orm_Unit_Admin::class;
            case 5:
                return Orm_Unit_Vice_Rector::class;
            default:
                return Orm_Unit_Admin::class;
        }
    }

    public function campuses()
    {
        $result = $this->getSOUP('Campuses');

        $campuses = $this->check_data($result, 'campusesList');

        foreach($campuses as $row) {

            $row = array_merge([
                'campusName'      => '',
                'campusNameE'   => '',
                'campusNo'  => '',
            ], (array) $row);

            $this->integration->campus(
                $row['campusNo'],
                $row['campusName']?: $row['campusNameE'],
                $row['campusNameE']?: $row['campusName']
            );

        }
    }

    public function colleges()
    {
        $result = $this->getSOUP('Colleges');

        $colleges = $this->check_data($result, 'collegesList');

        foreach($colleges as $row) {

            $row = array_merge([
                'campusNo'      => '',
                'collegeId'     => '',
                'collegeName'   => '',
                'collegeNameE'  => '',
            ], (array) $row);

            $this->integration->college(
                $row['collegeId'],
                $row['campusNo'],
                $row['collegeName']?: $row['collegeNameE'],
                $row['collegeNameE']?: $row['collegeName']
            );

        }
    }

    public function departments()
    {
        $colleges = Orm_College::get_all();

        $i = 0;

        foreach ($colleges as $college) {
            $result = $this->getSOUP('Departments', ['college' => $college->get_integration_id()]);

            $departments = $this->check_data($result, 'departmentsList');

            foreach ($departments as $row) {

                $i++;

                $row = array_merge([
                    'departmentId' => '',
                    'departmentName' => '',
                    'departmentNameE' => '',
                ], (array)$row);


                $this->integration->department(
                    $college->get_integration_id().'-'.$row['departmentId'],
                    $college->get_integration_id(),
                    $row['departmentName'] ?: $row['departmentNameE'],
                    $row['departmentNameE'] ?: $row['departmentName']
                );
            }
        }

    }

    public function degrees()
    {
        $result = $this->getSOUP('StudentDegree');

        $colleges = $this->check_data($result, 'studentDegreeList');

        foreach ($colleges as $row) {

            $row = array_merge([
                'degreeId' => '',
                'degreeDesc' => '',
                'degreeDescE' => '',
            ], (array)$row);

            $this->integration->degree(
                $row['degreeId'],
                $row['degreeDesc'] ? : $row['degreeDescE'],
                $row['degreeDescE'] ? : $row['degreeDesc']
            );
        }
    }

    public function programs()
    {
        $departments = Orm_Department::get_all();

        foreach ($departments as $department) {

            $department_integration_id = explode('-', $department->get_integration_id());

            $department_integration_id = isset($department_integration_id[1])? $department_integration_id[1]: 0;

            $result = $this->getSOUP('Majors', ['college'=> $department->get_college_obj()->get_integration_id(), 'department'=> $department_integration_id]);

            $programs = $this->check_data($result, 'majorsList');


            foreach ($programs as $row) {

                $row = array_merge([
                    'majorId'    => '',
                    'majorLevel' => '',
                    'majorName'  => '',
                    'majorNameE' => '',
                ], (array)$row);

                $this->integration->program(
                    $row['majorId'],
                    $department->get_integration_id(),
                    $row['degreeCode'],
                    $row['majorName'] ? : $row['majorNameE'],
                    $row['majorNameE'] ? : $row['majorName']
                );
            }
        }
    }

    public function courses()
    {

        $programs = Orm_Program::get_all();

        foreach($programs as $program) {

            $department_integration_id = $program->get_department_obj()->get_integration_id();
            $department_integration_id = explode('-', $department_integration_id);
            $department_integration_id = isset($department_integration_id[1])? $department_integration_id[1]: 0;

            $result = $this->getSOUP('courses', [
                'faculty'    => $program->get_department_obj()->get_college_obj()->get_integration_id(),
                'department' => $department_integration_id,
                'major'      => $program->get_integration_id(),
                'edition'    => 1
            ]);

            $courses = $this->check_data($result, 'coursesList');

            foreach($courses as $row) {

                $row = array_merge([
                    'courseCategory'      => '',
                    'courseCategoryDescA' => '',
                    'courseCode'          => '',
                    'courseCodeE'         => '',
                    'courseDesc'          => '',
                    'courseDescE'         => '',
                    'courseLevelNo'       => '',
                    'courseNo'            => '',
                    'courseTerm'          => '',
                    'courseYear'          => '',
                    'crdHrs'              => '',
                    'isTraining'          => ''
                ], (array)$row);

                $this->integration->course(
                    $row['courseNo'],
                    $program->get_department_obj()->get_integration_id(),

                    $row['courseDesc'] ?: $row['courseDescE'],
                    $row['courseDescE'] ?: $row['courseDesc'],

                    $row['courseCode'] ?: $row['courseCodeE'],
                    $row['courseCodeE'] ?: $row['courseCode'],
                    $row['isTraining']
                );

                $this->integration->program_plan(
                    $program->get_integration_id(),
                    $row['courseNo'],
                    $row['courseYear'].$row['courseTerm'],
                    $row['crdHrs'],
                    $row['courseCategory']
                );
            }
        }
    }

    public function programPlan(){}

    public function faculty_members()
    {
        foreach(range(1,2) as $empSex) {


            $result = $this->getSOUP('EmployeesInfo', [
                'infoName' => 'eaa',
                'empSex'   => $empSex
            ],'HR');

            $result = $this->check_data($result, 'employeeData');

            foreach($result as $row) {

                $row = array_merge([
                    'academicDest'       => '',
                    'classA'             => '',
                    'classE'             => '',
                    'dob'                => '19700101',
                    'eduMajorDetDesc'    => '',
                    'educationPlace'     => '',
                    'educationPlaceDesc' => '',
                    'email'              => '',
                    'empEduMajor'        => '',
                    'empEducation'       => '',
                    'empEducationDesc'   => '',
                    'empFmname'          => '',
                    'empFmnameE'         => '',
                    'empFname'           => '',
                    'empFnameE'          => '',
                    'empInstructor'      => '',
                    'empMajorDesc'       => '',
                    'empNo'              => '',
                    'empSex'             => '',
                    'empStOldDest'       => '',
                    'empStatus'          => '',
                    'isAcademic'         => '',
                    'middleName'         => '',
                    'middleNameE'        => '',
                    'nationA'            => '',
                    'nationE'            => '',
                    'nationId'           => '',
                    'statusId'           => '',
                    'nickname'           => '',
                    'sisInstructor'      => ''
                ], (array)$row);



                $row['dob'] = trim($row['dob']);
                $row['dob'] = substr($row['dob'], 0, 4) . '-' . substr($row['dob'], 4, 2) . '-' . substr($row['dob'], 6, 2);

                if (intval(date('Y', strtotime($row['dob']))) < 1900) {
                    $row['dob'] = HijriToGregorian($row['dob'], 'YYYY-MM-DD');
                }


                if($row['empInstructor']==1) {
                    if(!isset($row['academicDept'])){
                        $row['academicDept']='';
                    }

                    $this->integration->faculty(
                    /* integration_id */    trim($row['sisInstructor']).'_'. trim($row['empNo']),
                        /* email */             filter_var(trim($row['email']), FILTER_VALIDATE_EMAIL)? trim($row['email']): $row['empNo'] . '@kku.edu.sa',
                        /* login_id */          $row['nickname'] ?: '',
                        /* first_name */        ($row['empFname']?: $row['empFnameE']),
                        /* last_name */         trim(trim($row['middleName']?:$row['middleNameE']).' '.trim($row['empFmname']?: $row['empFmnameE'])),
                        /* is_active */         $row['statusId'] == 100,
                        /* dob */               $row['dob'],
                        /* nationality */       trim($row['nationA']),
                        /* college_id */        $row['academicDest'],
                        /* department_id */     $row['academicDest'].'-'.$row['academicDept'],
                        /* program_id */        0,
                        /* male_gender */       $empSex==1,
                        /* phone */             '',
                        /* fax_no */            '',
                        /* office_no */         '',
                        /* address */           '',
                        /* job_position */      Orm_User_Faculty::JOB_POSITION_LECTURER,
                        /* academic_rank */     $this->get_academic_rank(trim($row['classE'])),
                        /* service_time */      0,
                        /* general_specialty */ trim($row['empMajorDesc']),
                        /* specific_specialty */trim($row['eduMajorDetDesc']),
                        /* graduate_from */     trim($row['educationPlaceDesc'])
                    );
                }
                else {
                    if(!isset($row['academicDept'])){
                        $row['academicDept']='';
                    }

                    $this->integration->staff(
                    /* integration_id */    trim($row['empNo']),
                        /* email */             filter_var(trim($row['email']), FILTER_VALIDATE_EMAIL)? trim($row['email']): $row['empNo'] . '@kku.edu.sa',
                        /* login_id */          $row['nickname'] ?: '',
                        /* first_name */        ($row['empFname']?: $row['empFnameE']),
                        /* last_name */         trim(trim($row['middleName']?:$row['middleNameE']).' '.trim($row['empFmname']?: $row['empFmnameE'])),
                        /* is_active */         $row['statusId'] == 100,
                        /* dob */               $row['dob'],
                        /* nationality */       trim($row['nationA']),
                        /* college_id */        $row['academicDest'],
                        /* department_id */     $row['academicDest'].'-'.$row['academicDept'],
                        /* program_id */        0,
                        /* unit_id */           $row['empStOldDest'],
                        /* male_gender */       $empSex==1,
                        /* phone */             '',
                        /* fax_no */            '',
                        /* office_no */         '',
                        /* address */           '',
                        /* job_position */      -1,
                        /* service_time */      0
                    );
                }
            }
        }
    }

    public function staff_members() {}

    public function student_statuses(){
        $statuses = $this->getSOUP('StudentStatus');
        $statuses = $this->check_data($statuses, 'studentStatusList');


        foreach($statuses as $row) {

            $row = array_merge([
                'statusDesc' => '',
                'statusDescE' => '',
            ], (array)$row);


            $this->integration->status(
                $row['statusId'],
                $row['statusDesc']?: $row['statusDescE'],
                $row['statusDescE']?: $row['statusDesc']
            );
        }


    }

    public function student_members()
    {
        $this->load->helper('email');

        $nationalities = $this->getSOUP('Nationalities');
        $nationalities = $this->check_data($nationalities, 'nationalitiesList');
        $nationalities = json_decode(json_encode($nationalities), true);
        $nationalities = array_column($nationalities, 'nationalityDesc', 'nationalityId');

        $programs = Orm_Program::get_all();

        foreach($programs as $program) {

            $result = $this->getSOUP('Students', [
                'infoName'   => 'eaa',
                'statusCode' => 1,
                'facultyNo'  => $program->get_department_obj()->get_college_obj()->get_integration_id(),
                'majorNo'    => $program->get_integration_id()
            ]);

            $result = $this->check_data($result, 'studentsList');


            foreach ($result as $row) {

                $row = array_merge([
                    'birthdate' => '1970-01-01',
                    'degreeCode' => '2',
                    'deptCode' => '',
                    'email' => '',
                    'facultyNo' => '',
                    'fname' => '',
                    'fnameE' => '',
                    'gender' => '1',
                    'joinSemester' => '1',
                    'majorNo' => '0',
                    'mnames' => '',
                    'mnamesE' => '',
                    'nationalityCode' => '1',
                    'statusCode' => '',
                    'studentId' => '',
                    'surname' => '',
                    'surnameE' => ''
                ], (array)$row);


                $this->integration->student(
                /* $integration_id */ $row['studentId'],
                    /* $email          */ filter_var(trim($row['email']), FILTER_VALIDATE_EMAIL)? trim($row['email']): trim($row['studentId']) . '@kku.edu.sa',
                    /* $login_id       */ $row['studentId'],
                    /* $first_name     */ trim($row['fname']),
                    /* $last_name      */ trim(trim($row['mnames']) . ' ' . trim($row['surname'])),
                    /* $is_active      */ true,
                    /* $dob            */ date('Y-m-d', strtotime(trim($row['birthdate']))),
                    /* $nationality    */ isset($nationalities[$row['nationalityCode']])? $nationalities[$row['nationalityCode']]:  '',
                    /* $college_id     */ trim($row['facultyNo']),
                    /* $department_id  */ trim($row['facultyNo']).'-'.trim($row['deptCode']),
                    /* $program_id     */ trim($row['majorNo']),
                    /* $status_id      */ 1,
                    /* $male_gender    */ $row['gender']==1,
                    /* $phone          */ '',
                    /* $fax_no         */ '',
                    /* $office_no      */ '',
                    /* $address        */ ''
                );
            }
        }
    }

    public function alumni_members()
    {

        $nationalities = $this->getSOUP('Nationalities');
        $nationalities = $this->check_data($nationalities, 'nationalitiesList');
        $nationalities = json_decode(json_encode($nationalities), true);
        $nationalities = array_column($nationalities, 'nationalityDesc', 'nationalityId');

        $programs = Orm_Program::get_all();

        foreach($programs as $program) {

            $result = $this->getSOUP('Students', [
                'infoName'   => 'eaa',
                'statusCode' => 7,
                'facultyNo'  => $program->get_department_obj()->get_college_obj()->get_integration_id(),
                'majorNo'    => $program->get_integration_id()
            ]);

            $result = $this->check_data($result, 'studentsList');

            foreach ($result as $row) {

                $row = array_merge([
                    'birthdate' => '1970-01-01',
                    'degreeCode' => '2',
                    'deptCode' => '',
                    'email' => '',
                    'facultyNo' => '',
                    'fname' => '',
                    'fnameE' => '',
                    'gender' => '1',
                    'joinSemester' => '1',
                    'majorNo' => '0',
                    'mnames' => '',
                    'mnamesE' => '',
                    'nationalityCode' => '1',
                    'statusCode' => '',
                    'studentId' => '',
                    'surname' => '',
                    'surnameE' => ''
                ], (array)$row);


                $this->integration->alumni(
                /* $integration_id */ $row['studentId'],
                    /* $email          */ filter_var(trim($row['email']), FILTER_VALIDATE_EMAIL)? trim($row['email']): trim($row['studentId']) . '@kku.edu.sa',
                    /* $login_id       */ $row['studentId'],
                    /* $first_name     */ trim($row['fname']),
                    /* $last_name      */ trim(trim($row['mnames']) . ' ' . trim($row['surname'])),
                    /* $is_active      */ true,
                    /* $dob            */ date('Y-m-d', strtotime(trim($row['birthdate']))),
                    /* $nationality    */ isset($nationalities[$row['nationalityCode']])? $nationalities[$row['nationalityCode']]:  '',
                    /* $college_id     */ trim($row['facultyNo']),
                    /* $department_id  */ trim($row['facultyNo']).'-'.trim($row['deptCode']),
                    /* $program_id     */ trim($row['majorNo']),
                    /* $male_gender    */ $row['gender']==1,
                    /* $graduated      */ 0,
                    /* $phone          */ '',
                    /* $fax_no         */ '',
                    /* $office_no      */ '',
                    /* $address        */ ''
                );
            }
        }
    }

    public function inactive_student_members()
    {

        $nationalities = $this->getSOUP('Nationalities');
        $nationalities = $this->check_data($nationalities, 'nationalitiesList');
        $nationalities = json_decode(json_encode($nationalities), true);
        $nationalities = array_column($nationalities, 'nationalityDesc', 'nationalityId');

        $statuses = Orm_Student_Status::get_all();

        $programs = Orm_Program::get_all();

        foreach($statuses as $status) {
            if($status->get_integration_id() ==1 || $status->get_integration_id() ==7){
                continue;
            }

            $status_id = $status->get_id();

            foreach($programs as $program) {

                $result = $this->getSOUP('Students', [
                    'infoName'   => 'eaa',
                    'statusCode' => $status->get_integration_id(),
                    'facultyNo'  => $program->get_department_obj()->get_college_obj()->get_integration_id(),
                    'majorNo'    => $program->get_integration_id()
                ]);

                $result = $this->check_data($result, 'studentsList');

                foreach ($result as $row) {

                    $row = array_merge([
                        'birthdate' => '1970-01-01',
                        'degreeCode' => '2',
                        'deptCode' => '',
                        'email' => '',
                        'facultyNo' => '',
                        'fname' => '',
                        'fnameE' => '',
                        'gender' => '1',
                        'joinSemester' => '1',
                        'majorNo' => '0',
                        'mnames' => '',
                        'mnamesE' => '',
                        'nationalityCode' => '1',
                        'statusCode' => '',
                        'studentId' => '',
                        'surname' => '',
                        'surnameE' => ''
                    ], (array)$row);


                    $this->integration->student(
                    /* $integration_id */ $row['studentId'],
                        /* $email          */ filter_var(trim($row['email']), FILTER_VALIDATE_EMAIL)? trim($row['email']): trim($row['studentId']) . '@kku.edu.sa',
                        /* $login_id       */ $row['studentId'],
                        /* $first_name     */ trim($row['fname']),
                        /* $last_name      */ trim(trim($row['mnames']) . ' ' . trim($row['surname'])),
                        /* $is_active      */ false,
                        /* $dob            */ date('Y-m-d', strtotime(trim($row['birthdate']))),
                        /* $nationality    */ isset($nationalities[$row['nationalityCode']])? $nationalities[$row['nationalityCode']]:  '',
                        /* $college_id     */ trim($row['facultyNo']),
                        /* $department_id  */ trim($row['facultyNo']).'-'.trim($row['deptCode']),
                        /* $program_id     */ trim($row['majorNo']),
                        /* $status_id      */ $status->get_integration_id(),
                        /* $male_gender    */ $row['gender']==1,
                        /* $phone          */ '',
                        /* $fax_no         */ '',
                        /* $office_no      */ '',
                        /* $address        */ ''
                    );
                }
            }
        }
    }

    public function course_sections($semester_id)
    {
        if (!$semester_id) {
            die('No Semester Selected');
        }

        foreach(Orm_Course::get_all() as $course) {

            $result = $this->getSOUP('InstructorCourses', [
                'corseNo'  => $course->get_integration_id(),
                'semester' => $semester_id
            ]);

            $section = $this->check_data($result, 'instructorCoursesList');


            foreach($section as $row) {

                $row = array_merge([
                    'semester'     => $semester_id,
                    'campusNo'     => 0,
                    'sectionSeq'   => 0,
                    'activityCode' => 0,
                    'instructorId' => 0
                ], (array)$row);


                $teacher = Orm_User_Faculty::get_one(['like_integration_id' => $row['instructorId'].'_' ]);


                $this->integration->course_sections(
                    $semester_id.'_'.$course->get_integration_id().'_'.$row['campusNo'].'_'.$row['sectionSeq'].'_'.$row['activityCode'],
                    $semester_id,
                    $row['campusNo'],
                    $course->get_integration_id(),
                    $row['sectionSeq'],
                    $teacher->get_integration_id()
                );

                unset($row);
                unset($teacher);
            }
            unset($section);
        }
    }

    public function course_students($semester_id)
    {
        if (!$semester_id) {
            die('No Semester Selected');
        }

        foreach(Orm_Course::get_all() as $course) {

            $result = $this->getSOUP('CourseSectionsStudents', [
                'corseNo'  => $course->get_integration_id(),
                'semester' => $semester_id
            ]);


            $section = $this->check_data($result, 'courseSectionsStudentsList');

            foreach($section as $row) {

                $row = array_merge([
                    'semester'     => $semester_id,
                    'campusNo'     => 0,
                    'sectionSeq'   => 0,
                    'activityCode' => 0,
                    'studentId'    => 0
                ], (array)$row);


                if($row['studentId']==0){
                    continue;
                }

                $this->integration->course_student(
                    $semester_id.'_'.$course->get_integration_id().'_'.$row['campusNo'].'_'.$row['sectionSeq'].'_'.$row['activityCode'],
                    $row['studentId']
                );
            }

            unset($section);
        }
    }

    public function force_add_student_members()
    {
        if(!file_exists('logs/students_ids')){
            return;
        }


        $nationalities = $this->getSOUP('Nationalities');
        $nationalities = $this->check_data($nationalities, 'nationalitiesList');
        $nationalities = json_decode(json_encode($nationalities), true);
        $nationalities = array_column($nationalities, 'nationalityDesc', 'nationalityId');

        foreach(file('logs/students_ids') as $id) {

            if(trim($id)=='') {
                continue;
            }

            $result = $this->getSOUP('Students', [
                'infoName'  => 'eaa',
                'studentId' => trim($id)
            ]);

            $result = $this->check_data($result, 'studentsList');

            if(isset($result[0])) {

                $row = array_merge([
                    'birthdate' => '1970-01-01',
                    'degreeCode' => '2',
                    'deptCode' => '',
                    'email' => '',
                    'facultyNo' => '',
                    'fname' => '',
                    'fnameE' => '',
                    'gender' => '1',
                    'joinSemester' => '1',
                    'majorNo' => '0',
                    'mnames' => '',
                    'mnamesE' => '',
                    'nationalityCode' => '1',
                    'statusCode' => '',
                    'studentId' => '',
                    'surname' => '',
                    'surnameE' => ''
                ], (array)$result[0]);


                $this->integration->student(
                /* $integration_id */ $row['studentId'],
                    /* $email          */ filter_var(trim($row['email']), FILTER_VALIDATE_EMAIL)? trim($row['email']): trim($row['studentId']) . '@kku.edu.sa',
                    /* $login_id       */ $row['studentId'],
                    /* $first_name     */ trim($row['fname']),
                    /* $last_name      */ trim(trim($row['mnames']) . ' ' . trim($row['surname'])),
                    /* $is_active      */ $row['statusCode']==1,
                    /* $dob            */ date('Y-m-d', strtotime(trim($row['birthdate']))),
                    /* $nationality    */ isset($nationalities[$row['nationalityCode']])? $nationalities[$row['nationalityCode']]:  '',
                    /* $college_id     */ trim($row['facultyNo']),
                    /* $department_id  */ trim($row['facultyNo']).'-'.trim($row['deptCode']),
                    /* $program_id     */ trim($row['majorNo']),
                    /* $status_id      */ trim($row['statusCode']),
                    /* $male_gender    */ $row['gender']==1,
                    /* $phone          */ '',
                    /* $fax_no         */ '',
                    /* $office_no      */ '',
                    /* $address        */ ''
                );
            }
        }
    }

    public function get_faculty_job_position($position) {
        switch ($position) {
            case 'أعضاء هيئة التدريس' :
                return Orm_User_Faculty::JOB_POSITION_MEMBERS;
            case 'المحاضرون والمعيدون' :
                return Orm_User_Faculty::JOB_POSITION_LECTURER;
            default:
                return -1;
        }
    }

    public function get_academic_rank($rank)
    {
        switch ($rank) {
            case 'Tutor':
                return Orm_User_Faculty::ACADEMIC_RANK_TUTOR;
            case 'Teaching Assistant':
                return Orm_User_Faculty::ACADEMIC_RANK_TEACHING_ASSISTANT;
            case 'Professor':
                return Orm_User_Faculty::ACADEMIC_RANK_PROFESSOR;
            case 'Assistant Prof.':
                return Orm_User_Faculty::ACADEMIC_RANK_ASSISTANT_PROF;
            case 'Lecturer':
                return Orm_User_Faculty::ACADEMIC_RANK_LECTURER;
            case 'Associate Prof.':
                return Orm_User_Faculty::ACADEMIC_RANK_ASSOCIATE_PROF;
            default:
                return Orm_User_Faculty::ACADEMIC_RANK_TUTOR;
        }
    }

    private function getSOUP($function, $param = [], $url = null, $list = '') {
        $url = $url == null ? $this->_soapSIS : $this->_soapHR;
        $soapClient = new SoapClient($url);
        $param['wsUserName'] = "eaa";
        $param['wsPassword'] = "EAAeaa124578";

        $headers = new SoapHeader($url, 'UserCredentials', $param);
        $soapClient->__setSoapHeaders([$headers]);


        try {
            $info = $soapClient->__call($function, [$param]);

            if (isset($info->return)) {
                if (is_object($info->return)) {
                    if ($list != '') {
                        if (property_exists($info->return, $list)) {
                            $this->retry = 0;
                            unset($soapClient);
                            return $info->return;
                        } else {
                            print_r($param);
                            print($list . " is not found in object\n");
                            print("Can not Connect KKU Server. try #:" . $this->retry . ".\n");
                            if ($this->retry > 5) {
                                $this->retry++;
                                $this->getSOUP($function, $param, $url, $list);
                            } else {
                                unset($soapClient);
                                return $info->return;
                            }
                        }
                    } else {
                        unset($soapClient);
                        return $info->return;
                    }
                } else {
                    print_r($param);
                    print("return is not object\n");
                    print("Can not Connect KKU Server. try #:" . $this->retry . ".\n");
                    if ($this->retry > 5) {
                        $this->retry++;
                        $this->getSOUP($function, $param, $url, $list);
                    } else {
                        unset($soapClient);
                        return null;
                    }
                }
            } else {
                print_r($param);
                print("no data in return\n");
                print("Can not Connect KKU Server. try #:" . $this->retry . ".\n");
                if ($this->retry > 5) {
                    $this->retry++;
                    $this->getSOUP($function, $param, $url, $list);
                } else {
                    unset($soapClient);
                    return null;
                }
            }
        } catch (SoapFault $fault) {
            $this->retry++;
            print_r($param);
            print("Can not Connect KKU Server. try #:" . $this->retry . ".\n");
            print('SOAP Fault: (faultcode: {' . $fault->faultcode . '}, faultstring: {' . $fault->faultstring . "})\n");
            if ($this->retry > 5)
                $this->getSOUP($function, $param, $url, $list);
        }

        unset($soapClient);
        return null;
    }

    private function check_data($obj, $property) {
        $rows = [];
        if(is_object($obj)){
            if(property_exists($obj, $property)){
                if(is_object($obj->$property)) {
                    $rows = [$obj->$property];
                } else if(is_array($obj->$property)) {
                    $rows = $obj->$property;
                }
            }
        }


        return $rows;
    }
}
