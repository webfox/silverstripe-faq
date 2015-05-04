<?php


class FaqSegment extends DataObject {

	private static $db = [
		'Title'     => 'Varchar(255)',
		'Answer'   => 'HTMLText',
		'SortOrder' => 'Int'
	];

	private static $has_one = [
		'Page' => 'Page'
	];

	private static $default_sort = 'SortOrder';

	private static $field_labels = [
		'Title'   => 'Question',
		'Answer' => 'Answer'
	];

	public function getCMSFields(){

	    $this->beforeUpdateCMSFields(function(FieldList $fields) {

		    $fields->addFieldsToTab('Root.Main', [
			    TextField::create('Title', 'Question'),
		        HtmlEditorField::create('Answer', 'Answer')->setRows(20)
		    ]);

		    $fields->removeByName('SortOrder');
		    $fields->removeByName('PageID');
		});

		$fields = parent::getCMSFields();

		return $fields;
	}
}