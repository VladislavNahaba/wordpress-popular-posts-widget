<?php
/**
 * Plugin Name: Popular Posts
 * Description: Widget that shows popular posts
 * Plugin URI:
 * Author URI:
 * Author:      Nahaba Vadilslav
 * Version:     1.0
 * Text Domain: popular-posts
 */

/*  Copyright ГОД  Nahaba Vladislav  (email: nahabavladislav@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
define( 'POPLAR_VERSION', '1.0' );
define( 'POPULAR_SLUG', 'popular-posts' );
define( 'POPULAR_DIR', plugin_dir_path(__FILE__) );
define( 'POPULAR_URL', plugin_dir_url(__FILE__) );
require_once  __DIR__ . '/lib/dropdown_categories_multiple.php';
require_once __DIR__ . '/lib/popularPostsWidget.php';
new popularPostsWidget();

function popular_posts_widget_register() {
	register_widget( 'popularPostsWidget' );
}
add_action( 'widgets_init', 'popular_posts_widget_register' );
