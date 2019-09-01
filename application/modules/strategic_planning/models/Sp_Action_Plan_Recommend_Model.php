<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sp_Action_Plan_Recommend_Model extends CI_Model
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

        $this->db->select('sapr.*');
        $this->db->distinct();
        $this->db->from(Orm_Sp_Action_Plan_Recommend::get_table_name().' AS sapr');

        if (isset($filters['id'])) {
            $this->db->where('sapr.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('sapr.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('sapr.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('sapr.id', $filters['not_in_id']);
        }
        if (isset($filters['action_plan_id'])) {
            $this->db->where('sapr.action_plan_id', $filters['action_plan_id']);
        }
        if (isset($filters['recommend_id'])) {
            $this->db->where('sapr.recommend_id', $filters['recommend_id']);
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
                return Orm_Sp_Action_Plan_Recommend::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach ($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Sp_Action_Plan_Recommend::to_object($row);
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
        $this->db->insert(Orm_Sp_Action_Plan_Recommend::get_table_name(), $params);
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
        return $this->db->update(Orm_Sp_Action_Plan_Recommend::get_table_name(), $params, array('id' => (int)$id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->db->delete(Orm_Sp_Action_Plan_Recommend::get_table_name(), array('id' => (int)$id));
    }
    /**
     * this function delete all by its filters
     * @param array $filters the filters of the delete all to be call function
     * @return null|bool the call function
     */
    public function delete_all($filters = array()) {
        if (isset($filters['action_plan_id'])) {
            return $this->db->delete(Orm_Sp_Action_Plan_Recommend::get_table_name(), array('action_plan_id' => (int) $filters['action_plan_id']));
        }
        return null;
    }

}

