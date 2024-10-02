<!-- 
<a href="#" onclick="window.history.back();" class="text-black"
><header
class="position-fixed z-3 top-0 w-100 d-flex justify-content-start align-items-baseline gap-2 pt-3 px-3"
>
<p class="icon"><i class="icon fa-solid fa-angle-left fa-lg"></i></p>
<p class="teks"><?=$detail['title']?></p>
</header></a>
-->


<?php if($detail['type']=='quiz'):?>
<script>
    function backToCompetency() {
        window.location.href='<?=$kUrl."/app/kompetensi/".md5($course_sub_id) ?>';
    }
</script>
<style>
    iframe { position: absolute;width: 100%; height: calc(100vh - 0px); border: none; }
    body{
        padding-top:0px !important;
    }

</style>
 <iframe src="<?=$kUrl?>/app_quiz_login?submit=1&course_material_id=<?=$course_material_id?>&token=<?=$auth_token?>" allowfullscreen></iframe>
<?php endif;?>

<?php $hide_bottom_bar=1?>
<?php $hide_top_bar=1?>