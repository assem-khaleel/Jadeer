<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 * Class Survey_User_Response_Text_Model
 */
class Survey_User_Response_Text_Model extends CI_Model
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

        $this->db->select('surt.*');
        $this->db->distinct();
        $this->db->from(Orm_Survey_User_Response_Text::get_table_name().' AS surt');

        if (isset($filters['id'])) {
            $this->db->where('surt.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('surt.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('surt.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('surt.id', $filters['not_in_id']);
        }
        if (isset($filters['question_id'])) {
            $this->db->where('surt.question_id', $filters['question_id']);
        }
        if (isset($filters['survey_evaluator_id'])) {
            $this->db->where('surt.survey_evaluator_id', $filters['survey_evaluator_id']);
        }
        if (!empty($filters['value'])) {
            $this->db->where('surt.value', $filters['value']);
        }
        if (!empty($filters['not_empty'])) {
            $this->db->where('surt.value !=', '');
        }
        if (isset($filters['evaluation_id']) || isset($filters['class_type']) || isset($filters['semester_id']) || isset($filters['faculty_id'])) {
            $this->db->join(Orm_Survey_Evaluator::get_table_name() . ' AS se', 'surt.survey_evaluator_id = se.id', 'INNER');
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

        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        }

        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }

        switch ($fetch_as) {
            case Orm::FETCH_OBJECT:
                return Orm_Survey_User_Response_Text::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach ($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Survey_User_Response_Text::to_object($row);
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
        $this->db->insert(Orm_Survey_User_Response_Text::get_table_name(), $params);
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
        return $this->db->update(Orm_Survey_User_Response_Text::get_table_name(), $params, array('id' => (int)$id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->db->delete(Orm_Survey_User_Response_Text::get_table_name(), array('id' => (int)$id));
    }

}

