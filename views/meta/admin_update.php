<?php
/**
 * Core Metas (core-meta)
 * @var $this app\components\View
 * @var $this ommu\core\controllers\MetaController
 * @var $model ommu\core\models\CoreMeta
 * @var $form app\components\ActiveForm
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2018 OMMU (www.ommu.co)
 * @created date 24 April 2018, 14:11 WIB
 * @link https://github.com/ommu/mod-core
 *
 */

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\ActiveForm;
use ommu\core\models\CoreMeta;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Metas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->params['menu']['content'] = [
	['label' => Yii::t('app', 'Global Meta'), 'url' => Url::to(['update']), 'icon' => 'pencil'],
	['label' => Yii::t('app', 'Address'), 'url' => Url::to(['address']), 'icon' => 'pencil'],
	['label' => Yii::t('app', 'Google Owner Meta'), 'url' => Url::to(['google']), 'icon' => 'pencil'],
	['label' => Yii::t('app', 'Twitter Meta'), 'url' => Url::to(['twitter']), 'icon' => 'pencil'],
	['label' => Yii::t('app', 'Facebook Meta'), 'url' => Url::to(['facebook']), 'icon' => 'pencil'],
];
?>

<?php $form = ActiveForm::begin([
	'options' => [
		'enctype' => 'multipart/form-data',
	],
	'enableClientValidation' => false,
	'enableAjaxValidation' => false,
	//'enableClientScript' => true,
]); ?>

<?php //echo $form->errorSummary($model);?>

<div class="form-group field-meta_image">
	<?php echo $form->field($model, 'meta_image', ['template' => '{label}', 'options' => ['tag' => null]])
		->label($model->getAttributeLabel('meta_image'), ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']); ?>
	<div class="col-md-6 col-sm-9 col-xs-12">
		<?php echo !$model->isNewRecord && $model->old_meta_image_i != '' ? Html::img(join('/', [Url::Base(), CoreMeta::getUploadPath(false), $model->old_meta_image_i]), ['class'=>'mb-15', 'width'=>'100%']) : '';?>
		<?php echo $form->field($model, 'meta_image', ['template' => '{input}{error}'])
			->fileInput()
			->label($model->getAttributeLabel('meta_image'), ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']); ?>
	</div>
</div>

<?php echo $form->field($model, 'meta_image_alt', ['template' => '{label}<div class="col-md-6 col-sm-9 col-xs-12">{input}{error}</div>'])
	->textInput()
	->label($model->getAttributeLabel('meta_image_alt'), ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']); ?>

<?php 
$setting = [
	1 => Yii::t('app', 'Enable'),
	0 => Yii::t('app', 'Disable'),
];
echo $form->field($model, 'office_on', ['template' => '{label}<div class="col-md-6 col-sm-9 col-xs-12">{input}{error}</div>'])
	->radioList($setting, ['class'=>'desc', 'separator' => '<br />'])
	->label($model->getAttributeLabel('office_on'), ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']); ?>
	
<?php echo $form->field($model, 'google_on', ['template' => '{label}<div class="col-md-6 col-sm-9 col-xs-12">{input}{error}</div>'])
	->radioList($setting, ['class'=>'desc', 'separator' => '<br />'])
	->label($model->getAttributeLabel('google_on'), ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']); ?>

<?php echo $form->field($model, 'twitter_on', ['template' => '{label}<div class="col-md-6 col-sm-9 col-xs-12">{input}{error}</div>'])
	->radioList($setting, ['class'=>'desc', 'separator' => '<br />'])
	->label($model->getAttributeLabel('twitter_on'), ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']); ?>

<?php echo $form->field($model, 'facebook_on', ['template' => '{label}<div class="col-md-6 col-sm-9 col-xs-12">{input}{error}</div>'])
	->radioList($setting, ['class'=>'desc', 'separator' => '<br />'])
	->label($model->getAttributeLabel('facebook_on'), ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']); ?>

<div class="ln_solid"></div>
<div class="form-group">
	<div class="col-md-6 col-sm-9 col-xs-12 col-sm-offset-3">
		<?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
	</div>
</div>

<?php ActiveForm::end(); ?>