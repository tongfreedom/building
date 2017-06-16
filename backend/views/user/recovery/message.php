<?php
use yii\helpers\Url;
?>

<script>
	jQuery(document).ready(function($) {
		swal({
            title: "<?=$title; ?>",
            text: "<?=$text; ?>",
            type: "<?=$type; ?>",
            showCancelButton: false,
            confirmButtonText: "OK",
            closeOnConfirm: false
        },
        function(){
        window.location.href = "<?=Yii::$app->homeUrl.$url; ?>";//"<?=url::to([$url])?>";
        });
	});
</script>