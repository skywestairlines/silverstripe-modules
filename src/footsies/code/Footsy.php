<?php
class Footsy extends DataObject {
	static $db = array(
		'Title' => 'Varchar(25)',
		'SortOrder' => 'Int(25)'
	);
	
	static $has_many = array(
		'IntLinks' => 'IntLink',
		'ExtLinks' => 'ExtLink'
	);
	
	static $singular_name = 'Footsy';
	static $plural_name	  = 'Footsies';
	
	static $default_sort = 'SortOrder ASC';
	
	static $summary_fields = array(
		'Title' => 'Title'
	);
	
	public function getCMSFields() {
		$f = new FieldList();
		
		$iDom = new GridField(
			'IntLinks',
			'IntLink',
			$this->IntLinks(),
			GridFieldConfig_RelationEditor::create()->addComponent(new GridFieldSortableRows('SortOrder'))
		);
		//$iDom->setPopupWidth('960');
        //$iDom->setAddTitle('Internal Link');
        
        $eDom = new GridField(
			
			'ExtLinks',
			'ExtLink',
			$this->ExtLinks(),
			GridFieldConfig_RelationEditor::create()
		);
		//$eDom->setPopupWidth('960');
        //$eDom->setAddTitle('External Link');
        
        $f->push(TextField::create('Title')->setTitle('Link Title'));
        $f->push(TextField::create('SortOrder'));
        $f->push(new LiteralField('', '<br />'));
        $f->push($iDom);
        $f->push(new LiteralField('', '<br />'));
        $f->push($eDom);
		
		return $f;
	}
}