<?php
use yii\bootstrap\ActiveForm;
?>
<!-- Navbar -->
<nav>
    <div class="container">
        <div class="row">
            <div class="mm-toggle-wrap">
                <div class="mm-toggle"><i class="icon-reorder"></i><span class="mm-label">Menu</span> </div>
            </div>
            <div class="nav-inner col-lg-12">
                <ul id="nav" class="hidden-xs">
                    <li class="level0 parent drop-menu"><a href="#"><span>Главная</span></a>
                        <ul class="level1">
                            <li class="level1 nav-11-1 first"> <a href="grid.html"> <span>Grid </span> </a> </li>
                            <li class="level1 nav-11-2"> <a href="list.html"> <span>List </span> </a> </li>
                            <li class="level1 nav-11-3"> <a href="product_detail.html"> <span>Product Detail </span> </a> </li>
                            <li class="level1 nav-11-4"> <a href="shopping_cart.html"> <span>Shopping Cart </span> </a> </li>
                            <li class="level1 nav-11-5"> <a href="checkout.html"> <span>Checkout </span> </a>
                                <ul class="level1">
                                    <li class="level2 nav-11-4-1 first">
                                        <a href="checkout_billing_info.html"><span>Billing Info</span></a></li>
                                    <li class="level2 nav-11-4-2 last"><a href="checkout_method.html"><span>Checkout Method</span></a></li>
                                </ul>
                            </li>
                            <li class="level1 nav-11-6"> <a href="wishlist.html"> <span>Wishlist</span> </a> </li>
                            <li class="level1 nav-11-7"> <a href="dashboard.html"> <span>Dashboard </span> </a> </li>
                            <li class="level1 nav-11-8"> <a href="multiple_addresses.html"> <span>Multiple Addresses</span> </a> </li>
                            <li class="level1 nav-11-9"> <a href="about_us.html"> <span>About us </span> </a> </li>
                            <li class="level1 nav-11-9"> <a href="compare.html"> <span>Compare </span> </a> </li>
                            <li class="level1 nav-11-9"> <a href="delivery.html"> <span>Delivery </span> </a> </li>
                            <li class="level1 nav-11-9"> <a href="faq.html"> <span>FAQ </span> </a> </li>
                            <li class="level1 nav-11-9"> <a href="quick_view.html"> <span>Quick View </span> </a> </li>
                            <li class="level1 nav-11-9"> <a href="newsletter.html"> <span>Newsletter </span> </a> </li>
                            <li class="level1 nav-11-9"> <a href="contact_us.html"> <span>Contact Us </span> </a> </li>
                            <li class="level1 nav-11-9"> <a href="sitemap.html"> <span>Sitemap </span> </a> </li>
                            <li class="level1 nav-11-10"> <a href="blog.html"> <span>Blog </span> </a>
                                <ul class="level1">
                                    <li class="level2 nav-11-10-1 last"><a href="blog_detail.html"><span>Blog Detail</span></a></li>
                                </ul>
                            </li>

                            <li class="level1 nav-11-14 last"> <a href="404error.html"> <span>404 Error Page </span> </a> </li>
                        </ul>
                    </li>
                    <li class="mega-menu"><a href="grid.html" class="level-top"><span>Женщинам</span></a>
                        <div class="level0-wrapper dropdown-6col">
                            <div class="container">
                                <div class="level0-wrapper2">
                                    <div class="col-1">
                                        <div class="nav-block nav-block-center">
                                            <ul class="level0">
                                                <li class="level1 nav-6-1 parent item"><a href="grid.html" class=""><span>Stylish Bag</span></a>
                                                    <ul class="level1">
                                                        <li class="level2 nav-6-1-1"><a href="grid.html" class=""><span>Clutch Handbags</span></a></li>
                                                        <li class="level2 nav-6-1-1"><a href="grid.html" class=""><span>Diaper Bags</span></a></li>
                                                        <li class="level2 nav-6-1-1"><a href="grid.html" class=""><span>Bags</span></a></li>
                                                        <li class="level2 nav-6-1-1"><a href="grid.html" class=""><span>Hobo handbags</span></a></li>
                                                    </ul>
                                                </li>
                                                <li class="level1 nav-6-1 parent item"><a href="grid.html"><span>Material Bag</span></a>
                                                    <ul class="level1">
                                                        <li class="level2 nav-6-1-1"><a href="grid.html"><span>Beaded Handbags</span></a></li>
                                                        <li class="level2 nav-6-1-1"><a href="grid.html"><span>Fabric Handbags</span></a></li>
                                                        <li class="level2 nav-6-1-1"><a href="grid.html"><span>Handbags</span></a></li>
                                                        <li class="level2 nav-6-1-1"><a href="grid.html"><span>Leather Handbags</span></a></li>
                                                    </ul>
                                                </li>
                                                <li class="level1 nav-6-1 parent item"><a href="grid.html"><span>Shoes</span></a>
                                                    <ul class="level1">
                                                        <li class="level2 nav-6-1-1"><a href="grid.html"><span>Flat Shoes</span></a></li>
                                                        <li class="level2 nav-6-1-1"><a href="grid.html"><span>Flat Sandals</span></a></li>
                                                        <li class="level2 nav-6-1-1"><a href="grid.html"><span>Boots</span></a></li>
                                                        <li class="level2 nav-6-1-1"><a href="grid.html"><span>Heels</span></a></li>
                                                    </ul>
                                                </li>
                                                <li class="level1 nav-6-1 parent item"><a href="grid.html"><span>Jwellery</span></a>
                                                    <ul class="level1">
                                                        <li class="level2 nav-6-1-1"><a href="grid.html"><span>Bracelets</span></a></li>
                                                        <li class="level2 nav-6-1-1"><a href="grid.html"><span>Necklaces &amp; Pendent</span></a></li>
                                                        <li class="level2 nav-6-1-1"><a href="grid.html"><span>Pendants</span></a></li>
                                                        <li class="level2 nav-6-1-1"><a href="grid.html"><span>Pins &amp; Brooches</span></a></li>
                                                    </ul>
                                                </li>
                                                <li class="level1 nav-6-1 parent item"><a href="grid.html"><span>Dresses</span></a>
                                                    <ul class="level1">
                                                        <li class="level2 nav-6-1-1"><a href="grid.html"><span>Casual Dresses</span></a></li>
                                                        <li class="level2 nav-6-1-1"><a href="grid.html"><span>Evening</span></a></li>
                                                        <li class="level2 nav-6-1-1"><a href="grid.html"><span>Designer</span></a></li>
                                                        <li class="level2 nav-6-1-1"><a href="grid.html"><span>Party</span></a></li>
                                                    </ul>
                                                </li>
                                                <li class="level1 nav-6-1 parent item"><a href="grid.html"><span>Swimwear</span></a>
                                                    <ul class="level1">
                                                        <li class="level2 nav-6-1-1"><a href="grid.html"><span>Swimsuits</span></a></li>
                                                        <li class="level2 nav-6-1-1"><a href="grid.html"><span>Beach Clothing</span></a></li>
                                                        <li class="level2 nav-6-1-1"><a href="grid.html"><span>Clothing</span></a></li>
                                                        <li class="level2 nav-6-1-1"><a href="grid.html"><span>Bikinis</span></a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--nav-block nav-block-center-->
                                    <div class="col-2">
                                        <div class="menu_image"><a href="#" title=""><img src="/images/new/menu_image.jpg" alt="menu_image"></a></div>
                                        <div class="menu_image1"><a href="#" title=""><img src="/images/new/menu_image.jpg" alt="menu_image"></a></div>
                                    </div>
                                </div>
                                <!--level0-wrapper2--> </div>
                        </div>
                    </li>
                    <li class="mega-menu"><a href="grid.html" class="level-top"><span>Мужчинам</span></a>
                        <div class="level0-wrapper dropdown-6col">
                            <div class="container">
                                <div class="level0-wrapper2">
                                    <div class="nav-block nav-block-center">
                                        <ul class="level0">
                                            <li class="level1 nav-6-1 parent item"><a href="grid.html" class=""><span>Shoes</span></a>
                                                <ul class="level1">
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Sport Shoes</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Casual Shoes</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Leather Shoes</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>canvas shoes</span></a></li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-6-1 parent item"><a href="grid.html"><span>Dresses</span></a>
                                                <ul class="level1">
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Casual Dresses</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Evening</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Designer</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Party</span></a></li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-6-1 parent item"><a href="grid.html"><span>Jackets</span></a>
                                                <ul class="level1">
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Coats</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Formal Jackets</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Leather Jackets</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Blazers</span></a></li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-6-1 parent item"><a href="grid.html"><span>Watches</span></a>
                                                <ul class="level1">
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Fasttrack</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Casio</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Titan</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Tommy-Hilfiger</span></a></li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-6-1 parent item"><a href="grid.html"><span>Sunglasses</span></a>
                                                <ul class="level1">
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Ray Ban</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Fasttrack</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Police</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Oakley</span></a></li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-6-1 parent item"><a href="grid.html"><span>Accesories</span></a>
                                                <ul class="level1">
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Backpacks</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Wallets</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Laptops Bags</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Belts</span></a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <!--level0-wrapper2-->
                                    <div class="nav-add">
                                        <div class="push_item">
                                            <div class="push_img"><a href="#"><img alt="sunglass" src="/images/new/menu_man_sunglass.png"></a></div>
                                            <div class="push_text">Lorem Ipsum is simply dummy text of the printing</div>
                                        </div>
                                        <div class="push_item">
                                            <div class="push_img"><a href="#"><img alt="watch" src="/images/new/menu_man_sunglass.png"></a></div>
                                            <div class="push_text">Lorem Ipsum is simply dummy text of the printing</div>
                                        </div>
                                        <div class="push_item">
                                            <div class="push_img"><a href="#"><img alt="jeans" src="/images/new/menu_man_sunglass.png"></a></div>
                                            <div class="push_text">Lorem Ipsum is simply dummy text of the printing</div>
                                        </div>
                                        <div class="push_item push_item_last">
                                            <div class="push_img"><a href="#"><img alt="shoes" src="/images/new/menu_man_sunglass.png"></a></div>
                                            <div class="push_text">Lorem Ipsum is simply dummy text of the printing</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
<!--                    <li class="mega-menu"><a href="grid.html" class="level-top"><span>Электроника</span></a>-->
<!--                        <div class="level0-wrapper dropdown-6col">-->
<!--                            <div class="container">-->
<!--                                <div class="level0-wrapper2">-->
<!--                                    <div class="nav-block nav-block-center">-->
<!--                                        <ul class="level0">-->
<!--                                            <li class="level1 nav-6-1 parent item"><a href="grid.html"><span>Mobiles</span></a>-->
<!--                                                <ul class="level1">-->
<!--                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Samsung</span></a></li>-->
<!--                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Nokia</span></a></li>-->
<!--                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>IPhone</span></a></li>-->
<!--                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Sony</span></a></li>-->
<!--                                                </ul>-->
<!--                                            </li>-->
<!--                                            <li class="level1 nav-6-1 parent item"><a href="grid.html" class=""><span>Accesories</span></a>-->
<!--                                                <ul class="level1">-->
<!--                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Mobile Memory Cards</span></a></li>-->
<!--                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Cases &amp; Covers</span></a></li>-->
<!--                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Mobile Headphones</span></a></li>-->
<!--                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Bluetooth Headsets</span></a></li>-->
<!--                                                </ul>-->
<!--                                            </li>-->
<!--                                            <li class="level1 nav-6-1 parent item"><a href="grid.html"><span>Cameras</span></a>-->
<!--                                                <ul class="level1">-->
<!--                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Camcorders</span></a></li>-->
<!--                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Point &amp; Shoot</span></a></li>-->
<!--                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Digital SLR</span></a></li>-->
<!--                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Camera Accesories</span></a></li>-->
<!--                                                </ul>-->
<!--                                            </li>-->
<!--                                            <li class="level1 nav-6-1 parent item"><a href="grid.html"><span>Audio &amp; Video</span></a>-->
<!--                                                <ul class="level1">-->
<!--                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>MP3 Players</span></a></li>-->
<!--                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>IPods</span></a></li>-->
<!--                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Speakers</span></a></li>-->
<!--                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Video Players</span></a></li>-->
<!--                                                </ul>-->
<!--                                            </li>-->
<!--                                            <li class="level1 nav-6-1 parent item"><a href="grid.html"><span>Computer</span></a>-->
<!--                                                <ul class="level1">-->
<!--                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>External Hard Disk</span></a></li>-->
<!--                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Pendrives</span></a></li>-->
<!--                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Headphones</span></a></li>-->
<!--                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>PC Components</span></a></li>-->
<!--                                                </ul>-->
<!--                                            </li>-->
<!--                                            <li class="level1 nav-6-1 parent item"><a href="grid.html"><span>Appliances</span></a>-->
<!--                                                <ul class="level1">-->
<!--                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Vaccum Cleaners</span></a></li>-->
<!--                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Indoor Lighting</span></a></li>-->
<!--                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Kitchen Tools</span></a></li>-->
<!--                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Water Purifier</span></a></li>-->
<!--                                                </ul>-->
<!--                                            </li>-->
<!--                                        </ul>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <!--level0-wrapper2-->
<!--                                <div class="nav-add">-->
<!--                                    <div class="push_item">-->
<!--                                        <div class="push_img"><a href="#"><img alt="phone" src="/images/new/menu_ele_phone.png"></a></div>-->
<!--                                        <div class="push_text">Lorem Ipsum is simply dummy text of the printing</div>-->
<!--                                    </div>-->
<!--                                    <div class="push_item">-->
<!--                                        <div class="push_img"><a href="#"><img alt="camera" src="/images/new/menu_ele_phone.png"></a></div>-->
<!--                                        <div class="push_text">Lorem Ipsum is simply dummy text of the printing</div>-->
<!--                                    </div>-->
<!--                                    <div class="push_item">-->
<!--                                        <div class="push_img"><a href="#"><img alt="ipod" src="/images/new/menu_ele_phone.png"></a></div>-->
<!--                                        <div class="push_text">Lorem Ipsum is simply dummy text of the printing</div>-->
<!--                                    </div>-->
<!--                                    <div class="push_item push_item_last">-->
<!--                                        <div class="push_img"><a href="#"><img alt="laptop" src="/images/new/menu_ele_phone.png"></a></div>-->
<!--                                        <div class="push_text">Lorem Ipsum is simply dummy text of the printing</div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </li>-->
                    <li class="mega-menu"><a class="level-top" href="grid.html"><span>Аксессуары</span></a>
                        <div class="level0-wrapper dropdown-6col">
                            <div class="container">
                                <div class="level0-wrapper2">
                                    <div class="nav-block nav-block-center grid12-8 itemgrid itemgrid-4col">
                                        <ul class="level0">
                                            <li class="level1 nav-6-1 parent item"><a href="grid.html"><span>Living Room</span></a>
                                                <ul class="level1">
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Racks &amp; Cabinets</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Sofas</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Chairs</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Tables</span></a></li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-6-1 parent item"><a href="grid.html" class=""><span>Dining &amp; Bar</span></a>
                                                <ul class="level1">
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Dining Table Sets</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Serving Trolleys</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Bar Counters</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Dining Cabinets</span></a></li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-6-1 parent item"><a href="grid.html"><span>Bedroom</span></a>
                                                <ul class="level1">
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Beds</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Chest of Drawers</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Wardrobes &amp; Almirahs</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Nightstands</span></a></li>
                                                </ul>
                                            </li>
                                            <li class="level1 nav-6-1 parent item"><a href="grid.html"><span>Kitchen</span></a>
                                                <ul class="level1">
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Kitchen Racks</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Kitchen Fillings</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Wall Units</span></a></li>
                                                    <li class="level2 nav-6-1-1"><a href="grid.html"><span>Benches &amp; Stools</span></a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <!--nav-block nav-block-center-->
                                    <div class="nav-block nav-block-right std grid12-4"><a href="#"><img src="/images/new/menu_furniture_2.png" alt="furniture"></a> </div>
                                    <!--nav-block nav-block-right std grid12-4--> </div>
                            </div>
                            <!--level0-wrapper2-->
                        </div>
                    </li>
                    <li class="level0 nav-8 level-top"><a href="grid.html" class="level-top"><span>Детям</span></a></li>
                    <li class="nav-custom-link mega-menu"><a class="level-top" href="#"><span>Все категории</span></a>
                        <div class="level0-wrapper custom-menu">
                            <div class="header-nav-dropdown-wrapper clearer">
                                <div class="grid12-3">
                                    <h4 class="heading">GET 20% OFF, 48 HOURS ONLY!</h4>
                                    <div class="heart-icon">&nbsp;</div>
                                    <p>Our designed to deliver almost everything you want to do online.</p>
                                    <div><img  src="/images/new/custom-img1.jpg" alt=""></div>
                                </div>
                                <div class="grid12-3">
                                    <h4 class="heading">GET 20% OFF, 48 HOURS ONLY!</h4>
                                    <a href="#">
                                        <div class="icon-star"></div>
                                    </a>
                                    <p>Responsive design is a Web design to provide an optimal navigation.</p>
                                    <div><img  src="/images/new/custom-img1.jpg" alt=""></div>
                                </div>
                                <div class="grid12-3">
                                    <h4 class="heading">GET 20% OFF, 48 HOURS ONLY!</h4>
                                    <a href="#">
                                        <div class="custom-icon"></div>
                                    </a>
                                    <p>Our font delivery service is built upon a reliable, global network of servers.</p>
                                    <div><img  src="/images/new/custom-img1.jpg" alt=""></div>
                                </div>
                                <div class="grid12-3">
                                    <h4 class="heading">GET 20% OFF, 48 HOURS ONLY!</h4>
                                    <a href="#">
                                        <div class="icon-custom-grid"></div>
                                    </a>
                                    <p>Smart Product Grid is uses maximum available width of the screen.</p>
                                    <div><img  src="/images/new/custom-img1.jpg" alt=""></div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </li>
                </ul>
                <!-- Search-col -->
                <div class="search-box pull-right">
                    <?php ActiveForm::begin(['action'=>'/catalog/','method'=>'get'])?>
                        <input class="search" autocomplete="off" type="text" placeholder="Введите артикул или название" maxlength="70" name="searchword" id="search">
                        <button type="submit" class="search-btn-bg"><span class="glyphicon glyphicon-search"></span>&nbsp;</button>
                        <button type="button" class="search-btn-bg hide search-button-toggle" data-toggle="tooltip" data-placement="top" title="Общий поиск"><span class="glyphicon glyphicon-globe"></span>&nbsp;</button>
                        <button type="button" class="search-btn-bg search-button-toggle" data-toggle="tooltip" data-placement="top" title="Поиск внутри текущей категории"><span class="glyphicon glyphicon-screenshot"></span>&nbsp;</button>
                    <?php ActiveForm::end();?>
                </div>
                <!-- End Search-col -->

            </div>
        </div>
    </div>
</nav>
<!-- end nav -->