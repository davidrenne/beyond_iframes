var childUrl     = '';
var firstRequest = false;
var sameDomain   = false;
var debug        = false;
function OnMessageFromChild(message)
{
 if (message.length > 0 && firstRequest == true)
 {
   childUrl = message;
 }
 firstRequest = true;
}

function loadURL()
{
 $.cookie('url1', $('#url1').val(), { expires: 7, path: '/' });
 $.cookie('url2', $('#url2').val(), { expires: 7, path: '/' });
 var iframeHeight = Math.round($(window).height())//  - $('.toparea').height() - 30;
 $('#iframe1').attr('src',$('#url1').val()).css('height',iframeHeight + 'px');
 $('#iframe2').attr('src',$('#url2').val()).css('height',iframeHeight + 'px');
}

function iframeBackForward(direction,runOnce)
{
 try
 {
   self.history.go(direction);
   if (runOnce == null)
   {
      setTimeout('iframeBackForward(' + direction + ',1);',1500 );
   }
 }
 catch(err)
 {
   if (debug)
   {
      alert(err);
   }
 }
}

function iframeButtonNavClick(o)
{
 $(o).fadeOut('slow');$(o).fadeIn('fast');
}

function iframeRefresh()
{
 try
 {
   $('#iframe1').attr('src',document.getElementById('iframe1').contentWindow.location.toString());
   $('#iframe2').attr('src',document.getElementById('iframe2').contentWindow.location.toString());
 }
 catch(err)
 {
   if (debug)
   {
      alert(err);
   }
 }
}

function iframeChanged(o)
{
 if (o.id == 'iframe1')
 {
   try
   {
      sameDomain = true;
      var url = o.contentWindow.location.toString();

      if ($('.icon-folder').attr('data-initialize') == 1)
      {
        $('.icon-folder').fadeIn('medium');
        $('.icon-folder').attr('data-initialize',0);
      }
   }
   catch(err)
   {
      sameDomain = false;
      var url = childUrl.toString();
      $('.icon-folder').hide();
   }

   var currentBaseURL = $('#url1').val();
   var newLocationBaseURL = $('#url2').val();

   if (currentBaseURL != url && newLocationBaseURL != url && url.search('://') != -1 && $.cookie('lastIframeUrl') != url)
   {

      var currentIframeRequest = url.replace(currentBaseURL,'').replace(newLocationBaseURL,'');
      var newIframePage = newLocationBaseURL + currentIframeRequest;

      //when we change the src it will also call iframeChanged again here
      //
      $('#iframe2').attr('src',newIframePage);
      $.cookie('lastIframeUrl', newIframePage, { expires: 7, path: '/' });
   }
 }
}

