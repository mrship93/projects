        <footer id="footer"><!--Footer-->
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <p class="pull-left">Copyright © 2015</p>
                        <p class="pull-right">Курс PHP Start</p>
                    </div>
                </div>
            </div>
        </footer><!--/Footer-->



        <script src="/template/js/jquery.js"></script>
        <script src="/template/js/bootstrap.min.js"></script>
        <script src="/template/js/jquery.scrollUp.min.js"></script>
        <script src="/template/js/price-range.js"></script>
        <script src="/template/js/jquery.prettyPhoto.js"></script>
        <script src="/template/js/main.js"></script>
		
		 <script>
			$(document).ready(function(){
				$('.add-to-cart').click(function(){
					var but = $(this);
					var id = $(this).attr('data-id');
					$.ajax({
						url:'/cart/ajaxAdd/'+id,
						type:'POST',
						success:function(data) {
							$('#cart_count').html(data);
							but.text('Уже в корзине')
							
						}
					});
					return false;
				});
				
								$('.rate').click(function(){

					
					var id = $(this).attr('data-id');
					var val = $(this).val();
					
					var totalCount = $('#totalCount').text();
					totalCount++;
					$.ajax({
						
						url:'/product/rating/'+id+'/'+val,
						type:'POST',
						success:function(data) {
							$('#totalCount').text(totalCount);
						
							$('.ratingBlockAsses').show();
							$('#totalRating').html(data);
							
							
							
						}
					});
					return false;
				});
				
				
			});
		 
		 </script>
    </body>
</html>