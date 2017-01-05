<?php

class View
{

	/*
	$content_file - dynamic content;
	$template_file - main layout;
	$data - data for view.
	*/
	public function generate($content_view, $template_view, $data = null)
	{

		/*
                dynamicly load  main layout, inside main will be build-in
		layout for certain page.
		*/
		include 'application/app/views/'.$template_view;
	}
	
	/**
         * Escape all HTML, JavaScript, and CSS
         * 
         * @param string $input The input string
         * @param string $encoding Which character encoding are we using?
         * @return string
         */
         public function noHTML($input, $encoding = 'UTF-8')
         {
               return htmlentities($input, ENT_QUOTES | ENT_HTML5, $encoding);
         } 
}
