</div>


   <div class="footer">
   	  <div class="wrapper">	
	     <div class="section group">
				<div class="col_1_of_4 span_1_of_4">
						<h4>Information</h4>
						<ul>
						<li><a href="#">About Us</a></li>
						<li><a href="#">Service</a></li>
						</ul>
					</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Hotline</h4>
						<ul>
							<li><span>+84835973152</span></li>
							<li><span>+84835973152</span></li>
						</ul>
					</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Media</h4>
							<ul>
							<li class="facebook"><a href="#" target="_blank"><i class="ti-facebook"></i></a></li>
							<li class="twitter"><a href="#" target="_blank"> <i class="ti-twitter"></i></a></li>
							<li class="googleplus"><a href="#" target="_blank"><i class="ti-email"></i></a></li>
							<div class="clear"></div>
						</ul>
					</div>
			</div>
			<div class="copy_right">
				<p>Training with live project &amp; All rights Reseverd </p>
		   </div>
     </div>
    </div>
    <script type="text/javascript">
		$(document).ready(function() {
			/*
			var defaults = {
	  			containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
	 		};
			*/
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
    <a href="#" id="toTop" style="display: block;">
		<i class="ti-arrow-circle-up"></i>
		<span id="toTopHover" style="opacity: 1;">
		
		</span>
	</a>
    <link href="css/flexslider.css" rel='stylesheet' type='text/css' />
	  <script defer src="js/jquery.flexslider.js"></script>
	  <script type="text/javascript">
		 $(document).ready(function(){
    		SyntaxHighlighter.all()
  		});
		$(window).load(function(){
		  $('.flexslider').flexslider({
			animation: "slide",
			start: function(slider){
			  $('body').removeClass('loading');
			}
		  });
		});
	  </script>
</body>
</html>
