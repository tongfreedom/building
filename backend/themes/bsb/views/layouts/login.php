<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\themes\bsb\LoginAsset;
use yii\helpers\Html; 
LoginAsset::register($this);

$assets = $this->theme->baseUrl.'/assets';
 
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="">

    <?= Html::csrfMetaTags() ?>
    <title>
        <?= Html::encode($this->title) ?>
    </title>
    <?php $this->head() ?>
    <!-- fav icon -->
    <link href="<?= $assets; ?>/images/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?= $assets; ?>/images/apple-touch-icon.png">
</head>
<body class="login-page"  >
<?php $this->beginBody() ?>
    <?=$content; ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
