<?php

class CampaignForm extends CFormModel
{
	public $form;
	public $name;
	public $venue;
	public $startDate;
	public $endDate;
	public $budget;
	public $wizard;
	public $tags;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('form, name, venue, startDate, budget', 'required'),
			array('startDate, endDate', 'date'),
			array('wizard, tags', 'safe'),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
		);
	}

	public function createEventData()
	{
		return array(
			'myEvent' => array(
				'EventName' => $this->name,
				'EventVenue' => $this->venue,
				'EventStatus' => 3,
				),
			);
	}

	public function createFormData()
	{
		return array(
			'myFormBuilder' => array(
				'FormName' => $this->form,
				'FormInput' => 'First Name|Last Name',
				'FormInputType' => 'Text|Text',
				'AuthorComID' => '0B4254C4-0BEF-4642-8CAB-CF9B51A6EFAC',
				),
			);
	}

	public function createTagsData()
	{
		$tags = array();
		foreach ($this->tags as $t)
			$tags[] = array('TagName' => $t);
		return array(
			'EventID' => '7',
			'Tags' => $tags,
			);
	}

	public static function getSessionInstance($name)
	{
		if (Yii::app()->session[$name] instanceof CampaignForm)
			$model = Yii::app()->session[$name];
		else {
			Yii::app()->session[$name] = new CampaignForm;
			$model = Yii::app()->session[$name];
		}
		return $model;
	}
}