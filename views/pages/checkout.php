
	<!--start-breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<div class="breadcrumbs-main">
				<ol class="breadcrumb">
					<li><a href="index.php">Home</a></li>
					<li class="active">Shopping Cart</li>
				</ol>
			</div>
		</div>
	</div>
	<!--end-breadcrumbs-->
	<!--start-ckeckout-->
	<div class="ckeckout">
		<div class="container">
			<div class="ckeck-top heading">
				<h2>Shopping Cart</h2>
			</div>
			<div class="ckeckout-top">
			<div class="cart-items">

			<div class="in-check" >
				<ul class="unit">
					<li><span>Item</span></li>
					<li><span>Product Name</span></li>		
					<li><span>Unit Price</span></li>
					<li><span>Quantity</span></li>
					<li> </li>
					<div class="clearfix"> </div>
				</ul>
                <div class="djordje">

                </div>

			</div>
			</div>  
		 </div>
            <div class="checkout-btn dj-t-padd-20">
                <button class="btn btn-danger" id="delete_all">Remove All</button>
            </div>
            <div class="total-price dj-t-padd-20">
                <h3 class="text-right">
                    Total:
                    <span>0$</span>

                </h3>
            </div>
            <div class="checkout-btn dj-t-padd-20">
                <?php
                if(isset($_SESSION["korisnik"])):
                ?>
                <button class="btn btn-success" id="checkout">Checkout</button>
                <?php
                else:
                ?>
                <p>You can't buy because you are not an authenticated user </p>
                <?php
                endif;
                ?>
            </div>
            <div class="dj-t-flex dj-t-center" id="msg">

            </div>

		</div>
	</div>

</body>
</html>