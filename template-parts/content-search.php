<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Clean Blog
 */

?>

<div id="{{ post.id }}">
    <div class="post-preview" ng-repeat="post in posts">
        <h2 class="post-title"><a href="{{ post.link }}" rel="bookmark"> {{post.title.rendered}} </a></h2>
        <post-meta class="post-meta"></post-meta>
        <p class="excerpt" ng-bind-html="post.excerpt.rendered"></p>
        <hr>
    </div>
</div>
<!-- /.post-preview -->