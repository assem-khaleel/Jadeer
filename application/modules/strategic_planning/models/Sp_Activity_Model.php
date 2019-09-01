<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 * Class Sp_Activity_Model
 */
class Sp_Activity_Model extends CI_Model
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

        $this->db->select('sa.*');
        $this->db->distinct();
        $this->db->from(Orm_Sp_Activity::get_table_name().' AS sa');

        if (isset($filters['strategy_id'])) {
            $this->db->join(Orm_Sp_Project::get_table_name().' AS sp', 'sp.id = sa.project_id', 'left');
            $this->db->join(Orm_Sp_Action_Plan::get_table_name().' AS sap', 'sap.id = sp.action_plan_id', 'left');
            $this->db->join(Orm_Sp_Initiative::get_table_name().' AS si', 'si.id = sap.initiative_id', 'left');
            $this->db->join(Orm_Sp_Objective::get_table_name().' AS so', 'so.id = si.objective_id', 'left');
            $this->db->join(Orm_Sp_Strategy::get_table_name().' AS ss', 'so.strategy_id = ss.id', 'left');
            $this->db->where('so.strategy_id', $filters['strategy_id']);
        }

        if (isset($filters['id'])) {
            $this->db->where('sa.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('sa.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('sa.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('sa.id', $filters['not_in_id']);
        }
        if (isset($filters['project_id'])) {
            $this->db->where('sa.project_id', $filters['project_id']);
        }
        if (!empty($filters['title_en'])) {
            $this->db->where('sa.title_en', $filters['title_en']);
        }
        if (!empty($filters['title_ar'])) {
            $this->db->where('sa.title_ar', $filters['title_ar']);
        }
        if (!empty($filters['start_date'])) {
            $this->db->where('sa.start_date', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $this->db->where('sa.end_date', $filters['end_date']);
        }
        if (!empty($filters['weight'])) {
            $this->db->where('sa.weight', $filters['weight']);
        }
        if (!empty($filters['value'])) {
            $this->db->where('sa.value', $filters['value']);
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
                return Orm_Sp_Activity::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach ($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Sp_Activity::to_object($row);
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
        $this->db->insert(Orm_Sp_Activity::get_table_name(), $params);
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
        return $this->db->update(Orm_Sp_Activity::get_table_name(), $params, array('id' => (int)$id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->db->delete(Orm_Sp_Activity::get_table_name(), array('id' => (int)$id));
    }

}

