<?php
//die(ENVIRONMENT);
defined('BASEPATH') OR exit('No direct script access allowed');

class Integration extends MX_Controller
{
    private $time = 0;
    private $count = 0;

    public function __construct()
    {
parent::__construct();

        if (!is_cli()) {
            exit('No direct script access allowed');
        }

        ini_set("memory_limit", "-1");
        set_time_limit(0);

        ini_set('mssql.charset', 'UTF-8');

        // Connect to MSSQL
        $link = mssql_connect('10.13.172.10:1433', 'BIService_Gadeer', 'AppSys4Gadeer');

        if (!$link) {
            die('connecting error' . "\n".mssql_get_last_message()."\n");
        }

        if (!$link || !mssql_select_db('JADEER', $link)) {
            die('Unable to connect or select database!');
        }
    }

    public function index()
    {

        $this->load->helper('hejri');


        error_log("Integrate : Start (Semesters)");
       // $this->semesters();

        error_log("Integrate : Start (Campus)");
        //$this->campuses();

        error_log("Integrate : Start (College)");
       // $this->colleges();
        error_log("Integrate : Start (Department)");
        //$this->departments();

        error_log("Integrate : Start (Degrees)");
       // $this->degrees();

        error_log("Integrate : Start (Programs)");
       // $this->programs();



        error_log("Integrate : Start (Majors)");
        //$this->majors();

        error_log("Integrate : Start (Courses)");
       //$this->courses();

        error_log("Integrate : Start (Program_plan)");
        // $this->program_plan();

        error_log("Integrate : Start (Faculty)");

        //$this->faculty_members();
        error_log("support_unit");

       // $this->support_unit();

        error_log("Integrate : Start (Staff)");
        //$this->staff_members();

        error_log("Integrate : Start (Students)");
       // $this->student_members();


        error_log("Integrate : Start (Course Sections)");
        $semester = Orm_Semester::get_current_semester()->get_integration_id();

       // $this->course_sections($semester);


        error_log("Integrate : Start (Course Students)");
        $this->course_students($semester);

        echo "The end\n";
    }

//* * * * * /home/app/jadeer/sync.sh
    public function semesters()
    {
        $query = mssql_query("SELECT * FROM Dim_Semester");
        while ($row = mssql_fetch_assoc($query)) {

            $semester = Orm_Semester::get_one(['integration_id' => $row['SEMESTER_ID']]);
            $mode = ($semester->get_id() ? 'Modify' : 'Add');
            $this->count++;
            $year=date('Y',strtotime($row['SEMESTER_ID']."01"));
            $semester->set_is_deleted(0);
            $semester->set_integration_id($row['SEMESTER_ID']);
            $semester->set_name_ar(trim($row['TITLE_ARABIC']));
            $semester->set_name_en(trim($row['TITLE_ENGLISH']));
            $semester->set_start(date('Y-m-d H:i:s', strtotime(trim($row['START_DATE']))));
            $semester->set_end(date('Y-m-d H:i:s', strtotime(trim($row['END_DATE']))));
            $semester->set_year($year);
            $semester->set_is_deleted(0);

            $semester->save();

            error_log("{$this->count} - Semester : {$mode} Replace ({$row['SEMESTER_ID']}) Time:" . (time() - $this->time));
            unset($semester);
        }

        mssql_free_result($query);
    }

    public function campuses()
    {
        $query = mssql_query("SELECT * FROM Dim_Campus");

        while ($row = mssql_fetch_assoc($query)) {

            $campus = Orm_Campus::get_one(['integration_id' => $row['CAMPUS_ID']]);
            $mode = ($campus->get_id() ? 'Modify' : 'Add');
            $this->count++;
            $campus->set_is_deleted(0);
            $campus->set_integration_id($row['CAMPUS_ID']);
            $campus->set_name_ar(trim($row['CAMPUS_NAME_ARABIC']));
            $campus->set_name_en(trim($row['CAMPUS_NAME_ENGLISH']));
            $campus->save();

            error_log("{$this->count} - Campus : {$mode} ({$campus->get_name()}) Time:" . (time() - $this->time));
            unset($campus);
        }
        mssql_free_result($query);
    }

    public function colleges()
    {
        $query = mssql_query("SELECT * FROM Dim_college");

        while ($row = mssql_fetch_assoc($query)) {
            $campus=Orm_Campus::get_one(['integration_id' => $row['CAMPUS_ID']]);
            if($campus->get_id()) {
            $campuses = Orm_Campus::get_model()->get_all([], 0, 0, [], Orm::FETCH_ARRAY);

            $campuses = array_column($campuses, 'id', 'integration_id');


            $college = Orm_College::get_one(array('integration_id' => trim($row['COLLEGE_ID'])));

            $mode = ($college->get_id() ? 'Modify' : 'Add');
            $this->count++;
            $college->set_is_deleted(0);
            $college->set_integration_id(trim($row['COLLEGE_ID']));
            $college->set_name_ar(trim($row['COLLEGE_NAME_ARABIC']));
            $college->set_name_en(trim($row['COLLEGE_NAME_ENGLISH']));
            $college->save();


            $campus_college = Orm_Campus_College::get_one(['campus_id' => $campuses[trim($row['CAMPUS_ID'])], 'college_id' => trim($college->get_id())]);

            if (!$campus_college->get_id()) {
                $campus_college->set_campus_id($campuses[trim($row['CAMPUS_ID'])]);
                $campus_college->set_college_id($college->get_id());
                $campus_college->save();
            }


//            error_log("{$this->count} - College : {$mode} ({$row['COLLEGE_ID']}) Time:" . (time() - $this->time));
            unset($college);
            }else{
                error_log("College ({$row['COLLEGE_ID']}) has no campus : campus:({$row['CAMPUS_ID']})");
            }
        }
        mssql_free_result($query);
    }

    public function departments()
    {
        $query = mssql_query("SELECT * FROM Dim_Departments");
        while ($row = mssql_fetch_assoc($query)) {

            $college=Orm_College::get_one(['integration_id' => $row['COLLEGE_ID']]);
            if($college->get_id()) {

                $integration_id = $row['COLLEGE_ID'] . '-' . $row['DEPARTMENT_ID'] ;

                $department = Orm_Department::get_one(array('integration_id' => $integration_id));
                $mode = ($department->get_id() ? 'Modify' : 'Add');
                $this->count++;
                $department->set_is_deleted(0);
                $department->set_integration_id($integration_id);
                $department->set_college_id(Orm_College::get_one(array('integration_id' => $row['COLLEGE_ID']))->get_id());
                $department->set_name_ar(trim($row['DEPARTMENT_TITLE_ARABIC']));
                $department->set_name_en(trim($row['DEPARTMENT_TITLE_ENGLISH']));
                $department->save();
                echo($row['DEPARTMENT_TITLE_ARABIC']);

                error_log("{$this->count} - Department : {$mode} ({$integration_id}) Time:" . (time() - $this->time));
                unset($department);
            }else{
                error_log("Department ({$row['DEPARTMENT_ID']}) has no college : College:({$row['COLLEGE_ID']})");
            }
        }
        mssql_free_result($query);
    }

    public function degrees()
    {
        $query = mssql_query("SELECT * FROM Dim_ProgramsDegree");

        while ($row = mssql_fetch_assoc($query)) {

            $degree = Orm_Degree::get_one(array('integration_id' => $row['DEGREE_ID']));
            $mode = ($degree->get_id() ? 'Modify' : 'Add');
            $this->count++;
            $degree->set_is_deleted(0);
            $degree->set_integration_id($row['DEGREE_ID']);
            $degree->set_name_ar(trim($row['DEGREE_TITLE_ARABIC']));
            $degree->set_name_en(trim($row['DEGREE_TITLE_ENGLISH']));
            $degree->save();

            error_log("{$this->count} - Degree : {$mode} ({$row['DEGREE_ID']}) Time:" . (time() - $this->time));
            unset($degree);
        }
        mssql_free_result($query);
    }

    public function programs()
    {
        $query = mssql_query("SELECT * FROM Dim_Programs order by department_id");
        $i=0;
        while ($row = mssql_fetch_assoc($query)) {

            $department=Orm_Department::get_one(['integration_id' => $row['COLLEGE_ID'].'-'.$row['DEPARTMENT_ID']]);
            if($department->get_id()){
                $program = Orm_Program::to_object($this->db->get_where('program', ['integration_id' => $row['PROGRAM_ID']])->row_array());


                $program = $program ?: new Orm_Program();

                $mode = ($program->get_id() ? 'Modify' : 'Add');
                $this->count++;
                $program->set_integration_id($row['PROGRAM_ID']);
                $program->set_department_id($department->get_id());
                $program->set_is_deleted(0);
                $program->set_degree_id(Orm_Degree::get_one(array('integration_id' => $row['DEGREE_ID']))->get_id());
                $program->set_name_ar(trim($row['PROGRAM_NAME_ARABIC']));
                $program->set_name_en(trim($row['PROGRAM_NAME_ENGLISH']));
                $program->set_credit_hours($row['CREDIT_HOURS'] ?: 0);
                $program->set_code_ar('NA');
                $program->set_code_en('NA');
                $program->save();

              // error_log("{$this->count} - Program : {$mode} ({$row['PROGRAM_ID']}) Time:" . (time() - $this->time));
                unset($program);
            }else{
                error_log("Program ({$row['PROGRAM_ID']}) has no department : College:({$row['COLLEGE_ID']}), Department:({$row['DEPARTMENT_ID']})");
            }

        }
        mssql_free_result($query);
    }

    public function majors()
    {

        $query = mssql_query("SELECT * FROM Dim_Major");

        while ($row = mssql_fetch_assoc($query)) {
            $program=Orm_Program::get_one(['integration_id' => $row['PROGRAM_ID']]);
            if($program->get_id()){

            $major = Orm_Major::get_one(array('integration_id' => $row['MAJOR_ID'] . '-' . $row['PROGRAM_ID'] .'-' . $row['DEPARTMENT_ID']));
            $mode = ($major->get_id() ? 'Modify' : 'Add');
            $this->count++;

            $major->set_is_deleted(0);
            $major->set_integration_id($row['MAJOR_ID'] . '-' . $row['PROGRAM_ID'] . '-' . $row['DEPARTMENT_ID']);
            $major->set_program_id(Orm_Program::get_one(array('integration_id' => $row['PROGRAM_ID']))->get_id());
            $major->set_name_ar(trim($row['MAJOR_TITLE_ARABIC']));
            $major->set_name_en(trim($row['MAJOR_TITLE_ENGLISH']));
            $major->save();

            //error_log("{$this->count} - Major : {$mode} ({$row['MAJOR_ID']}-{$row['PROGRAM_ID']}) Time:" . (time() - $this->time));

            unset($major);
            }else{
                error_log("Major ({$row['MAJOR_ID']}) Program:({$row['PROGRAM_ID']}) Department:({$row['DEPARTMENT_ID']})");
            }
        }

        mssql_free_result($query);
    }

    public function courses()
    {
        $query = mssql_query("SELECT * FROM Dim_Course");
        $i=0;
        $coursersArray=[];
        while ($row = mssql_fetch_assoc($query)) {

            $course = Orm_Course::to_object($this->db->get_where('course', ['integration_id' =>$row['COURSE_ID']])->row_array());

            $course = $course ?: new Orm_Course();

            /** @var Orm_Course $course */

            $mode = ($course->get_id() ? 'Modify' : 'Add');
            $this->count++;

            $department = Orm_Department::get_one(array('integration_id' => $row['COLLEGE_ID'] . '-' . $row['DEPARTMENT_ID']));
            if ($department->get_id()) {
//                error_log("COURSE_ID=" . $row['COURSE_ID'] . "-----" . "COLLEGE_ID=" . $row['COLLEGE_ID'] . "----" . "DEPARTMENT_ID=" . $row['DEPARTMENT_ID']);


                $course->set_is_deleted(0);
                $course->set_integration_id($row['COURSE_ID']);
                $course->set_department_id($department->get_id());
                $course->set_name_ar(trim($row['COURSE_TITLE_ARABIC']) ?: trim($row['COURSE_TITLE_ENGLISH']));
                $course->set_name_en(trim($row['COURSE_TITLE_ENGLISH']) ?: trim($row['COURSE_TITLE_ARABIC']));
                $course->set_code_ar($row['COURSE_ID']);
                $course->set_code_en($row['COURSE_ID']);
                $course->set_type($row['COURSE_TYPE'] == 'OUT' ? 'practical' : 'theoretical');
                $course->save();

                //error_log("{$this->count} - Course : {$mode} ({$row['COURSE_ID']}) Time:" . (time() - $this->time));




            if($mode=='Modify'){
                if(!in_array($row['COURSE_ID'],$coursersArray)){
                    $coursersArray[]=$row['COURSE_ID'];
                   // error_log("{$this->count} - Course : {$mode} ({$row['COURSE_ID']}) Time:" . (time() - $this->time));
                }
            }
                unset($course);

            } else {
              $i++;
             error_log("COURSE_ID=".$row['COURSE_ID']." has " ."DEPARTMENT_ID=".$row['DEPARTMENT_ID']);
            }

        }
        error_log($i);
        mssql_free_result($query);
    }

    public function program_plan()
    {
        $query = mssql_query("SELECT * FROM Dim_ProgramPlan");
        $missingCourses=[];

        while ($row = mssql_fetch_assoc($query)) { ;

            $program_id = Orm_Program::get_one(array('integration_id' => $row['PROGRAM_ID']))->get_id();

            $course_id = Orm_Course::get_one(array('integration_id' => $row['COURSE_ID']))->get_id();

            if ($program_id && $course_id) {
                $program_plan = Orm_Program_Plan::get_one(array('program_id' => $program_id, 'course_id' => $course_id));
                $mode = ($program_plan->get_id() ? 'Modify' : 'Add');
                $this->count++;
                $program_plan->set_program_id($program_id);
                $program_plan->set_course_id($course_id);
                $program_plan->set_level(substr($row['COURSE_LEVEL'],-2));
                $program_plan->set_credit_hours($row['CREDIT_HOURS']);
                $program_plan->set_is_required($row['REQUIRED_ELECTIVE']);
                $program_plan->save();


                $id = $row['PROGRAM_ID'] . '0' . $row['COURSE_ID'];
                error_log("{$this->count} - Program plan : {$mode} ({$id}) Time:" . (time() - $this->time));
                unset($program_plan);
            } else {
                $message='';
                if(!$program_id){
                    $message="**** - Program plan : error on  program : [{$row['PROGRAM_ID']}]";
                }
                if(!$course_id){
                    if(!in_array($row['COURSE_ID'],$missingCourses)){
                        $missingCourses[]=$row['COURSE_ID'];
                    }
                    $message.="**** - Program plan : error on course :{$row['COURSE_ID']} ";
                }
                error_log($message);
            }

            unset($program_id);
            unset($course_id);
        }
        mssql_free_result($query);
    }

    public function support_unit()
    {
        $query = mssql_query("SELECT * FROM Dim_SupportUnits");

        while ($row = mssql_fetch_assoc($query)) {
            $params = array(
                'id' => $row['UNIT_ID'],
                'name_ar' => trim($row['UNIT_NAME_ARABIC']),
                'name_en' => trim($row['UNIT_NAME_ENGLISH']),
                'integration_id' => $row['UNIT_ID'],
                'class_type' => 'Orm_Unit_Admin'
            );

            $this->db->replace('unit', $params);

            error_log("{$this->count} - Unit : Replace ({$row['UNIT_NAME_ARABIC']}) Time:" . (time() - $this->time));
            unset($params);
        }
        mssql_free_result($query);
    }

    public function faculty_members()
    {
        $query = mssql_query("SELECT * FROM Dim_FacultyMember");

        while ($row = mssql_fetch_assoc($query)) {

            $faculty = Orm_User_Faculty::get_one(['login_id' => trim($row['LOGIN_ID']), 'skip_active' => 1]);


            $this->count++;
            $mode = ($faculty->get_id() ? 'Modify' : 'Add');


            $faculty->set_first_name(trim($row['FIRST_NAME']));
            $faculty->set_last_name(trim($row['LAST_NAME']));
            $faculty->set_email(trim($row['EMAIL']));
            $faculty->set_is_active(intval($row['IS_ACTIVE']));
            $faculty->set_login_id(trim($row['LOGIN_ID']));

            if ($row['BIRTH_DATE']) {
                if (intval(date('Y', strtotime($row['BIRTH_DATE']))) < 1300) {
                    $faculty->set_birth_date(HijriToGregorian($row['BIRTH_DATE'], 'YYYY-MM-DD'));
                } else {
                    $faculty->set_birth_date($row['BIRTH_DATE']);
                }
            }

            $faculty->set_integration_id(trim($row['LOGIN_ID']));
            $faculty->set_gender($row['GENDER'] == 'M' ? 0 : 1);
            $faculty->set_nationality(trim($row['NATIONALITY']));
            $faculty->set_phone(trim($row['PHONE']));
            $faculty->set_fax_no('');
            $faculty->set_office_no('');
            $faculty->set_address(trim($row['ADDRESS']));
//            $faculty->set_role_id(6);

            $faculty->set_college_id(Orm_College::get_one(['integration_id' => $row['COLLEGE_ID']])->get_id());
            $faculty->set_department_id(Orm_Department::get_one(['integration_id' => $row['COLLEGE_ID'] . '-' . $row['DEPARTMENT_ID']])->get_id());

            if ($row['PROGRAM_ID']) {
                $faculty->set_program_id(Orm_Program::get_one(['integration_id' => $row['PROGRAM_ID']])->get_id());
            } else {
                $faculty->set_program_id(0);
            }


            if (!$faculty->get_id()) {
                $faculty->set_role_id(4);
            }


            $faculty->set_job_position(trim($row['JOB_POSITION']));
            $faculty->set_academic_rank($this->get_academic_rank(trim($row['ACADEMIC_RANK'])));
            $faculty->set_service_time(intval(trim($row['SERVICE_TIME'])));
            $faculty->set_general_specialty(trim($row['GENERAL_SPECIALTY']));
            $faculty->set_specific_specialty(trim($row['SPECIFIC_SPECIALTY']));
            $faculty->set_graduate_from(trim($row['GRADUATE_FROM']));

            $faculty->save();

            error_log("{$this->count} - Faculty Member : {$mode} ({$row['LOGIN_ID']}) Time:" . (time() - $this->time));

            unset($faculty);
        }

        mssql_free_result($query);
    }

    public function student_members()
    {

        $this->load->helper('email');
        $dbColleges=Orm_College::get_all();
        $colleges=[];

        foreach ($dbColleges as $college){
            $colleges[$college->get_integration_id()]=$college->get_id();
        }

        $dbDepartments=Orm_Department::get_all();
        $departments=[];

        foreach ($dbDepartments as $department){
            $departments[$department->get_integration_id()]=$department->get_id();
        }


        $dbPrograms=Orm_Program::get_all();
        $programs=[];

        foreach ($dbPrograms as $program){
            $programs[$program->get_integration_id()]=$program->get_id();
        }


        $total = mssql_fetch_assoc(mssql_query("select COUNT(*) as 'total' from Dim_Student where login_id != '0'"));
        var_dump($total['total']);

        $i=1;
        while ($i<=$total['total']){

            $offset = $i * 10000;
            $students = mssql_query("select * from  (select *, ROW_NUMBER() OVER(ORDER BY LOGIN_ID) AS row  from Dim_Student where login_id != '0') as f where row between {$i} and {$offset}");
            echo "$i\n";
            $i+=10000;
            while ($row = mssql_fetch_assoc($students)) {

                $student = Orm_User::get_one(['login_id' => $row['LOGIN_ID'], 'skip_active' => 1]);

                if ($row['IS_ACTIVE'] == 'GR') {

                    if ($student && $student->get_class_type() != Orm_User_Alumni::class) {

                        $this->db->query("delete from user_student where user_id = " . $student->get_id());

                        $student->set_class_type(Orm_User_Alumni::class);

                        $student->save();

                        $this->db->query("insert into user_alumni (user_id, college_id, department_id, program_id, graduated) VALUES ('" . $student->get_id() . "', 0, 0, 0)");

                        $student = Orm_User_Alumni::get_one(['login_id' => $row['LOGIN_ID'], 'skip_active' => 1]);

                        $student->set_graduated($row['GRADUATED_YEAR'] ?: 0);

                    } elseif (is_null($student)) {

                        $student = new Orm_User_Alumni();
                    }


                    $student->set_graduated(trim($row['GRADUATED_YEAR']));
                } else {
                    $student = Orm_User_Student::get_one(['login_id' => $row['LOGIN_ID'], 'skip_active' => 1]);
                }

                $this->count++;
                $mode = ($student->get_id() ? 'Modify' : 'Add');


                if (valid_email($row['EMAIL'])) {

                    $student->set_email($row['EMAIL']);
                } else {
                    $student->set_email($row['LOGIN_ID'] . '@kau.edu.sa');
                }

                $student->set_login_id(trim($row['LOGIN_ID']));
                $student->set_integration_id(trim($row['LOGIN_ID']));

//            $bDate = 0;
//            preg_match('/\d{4}/', $row['BIRTH_DATE'], $output_array);
//            if(count($output_array)) {
//                $bDate = intval($output_array[0]);
//            }
//            if($bDate>1900){
//                $bDate = date('Y-m-d', strtotime($row['BIRTH_DATE']));
//            }
//            else {
//                $bDate = HijriToGregorian($row['BIRTH_DATE'], 'YYYY-MM-DD');
//            }


                $bDate = date('Y-m-d', strtotime($row['BIRTH_DATE']));

                $student->set_birth_date($bDate);
                $student->set_first_name(trim($row['FIRST_NAME']) ?: '');
                $student->set_last_name(trim($row['LAST_NAME']) ?: '');
                $student->set_is_active(in_array($row['IS_ACTIVE'], ['AS', 'GR']) ? 1 : 0);
                $student->set_gender(trim($row['GENDER']) == 'ذكر' ? 0 : 1);
                $student->set_nationality(trim($row['NATIONALITY']) ?: '');
                $student->set_fax_no('');
                $student->set_phone(trim($row['PHONE']) ?: '');
                $student->set_office_no('');
                $student->set_address(trim($row['ADDRESS']) ?: '');


                $student->set_college_id($colleges[$row['COLLEGE_ID']]);
                if($departments[$row['COLLEGE_ID'] . '-' . $row['DEPARTMENT_ID']] !=0){
                    $student->set_department_id($departments[$row['COLLEGE_ID'] . '-' . $row['DEPARTMENT_ID']]);
                }else{
                    error_log("{$this->count} - Student : {$mode} ({$row['LOGIN_ID']}) Time: No Department {$row['DEPARTMENT_ID']} with college {$row['COLLEGE_ID']} " . ((time() - $this->time)/60/60));
                }


                //print_r($row);
                //[PROGRAM_ID] => BS-MEDI-MD
               // die('hhj');
                if ($row['PROGRAM_ID']) {
                    $student->set_program_id($programs[$row['PROGRAM_ID']]);

//                    $student->set_program_id(Orm_Program::get_one(['integration_id' => $row['PROGRAM_ID'].'-'.$row['DEPARTMENT_ID']])->get_id());

                } else {
                    $student->set_program_id(0);

                }

                $student->save();

               // error_log("{$this->count} - Student : {$mode} ({$row['LOGIN_ID']}) Time:" . ((time() - $this->time)/60/60));
                unset($student);
            }
        }
        echo 'end student';

    }

    public function staff_members()
    {

        $query = mssql_query("SELECT * FROM Dim_StaffMember");

        while ($row = mssql_fetch_assoc($query)) {

            $this->count++;
            $staff = Orm_User_Staff::get_one(['login_id' => $row['LOGIN_ID']]);

            $mode = $staff->get_id() ? 'Modify' : 'Add';

            $row['EMAIL'] = $row['EMAIL'] ?: '';
            $row['EMAIL'] = trim($row['EMAIL']) == 'NULL' ? '' : $row['EMAIL'];

            $staff->set_email($row['EMAIL']);
            $staff->set_login_id(trim($row['LOGIN_ID']));

            $staff->set_first_name(trim($row['FIRST_NAME']));
            $staff->set_last_name(trim($row['LAST_NAME']));

            if (trim($row['BIRTH_DATE'])) {
                if (intval(date('Y', strtotime($row['BIRTH_DATE']))) < 1300) {
                    $staff->set_birth_date(HijriToGregorian($row['BIRTH_DATE'], 'YYYY-MM-DD'));
                } else {
                    $staff->set_birth_date($row['BIRTH_DATE']);
                }
            }

            $staff->set_integration_id(trim($row['LOGIN_ID']));
            $staff->set_gender($row['GENDER'] == 'M' ? 0 : 1);
            $staff->set_nationality(trim($row['NATIONALITY']));
            $staff->set_phone(trim($row['PHONE']));
            $staff->set_fax_no('');
            $staff->set_office_no('');

            if (!$staff->get_id()) {
                $staff->set_role_id(5);
            }

            $staff->set_address(trim($row['ADDRESS']));

            $staff->set_unit_id($row['UNIT_ID']);

            $staff->set_college_id(Orm_College::get_one(['integration_id' => $row['COLLEGE_ID']])->get_id());
            $staff->set_department_id(Orm_Department::get_one(['integration_id' => $row['COLLEGE_ID'] . '-' . $row['DEPARTMENT_ID']])->get_id());

            if ($row['PROGRAM_ID']) {
                $staff->set_program_id(Orm_Program::get_one(['integration_id' => $row['PROGRAM_ID']])->get_id());
            } else {
                $staff->set_program_id(0);
            }

            $staff->set_job_position($this->get_faculty_job_position($row['JOB_POSITION']));

            $staff->set_service_time((int)$row['SERVICE_TIME']);
            $staff->save();

            error_log("{$this->count} - Staff : {$mode} ({$row['LOGIN_ID']}) Time:" . (time() - $this->time));
            unset($staff);
        }

        mssql_free_result($query);
    }

    public function course_sections($semester_id)
    {
        if (!$semester_id) {
            echo('No Semester Selected');
        }
        $query = mssql_query("SELECT * FROM CourseSection where SEMESTER_ID = '{$semester_id}'");

        while ($row = mssql_fetch_assoc($query)) {

            $this->count++;

            $integration_id = "{$row['SEMESTER_ID']}-{$row['SSBSECT_CAMP_CODE']}-{$row['FACULTY_ID']}-{$row['COURSE_ID']}-{$row['SECTION_NO']}";

            $this->db->select('id');
            $rs_course_section = $this->db->get_where('course_section', ['integration_id' => $integration_id]);

            $mode = $rs_course_section->num_rows()? 'Modify': 'Add';

            if ($rs_course_section->num_rows() == 0) {

                $this->db->select('id');
                $rs_course = $this->db->get_where('course', ['integration_id' => $row['COURSE_ID']]);

                if ($rs_course->num_rows() == 0) {
                    continue;
                }

                $this->db->select('id');
                $rs_campus = $this->db->get_where('campus', ['integration_id' => $row['SSBSECT_CAMP_CODE']]);

                if ($rs_campus->num_rows() == 0) {
                    continue;
                }

                $semesterID=Orm_Semester::get_one(['integration_id'=>$row['SEMESTER_ID']])->get_id();
                $course_section = new Orm_Course_Section();

                $course_section->set_course_id($rs_course->row()->id);
                $course_section->set_semester_id($semesterID);
                $course_section->set_section_no($row['SECTION_NO']);
                $course_section->set_campus_id($rs_campus->row()->id);

                $course_section->set_integration_id($integration_id);

                $course_section->save();

                $course_section_id = $course_section->get_id();

                error_log("{$this->count} - Course sections : {$mode} ({$row['SECTION_NO']}) Time:" . (time() - $this->time));


                unset($rs_course);
                unset($rs_campus);
            } else {
                $course_section_id = $rs_course_section->row()->id;
            }
            $user_faculty_id = Orm_User_Faculty::get_one(['login_id' => trim($row['FACULTY_ID'])])->get_id();

            if ($user_faculty_id) {

                $this->db->query("
INSERT into course_section_teacher
select null as id, '{$course_section_id}' as section_id, '{$user_faculty_id}' as user_id
from (select 1) as f where not exists(select id from course_section_teacher where section_id={$course_section_id} and user_id={$user_faculty_id});
                ");

            }

           error_log("{$this->count} - Course sections : {$mode} ({$row['SECTION_NO']}) Faculty: {$row['FACULTY_ID']} Time:" . (time() - $this->time));
            unset($course_section);
        }
echo 'end course section';
        mssql_free_result($query);
    }

    public function course_students($semester_id)
    {

        if (!$semester_id) {
            die('No Semester Selected');
        }
        $this->db->select(['id', 'integration_id']);
        $rs_course_section = $this->db->get('course_section');

        $sections = array_column($rs_course_section->result_array(), 'id', 'integration_id');


        $this->db->select(['integration_id']);
        $rs_college = $this->db->get('college');

        $colleges = array_column($rs_college->result_array(), 'integration_id');

        foreach ($colleges as $college) {

            $add_arr = [];

//            $query = mssql_query("select Dim_CourseStudent.*,CourseSection.SSBSECT_CAMP_CODE
//                                  from Dim_CourseStudent join Dim_Student on LOGIN_ID=STUDENT_ID
//                                  join CourseSection on CourseSection.COURSE_ID = Dim_CourseStudent.COURSE_ID
//                                  where Dim_Student.COLLEGE_ID ='{$college}' and Dim_CourseStudent.SEMESTER_ID='{$semester_id}'");

//            echo '-';
//            echo $semester_id;
//            echo '-';
//            echo $college;
//            die('-');
            $query = mssql_query("select Dim_CourseStudent.*
                                  from Dim_CourseStudent join Dim_Student on LOGIN_ID=STUDENT_ID 
                                  where Dim_Student.COLLEGE_ID ='{$college}' and Dim_CourseStudent.SEMESTER_ID='{$semester_id}'");

            while ($row = mssql_fetch_assoc($query)) {
                $this->count++;

                //$integration_id = "{$row['SEMESTER_ID']}-{$row['SSBSECT_CAMP_CODE']}-{$row['COURSE_ID']}-{$row['SECTION_NO']}";
                $integration_id = "{$row['SEMESTER_ID']}-{$row['SSBSECT_CAMP_CODE']}-{$row['FACULTY_ID']}-{$row['COURSE_ID']}-{$row['SECTION_NO']}";
                echo $integration_id;
                if (!isset($sections[$integration_id])) {
                    continue;
                }


                $this->db->select(['id', 'class_type']);
                $rs_user = $this->db->get_where('user', ['login_id' => trim($row['STUDENT_ID'])], 1);

                $user_student = $rs_user->row();


                if (!($rs_user->num_rows() && $user_student->id) || $user_student->class_type != 'Orm_User_Student') {
                    continue;
                }

                unset($rs_user);

                if ($user_student->id) {
                    $add_arr[] = [
                        'section_id' => $sections[$integration_id],
                        'user_id' => $user_student->id
                    ];
                }


                if (count($add_arr) == 2000) {
                    echo 'insert_1';
                    $this->db->query($this->insert_ignore_batch('course_section_student', $add_arr));
                    $add_arr = [];
                    echo 'insert1';
                }
            }

            if (count($add_arr) > 0) {
                echo 'insert_2';
                $this->db->query($this->insert_ignore_batch('course_section_student', $add_arr));
                echo 'insert2';
            }

            mssql_free_result($query);
        }
    }

    public function get_faculty_job_position($position)
    {
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
            case 'مدرس':
                return Orm_User_Faculty::ACADEMIC_RANK_TUTOR;
            case 'معيد':
                return Orm_User_Faculty::ACADEMIC_RANK_TEACHING_ASSISTANT;
            case 'أستاذ':
            case 'استاذ':
                return Orm_User_Faculty::ACADEMIC_RANK_PROFESSOR;
            case 'أستاذ مساعد':
            case 'استاذ مساعد':
                return Orm_User_Faculty::ACADEMIC_RANK_ASSISTANT_PROF;
            case 'محاضر':
                return Orm_User_Faculty::ACADEMIC_RANK_LECTURER;
            case 'أستاذ مشارك':
            case 'استاذ مشارك':
                return Orm_User_Faculty::ACADEMIC_RANK_ASSOCIATE_PROF;
            default:
                return Orm_User_Faculty::ACADEMIC_RANK_TUTOR;
        }
    }

    private function insert_ignore_batch($table, $rows)
    {
        if (trim($table) == '' || count($rows) == 0) {
            return '';
        }

        $sql = "insert ignore into `{$table}` ";
        $sql .= "(`" . implode('`, `', array_keys($rows[0])) . "`)";
        $sql .= " values ";
        foreach ($rows as $row) {
            $sql .= "('" . implode("', '", $row) . "'),";
        }

        $sql = trim($sql, ',');
        return $sql;

    }
}
/*
 * select Dim_CourseStudent.STUDENT_ID,Dim_CourseStudent.SECTION_NO,CourseSection.SSBSECT_CAMP_CODE,Dim_CourseStudent.COURSE_ID,CourseSection.FACULTY_ID
  from Dim_CourseStudent join Dim_Student on LOGIN_ID=STUDENT_ID
  join CourseSection on CourseSection.COURSE_ID = Dim_CourseStudent.COURSE_ID
  		and CourseSection.SECTION_NO = Dim_CourseStudent.SECTION_NO
  where Dim_CourseStudent.SEMESTER_ID=201802
--  GROUP BY Dim_CourseStudent.STUDENT_ID,Dim_CourseStudent.SECTION_NO,CourseSection.SSBSECT_CAMP_CODE,Dim_CourseStudent.COURSE_ID,CourseSection.FACULTY_ID
  ORDER BY Dim_CourseStudent.STUDENT_ID,Dim_CourseStudent.SECTION_NO,CourseSection.SSBSECT_CAMP_CODE,Dim_CourseStudent.COURSE_ID,CourseSection.FACULTY_ID



Select COUNT(*), COLLEGE_ID,DEPARTMENT_ID
from Dim_Departments
GROUP by COLLEGE_ID,DEPARTMENT_ID

/Duplicated Coursers
SELECT COURSE_ID,DEPARTMENT_ID,COLLEGE_ID,COUNT(*)
FROM JADEER.dbo.Dim_Course GROUP BY COURSE_ID,DEPARTMENT_ID,COLLEGE_ID HAVING COUNT(*) > 1 ORDER BY COUNT(*);




ALTER TABLE jadeer.unit MODIFY
    name_ar VARCHAR(255)
      CHARACTER SET utf8
      COLLATE utf8_general_ci;


/* we should make truncate for user table then fix name ,address, nationality,



SELECT COURSE_ID,DEPARTMENT_ID,COLLEGE_ID,COUNT(*)
FROM JADEER.dbo.Dim_Course GROUP BY COURSE_ID,DEPARTMENT_ID,COLLEGE_ID HAVING COUNT(*) > 1 ORDER BY COUNT(*);


*/
