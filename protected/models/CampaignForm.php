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

	public function apphbPostData()
	{
		return json_encode(array(
			'myEvent' => array(
				'EventName' => $this->name,
				'EventVenue' => $this->venue,
				'EventStatus' => 3,
				),
			));
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