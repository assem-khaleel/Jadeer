<?php

class Orm_Tree_Item extends Orm
{

    private $id = 0;
    private $name = '';
    private $is_finished = 0;
    private $review_status = 'none';
    private $actions = array();
    private $children = array();
    private $indentation = 0;

    public function get_id()
    {
        return $this->id;
    }

    public function set_id($value)
    {
        $this->id = $value;
    }

    public function get_name()
    {
        return $this->name;
    }

    public function set_name($value)
    {
        $this->name = $value;
    }

    public function get_is_finished()
    {
        return $this->is_finished;
    }

    public function set_is_finished($value)
    {
        $this->is_finished = $value;
    }

    public function get_review_status()
    {
        return $this->review_status;
    }

    public function set_review_status($value)
    {
        $this->review_status = $value;
    }

    public function add_action($class, $link, $attr = '', $btn_color = 'btn-default')
    {
        $this->actions[] = array('class' => $class, 'link' => $link, 'attr' => $attr, 'btn_color' => $btn_color);
    }

    public function get_actions()
    {
        return $this->actions;
    }

    public function add_child(Orm_Tree_Item $child)
    {
        $this->children[] = $child;
    }

    public function get_children()
    {
        return $this->children;
    }

    public function get_indentation()
    {
        return $this->indentation;
    }

    public function set_indentation($value)
    {
        $this->indentation = $value;
    }

    public function draw()
    {

        $html = '<div id="item_' . $this->get_id() . '" class="tree-node row">' . "\n";
        $html .= $this->node_indentation();
        $html .= $this->node_indicator();
        $html .= $this->node_title();
        $html .= $this->node_actions();
        $html .= '</div>' . "\n";

        if ($this->get_children()) {
            $html .= '<div id="children_' . $this->get_id() . '" class="tree-children">' . "\n";
            foreach ($this->get_children() as $child) {
                /* @var $child Orm_Tree_Item */
                $html .= $child->draw();
            }
            $html .= '</div>' . "\n";
        }

        return $html;
    }

    public function node_indentation()
    {

        if ($this->get_indentation()) {
            $html = '<div class="indentation">';
            for ($i = 0; $i < $this->get_indentation(); $i++) {
                $color_key = ($i % 5) + 1;
                $html .= "<span class='text-center bg-tree-node-{$color_key}'>";
                if (($i + 1) >= $this->get_indentation()) {
                    $html .= "\n";
                    switch ($this->get_review_status()) {
                        case 'compliant':
                            $html .= '<span class="ion-android-done-all font-size-28" title="' . lang('Form Compliant') . '"></span>';
                            break;
                        case 'not_compliant':
                        case 'partly_compliant':
                            $html .= '<span class="ion-android-warning font-size-28" title="' . lang('Form Partly Compliant') . '"></span>';
                            break;
                        default :
                            if ($this->get_is_finished()) {
                                $html .= '<span class="ion-android-done font-size-28" title="' . lang('Form Saved and Finish') . '"></span>' . "\n";
                            } else {
                                $html .= '<span class="ion-android-close font-size-28" title="' . lang('Form Ongoing or Saved') . '"></span>' . "\n";
                            }
                            break;
                    }
                }
                $html .= '</span>' . "\n";
            }
            $html .= '</div>' . "\n";

            return $html;
        }
    }

    public function node_indicator()
    {
        if ($this->get_children()) {
            $html = '  <span class="tree-branch"></span>' . "\n";
        } else {
            $html = '  <span class="tree-leaf"></span>' . "\n";
        }
        return $html;
    }

    public function node_title()
    {
        return '  <span class="tree-name">' . htmlfilter($this->get_name()) . '</span>' . "\n";
    }

    public function node_actions()
    {
        if ($this->get_actions()) {
            $html = '   <div class="tree-actions">';
            foreach ($this->get_actions() as $action) {
                $link = (empty($action['link']) ? '' : $action['link']);
                $attr = (empty($action['attr']) ? '' : ' ' . $action['attr']);
                $btn_color = (empty($action['btn_color']) ? 'btn-default' : $action['btn_color']);
                $span = (empty($action['class']) ? '' : '<span class="' . $action['class'] . '" aria-hidden="true"></span>');

                $html .= '      <a href="' . $link . '" class="btn ' . $btn_color . ' btn-sm"' . $attr . '>' . $span . '</a>' . "\n";
            }
            $html .= '  </div>' . "\n";

            return $html;
        }
    }

}
