<?php
/**
 * Core Zone Cities (core-zone-city)
 * @var $this app\components\View
 * @var $this ommu\core\controllers\zone\CityController
 * @var $model ommu\core\models\CoreZoneCity
 * @var $searchModel ommu\core\models\search\CoreZoneCity
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2017 OMMU (www.ommu.co)
 * @created date 14 September 2017, 22:22 WIB
 * @modified date 30 January 2019, 17:13 WIB
 * @link https://github.com/ommu/mod-core
 *
 */

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\widgets\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use ommu\core\models\CoreZoneCountry;
use ommu\core\models\CoreZoneProvince;

$this->params['breadcrumbs'][] = $this->title;

$this->params['menu']['content'] = [
	['label' => Yii::t('app', 'Add City'), 'url' => Url::to(['create']), 'icon' => 'plus-square'],
];
$this->params['menu']['option'] = [
	//['label' => Yii::t('app', 'Search'), 'url' => 'javascript:void(0);'],
	['label' => Yii::t('app', 'Grid Option'), 'url' => 'javascript:void(0);'],
];
?>

<div class="core-zone-city-manage">
<?php Pjax::begin(); ?>

<?php if($country != null) {
$model = $countries;
echo DetailView::widget([
	'model' => $countries,
	'options' => [
		'class'=>'table table-striped detail-view',
	],
	'attributes' => [
		[
			'attribute' => 'country_name',
			'value' => function ($model) {
				return Html::a($model->country_name, ['zone/country/view', 'id'=>$model->country_id], ['title'=>$model->country_name]);
			},
			'format' => 'html',
		],
		'code',
	],
]);
}?>

<?php if($province != null) {
$model = $provinces;
echo DetailView::widget([
	'model' => $provinces,
	'options' => [
		'class'=>'table table-striped detail-view',
	],
	'attributes' => [
		[
			'attribute' => 'province_name',
			'value' => function ($model) {
				return Html::a($model->province_name, ['zone/province/view', 'id'=>$model->province_id], ['title'=>$model->province_name]);
			},
			'format' => 'html',
		],
		[
			'attribute' => 'countryName',
			'value' => function ($model) {
				$countryName = isset($model->country) ? $model->country->country_name : '-';
				if($countryName != '-')
					return Html::a($countryName, ['zone/country/view', 'id'=>$model->country_id], ['title'=>$countryName]);
				return $countryName;
			},
			'format' => 'html',
		],
		'mfdonline',
	],
]);
}?>

<?php //echo $this->render('_search', ['model'=>$searchModel]); ?>

<?php echo $this->render('_option_form', ['model'=>$searchModel, 'gridColumns'=>$this->activeDefaultColumns($columns), 'route'=>$this->context->route]); ?>

<?php 
$columnData = $columns;
array_push($columnData, [
	'class' => 'yii\grid\ActionColumn',
	'header' => Yii::t('app', 'Option'),
	'contentOptions' => [
		'class'=>'action-column',
	],
	'buttons' => [
		'view' => function ($url, $model, $key) {
			$url = Url::to(ArrayHelper::merge(['view', 'id'=>$model->primaryKey], Yii::$app->request->get()));
			return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, ['title' => Yii::t('app', 'Detail City')]);
		},
		'update' => function ($url, $model, $key) {
			$url = Url::to(ArrayHelper::merge(['update', 'id'=>$model->primaryKey], Yii::$app->request->get()));
			return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['title' => Yii::t('app', 'Update City')]);
		},
		'delete' => function ($url, $model, $key) {
			$url = Url::to(['delete', 'id'=>$model->primaryKey]);
			return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
				'title' => Yii::t('app', 'Delete City'),
				'data-confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
				'data-method'  => 'post',
			]);
		},
	],
	'template' => '{view}{update}{delete}',
]);

echo GridView::widget([
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
	'layout' => '<div class="row"><div class="col-sm-12">{items}</div></div><div class="row sum-page"><div class="col-sm-5">{summary}</div><div class="col-sm-7">{pager}</div></div>',
	'columns' => $columnData,
]); ?>

<?php Pjax::end(); ?>
</div>