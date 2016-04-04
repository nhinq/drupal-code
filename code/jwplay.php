<?php
$thumbnail_path = '';
if(isset($entity->field_video_thumbnail[$entity->language])){
$thumbnail_path = file_create_url($entity->field_video_thumbnail[$entity->language][0]['uri']);
}
$flv_file_path = $entity->field_streamingvid[$entity->language][0]['value'];
$mp4_file_path = $entity->field_mp4vid[$entity->language][0]['value'];
$content_url = url('node/' . $entity->nid, array('absolute'=>TRUE));
$embedcode = '&autostart=true&backcolor=0xffffff&bandwidth=19962&controlbar=over&file='.$flv_file_path.'&frontcolor=0x000000&image='.$thumbnail_path.'&lightcolor=0x000000&plugins=viral-2d&screencolor=0x000000&skin=http%3A%2F%2Fwww.cspnet.com%2Fsites%2Fdefault%2Ffiles%2Fjw%2Fskins%2Fglow%2Fglow.zip&streamer=rtmp%3A%2F%2Fcspnet.flash.internapcdn.net%2Fcspnet_vitalstream_com%2F_definst_%2F';

/*more*/
$thumbnail = image_style_url("full_width", $thumbnail_path);
$play_mp4 = 'http://cspnet.http.internapcdn.net/foodgroup/mp4/'.$mp4_file_path;
?>
<!-- JW Media Player -->
<div id="csptv-video"><div id="mediaplayer">Jw player</div><div id="playerID"></div></div>
 

<script type="text/javascript">
 <!--// <![CDATA[
    jwplayer('mediaplayer').setup({
    'id': 'playerID',
    'width': '640',
    'height': '380',
	  'autostart':'true',
    'provider': 'rtmp',
    'streamer': 'rtmp://cspnet.flash.internapcdn.net/foodgroup/_definst_/',
    'file': '<?php print($play_mp4)?>',
	  'image': '<?php print($thumbnail)?>',
	  'skin': '/sites/all/libraries/jw/skins/lightrv5.zip',
	  'plugins': {
       'sharing-2': {
           'link': '<?php echo $content_url; ?>',
      	   'code': '<embed src="/sites/all/libraries/jw/player.swf" width="640" height="380" allowfullscreen="true" flashvars="<?php echo $embedcode?>" />'		   
       }
    },

	'modes': [
        {type: 'flash', src: '/sites/all/libraries/jw/player.swf'},
        {
          type: 'html5',
          config: {
           'file': 'http://cspnet.http.internapcdn.net/foodgroup/mp4/<?php print($mp4_file_path)?>',
           'provider': 'video',
		   'skin': '/sites/all/libraries/jw/skins/lightrv5.zip',
		   'image': '<?php print($thumbnail_path)?>'
          }
        },
        {
          type: 'download',
          config: {
           'file': 'http://cspnet.http.internapcdn.net/foodgroup/mp4/<?php print($mp4_file_path)?>',
           'provider': 'video',
		   'skin': '/sites/all/libraries/jw/skins/glow/glow.zip',
		   'image': '<?php print($thumbnail_path)?>'
          }
        }
    ]
  });// ]]> -->
</script>
 
<script type="text/javascript">
    jwplayer("mediaplayer").setup({
        file: "<?php print $play_mp4 ; ?>",
        image: "<?php print $thumbnail  ; ?>"
    });
</script>
