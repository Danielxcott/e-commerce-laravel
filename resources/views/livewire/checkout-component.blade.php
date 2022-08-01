<style>
    #shipping_box{
        display: none;
    }
</style>
<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">home</a></li>
                <li class="item-link"><span>Checkout</span></li>
            </ul>
        </div>
        <div class=" main-content-area">
            <form action="{{ route("checkout.store") }}" method="post" id="billing_form" name="frm-billing">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="wrap-address-billing">
                        <h3 class="box-title">Billing Address</h3>
                            <p class="row-in-form">
                                <label for="fname">first name<span>*</span></label>
                                <input  type="text" name="fname" value="" placeholder="Your name">
                            </p>
                            <p class="row-in-form">
                                <label for="lname">last name<span>*</span></label>
                                <input  type="text" name="lname" value="" placeholder="Your last name">
                            </p>
                            <p class="row-in-form">
                                <label for="email">Email Addreess:</label>
                                <input  type="email" name="email" value="" placeholder="Type your email">
                            </p>
                            <p class="row-in-form">
                                <label for="phone">Phone number<span>*</span></label>
                                <input  type="number" name="phone" value="" placeholder="10 digits format">
                            </p>
                            <p class="row-in-form">
                                <label for="phone">Line 1<span>*</span></label>
                                <input  type="text" name="line1" value="" placeholder="">
                            </p>
                            <p class="row-in-form">
                                <label for="phone">Line 2<span>*</span></label>
                                <input  type="text" name="line2" value="" placeholder="">
                            </p>
                            <p class="row-in-form">
                                <label for="country">Country<span>*</span></label>
                                <input  type="text" name="country" value="" placeholder="United States">
                            </p>
                            <p class="row-in-form">
                                <label for="country">Province<span>*</span></label>
                                <input  type="text" name="province" value="" placeholder="">
                            </p>
                            <p class="row-in-form">
                                <label for="zip-code">Postcode / ZIP:</label>
                                <input  type="number" name="zipcode" value="" placeholder="Your postal code">
                            </p>
                            <p class="row-in-form">
                                <label for="city">Town / City<span>*</span></label>
                                <input  type="text" name="city" value="" placeholder="City name">
                            </p>
                            <p class="row-in-form fill-wife">
                                <label class="checkbox-field">
                                    <input name="ship_different" id="shipBoxCheck"  value="check" type="checkbox">
                                    <span>Ship to a different address?</span>
                                </label>
                            </p>
                    </div>
                </div>
                <div class="col-md-12" id="shipping_box">
                    <div class="wrap-address-billing">
                        <h3 class="box-title">Shipping Address</h3>
                            <p class="row-in-form">
                                <label for="fname">first name<span>*</span></label>
                                <input  type="text" name="s_fname" value="" placeholder="Your name">
                            </p>
                            <p class="row-in-form">
                                <label for="lname">last name<span>*</span></label>
                                <input  type="text" name="s_lname" value="" placeholder="Your last name">
                            </p>
                            <p class="row-in-form">
                                <label for="email">Email Addreess:</label>
                                <input  type="email" name="s_email" value="" placeholder="Type your email">
                            </p>
                            <p class="row-in-form">
                                <label for="phone">Phone number<span>*</span></label>
                                <input  type="number" name="s_phone" value="" placeholder="10 digits format">
                            </p>
                            <p class="row-in-form">
                                <label for="phone">Line 1<span>*</span></label>
                                <input  type="text" name="s_line1" value="" placeholder="">
                            </p>
                            <p class="row-in-form">
                                <label for="phone">Line 2<span>*</span></label>
                                <input  type="text" name="s_line2" value="" placeholder="">
                            </p>
                            <p class="row-in-form">
                                <label for="country">Country<span>*</span></label>
                                <input  type="text" name="s_country" value="" placeholder="United States">
                            </p>
                            <p class="row-in-form">
                                <label for="country">Province<span>*</span></label>
                                <input  type="text" name="s_province" value="" placeholder="">
                            </p>
                            <p class="row-in-form">
                                <label for="zip-code">Postcode / ZIP:</label>
                                <input  type="number" name="s_zipcode" value="" placeholder="Your postal code">
                            </p>
                            <p class="row-in-form">
                                <label for="city">Town / City<span>*</span></label>
                                <input  type="text" name="s_city" value="" placeholder="City name">
                            </p>
                    </div>
                </div>
            </div>
            
            <div class="summary summary-checkout">
                <div class="summary-item payment-method">
                    <h4 class="title-box">Payment Method</h4>
                    <p class="summary-info"><span class="title">Check / Money order</span></p>
                    <p class="summary-info"><span class="title">Credit Cart (saved)</span></p>
                    <div class="choose-payment-methods">
                        <label class="payment-method">
                            <input name="payment_method" id="payment-method-bank" value="cod" type="radio">
                            <span>Cash on delivery</span>
                            <span class="payment-desc">Order now and pay on delivery</span>
                        </label>
                        <label class="payment-method">
                            <input name="payment_method" id="payment-method-visa" value="card" type="radio">
                            <span>Debit / Credit Card</span>
                            <span class="payment-desc">There are many variations of passages of Lorem Ipsum available</span>
                        </label>
                        <label class="payment-method">
                            <input name="payment_method" id="payment-method-paypal" value="paypal" type="radio">
                            <span>Paypal</span>
                            <span class="payment-desc">You can pay with your credit</span>
                            <span class="payment-desc">card if you don't have a paypal account</span>
                        </label>
                    </div>
                    @if (Session::has("checkout"))
                    <p class="summary-info grand-total"><span>Grand Total</span> <span class="grand-total-price">${{ session::get("checkout")['total'] }}</span></p>
                    @endif
                    <button type="submit" class="btn btn-primary" form="billing_form">Place order now</button>
                </div>
                <div class="summary-item shipping-method">
                    <h4 class="title-box f-title">Shipping method</h4>
                    <p class="summary-info"><span class="title">Flat Rate</span></p>
                    <p class="summary-info"><span class="title">Fixed $0</span></p>
                </div>
            </div>
            </form>

        </div><!--end main content area-->
    </div><!--end container-->

</main>
<script>
    let shipForm = document.querySelector("#shipping_box");
    let shipBox = document.querySelector("#shipBoxCheck");
    shipBox.addEventListener("change",function(e){
        if(e.target.checked)
        {
            shipForm.style.display = "block";
        }else
        {
            shipForm.style.display = "none";
        }
    });
</script>