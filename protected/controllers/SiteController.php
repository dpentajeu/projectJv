<?php

class SiteController extends Controller
{
	public $pageTitle = 'Listo - Simple Segment';
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$model=new LoginForm;
		$this->render('index',array('model'=>$model));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				// $this->redirect(Yii::app()->user->returnUrl);
				$this->redirect(array("site/campaign"));
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionCampaign()
	{
		$event = array();
		$form = array();
		$model = CampaignForm::getSessionInstance('campaign');
		try {
			$url = array(
				'event' => "http://listoprototype.apphb.com/ListoEvent.svc/GetEvents",
				'form' => "http://listoprototype.apphb.com/ListoForm.svc/GetFormsByCompanyID?CompanyID={$model->companyId}",
				);
			$event = Yii::app()->curl->get($url['event']);
			$form = Yii::app()->curl->get($url['form']);
			if (Yii::app()->curl->getInfo(CURLINFO_HTTP_CODE) != 200)
				throw new Exception("apphb API call error", 500);
			$event = json_decode($event, true);
			$form = json_decode($form, true);
		} catch (Exception $e) {
			$event = array();
			$form = array();
			if ($e->getCode() == 500)
				throw new CHttpException(500, $e->getMessage());
		}

		$this->render('campaign', array('list'=>$event, 'form'=>$form));
	}

	public function actionCreatecampaign()
	{
		$model = CampaignForm::getSessionInstance('campaign');
		$param = array('model'=>$model);
		$page = $model->handleCreateCampaign();
		$this->render($page, $param);
	}

	public function actionResult($id)
	{
		$customer = array();
		try {
			$url = "http://listoprototype.apphb.com/ListoUser.svc/GetUsersByEventID?EventID={$id}";
			$result = Yii::app()->curl->get($url);
			if (Yii::app()->curl->getInfo(CURLINFO_HTTP_CODE) != 200)
				throw new Exception;

			$result = json_decode($result, true);

			if (!isset($result['Data']))
				throw new Exception;

			$customer = $result['Data'];
		} catch (Exception $e) {
			throw new CHttpException(500, "apphb API call error");
		}
		$this->render('result', array('model'=>$customer));
	}

	public function actionFormgenerator($id)
	{
		try {
			if (!isset($_GET['f_id']))
				throw new Exception("Invalid request.", 400);
			$url = "http://listoprototype.apphb.com/ListoForm.svc/GenerateFormCode?EventID={$id}&FormID={$_GET['f_id']}";
			$result = Yii::app()->curl->get($url);
			$result = json_decode($result, true);

			if (Yii::app()->curl->getInfo(CURLINFO_HTTP_CODE) != 200)
				throw new Exception("apphb API call error", Yii::app()->curl->getInfo(CURLINFO_HTTP_CODE));

			if (isset($_GET['download'])) {
				header("content-type: application/octet-stream");
				header("content-disposition: attachment; filename='form.html'");
				header("content-length: ".strlen($result['Data']));
			}

			echo $result['Data'];
		} catch (Exception $e) {
			throw new CHttpException($e->getCode(), $e->getMessage());
		}
	}
}