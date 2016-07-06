<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Clean Blog
 */

get_header(); ?>

<?php //do_action('cleanblog_index_top'); ?>

        <div ng-view></div>

        <?php //cleanblog_posts_navigation(); ?>

<?php //do_action('cleanblog_index_bottom'); ?>

<?php get_footer(); ?>
