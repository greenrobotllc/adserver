function loadScript(url, callback)
{
    var head = document.getElementsByTagName('head')[0];
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = url;

    script.onreadystatechange = callback;
    script.onload = callback;

    head.appendChild(script);

}

<?php if($ad_provider_id == 1) { ?>
  loadScript('//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js', function() {(adsbygoogle = window.adsbygoogle || []).push({});});
  var ins = document.getElementById('selectivead');
  ins.insertAdjacentHTML('afterbegin', '<ins class="adsbygoogle" style="{{$adsense_style}}" data-ad-client="{{$adsense_ad_client}}" data-ad-slot="{{$adsense_ad_slot}}" data-ad-format="auto"></ins>')
<?php } else { ?>
loadScript('//ads.lfstmedia.com/getad?site={{$lsm_site}}', function() {
  var mySlot = LSM_Slot({
      adkey: '{{$lsm_ad_key}}',
      ad_size: '{{$lsm_ad_size}}',
      slot: '{{$lsm_ad_slot}}',
      _render_div_id: 'selectivead'
    });
  });
<?php } ?>


