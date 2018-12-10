<?php
class ExtLink extends DataObject {
	static $db = array(
		'Title' => 'Varchar(50)',
		'customLink' => 'Varchar(255)',
		'newWindow'  => 'Boolean'
	);
	
	static $has_one = array(
		'icon' => 'BetterImage',
		'Footsy' => 'Footsy'
	);
	
	static $singular_name = 'ExtLink';
	static $plural_name	  = 'ExtLinks';
	
	//static $default_sort = 'SortOrder ASC';
	
	static $summary_fields = array(
		'Title' => 'Title',
		'customLink' => 'Link',
		'newWindow' => 'NewWindow'
	);
	
	public function newWindow() {
		return ($this->newWindow) ? 'Yes' : '';
	}
	
	public function getCMSFields() {
		$f = new FieldList();
		
		$icon = new UploadField('icon');
		$icon->setFolderName('Uploads/LinkIcons');
		if(!Permission::check('ADMIN')) {
			$icon->removeFolderSelection();
		}
		
		$f->push(TextField::create('Title')->setTitle('External Link Title'));
		$f->push(TextField::create('customLink')->setTitle('External Link'));
		$f->push(CheckboxField::create('newWindow')->setTitle('Open link in new window'));
		//$f->push($icon);
		
		return $f;
	}
	
	/**
	 * setHTTP function check the URL string for HTTP and if not present adds it.
	 * 
	 * @access protected
	 * @param mixed $url
	 * @return string
	 */
	protected function setHTTP($url) {
		$pattern	= '/^http/';
		if(preg_match($pattern, $url)) {
			return $url;
		} else {
			return $url = 'http://' . $url;
		}
	}
	
	/**
	 * onBeforeWrite function checks to see if http is on the url, if not run the function setHTTP()
	 * 
	 * @access public
	 * @return void
	 */
	function onBeforeWrite() {
		parent::onBeforeWrite();
		if(isset($this->record['customLink']) && $this->record['customLink'] != '' && $this->record['customLink'] != '#') {
			$this->customLink = $this->setHTTP($this->record['customLink']);
		} else {
			$this->customLink = '#';
		}
	}
}