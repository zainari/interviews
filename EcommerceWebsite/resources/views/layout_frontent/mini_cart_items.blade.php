<!-- Side Cart Drawer -->
<div id="cartDrawer" class="cart-drawer" style="position: fixed; right: -400px; top: 0; width: 380px; height: 100vh; background: #fff; z-index: 9999; transition: 0.4s; box-shadow: -10px 0 30px rgba(0,0,0,0.1); padding: 30px;">
    <div style="display:flex; justify-content:space-between; border-bottom: 1px solid #eee; padding-bottom: 20px;">
        <h3 style="text-transform: uppercase; letter-spacing: 1px;">Your Bag</h3>
        <span onclick="toggleCart()" style="cursor:pointer; font-size: 20px;">&times;</span>
    </div>
    
    <div id="drawer-items" style="padding-top: 20px;">
        <!-- Cart items will be listed here via AJAX or Session loop -->
    </div>

    <div style="position: absolute; bottom: 30px; width: 85%;">
        <a href="{{ route('cart.index') }}" class="btn-add-bag" style="text-align: center; display: block; text-decoration: none;">View Full Bag</a>
    </div>
</div>

<div id="cartOverlay" onclick="toggleCart()" style="display:none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 9998;"></div>

<style>
.cart-drawer.open { right: 0 !important; }
</style>

<script>
function toggleCart() {
    let drawer = document.getElementById('cartDrawer');
    let overlay = document.getElementById('cartOverlay');
    drawer.classList.toggle('open');
    overlay.style.display = overlay.style.display === 'none' ? 'block' : 'none';
}
</script>