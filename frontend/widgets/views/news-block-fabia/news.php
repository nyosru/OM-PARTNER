<?php if($news) { ?>
    <section class="latest-blog">
        <div class="container">
            <div class="new_title center">
                <h2>Последние новости</h2>
            </div>
            <div class="row">
                <?php
                foreach($news as $item){
                   echo $this->render('_item',['model'=>$item]);
                }
                ?>
            </div>
        </div>
    </section>
<?php } ?>
