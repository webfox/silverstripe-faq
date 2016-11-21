<?php

class FrequentlyAskedQuestionsExtension extends SiteTreeExtension
{

    private static $has_many = [
        'Faqs' => 'FaqSegment'
    ];

    public function updateCMSFields(FieldList $fields)
    {

        /** @var GridFieldConfig $gridConfig */
        $gridConfig = GridFieldConfig::create();

        $gridConfig
            ->addComponent(new GridFieldButtonRow('before'))
            ->addComponent(new GridFieldAddNewButton('buttons-before-left'))
            ->addComponent(new GridFieldToolbarHeader())
            ->addComponent(new  GridFieldSortableHeader())
            ->addComponent(new GridFieldOrderableRows('SortOrder'))
            ->addComponent($dataColumns = new GridFieldDataColumns())
            ->addComponent(new GridFieldEditButton())
            ->addComponent(new GridFieldDeleteAction())
            ->addComponent(new GridFieldDetailForm());

        $dataColumns->setDisplayFields([
            'Title' => 'Question',
            'Answer.Summary' => 'Answer Preview',
        ]);

        /** @var TabSet $rootTab */
        //We need to repush Metadata to ensure it is the last tab
        $rootTab = $fields->fieldByName('Root');
        if ($this->owner->exists()) {
            $rootTab->push(Tab::create('FaqSegments'));
        }

        $GridField = GridField::create('FaqSegments', 'FAQs', $this->owner->Faqs(), $gridConfig);

        if ($this->owner->exists()) {
            $fields->addFieldToTab('Root.FaqSegments', $GridField);
        }
        $fields->removeByName('Faqs');
        return $fields;
    }
}
