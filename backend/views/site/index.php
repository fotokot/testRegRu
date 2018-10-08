<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Skyeng demo';
?>
<div class="site-index">

    <div>
        <p>Skyeng registration demo</p>
        <?php
        $form = ActiveForm::begin([
            'id' => 'form-registration',
            'action' => ['site/register'],
            'options' => [
                'enctype' => 'multipart/form-data'
            ],
        ]); ?>
        <?= $form->field($model, 'username'); ?>
        <?= $form->field($model, 'email'); ?>
        <?= $form->field($model, 'surename'); ?>
        <?= $form->field($model, 'name'); ?>
        <?= $form->field($model, 'middle_name'); ?>
        <?= $form->field($model, 'type')
            ->dropDownList($model::TYPES,
                [
                    'prompt' => 'Выберите один вариант'
                ]); ?>
        <?= $form->field($model, 'inn'); ?>
        <?= $form->field($model, 'company_name'); ?>
        <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary']); ?>
        <?php
        ActiveForm::end();
        ?>
    </div>

    <div class="body-content">

        <div class="row">

        </div>

    </div>
</div>
