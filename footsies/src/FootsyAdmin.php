<?php

use SilverStripe\Admin\ModelAdmin;
/*
	This will be a new tab only viewable by admins
	
	- !Home footer -- This is only on the home page so I just put it in the homepage backend.
	- regular footer
	
	will show each page in the site tree with a check mark by them ????
	
*/
class FootsyAdmin extends ModelAdmin {
	public static $managed_models = array(
		'Footsy',
		'HomeFootsy'
	);
	
	static $url_segment = 'footsies';
	static $menu_title = 'Footsies';
	
	static $set_page_length = 100;
	
	var $showImportForm = false;
}