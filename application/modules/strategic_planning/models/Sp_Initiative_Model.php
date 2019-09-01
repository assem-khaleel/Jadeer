<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sp_Initiative_Model extends CI_Model
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

        $this->db->select('si.*');
        $this->db->distinct();
        $this->db->from(Orm_Sp_Initiative::get_table_name().' AS si');

        if (isset($filters['strategy_id'])) {
            $this->db->join(Orm_Sp_Objective::get_table_name().' AS so', 'so.id = si.objective_id', 'left');
            $this->db->join(Orm_Sp_Strategy::get_table_name().' AS ss', 'so.strategy_id = ss.id', 'left');
            $this->db->where('so.strategy_id', $filters['strategy_id']);
        }

        if (isset($filters['id'])) {
            $this->db->where('si.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('si.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('si.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('si.id', $filters['not_in_id']);
        }
        if (isset($filters['objective_id'])) {
            $this->db->where('si.objective_id', $filters['objective_id']);
        }
        if (isset($filters['owner_id'])) {
            $this->db->where('si.owner_id', $filters['owner_id']);
        }
        if (!empty($filters['start_date'])) {
            $this->db->where('si.start_date', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $this->db->where('si.end_date', $filters['end_date']);
        }
        if (!empty($filters['code'])) {
            $this->db->where('si.code', $filters['code']);
        }
        if (!empty($filters['title_en'])) {
            $this->db->where('si.title_en', $filters['title_en']);
        }
        if (!empty($filters['title_ar'])) {
            $this->db->where('si.title_ar', $filters['title_ar']);
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
                return Orm_Sp_Initiative::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach ($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Sp_Initiative::to_object($row);
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
        $this->db->insert(Orm_Sp_Initiative::get_table_name(), $params);
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
        return $this->db->update(Orm_Sp_Initiative::get_table_name(), $params, array('id' => (int)$id));
    }

    /**
     * delete item
     *
     * @param int $id sp_initiative
     * @return boolean
     */
    public function delete($id)
    {
        return $this->db->delete(Orm_Sp_Initiative::get_table_name(), array('id' => (int)$id));
    }
    /**
     * this function get date range by its initiative id and type
     * @param int $initiative_id the initiative id of the get date range to be call function
     * @param string $type the type of the get date range to be call function
     * @return string the call function
     */
    public function get_date_range($initiative_id, $type = 'start_date'){

        if($type == 'start_date') {
            $this->db->select_min('start_date');
        } else {
            $this->db->select_max('end_date');
        }

        $this->db->where('initiative_id', $initiative_id);
        $range = $this->db->get(Orm_Sp_Action_Plan::get_table_name())->row_array();

        return isset($range[$type]) ? $range[$type] : '0000-00-00';
    }
}

