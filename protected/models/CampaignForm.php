<?php

class CampaignForm extends CFormModel
{
	public $customerId;
	public $companyId;
	public $companyName;
	public $formId;
	public $formInput;
	public $formType;
	public $eventId;
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
			array('form, name, venue, startDate, endDate, budget', 'required'),
			array('startDate, endDate', 'date'),
			array('customerId, companyId, companyName, eventId, wizard, tags', 'safe'),
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
				'CustomerId' => $this->customerId,
				'CompanyId' => $this->companyId,
				'EventName' => $this->name,
				'EventVenue' => $this->venue,
				'EventStatus' => 3,
				'EventStart' => date("dmY", strtotime($this->startDate)),
				'EventEnd' => date("dmY", strtotime($this->endDate)),
				),
			);
	}

	public function createFormData()
	{
		return array(
			'myFormBuilder' => array(
				'FormName' => $this->form,
				'FormInput' => $this->formInput,
				'FormInputType' => $this->formType,
				'AuthorComID' => $this->companyId,
				),
			);
	}

	public function createTagsData()
	{
		$tags = array();
		foreach ($this->tags as $t)
			$tags[] = array('TagName' => $t);
		return array(
			'EventID' => $this->eventId,
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

	public function handleCreateCampaign()
	{
		$method = array(
			'step2'=>array(
				'method' => 'createEventData',
				'fetch' => array('eventId' => 'EventID'),
				'put' => array('attributes' => 'CampaignForm'),
				'url' => 'http://listoprototype.apphb.com/ListoEvent.svc/CreateEvent',
				),
			'step3'=>array(
				'method' => 'createFormData',
				'fetch' => array('formId' => 'FormID'),
				'put' => array('wizard', 'formInput', 'formType'),
				'url' => 'http://listoprototype.apphb.com/ListoForm.svc/CreateForm',
				),
			'step4'=>array(
				'method' => 'createTagsData',
				'fetch' => array(),
				'put' => array('tags'),
				'url' => 'http://listoprototype.apphb.com/ListoTag.svc/CreateTags',
				),
			);
		if (!isset($_GET['step']))
			return 'createcampaign';

		try {
			// initialize
			$page = "step{$_GET['step']}";
			foreach ($method[$page]['put'] as $key => $value) {
				if (is_numeric($key))
					$this->{$value} = $_POST[$value];
				else
					$this->{$key} = $_POST[$value];
			}

			$post = call_user_func(array($this, $method[$page]['method']));
			$curl = Yii::app()->curl;
			$curl->setOption(CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
			$data = $curl->post($method[$page]['url'], json_encode($post));
			if ($curl->getInfo(CURLINFO_HTTP_CODE) != 200)
				throw new Exception("API call fail.", $curl->getInfo(CURLINFO_HTTP_CODE));
			$data = json_decode($data, true);

			if (!isset($data['Data']))
				throw new Exception("API call fail.", 500);

			foreach ($method[$page]['fetch'] as $key => $value)
				$this->{$key} = $data['Data'][$value];
		} catch (Exception $e) {
			$err = $e->getCode();
			if (!in_array($err, array(404, 500)))
				$err = 404;
			throw new CHttpException($err, $e->getMessage());
		}
		return $page;
	}
}