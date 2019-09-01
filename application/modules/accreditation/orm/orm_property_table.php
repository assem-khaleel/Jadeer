<?php

/**
 *  E.G
 *
 * public function set_table($value) {
 * $property = new \Orm_Property_Table('table', $value);
 *
 * $property->add_cell(1, 1, new \Orm_Property_Fixedtext('header_1', 'header 1'));
 * $property->add_cell(1, 2, new \Orm_Property_Fixedtext('header_1', 'header 1'), 0, 2);
 * $property->add_cell(1, 3, new \Orm_Property_Fixedtext('header_1', 'header 1'));
 *
 * $text_1 = new \Orm_Property_Text('text_1');
 * $text_1->add_validator('required_field_validator');
 *
 * $property->add_cell(2, 1, $text_1);
 * $property->add_cell(2, 2, new \Orm_Property_Text('text_2'));
 * $property->add_cell(2, 3, new \Orm_Property_Text('text_3'));
 * $property->add_cell(2, 4, new \Orm_Property_Text('text_4'));
 *
 * $property->add_cell(3, 1, new \Orm_Property_Text('text_1'));
 * $property->add_cell(3, 2, new \Orm_Property_Text('text_2'));
 * $property->add_cell(3, 3, new \Orm_Property_Text('text_3'));
 * $property->add_cell(3, 4, new \Orm_Property_Text('text_4'));
 *
 * $this->set_property($property);
 * }
 *
 * public function get_table() {
 * return $this->get_property('table')->get_value();
 * }
 */
class Orm_Property_Table extends Orm_Property
{

    protected $value = array();
    protected $cells;
    protected $cell_rowspan;
    protected $cell_colspan;
    protected $is_responsive = false;

    public function set_is_responsive($value)
    {
        $this->is_responsive = $value;
    }

    public function get_is_responsive()
    {
        return $this->is_responsive;
    }

    public function add_cell($row, $column, Orm_Property $property, $rowspan = 0, $colspan = 0)
    {

        if ($property instanceof Orm_Property_Add_More) {
            return;
        }

        $this->cells[$row][$column][$property->get_name()] = $property;

        if ($rowspan > 1) {
            $this->cell_rowspan[$row][$column] = $rowspan;
        }

        if ($colspan > 1) {
            $this->cell_colspan[$row][$column] = $colspan;
        }
    }

    public function get_cell($row, $column)
    {
        return (isset($this->cells[$row][$column]) ? $this->cells[$row][$column] : array());
    }

    public function get_cells($row = null)
    {
        if (is_null($row)) {
            return $this->cells;
        }
        return (isset($this->cells[$row]) ? $this->cells[$row] : array());
    }

    /**
     * @param int $row
     * @param int $column
     * @return Orm_Property
     */
    public function get_cell_property($row, $column)
    {
        $cell = $this->get_cell($row, $column);
        $name = key($cell);
        $property = (isset($cell[$name]) ? $cell[$name] : new Orm_Property(''));

        if (!($property instanceof Orm_Property_Fixedtext)) {
            $property->set_name("{$this->get_name()}][{$row}][{$column}][{$name}");
            $property->set_value($this->get_specific_value($row, $column, $name));
        }

        return $property;
    }

    public function get_specific_value($row, $column, $name)
    {
        return (isset($this->value[$row][$column][$name]) ? $this->value[$row][$column][$name] : '');
    }

    public function validat()
    {
        for ($row = 1; $row <= count($this->get_cells()); $row++) {
            for ($column = 1; $column <= count($this->get_cells($row)); $column++) {
                $this->get_cell_property($row, $column)->validat();
            }
        }
    }

    public function draw_html()
    {

        if ($this->get_readonly()) {
            return $this->draw_report();
        }

        $html = '';

        if ($this->get_is_responsive()) {
            $html .= '<p><small style="color: #89cded;">Please scroll right to fill required information</small></p>';
        }

        $html .= '<div class="table-primary table-responsive">';
        $html .= '<table class="table table-striped table-bordered">';
        for ($row = 1; $row <= count($this->get_cells()); $row++) {
            $html .= '<tr>';
            for ($column = 1; $column <= count($this->get_cells($row)); $column++) {

                $rowspan = (empty($this->cell_rowspan[$row][$column]) ? '' : ' rowspan="' . $this->cell_rowspan[$row][$column] . '"');
                $colspan = (empty($this->cell_colspan[$row][$column]) ? '' : ' colspan="' . $this->cell_colspan[$row][$column] . '"');

                $html .= "<td{$rowspan}{$colspan}>";
                $html .= $this->get_cell_property($row, $column)->draw_html();
                $html .= '</td>';
            }
            $html .= '</tr>';
        }
        $html .= '</table>';
        $html .= '</div>';

        if ($this->get_is_responsive()) {
            $html .= '<p><small style="color: #89cded;">Please scroll right to fill required information</small></p>';
        }

        return $this->draw_html_wrapper($html);
    }

    public function draw_report($pdf = false)
    {
        $responsive = $pdf ? '' : ' table-responsive';

        $html = '<div class="table-primary'.$responsive.'">';
        $html .= '<table class="table table-striped table-bordered" border="1">';
        for ($row = 1; $row <= count($this->get_cells()); $row++) {
            $html .= '<tr>';
            for ($column = 1; $column <= count($this->get_cells($row)); $column++) {

                $rowspan = (empty($this->cell_rowspan[$row][$column]) ? '' : ' rowspan="' . $this->cell_rowspan[$row][$column] . '"');
                $colspan = (empty($this->cell_colspan[$row][$column]) ? '' : ' colspan="' . $this->cell_colspan[$row][$column] . '"');

                $property = $this->get_cell_property($row, $column);

                $width = $property->get_width() ? (' width:' . ($pdf ? ($property->get_width() / 2) : $property->get_width()) . 'px;') : '';
                $style = $pdf ? " style='font-size:10px;{$width}'" : '';

                $html .= "<td{$rowspan}{$colspan}{$style}>";
                $html .= $property->draw_report($pdf);
                $html .= '</td>';
            }
            $html .= '</tr>';
        }
        $html .= '</table>';
        $html .= '</div>';

        return $this->draw_report_wrapper($html);
    }

    public function generate_ams_property(&$ams_form = array(), $ams_file = null, $class_type = null)
    {

        $ams_table = array();
        $index = 0;

        for ($row = 1; $row <= count($this->get_cells()); $row++) {
            for ($column = 1; $column <= count($this->get_cells($row)); $column++) {
                $property = $this->get_cell_property($row, $column);
                if (!($property instanceof Orm_Property_Fixedtext)) {
                    $property->generate_ams_property($ams_table[$index], $ams_file, $class_type);
                }
            }
            $index++;
        }

        $ams_form[] = array(
            'type' => 'table',
            'field' => $this->get_ams_id($ams_file, $class_type),
            'value' => $ams_table
        );
    }
}
