<?php
$name = $newsprovider[0]->name;
$text = $newsprovider[0]->post;
$time = date('Y-m-d', strtotime($newsprovider[0]->date_modified));
?>
<!-- Main Container -->
<section class="main-container col2-right-layout bounceInUp animated">
    <div class="main container">
        <div class="row">
            <div class="col-main col-sm-9" style="margin-left: 0">
                <div class="page-title">
                    <h2>Новости</h2>
                </div>
                <div class="blog-wrapper" id="main">
                    <div class="site-content" id="primary">
                        <div role="main" id="content">
                            <article class="blog_entry clearfix" >
                                <header class="blog_entry-header clearfix">
                                    <div class="blog_entry-header-inner">
                                        <h2 class="blog_entry-title"><?=$name?></h2>
                                    </div>
                                    <!--blog_entry-header-inner-->
                                </header>
                                <!--blog_entry-header clearfix-->
                                <div class="entry-content">
                                    <div class="featured-thumb"><a href="#"><img alt="blog-img4" src="images/blog-img1.jpg"></a></div>
                                    <div class="entry-content">
                                        <?=$text?>
                                    </div>
                                </div>
                                <footer class="entry-meta">Опубликовано
                                    <time datetime="<?=$time?>" class="entry-date"><?=$time?></time>
                                </footer>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
            <aside class="col-right sidebar col-sm-3">
                <div role="complementary" class="widget_wrapper13" id="secondary">
                    <div class="popular-posts widget widget__sidebar" id="recent-posts-4">
                        <h3 class="widget-title">Most Popular Post</h3>
                        <div class="widget-content">
                            <ul class="posts-list unstyled clearfix">
                                <li>
                                    <figure class="featured-thumb"> <a href="blog_detail.html"> <img width="80" height="53" alt="blog image" src="images/blog-img1.jpg"> </a> </figure>
                                    <!--featured-thumb-->
                                    <h4><a title="Pellentesque posuere" href="blog_detail.html">Pellentesque posuere</a></h4>
                                    <p class="post-meta"><i class="icon-calendar"></i>
                                        <time datetime="2014-07-10T07:09:31+00:00" class="entry-date">Jul 10, 2014</time>
                                        .</p>
                                </li>
                                <li>
                                    <figure class="featured-thumb"> <a href="blog_detail.html"> <img width="80" height="53" alt="blog image" src="images/blog-img1.jpg"> </a> </figure>
                                    <!--featured-thumb-->
                                    <h4><a title="Dolor lorem ipsum" href="blog_detail.html">Dolor lorem ipsum</a></h4>
                                    <p class="post-meta"><i class="icon-calendar"></i>
                                        <time datetime="2014-07-10T07:01:18+00:00" class="entry-date">Jul 10, 2014</time>
                                        .</p>
                                </li>
                                <li>
                                    <figure class="featured-thumb"> <a href="blog_detail.html"> <img width="80" height="53" alt="blog image" src="images/blog-img1.jpg"> </a> </figure>
                                    <!--featured-thumb-->
                                    <h4><a title="Aliquam eget sapien placerat" href="blog_detail.html">Aliquam eget sapien placerat</a></h4>
                                    <p class="post-meta"><i class="icon-calendar"></i>
                                        <time datetime="2014-07-10T06:59:14+00:00" class="entry-date">Jul 10, 2014</time>
                                        .</p>
                                </li>
                                <li>
                                    <figure class="featured-thumb"> <a href="blog_detail.html"> <img width="80" height="53" alt="blog image" src="images/blog-img1.jpg"> </a> </figure>
                                    <!--featured-thumb-->
                                    <h4><a title="Pellentesque habitant morbi" href="blog_detail.html">Pellentesque habitant morbi</a></h4>
                                    <p class="post-meta"><i class="icon-calendar"></i>
                                        <time datetime="2014-07-10T06:53:43+00:00" class="entry-date">Jul 10, 2014</time>
                                        .</p>
                                </li>
                            </ul>
                        </div>
                        <!--widget-content-->
                    </div>
                    <div class="popular-posts widget widget_categories" id="categories-2">
                        <h3 class="widget-title">Categories</h3>
                        <ul>
                            <li class="cat-item cat-item-19599"><a href="#">First Category</a></li>
                            <li class="cat-item cat-item-19599"><a href="#">Second Category</a></li>
                        </ul>
                    </div>
                    <!-- Banner Ad Block -->
                    <div class="ad-spots widget widget__sidebar">
                        <a target="_self" href="#" title=""><img alt="offer banner" src="images/block1.jpg"></a>
                        <a target="_self" href="#" title=""><img alt="offer banner" src="images/block1.jpg"></a>
                    </div>
                    <!-- Banner Text Block -->
                    <div class="text-widget widget widget__sidebar">
                        <h3 class="widget-title">Text Widget</h3>
                        <div class="widget-content">Mauris at blandit erat. Nam vel tortor non quam scelerisque cursus. Praesent nunc vitae magna pellentesque auctor. Quisque id lectus.<br>
                            <br>
                            Massa, eget eleifend tellus. Proin nec ante leo ssim nunc sit amet velit malesuada pharetra. Nulla neque sapien, sollicitudin non ornare quis, malesuada.</div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>
<!-- Main Container End -->