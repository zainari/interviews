
<style>
    /* ===========================
   FOOTER STYLE LIKE ZEROLIFESTYLE
=========================== */


</style>
<footer class="zl-footer">

    <div class="footer-container">

        <!-- Column 1 -->
        <div class="footer-col">
            <h4>About Us</h4>
            <p>
                We provide premium quality smart watches, earbuds,
                fitness accessories at affordable prices.
            </p>
        </div>

        <!-- Column 2 -->
        <div class="footer-col">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('product') }}">Products</a></li>
                <li><a href="{{ url('aboutpage') }}">About</a></li>
                <li><a href="{{ url('contact') }}">Contact</a></li>
            </ul>
        </div>

        <!-- Column 3 -->
        <div class="footer-col">
            <h4>Support</h4>
            <ul>
                <li><a href="#">Return Policy</a></li>
                <li><a href="#">Shipping Info</a></li>
                <li><a href="#">Warranty</a></li>
                <li><a href="#">FAQs</a></li>
            </ul>
        </div>

        <!-- Column 4 -->
        <div class="footer-col">
            <h4>Follow Us</h4>
            <div class="footer-social">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-youtube"></i></a>
                <a href="#"><i class="fa fa-whatsapp"></i></a>
            </div>
        </div>

    </div>

    <hr>

    <div class="footer-bottom">
        <p>© {{ date('Y') }} Zain Store — All Rights Reserved.</p>
    </div>
</footer>
