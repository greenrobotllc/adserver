        

                  <h4 class="col-md-10">Include this in your page footer</h4>



                  <button class="btn cpy_btn" data-clipboard-target="#code" title="copy to clipboard">
    <img src="{{asset('img/clippy.svg')}}" alt="Copy to clipboard" style="width: 20px;"> COPY
</button>


                  
					 <code id="code" class="col-md-12">            
						  &lt;script type='text/javascript'&gt;&lt;!--//&lt;![CDATA[<br /> 
						    var m3_u = (location.protocol=='https:'?'<?php echo secure_url('/getad/'.$id) ?>':'<?php echo url('/getad/'.$id) ?>');
						  <br /> var m3_r = Math.floor(Math.random()*99999999999);
					  
						  <br /> 
						  if (!document.MAX_used) document.MAX_used = ',';<br /> document.write ("&lt;scr"+"ipt type='text/javascript' src='"+m3_u);<br /> document.write ("?zoneid={{$id}}");<br /> document.write ('&amp;amp;cb=' + m3_r);<br /> if (document.MAX_used != ',') document.write ("&amp;amp;exclude=" + document.MAX_used);<br /> document.write (document.charset ? '&amp;amp;charset='+document.charset : (document.characterSet ? '&amp;amp;charset='+document.characterSet : ''));<br /> document.write ("&amp;amp;loc=" + escape(window.location));<br /> if (document.referrer) document.write ("&amp;amp;referer=" + escape(document.referrer));<br /> if (document.context) document.write ("&amp;context=" + escape(document.context));<br /> if (document.mmm_fo) document.write ("&amp;amp;mmm_fo=1");<br /> document.write ("'&gt;&lt;\/scr"+"ipt&gt;");&lt;/script&gt; </code>



         <script src="{{asset('js/clipboard.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function(){
	new Clipboard('.cpy_btn');
});

</script>