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
use yii\web\JsExpression;
use yii\jui\AutoComplete;
use ommu\core\models\CoreZoneCity;
use ommu\core\models\CoreZoneProvince;
use ommu\core\models\CoreZoneCountry;

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
	'enableClientValidation' => true,
	'enableAjaxValidation' => false,
	//'enableClientScript' => true,
]); ?>

<?php //echo $form->errorSummary($model);?>

<?php echo $form->field($model, 'office_location', ['template' => '{label}<div class="col-md-6 col-sm-9 col-xs-12">{input}{error}<span class="small-px">'.Yii::t('app', 'A struct containing metadata defining the location of a place').'</span></div>'])
	->textInput(['maxlength' => true])
	->label($model->getAttributeLabel('office_location'), ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']); ?>

<?php echo $form->field($model, 'office_name', ['template' => '{label}<div class="col-md-6 col-sm-9 col-xs-12">{input}{error}</div>'])
	->textInput(['maxlength' => true])
	->label($model->getAttributeLabel('office_name'), ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']); ?>

<div class="form-group">
	<?php echo $form->field($model, 'office_place', ['template' => '{label}', 'options' => ['tag' => null]])
		->label($model->getAttributeLabel('office_place'), ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']); ?>
	<div class="col-md-6 col-sm-9 col-xs-12">
		<?php echo $form->field($model, 'office_place', ['template' => '{input}{error}'])
			->textarea(['rows'=>2,'rows'=>6])
			->label($model->getAttributeLabel('office_place'), ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']); ?>
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<?php echo $form->field($model, 'office_district', ['template' => '{input}{error}'])
					//->textInput(['maxlength' => true, 'placeholder'=>$model->getAttributeLabel('office_district')])
					->widget(AutoComplete::className(), [
						'options' => [
							'placeholder' => 'Your district. *auto suggest',
							'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Autosuggest input, ketikan minimal 2 huruf',
							'class' => 'ui-autocomplete-input form-control'
						],
						'clientOptions' => [
							'source' => Url::to(['/district/suggest', 'extend'=>'district_name,city_id,province_id,country_id']),
							'minLength' => 2,
							'select' => new JsExpression("function(event, ui) {
								\$('.field-office_city_id #office_city_id').val(ui.item.city_id);
								\$('.field-office_province_id #office_province_id').val(ui.item.province_id);
								\$('.field-office_country_id #office_country_id').val(ui.item.country_id);
								\$(event.target).val(ui.item.district_name);
								return false;
							}"),
						]
					])
					->label($model->getAttributeLabel('office_district'), ['class'=>'control-label col-md-3 col-sm-3 col-xs-12', 'placeholder'=>$model->getAttributeLabel('office_village')]); ?>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<?php echo $form->field($model, 'office_village', ['template' => '{input}{error}'])
					//->textInput(['maxlength' => true, 'placeholder'=>$model->getAttributeLabel('office_village')])
					->widget(AutoComplete::className(), [
						'options' => [
							'placeholder' => 'Your village. *auto suggest',
							'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Autosuggest input, ketikan minimal 2 huruf',
							'class' => 'ui-autocomplete-input form-control'
						],
						'clientOptions' => [
							'source' => Url::to(['/village/suggest', 'extend'=>'village_name,district_name,city_id,province_id,country_id']),
							'minLength' => 2,
							'select' => new JsExpression("function(event, ui) {
								\$('.field-office_district #office_district').val(ui.item.district_name);
								\$('.field-office_city_id #office_city_id').val(ui.item.city_id);
								\$('.field-office_province_id #office_province_id').val(ui.item.province_id);
								\$('.field-office_country_id #office_country_id').val(ui.item.country_id);
								\$(event.target).val(ui.item.village_name);
								return false;
							}"),
						]
					])
					->label($model->getAttributeLabel('office_village'), ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']); ?>
			</div>
		</div>
		<span class="small-px"><?php echo Yii::t('app', 'The number, street, district and village of the postal address for this business');?></span>
	</div>
</div>

<?php
$office_city_id = CoreZoneCity::getCity(1);
echo $form->field($model, 'office_city_id', ['template' => '{label}<div class="col-md-6 col-sm-9 col-xs-12">{input}{error}<span class="small-px">'.Yii::t('app', 'The city (or locality) line of the postal address for this business').'</span></div>'])
	->dropDownList($office_city_id, ['prompt'=>''])
	->label($model->getAttributeLabel('office_city_id'), ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']); ?>

<?php
$office_province_id = CoreZoneProvince::getProvince(1);
echo $form->field($model, 'office_province_id', ['template' => '{label}<div class="col-md-6 col-sm-9 col-xs-12">{input}{error}</div>'])
	->dropDownList($office_province_id, ['prompt'=>''])
	->label($model->getAttributeLabel('office_province_id'), ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']); ?>

<?php
$office_country_id = CoreZoneCountry::getCountry();
echo $form->field($model, 'office_country_id', ['template' => '{label}<div class="col-md-6 col-sm-9 col-xs-12">{input}{error}</div>'])
	->dropDownList($office_country_id, ['prompt'=>''])
	->label($model->getAttributeLabel('office_country_id'), ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']); ?>

<?php echo $form->field($model, 'office_zipcode', ['template' => '{label}<div class="col-md-6 col-sm-9 col-xs-12">{input}{error}<span class="small-px">'.Yii::t('app', 'The state (or region) line of the postal address for this business').'</span></div>'])
	->textInput(['maxlength' => true])
	->label($model->getAttributeLabel('office_zipcode'), ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']); ?>

<?php echo $form->field($model, 'office_phone', ['template' => '{label}<div class="col-md-6 col-sm-9 col-xs-12">{input}{error}<span class="small-px">'.Yii::t('app', 'A telephone number to contact this business').'</span></div>'])
	->textInput(['maxlength' => true])
	->label($model->getAttributeLabel('office_phone'), ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']); ?>

<?php echo $form->field($model, 'office_fax', ['template' => '{label}<div class="col-md-6 col-sm-9 col-xs-12">{input}{error}<span class="small-px">'.Yii::t('app', 'A fax number to contact this business').'</span></div>'])
	->textInput(['maxlength' => true])
	->label($model->getAttributeLabel('office_fax'), ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']); ?>

<?php echo $form->field($model, 'office_email', ['template' => '{label}<div class="col-md-6 col-sm-9 col-xs-12">{input}{error}<span class="small-px">'.Yii::t('app', 'An email address to contact this business').'</span></div>'])
	->textInput(['maxlength' => true])
	->label($model->getAttributeLabel('office_email'), ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']); ?>

<?php echo $form->field($model, 'office_website', ['template' => '{label}<div class="col-md-6 col-sm-9 col-xs-12">{input}{error}<span class="small-px">'.Yii::t('app', 'A website for this business').'</span></div>'])
	->textInput(['maxlength' => true])
	->label($model->getAttributeLabel('office_website'), ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']); ?>

<div class="ln_solid"></div>
<div class="form-group">
	<div class="col-md-6 col-sm-9 col-xs-12 col-sm-offset-3">
		<?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
	</div>
</div>

<?php ActiveForm::end(); ?>