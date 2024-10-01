<a href="#" onclick="window.history.back();" class="text-black"
      ><header
        class="position-fixed z-3 top-0 w-100 d-flex justify-content-start align-items-baseline gap-2 pt-3 px-3"
      >
        <p class="icon"><i class="icon fa-solid fa-angle-left fa-lg"></i></p>
        <p class="teks"><?=$detail['title']?></p>
      </header></a>
      
<?php if($detail['type']=='video'):?>
    <?php if($detail['video_embed_url']!=''):?>
    <?=$detail['video_embed_url'];?>
    <?php endif ?>
    <?php if($detail['video_embed_url']=='' and $detail['video_url']!=''):?>
            <div class="main mb-5">
            <div id="player"></div>
            <script>
            var tag = document.createElement('script');
            tag.src = "https://www.youtube.com/iframe_api";
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
            
            var player;
            function onYouTubeIframeAPIReady() {
                player = new YT.Player('player', {
                    height: '100%',
                    width: '100%',
                    videoId: '<?=$detail['video_url']?>', // Replace with your YouTube video ID
                    playerVars: {
                        'autoplay': 1,
                        'controls': 1
                    }
                });
            }
            </script>
        <?php endif ?>
<?php endif;?>

    
    