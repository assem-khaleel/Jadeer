<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sp_Action_Plan_Model extends CI_Model
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

        $this->db->select('sap.*');
        $this->db->distinct();
        $this->db->from(Orm_Sp_Action_Plan::get_table_name().' AS sap');

        if (isset($filters['objective_id']) || isset($filters['strategy_id'])) {
            $this->db->join(Orm_Sp_Initiative::get_table_name().' AS si', 'si.id = sap.initiative_id', 'left');
        }

        if (isset($filters['strategy_id'])) {
            $this->db->join(Orm_Sp_Objective::get_table_name().' AS so', 'so.id = si.objective_id', 'left');
            $this->db->join(Orm_Sp_Strategy::get_table_name().' AS ss', 'so.strategy_id = ss.id', 'left');
            $this->db->where('so.strategy_id', $filters['strategy_id']);
        }
        if (isset($filters['has_project'])) {
            $this->db->join(Orm_Sp_Project::get_table_name().' AS spp', 'spp.action_plan_id = sap.id', 'inner');
        }

        if (isset($filters['objective_id'])) {
            $this->db->where('si.objective_id', $filters['objective_id']);
        }

        if (isset($filters['id'])) {
            $this->db->where('sap.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('sap.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('sap.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('sap.id', $filters['not_in_id']);
        }
        if (isset($filters['initiative_id'])) {
            $this->db->where('sap.initiative_id', $filters['initiative_id']);
        }
        if (isset($filters['responsible_id'])) {
            $this->db->where('sap.responsible_id', $filters['responsible_id']);
        }
        if (isset($filters['responsible_id_in'])) {
            $this->db->where_in('sap.responsible_id', $filters['responsible_id_in']);
        }
        if (!empty($filters['title_en'])) {
            $this->db->where('sap.title_en', $filters['title_en']);
        }
        if (!empty($filters['title_ar'])) {
            $this->db->where('sap.title_ar', $filters['title_ar']);
        }
        if (!empty($filters['start_date'])) {
            $this->db->where('sap.start_date', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $this->db->where('sap.end_date', $filters['end_date']);
        }
        if (!empty($filters['budget'])) {
            $this->db->where('sap.budget', $filters['budget']);
        }
        if (!empty($filters['resources'])) {
            $this->db->where('sap.resources', $filters['resources']);
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
                return Orm_Sp_Action_Plan::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach ($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Sp_Action_Plan::to_object($row);
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
        $this->db->insert(Orm_Sp_Action_Plan::get_table_name(), $params);
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
        return $this->db->update(Orm_Sp_Action_Plan::get_table_name(), $params, array('id' => (int)$id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->db->delete(Orm_Sp_Action_Plan::get_table_name(), array('id' => (int)$id));
    }
    /**
     * this function get activities by its id and filters
     * @param int $id the id of the get activities to be call function
     * @param array $filters the filters of the get activities to be call function
     * @return mixed the call function
     */
    public function get_activities($id, $filters = array()) {
        $this->db->select('sa.*, sp.title_en as project_title_en, sp.title_ar as project_title_ar, sp.start_date as project_start_date, sp.end_date as project_end_date, sp.budget as project_budget');
        $this->db->distinct();
        $this->db->from(Orm_Sp_Project::get_table_name().' AS sp');
        $this->db->join(Orm_Sp_Activity::get_table_name().' AS sa', 'sa.project_id = sp.id', 'inner');
        $this->db->where('sp.action_plan_id', $id);

        if (!empty($filters['title_en'])) {
            $this->db->like('sap.title_en', $filters['title_en']);
        }
        if (!empty($filters['title_ar'])) {
            $this->db->like('sa.title_ar', $filters['title_ar']);
        }
        if (!empty($filters['start_date'])) {
            $this->db->where('sa.start_date', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $this->db->where('sa.end_date', $filters['end_date']);
        }
        if (!empty($filters['budget'])) {
            $this->db->where('sa.budget', $filters['budget']);
        }
        if (!empty($filters['resources'])) {
            $this->db->where('sa.resources', $filters['resources']);
        }
        $this->db->order_by('sp.start_date asc, sa.start_date asc');

        return $this->db->get()->result_array();
    }

    /**
     * this function get recommendations by its id
     * @param int $id the id of the get recommendations to be call function
     * @return array the call function
     */
    public function get_recommendations($id) {
        $this->db->select('srt.*, sr.id as recommend_id, sr.title_en as recommend_title_en, sr.title_ar as recommend_title_ar, sr.recommendation_type_id as type_id');
        $this->db->distinct();
        $this->db->from(Orm_Sp_Action_Plan_Recommend::get_table_name().' AS sapr');
        $this->db->join(Orm_Sp_Recommendation::get_table_name().' AS sr', 'sr.id = sapr.recommend_id', 'inner');
        $this->db->join(Orm_Sp_Recommendation_Type::get_table_name().' AS srt', 'sr.recommendation_type_id = srt.id', 'left');
        $this->db->where('sapr.action_plan_id', $id);

        $this->db->order_by('srt.id asc');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    /**
     * this function get child total budget by its action plan id
     * @param int $action_plan_id the action plan id of the get child total budget to be call function
     * @return int the call function
     */
    public function get_child_total_budget($action_plan_id) {

        $this->db->select('SUM(budget) total');
        $this->db->from(Orm_Sp_Project::get_table_name());
        $this->db->where('action_plan_id', $action_plan_id);
        $result = $this->db->get()->row_array();

        return isset($result['total']) ? $result['total'] : 0;
    }
    /**
     * this function get date range by its action plan id and type
     * @param int $action_plan_id the action plan id of the get date range to be call function
     * @param string $type the type of the get date range to be call function
     * @return string the call function
     */
    public function get_date_range($action_plan_id, $type = 'start_date'){

        if($type == 'start_date') {
            $this->db->select_min('start_date');
        } else {
            $this->db->select_max('end_date');
        }

        $this->db->where('action_plan_id', $action_plan_id);
        $range = $this->db->get(Orm_Sp_Project::get_table_name())->row_array();

        return isset($range[$type]) ? $range[$type] : '0000-00-00';
    }
}

