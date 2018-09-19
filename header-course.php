<!DOCTYPE html>
<html lang="en" >
<head>
    <?php wp_head() ?>
</head>
<body <?php body_class() ?>>

	<header class="diy_menu">

		<?php



		if(has_nav_menu('course_menu')){
			wp_nav_menu(
					array('theme_location' => 'course_menu')
				);
		} ?>

	</header>