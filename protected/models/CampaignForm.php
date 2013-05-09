<?php

class CampaignForm extends CFormModel
{
	public $customerId;
	public $companyId;
	public $companyName;
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
				'fetch' => array(
					'eventId' => 'EventID',
					),
				),
			'step3'=>array(
				'method' => 'createFormData',
				'fetch' => array(),
				),
			'step4'=>array(
				'method' => 'createTagsData',
				'fetch' => array(),
				),
			);
		if (!isset($_GET['step']))
			return 'createcampaign';

		try {
			switch ($_GET['step']) {
				case '2':
					$this->attributes = $_POST['CampaignForm'];
					$url = "http://listoprototype.apphb.com/ListoEvent.svc/CreateEvent";
					break;

				case '3':
					$this->wizard = $_POST['wizard'];
					$this->formInput = $_POST['formInput'];
					$this->formType = $_POST['formType'];
					$url = "http://listoprototype.apphb.com/ListoForm.svc/CreateForm";
					break;

				case '4':
					$this->tags = $_POST['tags'];
					$url = "http://listoprototype.apphb.com/ListoTag.svc/CreateTags";
					break;

				default:
					throw new Exception("Page not found", 404);
					break;
			}
			$page = "step{$_GET['step']}";
			$post = call_user_func(array($this, $method[$page]['method']));
			$curl = Yii::app()->curl;
			$curl->setOption(CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
			$data = $curl->post($url, json_encode($post));
			$data = json_decode($data, true);

			if (!isset($data['Data']))
				throw new Exception("API call fail.", 500);

			foreach ($method[$page]['fetch'] as $key => $value)
				$this->{$key} = $data['Data'][$value];
		} catch (Exception $e) {
			$err = $e->getErrorCode();
			if (!in_array($err, array(404, 500)))
				$err = 404;
			throw new CHttpException($err, $e->getMessage());
		}
		return $page;
	}
}