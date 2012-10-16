<?php
//Instructions
//============
//Use Beyond Iframes for instances where you set up a production staging area where either you have an isolated database or code base where you can safely deploy new development code to "cross compare" apples to apples two side by side web pages within one browser window
//
//It is an ideal way to test some projects so that your testers can see exact differences easily without having to load up the same request in production and splitting their windows.
//
//It is also ideal because the scroll bars stay in sync from your "left side" staging to your right side production. This saves you time and helps you spot check any discrepencies in new code because it is very easy to spot issues in your new code base (so long as the page hasnt dramatically been re-written).  So perfect for cases where you are hot fixing a production staging region and people need to verify your changes are legit and defect free.
//
//Let me know if this script is useful to you.  Email me at david_renne@yahoo.com
//
//If you wish to perform "dual actions" such as refreshing both iframes with the page you are currently on or going back or forward.  There is a little CSS based folder icon that floats between both windows.  Click this and you will be presented with three icons to refresh both iframe sources or go back -1 or forward +1 from your current history.
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
   <head>
      <meta http-equiv="content-type" content="text/html;charset=utf-8" />
      <link rel="stylesheet" type="text/css" media="screen" href="peculiar.css" />
      <link rel="stylesheet" type="text/css" media="screen" href="beyond_iframes.css" />
<!--      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.js"></script>  -->
      <script type="text/javascript" src="jquery.js"></script>
      <script type="text/javascript" src="beyond_iframes.js"></script>
   </head>
   <body onload="loadURL();">
      <div id="bar">
         <!--<div class="icon icon-screens" style="display:none;">
          <div class="icon-screens-rectangle-1"></div>
          <div class="icon-screens-rectangle-2"></div>
         </div>
         -->
         <div class="icon icon-back" style="display:none;" onclick="iframeBackForward(-1);iframeButtonNavClick(this);">
          <div class="icon-back-triangle-1"></div>
          <div class="icon-back-triangle-2"></div>
          <div class="icon-back-triangle-3"></div>
          <div class="icon-back-line"></div>
         </div>

         <div class="icon icon-forward" style="display:none;" onclick="iframeBackForward(1);iframeButtonNavClick(this);">
          <div class="icon-forward-triangle-1"></div>
          <div class="icon-forward-triangle-2"></div>
          <div class="icon-forward-triangle-3"></div>
          <div class="icon-forward-line"></div>
         </div>

         <div class="icon icon-repeat" style="display:none;" onclick="iframeRefresh();iframeButtonNavClick(this);">
          <div class="icon-repeat-rectangle-1"></div>
          <div class="icon-repeat-rectangle-2"></div>
          <div class="icon-repeat-triangle-1"></div>
          <div class="icon-repeat-triangle-2"></div>
         </div>

         <div class="icon icon-folder" data-initialize="1" style="display:none;" onclick="$(this).fadeOut('fast');$('.icon-repeat,.icon-forward,.icon-back,.icon-screens').fadeIn('slow');">
          <div class="icon-folder-rectangle-1"></div>
          <div class="icon-folder-rectangle-2"></div>
          <div class="icon-folder-rectangle-3"></div>
         </div>
      </div>

      <div class="url toparea" style="display:none">
         Base 1:
         <input class="url" onblur="loadURL();" type="text" id="url1" value="<?php echo (array_key_exists('baseUrl1',$_GET)) ? $_GET['baseUrl1'] : 'http://google.com';?>"/>
         Base 2:
         <input class="url" onblur="loadURL();" type="text" id="url2" value="<?php echo (array_key_exists('baseUrl2',$_GET)) ? $_GET['baseUrl2'] : 'http://google.com';?>"/>
      </div>
      <div id="frames">
         <!-- this frame is to communicate the URL of the child iframe-->
         <iframe id="innerFrameProxy" width="10px" height="10px" frameborder="0" src="frame_proxy.php" style="display:none; position: absolute; left: -150px; top: 0px;"></iframe>
         <div>

         <iframe onload="iframeChanged(this);" id="iframe1"></iframe>
         <iframe onload="iframeChanged(this);" id="iframe2"></iframe>
      </div>
   </body>
</html>