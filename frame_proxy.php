<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Pragma" content="no-cache"/>
    </head>
    <body onload="ForwardMessage();">
       <script type="text/javascript">
         // Forward message to the top most parent page
         function ForwardMessage()
         {
            var message = document.location.hash;
            if (message.length > 0)
            {
               message = message.substr(1);
               try
               {
                  top.OnMessageFromChild(message);
               }
               catch(err)
               {

               }
            }
         }
         // Ensure ForwardMessage is called once after the page is loaded so that
         // any message sent during page load is eventually passsed on. Particularly
         // needed if you are looking at resizing content.
       </script>
    </body>
</html>