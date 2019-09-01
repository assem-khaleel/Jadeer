<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Orm::get_ci_model('User_Model', 'user');

class User_Faculty_Model extends User_Model
{

    /**
     * get table rows according to the assigned filters and page
     *
     * @param array $filters
     * @param int $page
     * @param int $per_page
     * @param array $orders
     * @param int $fetch_as
     *
     * @return array
     */
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS)
    {

        $page = (int)$page;
        $per_page = (int)$per_page;

        $this->db->select(['uf.*', Orm_User::get_table_name().'.*']);
        $this->db->distinct();
        $this->db->from(Orm_User_Faculty::get_table_name().' AS uf');

        $this->get_filters($filters);

        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        }

        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }

        switch ($fetch_as) {
            case Orm::FETCH_OBJECT:
                return Orm_User_Faculty::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach ($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_User_Faculty::to_object($row);
                }
                return $objects;
                break;
            case Orm::FETCH_ARRAY:
                return $this->db->get()->result_array();
                break;
            case Orm::FETCH_COUNT:
                return $this->db->count_all_results();
                break;
        }
    }

    public function get_filters($filters, $alias = 'uf')
    {

        $this->db->join(Orm_User::get_table_name(), Orm_User::get_table_name().".id = {$alias}.user_id", 'INNER');

        parent::get_filters($filters, Orm_User::get_table_name());

        if (isset($filters['user_id'])) {
            $this->db->where("{$alias}.user_id", $filters['user_id']);
        }
        if (!empty($filters['role_id'])) {
            $this->db->where("{$alias}.role_id", $filters['role_id']);
        }
        if (isset($filters['role_in'])) {
            $this->db->where_in("{$alias}.role_id", $filters['role_in']);
        }
        // Added by shamaseen
        if (!empty($filters['campus_in'])) {

            if(!empty($filters['semesters_id'])){
                $campus_id = $filters['campus_in'];
                $semester_id = empty($filters['semester_id']) ? Orm_Semester::get_active_semester_id() : intval($filters['semester_id']);

                $query = "SELECT DISTINCT ccs.id FROM ". Orm_Course_Section::get_table_name() ." AS ccs WHERE ccs.campus_id IN (";
                if(count($campus_id) >1){
                    foreach($campus_id as $campus) {
                        $query .= $campus.",";
                    }
                    $query = rtrim($query,',');
                }else{
                    foreach($campus_id as $key=> $campus) {
                        $query .= $campus;
                    }
                }

                $query .= ") AND ccs.semester_id = {$semester_id}";
                $query = "SELECT DISTINCT ccst.user_id FROM " . Orm_Course_Section_Teacher::get_table_name() . " AS ccst WHERE ccst.section_id IN ({$query})";

                $this->db->join("($query) AS campus_section_table", "campus_section_table.user_id = {$alias}.user_id", 'INNER', false);
            }

            $campus_id = $filters['campus_in'];

            $query = "SELECT DISTINCT ccs.id FROM ". Orm_Course_Section::get_table_name() ." AS ccs WHERE ccs.campus_id IN (";
            if(count($campus_id) >1){
                foreach($campus_id as $campus) {
                    $query .= $campus.",";
                }
                $query = rtrim($query,',');
            }else{
                foreach($campus_id as $key=> $campus) {
                    $query .= $campus;
                }
            }
            $query .= ")";
            $query = "SELECT DISTINCT ccst.user_id FROM " . Orm_Course_Section_Teacher::get_table_name() . " AS ccst WHERE ccst.section_id IN ({$query})";

            $this->db->join("($query) AS campus_section_table", "campus_section_table.user_id = {$alias}.user_id", 'INNER', false);
        }

        if (!empty($filters['campus_id'])) {
            $campus_id = intval($filters['campus_id']);
            $semester_id = empty($filters['semester_id']) ? Orm_Semester::get_active_semester_id() : intval($filters['semester_id']);

            $query = "SELECT DISTINCT ccs.id FROM ". Orm_Course_Section::get_table_name() ." AS ccs WHERE ccs.campus_id = {$campus_id} AND ccs.semester_id = {$semester_id}";
            $query = "SELECT DISTINCT ccst.user_id FROM " . Orm_Course_Section_Teacher::get_table_name() . " AS ccst WHERE ccst.section_id IN ({$query})";

            $this->db->join("($query) AS campus_section_table", "campus_section_table.user_id = {$alias}.user_id", 'INNER', false);
        }
        if (!empty($filters['college_id'])) {
            $this->db->where("{$alias}.college_id", $filters['college_id']);
        }
        if (!empty($filters['department_id'])) {
            $this->db->where("{$alias}.department_id", $filters['department_id']);
        }
        if (!empty($filters['not_department_id'])) {
            $this->db->where("{$alias}.department_id !=", $filters['department_id']);
        }
        if (!empty($filters['program_id'])) {
            $this->db->where("{$alias}.program_id", $filters['program_id']);
        }
        if (!empty($filters['has_courses_in_semester'])) {
            $this->db->join(Orm_Course_Section_Teacher::get_table_name().' AS cst', "cst.user_id = {$alias}.user_id");
            $this->db->join(Orm_Course_Section::get_table_name().' AS cs', "cs.id = cst.section_id");
            $this->db->where('cs.semester_id',$filters['has_courses_in_semester']);
        }

        if (!empty($filters['service_time']) && is_array($filters['service_time'])) {

            $service_times = array();

            foreach ($filters['service_time'] as $service_time) {
                switch ($service_time) {
                    case Orm_User_Faculty::SERVICE_TIME_1_TO_3 :
                        $service_times[] = "({$alias}.service_time >= 1 AND {$alias}.service_time <= 3)";
                        break;

                    case Orm_User_Faculty::SERVICE_TIME_4_TO_6 :
                        $service_times[] = "({$alias}.service_time >= 4 AND {$alias}.service_time <= 6)";
                        break;

                    case Orm_User_Faculty::SERVICE_TIME_7_TO_10 :
                        $service_times[] = "({$alias}.service_time >= 7 AND {$alias}.service_time <= 10)";
                        break;

                    case Orm_User_Faculty::SERVICE_TIME_11_TO_15 :
                        $service_times[] = "({$alias}.service_time >= 11 AND {$alias}.service_time <= 15)";
                        break;

                    case Orm_User_Faculty::SERVICE_TIME_16_TO_20 :
                        $service_times[] = "({$alias}.service_time >= 16 AND {$alias}.service_time <= 20)";
                        break;

                    case Orm_User_Faculty::SERVICE_TIME_21_TO_25 :
                        $service_times[] = "({$alias}.service_time >= 21 AND {$alias}.service_time <= 25)";
                        break;

                    case Orm_User_Faculty::SERVICE_TIME_25_TO_ANY :
                        $service_times[] = "({$alias}.service_time > 25)";
                        break;
                }
            }

            $service_times = '(' . implode(' OR ', $service_times) . ')';

            $this->db->where($service_times);
        }
        if (!empty($filters['job_position']) && is_array($filters['job_position'])) {
            $this->db->where_in("{$alias}.job_position", $filters['job_position']);
        }
        if (!empty($filters['academic_rank']) && is_array($filters['academic_rank'])) {
            $this->db->where_in("{$alias}.academic_rank", $filters['academic_rank']);
        }
        if (!empty($filters['general_specialty'])) {
            $this->db->where("{$alias}.general_specialty", $filters['general_specialty']);
        }
        if (!empty($filters['user_id_in'])) {
            $this->db->where_in("{$alias}.user_id", $filters['user_id_in']);
        }

        if (!empty($filters['user_id_not_in'])) {
            $this->db->where_not_in("{$alias}.user_id", $filters['user_id_not_in']);
        }
        if (!empty($filters['specific_specialty'])) {
            $this->db->where("{$alias}.specific_specialty", $filters['specific_specialty']);
        }
        if (!empty($filters['graduate_from'])) {
            $this->db->where("{$alias}.graduate_from", $filters['graduate_from']);
        }
        if (!empty($filters['degree'])) {
            $this->db->where("{$alias}.degree", $filters['degree']);
        }
        if (isset($filters['evaluator'])) {

            $user_id = isset($filters['evaluator_user_id'])? $filters['evaluator_user_id']: Orm_User::get_logged_user_id();

            $this->db->join(Orm_Fp_Evaluation::get_table_name(). ' AS fpe', Orm_User::get_table_name() . ".id = fpe.user_id", 'INNER');

            if($filters['evaluator'] == 'peer') {
                $this->db->where('fpe.peer_id', $user_id);
            } elseif($filters['evaluator'] == 'supervisor') {
                $this->db->where('fpe.supervisor_id', $user_id);
            }
        }
    }

    /**
     * replace new row to the table
     * @param array $params
     * @return int
     */
    public function replace($params = array())
    {
        $replace = $this->db->replace(Orm_User_Faculty::get_table_name(), $params);
        return $replace;
    }

    public function get_by_user_id($user_id)
    {

        $this->db->select('*');
        $this->db->distinct();
        $this->db->from(Orm_User_Faculty::get_table_name());
        $this->db->where('user_id', $user_id);

        return $this->db->get()->row_array();
    }

}

