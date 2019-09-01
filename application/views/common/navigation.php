<?php
// Load config file
$this->load->config('navigation');
// Get breadcrumbs display options
$navigation = $this->config->item('navigation');

/**
 * @param $item
 * @return bool
 */
if(!function_exists('check_credentials')) {
    function check_credentials($item) {
        if(isset($item['credential']) && $item['credential']) {
            return true;
        } elseif (isset($item['items']) && $item['items']) {
            $credential = false;
            foreach ($item['items'] as $menu_item) {
                $credential = ($credential || check_credentials($menu_item));
            }
            return $credential;
        }

        return false;
    }
}

/**
 * @param $navigation
 * @param $active_menu
 * @param bool $show_order (show the menu item order to help you to find the correct order of the module while development).
 * @return string
 */
if(!function_exists('get_navigation')) {
    function get_navigation($navigation, $active_menu, $show_order = false) {

        uasort($navigation, function ($first, $second) {
            return $first['order'] - $second['order'];
        });

        $html = '';
        foreach ($navigation as $menu => $item) {

            if(check_credentials($item)) {

                $html .= '<li class="px-nav-item' . (isset($item['items']) && $item['items'] ? ' px-nav-dropdown' : '') . ($active_menu == $menu ? ' active' : '') . '">';
                $html .= '<a href="' . (isset($item['link']) ? $item['link'] : '#') . '" '. (!empty($item['extra_class']) ? "class='{$item['extra_class']}'" : '') .'>' . (!empty($item['icon']) ? "<i class='px-nav-icon {$item['icon']}'></i>" : '') . '<span class="px-nav-label">' . (isset($item['title']) ? $item['title'] : '') . ($show_order ? ' ' . $item['order'] : '') . '</span></a>';

                if (isset($item['items']) && $item['items']) {

                    $html .= '<ul class="px-nav-dropdown-menu">';
                    $html .= get_navigation($item['items'], $active_menu);
                    $html .= '</ul>';
                }

                $html .= '</li>';

            }

        }

        return $html;
    }
}
// px-nav-expand
?>

<nav class="px-nav px-nav-left" id="px-nav" >
    <button type="button" class="px-nav-toggle" data-toggle="px-nav" onclick="extend($(this))">
        <span class="px-nav-toggle-arrow"></span>
        <span class="navbar-toggle-icon"></span>
        <span class="px-nav-toggle-label font-size-11">HIDE MENU</span>
    </button>

    <ul class="px-nav-content" id="px-nav-box">
        <?php echo get_navigation($navigation, (isset($menu_tab) ? $menu_tab : ''),false) ?>
    </ul>

    <script>
        pxInit.unshift(function () {
            $('#px-nav').pxNav();
        });
    </script>
</nav>
