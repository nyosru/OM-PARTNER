<?php if((integer)($old_price)){ ?>
    <div class="price-box">
        <p class="old-price">
            <span class="price-label"></span>
            <span class="price"><?=round($old_price)?> &#8381;</span>
        </p>
        <p class="special-price">
            <span class="price-label"></span>
            <span class="price"><?=round($price)?> &#8381;</span>
        </p>
    </div>
<?php } else { ?>
    <div class="price-box">
        <span class="regular-price">
            <span class="price"><?=round($price)?> &#8381;</span>
        </span>
    </div>
<?php } ?>