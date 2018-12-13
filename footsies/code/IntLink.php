<?php

class IntLink extends DataObject {
	static $db = array(
		'Title' => 'Varchar(50)',
		'SortOrder' => 'Int'
	);

	static $has_one = array(
		'icon' => 'BetterImage',
		'Link' => 'SiteTree',
		'Footsy' => 'Footsy'
	);

	static $singular_name = 'IntLink';
	static $plural_name	  = 'IntLinks';

	//static $default_sort = 'SortOrder ASC';

	static $summary_fields = array(
		'Title' => 'Title',
		'Link.Title' => 'Link',
		//'icon.CMSThumbnail.Tag' => 'Icon'
	);
	static $default_sort = 'SortOrder ASC';

	public function getCMSFields() {
		$f = new FieldList();

		$fLink = new TreeDropdownField('LinkID', 'Link to Page', 'SiteTree');
        //$fLink->setEmptyString('Select One...');

        $icon = new UploadField('icon');
		$icon->setFolderName('Uploads/LinkIcons');
		if(!Permission::check('ADMIN')) {
			$icon->removeFolderSelection();
		}

        $f->push(TextField::create('Title')->setTitle('Link Title'));
        $f->push($fLink);
        //$f->push($icon);

        $f->removeByName('SortOrder');

		return $f;
	}

	function FooterLink() {
		if($this->LinkID) {
			//debug::show($this->LinkID);
			$pageLink = SiteTree::get()->byID($this->LinkID);
			return $pageLink->Link();
			//debug::show($pageLink->Link());
		}
	}

	/**
	 * onBeforeWrite function checks to see if title is filled out, if not put the page title from the dropdown in
	 *
	 * @access public
	 * @return void
	 */
	function onBeforeWrite() {
		//debug::show(DataObject::get_by_id('SiteTree', $this->record['LinkID']));
		//die();
		parent::onBeforeWrite();
		if(isset($this->record['Title']) && $this->record['Title'] != '' && $this->record['Title'] != '#') {
			$this->Title = $this->record['Title'];
		} else {
			$t = SiteTree::get()->byID($this->record['LinkID']);
			$this->Title = $t->Title;
		}
	}
}
