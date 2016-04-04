<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
</script>
<script src="http://cdn.jsdelivr.net/qtip2/2.2.1/jquery.qtip.min.js"></script>
 

 
<a class="selector" href="#test" title="My tooltip text">Sample link</a>
<div id="tooltip" style="display: none;">
   <a class="live" href="#test">Show next</a>
    <div class="tooltiptext">
    Complex <b>inline</b> <i>HTML</i> in your <u>config</u>
    </div>
</div>
<a class="selector" href="#test" title="My tooltip text">Sample link</a>
<div id="tooltip" style="display: none;">
   <a class="live" href="#test">Show next</a>
    <div class="tooltiptext">
    Complex <b>inline</b> <i>HTML</i> in your <u>config</u>
    </div>
</div> 
<a class="selector" href="#test" title="My tooltip text">Sample link</a>
<div id="tooltip" style="display: none;">
   <a class="live" href="#test">Show next</a>
    <div class="tooltiptext">
    Complex <b>inline</b> <i>HTML</i> in your <u>config</u>
    </div>
</div> 

<script type="text/javascript">
$(document).ready(function() {
// MAKE SURE YOUR SELECTOR MATCHES SOMETHING IN YOUR HTML!!!
$('.selector').each(function() {   
 $(this).qtip({
    content: { text: $(this).next('#tooltip') },
    show: {
        solo: true
     },
     hide: {
         fixed: true,
         delay: 800
    },
    events: {
        //show: function(event, api) { $('.selector').addClass('show'); },
        render: function(event, api) {
            // Grab the tooltip element from the API
            var tooltip = api.elements.tooltip
             $('a.live').each(function() {
                     $(this).qtip({
                         content: {
                             text: $(this).next('.tooltiptext')
                         }
                     });
                 });
            // ...and here's the extra event binds
            tooltip.bind('tooltipshow', function(event, api) {
                

            })
        }
    }
});
});
});


</script>