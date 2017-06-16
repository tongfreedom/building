<?php

/*
 * This file is part of the Dektrium project
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/*
 * @var yii\web\View $this
 * @var dektrium\user\models\User $user
 */

?>

<?php $this->beginContent('@dektrium/user/views/admin/update.php', ['user' => $user]) ?>

<?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'enableAjaxValidation'   => true,
    'enableClientValidation' => false,
    'fieldConfig' => [
        'horizontalCssClasses' => [
            'wrapper' => 'col-sm-9',
        ],
    ],
]); ?>

<?= $this->render('_user', ['form' => $form, 'user' => $user]) ?>

 <div class="row clearfix m-t-10">
    <div class="col-lg-offset-3 col-lg-9">
        <?= Html::submitButton('SUBMIT', ['class' => 'btn btn-primary m-t-15 waves-effect']) ?>
        <?= Html::resetButton('CLEAR', ['class' => 'btn btn-danger m-t-15 waves-effect']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php $this->endContent() ?>
