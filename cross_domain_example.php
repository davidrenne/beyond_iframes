
         <!--

         instructions
         ============

         Insert this code into the header of your "left side" staging area link for each page.

         This way the calling iframe location can communicate to the parent what the current URL is across different domains and also send scroll information.

         -->
         <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.js"></script>
         <script type="text/javascript">
         function SendCurrentURLToParent()
         {
            document.getElementById('parentProxy').contentWindow.location = 'http://where.ever.this.file.is.located.com/frame_proxy.php#' + escape(document.location);
         }

         $(document).ready(function()
         {
            document.onscroll= function(e)
            {
               try
               {
                  parent.document.getElementById('iframe2').contentWindow.scrollTo($(document).scrollLeft(),$(document).scrollTop());
               }
               catch(err)
               {

               }
            }
            $('body').append('<iframe id="parentProxy" width="10px" height="10px" frameborder="0" style="position: absolute; left: -150px; top: 0px; display:none;"></iframe>');
            SendCurrentURLToParent();
         });
         </script>