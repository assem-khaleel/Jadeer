<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * @property CI_DB_query_builder $db
 * Class Survey_Evaluator_Model
 */
class Survey_Evaluator_Model extends CI_Model
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

        //Added by M.D.
        if (!isset($filters['semester_id']) && !isset($filters['academic_year']))
        {
            $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();
        }

        $page = (int)$page;
        $per_page = (int)$per_page;

        $this->db->select('se.*');
        $this->db->distinct();
        $this->db->from(Orm_Survey_Evaluator::get_table_name().' AS se');

        if (isset($filters['id'])) {
            $this->db->where('se.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('se.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('se.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('se.id', $filters['not_in_id']);
        }
        if (isset($filters['survey_evaluation_id'])) {
            $this->db->where('se.survey_evaluation_id', $filters['survey_evaluation_id']);
        }
        if (isset($filters['user_id'])) {
            $this->db->where('se.user_id', $filters['user_id']);
        }
        if (!empty($filters['hash_code'])) {
            $this->db->where('se.hash_code', $filters['hash_code']);
        }
        if (!empty($filters['response_status'])) {
            $this->db->where('se.response_status', $filters['response_status']);
        }
        if (!empty($filters['response_date'])) {
            $this->db->where('se.response_date', $filters['response_date']);
        }
        if (isset($filters['semester_id']) || isset($filters['survey_id']) || isset($filters['academic_year'])) {
            $this->db->join(Orm_Survey_Evaluation::get_table_name() . ' AS sev','sev.id = se.survey_evaluation_id','inner');
            $this->db->join(Orm_Survey::get_table_name() . ' AS sr','sr.id = sev.survey_id AND sr.is_deleted = 0','inner');
        }
        if (isset($filters['semester_id'])) {
            $this->db->where('sev.semester_id', $filters['semester_id']);
        }
        if (isset($filters['academic_year'])) {
            $this->db->join(Orm_Semester::get_table_name().' AS s','s.id = sev.semester_id','inner');
            $this->db->where('s.year', $filters['academic_year']);
        }
        if (isset($filters['survey_id'])) {
            $this->db->where('sev.survey_id', $filters['survey_id']);
        }
        if (isset($filters['survey_in'])) {
            $this->db->where_in('sev.survey_id', $filters['survey_in']);
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
                return Orm_Survey_Evaluator::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach ($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Survey_Evaluator::to_object($row);
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
        $this->db->insert(Orm_Survey_Evaluator::get_table_name(), $params);
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
        return $this->db->update(Orm_Survey_Evaluator::get_table_name(), $params, array('id' => (int)$id));
    }

    /**
     * delete item
     * @param int $id
     * @return boolean
     */
    public function delete($id) {

        $this->delete_response($id);

        return $this->db->delete(Orm_Survey_Evaluator::get_table_name(), array('id' => (int) $id));
    }

    /**
     * this function delete response by its id
     * @param int $id $id the id of the delete response to be viewed
     * @redirect success or error
     */
    public function delete_response($id) {

        $this->db->delete(Orm_Survey_User_Response_Choice::get_table_name(), array('survey_evaluator_id' => (int) $id));
        $this->db->delete(Orm_Survey_User_Response_Factor::get_table_name(), array('survey_evaluator_id' => (int) $id));
        $this->db->delete(Orm_Survey_User_Response_Text::get_table_name(), array('survey_evaluator_id' => (int) $id));

    }
    /**
     * this function get user ids by its evaluation id and as query
     * @param int $evaluation_id the evaluation id of the get user ids to be call function
     * @param bool $as_query the as query of the get user ids to be call function
     * @return array|string the call function
     */
    public function get_user_ids($evaluation_id, $as_query = false) {
        $this->db->select('se.user_id');
        $this->db->distinct();
        $this->db->from(Orm_Survey_Evaluator::get_table_name().' AS se');
        $this->db->where('se.survey_evaluation_id', $evaluation_id);

        $result_array = $this->db->get()->result_array();

        if($as_query) {
            return $this->db->last_query();
        }

        return array_column($result_array, 'user_id');
    }

}

