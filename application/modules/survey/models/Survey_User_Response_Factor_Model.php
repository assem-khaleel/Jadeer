<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey_User_Response_Factor_Model extends CI_Model
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

        $this->db->select('surf.*');
        $this->db->distinct();
        $this->db->from(Orm_Survey_User_Response_Factor::get_table_name().' AS surf');

        if (isset($filters['id'])) {
            $this->db->where('surf.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('surf.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('surf.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('surf.id', $filters['not_in_id']);
        }
        if (isset($filters['question_id'])) {
            $this->db->where('surf.question_id', $filters['question_id']);
        }
        if (isset($filters['survey_evaluator_id'])) {
            $this->db->where('surf.survey_evaluator_id', $filters['survey_evaluator_id']);
        }
        if (isset($filters['statement_id'])) {
            $this->db->where('surf.statement_id', $filters['statement_id']);
        }
        if (!empty($filters['rank'])) {
            $this->db->where('surf.rank', $filters['rank']);
        }

        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        }

        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }

        switch ($fetch_as) {
            case Orm::FETCH_OBJECT:
                return Orm_Survey_User_Response_Factor::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach ($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Survey_User_Response_Factor::to_object($row);
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

    /**
     * insert new row to the table
     *
     * @param array $params
     * @return int
     */
    public function insert($params = array())
    {
        $this->db->insert(Orm_Survey_User_Response_Factor::get_table_name(), $params);
        return $this->db->insert_id();
    }

    /**
     * update item
     *
     * @param int $id
     * @param array $params
     * @return boolean
     */
    public function update($id, $params = array())
    {
        return $this->db->update(Orm_Survey_User_Response_Factor::get_table_name(), $params, array('id' => (int)$id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->db->delete(Orm_Survey_User_Response_Factor::get_table_name(), array('id' => (int)$id));
    }

    /**
     * @param array $filters
     * @return array
     */
    public function get_user_response($filters = array()) {
        $this->db->select('COUNT(DISTINCT surf.survey_evaluator_id) AS count, AVG(surf.rank) AS average');
        $this->db->from(Orm_Survey_User_Response_Factor::get_table_name().' AS surf');

        if (isset($filters['statement_id'])) {
            $this->db->where('surf.statement_id', $filters['statement_id']);
            $this->db->group_by("surf.statement_id");
        }
        if (isset($filters['survey_evaluator_id'])) {
            $this->db->where('surf.survey_evaluator_id', $filters['survey_evaluator_id']);
        }
        if (isset($filters['factor_id'])) {
            $this->db->join(Orm_Survey_Question_Statement::get_table_name() . ' AS sqs', 'surf.statement_id = sqs.id', 'INNER');
            $this->db->where('sqs.factor_id', $filters['factor_id']);
            $this->db->group_by("sqs.factor_id");
        }
        if (isset($filters['evaluation_id']) || isset($filters['class_type']) || isset($filters['semester_id']) || isset($filters['faculty_id'])) {
            $this->db->join(Orm_Survey_Evaluator::get_table_name() . ' AS se', 'surf.survey_evaluator_id = se.id', 'INNER');
        }
        if (isset($filters['faculty_id'])) {
            $this->db->join(Orm_Course_Section_Teacher::get_table_name() . ' AS cst', 'se.user_id = cst.user_id', 'INNER');
            $this->db->join(Orm_Course_Section_Student::get_table_name() . ' AS css', 'cst.section_id = css.section_id', 'INNER');
            $this->db->where('cst.user_id', $filters['faculty_id']);
        }
        if (isset($filters['evaluation_id'])) {
            $this->db->where('se.survey_evaluation_id', $filters['evaluation_id']);
        }
        if (isset($filters['semester_id'])) {
            $this->db->join(Orm_Survey_Evaluation::get_table_name() . ' AS sev', 'se.survey_evaluation_id = sev.id', 'INNER');
            $this->db->where('sev.semester_id', $filters['semester_id']);
        }
        if (!empty($filters['class_type']) && class_exists($filters['class_type'])) {
            $class = $filters['class_type']; /** @var $class Orm_User */
            $table = str_replace('orm_','',strtolower($class));

            $this->db->join($table, "se.user_id = {$table}.user_id", 'INNER');
            $class::get_model()->get_filters($filters, $table);
        }

        return $this->db->get()->row_array();
    }

    /**
     * this function get details user response by its filters
     * @param array $filters  the filters of the get details user response to be call function
     * @return array the call function
     */
    public function get_details_user_response($filters = array()) {

        $this->db->select('round(count(*)/count(distinct surf.statement_id)) AS CNT, surf.rank AS RANK');
        $this->db->from(Orm_Survey_User_Response_Factor::get_table_name().' AS surf');
        $this->db->group_by("surf.rank");

        if (isset($filters['statement_id'])) {
            $this->db->where('surf.statement_id', $filters['statement_id']);
        }
        if (isset($filters['survey_evaluator_id'])) {
            $this->db->where('surf.survey_evaluator_id', $filters['survey_evaluator_id']);
        }
        if (isset($filters['factor_id'])) {
            $this->db->join(Orm_Survey_Question_Statement::get_table_name() . ' AS sqs', 'surf.statement_id = sqs.id', 'INNER');
            $this->db->where('sqs.factor_id', $filters['factor_id']);
        }
        if (isset($filters['evaluation_id']) || isset($filters['class_type']) || isset($filters['semester_id']) || isset($filters['faculty_id'])) {
            $this->db->join(Orm_Survey_Evaluator::get_table_name() . ' AS se', 'surf.survey_evaluator_id = se.id', 'INNER');
        }
        if (isset($filters['faculty_id'])) {
            $this->db->join(Orm_Course_Section_Teacher::get_table_name() . ' AS cst', 'se.user_id = cst.user_id', 'INNER');
            $this->db->join(Orm_Course_Section_Student::get_table_name() . ' AS css', 'cst.section_id = css.section_id', 'INNER');
            $this->db->where('cst.user_id', $filters['faculty_id']);
        }
        if (isset($filters['evaluation_id'])) {
            $this->db->where('se.survey_evaluation_id', $filters['evaluation_id']);
        }
        if (isset($filters['semester_id'])) {
            $this->db->join(Orm_Survey_Evaluation::get_table_name() . ' AS sev', 'se.survey_evaluation_id = sev.id', 'INNER');
            $this->db->where('sev.semester_id', $filters['semester_id']);
        }
        if (!empty($filters['class_type']) && class_exists($filters['class_type'])) {
            $class = $filters['class_type']; /** @var $class Orm_User */
            $table = str_replace('orm_','',strtolower($class));

            $this->db->join($table, "se.user_id = {$table}.user_id", 'INNER');
            $class::get_model()->get_filters($filters, $table);
        }

        $result = $this->db->get()->result_array();

        $ranks_array = array();
        $ranks_array['SD'] = 0;
        $ranks_array['D'] = 0;
        $ranks_array['N'] = 0;
        $ranks_array['A'] = 0;
        $ranks_array['SA'] = 0;

        foreach ($result as $row) {
            switch ($row['RANK']) {
                case 1:
                    $ranks_array['SD'] = $row['CNT'];
                    break;
                case 2:
                    $ranks_array['D'] = $row['CNT'];
                    break;
                case 3:
                    $ranks_array['N'] = $row['CNT'];
                    break;
                case 4:
                    $ranks_array['A'] = $row['CNT'];
                    break;
                case 5:
                    $ranks_array['SA'] = $row['CNT'];
                    break;
            }
        }

        return $ranks_array;
    }

    /**
     * this function get average by its filters
     * @param array $filters  the filters of the get average to be call function
     * @return int the call function
     */
    public function get_average($filters)
    {
        $this->db->select('AVG(rank) as average');
        $this->db->from(Orm_Survey_User_Response_Factor::get_table_name() . ' AS srf ');

        if (!empty($filters['survey_id'])) {
            $this->db->join(Orm_Survey_Question::get_table_name().' AS sq','sq.id = srf.question_id');
            $this->db->join(Orm_Survey_Page::get_table_name().' AS sp','sq.page_id = sp.id');
//            $this->db->join(Orm_Survey::get_table_name().' AS s','sp.survey_id = s.id');

            $this->db->where("sp.survey_id",$filters['survey_id']);
//            $this->db->having('count(qf.id) > 0');
        }

        $result = $this->db->get()->row()->average;

        return  $result ? $result : 0;
    }
}

