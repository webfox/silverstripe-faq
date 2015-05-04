<?php

class FrequentlyAskedQuestionsExtension extends SiteTreeExtension {

	private static $has_many = [
		'Faqs' => 'FaqSegment'
	];

	public function updateCMSFields(FieldList $fields) {

		/** @var GridFieldConfig $gridConfig */
		$gridConfig = GridFieldConfig::create();

		$gridConfig
			->addComponent(new GridFieldButtonRow('before'))
			->addComponent(new GridFieldAddNewButton('buttons-before-left'))
			->addComponent(new GridFieldToolbarHeader())
			->addComponent(new GridFieldTitleHeader())
			->addComponent(new GridFieldSortableRows('SortOrder'))
			->addComponent($dataColumns = new GridFieldDataColumns())
			->addComponent(new GridFieldEditButton())
			->addComponent(new GridFieldDeleteAction())
			->addComponent(new GridFieldDetailForm());

		$dataColumns->setDisplayFields([
			'Title'          => 'Question',
			'Answer.Summary' => 'Answer Preview',
		]);

		$GridField = GridField::create('FaqSegments', 'FAQs', $this->owner->Faqs(), $gridConfig);

		$fields->addFieldToTab('Root.FaqSegments', $GridField);

		return $fields;
	}

}