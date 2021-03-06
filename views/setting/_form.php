<?php
/**
 * Core Settings (core-settings)
 * @var $this app\components\View
 * @var $this ommu\core\controllers\SettingController
 * @var $model ommu\core\models\CoreSettings
 * @var $form app\components\widgets\ActiveForm
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2018 OMMU (www.ommu.id)
 * @created date 23 April 2018, 18:49 WIB
 * @link https://github.com/ommu/mod-core
 *
 */

use yii\helpers\Html;
use app\components\widgets\ActiveForm;
use ommu\flatpickr\Flatpickr;
?>

<?php $form = ActiveForm::begin([
	'options' => ['class' => 'form-horizontal form-label-left'],
	'enableClientValidation' => true,
	'enableAjaxValidation' => true,
	//'enableClientScript' => true,
]); ?>

<?php //echo $form->errorSummary($model);?>

<?php echo $form->field($model, 'site_creation')
    ->widget(Flatpickr::className(), ['model' => $model, 'attribute' => 'site_creation'])
	->label($model->getAttributeLabel('site_creation')); ?>

<?php echo $form->field($model, 'site_dateformat')
	->textInput(['maxlength' => true])
	->label($model->getAttributeLabel('site_dateformat')); ?>

<?php echo $form->field($model, 'site_timeformat')
	->textInput(['maxlength' => true])
	->label($model->getAttributeLabel('site_timeformat')); ?>

<?php echo $form->field($model, 'license_email')
	->textInput(['maxlength' => true])
	->label($model->getAttributeLabel('license_email')); ?>

<?php echo $form->field($model, 'license_key')
	->textInput(['maxlength' => true])
	->label($model->getAttributeLabel('license_key')); ?>

<?php echo $form->field($model, 'ommu_version')
	->textInput(['maxlength' => true])
	->label($model->getAttributeLabel('ommu_version')); ?>

<hr/>

<?php echo $form->field($model, 'submitButton')
	->submitButton(); ?>

<?php ActiveForm::end(); ?>