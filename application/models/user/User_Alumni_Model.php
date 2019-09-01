<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Orm::get_ci_model('User_Model', 'user');

class User_Alumni_Model extends User_Model
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

        $this->db->select(['ua.*', Orm_User::get_table_name().'.*']);
        $this->db->distinct();
        $this->db->from(Orm_User_Alumni::get_table_name().' AS ua');

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
                return Orm_User_Alumni::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach ($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_User_Alumni::to_object($row);
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

    public function get_filters($filters, $alias = 'ua')
    {

        $this->db->join(Orm_User::get_table_name(), Orm_User::get_table_name().".id = {$alias}.user_id", 'INNER');

        parent::get_filters($filters, Orm_User::get_table_name());

        if (isset($filters['user_id'])) {
            $this->db->where("{$alias}.user_id", $filters['user_id']);
        }
        if (!empty($filters['college_id'])) {
            $this->db->where("{$alias}.college_id", $filters['college_id']);
        }
        if (!empty($filters['department_id'])) {
            $this->db->where("{$alias}.department_id", $filters['department_id']);
        }
        if (!empty($filters['program_id'])) {
            $this->db->where("{$alias}.program_id", $filters['program_id']);
        }
        if (isset($filters['graduated'])) {
            $this->db->where("{$alias}.graduated", $filters['graduated']);
        }
    }

    /**
     * replace new row to the table
     * @param array $params
     * @return int
     */
    public function replace($params = array())
    {
        return $this->db->replace(Orm_User_Alumni::get_table_name(), $params);
    }

    public function get_by_user_id($user_id)
    {

        $this->db->select('*');
        $this->db->distinct();
        $this->db->from(Orm_User_Alumni::get_table_name());
        $this->db->where('user_id', $user_id);

        return $this->db->get()->row_array();
    }

}

