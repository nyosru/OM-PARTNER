<?php
use yii\helpers\Html;
$this -> title = 'Корзина';

$del_add='<select id="shipaddr" name="address">';
foreach($addr as $key=>$value){
    if($key != $default) {
        $options .= '<option value="' . $key . '">' . $value . '</option>';
    }else{
        $first .= '<option value="' . $key . '">' . $value . '</option>';
    }
}



$del_add .= $first;
$del_add .= $options;
$del_add .= '</select>';

?>
<!-- layout: main-layout -->


<!-- Main Container -->
<section class="main-container col1-layout">
<div class="main container">
<div class="col-main">
<div class="cart">
<div class="page-title">
    <h2>Товары в моей корзине</h2>
</div>
<div class="table-responsive">
    <form method="post" action="#">
        <fieldset>
            <table class="data-table cart-table" id="shopping-cart-table">
                <thead>
                <tr class="first last">
                    <th></th>
                    <th style="width: 33%;"><span class="nobr">Наименование</span></th>
                    <th><span class="nobr">Размер</span></th>
                    <th><span class="nobr">Цена</span></th>
                    <th><span class="nobr">Количество</span></th>
                    <th><span class="nobr">Действия</span></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </fieldset>
    </form>
</div>
<!-- BEGIN CART COLLATERALS -->
<div class="cart-collaterals row">
<div class="col-sm-4">
<div class="shipping">
<h3>Estimate Shipping and Tax</h3>
<div class="shipping-form">
<form id="shipping-zip-form" method="post" action="#">
<p>Enter your destination to get a shipping estimate.</p>
<ul class="form-list">
<li>
<label class="required" for="country"><em>*</em>Country</label>
<div class="input-box">
<select title="Country" class="validate-select" id="country" name="country_id">
<option value="Select">Select</option>
<option value="AF">Afghanistan</option>
<option value="AX">Åland Islands</option>
<option value="AL">Albania</option>
<option value="DZ">Algeria</option>
<option value="AS">American Samoa</option>
<option value="AD">Andorra</option>
<option value="AO">Angola</option>
<option value="AI">Anguilla</option>
<option value="AQ">Antarctica</option>
<option value="AG">Antigua and Barbuda</option>
<option value="AR">Argentina</option>
<option value="AM">Armenia</option>
<option value="AW">Aruba</option>
<option value="AU">Australia</option>
<option value="AT">Austria</option>
<option value="AZ">Azerbaijan</option>
<option value="BS">Bahamas</option>
<option value="BH">Bahrain</option>
<option value="BD">Bangladesh</option>
<option value="BB">Barbados</option>
<option value="BY">Belarus</option>
<option value="BE">Belgium</option>
<option value="BZ">Belize</option>
<option value="BJ">Benin</option>
<option value="BM">Bermuda</option>
<option value="BT">Bhutan</option>
<option value="BO">Bolivia</option>
<option value="BA">Bosnia and Herzegovina</option>
<option value="BW">Botswana</option>
<option value="BV">Bouvet Island</option>
<option value="BR">Brazil</option>
<option value="IO">British Indian Ocean Territory</option>
<option value="VG">British Virgin Islands</option>
<option value="BN">Brunei</option>
<option value="BG">Bulgaria</option>
<option value="BF">Burkina Faso</option>
<option value="BI">Burundi</option>
<option value="KH">Cambodia</option>
<option value="CM">Cameroon</option>
<option value="CA">Canada</option>
<option value="CV">Cape Verde</option>
<option value="KY">Cayman Islands</option>
<option value="CF">Central African Republic</option>
<option value="TD">Chad</option>
<option value="CL">Chile</option>
<option value="CN">China</option>
<option value="CX">Christmas Island</option>
<option value="CC">Cocos [Keeling] Islands</option>
<option value="CO">Colombia</option>
<option value="KM">Comoros</option>
<option value="CG">Congo - Brazzaville</option>
<option value="CD">Congo - Kinshasa</option>
<option value="CK">Cook Islands</option>
<option value="CR">Costa Rica</option>
<option value="CI">Côte d’Ivoire</option>
<option value="HR">Croatia</option>
<option value="CU">Cuba</option>
<option value="CY">Cyprus</option>
<option value="CZ">Czech Republic</option>
<option value="DK">Denmark</option>
<option value="DJ">Djibouti</option>
<option value="DM">Dominica</option>
<option value="DO">Dominican Republic</option>
<option value="EC">Ecuador</option>
<option value="EG">Egypt</option>
<option value="SV">El Salvador</option>
<option value="GQ">Equatorial Guinea</option>
<option value="ER">Eritrea</option>
<option value="EE">Estonia</option>
<option value="ET">Ethiopia</option>
<option value="FK">Falkland Islands</option>
<option value="FO">Faroe Islands</option>
<option value="FJ">Fiji</option>
<option value="FI">Finland</option>
<option value="FR">France</option>
<option value="GF">French Guiana</option>
<option value="PF">French Polynesia</option>
<option value="TF">French Southern Territories</option>
<option value="GA">Gabon</option>
<option value="GM">Gambia</option>
<option value="GE">Georgia</option>
<option value="DE">Germany</option>
<option value="GH">Ghana</option>
<option value="GI">Gibraltar</option>
<option value="GR">Greece</option>
<option value="GL">Greenland</option>
<option value="GD">Grenada</option>
<option value="GP">Guadeloupe</option>
<option value="GU">Guam</option>
<option value="GT">Guatemala</option>
<option value="GG">Guernsey</option>
<option value="GN">Guinea</option>
<option value="GW">Guinea-Bissau</option>
<option value="GY">Guyana</option>
<option value="HT">Haiti</option>
<option value="HM">Heard Island and McDonald Islands</option>
<option value="HN">Honduras</option>
<option value="HK">Hong Kong SAR China</option>
<option value="HU">Hungary</option>
<option value="IS">Iceland</option>
<option value="IN">India</option>
<option value="ID">Indonesia</option>
<option value="IR">Iran</option>
<option value="IQ">Iraq</option>
<option value="IE">Ireland</option>
<option value="IM">Isle of Man</option>
<option value="IL">Israel</option>
<option value="IT">Italy</option>
<option value="JM">Jamaica</option>
<option value="JP">Japan</option>
<option value="JE">Jersey</option>
<option value="JO">Jordan</option>
<option value="KZ">Kazakhstan</option>
<option value="KE">Kenya</option>
<option value="KI">Kiribati</option>
<option value="KW">Kuwait</option>
<option value="KG">Kyrgyzstan</option>
<option value="LA">Laos</option>
<option value="LV">Latvia</option>
<option value="LB">Lebanon</option>
<option value="LS">Lesotho</option>
<option value="LR">Liberia</option>
<option value="LY">Libya</option>
<option value="LI">Liechtenstein</option>
<option value="LT">Lithuania</option>
<option value="LU">Luxembourg</option>
<option value="MO">Macau SAR China</option>
<option value="MK">Macedonia</option>
<option value="MG">Madagascar</option>
<option value="MW">Malawi</option>
<option value="MY">Malaysia</option>
<option value="MV">Maldives</option>
<option value="ML">Mali</option>
<option value="MT">Malta</option>
<option value="MH">Marshall Islands</option>
<option value="MQ">Martinique</option>
<option value="MR">Mauritania</option>
<option value="MU">Mauritius</option>
<option value="YT">Mayotte</option>
<option value="MX">Mexico</option>
<option value="FM">Micronesia</option>
<option value="MD">Moldova</option>
<option value="MC">Monaco</option>
<option value="MN">Mongolia</option>
<option value="ME">Montenegro</option>
<option value="MS">Montserrat</option>
<option value="MA">Morocco</option>
<option value="MZ">Mozambique</option>
<option value="MM">Myanmar [Burma]</option>
<option value="NA">Namibia</option>
<option value="NR">Nauru</option>
<option value="NP">Nepal</option>
<option value="NL">Netherlands</option>
<option value="AN">Netherlands Antilles</option>
<option value="NC">New Caledonia</option>
<option value="NZ">New Zealand</option>
<option value="NI">Nicaragua</option>
<option value="NE">Niger</option>
<option value="NG">Nigeria</option>
<option value="NU">Niue</option>
<option value="NF">Norfolk Island</option>
<option value="MP">Northern Mariana Islands</option>
<option value="KP">North Korea</option>
<option value="NO">Norway</option>
<option value="OM">Oman</option>
<option value="PK">Pakistan</option>
<option value="PW">Palau</option>
<option value="PS">Palestinian Territories</option>
<option value="PA">Panama</option>
<option value="PG">Papua New Guinea</option>
<option value="PY">Paraguay</option>
<option value="PE">Peru</option>
<option value="PH">Philippines</option>
<option value="PN">Pitcairn Islands</option>
<option value="PL">Poland</option>
<option value="PT">Portugal</option>
<option value="PR">Puerto Rico</option>
<option value="QA">Qatar</option>
<option value="RE">Réunion</option>
<option value="RO">Romania</option>
<option value="RU">Russia</option>
<option value="RW">Rwanda</option>
<option value="BL">Saint Barthélemy</option>
<option value="SH">Saint Helena</option>
<option value="KN">Saint Kitts and Nevis</option>
<option value="LC">Saint Lucia</option>
<option value="MF">Saint Martin</option>
<option value="PM">Saint Pierre and Miquelon</option>
<option value="VC">Saint Vincent and the Grenadines</option>
<option value="WS">Samoa</option>
<option value="SM">San Marino</option>
<option value="ST">São Tomé and Príncipe</option>
<option value="SA">Saudi Arabia</option>
<option value="SN">Senegal</option>
<option value="RS">Serbia</option>
<option value="SC">Seychelles</option>
<option value="SL">Sierra Leone</option>
<option value="SG">Singapore</option>
<option value="SK">Slovakia</option>
<option value="SI">Slovenia</option>
<option value="SB">Solomon Islands</option>
<option value="SO">Somalia</option>
<option value="ZA">South Africa</option>
<option value="GS">South Georgia and the South Sandwich Islands</option>
<option value="KR">South Korea</option>
<option value="ES">Spain</option>
<option value="LK">Sri Lanka</option>
<option value="SD">Sudan</option>
<option value="SR">Suriname</option>
<option value="SJ">Svalbard and Jan Mayen</option>
<option value="SZ">Swaziland</option>
<option value="SE">Sweden</option>
<option value="CH">Switzerland</option>
<option value="SY">Syria</option>
<option value="TW">Taiwan</option>
<option value="TJ">Tajikistan</option>
<option value="TZ">Tanzania</option>
<option value="TH">Thailand</option>
<option value="TL">Timor-Leste</option>
<option value="TG">Togo</option>
<option value="TK">Tokelau</option>
<option value="TO">Tonga</option>
<option value="TT">Trinidad and Tobago</option>
<option value="TN">Tunisia</option>
<option value="TR">Turkey</option>
<option value="TM">Turkmenistan</option>
<option value="TC">Turks and Caicos Islands</option>
<option value="TV">Tuvalu</option>
<option value="UG">Uganda</option>
<option value="UA">Ukraine</option>
<option value="AE">United Arab Emirates</option>
<option value="GB">United Kingdom</option>
<option selected="selected" value="US">United States</option>
<option value="UY">Uruguay</option>
<option value="UM">U.S. Minor Outlying Islands</option>
<option value="VI">U.S. Virgin Islands</option>
<option value="UZ">Uzbekistan</option>
<option value="VU">Vanuatu</option>
<option value="VA">Vatican City</option>
<option value="VE">Venezuela</option>
<option value="VN">Vietnam</option>
<option value="WF">Wallis and Futuna</option>
<option value="EH">Western Sahara</option>
<option value="YE">Yemen</option>
<option value="ZM">Zambia</option>
<option value="ZW">Zimbabwe</option>
</select>
</div>
</li>
<li>
    <label for="region_id">State/Province</label>
    <div class="input-box">
        <select title="State/Province" name="region_id" id="region_id">
            <option value="">Please select region, state or province</option>
            <option value="1" title="Alabama">Alabama</option>
            <option value="2" title="Alaska">Alaska</option>
            <option value="3" title="American Samoa">American Samoa</option>
            <option value="4" title="Arizona">Arizona</option>
            <option value="5" title="Arkansas">Arkansas</option>
            <option value="6" title="Armed Forces Africa">Armed Forces Africa</option>
            <option value="7" title="Armed Forces Americas">Armed Forces Americas</option>
            <option value="8" title="Armed Forces Canada">Armed Forces Canada</option>
            <option value="9" title="Armed Forces Europe">Armed Forces Europe</option>
            <option value="10" title="Armed Forces Middle East">Armed Forces Middle East</option>
            <option value="11" title="Armed Forces Pacific">Armed Forces Pacific</option>
            <option value="12" title="California">California</option>
            <option value="13" title="Colorado">Colorado</option>
            <option value="14" title="Connecticut">Connecticut</option>
            <option value="15" title="Delaware">Delaware</option>
            <option value="16" title="District of Columbia">District of Columbia</option>
            <option value="17" title="Federated States Of Micronesia">Federated States Of Micronesia</option>
            <option value="18" title="Florida">Florida</option>
            <option value="19" title="Georgia">Georgia</option>
            <option value="20" title="Guam">Guam</option>
            <option value="21" title="Hawaii">Hawaii</option>
            <option value="22" title="Idaho">Idaho</option>
            <option value="23" title="Illinois">Illinois</option>
            <option value="24" title="Indiana">Indiana</option>
            <option value="25" title="Iowa">Iowa</option>
            <option value="26" title="Kansas">Kansas</option>
            <option value="27" title="Kentucky">Kentucky</option>
            <option value="28" title="Louisiana">Louisiana</option>
            <option value="29" title="Maine">Maine</option>
            <option value="30" title="Marshall Islands">Marshall Islands</option>
            <option value="31" title="Maryland">Maryland</option>
            <option value="32" title="Massachusetts">Massachusetts</option>
            <option value="33" title="Michigan">Michigan</option>
            <option value="34" title="Minnesota">Minnesota</option>
            <option value="35" title="Mississippi">Mississippi</option>
            <option value="36" title="Missouri">Missouri</option>
            <option value="37" title="Montana">Montana</option>
            <option value="38" title="Nebraska">Nebraska</option>
            <option value="39" title="Nevada">Nevada</option>
            <option value="40" title="New Hampshire">New Hampshire</option>
            <option value="41" title="New Jersey">New Jersey</option>
            <option value="42" title="New Mexico">New Mexico</option>
            <option value="43" title="New York">New York</option>
            <option value="44" title="North Carolina">North Carolina</option>
            <option value="45" title="North Dakota">North Dakota</option>
            <option value="46" title="Northern Mariana Islands">Northern Mariana Islands</option>
            <option value="47" title="Ohio">Ohio</option>
            <option value="48" title="Oklahoma">Oklahoma</option>
            <option value="49" title="Oregon">Oregon</option>
            <option value="50" title="Palau">Palau</option>
            <option value="51" title="Pennsylvania">Pennsylvania</option>
            <option value="52" title="Puerto Rico">Puerto Rico</option>
            <option value="53" title="Rhode Island">Rhode Island</option>
            <option value="54" title="South Carolina">South Carolina</option>
            <option value="55" title="South Dakota">South Dakota</option>
            <option value="56" title="Tennessee">Tennessee</option>
            <option value="57" title="Texas">Texas</option>
            <option value="58" title="Utah">Utah</option>
            <option value="59" title="Vermont">Vermont</option>
            <option value="60" title="Virgin Islands">Virgin Islands</option>
            <option value="61" title="Virginia">Virginia</option>
            <option value="62" title="Washington">Washington</option>
            <option value="63" title="West Virginia">West Virginia</option>
            <option value="64" title="Wisconsin">Wisconsin</option>
            <option value="65" title="Wyoming">Wyoming</option>
        </select>
        <input type="text" class="input-text" title="State/Province" name="region" id="region">
    </div>
</li>
<li>
    <label for="postcode">Zip/Postal Code</label>
    <div class="input-box">
        <input type="text" name="estimate_postcode" id="postcode" class="input-text validate-postcode">
    </div>
</li>
</ul>
<div class="buttons-set11">
    <button class="button get-quote" title="Get a Quote" type="button"><span>Get a Quote</span></button>
</div>
<!--buttons-set11-->
</form>
</div>
</div>
</div>
<div class="col-sm-4">
    <div class="discount">
        <h3>Discount Codes</h3>
        <form method="post" action="#" id="discount-coupon-form">
            <label for="coupon_code">Enter your coupon code if you have one.</label>
            <input type="hidden" value="0" id="remove-coupone" name="remove">
            <input type="text" name="coupon_code" id="coupon_code" class="input-text fullwidth">
            <button value="Apply Coupon" class="button coupon " title="Apply Coupon" type="button"><span>Apply Coupon</span></button>
        </form>
    </div>
</div>
<div class="col-sm-4">
    <div class="totals">
        <h3>Shopping Cart Total</h3>
        <div class="inner">
            <table class="table shopping-cart-table-total" id="shopping-cart-totals-table">
                <tfoot>
                <tr>
                    <td colspan="1" class="a-left"><strong>Grand Total</strong></td>
                    <td class="a-right"><strong><span class="price">$77.38</span></strong></td>
                </tr>
                </tfoot>
                <tbody>
                <tr>
                    <td colspan="1" class="a-left"> Subtotal </td>
                    <td class="a-right"><span class="price">$77.38</span></td>
                </tr>
                </tbody>
            </table>
            <ul class="checkout">
                <li>
                    <button class="button btn-proceed-checkout" title="Proceed to Checkout" type="button"><span>Proceed to Checkout</span></button>
                </li>
                <li><br>
                </li>
                <li><a title="Checkout with Multiple Addresses" href="multiple_addresses.html">Checkout with Multiple Addresses</a> </li>
                <li><br>
                </li>
            </ul>
        </div>
    </div>
    <!--inner-->

</div>
</div>

<!--cart-collaterals-->

</div>

</div>
</div>
</section>
<script>
function renderCartProduct(product,params,item,i){
    var access, identypay, disable_for_stepping;
    if((typeof(product.productsAttributes[this[2]]) !=='undefined' && product.productsAttributes[this[2]].quantity == 0) || product.products.products_quantity == 0){
        access = params.message ;
        identypay = false;
    }else if(params.result == false){
        access = params.message;
        identypay = false;
    }else{
        access = params.message;
        identypay = true;
    }
    if(product.products.products_quantity_order_min === '1'  || product.products.products_quantity_order_units === '1'){
        disable_for_stepping = '';
    }else{
        disable_for_stepping = 'readonly';
    }
    var result =
        '<tr data-calc="'+identypay+'" data-access="'+access+'" data-raw="'+i+'">' +
            '<td class="image">' +
                '<a class="product-image" href="/product?id='+product.products.products_id+'" target="_blank">' +
                    '<img width="75"  alt="'+product.productsDescription.products_name+'" src="/imagepreview?src=' + product.products.products_id + '">' +
                '</a>' +
            '</td>' +
            '<td>' +
                '<h2 class="product-name"><a href="#">'+product.productsDescription.products_name+'</a></h2>' +
                '<span>Код: '+product.products.products_model+'</span>' +
            '</td>' +
            '<td><div data-attr="' + item[2] + '" class="cart-attr">' + item[6] + '</div></td>' +
            '<td><span class="price">' + parseInt(product.products.products_price) + ' руб.</span></td>' +
            '<td class="num-of-items" data-raw="' + i + '">' +
                '<div class="custom">' +
                    '<button id="del-count" class="reduced items-count del-count" type="button"><i class="icon-minus">&nbsp;</i></button>' +
                    '<input '+ disable_for_stepping +' id="input-count" class="input-count input-text qty" name="product['+item[0]+']['+item[2]+']" '+renderDataInput(product,item,i)+'>' +
                    '<button id="add-count" class="increase items-count add-count" type="button"><i class="icon-plus">&nbsp;</i></button>' +
                '</div>' +
            '</td>' +
            '<td><a class="button remove-item del-product" title="Удалить" href="#"><span><span>Удалить</span></span></a></td>' +
        '</tr>';

    return result;
}
function renderDataInput(product,item,i){
    var result =
            'data-prod="'+item[0]+'" ' +
            'data-model="'+item[1]+'" ' +
            'data-price="'+parseFloat(product.products.products_price)+'" ' +
            'data-image="'+product.products.products_image+'" ' +
            'data-name="'+product.productsDescription.products_name+'" ' +
            'data-min="'+product.products.products_quantity_order_min+'" ' +
            'data-step="'+product.products.products_quantity_order_units+'"  ' +
            'data-id="'+i+'" ';
    if(typeof(product.productsAttributes[item[2]]) !=='undefined'){
        result +=
            'data-count="'+product.productsAttributes[item[2]].quantity+'" '+
            'data-attr="'+product.productsAttributesDescr[item[6]].products_options_values_id+'" ' +
            'data-attrname="'+product.productsAttributesDescr[item[6]].products_options_values_name+'" '+
            'value="' + Math.min(item[4],product.productsAttributes[item[2]].quantity) + '" ';
    }else{
        result +=
            'data-count="'+product.products.products_quantity+'"  ' +
            'data-attr="" ' +
            'data-attrname="" '+
            'value="' + Math.min(item[4],product.products.products_quantity) + '" ';
    }
    return result;
}
$(window).on('load', function () {
    if (JSON.parse(localStorage.getItem('cart-om'))) {
        $item = JSON.parse(localStorage.getItem('cart-om'));
        $i = $item.cart;
        if(typeof ($i)== 'undefined'){
            localStorage.removeItem('cart-om');
            localStorage.removeItem('cart-om-date');
        }
        $c = 0;

        $.each($i, function (i,item) {
            var requestdata = $.ajax({
                method: 'post',
                url: "/site/product",
                async: false,
                data: {id: item[0], _csrf: yii.getCsrfToken()}
            });

            var mandata = $.ajax({
                method: 'post',
                url: "/site/pre-check-product-to-orders",
                async: false,
                data: {
                    product: requestdata.responseJSON.product.products_id,
                    category: requestdata.responseJSON.categories_id,
                    attr: item[2],
                    count: item[4],
                    _csrf: yii.getCsrfToken()
                }
            });

            $('.cart-table tbody').append(renderCartProduct(requestdata.responseJSON.product, mandata.responseJSON,item,i));
            var $innerhtml = '';
            $innerhtml +=
            '<div class="del-product" style="width: 12px; margin-left:5px; float: left; top:35%;color:#ea516d;"><i class="fa fa-times"></i></div>' +
            '</div>'+
            '<div style="float: left; width: 100%;border-bottom: 1px solid #CCC;">' +
            '<div class="panel panel-default" style="border: medium none; border-radius: 0px; margin: 0px;">'+
            '<a class="collapsed" role="button" data-toggle="collapse'+$c+'" data-parent="#accordion" aria-expanded="false" aria-controls="collapseOne">' +
            '<div class="panel-heading no-border-bottom-rad" role="tab" id="headingOne" style="padding: 0px 10px;">' +
            '<div class="panel-title no-border-bottom-rad" style="font-size: 12px;">' +
            'Добавить комментарий к этому товару <i class="fa fa-caret-down"></i>' +
            '</div>' +
            ' </div>' +
            '</a>'+
            '<div style=" position: relative;    z-index: 999;" aria-expanded="false" id="" class="filter-cont panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">'+
            '<div class="panel-body" style="padding: 0px 5px;">' +
            '<div style="padding: 10px 0px;">';

            if(typeof(requestdata.responseJSON.product.productsAttributes[this[2]]) !=='undefined'){
                $innerhtml += '<textarea name="comments['+requestdata.responseJSON.product.products.products_id+']['+requestdata.responseJSON.product.productsAttributesDescr[this[6]].products_options_values_id+']" style="width: 100%;" ></textarea>';

            }else{
                $innerhtml += '<textarea name="comments['+requestdata.responseJSON.product.products.products_id+'][all]" style="width: 100%;" ></textarea>';

            }
            $innerhtml +=    '</div>' +
            '</div>' +
            '</div>' +
            '</div>'+
            '</div>';
        });
        $innerhtml+='</div><div class="cart-column2" style="border:1px solid #ccc; float: left; width: 49%; border-radius: 4px;">';

        <?php
        if(!Yii::$app->user->isGuest && $template == 'om' ){
        ?>
        $innerhtml+= '<div class="wrap-cart" style=" border-bottom: 1px solid #ccc; padding:10px;">Я выбираю способ упаковки моего заказа:';
        $innerhtml+=  '<div class=wrap-select ><input id="pack" name="wrap" type="radio" value="packages" checked="checked"/>Полиэтиленовые пакеты<br/><input id="box" name="wrap" type="radio" value="boxes" />Крафт-коробки</div></div>';
        $innerhtml+=   '<div class="deliv-addr" style="border-bottom: 1px solid #ccc; padding:10px;">Адрес доставки:<div class="shipaddr" style=""><?=$del_add?></div></div>';
        $innerhtml+=   '<div class="deliv-cart" style="border-bottom: 1px solid #ccc; padding:10px;">Я выбираю бесплатную доставку до компании:<div class="ship" style=""></div></div>';
        $innerhtml+=   '<div class="deliv-code" style="border-bottom: 1px solid #ccc; padding:10px;"></div>';
        $innerhtml += '<button class="btn btn-lg btn-info lock-on" style="border-radius: 4px; text-align: center; width: 100%; margin-top: 5px;" id="check-confirm" type="submit">' +
        'Подтвердить заказ' +
        '</button>';
        <?php
        }else if($template == 'sp')
        {
        ?>
        $innerhtml +=    '' +
        '<div class="address" style="padding: 0px 10px;">' +
        '<div class="name-item lable-info-item">' +
        'Имя: ' +
        '<input disabled="" name="[userinfo]name" title="Допустимые символы а-я,a-z,-,пробел" data-placement="top" data-toggle="tooltip" data-name="name" class="info-item" value="<?=htmlentities($userinfo['name']);?>">' +
        '</div>' +
        '<div class="secondname-item lable-info-item">' +
        'Отчество: ' +
        '<input disabled="" name="[userinfo]secondname" title="Допустимые символы а-я,a-z,-,пробел" data-placement="top" data-toggle="tooltip" data-name="secondname" class="info-item" value="<?=htmlentities($userinfo['secondname']);?>">' +
        '</div>' +
        '<div class="lastname-item lable-info-item">' +
        'Фамилия: ' +
        '<input disabled="" name="[userinfo]lastname" title="Допустимые символы а-я,a-z,-,пробел" data-placement="top" data-toggle="tooltip" data-name="lastname" class="info-item" value="<?=htmlentities($userinfo['lastname']);?>">' +
        '</div>' +
        '<div class="country-item lable-info-item">' +
        'Страна: ' +
        '<input autocomplete="off" disabled="" name="[userinfo]country" title="Выберите из списка" data-placement="top" data-toggle="tooltip" data-name="country" class="info-item" value="<?=htmlentities($userinfo['country']);?>">' +
        '<ul class="dropdown-menu" id="country-drop" aria-labelledby="dropdownMenu1">' +
        '</ul>' +
        '</div>' +
        '<div class="state-item lable-info-item">' +
        'Область: ' +
        '<input autocomplete="off" disabled="" name="[userinfo]state" title="Выберите из списка" data-placement="top" data-toggle="tooltip" data-name="state" class="info-item" value="<?=htmlentities($userinfo['state']);?>">' +
        '<ul class="dropdown-menu" id="state-drop" aria-labelledby="dropdownMenu2">' +
        '</ul>' +
        '</div>' +
        '<div class="city-item lable-info-item">' +
        'Город: ' +
        '<input disabled="" name="[userinfo]city" title="Допустимые символы а-я,a-z,0-9,-,пробел" data-placement="top" data-toggle="tooltip" data-name="city" class="info-item" value="<?=htmlentities($userinfo['city']);?>">' +
        '</div>' +
        '<div class="adress-item lable-info-item">' +
        'Адрес: ' +
        '<input disabled="" name="[userinfo]adress" title="Допустимые символы а-я,a-z,0-9,-,пробел,.,," data-placement="top" data-toggle="tooltip" data-name="adress" class="info-item" value="<?=htmlentities($userinfo['country']);?>">' +
        '</div>' +
        '<div class="postcode-item lable-info-item">' +
        'Почтовый индекс: ' +
        '<input disabled="" name="[userinfo]postcode" title="Допустимые символы 0-9, пробел" data-placement="top" data-toggle="tooltip" data-name="postcode" class="info-item" value="124124"></div>' +
        '<div class="telephone-item lable-info-item">Телефон: <input disabled="" name="[userinfo]telephone" title="Допустимые символы 0-9,-,пробел,),(,+" data-placement="top" data-toggle="tooltip" data-name="telephone" class="info-item" value="<?=htmlentities($userinfo['telephone']);?>"></div>' +
        '<div class="order-accept"><strong>Убедительная просьба проверить свой заказ, так как после подтверждения заказа Вами, мы не можем добавлять, удалять или менять размер у позиции в заказе! ' +
        '</strong>' +
        '<br>' +
        'Нажимая кнопку "Подтвердить заказ" вы подтверждаете свое согласие на сбор и обработку ваших персональных данных, а также соглашаетесь с ' +
        '<a target="_blank" href="/page?article=offerta">' +
        'договором оферты' +
        '</a>.' +
        '</div>' +
        '<button class=" btn btn-lg btn-info lock-on" style="border-radius: 4px; text-align: center; width: 100%; margin-bottom: 5px;"type="submit">' +
        'Подтвердить заказ' +
        '</button>' +
        '</div>';
        <?php
        }else{
        ?>
        $innerhtml +=   '<div class="deliv-addr" style="border-bottom: 1px solid #ccc; padding:10px;"><a href="<?=BASEURL?>/login" class="shipaddr" style="">Необходимо авторизоваться</a></div>';
        <?php
        }
        ?>
        $innerhtml+= '<div class="total-cart" style="padding:10px; overflow: hidden;">' +
        '<div class="total-top" style="height: 25px;">Итого: </div>' +
        '<div class="total-cost"><div style="width: 70%; float: left">Стоимость</div><div id="gods-price" style="width: 30%; float: right"></div></div>' +
        '<div class="total-cost"><div style="width: 70%; float: left">Скидка</div><div id="coupon-price" style="width: 30%; float: right">0 руб</div></div>' +
        '<div class="total-wrap"><div style="width: 70%; float: left">Упаковка(указана минимальная стоимость.Необходимое количество и размеры определит комплектовщик)</div><div id="wrap-price" style="width: 30%; float: right"></div></div>' +
            //   '<div class="total-deliv"><div style="width: 70%; float: left">Доставка</div><div id="deliv-price" style="width: 30%; float: right">0 руб.</div></div>' +
        '<div class="total-price"><div style="width: 55%; float: left">Всего к оплате</div><div id="total-price" style="width: 45%; float: right"><span style="font-size: 26px; font-weight: 600;"></span> руб.</div></div>' +

        '</div>';
        $innerhtml+=  '<div style="float: left; width: 100%;border-bottom: 1px solid #CCC;">' +
        '<div class="panel panel-default" style="border: medium none; border-radius: 0px; margin: 0px;">'+
        '<a class="collapsed" role="button" data-toggle="collapse'+$c+'" data-parent="#accordion" aria-expanded="false" aria-controls="collapseOne">' +
        '<div class="panel-heading no-border-bottom-rad" role="tab" id="headingOne" style="padding: 0px 10px;">' +
        '<div class="panel-title no-border-bottom-rad" style="font-size: 12px;">' +
        'Добавить комментарий к этому заказу <i class="fa fa-caret-down"></i>' +
        '</div>' +
        '</div>' +
        '</a>'+
        '<div style=" position: relative;    z-index: 999;" aria-expanded="false" id="" class="filter-cont panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">'+
        '<div class="panel-body" style="padding: 0px 5px;">' +
        '<div style="padding: 10px 0px;">' +
        '<textarea name="ordercomments" style="width: 100%;" ></textarea>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>';
        if($i.length>0){
            <?php
            if($template){?>
            $innerhtml+='<span class="cart-auth" style="display: block; overflow: hidden;">' +
            '<a class="save-order" style="display: block;position: relative" href="<?=BASEURL;?>/cart?action=1">Оформить заказ</a>' +
            '</span></form></div>';
            <?php }elseif(!Yii::$app->user->isGuest) { ?>
            $innerhtml+='<span class="cart-auth"  style="display: block; overflow: hidden; float: right;"><a class="auth-order" style="display: block;position: relative" href="/site/login">Купить</a></span></form></div>';
            <?php }else { ?>
            $innerhtml+='<span class="cart-auth"  style="display: block; overflow: hidden; float: right;"><a class="auth-order" style="display: block;position: relative" href="/site/login">Купить</a></span></form></div>';
            <?php }?>


            $.post(
                "/site/shipping",
                function (shipdata) {
                    $inht = '';
                    $.each(shipdata, function (index) {
                        if (this.active == '1') {
                            $inht += '<option class="shipping-confirm-option" data-pasp="' + this.wantpasport + '" value="' + index + '">' + this.value + '</option>';
                        }
                    });
                    $('.ship').html('<div class="shipping">Cпособ доставки <select name="ship" class="shipping-confirm"><option class="shipping-confirm-option" value=""></option>' + $inht + '</select></div>');
                    $('.cart-auth').remove();
                    $.post(
                        "/site/paymentmethod",
                        function (data) {
                            if (data != 'false') {
                                $inht = '';
                                $.each(data, function (index) {
                                    if (this.active == '1') {
                                        $inht += '<option class="shipping-confirm-option" value="' + this.name + '">' + this.name + '</option>';
                                    }
                                });
                                $('.ship').append('<div class="shipping">Cпособ оплаты <select  name="ship" id="paymentmethod"><option class="paymentmethod-option" value=""></option>' + $inht + '</select></div><div class="userinfo"></div>');
                            } else {
                                $('.ship').append('<div class="userinfo"></div>');

                            }
                        }
                    );
                }
            );
        }
        else {
            $innerhtml='<div style="text-align: center; padding: calc(100% / 4);">Ваша корзина пуста</div>';
        }
        $('.bside').html($innerhtml);
    }

//    if (JSON.parse(localStorage.getItem('cart-om'))) {
//    <?php
        //    if(!Yii::$app->user->isGuest){?>
//        $(".bside").append('<span class="cart-auth" style="display: block; overflow: hidden;"><a class="save-order" style="display: block;position: relative" href="<?//=BASEURL;?>///cart?action=1">Оформить заказ</a></span>');
//    <?php// }else { ?>
//        $(".bside").append('<span class="cart-auth"  style="display: block; overflow: hidden;"><a class="auth-order" style="display: block;position: relative" href="/site/login">Купить</a></span>');
//    <?php//}?>
//    }

    getCoupon();
    function getCoupon() {
        $.ajax({
            type: "POST",
            url: "/glavnaya/cart?coupon=1",
            data: {_csrf: yii.getCsrfToken()}
        }).done(function (html) {
            $('.deliv-code').html(html);
        });
    }

    changeDisableSubmit();
});

$('body').on('click', '#check-confirm', function() {
    $('#check-confirm + .btn-tk-error').remove();

    if ($(this).hasClass('disabled')) {
        $(this).after('<div class="btn-tk-error" style="color: #f00;">Пожалуйста выберите транспортную компанию.</div>');
        return false;
    }
    else {
        $('.btn-tk-error').remove();
        check();
        return true;
    }
});

//$(document).on('load change click','.num-of-items', );
//$(document).on('ready', function () {
//    var overprice=0;
//    $indexes = $(".cart-row");
//    $.each($indexes, function () {
//        var c=((parseInt($(this).find('#input-c').val()))*(parseInt($(this).find('.cart-prod-price').html())));
//        overprice+=c;
//    });
//    $('#gods-price').html(overprice+' руб');
//    $('#total-price').html()
//});
var wrap=<?=$wrapprice?>;
$(document).on('change click','.num-of-items',function () {
    countPrice();
});
$(window).on('load', function () {
    countPrice();
});
$(window).on('load','.wrap-select', function () {
    countPrice();
});

$('.input-count').on('change',function(){
    countPrice();
});
/*
 Сумма заказа
 */
function countPrice(){
    var godsprice=0;
    var wrapprice=0;
    var couponprice=0;

    var check = $("[name='wrap']").filter(':checked').first();
    if(check.val()=="boxes") wrapprice=wrap;

    $indexes = $(".cart-row");
    $.each($indexes, function () {
        if(parseInt($(this).find('#input-count').val())<parseInt($(this).find('#input-count').attr('data-min'))){
            $(this).find('#input-count').val($(this).find('#input-count').attr('data-min'));
        }
        $(this).attr('');
        if($(this).attr('data-calc') == "true") {
            var c = ((parseFloat($(this).find('#input-count').val())) * (parseFloat($(this).find('.cart-prod-price').html())));
            godsprice += c;
        }
    });

    var totalPrice;

    // Учитываем купон
    var couponType = $('#promo-code-type').val(),
        couponValue = parseInt($('#promo-code-amount').val());
    if(couponType=='F'){ // если тип купона денежный
        couponprice = couponValue+' руб';
        totalPrice = godsprice+wrapprice-couponValue;
        $('#promo-code-sum').val(couponValue);
    } else if(couponType=='P') { // если тип купона процентный
        couponprice = couponValue+'%';
        var couponSum = couponValue*godsprice/100;
        totalPrice = godsprice-couponSum+wrapprice;
        $('#promo-code-sum').val(couponSum);
    } else {
        couponprice = '0 руб';
        totalPrice = godsprice+wrapprice;
    }

    $('#gods-price').html(godsprice+' руб');
    $('#coupon-price').html(couponprice);
    $('#total-price').html(totalPrice+' руб');
    $('#wrap-price').html(wrapprice+' руб');
}

$(document).on('change', '.shipping-confirm, #shipaddr', function () {
    if($('.shipping-confirm option:selected')[0].getAttribute('value') == 'flat12_flat12'){
        $('.deliv-hint').remove();
        $('.deliv-cart').append('<div class="deliv-hint" data-hint="'+$('.shipping-confirm option:selected')[0].getAttribute('value')+'">' +
        '<b>При отправке ТК Энергия, рекомендуем Вам выбирать способ упаковки "коробка", т.к по правилам перевозки ТК сборного груза, упаковка должна быть жесткая, в противном случае за повреждение груза ответсвенность ТК Энергия не несет.</b>' +
        '</div>');
    }else if($('.shipping-confirm option:selected')[0].getAttribute('value') == 'russianpostpf_russianpostpf'){
        $('.deliv-hint').remove();
        $('.deliv-cart').append('<div class="deliv-hint" data-hint="'+$('.shipping-confirm option:selected')[0].getAttribute('value')+'">' +
        '<b>На данный момент со стороны Почты России происходит задержка в отправке заказа в 2 дня</b>' +
        '</div>');
    }else{
        $('.deliv-hint').remove();
    }
    $('.shipping-confirm option').filter(function (index) {
        if ($(this).val() == '') {
            return $(this)
        }
    }).remove();
    $.post(
        "/site/requestadress",
        {ship: $('.shipping-confirm option:selected')[0].getAttribute('data-pasp'),
            id:$('#shipaddr option:selected')[0].getAttribute('value'),
            _csrf: yii.getCsrfToken()},
        onAjaxSuccessinfo
    );

    changeDisableSubmit();
});
$(document).on('click', '.panel  > a',  function(){
    if($(this).siblings().filter('.filter-cont').attr('class').indexOf('collapse in')+1) {
        $(this).html('<div class="panel-heading no-border-bottom-rad" role="tab" id="headingOne" style="padding: 0px 10px;">' +
        '<div class="panel-title no-border-bottom-rad" style="font-size: 12px;">' +
        'Добавить комментарий <i class="fa fa-caret-down"></i>' +
        '</div>' +
        ' </div>');
        $(this).siblings().filter('.filter-cont').removeClass('in');
    }else{
        $(this).html('<div class="panel-heading no-border-bottom-rad" role="tab" id="headingOne" style="padding: 0px 10px;">' +
        '<div class="panel-title no-border-bottom-rad" style="font-size: 12px;">' +
        'Добавить комментарий <i class="fa fa-caret-up"></i>' +
        '</div>' +
        ' </div>');
        $(this).find(':first-child').addClass('no-border-bottom-rad');
        $(this).siblings().filter('.filter-cont').addClass('in');
    }
});

function changeDisableSubmit() {
    if ($('.shipping-confirm').val() === undefined)
        $('#check-confirm').addClass('disabled');
    else {
        $('#check-confirm').removeClass('disabled');
        $('#check-confirm + .btn-tk-error').remove();
    }
}
</script>

