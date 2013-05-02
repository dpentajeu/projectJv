<?php

class CampaignForm extends CFormModel
{
	public $name;
	public $venue;
	public $startDate;
	public $endDate;
	public $remarks;
	public $budget;
	public $wizard;
	public $tags;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('name, venue, startDate, budget', 'required'),
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
}