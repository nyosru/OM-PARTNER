//////////////////////////////////////////////////////////////////////////////////
// Cloud Zoom V1.0.2.6
// (c) 2010 by R Cecco. <http://www.professorcloud.com>
// with enhancements by Philipp Andreas <https://github.com/smurfy/cloud-zoom>
//
// MIT License
//
// Please retain this copyright header in all versions of the software
//////////////////////////////////////////////////////////////////////////////////
(function ($) {

    function format(str) {
        for (var i = 1; i < arguments.length; i++) {
            str = str.replace('%' + (i - 1), arguments[i]);
        }
        return str;
    }

    function CloudZoom(jWin, opts) {
        var sImg = $('img', jWin);
        var	img1;
        var	img2;
        var zoomDiv = null;
        var	$mouseTrap = null;
        var	lens = null;
        var	$tint = null;
        var	softFocus = null;
        var	$ie6Fix = null;
        var	zoomImage;
        var controlTimer = 0;
        var cw, ch;
        var destU = 0;
        var	destV = 0;
        var currV = 0;
        var currU = 0;
        var filesLoaded = 0;
        var mx,
            my;
        var ctx = this, zw;
        // Display an image loading message. This message gets deleted when the images have loaded and the zoom init function is called.
        // We add a small delay before the message is displayed to avoid the message flicking on then off again virtually immediately if the
        // images load really fast, e.g. from the cache.
        //var	ctx = this;
        setTimeout(function () {
            //						 <img src="/images/loading.gif"/>
            if ($mouseTrap === null) {
                var w = jWin.width();
                jWin.parent().append(format('<div style="width:%0px;position:absolute;top:75%;left:%1px;text-align:center" class="cloud-zoom-loading" >Loading...</div>', w / 3, (w / 2) - (w / 6))).find(':last').css('opacity', 0.5);
            }
        }, 200);


        var ie6FixRemove = function () {

            if ($ie6Fix !== null) {
                $ie6Fix.remove();
                $ie6Fix = null;
            }
        };

        // Removes cursor, tint layer, blur layer etc.
        this.removeBits = function () {
            //$mouseTrap.unbind();
            if (lens) {
                lens.remove();
                lens = null;
            }
            if ($tint) {
                $tint.remove();
                $tint = null;
            }
            if (softFocus) {
                softFocus.remove();
                softFocus = null;
            }
            ie6FixRemove();

            $('.cloud-zoom-loading', jWin.parent()).remove();
        };


        this.destroy = function () {
            jWin.data('zoom', null);

            if ($mouseTrap) {
                $mouseTrap.unbind();
                $mouseTrap.remove();
                $mouseTrap = null;
            }
            if (zoomDiv) {
                zoomDiv.remove();
                zoomDiv = null;
            }
            //ie6FixRemove();
            this.removeBits();
            // DON'T FORGET TO REMOVE JQUERY 'DATA' VALUES
        };


        // This is called when the zoom window has faded out so it can be removed.
        this.fadedOut = function () {

            if (zoomDiv) {
                zoomDiv.remove();
                zoomDiv = null;
            }
            this.removeBits();
            //ie6FixRemove();
        };

        this.controlLoop = function () {
            if (lens) {
                var x = (mx - sImg.offset().left - (cw * 0.5)) >> 0;
                var y = (my - sImg.offset().top - (ch * 0.5)) >> 0;

                if (x < 0) {
                    x = 0;
                }
                else if (x > (sImg.outerWidth() - cw)) {
                    x = (sImg.outerWidth() - cw);
                }
                if (y < 0) {
                    y = 0;
                }
                else if (y > (sImg.outerHeight() - ch)) {
                    y = (sImg.outerHeight() - ch);
                }

                lens.css({
                    left: x,
                    top: y
                });
                lens.css('background-position', (-x) + 'px ' + (-y) + 'px');

                destU = (((x) / sImg.outerWidth()) * zoomImage.width) >> 0;
                destV = (((y) / sImg.outerHeight()) * zoomImage.height) >> 0;
                currU += (destU - currU) / opts.smoothMove;
                currV += (destV - currV) / opts.smoothMove;

                zoomDiv.css('background-position', (-(currU >> 0) + 'px ') + (-(currV >> 0) + 'px'));
            }
            controlTimer = setTimeout(function () {
                ctx.controlLoop();
            }, 30);
        };

        this.init2 = function (img, id) {

            filesLoaded++;
            //console.log(img.src + ' ' + id + ' ' + img.width);
            if (id === 1) {
                zoomImage = img;
            }
            //this.images[id] = img;
            if (filesLoaded === 2) {
                this.init();
            }
        };

        /* Init function start.  */
        this.init = function () {
            // Remove loading message (if present);
            $('.cloud-zoom-loading', jWin.parent()).remove();


            /* Add a box (mouseTrap) over the small image to trap mouse events.
             It has priority over zoom window to avoid issues with inner zoom.
             We need the dummy background image as IE does not trap mouse events on
             transparent parts of a div.
             */
            $mouseTrap = jWin.parent().append(format("<div class='mousetrap' style='background-image:url(\""+ opts.transparentImage +"\");z-index:999;position:absolute;width:%0px;height:%1px;left:%2px;top:%3px;\'></div>", sImg.outerWidth(), sImg.outerHeight(), 0, 0)).find(':last');

            //////////////////////////////////////////////////////////////////////
            /* Do as little as possible in mousemove event to prevent slowdown. */
            $mouseTrap.bind('mousemove', this, function (event) {
                // Just update the mouse position
                mx = event.pageX;
                my = event.pageY;
            });
            //////////////////////////////////////////////////////////////////////
            $mouseTrap.bind('mouseleave', this, function (event) {
                jWin.trigger('cloudzoom_end_zoom');
                clearTimeout(controlTimer);
                //event.data.removeBits();
                if(lens) { lens.fadeOut(299); }
                if($tint) { $tint.fadeOut(299); }
                if(softFocus) { softFocus.fadeOut(299); }
                zoomDiv.fadeOut(300, function () {
                    ctx.fadedOut();
                });
                return false;
            });
            //////////////////////////////////////////////////////////////////////
            $mouseTrap.bind('mouseenter', this, function (event) {
                jWin.trigger('cloudzoom_start_zoom');
                mx = event.pageX;
                my = event.pageY;
                zw = event.data;
                if (zoomDiv) {
                    zoomDiv.stop(true, false);
                    zoomDiv.remove();
                }

                var xPos = opts.adjustX,
                    yPos = opts.adjustY;

                var siw = sImg.outerWidth();
                var sih = sImg.outerHeight();

                var w = opts.zoomWidth;
                var h = opts.zoomHeight;
                if (opts.zoomWidth == 'auto') {
                    w = siw;
                }
                if (opts.zoomHeight == 'auto') {
                    h = sih;
                }
                //$('#info').text( xPos + ' ' + yPos + ' ' + siw + ' ' + sih );
                var appendTo = jWin.parent(); // attach to the wrapper
                switch (opts.position) {
                    case 'top':
                        yPos -= h; // + opts.adjustY;
                        break;
                    case 'right':
                        xPos += siw; // + opts.adjustX;
                        break;
                    case 'bottom':
                        yPos += sih; // + opts.adjustY;
                        break;
                    case 'left':
                        xPos -= w; // + opts.adjustX;
                        break;
                    case 'inside':
                        w = siw;
                        h = sih;
                        break;
                    // All other values, try and find an id in the dom to attach to.
                    default:
                        appendTo = $('#' + opts.position);
                        // If dom element doesn't exit, just use 'right' position as default.
                        if (!appendTo.length) {
                            appendTo = jWin;
                            xPos += siw; //+ opts.adjustX;
                            yPos += sih; // + opts.adjustY;
                        } else {
                            w = appendTo.innerWidth();
                            h = appendTo.innerHeight();
                        }
                }

                zoomDiv = appendTo.append(format('<div id="cloud-zoom-big" class="cloud-zoom-big" style="display:none;position:absolute;left:%0px;top:%1px;width:%2px;height:%3px;background-image:url(\'%4\');z-index:99;"></div>', xPos, yPos, w, h, zoomImage.src)).find(':last');

                // Add the title from title tag.
                if (sImg.attr('title') && opts.showTitle) {
                    zoomDiv.append(format('<div class="cloud-zoom-title">%0</div>', sImg.attr('title'))).find(':last').css('opacity', opts.titleOpacity);
                }

                // Fix ie6 select elements wrong z-index bug. Placing an iFrame over the select element solves the issue...
                var browserCheck = /(msie) ([\w.]+)/.exec( navigator.userAgent );
                if (browserCheck) {
                    if ((browserCheck[1] || "") == 'msie' && (browserCheck[2] || "0" ) < 7) {
                        $ie6Fix = $('<iframe frameborder="0" src="#"></iframe>').css({
                            position: "absolute",
                            left: xPos,
                            top: yPos,
                            zIndex: 99,
                            width: w,
                            height: h
                        }).insertBefore(zoomDiv);
                    }
                }

                zoomDiv.fadeIn(500);

                if (lens) {
                    lens.remove();
                    lens = null;
                } /* Work out size of cursor */
                cw = (sImg.outerWidth() / zoomImage.width) * zoomDiv.width();
                ch = (sImg.outerHeight() / zoomImage.height) * zoomDiv.height();

                // Attach mouse, initially invisible to prevent first frame glitch
                lens = jWin.append(format("<div class = 'cloud-zoom-lens' style='display:none;z-index:98;position:absolute;width:%0px;height:%1px;'></div>", cw, ch)).find(':last');

                $mouseTrap.css('cursor', lens.css('cursor'));

                var noTrans = false;

                // Init tint layer if needed. (Not relevant if using inside mode)
                if (opts.tint) {
                    lens.css('background', 'url("' + sImg.attr('src') + '")');
                    $tint = jWin.append(format('<div style="display:none;position:absolute; left:0px; top:0px; width:%0px; height:%1px; background-color:%2;" />', sImg.outerWidth(), sImg.outerHeight(), opts.tint)).find(':last');
                    $tint.css('opacity', opts.tintOpacity);
                    noTrans = true;
                    $tint.fadeIn(500);

                }
                if (opts.softFocus) {
                    lens.css('background', 'url("' + sImg.attr('src') + '")');
                    softFocus = jWin.append(format('<div style="position:absolute;display:none;top:2px; left:2px; width:%0px; height:%1px;" />', sImg.outerWidth() - 2, sImg.outerHeight() - 2, opts.tint)).find(':last');
                    softFocus.css('background', 'url("' + sImg.attr('src') + '")');
                    softFocus.css('opacity', 0.5);
                    noTrans = true;
                    softFocus.fadeIn(500);
                }

                if (!noTrans) {
                    lens.css('opacity', opts.lensOpacity);
                }
                if ( opts.position !== 'inside' ) { lens.fadeIn(500); }

                // Start processing.
                zw.controlLoop();

                return; // Don't return false here otherwise opera will not detect change of the mouse pointer type.
            });
            jWin.trigger('cloudzoom_ready');
        };

        img1 = new Image();
        $(img1).load(function () {
            ctx.init2(this, 0);
        });
        img1.src = sImg.attr('src');

        img2 = new Image();
        $(img2).load(function () {
            ctx.init2(this, 1);
        });
        img2.src = jWin.attr('href');
    }

    $.fn.CloudZoom = function (options) {
        // IE6 background image flicker fix
        try {
            document.execCommand("BackgroundImageCache", false, true);
        } catch (e) {}
        this.each(function () {
            var	relOpts, opts;
            // Hmm...eval...slap on wrist.
            eval('var	a = {' + $(this).attr('rel') + '}');
            relOpts = a;
            if ($(this).is('.cloud-zoom')) {
                opts = $.extend({}, $.fn.CloudZoom.defaults, options);
                opts = $.extend({}, opts, relOpts);

                $(this).css({
                    'position': 'relative',
                    'display': 'block'
                });
                $('img', $(this)).css({
                    'display': 'block'
                });


                // Wrap an outer div around the link so we can attach things without them becoming part of the link.
                // But not if wrap already exists.
                if (!$(this).parent().hasClass('cloud-zoom-wrap') && opts.useWrapper) {
                    $(this).wrap('<div class="cloud-zoom-wrap"></div>');
                }
                $(this).data('zoom', new CloudZoom($(this), opts));

            } else if ($(this).is('.cloud-zoom-gallery')) {
                opts = $.extend({}, relOpts, options);
                $(this).data('relOpts', opts);
                $(this).bind('click', $(this), function (event) {
                    var data = event.data.data('relOpts');
                    // Destroy the previous zoom
                    $('#' + data.useZoom).data('zoom').destroy();
                    // Change the biglink to point to the new big image.
                    $('#' + data.useZoom).attr('href', event.data.attr('href'));
                    // Change the small image to point to the new small image.
                    $('#' + data.useZoom + ' img').attr('src', event.data.data('relOpts').smallImage);
                    // Init a new zoom with the new images.
                    $('#' + event.data.data('relOpts').useZoom).CloudZoom();
                    return false;
                });
            }
        });
        return this;
    };

    $.fn.CloudZoom.defaults = {
        zoomWidth: 'auto',
        zoomHeight: 'auto',
        position: 'right',
        transparentImage: '.',
        useWrapper: true,
        tint: false,
        tintOpacity: 0.5,
        lensOpacity: 0.5,
        softFocus: false,
        smoothMove: 3,
        showTitle: true,
        titleOpacity: 0.5,
        adjustX: 0,
        adjustY: 0
    };
    $(document).ready(function () {
        $('.cloud-zoom, .cloud-zoom-gallery').CloudZoom();
    });
})(jQuery);


/*
 * ShortScroll - jQuery UI Widget
 * Copyright (c) 2010 Jesse Baird
 *
 * http://jebaird.com/blog/shortscroll-jquery-ui-google-wave-style-scroll-bar
 *
 * Depends:
 *   - jQuery 1.4
 *   - jQuery UI 1.8 (core, widget factory, draggable)
 *   - jQuery mousewheel plugin - Copyright (c) 2010 Brandon Aaron (http://brandonaaron.net)
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 *
 *  ######### change log ###########
 * 	Jesse Baird
 * 	7/1/2011
 * 	switched up the markup.
 * 		now the scroll bar elements get appended to the target and the target cotnent gets wrapped.
 * 		This solves the issue of the scroll bar element sticking around after the target has been hidden
 *
 *
 *
 */
(function($) {

    jQuery.event.special.jbShortscrollUpdateMarker = {
        setup: function(data, namespaces) {
            var elem = this, $elem = jQuery(elem);
            $elem.bind('scroll', jQuery.event.special.jbShortscrollUpdateMarker.handler);
        },

        teardown: function(namespaces) {
            var elem = this, $elem = jQuery(elem);
            $elem.unbind('scroll', jQuery.event.special.jbShortscrollUpdateMarker.handler);
        },

        handler: function(event) {
            // console.log(event);
            var elem = this,
                scrollHeight = this.scrollHeight,
                scrollTop = this.scrollTop,
                $elem = $(elem),
                viewPort = $elem.innerHeight(),
                $marker = $elem.data('jb-shortscroll-marker'),
                markerIncrament = Math.ceil(scrollTop /(((scrollHeight-viewPort)/(viewPort/1-$marker.outerHeight()))));

            $marker.css('top',markerIncrament);
            event.type = "jbShortscrollUpdateMarker";
            // jQuery.event.handle.apply(this, arguments)

        }
    };

    jQuery.event.special.jbShortscrollUpdateMiddle = {
        setup: function(data, namespaces) {
            var elem = this, $elem = jQuery(elem);
            $elem.bind('scroll', jQuery.event.special.jbShortscrollUpdateMiddle.handler);
        },

        teardown: function(namespaces) {
            var elem = this, $elem = jQuery(elem);
            $elem.unbind('scroll', jQuery.event.special.jbShortscrollUpdateMiddle.handler);
        },

        handler: function(event) {
            // console.log(event);
            var elem2 = this,
                scrollHeight = this.scrollHeight,
                scrollTop = this.scrollTop,
                $elem2 = $(elem2),
                viewPort = $elem2.innerHeight(),
                $marker = $elem2.data('jb-shortscroll-scrollbar'),
                markerIncrament = Math.ceil(scrollTop /(((scrollHeight-viewPort)/(viewPort/1-$marker.outerHeight()))));

            $marker.css('top',markerIncrament);
            event.type = "jbShortscrollUpdateMiddle";
            // jQuery.event.handle.apply(this, arguments)

        }
    };


    $.widget("jb.shortscroll", {
        options: {
            scrollSpeed: 10,
            animationSpeed: 10
        },

        _create: function() {

            var self = this,
                o = self.options,
                el = self.element;

            //TODO: wrap all of the childen with another div, so we can have the scroll track inside the target
            //el.children().wrap('<div/>')
            self.content = el.wrapInner('<div class="jb-shortscroll-content">').children('.jb-shortscroll-content');
            //   console.log( self.content );
            //TODO: change wrpper to scroll element
            //self.wrapper = $(
            //	'<div class="jb-shortscroll-wrapper" style="display: none">' +
            //		'<div class="jb-shortscroll-track">' +
            //    '<div class="jb-shortscroll-scrollbar jb-shortscroll-marker jb-shortscroll-scrollbar-middle">' +
            //    '<div class=""></div>' +
            //    '</div>' +
            //    '</div>'+
            //		//'<div class=" "></div>' +
            //	'</div>'
            //).appendTo(el);
            self.wrapper = $(
                '<div class="jb-shortscroll-wrapper">' +
                '<div class="jb-shortscroll-track">' +
                '<div class="jb-shortscroll-scrollbar">' +
                '<div class="jb-shortscroll-scrollbar-btn-up jb-shortscroll-scrollbar-btn ui-corner-top" data-dir="up">' +
                '<span class="ui-icon ui-icon-triangle-1-n"></span>' +
                '</div>' +
                '<div class="jb-shortscroll-scrollbar-middle"></div>' +
                '<div class="jb-shortscroll-scrollbar-btn-down jb-shortscroll-scrollbar-btn ui-corner-bottom" data-dir="down">' +
                '<span class="ui-icon ui-icon-triangle-1-s"></span>' +
                '</div>' +
                '</div>' +
                '</div>'+
                '<div class="jb-shortscroll-marker ui-corner-all"></div>' +
                '<div class="jb-shortscroll-stopper ui-corner-all"></div>' +
                '</div>'
            ).appendTo(el);
            self._viewPort = el.innerHeight();



            el.addClass('jb-shortscroll-target')
            self.content
                .data('jb-shortscroll-marker',self.wrapper.find('.jb-shortscroll-marker'))
                //.attr('tabindex','0')
                .bind({
                    'jbShortscrollUpdateMarker.jbss': $.noop,
                    'mousewheel.jbss':function(event,delta){
                        var dir = delta > 0 ? 'Up' : 'Down',
                            vel = (dir=='Up')?-Math.abs(delta):Math.abs(delta);
                        this.scrollTop=+this.scrollTop+vel*o.scrollSpeed;
                        //make the target act like it has a navtive scroll bar
                        // console.log(this.scrollTop,self._viewPort,this.scrollHeight);
                        if( this.scrollTop != 0 && dir == 'Up' || this.scrollTop +self._viewPort != this.scrollHeight && dir=='Down' ){
                            //console.log('up false');
                            return false;
                        }

                    }
                });
            self.content
                .data('jb-shortscroll-scrollbar',self.wrapper.find('.jb-shortscroll-scrollbar')).bind({
                'jbShortscrollUpdateMiddle.jbss': $.noop,
                'mousewheel.jbss':function(event,delta){
                    var dir = delta > 0 ? 'Up' : 'Down',
                        vel = (dir=='Up')?-Math.abs(delta):Math.abs(delta);
                    this.scrollTop=+this.scrollTop+vel*o.scrollSpeed;
                    //make the target act like it has a navtive scroll bar
                    // console.log(this.scrollTop,self._viewPort,this.scrollHeight);
                    if( this.scrollTop != 0 && dir == 'Up' || this.scrollTop +self._viewPort != this.scrollHeight && dir=='Down' ){
                        //console.log('up false');
                        return false;
                    }

                }
            });
            $(document).on('change', '.jb-shortscroll-marker', function(){
                console.log( $(this));
                $top = $(this).position();
                $('.jb-shortscroll-scrollbar').position = $top;
            });

            //console.log( el.data('jb-shortscroll-marker'))
            self._positionWrapper();

            self.wrapper
                .find('div.jb-shortscroll-scrollbar')
                .hover(function(e){
                    $(this).toggleClass('ui-state-hover')
                })
                .bind('click',function(e){

                    self.content.animate({
                            'scrollTop':'+='+(($(this).attr('data-dir')=='up')?-self._viewPort:self._viewPort)
                        },
                        o.animationSpeed
                    );
                })
                .end()
                .find('div.jb-shortscroll-scrollbar')
                .draggable({
                    axis:'y',
                    iframeFix: true,
                    containment:'parent',
                    //cancel:'.jb-shortscroll-scrollbar-btn',
                    cursor:'move',
                    start: function(e,ui){
                        //TODO: figure out a way to tirgger this so its now so slow
                        //only trigger if bar and scroll top are faruther apart
                        //            el
//                   .stop()
//                   .animate({
//                        scrollTop:self._pixelRatio($(this))*ui.position.top
//                   },250)
                    },
                    drag: function(e,ui) {
                        var $this = $(this);
                        // console.log( $this, self.content[0])
                        markerIncrament=self._pixelRatio($this);
                        //console.log(markerIncrament, $this.outerHeight())

                        self.content[0].scrollTop=markerIncrament*ui.position.top;
                    }
                });

        },

        destroy: function() {
            //TODO: fix this up to work with new api and markup
            //	this.wrapper.remove();
            //  this.element.unbind('jbShortscrollUpdateMarker.jbss mousewheel.jbss');
            //remove wrapper and mouse wheel events
            //	$(window).unbind("resize");
        },
        scrollTo: function( e ){
            if( typeof e == 'number'){
                //set scroll top to the % of the height
            }else if( true ){
                //scroll to element
            }

        },
        _setOption: function(option, value) {
            $.Widget.prototype._setOption.apply( this, arguments );

        },
        /*
         get the ratio of pxs to the target to scroll track
         */
        _pixelRatio: function(element){

            return Math.ceil(
                (
                    (( this.content[0].scrollHeight - this._viewPort ) / ( this._viewPort / 1 - element.outerHeight() ))
                )
            );
        },
        _positionWrapper: function(){

            this.wrapper
                .css({
                    // position:'absolute',
                    // top:0,
                    // left:0,
                    height: this._viewPort/1
                })

        }

    });
})(jQuery);

(function( $ ){
    var methods = {
        init : function( options ) {
            var settings = $.extend( {
                unbind:true,
                prevText:'Назад',
                nextText:'Вперед',
                loadText:'Загрузка...',
                errorText:'Изображение не найдено',
                keyboard:true
            }, options);
            if(settings.unbind) {
                $(this).unbind('click');
            }
            var loaded_imgs=[];
            $(this).click(function(e) {
                var t=$(this);
                var url=t.attr('href');
                e.preventDefault();
                var div = $('<div></div>').addClass('light_container').html('<span class="light_inner"><div class="light_loading">'+settings.loadText+'</div></span><a href="javascript:;" class="light_close">x</a>');
                var di=div.find('.light_inner');
                $('body').append(div);
                di.width(di.children().first().outerWidth());
                di.height(di.children().first().outerHeight());
                // lock scroll position, but retain settings for later
                var scrollPosition = [
                    self.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft,
                    self.pageYOffset || document.documentElement.scrollTop  || document.body.scrollTop
                ];
                var html = jQuery('html'); // it would make more sense to apply this to body, but IE7 won't have that
                html.data('scroll-position', scrollPosition);
                html.data('previous-overflow', html.css('overflow'));
                html.css('overflow', 'hidden');
                html.css('height','100%');
                window.scrollTo(scrollPosition[0], scrollPosition[1]);
                div.click(function(e) {
                    var ele=$(e.target);
                    var go=true;
                    while(!ele.hasClass('light_container')) {
                        if(ele.hasClass('light_inner')) {
                            go=false;
                        }
                        ele=ele.parent();
                    }
                    if(go) {
                        e.preventDefault();
                        div.remove();
                        // un-lock scroll position
                        var html = jQuery('html');
                        var scrollPosition = html.data('scroll-position');
                        html.css('overflow', html.data('previous-overflow'));
                        html.css('height','auto');
                        window.scrollTo(scrollPosition[0], scrollPosition[1]);
                        if(settings.keyboard) {
                            $(document).unbind('keydown');
                        }
                    }
                });
                if(settings.keyboard) {
                    $(document).unbind('keydown');
                    $(document).keydown(function(e) {
                        if(e.keyCode==27) {
                            e.preventDefault();
                            div.click();
                        }
                    });
                }
                var img=$('<img />').attr('src',url);
                img.load(function(e) {
                    var found=false;
                    $.each(loaded_imgs, function( index, value ) {
                        if(url==value[0]) {
                            found=true;
                        }
                    });
                    if(found===false) {
                        loaded_imgs.push([url,true]);
                    }
                    di.html(img);
                    var w=$( window ).width()-20;
                    var h=$( window ).height()-20;
                    img.css({'max-width':w,'max-height':h,'width':'auto','height':'auto'})
                    di.width(di.children().first().outerWidth());
                    di.height(di.children().first().outerHeight());
                    if(t.attr('data-caption')!==undefined) {
                        di.append('<div class="light_caption"><div class="light_caption_inner">'+t.attr('data-caption')+'</div></div>');
                    }
                    if(t.attr('data-gallery')!==undefined) {
                        var my_gallery=[];
                        var size=-1;
                        var ix=-1;
                        var gallery_id=t.attr('data-gallery');
                        $('[data-gallery='+gallery_id+']').each(function(index) {
                            my_gallery.push($(this));
                            size++;
                            if($(this)[0]==t[0]) {
                                ix=size;
                            }
                        });
                        if(size>0) {
                            di.append('<div class="light_nav"><a href="javascript:;" class="light_prev">'+settings.prevText+'</a><a href="javascript:;" class="light_next">'+settings.nextText+'</a></div>');
                            di.find('.light_prev').click(function(e) {
                                e.preventDefault();
                                ix--;
                                if(ix<0) {
                                    ix=size;
                                }
                                div.click();
                                my_gallery[ix].click();
                            });
                            di.find('.light_next').click(function(e) {
                                e.preventDefault();
                                ix++;
                                if(ix>size) {
                                    ix=0;
                                }
                                div.click();
                                my_gallery[ix].click();
                            });
                            if(settings.keyboard) {
                                $(document).unbind('keydown');
                                $(document).keydown(function(e) {
                                    if(e.keyCode==27) {
                                        e.preventDefault();
                                        div.click();
                                    }
                                    if (e.keyCode == 37) {
                                        e.preventDefault();
                                        ix--;
                                        if(ix<0) {
                                            ix=size;
                                        }
                                        div.click();
                                        my_gallery[ix].click();
                                    }
                                    if (e.keyCode == 39) {
                                        e.preventDefault();
                                        ix++;
                                        if(ix>size) {
                                            ix=0;
                                        }
                                        div.click();
                                        my_gallery[ix].click();
                                    }
                                });
                            }
                        }
                    }
                }).error(function() {
                    var found=false;
                    $.each(loaded_imgs, function( index, value ) {
                        if(url==value[0]) {
                            found=true;
                        }
                    });
                    if(found===false) {
                        loaded_imgs.push([url,false]);
                    }
                    di.width(500);
                    di.html('<div class="light_error">'+settings.errorText+'</div>');
                    di.width(di.children().first().outerWidth());
                    di.height(di.children().first().outerHeight());
                });
                $.each(loaded_imgs, function( index, value ) {
                    if(url==value[0]) {
                        if(value[1]) {
                            img.load();
                        }else{
                            img.error();
                        }
                    }
                });
            });
        }
    };
    $.fn.light = function( method ) {
        if ( methods[method] ) {
            return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return methods.init.apply( this, arguments );
        }else{
            $.error( 'Method ' +  method + ' does not exist on jQuery.light' );
        }
    };
})( jQuery );

/*
 == malihu jquery custom scrollbar plugin ==
 Version: 3.1.3
 Plugin URI: http://manos.malihu.gr/jquery-custom-content-scroller
 Author: malihu
 Author URI: http://manos.malihu.gr
 License: MIT License (MIT)
 */

/*
 Copyright Manos Malihutsakis (email: manos@malihu.gr)

 Permission is hereby granted, free of charge, to any person obtaining a copy
 of this software and associated documentation files (the "Software"), to deal
 in the Software without restriction, including without limitation the rights
 to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 copies of the Software, and to permit persons to whom the Software is
 furnished to do so, subject to the following conditions:

 The above copyright notice and this permission notice shall be included in
 all copies or substantial portions of the Software.

 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 THE SOFTWARE.
 */

/*
 The code below is fairly long, fully commented and should be normally used in development.
 For production, use either the minified jquery.mCustomScrollbar.min.js script or
 the production-ready jquery.mCustomScrollbar.concat.min.js which contains the plugin
 and dependencies (minified).
 */

(function(factory){
    if(typeof module!=="undefined" && module.exports){
        module.exports=factory;
    }else{
        factory(jQuery,window,document);
    }
}(function($){
    (function(init){
        var _rjs=typeof define==="function" && define.amd, /* RequireJS */
            _njs=typeof module !== "undefined" && module.exports, /* NodeJS */
            _dlp=("https:"==document.location.protocol) ? "https:" : "http:", /* location protocol */
            _url="cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js";
        if(!_rjs){
            if(_njs){
                require("jquery-mousewheel")($);
            }else{
                /* load jquery-mousewheel plugin (via CDN) if it's not present or not loaded via RequireJS
                 (works when mCustomScrollbar fn is called on window load) */
                $.event.special.mousewheel || $("head").append(decodeURI("%3Cscript src="+_dlp+"//"+_url+"%3E%3C/script%3E"));
            }
        }
        init();
    }(function(){

        /*
         ----------------------------------------
         PLUGIN NAMESPACE, PREFIX, DEFAULT SELECTOR(S)
         ----------------------------------------
         */

        var pluginNS="mCustomScrollbar",
            pluginPfx="mCS",
            defaultSelector=".mCustomScrollbar",





        /*
         ----------------------------------------
         DEFAULT OPTIONS
         ----------------------------------------
         */

            defaults={
                /*
                 set element/content width/height programmatically
                 values: boolean, pixels, percentage
                 option						default
                 -------------------------------------
                 setWidth					false
                 setHeight					false
                 */
                /*
                 set the initial css top property of content
                 values: string (e.g. "-100px", "10%" etc.)
                 */
                setTop:0,
                /*
                 set the initial css left property of content
                 values: string (e.g. "-100px", "10%" etc.)
                 */
                setLeft:0,
                /*
                 scrollbar axis (vertical and/or horizontal scrollbars)
                 values (string): "y", "x", "yx"
                 */
                axis:"y",
                /*
                 position of scrollbar relative to content
                 values (string): "inside", "outside" ("outside" requires elements with position:relative)
                 */
                scrollbarPosition:"inside",
                /*
                 scrolling inertia
                 values: integer (milliseconds)
                 */
                scrollInertia:950,
                /*
                 auto-adjust scrollbar dragger length
                 values: boolean
                 */
                autoDraggerLength:true,
                /*
                 auto-hide scrollbar when idle
                 values: boolean
                 option						default
                 -------------------------------------
                 autoHideScrollbar			false
                 */
                /*
                 auto-expands scrollbar on mouse-over and dragging
                 values: boolean
                 option						default
                 -------------------------------------
                 autoExpandScrollbar			false
                 */
                /*
                 always show scrollbar, even when there's nothing to scroll
                 values: integer (0=disable, 1=always show dragger rail and buttons, 2=always show dragger rail, dragger and buttons), boolean
                 */
                alwaysShowScrollbar:0,
                /*
                 scrolling always snaps to a multiple of this number in pixels
                 values: integer, array ([y,x])
                 option						default
                 -------------------------------------
                 snapAmount					null
                 */
                /*
                 when snapping, snap with this number in pixels as an offset
                 values: integer
                 */
                snapOffset:0,
                /*
                 mouse-wheel scrolling
                 */
                mouseWheel:{
                    /*
                     enable mouse-wheel scrolling
                     values: boolean
                     */
                    enable:true,
                    /*
                     scrolling amount in pixels
                     values: "auto", integer
                     */
                    scrollAmount:"auto",
                    /*
                     mouse-wheel scrolling axis
                     the default scrolling direction when both vertical and horizontal scrollbars are present
                     values (string): "y", "x"
                     */
                    axis:"y",
                    /*
                     prevent the default behaviour which automatically scrolls the parent element(s) when end of scrolling is reached
                     values: boolean
                     option						default
                     -------------------------------------
                     preventDefault				null
                     */
                    /*
                     the reported mouse-wheel delta value. The number of lines (translated to pixels) one wheel notch scrolls.
                     values: "auto", integer
                     "auto" uses the default OS/browser value
                     */
                    deltaFactor:"auto",
                    /*
                     normalize mouse-wheel delta to -1 or 1 (disables mouse-wheel acceleration)
                     values: boolean
                     option						default
                     -------------------------------------
                     normalizeDelta				null
                     */
                    /*
                     invert mouse-wheel scrolling direction
                     values: boolean
                     option						default
                     -------------------------------------
                     invert						null
                     */
                    /*
                     the tags that disable mouse-wheel when cursor is over them
                     */
                    disableOver:["select","option","keygen","datalist","textarea"]
                },
                /*
                 scrollbar buttons
                 */
                scrollButtons:{
                    /*
                     enable scrollbar buttons
                     values: boolean
                     option						default
                     -------------------------------------
                     enable						null
                     */
                    /*
                     scrollbar buttons scrolling type
                     values (string): "stepless", "stepped"
                     */
                    scrollType:"stepless",
                    /*
                     scrolling amount in pixels
                     values: "auto", integer
                     */
                    scrollAmount:"auto"
                    /*
                     tabindex of the scrollbar buttons
                     values: false, integer
                     option						default
                     -------------------------------------
                     tabindex					null
                     */
                },
                /*
                 keyboard scrolling
                 */
                keyboard:{
                    /*
                     enable scrolling via keyboard
                     values: boolean
                     */
                    enable:true,
                    /*
                     keyboard scrolling type
                     values (string): "stepless", "stepped"
                     */
                    scrollType:"stepless",
                    /*
                     scrolling amount in pixels
                     values: "auto", integer
                     */
                    scrollAmount:"auto"
                },
                /*
                 enable content touch-swipe scrolling
                 values: boolean, integer, string (number)
                 integer values define the axis-specific minimum amount required for scrolling momentum
                 */
                contentTouchScroll:25,
                /*
                 enable/disable document (default) touch-swipe scrolling
                 */
                documentTouchScroll:true,
                /*
                 advanced option parameters
                 */
                advanced:{
                    /*
                     auto-expand content horizontally (for "x" or "yx" axis)
                     values: boolean, integer (the value 2 forces the non scrollHeight/scrollWidth method, the value 3 forces the scrollHeight/scrollWidth method)
                     option						default
                     -------------------------------------
                     autoExpandHorizontalScroll	null
                     */
                    /*
                     auto-scroll to elements with focus
                     */
                    autoScrollOnFocus:"input,textarea,select,button,datalist,keygen,a[tabindex],area,object,[contenteditable='true']",
                    /*
                     auto-update scrollbars on content, element or viewport resize
                     should be true for fluid layouts/elements, adding/removing content dynamically, hiding/showing elements, content with images etc.
                     values: boolean
                     */
                    updateOnContentResize:true,
                    /*
                     auto-update scrollbars each time each image inside the element is fully loaded
                     values: "auto", boolean
                     */
                    updateOnImageLoad:"auto",
                    /*
                     auto-update scrollbars based on the amount and size changes of specific selectors
                     useful when you need to update the scrollbar(s) automatically, each time a type of element is added, removed or changes its size
                     values: boolean, string (e.g. "ul li" will auto-update scrollbars each time list-items inside the element are changed)
                     a value of true (boolean) will auto-update scrollbars each time any element is changed
                     option						default
                     -------------------------------------
                     updateOnSelectorChange		null
                     */
                    /*
                     extra selectors that'll allow scrollbar dragging upon mousemove/up, pointermove/up, touchend etc. (e.g. "selector-1, selector-2")
                     option						default
                     -------------------------------------
                     extraDraggableSelectors		null
                     */
                    /*
                     extra selectors that'll release scrollbar dragging upon mouseup, pointerup, touchend etc. (e.g. "selector-1, selector-2")
                     option						default
                     -------------------------------------
                     releaseDraggableSelectors	null
                     */
                    /*
                     auto-update timeout
                     values: integer (milliseconds)
                     */
                    autoUpdateTimeout:60
                },
                /*
                 scrollbar theme
                 values: string (see CSS/plugin URI for a list of ready-to-use themes)
                 */
                theme:"light",
                /*
                 user defined callback functions
                 */
                callbacks:{
                    /*
                     Available callbacks:
                     callback					default
                     -------------------------------------
                     onCreate					null
                     onInit						null
                     onScrollStart				null
                     onScroll					null
                     onTotalScroll				null
                     onTotalScrollBack			null
                     whileScrolling				null
                     onOverflowY					null
                     onOverflowX					null
                     onOverflowYNone				null
                     onOverflowXNone				null
                     onImageLoad					null
                     onSelectorChange			null
                     onBeforeUpdate				null
                     onUpdate					null
                     */
                    onTotalScrollOffset:0,
                    onTotalScrollBackOffset:0,
                    alwaysTriggerOffsets:true
                }
                /*
                 add scrollbar(s) on all elements matching the current selector, now and in the future
                 values: boolean, string
                 string values: "on" (enable), "once" (disable after first invocation), "off" (disable)
                 liveSelector values: string (selector)
                 option						default
                 -------------------------------------
                 live						false
                 liveSelector				null
                 */
            },





        /*
         ----------------------------------------
         VARS, CONSTANTS
         ----------------------------------------
         */

            totalInstances=0, /* plugin instances amount */
            liveTimers={}, /* live option timers */
            oldIE=(window.attachEvent && !window.addEventListener) ? 1 : 0, /* detect IE < 9 */
            touchActive=false,touchable, /* global touch vars (for touch and pointer events) */
        /* general plugin classes */
            classes=[
                "mCSB_dragger_onDrag","mCSB_scrollTools_onDrag","mCS_img_loaded","mCS_disabled","mCS_destroyed","mCS_no_scrollbar",
                "mCS-autoHide","mCS-dir-rtl","mCS_no_scrollbar_y","mCS_no_scrollbar_x","mCS_y_hidden","mCS_x_hidden","mCSB_draggerContainer",
                "mCSB_buttonUp","mCSB_buttonDown","mCSB_buttonLeft","mCSB_buttonRight"
            ],





        /*
         ----------------------------------------
         METHODS
         ----------------------------------------
         */

            methods={

                /*
                 plugin initialization method
                 creates the scrollbar(s), plugin data object and options
                 ----------------------------------------
                 */

                init:function(options){

                    var options=$.extend(true,{},defaults,options),
                        selector=_selector.call(this); /* validate selector */

                    /*
                     if live option is enabled, monitor for elements matching the current selector and
                     apply scrollbar(s) when found (now and in the future)
                     */
                    if(options.live){
                        var liveSelector=options.liveSelector || this.selector || defaultSelector, /* live selector(s) */
                            $liveSelector=$(liveSelector); /* live selector(s) as jquery object */
                        if(options.live==="off"){
                            /*
                             disable live if requested
                             usage: $(selector).mCustomScrollbar({live:"off"});
                             */
                            removeLiveTimers(liveSelector);
                            return;
                        }
                        liveTimers[liveSelector]=setTimeout(function(){
                            /* call mCustomScrollbar fn on live selector(s) every half-second */
                            $liveSelector.mCustomScrollbar(options);
                            if(options.live==="once" && $liveSelector.length){
                                /* disable live after first invocation */
                                removeLiveTimers(liveSelector);
                            }
                        },500);
                    }else{
                        removeLiveTimers(liveSelector);
                    }

                    /* options backward compatibility (for versions < 3.0.0) and normalization */
                    options.setWidth=(options.set_width) ? options.set_width : options.setWidth;
                    options.setHeight=(options.set_height) ? options.set_height : options.setHeight;
                    options.axis=(options.horizontalScroll) ? "x" : _findAxis(options.axis);
                    options.scrollInertia=options.scrollInertia>0 && options.scrollInertia<17 ? 17 : options.scrollInertia;
                    if(typeof options.mouseWheel!=="object" &&  options.mouseWheel==true){ /* old school mouseWheel option (non-object) */
                        options.mouseWheel={enable:true,scrollAmount:"auto",axis:"y",preventDefault:false,deltaFactor:"auto",normalizeDelta:false,invert:false}
                    }
                    options.mouseWheel.scrollAmount=!options.mouseWheelPixels ? options.mouseWheel.scrollAmount : options.mouseWheelPixels;
                    options.mouseWheel.normalizeDelta=!options.advanced.normalizeMouseWheelDelta ? options.mouseWheel.normalizeDelta : options.advanced.normalizeMouseWheelDelta;
                    options.scrollButtons.scrollType=_findScrollButtonsType(options.scrollButtons.scrollType);

                    _theme(options); /* theme-specific options */

                    /* plugin constructor */
                    return $(selector).each(function(){

                        var $this=$(this);

                        if(!$this.data(pluginPfx)){ /* prevent multiple instantiations */

                            /* store options and create objects in jquery data */
                            $this.data(pluginPfx,{
                                idx:++totalInstances, /* instance index */
                                opt:options, /* options */
                                scrollRatio:{y:null,x:null}, /* scrollbar to content ratio */
                                overflowed:null, /* overflowed axis */
                                contentReset:{y:null,x:null}, /* object to check when content resets */
                                bindEvents:false, /* object to check if events are bound */
                                tweenRunning:false, /* object to check if tween is running */
                                sequential:{}, /* sequential scrolling object */
                                langDir:$this.css("direction"), /* detect/store direction (ltr or rtl) */
                                cbOffsets:null, /* object to check whether callback offsets always trigger */
                                /*
                                 object to check how scrolling events where last triggered
                                 "internal" (default - triggered by this script), "external" (triggered by other scripts, e.g. via scrollTo method)
                                 usage: object.data("mCS").trigger
                                 */
                                trigger:null,
                                /*
                                 object to check for changes in elements in order to call the update method automatically
                                 */
                                poll:{size:{o:0,n:0},img:{o:0,n:0},change:{o:0,n:0}}
                            });

                            var d=$this.data(pluginPfx),o=d.opt,
                            /* HTML data attributes */
                                htmlDataAxis=$this.data("mcs-axis"),htmlDataSbPos=$this.data("mcs-scrollbar-position"),htmlDataTheme=$this.data("mcs-theme");

                            if(htmlDataAxis){o.axis=htmlDataAxis;} /* usage example: data-mcs-axis="y" */
                            if(htmlDataSbPos){o.scrollbarPosition=htmlDataSbPos;} /* usage example: data-mcs-scrollbar-position="outside" */
                            if(htmlDataTheme){ /* usage example: data-mcs-theme="minimal" */
                                o.theme=htmlDataTheme;
                                _theme(o); /* theme-specific options */
                            }

                            _pluginMarkup.call(this); /* add plugin markup */

                            if(d && o.callbacks.onCreate && typeof o.callbacks.onCreate==="function"){o.callbacks.onCreate.call(this);} /* callbacks: onCreate */

                            $("#mCSB_"+d.idx+"_container img:not(."+classes[2]+")").addClass(classes[2]); /* flag loaded images */

                            methods.update.call(null,$this); /* call the update method */

                        }

                    });

                },
                /* ---------------------------------------- */



                /*
                 plugin update method
                 updates content and scrollbar(s) values, events and status
                 ----------------------------------------
                 usage: $(selector).mCustomScrollbar("update");
                 */

                update:function(el,cb){

                    var selector=el || _selector.call(this); /* validate selector */

                    return $(selector).each(function(){

                        var $this=$(this);

                        if($this.data(pluginPfx)){ /* check if plugin has initialized */

                            var d=$this.data(pluginPfx),o=d.opt,
                                mCSB_container=$("#mCSB_"+d.idx+"_container"),
                                mCustomScrollBox=$("#mCSB_"+d.idx),
                                mCSB_dragger=[$("#mCSB_"+d.idx+"_dragger_vertical"),$("#mCSB_"+d.idx+"_dragger_horizontal")];

                            if(!mCSB_container.length){return;}

                            if(d.tweenRunning){_stop($this);} /* stop any running tweens while updating */

                            if(cb && d && o.callbacks.onBeforeUpdate && typeof o.callbacks.onBeforeUpdate==="function"){o.callbacks.onBeforeUpdate.call(this);} /* callbacks: onBeforeUpdate */

                            /* if element was disabled or destroyed, remove class(es) */
                            if($this.hasClass(classes[3])){$this.removeClass(classes[3]);}
                            if($this.hasClass(classes[4])){$this.removeClass(classes[4]);}

                            /* css flexbox fix, detect/set max-height */
                            mCustomScrollBox.css("max-height","none");
                            if(mCustomScrollBox.height()!==$this.height()){mCustomScrollBox.css("max-height",$this.height());}

                            _expandContentHorizontally.call(this); /* expand content horizontally */

                            if(o.axis!=="y" && !o.advanced.autoExpandHorizontalScroll){
                                mCSB_container.css("width",_contentWidth(mCSB_container));
                            }

                            d.overflowed=_overflowed.call(this); /* determine if scrolling is required */

                            _scrollbarVisibility.call(this); /* show/hide scrollbar(s) */

                            /* auto-adjust scrollbar dragger length analogous to content */
                            if(o.autoDraggerLength){_setDraggerLength.call(this);}

                            _scrollRatio.call(this); /* calculate and store scrollbar to content ratio */

                            _bindEvents.call(this); /* bind scrollbar events */

                            /* reset scrolling position and/or events */
                            var to=[Math.abs(mCSB_container[0].offsetTop),Math.abs(mCSB_container[0].offsetLeft)];
                            if(o.axis!=="x"){ /* y/yx axis */
                                if(!d.overflowed[0]){ /* y scrolling is not required */
                                    _resetContentPosition.call(this); /* reset content position */
                                    if(o.axis==="y"){
                                        _unbindEvents.call(this);
                                    }else if(o.axis==="yx" && d.overflowed[1]){
                                        _scrollTo($this,to[1].toString(),{dir:"x",dur:0,overwrite:"none"});
                                    }
                                }else if(mCSB_dragger[0].height()>mCSB_dragger[0].parent().height()){
                                    _resetContentPosition.call(this); /* reset content position */
                                }else{ /* y scrolling is required */
                                    _scrollTo($this,to[0].toString(),{dir:"y",dur:0,overwrite:"none"});
                                    d.contentReset.y=null;
                                }
                            }
                            if(o.axis!=="y"){ /* x/yx axis */
                                if(!d.overflowed[1]){ /* x scrolling is not required */
                                    _resetContentPosition.call(this); /* reset content position */
                                    if(o.axis==="x"){
                                        _unbindEvents.call(this);
                                    }else if(o.axis==="yx" && d.overflowed[0]){
                                        _scrollTo($this,to[0].toString(),{dir:"y",dur:0,overwrite:"none"});
                                    }
                                }else if(mCSB_dragger[1].width()>mCSB_dragger[1].parent().width()){
                                    _resetContentPosition.call(this); /* reset content position */
                                }else{ /* x scrolling is required */
                                    _scrollTo($this,to[1].toString(),{dir:"x",dur:0,overwrite:"none"});
                                    d.contentReset.x=null;
                                }
                            }

                            /* callbacks: onImageLoad, onSelectorChange, onUpdate */
                            if(cb && d){
                                if(cb===2 && o.callbacks.onImageLoad && typeof o.callbacks.onImageLoad==="function"){
                                    o.callbacks.onImageLoad.call(this);
                                }else if(cb===3 && o.callbacks.onSelectorChange && typeof o.callbacks.onSelectorChange==="function"){
                                    o.callbacks.onSelectorChange.call(this);
                                }else if(o.callbacks.onUpdate && typeof o.callbacks.onUpdate==="function"){
                                    o.callbacks.onUpdate.call(this);
                                }
                            }

                            _autoUpdate.call(this); /* initialize automatic updating (for dynamic content, fluid layouts etc.) */

                        }

                    });

                },
                /* ---------------------------------------- */



                /*
                 plugin scrollTo method
                 triggers a scrolling event to a specific value
                 ----------------------------------------
                 usage: $(selector).mCustomScrollbar("scrollTo",value,options);
                 */

                scrollTo:function(val,options){

                    /* prevent silly things like $(selector).mCustomScrollbar("scrollTo",undefined); */
                    if(typeof val=="undefined" || val==null){return;}

                    var selector=_selector.call(this); /* validate selector */

                    return $(selector).each(function(){

                        var $this=$(this);

                        if($this.data(pluginPfx)){ /* check if plugin has initialized */

                            var d=$this.data(pluginPfx),o=d.opt,
                            /* method default options */
                                methodDefaults={
                                    trigger:"external", /* method is by default triggered externally (e.g. from other scripts) */
                                    scrollInertia:o.scrollInertia, /* scrolling inertia (animation duration) */
                                    scrollEasing:"mcsEaseInOut", /* animation easing */
                                    moveDragger:false, /* move dragger instead of content */
                                    timeout:60, /* scroll-to delay */
                                    callbacks:true, /* enable/disable callbacks */
                                    onStart:true,
                                    onUpdate:true,
                                    onComplete:true
                                },
                                methodOptions=$.extend(true,{},methodDefaults,options),
                                to=_arr.call(this,val),dur=methodOptions.scrollInertia>0 && methodOptions.scrollInertia<17 ? 17 : methodOptions.scrollInertia;

                            /* translate yx values to actual scroll-to positions */
                            to[0]=_to.call(this,to[0],"y");
                            to[1]=_to.call(this,to[1],"x");

                            /*
                             check if scroll-to value moves the dragger instead of content.
                             Only pixel values apply on dragger (e.g. 100, "100px", "-=100" etc.)
                             */
                            if(methodOptions.moveDragger){
                                to[0]*=d.scrollRatio.y;
                                to[1]*=d.scrollRatio.x;
                            }

                            methodOptions.dur=_isTabHidden() ? 0 : dur; //skip animations if browser tab is hidden

                            setTimeout(function(){
                                /* do the scrolling */
                                if(to[0]!==null && typeof to[0]!=="undefined" && o.axis!=="x" && d.overflowed[0]){ /* scroll y */
                                    methodOptions.dir="y";
                                    methodOptions.overwrite="all";
                                    _scrollTo($this,to[0].toString(),methodOptions);
                                }
                                if(to[1]!==null && typeof to[1]!=="undefined" && o.axis!=="y" && d.overflowed[1]){ /* scroll x */
                                    methodOptions.dir="x";
                                    methodOptions.overwrite="none";
                                    _scrollTo($this,to[1].toString(),methodOptions);
                                }
                            },methodOptions.timeout);

                        }

                    });

                },
                /* ---------------------------------------- */



                /*
                 plugin stop method
                 stops scrolling animation
                 ----------------------------------------
                 usage: $(selector).mCustomScrollbar("stop");
                 */
                stop:function(){

                    var selector=_selector.call(this); /* validate selector */

                    return $(selector).each(function(){

                        var $this=$(this);

                        if($this.data(pluginPfx)){ /* check if plugin has initialized */

                            _stop($this);

                        }

                    });

                },
                /* ---------------------------------------- */



                /*
                 plugin disable method
                 temporarily disables the scrollbar(s)
                 ----------------------------------------
                 usage: $(selector).mCustomScrollbar("disable",reset);
                 reset (boolean): resets content position to 0
                 */
                disable:function(r){

                    var selector=_selector.call(this); /* validate selector */

                    return $(selector).each(function(){

                        var $this=$(this);

                        if($this.data(pluginPfx)){ /* check if plugin has initialized */

                            var d=$this.data(pluginPfx);

                            _autoUpdate.call(this,"remove"); /* remove automatic updating */

                            _unbindEvents.call(this); /* unbind events */

                            if(r){_resetContentPosition.call(this);} /* reset content position */

                            _scrollbarVisibility.call(this,true); /* show/hide scrollbar(s) */

                            $this.addClass(classes[3]); /* add disable class */

                        }

                    });

                },
                /* ---------------------------------------- */



                /*
                 plugin destroy method
                 completely removes the scrollbar(s) and returns the element to its original state
                 ----------------------------------------
                 usage: $(selector).mCustomScrollbar("destroy");
                 */
                destroy:function(){

                    var selector=_selector.call(this); /* validate selector */

                    return $(selector).each(function(){

                        var $this=$(this);

                        if($this.data(pluginPfx)){ /* check if plugin has initialized */

                            var d=$this.data(pluginPfx),o=d.opt,
                                mCustomScrollBox=$("#mCSB_"+d.idx),
                                mCSB_container=$("#mCSB_"+d.idx+"_container"),
                                scrollbar=$(".mCSB_"+d.idx+"_scrollbar");

                            if(o.live){removeLiveTimers(o.liveSelector || $(selector).selector);} /* remove live timers */

                            _autoUpdate.call(this,"remove"); /* remove automatic updating */

                            _unbindEvents.call(this); /* unbind events */

                            _resetContentPosition.call(this); /* reset content position */

                            $this.removeData(pluginPfx); /* remove plugin data object */

                            _delete(this,"mcs"); /* delete callbacks object */

                            /* remove plugin markup */
                            scrollbar.remove(); /* remove scrollbar(s) first (those can be either inside or outside plugin's inner wrapper) */
                            mCSB_container.find("img."+classes[2]).removeClass(classes[2]); /* remove loaded images flag */
                            mCustomScrollBox.replaceWith(mCSB_container.contents()); /* replace plugin's inner wrapper with the original content */
                            /* remove plugin classes from the element and add destroy class */
                            $this.removeClass(pluginNS+" _"+pluginPfx+"_"+d.idx+" "+classes[6]+" "+classes[7]+" "+classes[5]+" "+classes[3]).addClass(classes[4]);

                        }

                    });

                }
                /* ---------------------------------------- */

            },





        /*
         ----------------------------------------
         FUNCTIONS
         ----------------------------------------
         */

        /* validates selector (if selector is invalid or undefined uses the default one) */
            _selector=function(){
                return (typeof $(this)!=="object" || $(this).length<1) ? defaultSelector : this;
            },
        /* -------------------- */


        /* changes options according to theme */
            _theme=function(obj){
                var fixedSizeScrollbarThemes=["rounded","rounded-dark","rounded-dots","rounded-dots-dark"],
                    nonExpandedScrollbarThemes=["rounded-dots","rounded-dots-dark","3d","3d-dark","3d-thick","3d-thick-dark","inset","inset-dark","inset-2","inset-2-dark","inset-3","inset-3-dark"],
                    disabledScrollButtonsThemes=["minimal","minimal-dark"],
                    enabledAutoHideScrollbarThemes=["minimal","minimal-dark"],
                    scrollbarPositionOutsideThemes=["minimal","minimal-dark"];
                obj.autoDraggerLength=$.inArray(obj.theme,fixedSizeScrollbarThemes) > -1 ? false : obj.autoDraggerLength;
                obj.autoExpandScrollbar=$.inArray(obj.theme,nonExpandedScrollbarThemes) > -1 ? false : obj.autoExpandScrollbar;
                obj.scrollButtons.enable=$.inArray(obj.theme,disabledScrollButtonsThemes) > -1 ? false : obj.scrollButtons.enable;
                obj.autoHideScrollbar=$.inArray(obj.theme,enabledAutoHideScrollbarThemes) > -1 ? true : obj.autoHideScrollbar;
                obj.scrollbarPosition=$.inArray(obj.theme,scrollbarPositionOutsideThemes) > -1 ? "outside" : obj.scrollbarPosition;
            },
        /* -------------------- */


        /* live option timers removal */
            removeLiveTimers=function(selector){
                if(liveTimers[selector]){
                    clearTimeout(liveTimers[selector]);
                    _delete(liveTimers,selector);
                }
            },
        /* -------------------- */


        /* normalizes axis option to valid values: "y", "x", "yx" */
            _findAxis=function(val){
                return (val==="yx" || val==="xy" || val==="auto") ? "yx" : (val==="x" || val==="horizontal") ? "x" : "y";
            },
        /* -------------------- */


        /* normalizes scrollButtons.scrollType option to valid values: "stepless", "stepped" */
            _findScrollButtonsType=function(val){
                return (val==="stepped" || val==="pixels" || val==="step" || val==="click") ? "stepped" : "stepless";
            },
        /* -------------------- */


        /* generates plugin markup */
            _pluginMarkup=function(){
                var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
                    expandClass=o.autoExpandScrollbar ? " "+classes[1]+"_expand" : "",
                    scrollbar=["<div id='mCSB_"+d.idx+"_scrollbar_vertical' class='mCSB_scrollTools mCSB_"+d.idx+"_scrollbar mCS-"+o.theme+" mCSB_scrollTools_vertical"+expandClass+"'><div class='"+classes[12]+"'><div id='mCSB_"+d.idx+"_dragger_vertical' class='mCSB_dragger' style='position:absolute;' oncontextmenu='return false;'><div class='mCSB_dragger_bar' /></div><div class='mCSB_draggerRail' /></div></div>","<div id='mCSB_"+d.idx+"_scrollbar_horizontal' class='mCSB_scrollTools mCSB_"+d.idx+"_scrollbar mCS-"+o.theme+" mCSB_scrollTools_horizontal"+expandClass+"'><div class='"+classes[12]+"'><div id='mCSB_"+d.idx+"_dragger_horizontal' class='mCSB_dragger' style='position:absolute;' oncontextmenu='return false;'><div class='mCSB_dragger_bar' /></div><div class='mCSB_draggerRail' /></div></div>"],
                    wrapperClass=o.axis==="yx" ? "mCSB_vertical_horizontal" : o.axis==="x" ? "mCSB_horizontal" : "mCSB_vertical",
                    scrollbars=o.axis==="yx" ? scrollbar[0]+scrollbar[1] : o.axis==="x" ? scrollbar[1] : scrollbar[0],
                    contentWrapper=o.axis==="yx" ? "<div id='mCSB_"+d.idx+"_container_wrapper' class='mCSB_container_wrapper' />" : "",
                    autoHideClass=o.autoHideScrollbar ? " "+classes[6] : "",
                    scrollbarDirClass=(o.axis!=="x" && d.langDir==="rtl") ? " "+classes[7] : "";
                if(o.setWidth){$this.css("width",o.setWidth);} /* set element width */
                if(o.setHeight){$this.css("height",o.setHeight);} /* set element height */
                o.setLeft=(o.axis!=="y" && d.langDir==="rtl") ? "989999px" : o.setLeft; /* adjust left position for rtl direction */
                $this.addClass(pluginNS+" _"+pluginPfx+"_"+d.idx+autoHideClass+scrollbarDirClass).wrapInner("<div id='mCSB_"+d.idx+"' class='mCustomScrollBox mCS-"+o.theme+" "+wrapperClass+"'><div id='mCSB_"+d.idx+"_container' class='mCSB_container' style='position:relative; top:"+o.setTop+"; left:"+o.setLeft+";' dir="+d.langDir+" /></div>");
                var mCustomScrollBox=$("#mCSB_"+d.idx),
                    mCSB_container=$("#mCSB_"+d.idx+"_container");
                if(o.axis!=="y" && !o.advanced.autoExpandHorizontalScroll){
                    mCSB_container.css("width",_contentWidth(mCSB_container));
                }
                if(o.scrollbarPosition==="outside"){
                    if($this.css("position")==="static"){ /* requires elements with non-static position */
                        $this.css("position","relative");
                    }
                    $this.css("overflow","visible");
                    mCustomScrollBox.addClass("mCSB_outside").after(scrollbars);
                }else{
                    mCustomScrollBox.addClass("mCSB_inside").append(scrollbars);
                    mCSB_container.wrap(contentWrapper);
                }
                _scrollButtons.call(this); /* add scrollbar buttons */
                /* minimum dragger length */
                var mCSB_dragger=[$("#mCSB_"+d.idx+"_dragger_vertical"),$("#mCSB_"+d.idx+"_dragger_horizontal")];
                mCSB_dragger[0].css("min-height",mCSB_dragger[0].height());
                mCSB_dragger[1].css("min-width",mCSB_dragger[1].width());
            },
        /* -------------------- */


        /* calculates content width */
            _contentWidth=function(el){
                var val=[el[0].scrollWidth,Math.max.apply(Math,el.children().map(function(){return $(this).outerWidth(true);}).get())],w=el.parent().width();
                return val[0]>w ? val[0] : val[1]>w ? val[1] : "100%";
            },
        /* -------------------- */


        /* expands content horizontally */
            _expandContentHorizontally=function(){
                var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
                    mCSB_container=$("#mCSB_"+d.idx+"_container");
                if(o.advanced.autoExpandHorizontalScroll && o.axis!=="y"){
                    /* calculate scrollWidth */
                    mCSB_container.css({"width":"auto","min-width":0,"overflow-x":"scroll"});
                    var w=Math.ceil(mCSB_container[0].scrollWidth);
                    if(o.advanced.autoExpandHorizontalScroll===3 || (o.advanced.autoExpandHorizontalScroll!==2 && w>mCSB_container.parent().width())){
                        mCSB_container.css({"width":w,"min-width":"100%","overflow-x":"inherit"});
                    }else{
                        /*
                         wrap content with an infinite width div and set its position to absolute and width to auto.
                         Setting width to auto before calculating the actual width is important!
                         We must let the browser set the width as browser zoom values are impossible to calculate.
                         */
                        mCSB_container.css({"overflow-x":"inherit","position":"absolute"})
                            .wrap("<div class='mCSB_h_wrapper' style='position:relative; left:0; width:999999px;' />")
                            .css({ /* set actual width, original position and un-wrap */
                                /*
                                 get the exact width (with decimals) and then round-up.
                                 Using jquery outerWidth() will round the width value which will mess up with inner elements that have non-integer width
                                 */
                                "width":(Math.ceil(mCSB_container[0].getBoundingClientRect().right+0.4)-Math.floor(mCSB_container[0].getBoundingClientRect().left)),
                                "min-width":"100%",
                                "position":"relative"
                            }).unwrap();
                    }
                }
            },
        /* -------------------- */


        /* adds scrollbar buttons */
            _scrollButtons=function(){
                var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
                    mCSB_scrollTools=$(".mCSB_"+d.idx+"_scrollbar:first"),
                    tabindex=!_isNumeric(o.scrollButtons.tabindex) ? "" : "tabindex='"+o.scrollButtons.tabindex+"'",
                    btnHTML=[
                        "<a href='#' class='"+classes[13]+"' oncontextmenu='return false;' "+tabindex+" />",
                        "<a href='#' class='"+classes[14]+"' oncontextmenu='return false;' "+tabindex+" />",
                        "<a href='#' class='"+classes[15]+"' oncontextmenu='return false;' "+tabindex+" />",
                        "<a href='#' class='"+classes[16]+"' oncontextmenu='return false;' "+tabindex+" />"
                    ],
                    btn=[(o.axis==="x" ? btnHTML[2] : btnHTML[0]),(o.axis==="x" ? btnHTML[3] : btnHTML[1]),btnHTML[2],btnHTML[3]];
                if(o.scrollButtons.enable){
                    mCSB_scrollTools.prepend(btn[0]).append(btn[1]).next(".mCSB_scrollTools").prepend(btn[2]).append(btn[3]);
                }
            },
        /* -------------------- */


        /* auto-adjusts scrollbar dragger length */
            _setDraggerLength=function(){
                var $this=$(this),d=$this.data(pluginPfx),
                    mCustomScrollBox=$("#mCSB_"+d.idx),
                    mCSB_container=$("#mCSB_"+d.idx+"_container"),
                    mCSB_dragger=[$("#mCSB_"+d.idx+"_dragger_vertical"),$("#mCSB_"+d.idx+"_dragger_horizontal")],
                    ratio=[mCustomScrollBox.height()/mCSB_container.outerHeight(false),mCustomScrollBox.width()/mCSB_container.outerWidth(false)],
                    l=[
                        parseInt(mCSB_dragger[0].css("min-height")),Math.round(ratio[0]*mCSB_dragger[0].parent().height()),
                        parseInt(mCSB_dragger[1].css("min-width")),Math.round(ratio[1]*mCSB_dragger[1].parent().width())
                    ],
                    h=oldIE && (l[1]<l[0]) ? l[0] : l[1],w=oldIE && (l[3]<l[2]) ? l[2] : l[3];
                mCSB_dragger[0].css({
                    "height":h,"max-height":(mCSB_dragger[0].parent().height()-10)
                }).find(".mCSB_dragger_bar").css({"line-height":l[0]+"px"});
                mCSB_dragger[1].css({
                    "width":w,"max-width":(mCSB_dragger[1].parent().width()-10)
                });
            },
        /* -------------------- */


        /* calculates scrollbar to content ratio */
            _scrollRatio=function(){
                var $this=$(this),d=$this.data(pluginPfx),
                    mCustomScrollBox=$("#mCSB_"+d.idx),
                    mCSB_container=$("#mCSB_"+d.idx+"_container"),
                    mCSB_dragger=[$("#mCSB_"+d.idx+"_dragger_vertical"),$("#mCSB_"+d.idx+"_dragger_horizontal")],
                    scrollAmount=[mCSB_container.outerHeight(false)-mCustomScrollBox.height(),mCSB_container.outerWidth(false)-mCustomScrollBox.width()],
                    ratio=[
                        scrollAmount[0]/(mCSB_dragger[0].parent().height()-mCSB_dragger[0].height()),
                        scrollAmount[1]/(mCSB_dragger[1].parent().width()-mCSB_dragger[1].width())
                    ];
                d.scrollRatio={y:ratio[0],x:ratio[1]};
            },
        /* -------------------- */


        /* toggles scrolling classes */
            _onDragClasses=function(el,action,xpnd){
                var expandClass=xpnd ? classes[0]+"_expanded" : "",
                    scrollbar=el.closest(".mCSB_scrollTools");
                if(action==="active"){
                    el.toggleClass(classes[0]+" "+expandClass); scrollbar.toggleClass(classes[1]);
                    el[0]._draggable=el[0]._draggable ? 0 : 1;
                }else{
                    if(!el[0]._draggable){
                        if(action==="hide"){
                            el.removeClass(classes[0]); scrollbar.removeClass(classes[1]);
                        }else{
                            el.addClass(classes[0]); scrollbar.addClass(classes[1]);
                        }
                    }
                }
            },
        /* -------------------- */


        /* checks if content overflows its container to determine if scrolling is required */
            _overflowed=function(){
                var $this=$(this),d=$this.data(pluginPfx),
                    mCustomScrollBox=$("#mCSB_"+d.idx),
                    mCSB_container=$("#mCSB_"+d.idx+"_container"),
                    contentHeight=d.overflowed==null ? mCSB_container.height() : mCSB_container.outerHeight(false),
                    contentWidth=d.overflowed==null ? mCSB_container.width() : mCSB_container.outerWidth(false),
                    h=mCSB_container[0].scrollHeight,w=mCSB_container[0].scrollWidth;
                if(h>contentHeight){contentHeight=h;}
                if(w>contentWidth){contentWidth=w;}
                return [contentHeight>mCustomScrollBox.height(),contentWidth>mCustomScrollBox.width()];
            },
        /* -------------------- */


        /* resets content position to 0 */
            _resetContentPosition=function(){
                var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
                    mCustomScrollBox=$("#mCSB_"+d.idx),
                    mCSB_container=$("#mCSB_"+d.idx+"_container"),
                    mCSB_dragger=[$("#mCSB_"+d.idx+"_dragger_vertical"),$("#mCSB_"+d.idx+"_dragger_horizontal")];
                _stop($this); /* stop any current scrolling before resetting */
                if((o.axis!=="x" && !d.overflowed[0]) || (o.axis==="y" && d.overflowed[0])){ /* reset y */
                    mCSB_dragger[0].add(mCSB_container).css("top",0);
                    _scrollTo($this,"_resetY");
                }
                if((o.axis!=="y" && !d.overflowed[1]) || (o.axis==="x" && d.overflowed[1])){ /* reset x */
                    var cx=dx=0;
                    if(d.langDir==="rtl"){ /* adjust left position for rtl direction */
                        cx=mCustomScrollBox.width()-mCSB_container.outerWidth(false);
                        dx=Math.abs(cx/d.scrollRatio.x);
                    }
                    mCSB_container.css("left",cx);
                    mCSB_dragger[1].css("left",dx);
                    _scrollTo($this,"_resetX");
                }
            },
        /* -------------------- */


        /* binds scrollbar events */
            _bindEvents=function(){
                var $this=$(this),d=$this.data(pluginPfx),o=d.opt;
                if(!d.bindEvents){ /* check if events are already bound */
                    _draggable.call(this);
                    if(o.contentTouchScroll){_contentDraggable.call(this);}
                    _selectable.call(this);
                    if(o.mouseWheel.enable){ /* bind mousewheel fn when plugin is available */
                        function _mwt(){
                            mousewheelTimeout=setTimeout(function(){
                                if(!$.event.special.mousewheel){
                                    _mwt();
                                }else{
                                    clearTimeout(mousewheelTimeout);
                                    _mousewheel.call($this[0]);
                                }
                            },100);
                        }
                        var mousewheelTimeout;
                        _mwt();
                    }
                    _draggerRail.call(this);
                    _wrapperScroll.call(this);
                    if(o.advanced.autoScrollOnFocus){_focus.call(this);}
                    if(o.scrollButtons.enable){_buttons.call(this);}
                    if(o.keyboard.enable){_keyboard.call(this);}
                    d.bindEvents=true;
                }
            },
        /* -------------------- */


        /* unbinds scrollbar events */
            _unbindEvents=function(){
                var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
                    namespace=pluginPfx+"_"+d.idx,
                    sb=".mCSB_"+d.idx+"_scrollbar",
                    sel=$("#mCSB_"+d.idx+",#mCSB_"+d.idx+"_container,#mCSB_"+d.idx+"_container_wrapper,"+sb+" ."+classes[12]+",#mCSB_"+d.idx+"_dragger_vertical,#mCSB_"+d.idx+"_dragger_horizontal,"+sb+">a"),
                    mCSB_container=$("#mCSB_"+d.idx+"_container");
                if(o.advanced.releaseDraggableSelectors){sel.add($(o.advanced.releaseDraggableSelectors));}
                if(o.advanced.extraDraggableSelectors){sel.add($(o.advanced.extraDraggableSelectors));}
                if(d.bindEvents){ /* check if events are bound */
                    /* unbind namespaced events from document/selectors */
                    $(document).add($(!_canAccessIFrame() || top.document)).unbind("."+namespace);
                    sel.each(function(){
                        $(this).unbind("."+namespace);
                    });
                    /* clear and delete timeouts/objects */
                    clearTimeout($this[0]._focusTimeout); _delete($this[0],"_focusTimeout");
                    clearTimeout(d.sequential.step); _delete(d.sequential,"step");
                    clearTimeout(mCSB_container[0].onCompleteTimeout); _delete(mCSB_container[0],"onCompleteTimeout");
                    d.bindEvents=false;
                }
            },
        /* -------------------- */


        /* toggles scrollbar visibility */
            _scrollbarVisibility=function(disabled){
                var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
                    contentWrapper=$("#mCSB_"+d.idx+"_container_wrapper"),
                    content=contentWrapper.length ? contentWrapper : $("#mCSB_"+d.idx+"_container"),
                    scrollbar=[$("#mCSB_"+d.idx+"_scrollbar_vertical"),$("#mCSB_"+d.idx+"_scrollbar_horizontal")],
                    mCSB_dragger=[scrollbar[0].find(".mCSB_dragger"),scrollbar[1].find(".mCSB_dragger")];
                if(o.axis!=="x"){
                    if(d.overflowed[0] && !disabled){
                        scrollbar[0].add(mCSB_dragger[0]).add(scrollbar[0].children("a")).css("display","block");
                        content.removeClass(classes[8]+" "+classes[10]);
                    }else{
                        if(o.alwaysShowScrollbar){
                            if(o.alwaysShowScrollbar!==2){mCSB_dragger[0].css("display","none");}
                            content.removeClass(classes[10]);
                        }else{
                            scrollbar[0].css("display","none");
                            content.addClass(classes[10]);
                        }
                        content.addClass(classes[8]);
                    }
                }
                if(o.axis!=="y"){
                    if(d.overflowed[1] && !disabled){
                        scrollbar[1].add(mCSB_dragger[1]).add(scrollbar[1].children("a")).css("display","block");
                        content.removeClass(classes[9]+" "+classes[11]);
                    }else{
                        if(o.alwaysShowScrollbar){
                            if(o.alwaysShowScrollbar!==2){mCSB_dragger[1].css("display","none");}
                            content.removeClass(classes[11]);
                        }else{
                            scrollbar[1].css("display","none");
                            content.addClass(classes[11]);
                        }
                        content.addClass(classes[9]);
                    }
                }
                if(!d.overflowed[0] && !d.overflowed[1]){
                    $this.addClass(classes[5]);
                }else{
                    $this.removeClass(classes[5]);
                }
            },
        /* -------------------- */


        /* returns input coordinates of pointer, touch and mouse events (relative to document) */
            _coordinates=function(e){
                var t=e.type,o=e.target.ownerDocument!==document ? [$(frameElement).offset().top,$(frameElement).offset().left] : null,
                    io=_canAccessIFrame() && e.target.ownerDocument!==top.document ? [$(e.view.frameElement).offset().top,$(e.view.frameElement).offset().left] : [0,0];
                switch(t){
                    case "pointerdown": case "MSPointerDown": case "pointermove": case "MSPointerMove": case "pointerup": case "MSPointerUp":
                    return o ? [e.originalEvent.pageY-o[0]+io[0],e.originalEvent.pageX-o[1]+io[1],false] : [e.originalEvent.pageY,e.originalEvent.pageX,false];
                    break;
                    case "touchstart": case "touchmove": case "touchend":
                    var touch=e.originalEvent.touches[0] || e.originalEvent.changedTouches[0],
                        touches=e.originalEvent.touches.length || e.originalEvent.changedTouches.length;
                    return e.target.ownerDocument!==document ? [touch.screenY,touch.screenX,touches>1] : [touch.pageY,touch.pageX,touches>1];
                    break;
                    default:
                        return o ? [e.pageY-o[0]+io[0],e.pageX-o[1]+io[1],false] : [e.pageY,e.pageX,false];
                }
            },
        /* -------------------- */


        /*
         SCROLLBAR DRAG EVENTS
         scrolls content via scrollbar dragging
         */
            _draggable=function(){
                var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
                    namespace=pluginPfx+"_"+d.idx,
                    draggerId=["mCSB_"+d.idx+"_dragger_vertical","mCSB_"+d.idx+"_dragger_horizontal"],
                    mCSB_container=$("#mCSB_"+d.idx+"_container"),
                    mCSB_dragger=$("#"+draggerId[0]+",#"+draggerId[1]),
                    draggable,dragY,dragX,
                    rds=o.advanced.releaseDraggableSelectors ? mCSB_dragger.add($(o.advanced.releaseDraggableSelectors)) : mCSB_dragger,
                    eds=o.advanced.extraDraggableSelectors ? $(!_canAccessIFrame() || top.document).add($(o.advanced.extraDraggableSelectors)) : $(!_canAccessIFrame() || top.document);
                mCSB_dragger.bind("mousedown."+namespace+" touchstart."+namespace+" pointerdown."+namespace+" MSPointerDown."+namespace,function(e){
                    e.stopImmediatePropagation();
                    e.preventDefault();
                    if(!_mouseBtnLeft(e)){return;} /* left mouse button only */
                    touchActive=true;
                    if(oldIE){document.onselectstart=function(){return false;}} /* disable text selection for IE < 9 */
                    _iframe(false); /* enable scrollbar dragging over iframes by disabling their events */
                    _stop($this);
                    draggable=$(this);
                    var offset=draggable.offset(),y=_coordinates(e)[0]-offset.top,x=_coordinates(e)[1]-offset.left,
                        h=draggable.height()+offset.top,w=draggable.width()+offset.left;
                    if(y<h && y>0 && x<w && x>0){
                        dragY=y;
                        dragX=x;
                    }
                    _onDragClasses(draggable,"active",o.autoExpandScrollbar);
                }).bind("touchmove."+namespace,function(e){
                    e.stopImmediatePropagation();
                    e.preventDefault();
                    var offset=draggable.offset(),y=_coordinates(e)[0]-offset.top,x=_coordinates(e)[1]-offset.left;
                    _drag(dragY,dragX,y,x);
                });
                $(document).add(eds).bind("mousemove."+namespace+" pointermove."+namespace+" MSPointerMove."+namespace,function(e){
                    if(draggable){
                        var offset=draggable.offset(),y=_coordinates(e)[0]-offset.top,x=_coordinates(e)[1]-offset.left;
                        if(dragY===y && dragX===x){return;} /* has it really moved? */
                        _drag(dragY,dragX,y,x);
                    }
                }).add(rds).bind("mouseup."+namespace+" touchend."+namespace+" pointerup."+namespace+" MSPointerUp."+namespace,function(e){
                    if(draggable){
                        _onDragClasses(draggable,"active",o.autoExpandScrollbar);
                        draggable=null;
                    }
                    touchActive=false;
                    if(oldIE){document.onselectstart=null;} /* enable text selection for IE < 9 */
                    _iframe(true); /* enable iframes events */
                });
                function _iframe(evt){
                    var el=mCSB_container.find("iframe");
                    if(!el.length){return;} /* check if content contains iframes */
                    var val=!evt ? "none" : "auto";
                    el.css("pointer-events",val); /* for IE11, iframe's display property should not be "block" */
                }
                function _drag(dragY,dragX,y,x){
                    mCSB_container[0].idleTimer=o.scrollInertia<233 ? 250 : 0;
                    if(draggable.attr("id")===draggerId[1]){
                        var dir="x",to=((draggable[0].offsetLeft-dragX)+x)*d.scrollRatio.x;
                    }else{
                        var dir="y",to=((draggable[0].offsetTop-dragY)+y)*d.scrollRatio.y;
                    }
                    _scrollTo($this,to.toString(),{dir:dir,drag:true});
                }
            },
        /* -------------------- */


        /*
         TOUCH SWIPE EVENTS
         scrolls content via touch swipe
         Emulates the native touch-swipe scrolling with momentum found in iOS, Android and WP devices
         */
            _contentDraggable=function(){
                var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
                    namespace=pluginPfx+"_"+d.idx,
                    mCustomScrollBox=$("#mCSB_"+d.idx),
                    mCSB_container=$("#mCSB_"+d.idx+"_container"),
                    mCSB_dragger=[$("#mCSB_"+d.idx+"_dragger_vertical"),$("#mCSB_"+d.idx+"_dragger_horizontal")],
                    draggable,dragY,dragX,touchStartY,touchStartX,touchMoveY=[],touchMoveX=[],startTime,runningTime,endTime,distance,speed,amount,
                    durA=0,durB,overwrite=o.axis==="yx" ? "none" : "all",touchIntent=[],touchDrag,docDrag,
                    iframe=mCSB_container.find("iframe"),
                    events=[
                        "touchstart."+namespace+" pointerdown."+namespace+" MSPointerDown."+namespace, //start
                        "touchmove."+namespace+" pointermove."+namespace+" MSPointerMove."+namespace, //move
                        "touchend."+namespace+" pointerup."+namespace+" MSPointerUp."+namespace //end
                    ],
                    touchAction=document.body.style.touchAction!==undefined;
                mCSB_container.bind(events[0],function(e){
                    _onTouchstart(e);
                }).bind(events[1],function(e){
                    _onTouchmove(e);
                });
                mCustomScrollBox.bind(events[0],function(e){
                    _onTouchstart2(e);
                }).bind(events[2],function(e){
                    _onTouchend(e);
                });
                if(iframe.length){
                    iframe.each(function(){
                        $(this).load(function(){
                            /* bind events on accessible iframes */
                            if(_canAccessIFrame(this)){
                                $(this.contentDocument || this.contentWindow.document).bind(events[0],function(e){
                                    _onTouchstart(e);
                                    _onTouchstart2(e);
                                }).bind(events[1],function(e){
                                    _onTouchmove(e);
                                }).bind(events[2],function(e){
                                    _onTouchend(e);
                                });
                            }
                        });
                    });
                }
                function _onTouchstart(e){
                    if(!_pointerTouch(e) || touchActive || _coordinates(e)[2]){touchable=0; return;}
                    touchable=1; touchDrag=0; docDrag=0; draggable=1;
                    $this.removeClass("mCS_touch_action");
                    var offset=mCSB_container.offset();
                    dragY=_coordinates(e)[0]-offset.top;
                    dragX=_coordinates(e)[1]-offset.left;
                    touchIntent=[_coordinates(e)[0],_coordinates(e)[1]];
                }
                function _onTouchmove(e){
                    if(!_pointerTouch(e) || touchActive || _coordinates(e)[2]){return;}
                    if(!o.documentTouchScroll){e.preventDefault();}
                    e.stopImmediatePropagation();
                    if(docDrag && !touchDrag){return;}
                    if(draggable){
                        runningTime=_getTime();
                        var offset=mCustomScrollBox.offset(),y=_coordinates(e)[0]-offset.top,x=_coordinates(e)[1]-offset.left,
                            easing="mcsLinearOut";
                        touchMoveY.push(y);
                        touchMoveX.push(x);
                        touchIntent[2]=Math.abs(_coordinates(e)[0]-touchIntent[0]); touchIntent[3]=Math.abs(_coordinates(e)[1]-touchIntent[1]);
                        if(d.overflowed[0]){
                            var limit=mCSB_dragger[0].parent().height()-mCSB_dragger[0].height(),
                                prevent=((dragY-y)>0 && (y-dragY)>-(limit*d.scrollRatio.y) && (touchIntent[3]*2<touchIntent[2] || o.axis==="yx"));
                        }
                        if(d.overflowed[1]){
                            var limitX=mCSB_dragger[1].parent().width()-mCSB_dragger[1].width(),
                                preventX=((dragX-x)>0 && (x-dragX)>-(limitX*d.scrollRatio.x) && (touchIntent[2]*2<touchIntent[3] || o.axis==="yx"));
                        }
                        if(prevent || preventX){ /* prevent native document scrolling */
                            if(!touchAction){e.preventDefault();}
                            touchDrag=1;
                        }else{
                            docDrag=1;
                            $this.addClass("mCS_touch_action");
                        }
                        if(touchAction){e.preventDefault();}
                        amount=o.axis==="yx" ? [(dragY-y),(dragX-x)] : o.axis==="x" ? [null,(dragX-x)] : [(dragY-y),null];
                        mCSB_container[0].idleTimer=250;
                        if(d.overflowed[0]){_drag(amount[0],durA,easing,"y","all",true);}
                        if(d.overflowed[1]){_drag(amount[1],durA,easing,"x",overwrite,true);}
                    }
                }
                function _onTouchstart2(e){
                    if(!_pointerTouch(e) || touchActive || _coordinates(e)[2]){touchable=0; return;}
                    touchable=1;
                    e.stopImmediatePropagation();
                    _stop($this);
                    startTime=_getTime();
                    var offset=mCustomScrollBox.offset();
                    touchStartY=_coordinates(e)[0]-offset.top;
                    touchStartX=_coordinates(e)[1]-offset.left;
                    touchMoveY=[]; touchMoveX=[];
                }
                function _onTouchend(e){
                    if(!_pointerTouch(e) || touchActive || _coordinates(e)[2]){return;}
                    draggable=0;
                    e.stopImmediatePropagation();
                    touchDrag=0; docDrag=0;
                    endTime=_getTime();
                    var offset=mCustomScrollBox.offset(),y=_coordinates(e)[0]-offset.top,x=_coordinates(e)[1]-offset.left;
                    if((endTime-runningTime)>30){return;}
                    speed=1000/(endTime-startTime);
                    var easing="mcsEaseOut",slow=speed<2.5,
                        diff=slow ? [touchMoveY[touchMoveY.length-2],touchMoveX[touchMoveX.length-2]] : [0,0];
                    distance=slow ? [(y-diff[0]),(x-diff[1])] : [y-touchStartY,x-touchStartX];
                    var absDistance=[Math.abs(distance[0]),Math.abs(distance[1])];
                    speed=slow ? [Math.abs(distance[0]/4),Math.abs(distance[1]/4)] : [speed,speed];
                    var a=[
                        Math.abs(mCSB_container[0].offsetTop)-(distance[0]*_m((absDistance[0]/speed[0]),speed[0])),
                        Math.abs(mCSB_container[0].offsetLeft)-(distance[1]*_m((absDistance[1]/speed[1]),speed[1]))
                    ];
                    amount=o.axis==="yx" ? [a[0],a[1]] : o.axis==="x" ? [null,a[1]] : [a[0],null];
                    durB=[(absDistance[0]*4)+o.scrollInertia,(absDistance[1]*4)+o.scrollInertia];
                    var md=parseInt(o.contentTouchScroll) || 0; /* absolute minimum distance required */
                    amount[0]=absDistance[0]>md ? amount[0] : 0;
                    amount[1]=absDistance[1]>md ? amount[1] : 0;
                    if(d.overflowed[0]){_drag(amount[0],durB[0],easing,"y",overwrite,false);}
                    if(d.overflowed[1]){_drag(amount[1],durB[1],easing,"x",overwrite,false);}
                }
                function _m(ds,s){
                    var r=[s*1.5,s*2,s/1.5,s/2];
                    if(ds>90){
                        return s>4 ? r[0] : r[3];
                    }else if(ds>60){
                        return s>3 ? r[3] : r[2];
                    }else if(ds>30){
                        return s>8 ? r[1] : s>6 ? r[0] : s>4 ? s : r[2];
                    }else{
                        return s>8 ? s : r[3];
                    }
                }
                function _drag(amount,dur,easing,dir,overwrite,drag){
                    if(!amount){return;}
                    _scrollTo($this,amount.toString(),{dur:dur,scrollEasing:easing,dir:dir,overwrite:overwrite,drag:drag});
                }
            },
        /* -------------------- */


        /*
         SELECT TEXT EVENTS
         scrolls content when text is selected
         */
            _selectable=function(){
                var $this=$(this),d=$this.data(pluginPfx),o=d.opt,seq=d.sequential,
                    namespace=pluginPfx+"_"+d.idx,
                    mCSB_container=$("#mCSB_"+d.idx+"_container"),
                    wrapper=mCSB_container.parent(),
                    action;
                mCSB_container.bind("mousedown."+namespace,function(e){
                    if(touchable){return;}
                    if(!action){action=1; touchActive=true;}
                }).add(document).bind("mousemove."+namespace,function(e){
                    if(!touchable && action && _sel()){
                        var offset=mCSB_container.offset(),
                            y=_coordinates(e)[0]-offset.top+mCSB_container[0].offsetTop,x=_coordinates(e)[1]-offset.left+mCSB_container[0].offsetLeft;
                        if(y>0 && y<wrapper.height() && x>0 && x<wrapper.width()){
                            if(seq.step){_seq("off",null,"stepped");}
                        }else{
                            if(o.axis!=="x" && d.overflowed[0]){
                                if(y<0){
                                    _seq("on",38);
                                }else if(y>wrapper.height()){
                                    _seq("on",40);
                                }
                            }
                            if(o.axis!=="y" && d.overflowed[1]){
                                if(x<0){
                                    _seq("on",37);
                                }else if(x>wrapper.width()){
                                    _seq("on",39);
                                }
                            }
                        }
                    }
                }).bind("mouseup."+namespace+" dragend."+namespace,function(e){
                    if(touchable){return;}
                    if(action){action=0; _seq("off",null);}
                    touchActive=false;
                });
                function _sel(){
                    return 	window.getSelection ? window.getSelection().toString() :
                        document.selection && document.selection.type!="Control" ? document.selection.createRange().text : 0;
                }
                function _seq(a,c,s){
                    seq.type=s && action ? "stepped" : "stepless";
                    seq.scrollAmount=10;
                    _sequentialScroll($this,a,c,"mcsLinearOut",s ? 60 : null);
                }
            },
        /* -------------------- */


        /*
         MOUSE WHEEL EVENT
         scrolls content via mouse-wheel
         via mouse-wheel plugin (https://github.com/brandonaaron/jquery-mousewheel)
         */
            _mousewheel=function(){
                if(!$(this).data(pluginPfx)){return;} /* Check if the scrollbar is ready to use mousewheel events (issue: #185) */
                var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
                    namespace=pluginPfx+"_"+d.idx,
                    mCustomScrollBox=$("#mCSB_"+d.idx),
                    mCSB_dragger=[$("#mCSB_"+d.idx+"_dragger_vertical"),$("#mCSB_"+d.idx+"_dragger_horizontal")],
                    iframe=$("#mCSB_"+d.idx+"_container").find("iframe");
                if(iframe.length){
                    iframe.each(function(){
                        $(this).load(function(){
                            /* bind events on accessible iframes */
                            if(_canAccessIFrame(this)){
                                $(this.contentDocument || this.contentWindow.document).bind("mousewheel."+namespace,function(e,delta){
                                    _onMousewheel(e,delta);
                                });
                            }
                        });
                    });
                }
                mCustomScrollBox.bind("mousewheel."+namespace,function(e,delta){
                    _onMousewheel(e,delta);
                });
                function _onMousewheel(e,delta){
                    _stop($this);
                    if(_disableMousewheel($this,e.target)){return;} /* disables mouse-wheel when hovering specific elements */
                    var deltaFactor=o.mouseWheel.deltaFactor!=="auto" ? parseInt(o.mouseWheel.deltaFactor) : (oldIE && e.deltaFactor<100) ? 100 : e.deltaFactor || 100,
                        dur=o.scrollInertia;
                    if(o.axis==="x" || o.mouseWheel.axis==="x"){
                        var dir="x",
                            px=[Math.round(deltaFactor*d.scrollRatio.x),parseInt(o.mouseWheel.scrollAmount)],
                            amount=o.mouseWheel.scrollAmount!=="auto" ? px[1] : px[0]>=mCustomScrollBox.width() ? mCustomScrollBox.width()*0.9 : px[0],
                            contentPos=Math.abs($("#mCSB_"+d.idx+"_container")[0].offsetLeft),
                            draggerPos=mCSB_dragger[1][0].offsetLeft,
                            limit=mCSB_dragger[1].parent().width()-mCSB_dragger[1].width(),
                            dlt=e.deltaX || e.deltaY || delta;
                    }else{
                        var dir="y",
                            px=[Math.round(deltaFactor*d.scrollRatio.y),parseInt(o.mouseWheel.scrollAmount)],
                            amount=o.mouseWheel.scrollAmount!=="auto" ? px[1] : px[0]>=mCustomScrollBox.height() ? mCustomScrollBox.height()*0.9 : px[0],
                            contentPos=Math.abs($("#mCSB_"+d.idx+"_container")[0].offsetTop),
                            draggerPos=mCSB_dragger[0][0].offsetTop,
                            limit=mCSB_dragger[0].parent().height()-mCSB_dragger[0].height(),
                            dlt=e.deltaY || delta;
                    }
                    if((dir==="y" && !d.overflowed[0]) || (dir==="x" && !d.overflowed[1])){return;}
                    if(o.mouseWheel.invert || e.webkitDirectionInvertedFromDevice){dlt=-dlt;}
                    if(o.mouseWheel.normalizeDelta){dlt=dlt<0 ? -1 : 1;}
                    if((dlt>0 && draggerPos!==0) || (dlt<0 && draggerPos!==limit) || o.mouseWheel.preventDefault){
                        e.stopImmediatePropagation();
                        e.preventDefault();
                    }
                    if(e.deltaFactor<2 && !o.mouseWheel.normalizeDelta){
                        //very low deltaFactor values mean some kind of delta acceleration (e.g. osx trackpad), so adjusting scrolling accordingly
                        amount=e.deltaFactor; dur=17;
                    }
                    _scrollTo($this,(contentPos-(dlt*amount)).toString(),{dir:dir,dur:dur});
                }
            },
        /* -------------------- */


        /* checks if iframe can be accessed */
            _canAccessIFrame=function(iframe){
                var html=null;
                if(!iframe){
                    try{
                        var doc=top.document;
                        html=doc.body.innerHTML;
                    }catch(err){/* do nothing */}
                    return(html!==null);
                }else{
                    try{
                        var doc=iframe.contentDocument || iframe.contentWindow.document;
                        html=doc.body.innerHTML;
                    }catch(err){/* do nothing */}
                    return(html!==null);
                }
            },
        /* -------------------- */


        /* disables mouse-wheel when hovering specific elements like select, datalist etc. */
            _disableMousewheel=function(el,target){
                var tag=target.nodeName.toLowerCase(),
                    tags=el.data(pluginPfx).opt.mouseWheel.disableOver,
                /* elements that require focus */
                    focusTags=["select","textarea"];
                return $.inArray(tag,tags) > -1 && !($.inArray(tag,focusTags) > -1 && !$(target).is(":focus"));
            },
        /* -------------------- */


        /*
         DRAGGER RAIL CLICK EVENT
         scrolls content via dragger rail
         */
            _draggerRail=function(){
                var $this=$(this),d=$this.data(pluginPfx),
                    namespace=pluginPfx+"_"+d.idx,
                    mCSB_container=$("#mCSB_"+d.idx+"_container"),
                    wrapper=mCSB_container.parent(),
                    mCSB_draggerContainer=$(".mCSB_"+d.idx+"_scrollbar ."+classes[12]),
                    clickable;
                mCSB_draggerContainer.bind("mousedown."+namespace+" touchstart."+namespace+" pointerdown."+namespace+" MSPointerDown."+namespace,function(e){
                    touchActive=true;
                    if(!$(e.target).hasClass("mCSB_dragger")){clickable=1;}
                }).bind("touchend."+namespace+" pointerup."+namespace+" MSPointerUp."+namespace,function(e){
                    touchActive=false;
                }).bind("click."+namespace,function(e){
                    if(!clickable){return;}
                    clickable=0;
                    if($(e.target).hasClass(classes[12]) || $(e.target).hasClass("mCSB_draggerRail")){
                        _stop($this);
                        var el=$(this),mCSB_dragger=el.find(".mCSB_dragger");
                        if(el.parent(".mCSB_scrollTools_horizontal").length>0){
                            if(!d.overflowed[1]){return;}
                            var dir="x",
                                clickDir=e.pageX>mCSB_dragger.offset().left ? -1 : 1,
                                to=Math.abs(mCSB_container[0].offsetLeft)-(clickDir*(wrapper.width()*0.9));
                        }else{
                            if(!d.overflowed[0]){return;}
                            var dir="y",
                                clickDir=e.pageY>mCSB_dragger.offset().top ? -1 : 1,
                                to=Math.abs(mCSB_container[0].offsetTop)-(clickDir*(wrapper.height()*0.9));
                        }
                        _scrollTo($this,to.toString(),{dir:dir,scrollEasing:"mcsEaseInOut"});
                    }
                });
            },
        /* -------------------- */


        /*
         FOCUS EVENT
         scrolls content via element focus (e.g. clicking an input, pressing TAB key etc.)
         */
            _focus=function(){
                var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
                    namespace=pluginPfx+"_"+d.idx,
                    mCSB_container=$("#mCSB_"+d.idx+"_container"),
                    wrapper=mCSB_container.parent();
                mCSB_container.bind("focusin."+namespace,function(e){
                    var el=$(document.activeElement),
                        nested=mCSB_container.find(".mCustomScrollBox").length,
                        dur=0;
                    if(!el.is(o.advanced.autoScrollOnFocus)){return;}
                    _stop($this);
                    clearTimeout($this[0]._focusTimeout);
                    $this[0]._focusTimer=nested ? (dur+17)*nested : 0;
                    $this[0]._focusTimeout=setTimeout(function(){
                        var	to=[_childPos(el)[0],_childPos(el)[1]],
                            contentPos=[mCSB_container[0].offsetTop,mCSB_container[0].offsetLeft],
                            isVisible=[
                                (contentPos[0]+to[0]>=0 && contentPos[0]+to[0]<wrapper.height()-el.outerHeight(false)),
                                (contentPos[1]+to[1]>=0 && contentPos[0]+to[1]<wrapper.width()-el.outerWidth(false))
                            ],
                            overwrite=(o.axis==="yx" && !isVisible[0] && !isVisible[1]) ? "none" : "all";
                        if(o.axis!=="x" && !isVisible[0]){
                            _scrollTo($this,to[0].toString(),{dir:"y",scrollEasing:"mcsEaseInOut",overwrite:overwrite,dur:dur});
                        }
                        if(o.axis!=="y" && !isVisible[1]){
                            _scrollTo($this,to[1].toString(),{dir:"x",scrollEasing:"mcsEaseInOut",overwrite:overwrite,dur:dur});
                        }
                    },$this[0]._focusTimer);
                });
            },
        /* -------------------- */


        /* sets content wrapper scrollTop/scrollLeft always to 0 */
            _wrapperScroll=function(){
                var $this=$(this),d=$this.data(pluginPfx),
                    namespace=pluginPfx+"_"+d.idx,
                    wrapper=$("#mCSB_"+d.idx+"_container").parent();
                wrapper.bind("scroll."+namespace,function(e){
                    if(wrapper.scrollTop()!==0 || wrapper.scrollLeft()!==0){
                        $(".mCSB_"+d.idx+"_scrollbar").css("visibility","hidden"); /* hide scrollbar(s) */
                    }
                });
            },
        /* -------------------- */


        /*
         BUTTONS EVENTS
         scrolls content via up, down, left and right buttons
         */
            _buttons=function(){
                var $this=$(this),d=$this.data(pluginPfx),o=d.opt,seq=d.sequential,
                    namespace=pluginPfx+"_"+d.idx,
                    sel=".mCSB_"+d.idx+"_scrollbar",
                    btn=$(sel+">a");
                btn.bind("mousedown."+namespace+" touchstart."+namespace+" pointerdown."+namespace+" MSPointerDown."+namespace+" mouseup."+namespace+" touchend."+namespace+" pointerup."+namespace+" MSPointerUp."+namespace+" mouseout."+namespace+" pointerout."+namespace+" MSPointerOut."+namespace+" click."+namespace,function(e){
                    e.preventDefault();
                    if(!_mouseBtnLeft(e)){return;} /* left mouse button only */
                    var btnClass=$(this).attr("class");
                    seq.type=o.scrollButtons.scrollType;
                    switch(e.type){
                        case "mousedown": case "touchstart": case "pointerdown": case "MSPointerDown":
                        if(seq.type==="stepped"){return;}
                        touchActive=true;
                        d.tweenRunning=false;
                        _seq("on",btnClass);
                        break;
                        case "mouseup": case "touchend": case "pointerup": case "MSPointerUp":
                        case "mouseout": case "pointerout": case "MSPointerOut":
                        if(seq.type==="stepped"){return;}
                        touchActive=false;
                        if(seq.dir){_seq("off",btnClass);}
                        break;
                        case "click":
                            if(seq.type!=="stepped" || d.tweenRunning){return;}
                            _seq("on",btnClass);
                            break;
                    }
                    function _seq(a,c){
                        seq.scrollAmount=o.scrollButtons.scrollAmount;
                        _sequentialScroll($this,a,c);
                    }
                });
            },
        /* -------------------- */


        /*
         KEYBOARD EVENTS
         scrolls content via keyboard
         Keys: up arrow, down arrow, left arrow, right arrow, PgUp, PgDn, Home, End
         */
            _keyboard=function(){
                var $this=$(this),d=$this.data(pluginPfx),o=d.opt,seq=d.sequential,
                    namespace=pluginPfx+"_"+d.idx,
                    mCustomScrollBox=$("#mCSB_"+d.idx),
                    mCSB_container=$("#mCSB_"+d.idx+"_container"),
                    wrapper=mCSB_container.parent(),
                    editables="input,textarea,select,datalist,keygen,[contenteditable='true']",
                    iframe=mCSB_container.find("iframe"),
                    events=["blur."+namespace+" keydown."+namespace+" keyup."+namespace];
                if(iframe.length){
                    iframe.each(function(){
                        $(this).load(function(){
                            /* bind events on accessible iframes */
                            if(_canAccessIFrame(this)){
                                $(this.contentDocument || this.contentWindow.document).bind(events[0],function(e){
                                    _onKeyboard(e);
                                });
                            }
                        });
                    });
                }
                mCustomScrollBox.attr("tabindex","0").bind(events[0],function(e){
                    _onKeyboard(e);
                });
                function _onKeyboard(e){
                    switch(e.type){
                        case "blur":
                            if(d.tweenRunning && seq.dir){_seq("off",null);}
                            break;
                        case "keydown": case "keyup":
                        var code=e.keyCode ? e.keyCode : e.which,action="on";
                        if((o.axis!=="x" && (code===38 || code===40)) || (o.axis!=="y" && (code===37 || code===39))){
                            /* up (38), down (40), left (37), right (39) arrows */
                            if(((code===38 || code===40) && !d.overflowed[0]) || ((code===37 || code===39) && !d.overflowed[1])){return;}
                            if(e.type==="keyup"){action="off";}
                            if(!$(document.activeElement).is(editables)){
                                e.preventDefault();
                                e.stopImmediatePropagation();
                                _seq(action,code);
                            }
                        }else if(code===33 || code===34){
                            /* PgUp (33), PgDn (34) */
                            if(d.overflowed[0] || d.overflowed[1]){
                                e.preventDefault();
                                e.stopImmediatePropagation();
                            }
                            if(e.type==="keyup"){
                                _stop($this);
                                var keyboardDir=code===34 ? -1 : 1;
                                if(o.axis==="x" || (o.axis==="yx" && d.overflowed[1] && !d.overflowed[0])){
                                    var dir="x",to=Math.abs(mCSB_container[0].offsetLeft)-(keyboardDir*(wrapper.width()*0.9));
                                }else{
                                    var dir="y",to=Math.abs(mCSB_container[0].offsetTop)-(keyboardDir*(wrapper.height()*0.9));
                                }
                                _scrollTo($this,to.toString(),{dir:dir,scrollEasing:"mcsEaseInOut"});
                            }
                        }else if(code===35 || code===36){
                            /* End (35), Home (36) */
                            if(!$(document.activeElement).is(editables)){
                                if(d.overflowed[0] || d.overflowed[1]){
                                    e.preventDefault();
                                    e.stopImmediatePropagation();
                                }
                                if(e.type==="keyup"){
                                    if(o.axis==="x" || (o.axis==="yx" && d.overflowed[1] && !d.overflowed[0])){
                                        var dir="x",to=code===35 ? Math.abs(wrapper.width()-mCSB_container.outerWidth(false)) : 0;
                                    }else{
                                        var dir="y",to=code===35 ? Math.abs(wrapper.height()-mCSB_container.outerHeight(false)) : 0;
                                    }
                                    _scrollTo($this,to.toString(),{dir:dir,scrollEasing:"mcsEaseInOut"});
                                }
                            }
                        }
                        break;
                    }
                    function _seq(a,c){
                        seq.type=o.keyboard.scrollType;
                        seq.scrollAmount=o.keyboard.scrollAmount;
                        if(seq.type==="stepped" && d.tweenRunning){return;}
                        _sequentialScroll($this,a,c);
                    }
                }
            },
        /* -------------------- */


        /* scrolls content sequentially (used when scrolling via buttons, keyboard arrows etc.) */
            _sequentialScroll=function(el,action,trigger,e,s){
                var d=el.data(pluginPfx),o=d.opt,seq=d.sequential,
                    mCSB_container=$("#mCSB_"+d.idx+"_container"),
                    once=seq.type==="stepped" ? true : false,
                    steplessSpeed=o.scrollInertia < 26 ? 26 : o.scrollInertia, /* 26/1.5=17 */
                    steppedSpeed=o.scrollInertia < 1 ? 17 : o.scrollInertia;
                switch(action){
                    case "on":
                        seq.dir=[
                            (trigger===classes[16] || trigger===classes[15] || trigger===39 || trigger===37 ? "x" : "y"),
                            (trigger===classes[13] || trigger===classes[15] || trigger===38 || trigger===37 ? -1 : 1)
                        ];
                        _stop(el);
                        if(_isNumeric(trigger) && seq.type==="stepped"){return;}
                        _on(once);
                        break;
                    case "off":
                        _off();
                        if(once || (d.tweenRunning && seq.dir)){
                            _on(true);
                        }
                        break;
                }

                /* starts sequence */
                function _on(once){
                    if(o.snapAmount){seq.scrollAmount=!(o.snapAmount instanceof Array) ? o.snapAmount : seq.dir[0]==="x" ? o.snapAmount[1] : o.snapAmount[0];} /* scrolling snapping */
                    var c=seq.type!=="stepped", /* continuous scrolling */
                        t=s ? s : !once ? 1000/60 : c ? steplessSpeed/1.5 : steppedSpeed, /* timer */
                        m=!once ? 2.5 : c ? 7.5 : 40, /* multiplier */
                        contentPos=[Math.abs(mCSB_container[0].offsetTop),Math.abs(mCSB_container[0].offsetLeft)],
                        ratio=[d.scrollRatio.y>10 ? 10 : d.scrollRatio.y,d.scrollRatio.x>10 ? 10 : d.scrollRatio.x],
                        amount=seq.dir[0]==="x" ? contentPos[1]+(seq.dir[1]*(ratio[1]*m)) : contentPos[0]+(seq.dir[1]*(ratio[0]*m)),
                        px=seq.dir[0]==="x" ? contentPos[1]+(seq.dir[1]*parseInt(seq.scrollAmount)) : contentPos[0]+(seq.dir[1]*parseInt(seq.scrollAmount)),
                        to=seq.scrollAmount!=="auto" ? px : amount,
                        easing=e ? e : !once ? "mcsLinear" : c ? "mcsLinearOut" : "mcsEaseInOut",
                        onComplete=!once ? false : true;
                    if(once && t<17){
                        to=seq.dir[0]==="x" ? contentPos[1] : contentPos[0];
                    }
                    _scrollTo(el,to.toString(),{dir:seq.dir[0],scrollEasing:easing,dur:t,onComplete:onComplete});
                    if(once){
                        seq.dir=false;
                        return;
                    }
                    clearTimeout(seq.step);
                    seq.step=setTimeout(function(){
                        _on();
                    },t);
                }
                /* stops sequence */
                function _off(){
                    clearTimeout(seq.step);
                    _delete(seq,"step");
                    _stop(el);
                }
            },
        /* -------------------- */


        /* returns a yx array from value */
            _arr=function(val){
                var o=$(this).data(pluginPfx).opt,vals=[];
                if(typeof val==="function"){val=val();} /* check if the value is a single anonymous function */
                /* check if value is object or array, its length and create an array with yx values */
                if(!(val instanceof Array)){ /* object value (e.g. {y:"100",x:"100"}, 100 etc.) */
                    vals[0]=val.y ? val.y : val.x || o.axis==="x" ? null : val;
                    vals[1]=val.x ? val.x : val.y || o.axis==="y" ? null : val;
                }else{ /* array value (e.g. [100,100]) */
                    vals=val.length>1 ? [val[0],val[1]] : o.axis==="x" ? [null,val[0]] : [val[0],null];
                }
                /* check if array values are anonymous functions */
                if(typeof vals[0]==="function"){vals[0]=vals[0]();}
                if(typeof vals[1]==="function"){vals[1]=vals[1]();}
                return vals;
            },
        /* -------------------- */


        /* translates values (e.g. "top", 100, "100px", "#id") to actual scroll-to positions */
            _to=function(val,dir){
                if(val==null || typeof val=="undefined"){return;}
                var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
                    mCSB_container=$("#mCSB_"+d.idx+"_container"),
                    wrapper=mCSB_container.parent(),
                    t=typeof val;
                if(!dir){dir=o.axis==="x" ? "x" : "y";}
                var contentLength=dir==="x" ? mCSB_container.outerWidth(false) : mCSB_container.outerHeight(false),
                    contentPos=dir==="x" ? mCSB_container[0].offsetLeft : mCSB_container[0].offsetTop,
                    cssProp=dir==="x" ? "left" : "top";
                switch(t){
                    case "function": /* this currently is not used. Consider removing it */
                        return val();
                        break;
                    case "object": /* js/jquery object */
                        var obj=val.jquery ? val : $(val);
                        if(!obj.length){return;}
                        return dir==="x" ? _childPos(obj)[1] : _childPos(obj)[0];
                        break;
                    case "string": case "number":
                    if(_isNumeric(val)){ /* numeric value */
                        return Math.abs(val);
                    }else if(val.indexOf("%")!==-1){ /* percentage value */
                        return Math.abs(contentLength*parseInt(val)/100);
                    }else if(val.indexOf("-=")!==-1){ /* decrease value */
                        return Math.abs(contentPos-parseInt(val.split("-=")[1]));
                    }else if(val.indexOf("+=")!==-1){ /* inrease value */
                        var p=(contentPos+parseInt(val.split("+=")[1]));
                        return p>=0 ? 0 : Math.abs(p);
                    }else if(val.indexOf("px")!==-1 && _isNumeric(val.split("px")[0])){ /* pixels string value (e.g. "100px") */
                        return Math.abs(val.split("px")[0]);
                    }else{
                        if(val==="top" || val==="left"){ /* special strings */
                            return 0;
                        }else if(val==="bottom"){
                            return Math.abs(wrapper.height()-mCSB_container.outerHeight(false));
                        }else if(val==="right"){
                            return Math.abs(wrapper.width()-mCSB_container.outerWidth(false));
                        }else if(val==="first" || val==="last"){
                            var obj=mCSB_container.find(":"+val);
                            return dir==="x" ? _childPos(obj)[1] : _childPos(obj)[0];
                        }else{
                            if($(val).length){ /* jquery selector */
                                return dir==="x" ? _childPos($(val))[1] : _childPos($(val))[0];
                            }else{ /* other values (e.g. "100em") */
                                mCSB_container.css(cssProp,val);
                                methods.update.call(null,$this[0]);
                                return;
                            }
                        }
                    }
                    break;
                }
            },
        /* -------------------- */


        /* calls the update method automatically */
            _autoUpdate=function(rem){
                var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
                    mCSB_container=$("#mCSB_"+d.idx+"_container");
                if(rem){
                    /*
                     removes autoUpdate timer
                     usage: _autoUpdate.call(this,"remove");
                     */
                    clearTimeout(mCSB_container[0].autoUpdate);
                    _delete(mCSB_container[0],"autoUpdate");
                    return;
                }
                upd();
                function upd(){
                    clearTimeout(mCSB_container[0].autoUpdate);
                    if($this.parents("html").length===0){
                        /* check element in dom tree */
                        $this=null;
                        return;
                    }
                    mCSB_container[0].autoUpdate=setTimeout(function(){
                        /* update on specific selector(s) length and size change */
                        if(o.advanced.updateOnSelectorChange){
                            d.poll.change.n=sizesSum();
                            if(d.poll.change.n!==d.poll.change.o){
                                d.poll.change.o=d.poll.change.n;
                                doUpd(3);
                                return;
                            }
                        }
                        /* update on main element and scrollbar size changes */
                        if(o.advanced.updateOnContentResize){
                            d.poll.size.n=$this[0].scrollHeight+$this[0].scrollWidth+mCSB_container[0].offsetHeight+$this[0].offsetHeight+$this[0].offsetWidth;
                            if(d.poll.size.n!==d.poll.size.o){
                                d.poll.size.o=d.poll.size.n;
                                doUpd(1);
                                return;
                            }
                        }
                        /* update on image load */
                        if(o.advanced.updateOnImageLoad){
                            if(!(o.advanced.updateOnImageLoad==="auto" && o.axis==="y")){ //by default, it doesn't run on vertical content
                                d.poll.img.n=mCSB_container.find("img").length;
                                if(d.poll.img.n!==d.poll.img.o){
                                    d.poll.img.o=d.poll.img.n;
                                    mCSB_container.find("img").each(function(){
                                        imgLoader(this);
                                    });
                                    return;
                                }
                            }
                        }
                        if(o.advanced.updateOnSelectorChange || o.advanced.updateOnContentResize || o.advanced.updateOnImageLoad){upd();}
                    },o.advanced.autoUpdateTimeout);
                }
                /* a tiny image loader */
                function imgLoader(el){
                    if($(el).hasClass(classes[2])){doUpd(); return;}
                    var img=new Image();
                    function createDelegate(contextObject,delegateMethod){
                        return function(){return delegateMethod.apply(contextObject,arguments);}
                    }
                    function imgOnLoad(){
                        this.onload=null;
                        $(el).addClass(classes[2]);
                        doUpd(2);
                    }
                    img.onload=createDelegate(img,imgOnLoad);
                    img.src=el.src;
                }
                /* returns the total height and width sum of all elements matching the selector */
                function sizesSum(){
                    if(o.advanced.updateOnSelectorChange===true){o.advanced.updateOnSelectorChange="*";}
                    var total=0,sel=mCSB_container.find(o.advanced.updateOnSelectorChange);
                    if(o.advanced.updateOnSelectorChange && sel.length>0){sel.each(function(){total+=this.offsetHeight+this.offsetWidth;});}
                    return total;
                }
                /* calls the update method */
                function doUpd(cb){
                    clearTimeout(mCSB_container[0].autoUpdate);
                    methods.update.call(null,$this[0],cb);
                }
            },
        /* -------------------- */


        /* snaps scrolling to a multiple of a pixels number */
            _snapAmount=function(to,amount,offset){
                return (Math.round(to/amount)*amount-offset);
            },
        /* -------------------- */


        /* stops content and scrollbar animations */
            _stop=function(el){
                var d=el.data(pluginPfx),
                    sel=$("#mCSB_"+d.idx+"_container,#mCSB_"+d.idx+"_container_wrapper,#mCSB_"+d.idx+"_dragger_vertical,#mCSB_"+d.idx+"_dragger_horizontal");
                sel.each(function(){
                    _stopTween.call(this);
                });
            },
        /* -------------------- */


        /*
         ANIMATES CONTENT
         This is where the actual scrolling happens
         */
            _scrollTo=function(el,to,options){
                var d=el.data(pluginPfx),o=d.opt,
                    defaults={
                        trigger:"internal",
                        dir:"y",
                        scrollEasing:"mcsEaseOut",
                        drag:false,
                        dur:o.scrollInertia,
                        overwrite:"all",
                        callbacks:true,
                        onStart:true,
                        onUpdate:true,
                        onComplete:true
                    },
                    options=$.extend(defaults,options),
                    dur=[options.dur,(options.drag ? 0 : options.dur)],
                    mCustomScrollBox=$("#mCSB_"+d.idx),
                    mCSB_container=$("#mCSB_"+d.idx+"_container"),
                    wrapper=mCSB_container.parent(),
                    totalScrollOffsets=o.callbacks.onTotalScrollOffset ? _arr.call(el,o.callbacks.onTotalScrollOffset) : [0,0],
                    totalScrollBackOffsets=o.callbacks.onTotalScrollBackOffset ? _arr.call(el,o.callbacks.onTotalScrollBackOffset) : [0,0];
                d.trigger=options.trigger;
                if(wrapper.scrollTop()!==0 || wrapper.scrollLeft()!==0){ /* always reset scrollTop/Left */
                    $(".mCSB_"+d.idx+"_scrollbar").css("visibility","visible");
                    wrapper.scrollTop(0).scrollLeft(0);
                }
                if(to==="_resetY" && !d.contentReset.y){
                    /* callbacks: onOverflowYNone */
                    if(_cb("onOverflowYNone")){o.callbacks.onOverflowYNone.call(el[0]);}
                    d.contentReset.y=1;
                }
                if(to==="_resetX" && !d.contentReset.x){
                    /* callbacks: onOverflowXNone */
                    if(_cb("onOverflowXNone")){o.callbacks.onOverflowXNone.call(el[0]);}
                    d.contentReset.x=1;
                }
                if(to==="_resetY" || to==="_resetX"){return;}
                if((d.contentReset.y || !el[0].mcs) && d.overflowed[0]){
                    /* callbacks: onOverflowY */
                    if(_cb("onOverflowY")){o.callbacks.onOverflowY.call(el[0]);}
                    d.contentReset.x=null;
                }
                if((d.contentReset.x || !el[0].mcs) && d.overflowed[1]){
                    /* callbacks: onOverflowX */
                    if(_cb("onOverflowX")){o.callbacks.onOverflowX.call(el[0]);}
                    d.contentReset.x=null;
                }
                if(o.snapAmount){ /* scrolling snapping */
                    var snapAmount=!(o.snapAmount instanceof Array) ? o.snapAmount : options.dir==="x" ? o.snapAmount[1] : o.snapAmount[0];
                    to=_snapAmount(to,snapAmount,o.snapOffset);
                }
                switch(options.dir){
                    case "x":
                        var mCSB_dragger=$("#mCSB_"+d.idx+"_dragger_horizontal"),
                            property="left",
                            contentPos=mCSB_container[0].offsetLeft,
                            limit=[
                                mCustomScrollBox.width()-mCSB_container.outerWidth(false),
                                mCSB_dragger.parent().width()-mCSB_dragger.width()
                            ],
                            scrollTo=[to,to===0 ? 0 : (to/d.scrollRatio.x)],
                            tso=totalScrollOffsets[1],
                            tsbo=totalScrollBackOffsets[1],
                            totalScrollOffset=tso>0 ? tso/d.scrollRatio.x : 0,
                            totalScrollBackOffset=tsbo>0 ? tsbo/d.scrollRatio.x : 0;
                        break;
                    case "y":
                        var mCSB_dragger=$("#mCSB_"+d.idx+"_dragger_vertical"),
                            property="top",
                            contentPos=mCSB_container[0].offsetTop,
                            limit=[
                                mCustomScrollBox.height()-mCSB_container.outerHeight(false),
                                mCSB_dragger.parent().height()-mCSB_dragger.height()
                            ],
                            scrollTo=[to,to===0 ? 0 : (to/d.scrollRatio.y)],
                            tso=totalScrollOffsets[0],
                            tsbo=totalScrollBackOffsets[0],
                            totalScrollOffset=tso>0 ? tso/d.scrollRatio.y : 0,
                            totalScrollBackOffset=tsbo>0 ? tsbo/d.scrollRatio.y : 0;
                        break;
                }
                if(scrollTo[1]<0 || (scrollTo[0]===0 && scrollTo[1]===0)){
                    scrollTo=[0,0];
                }else if(scrollTo[1]>=limit[1]){
                    scrollTo=[limit[0],limit[1]];
                }else{
                    scrollTo[0]=-scrollTo[0];
                }
                if(!el[0].mcs){
                    _mcs();  /* init mcs object (once) to make it available before callbacks */
                    if(_cb("onInit")){o.callbacks.onInit.call(el[0]);} /* callbacks: onInit */
                }
                clearTimeout(mCSB_container[0].onCompleteTimeout);
                _tweenTo(mCSB_dragger[0],property,Math.round(scrollTo[1]),dur[1],options.scrollEasing);
                if(!d.tweenRunning && ((contentPos===0 && scrollTo[0]>=0) || (contentPos===limit[0] && scrollTo[0]<=limit[0]))){return;}
                _tweenTo(mCSB_container[0],property,Math.round(scrollTo[0]),dur[0],options.scrollEasing,options.overwrite,{
                    onStart:function(){
                        if(options.callbacks && options.onStart && !d.tweenRunning){
                            /* callbacks: onScrollStart */
                            if(_cb("onScrollStart")){_mcs(); o.callbacks.onScrollStart.call(el[0]);}
                            d.tweenRunning=true;
                            _onDragClasses(mCSB_dragger);
                            d.cbOffsets=_cbOffsets();
                        }
                    },onUpdate:function(){
                        if(options.callbacks && options.onUpdate){
                            /* callbacks: whileScrolling */
                            if(_cb("whileScrolling")){_mcs(); o.callbacks.whileScrolling.call(el[0]);}
                        }
                    },onComplete:function(){
                        if(options.callbacks && options.onComplete){
                            if(o.axis==="yx"){clearTimeout(mCSB_container[0].onCompleteTimeout);}
                            var t=mCSB_container[0].idleTimer || 0;
                            mCSB_container[0].onCompleteTimeout=setTimeout(function(){
                                /* callbacks: onScroll, onTotalScroll, onTotalScrollBack */
                                if(_cb("onScroll")){_mcs(); o.callbacks.onScroll.call(el[0]);}
                                if(_cb("onTotalScroll") && scrollTo[1]>=limit[1]-totalScrollOffset && d.cbOffsets[0]){_mcs(); o.callbacks.onTotalScroll.call(el[0]);}
                                if(_cb("onTotalScrollBack") && scrollTo[1]<=totalScrollBackOffset && d.cbOffsets[1]){_mcs(); o.callbacks.onTotalScrollBack.call(el[0]);}
                                d.tweenRunning=false;
                                mCSB_container[0].idleTimer=0;
                                _onDragClasses(mCSB_dragger,"hide");
                            },t);
                        }
                    }
                });
                /* checks if callback function exists */
                function _cb(cb){
                    return d && o.callbacks[cb] && typeof o.callbacks[cb]==="function";
                }
                /* checks whether callback offsets always trigger */
                function _cbOffsets(){
                    return [o.callbacks.alwaysTriggerOffsets || contentPos>=limit[0]+tso,o.callbacks.alwaysTriggerOffsets || contentPos<=-tsbo];
                }
                /*
                 populates object with useful values for the user
                 values:
                 content: this.mcs.content
                 content top position: this.mcs.top
                 content left position: this.mcs.left
                 dragger top position: this.mcs.draggerTop
                 dragger left position: this.mcs.draggerLeft
                 scrolling y percentage: this.mcs.topPct
                 scrolling x percentage: this.mcs.leftPct
                 scrolling direction: this.mcs.direction
                 */
                function _mcs(){
                    var cp=[mCSB_container[0].offsetTop,mCSB_container[0].offsetLeft], /* content position */
                        dp=[mCSB_dragger[0].offsetTop,mCSB_dragger[0].offsetLeft], /* dragger position */
                        cl=[mCSB_container.outerHeight(false),mCSB_container.outerWidth(false)], /* content length */
                        pl=[mCustomScrollBox.height(),mCustomScrollBox.width()]; /* content parent length */
                    el[0].mcs={
                        content:mCSB_container, /* original content wrapper as jquery object */
                        top:cp[0],left:cp[1],draggerTop:dp[0],draggerLeft:dp[1],
                        topPct:Math.round((100*Math.abs(cp[0]))/(Math.abs(cl[0])-pl[0])),leftPct:Math.round((100*Math.abs(cp[1]))/(Math.abs(cl[1])-pl[1])),
                        direction:options.dir
                    };
                    /*
                     this refers to the original element containing the scrollbar(s)
                     usage: this.mcs.top, this.mcs.leftPct etc.
                     */
                }
            },
        /* -------------------- */


        /*
         CUSTOM JAVASCRIPT ANIMATION TWEEN
         Lighter and faster than jquery animate() and css transitions
         Animates top/left properties and includes easings
         */
            _tweenTo=function(el,prop,to,duration,easing,overwrite,callbacks){
                if(!el._mTween){el._mTween={top:{},left:{}};}
                var callbacks=callbacks || {},
                    onStart=callbacks.onStart || function(){},onUpdate=callbacks.onUpdate || function(){},onComplete=callbacks.onComplete || function(){},
                    startTime=_getTime(),_delay,progress=0,from=el.offsetTop,elStyle=el.style,_request,tobj=el._mTween[prop];
                if(prop==="left"){from=el.offsetLeft;}
                var diff=to-from;
                tobj.stop=0;
                if(overwrite!=="none"){_cancelTween();}
                _startTween();
                function _step(){
                    if(tobj.stop){return;}
                    if(!progress){onStart.call();}
                    progress=_getTime()-startTime;
                    _tween();
                    if(progress>=tobj.time){
                        tobj.time=(progress>tobj.time) ? progress+_delay-(progress-tobj.time) : progress+_delay-1;
                        if(tobj.time<progress+1){tobj.time=progress+1;}
                    }
                    if(tobj.time<duration){tobj.id=_request(_step);}else{onComplete.call();}
                }
                function _tween(){
                    if(duration>0){
                        tobj.currVal=_ease(tobj.time,from,diff,duration,easing);
                        elStyle[prop]=Math.round(tobj.currVal)+"px";
                    }else{
                        elStyle[prop]=to+"px";
                    }
                    onUpdate.call();
                }
                function _startTween(){
                    _delay=1000/60;
                    tobj.time=progress+_delay;
                    _request=(!window.requestAnimationFrame) ? function(f){_tween(); return setTimeout(f,0.01);} : window.requestAnimationFrame;
                    tobj.id=_request(_step);
                }
                function _cancelTween(){
                    if(tobj.id==null){return;}
                    if(!window.requestAnimationFrame){clearTimeout(tobj.id);
                    }else{window.cancelAnimationFrame(tobj.id);}
                    tobj.id=null;
                }
                function _ease(t,b,c,d,type){
                    switch(type){
                        case "linear": case "mcsLinear":
                        return c*t/d + b;
                        break;
                        case "mcsLinearOut":
                            t/=d; t--; return c * Math.sqrt(1 - t*t) + b;
                            break;
                        case "easeInOutSmooth":
                            t/=d/2;
                            if(t<1) return c/2*t*t + b;
                            t--;
                            return -c/2 * (t*(t-2) - 1) + b;
                            break;
                        case "easeInOutStrong":
                            t/=d/2;
                            if(t<1) return c/2 * Math.pow( 2, 10 * (t - 1) ) + b;
                            t--;
                            return c/2 * ( -Math.pow( 2, -10 * t) + 2 ) + b;
                            break;
                        case "easeInOut": case "mcsEaseInOut":
                        t/=d/2;
                        if(t<1) return c/2*t*t*t + b;
                        t-=2;
                        return c/2*(t*t*t + 2) + b;
                        break;
                        case "easeOutSmooth":
                            t/=d; t--;
                            return -c * (t*t*t*t - 1) + b;
                            break;
                        case "easeOutStrong":
                            return c * ( -Math.pow( 2, -10 * t/d ) + 1 ) + b;
                            break;
                        case "easeOut": case "mcsEaseOut": default:
                        var ts=(t/=d)*t,tc=ts*t;
                        return b+c*(0.499999999999997*tc*ts + -2.5*ts*ts + 5.5*tc + -6.5*ts + 4*t);
                    }
                }
            },
        /* -------------------- */


        /* returns current time */
            _getTime=function(){
                if(window.performance && window.performance.now){
                    return window.performance.now();
                }else{
                    if(window.performance && window.performance.webkitNow){
                        return window.performance.webkitNow();
                    }else{
                        if(Date.now){return Date.now();}else{return new Date().getTime();}
                    }
                }
            },
        /* -------------------- */


        /* stops a tween */
            _stopTween=function(){
                var el=this;
                if(!el._mTween){el._mTween={top:{},left:{}};}
                var props=["top","left"];
                for(var i=0; i<props.length; i++){
                    var prop=props[i];
                    if(el._mTween[prop].id){
                        if(!window.requestAnimationFrame){clearTimeout(el._mTween[prop].id);
                        }else{window.cancelAnimationFrame(el._mTween[prop].id);}
                        el._mTween[prop].id=null;
                        el._mTween[prop].stop=1;
                    }
                }
            },
        /* -------------------- */


        /* deletes a property (avoiding the exception thrown by IE) */
            _delete=function(c,m){
                try{delete c[m];}catch(e){c[m]=null;}
            },
        /* -------------------- */


        /* detects left mouse button */
            _mouseBtnLeft=function(e){
                return !(e.which && e.which!==1);
            },
        /* -------------------- */


        /* detects if pointer type event is touch */
            _pointerTouch=function(e){
                var t=e.originalEvent.pointerType;
                return !(t && t!=="touch" && t!==2);
            },
        /* -------------------- */


        /* checks if value is numeric */
            _isNumeric=function(val){
                return !isNaN(parseFloat(val)) && isFinite(val);
            },
        /* -------------------- */


        /* returns element position according to content */
            _childPos=function(el){
                var p=el.parents(".mCSB_container");
                return [el.offset().top-p.offset().top,el.offset().left-p.offset().left];
            },
        /* -------------------- */


        /* checks if browser tab is hidden/inactive via Page Visibility API */
            _isTabHidden=function(){
                var prop=_getHiddenProp();
                if(!prop) return false;
                return document[prop];
                function _getHiddenProp(){
                    var pfx=["webkit","moz","ms","o"];
                    if("hidden" in document) return "hidden"; //natively supported
                    for(var i=0; i<pfx.length; i++){ //prefixed
                        if((pfx[i]+"Hidden") in document)
                            return pfx[i]+"Hidden";
                    }
                    return null; //not supported
                }
            };
        /* -------------------- */





        /*
         ----------------------------------------
         PLUGIN SETUP
         ----------------------------------------
         */

        /* plugin constructor functions */
        $.fn[pluginNS]=function(method){ /* usage: $(selector).mCustomScrollbar(); */
            if(methods[method]){
                return methods[method].apply(this,Array.prototype.slice.call(arguments,1));
            }else if(typeof method==="object" || !method){
                return methods.init.apply(this,arguments);
            }else{
                $.error("Method "+method+" does not exist");
            }
        };
        $[pluginNS]=function(method){ /* usage: $.mCustomScrollbar(); */
            if(methods[method]){
                return methods[method].apply(this,Array.prototype.slice.call(arguments,1));
            }else if(typeof method==="object" || !method){
                return methods.init.apply(this,arguments);
            }else{
                $.error("Method "+method+" does not exist");
            }
        };

        /*
         allow setting plugin default options.
         usage: $.mCustomScrollbar.defaults.scrollInertia=500;
         to apply any changed default options on default selectors (below), use inside document ready fn
         e.g.: $(document).ready(function(){ $.mCustomScrollbar.defaults.scrollInertia=500; });
         */
        $[pluginNS].defaults=defaults;

        /*
         add window object (window.mCustomScrollbar)
         usage: if(window.mCustomScrollbar){console.log("custom scrollbar plugin loaded");}
         */
        window[pluginNS]=true;

        $(window).load(function(){

            $(defaultSelector)[pluginNS](); /* add scrollbars automatically on default selector */

            /* extend jQuery expressions */
            $.extend($.expr[":"],{
                /* checks if element is within scrollable viewport */
                mcsInView:$.expr[":"].mcsInView || function(el){
                    var $el=$(el),content=$el.parents(".mCSB_container"),wrapper,cPos;
                    if(!content.length){return;}
                    wrapper=content.parent();
                    cPos=[content[0].offsetTop,content[0].offsetLeft];
                    return 	cPos[0]+_childPos($el)[0]>=0 && cPos[0]+_childPos($el)[0]<wrapper.height()-$el.outerHeight(false) &&
                        cPos[1]+_childPos($el)[1]>=0 && cPos[1]+_childPos($el)[1]<wrapper.width()-$el.outerWidth(false);
                },
                /* checks if element is overflowed having visible scrollbar(s) */
                mcsOverflow:$.expr[":"].mcsOverflow || function(el){
                    var d=$(el).data(pluginPfx);
                    if(!d){return;}
                    return d.overflowed[0] || d.overflowed[1];
                }
            });
            $("#scroll1").mCustomScrollbar({
                theme: "dark",
                axis: "y",
                contentTouchScroll: "TRUE",
                advanced: {autoExpandHorizontalScroll: true}
            } );
            $("#scroll2").mCustomScrollbar({
                theme: "dark",
                axis: "y",
                contentTouchScroll: "TRUE",
                advanced: {autoExpandHorizontalScroll: true}
            } );
            $("#scroll3").mCustomScrollbar({
                theme: "dark",
                axis: "y",
                contentTouchScroll: "TRUE",
                advanced: {autoExpandHorizontalScroll: true}
            } );
        });

    }))}));

/*!
 * jQuery Mousewheel 3.1.13
 *
 * Copyright jQuery Foundation and other contributors
 * Released under the MIT license
 * http://jquery.org/license
 */

(function (factory) {
    if ( typeof define === 'function' && define.amd ) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        // Node/CommonJS style for Browserify
        module.exports = factory;
    } else {
        // Browser globals
        factory(jQuery);
    }
}(function ($) {

    var toFix  = ['wheel', 'mousewheel', 'DOMMouseScroll', 'MozMousePixelScroll'],
        toBind = ( 'onwheel' in document || document.documentMode >= 9 ) ?
            ['wheel'] : ['mousewheel', 'DomMouseScroll', 'MozMousePixelScroll'],
        slice  = Array.prototype.slice,
        nullLowestDeltaTimeout, lowestDelta;

    if ( $.event.fixHooks ) {
        for ( var i = toFix.length; i; ) {
            $.event.fixHooks[ toFix[--i] ] = $.event.mouseHooks;
        }
    }

    var special = $.event.special.mousewheel = {
        version: '3.1.12',

        setup: function() {
            if ( this.addEventListener ) {
                for ( var i = toBind.length; i; ) {
                    this.addEventListener( toBind[--i], handler, false );
                }
            } else {
                this.onmousewheel = handler;
            }
            // Store the line height and page height for this particular element
            $.data(this, 'mousewheel-line-height', special.getLineHeight(this));
            $.data(this, 'mousewheel-page-height', special.getPageHeight(this));
        },

        teardown: function() {
            if ( this.removeEventListener ) {
                for ( var i = toBind.length; i; ) {
                    this.removeEventListener( toBind[--i], handler, false );
                }
            } else {
                this.onmousewheel = null;
            }
            // Clean up the data we added to the element
            $.removeData(this, 'mousewheel-line-height');
            $.removeData(this, 'mousewheel-page-height');
        },

        getLineHeight: function(elem) {
            var $elem = $(elem),
                $parent = $elem['offsetParent' in $.fn ? 'offsetParent' : 'parent']();
            if (!$parent.length) {
                $parent = $('body');
            }
            return parseInt($parent.css('fontSize'), 10) || parseInt($elem.css('fontSize'), 10) || 16;
        },

        getPageHeight: function(elem) {
            return $(elem).height();
        },

        settings: {
            adjustOldDeltas: true, // see shouldAdjustOldDeltas() below
            normalizeOffset: true  // calls getBoundingClientRect for each event
        }
    };

    $.fn.extend({
        mousewheel: function(fn) {
            return fn ? this.bind('mousewheel', fn) : this.trigger('mousewheel');
        },

        unmousewheel: function(fn) {
            return this.unbind('mousewheel', fn);
        }
    });


    function handler(event) {
        var orgEvent   = event || window.event,
            args       = slice.call(arguments, 1),
            delta      = 0,
            deltaX     = 0,
            deltaY     = 0,
            absDelta   = 0,
            offsetX    = 0,
            offsetY    = 0;
        event = $.event.fix(orgEvent);
        event.type = 'mousewheel';

        // Old school scrollwheel delta
        if ( 'detail'      in orgEvent ) { deltaY = orgEvent.detail * -1;      }
        if ( 'wheelDelta'  in orgEvent ) { deltaY = orgEvent.wheelDelta;       }
        if ( 'wheelDeltaY' in orgEvent ) { deltaY = orgEvent.wheelDeltaY;      }
        if ( 'wheelDeltaX' in orgEvent ) { deltaX = orgEvent.wheelDeltaX * -1; }

        // Firefox < 17 horizontal scrolling related to DOMMouseScroll event
        if ( 'axis' in orgEvent && orgEvent.axis === orgEvent.HORIZONTAL_AXIS ) {
            deltaX = deltaY * -1;
            deltaY = 0;
        }

        // Set delta to be deltaY or deltaX if deltaY is 0 for backwards compatabilitiy
        delta = deltaY === 0 ? deltaX : deltaY;

        // New school wheel delta (wheel event)
        if ( 'deltaY' in orgEvent ) {
            deltaY = orgEvent.deltaY * -1;
            delta  = deltaY;
        }
        if ( 'deltaX' in orgEvent ) {
            deltaX = orgEvent.deltaX;
            if ( deltaY === 0 ) { delta  = deltaX * -1; }
        }

        // No change actually happened, no reason to go any further
        if ( deltaY === 0 && deltaX === 0 ) { return; }

        // Need to convert lines and pages to pixels if we aren't already in pixels
        // There are three delta modes:
        //   * deltaMode 0 is by pixels, nothing to do
        //   * deltaMode 1 is by lines
        //   * deltaMode 2 is by pages
        if ( orgEvent.deltaMode === 1 ) {
            var lineHeight = $.data(this, 'mousewheel-line-height');
            delta  *= lineHeight;
            deltaY *= lineHeight;
            deltaX *= lineHeight;
        } else if ( orgEvent.deltaMode === 2 ) {
            var pageHeight = $.data(this, 'mousewheel-page-height');
            delta  *= pageHeight;
            deltaY *= pageHeight;
            deltaX *= pageHeight;
        }

        // Store lowest absolute delta to normalize the delta values
        absDelta = Math.max( Math.abs(deltaY), Math.abs(deltaX) );

        if ( !lowestDelta || absDelta < lowestDelta ) {
            lowestDelta = absDelta;

            // Adjust older deltas if necessary
            if ( shouldAdjustOldDeltas(orgEvent, absDelta) ) {
                lowestDelta /= 40;
            }
        }

        // Adjust older deltas if necessary
        if ( shouldAdjustOldDeltas(orgEvent, absDelta) ) {
            // Divide all the things by 40!
            delta  /= 40;
            deltaX /= 40;
            deltaY /= 40;
        }

        // Get a whole, normalized value for the deltas
        delta  = Math[ delta  >= 1 ? 'floor' : 'ceil' ](delta  / lowestDelta);
        deltaX = Math[ deltaX >= 1 ? 'floor' : 'ceil' ](deltaX / lowestDelta);
        deltaY = Math[ deltaY >= 1 ? 'floor' : 'ceil' ](deltaY / lowestDelta);

        // Normalise offsetX and offsetY properties
        if ( special.settings.normalizeOffset && this.getBoundingClientRect ) {
            var boundingRect = this.getBoundingClientRect();
            offsetX = event.clientX - boundingRect.left;
            offsetY = event.clientY - boundingRect.top;
        }

        // Add information to the event object
        event.deltaX = deltaX;
        event.deltaY = deltaY;
        event.deltaFactor = lowestDelta;
        event.offsetX = offsetX;
        event.offsetY = offsetY;
        // Go ahead and set deltaMode to 0 since we converted to pixels
        // Although this is a little odd since we overwrite the deltaX/Y
        // properties with normalized deltas.
        event.deltaMode = 0;

        // Add event and delta to the front of the arguments
        args.unshift(event, delta, deltaX, deltaY);

        // Clearout lowestDelta after sometime to better
        // handle multiple device types that give different
        // a different lowestDelta
        // Ex: trackpad = 3 and mouse wheel = 120
        if (nullLowestDeltaTimeout) { clearTimeout(nullLowestDeltaTimeout); }
        nullLowestDeltaTimeout = setTimeout(nullLowestDelta, 200);

        return ($.event.dispatch || $.event.handle).apply(this, args);
    }

    function nullLowestDelta() {
        lowestDelta = null;
    }

    function shouldAdjustOldDeltas(orgEvent, absDelta) {
        // If this is an older event and the delta is divisable by 120,
        // then we are assuming that the browser is treating this as an
        // older mouse wheel event and that we should divide the deltas
        // by 40 to try and get a more usable deltaFactor.
        // Side note, this actually impacts the reported scroll distance
        // in older browsers and can cause scrolling to be slower than native.
        // Turn this off by setting $.event.special.mousewheel.settings.adjustOldDeltas to false.
        return special.settings.adjustOldDeltas && orgEvent.type === 'mousewheel' && absDelta % 120 === 0;
    }

}));
/*
 * viewport - jQuery plugin for elements positioning in viewport
 * ver.: 0.2
 * (c) Copyright 2014, Anton Zinoviev aka xobotyi
 * Released under the MIT license
 */
(function ($) {
    var methods = {
        getElementPosition: function (forceViewport) {
            var $this = $(this);

            var _scrollableParent = forceViewport ? $this.parents(forceViewport) : $this.parents(':have-scroll');

            if (!_scrollableParent.length) {
                return false;
            }

            var pos = methods['getRelativePosition'].call(this, forceViewport);
            var _topBorder = pos.top - _scrollableParent.scrollTop();
            var _leftBorder = pos.left - _scrollableParent.scrollLeft();

            return {
                "elemTopBorder": _topBorder,
                "elemBottomBorder": _topBorder + $this.height(),
                "elemLeftBorder": _leftBorder,
                "elemRightBorder": _leftBorder + $this.width(),
                "viewport": _scrollableParent,
                "viewportHeight": _scrollableParent.height(),
                "viewportWidth": _scrollableParent.width()
            };
        },
        getRelativePosition: function (forceViewport) {
            var fromTop = 0;
            var fromLeft = 0;
            var $obj = null;

            for (var obj = $(this).get(0); obj && !$(obj).is(forceViewport ? forceViewport : ':have-scroll'); obj = $(obj).parent().get(0)) {
                $obj = $(obj);
                if (typeof $obj.data('pos') == 'undefined' || new Date().getTime() - $obj.data('pos')[1] > 1000) {
                    /*
                     * Making some kind of a cache system, it takes a bit of memory but helps us veeery much, reducing calculation
                     * */
                    fromTop += obj.offsetTop;
                    fromLeft += obj.offsetLeft;
                    $obj.data('pos', [
                        [obj.offsetTop, obj.offsetLeft],
                        new Date().getTime()
                    ]);
                } else {
                    fromTop += $obj.data('pos')[0][0];
                    fromLeft += $obj.data('pos')[0][1];
                }
            }

            return {"top": Math.round(fromTop), "left": Math.round(fromLeft)};
        },
        aboveTheViewport: function (threshold) {
            var pos = methods['getElementPosition'].call(this);

            return pos ? pos.elemTopBorder - threshold < 0 : false;
        },
        partlyAboveTheViewport: function (threshold) {
            var pos = methods['getElementPosition'].call(this);

            return pos ? pos.elemTopBorder - threshold < 0
            && pos.elemBottomBorder - threshold >= 0 : false;
        },
        belowTheViewport: function (threshold) {
            var pos = methods['getElementPosition'].call(this);

            return pos ? pos.viewportHeight < pos.elemBottomBorder + threshold : false;
        },
        partlyBelowTheViewport: function (threshold) {
            var pos = methods['getElementPosition'].call(this);

            return pos ? pos.viewportHeight < pos.elemBottomBorder + threshold
            && pos.viewportHeight > pos.elemTopBorder + threshold : false;
        },
        leftOfViewport: function (threshold) {
            var pos = methods['getElementPosition'].call(this);

            return pos ? pos.elemLeftBorder - threshold <= 0 : false;
        },
        partlyLeftOfViewport: function (threshold) {
            var pos = methods['getElementPosition'].call(this);

            return pos ? pos.elemLeftBorder - threshold < 0
            && pos.elemRightBorder - threshold >= 0 : false;
        },
        rightOfViewport: function (threshold) {
            var pos = methods['getElementPosition'].call(this);

            return pos ? pos.viewportWidth < pos.elemRightBorder + threshold : false;
        },
        partlyRightOfViewport: function (threshold) {
            var pos = methods['getElementPosition'].call(this);

            return pos ? pos.viewportWidth < pos.elemRightBorder + threshold
            && pos.viewportWidth > pos.elemLeftBorder + threshold : false;
        },
        inViewport: function (threshold) {
            var pos = methods['getElementPosition'].call(this);

            return pos ? !( pos.elemTopBorder - threshold < 0 )
            && !( pos.viewportHeight < pos.elemBottomBorder + threshold )
            && !( pos.elemLeftBorder - threshold < 0 )
            && !( pos.viewportWidth < pos.elemRightBorder + threshold ) : true;
        },
        getState: function (threshold, forceViewport, allowPartly) {
            var ret = {"inside": false, "posY": '', "posX": ''};
            var pos = methods['getElementPosition'].call(this, forceViewport);

            if (!pos) {
                ret.inside = true;
                return ret;
            }

            var _above = pos.elemTopBorder - threshold < 0;
            var _below = pos.viewportHeight < pos.elemBottomBorder + threshold;
            var _left = pos.elemLeftBorder - threshold < 0;
            var _right = pos.viewportWidth < pos.elemRightBorder + threshold;

            if (allowPartly) {
                var _partlyAbove = pos.elemTopBorder - threshold < 0 && pos.elemBottomBorder - threshold >= 0;
                var _partlyBelow = pos.viewportHeight < pos.elemBottomBorder + threshold && pos.viewportHeight > pos.elemTopBorder + threshold;
                var _partlyLeft = pos.elemLeftBorder - threshold < 0 && pos.elemRightBorder - threshold >= 0;
                var _partlyRight = pos.viewportWidth < pos.elemRightBorder + threshold && pos.viewportWidth > pos.elemLeftBorder + threshold;
            }

            if (!_above && !_below && !_left && !_right) {
                ret.inside = true;
                return ret;
            }

            if (allowPartly) {
                if (_partlyAbove && _partlyBelow) {
                    ret.posY = 'exceeds';
                } else if (( _partlyAbove && !_partlyBelow ) || ( _partlyBelow && !_partlyAbove )) {
                    ret.posY = _partlyAbove ? 'partly-above' : 'partly-below';
                } else if (!_above && !_below) {
                    ret.posY = 'inside';
                } else {
                    ret.posY = _above ? 'above' : 'below';
                }

                if (_partlyLeft && _partlyRight) {
                    ret.posX = 'exceeds';
                } else if (( _partlyLeft && !_partlyRight ) || ( _partlyLeft && !_partlyRight )) {
                    ret.posX = _partlyLeft ? 'partly-above' : 'partly-below';
                } else if (!_left && !_right) {
                    ret.posX = 'inside';
                } else {
                    ret.posX = _left ? 'left' : 'right';
                }
            } else {
                if (_above && _below) {
                    ret.posY = 'exceeds';
                } else if (!_above && !_below) {
                    ret.posY = 'inside';
                } else {
                    ret.posY = _above ? 'above' : 'below';
                }

                if (_left && _right) {
                    ret.posX = 'exceeds';
                } else if (!_left && !_right) {
                    ret.posX = 'inside';
                } else {
                    ret.posX = _left ? 'left' : 'right';
                }
            }

            return ret;
        },
        haveScroll: function () {
            return this.scrollHeight > this.offsetHeight
                || this.scrollWidth > this.offsetWidth;
        },
        generateEUID: function () {
            var result = "";
            for (var i = 0; i < 32; i++) {
                result += Math.floor(Math.random() * 16).toString(16);
            }

            return result;
        }
    };

    $.extend($.expr[':'], {
        "in-viewport": function (obj, index, meta) {
            var _threshold = typeof meta[3] == 'string' ? parseInt(meta[3], 10) : 0;
            return methods['inViewport'].call(obj, _threshold);
        },
        "above-the-viewport": function (obj, index, meta) {
            var _threshold = typeof meta[3] == 'string' ? parseInt(meta[3], 10) : 0;
            return methods['aboveTheViewport'].call(obj, _threshold);
        },
        "below-the-viewport": function (obj, index, meta) {
            var _threshold = typeof meta[3] == 'string' ? parseInt(meta[3], 10) : 0;
            return methods['belowTheViewport'].call(obj, _threshold);
        },
        "left-of-viewport": function (obj, index, meta) {
            var _threshold = typeof meta[3] == 'string' ? parseInt(meta[3], 10) : 0;
            return methods['leftOfViewport'].call(obj, _threshold);
        },
        "right-of-viewport": function (obj, index, meta) {
            var _threshold = typeof meta[3] == 'string' ? parseInt(meta[3], 10) : 0;
            return methods['rightOfViewport'].call(obj, _threshold);
        },
        "partly-above-the-viewport": function (obj, index, meta) {
            var _threshold = typeof meta[3] == 'string' ? parseInt(meta[3], 10) : 0;
            return methods['partlyAboveTheViewport'].call(obj, _threshold);
        },
        "partly-below-the-viewport": function (obj, index, meta) {
            var _threshold = typeof meta[3] == 'string' ? parseInt(meta[3], 10) : 0;
            return methods['partlyBelowTheViewport'].call(obj, _threshold);
        },
        "partly-left-of-viewport": function (obj, index, meta) {
            var _threshold = typeof meta[3] == 'string' ? parseInt(meta[3], 10) : 0;
            return methods['partlyLeftOfViewport'].call(obj, _threshold);
        },
        "partly-right-of-viewport": function (obj, index, meta) {
            var _threshold = typeof meta[3] == 'string' ? parseInt(meta[3], 10) : 0;
            return methods['partlyRightOfViewport'].call(obj, _threshold);
        },
        "have-scroll": function (obj) {
            return methods['haveScroll'].call(obj);
        }
    });

    $.fn.viewportTrack = function (options) {
        var settings = {
            "threshold": 0,
            "allowPartly": false,
            "forceViewport": false,
            "tracker": false,
            "checkOnInit": true
        };

        if (typeof options == 'undefined') {
            return methods['getState'].apply(this, [settings.threshold, settings.forceViewport, settings.allowPartly]);
        } else if (typeof options == 'string') {
            if (options == 'destroy') {
                return this.each(function () {
                    var $this = $(this);

                    if (typeof $this.data('viewport_euid') == 'undefined') {
                        return true;
                    }

                    var _scrollable = $([]);

                    if (typeof $this.data('viewport') != 'undefined') {
                        $this.data('viewport').forEach(function (val) {
                            _scrollable = $.extend(_scrollable, $this.parents(val));
                        });
                    } else {
                        _scrollable = $.extend(_scrollable, $this.parents(":have-scroll"));
                    }

                    _scrollable.each(function () {
                        if ($(this).get(0).tagName == "BODY") {
                            $(window).unbind(".viewport" + $this.data('viewport_euid'));
                        } else {
                            $(this).unbind(".viewport" + $this.data('viewport_euid'));
                        }
                    });

                    $this.removeData('viewport_euid');
                });
            } else {
                $.error('Incorrect parameter value.');
                return this;
            }
        } else if (typeof options == 'object') {
            $.extend(settings, options);

            if (!settings.tracker && typeof settings.tracker != 'function') {
                return methods['getState'].apply(this, [settings.threshold, settings.forceViewport, settings.allowPartly]);
            } else {
                return this.each(function () {
                    var $this = $(this);
                    var obj = this;

                    if (typeof $this.data('viewport_euid') == 'undefined') {
                        $this.data('viewport_euid', methods['generateEUID'].call());
                    }

                    if (settings.forceViewport) {
                        if (typeof $this.data('viewport') == 'undefined') {
                            $this.data('viewport', [settings.forceViewport]);
                        } else {
                            $this.data('viewport').push(settings.forceViewport);
                        }
                    }

                    if (settings.checkOnInit) {
                        settings.tracker.apply(obj, [methods['getState'].apply(obj, [settings.threshold, settings.forceViewport, settings.allowPartly])]);
                    }

                    var _scrollable = settings.forceViewport ? $this.parents(settings.forceViewport) : $this.parents(':have-scroll');

                    if (!_scrollable.length) {
                        if (settings.forceViewport) {
                            $.error('No such parent \'' + settings.forceViewport + '\'');
                        } else {
                            settings.tracker.apply(obj, [{"inside": true, "posY": '', "posX": ''}]);
                            return true;
                        }
                    }

                    if (_scrollable.get(0).tagName == "BODY") {
                        $(window).bind("scroll.viewport" + $this.data('viewport_euid'), function () {
                            settings.tracker.apply(obj, [methods['getState'].apply(obj, [settings.threshold, settings.forceViewport, settings.allowPartly])]);
                        });
                    } else {
                        _scrollable.bind("scroll.viewport" + $this.data('viewport_euid'), function () {
                            settings.tracker.apply(obj, [methods['getState'].apply(obj, [settings.threshold, settings.forceViewport, settings.allowPartly])]);
                        });
                    }
                });
            }
        }
    };
})(jQuery);
/**
 * Lazy Plugin
 * @version 2.0.0
 * @author Bartosz Wojciechowski
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {

    /**
     * Creates the lazy plugin.
     * @class The Lazy Plugin
     * @param {Owl} carousel - The Owl Carousel
     */
    var Lazy = function(carousel) {

        /**
         * Reference to the core.
         * @protected
         * @type {Owl}
         */
        this._core = carousel;

        /**
         * Already loaded items.
         * @protected
         * @type {Array.<jQuery>}
         */
        this._loaded = [];

        /**
         * Event handlers.
         * @protected
         * @type {Object}
         */
        this._handlers = {
            'initialized.owl.carousel change.owl.carousel': $.proxy(function(e) {
                if (!e.namespace) {
                    return;
                }

                if (!this._core.settings || !this._core.settings.lazyLoad) {
                    return;
                }

                if ((e.property && e.property.name == 'position') || e.type == 'initialized') {
                    var settings = this._core.settings,
                        n = (settings.center && Math.ceil(settings.items / 2) || settings.items),
                        i = ((settings.center && n * -1) || 0),
                        position = ((e.property && e.property.value) || this._core.current()) + i,
                        clones = this._core.clones().length,
                        load = $.proxy(function(i, v) { this.load(v) }, this);

                    while (i++ < n) {
                        this.load(clones / 2 + this._core.relative(position));
                        clones && $.each(this._core.clones(this._core.relative(position++)), load);
                    }
                }
            }, this)
        };

        // set the default options
        this._core.options = $.extend({}, Lazy.Defaults, this._core.options);

        // register event handler
        this._core.$element.on(this._handlers);
    }

    /**
     * Default options.
     * @public
     */
    Lazy.Defaults = {
        lazyLoad: false
    }

    /**
     * Loads all resources of an item at the specified position.
     * @param {Number} position - The absolute position of the item.
     * @protected
     */
    Lazy.prototype.load = function(position) {
        var $item = this._core.$stage.children().eq(position),
            $elements = $item && $item.find('.owl-lazy');

        if (!$elements || $.inArray($item.get(0), this._loaded) > -1) {
            return;
        }

        $elements.each($.proxy(function(index, element) {
            var $element = $(element), image,
                url = (window.devicePixelRatio > 1 && $element.attr('data-src-retina')) || $element.attr('data-src');

            this._core.trigger('load', { element: $element, url: url }, 'lazy');

            if ($element.is('img')) {
                $element.one('load.owl.lazy', $.proxy(function() {
                    $element.css('opacity', 1);
                    this._core.trigger('loaded', { element: $element, url: url }, 'lazy');
                }, this)).attr('src', url);
            } else {
                image = new Image();
                image.onload = $.proxy(function() {
                    $element.css({
                        'background-image': 'url(' + url + ')',
                        'opacity': '1'
                    });
                    this._core.trigger('loaded', { element: $element, url: url }, 'lazy');
                }, this);
                image.src = url;
            }
        }, this));

        this._loaded.push($item.get(0));
    }

    /**
     * Destroys the plugin.
     * @public
     */
    Lazy.prototype.destroy = function() {
        var handler, property;

        for (handler in this.handlers) {
            this._core.$element.off(handler, this.handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    }

    $.fn.owlCarousel.Constructor.Plugins.Lazy = Lazy;

})(window.Zepto || window.jQuery, window, document);

/**
 * AutoHeight Plugin
 * @version 2.0.0
 * @author Bartosz Wojciechowski
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {

    /**
     * Creates the auto height plugin.
     * @class The Auto Height Plugin
     * @param {Owl} carousel - The Owl Carousel
     */
    var AutoHeight = function(carousel) {
        /**
         * Reference to the core.
         * @protected
         * @type {Owl}
         */
        this._core = carousel;

        /**
         * All event handlers.
         * @protected
         * @type {Object}
         */
        this._handlers = {
            'initialized.owl.carousel': $.proxy(function() {
                if (this._core.settings.autoHeight) {
                    this.update();
                }
            }, this),
            'changed.owl.carousel': $.proxy(function(e) {
                if (this._core.settings.autoHeight && e.property.name == 'position'){
                    this.update();
                }
            }, this),
            'loaded.owl.lazy': $.proxy(function(e) {
                if (this._core.settings.autoHeight && e.element.closest('.' + this._core.settings.itemClass)
                    === this._core.$stage.children().eq(this._core.current())) {
                    this.update();
                }
            }, this)
        };

        // set default options
        this._core.options = $.extend({}, AutoHeight.Defaults, this._core.options);

        // register event handlers
        this._core.$element.on(this._handlers);
    };

    /**
     * Default options.
     * @public
     */
    AutoHeight.Defaults = {
        autoHeight: false,
        autoHeightClass: 'owl-height'
    };

    /**
     * Updates the view.
     */
    AutoHeight.prototype.update = function() {
        this._core.$stage.parent()
            .height(this._core.$stage.children().eq(this._core.current()).height())
            .addClass(this._core.settings.autoHeightClass);
    };

    AutoHeight.prototype.destroy = function() {
        var handler, property;

        for (handler in this._handlers) {
            this._core.$element.off(handler, this._handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    };

    $.fn.owlCarousel.Constructor.Plugins.AutoHeight = AutoHeight;

})(window.Zepto || window.jQuery, window, document);

/**
 * Video Plugin
 * @version 2.0.0
 * @author Bartosz Wojciechowski
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {

    /**
     * Creates the video plugin.
     * @class The Video Plugin
     * @param {Owl} carousel - The Owl Carousel
     */
    var Video = function(carousel) {
        /**
         * Reference to the core.
         * @protected
         * @type {Owl}
         */
        this._core = carousel;

        /**
         * Cache all video URLs.
         * @protected
         * @type {Object}
         */
        this._videos = {};

        /**
         * Current playing item.
         * @protected
         * @type {jQuery}
         */
        this._playing = null;

        /**
         * Whether this is in fullscreen or not.
         * @protected
         * @type {Boolean}
         */
        this._fullscreen = false;

        /**
         * All event handlers.
         * @protected
         * @type {Object}
         */
        this._handlers = {
            'resize.owl.carousel': $.proxy(function(e) {
                if (this._core.settings.video && !this.isInFullScreen()) {
                    e.preventDefault();
                }
            }, this),
            'refresh.owl.carousel changed.owl.carousel': $.proxy(function(e) {
                if (this._playing) {
                    this.stop();
                }
            }, this),
            'prepared.owl.carousel': $.proxy(function(e) {
                var $element = $(e.content).find('.owl-video');
                if ($element.length) {
                    $element.css('display', 'none');
                    this.fetch($element, $(e.content));
                }
            }, this)
        };

        // set default options
        this._core.options = $.extend({}, Video.Defaults, this._core.options);

        // register event handlers
        this._core.$element.on(this._handlers);

        this._core.$element.on('click.owl.video', '.owl-video-play-icon', $.proxy(function(e) {
            this.play(e);
        }, this));
    };

    /**
     * Default options.
     * @public
     */
    Video.Defaults = {
        video: false,
        videoHeight: false,
        videoWidth: false
    };

    /**
     * Gets the video ID and the type (YouTube/Vimeo only).
     * @protected
     * @param {jQuery} target - The target containing the video data.
     * @param {jQuery} item - The item containing the video.
     */
    Video.prototype.fetch = function(target, item) {

        var type = target.attr('data-vimeo-id') ? 'vimeo' : 'youtube',
            id = target.attr('data-vimeo-id') || target.attr('data-youtube-id'),
            width = target.attr('data-width') || this._core.settings.videoWidth,
            height = target.attr('data-height') || this._core.settings.videoHeight,
            url = target.attr('href');

        if (url) {
            id = url.match(/(http:|https:|)\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/);

            if (id[3].indexOf('youtu') > -1) {
                type = 'youtube';
            } else if (id[3].indexOf('vimeo') > -1) {
                type = 'vimeo';
            } else {
                throw new Error('Video URL not supported.');
            }
            id = id[6];
        } else {
            throw new Error('Missing video URL.');
        }

        this._videos[url] = {
            type: type,
            id: id,
            width: width,
            height: height
        };

        item.attr('data-video', url);

        this.thumbnail(target, this._videos[url]);
    };

    /**
     * Creates video thumbnail.
     * @protected
     * @param {jQuery} target - The target containing the video data.
     * @param {Object} info - The video info object.
     * @see `fetch`
     */
    Video.prototype.thumbnail = function(target, video) {

        var tnLink,
            icon,
            path,
            dimensions = video.width && video.height ? 'style="width:' + video.width + 'px;height:' + video.height + 'px;"' : '',
            customTn = target.find('img'),
            srcType = 'src',
            lazyClass = '',
            settings = this._core.settings,
            create = function(path) {
                icon = '<div class="owl-video-play-icon"></div>';

                if (settings.lazyLoad) {
                    tnLink = '<div class="owl-video-tn ' + lazyClass + '" ' + srcType + '="' + path + '"></div>';
                } else {
                    tnLink = '<div class="owl-video-tn" style="opacity:1;background-image:url(' + path + ')"></div>';
                }
                target.after(tnLink);
                target.after(icon);
            };

        // wrap video content into owl-video-wrapper div
        target.wrap('<div class="owl-video-wrapper"' + dimensions + '></div>');

        if (this._core.settings.lazyLoad) {
            srcType = 'data-src';
            lazyClass = 'owl-lazy';
        }

        // custom thumbnail
        if (customTn.length) {
            create(customTn.attr(srcType));
            customTn.remove();
            return false;
        }

        if (video.type === 'youtube') {
            path = "http://img.youtube.com/vi/" + video.id + "/hqdefault.jpg";
            create(path);
        } else if (video.type === 'vimeo') {
            $.ajax({
                type: 'GET',
                url: 'http://vimeo.com/api/v2/video/' + video.id + '.json',
                jsonp: 'callback',
                dataType: 'jsonp',
                success: function(data) {
                    path = data[0].thumbnail_large;
                    create(path);
                }
            });
        }
    };

    /**
     * Stops the current video.
     * @public
     */
    Video.prototype.stop = function() {
        this._core.trigger('stop', null, 'video');
        this._playing.find('.owl-video-frame').remove();
        this._playing.removeClass('owl-video-playing');
        this._playing = null;
    };

    /**
     * Starts the current video.
     * @public
     * @param {Event} ev - The event arguments.
     */
    Video.prototype.play = function(ev) {
        this._core.trigger('play', null, 'video');

        if (this._playing) {
            this.stop();
        }

        var target = $(ev.target || ev.srcElement),
            item = target.closest('.' + this._core.settings.itemClass),
            video = this._videos[item.attr('data-video')],
            width = video.width || '100%',
            height = video.height || this._core.$stage.height(),
            html, wrap;

        if (video.type === 'youtube') {
            html = '<iframe width="' + width + '" height="' + height + '" src="http://www.youtube.com/embed/'
                + video.id + '?autoplay=1&v=' + video.id + '" frameborder="0" allowfullscreen></iframe>';
        } else if (video.type === 'vimeo') {
            html = '<iframe src="http://player.vimeo.com/video/' + video.id + '?autoplay=1" width="' + width
                + '" height="' + height
                + '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
        }

        item.addClass('owl-video-playing');
        this._playing = item;

        wrap = $('<div style="height:' + height + 'px; width:' + width + 'px" class="owl-video-frame">'
            + html + '</div>');
        target.after(wrap);
    };

    /**
     * Checks whether an video is currently in full screen mode or not.
     * @todo Bad style because looks like a readonly method but changes members.
     * @protected
     * @returns {Boolean}
     */
    Video.prototype.isInFullScreen = function() {

        // if Vimeo Fullscreen mode
        var element = document.fullscreenElement || document.mozFullScreenElement
            || document.webkitFullscreenElement;

        if (element && $(element).parent().hasClass('owl-video-frame')) {
            this._core.speed(0);
            this._fullscreen = true;
        }

        if (element && this._fullscreen && this._playing) {
            return false;
        }

        // comming back from fullscreen
        if (this._fullscreen) {
            this._fullscreen = false;
            return false;
        }

        // check full screen mode and window orientation
        if (this._playing) {
            if (this._core.state.orientation !== window.orientation) {
                this._core.state.orientation = window.orientation;
                return false;
            }
        }

        return true;
    };

    /**
     * Destroys the plugin.
     */
    Video.prototype.destroy = function() {
        var handler, property;

        this._core.$element.off('click.owl.video');

        for (handler in this._handlers) {
            this._core.$element.off(handler, this._handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    };

    $.fn.owlCarousel.Constructor.Plugins.Video = Video;

})(window.Zepto || window.jQuery, window, document);

/**
 * Animate Plugin
 * @version 2.0.0
 * @author Bartosz Wojciechowski
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {

    /**
     * Creates the animate plugin.
     * @class The Navigation Plugin
     * @param {Owl} scope - The Owl Carousel
     */
    var Animate = function(scope) {
        this.core = scope;
        this.core.options = $.extend({}, Animate.Defaults, this.core.options);
        this.swapping = true;
        this.previous = undefined;
        this.next = undefined;

        this.handlers = {
            'change.owl.carousel': $.proxy(function(e) {
                if (e.property.name == 'position') {
                    this.previous = this.core.current();
                    this.next = e.property.value;
                }
            }, this),
            'drag.owl.carousel dragged.owl.carousel translated.owl.carousel': $.proxy(function(e) {
                this.swapping = e.type == 'translated';
            }, this),
            'translate.owl.carousel': $.proxy(function(e) {
                if (this.swapping && (this.core.options.animateOut || this.core.options.animateIn)) {
                    this.swap();
                }
            }, this)
        };

        this.core.$element.on(this.handlers);
    };

    /**
     * Default options.
     * @public
     */
    Animate.Defaults = {
        animateOut: false,
        animateIn: false
    };

    /**
     * Toggles the animation classes whenever an translations starts.
     * @protected
     * @returns {Boolean|undefined}
     */
    Animate.prototype.swap = function() {

        if (this.core.settings.items !== 1 || !this.core.support3d) {
            return;
        }

        this.core.speed(0);

        var left,
            clear = $.proxy(this.clear, this),
            previous = this.core.$stage.children().eq(this.previous),
            next = this.core.$stage.children().eq(this.next),
            incoming = this.core.settings.animateIn,
            outgoing = this.core.settings.animateOut;

        if (this.core.current() === this.previous) {
            return;
        }

        if (outgoing) {
            left = this.core.coordinates(this.previous) - this.core.coordinates(this.next);
            previous.css( { 'left': left + 'px' } )
                .addClass('animated owl-animated-out')
                .addClass(outgoing)
                .one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', clear);
        }

        if (incoming) {
            next.addClass('animated owl-animated-in')
                .addClass(incoming)
                .one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', clear);
        }
    };

    Animate.prototype.clear = function(e) {
        $(e.target).css( { 'left': '' } )
            .removeClass('animated owl-animated-out owl-animated-in')
            .removeClass(this.core.settings.animateIn)
            .removeClass(this.core.settings.animateOut);
        this.core.transitionEnd();
    }

    /**
     * Destroys the plugin.
     * @public
     */
    Animate.prototype.destroy = function() {
        var handler, property;

        for (handler in this.handlers) {
            this.core.$element.off(handler, this.handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    };

    $.fn.owlCarousel.Constructor.Plugins.Animate = Animate;

})(window.Zepto || window.jQuery, window, document);

/**
 * Autoplay Plugin
 * @version 2.0.0
 * @author Bartosz Wojciechowski
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {

    /**
     * Creates the autoplay plugin.
     * @class The Autoplay Plugin
     * @param {Owl} scope - The Owl Carousel
     */
    var Autoplay = function(scope) {
        this.core = scope;
        this.core.options = $.extend({}, Autoplay.Defaults, this.core.options);

        this.handlers = {
            'translated.owl.carousel refreshed.owl.carousel': $.proxy(function() {
                this.autoplay();
            }, this),
            'play.owl.autoplay': $.proxy(function(e, t, s) {
                this.play(t, s);
            }, this),
            'stop.owl.autoplay': $.proxy(function() {
                this.stop();
            }, this),
            'mouseover.owl.autoplay': $.proxy(function() {
                if (this.core.settings.autoplayHoverPause) {
                    this.pause();
                }
            }, this),
            'mouseleave.owl.autoplay': $.proxy(function() {
                if (this.core.settings.autoplayHoverPause) {
                    this.autoplay();
                }
            }, this)
        };

        this.core.$element.on(this.handlers);
    };

    /**
     * Default options.
     * @public
     */
    Autoplay.Defaults = {
        autoplay: false,
        autoplayTimeout: 5000,
        autoplayHoverPause: false,
        autoplaySpeed: false
    };

    /**
     * @protected
     * @todo Must be documented.
     */
    Autoplay.prototype.autoplay = function() {
        if (this.core.settings.autoplay && !this.core.state.videoPlay) {
            window.clearInterval(this.interval);

            this.interval = window.setInterval($.proxy(function() {
                this.play();
            }, this), this.core.settings.autoplayTimeout);
        } else {
            window.clearInterval(this.interval);
        }
    };

    /**
     * Starts the autoplay.
     * @public
     * @param {Number} [timeout] - ...
     * @param {Number} [speed] - ...
     * @returns {Boolean|undefined} - ...
     * @todo Must be documented.
     */
    Autoplay.prototype.play = function(timeout, speed) {
        // if tab is inactive - doesnt work in <IE10
        if (document.hidden === true) {
            return;
        }

        if (this.core.state.isTouch || this.core.state.isScrolling
            || this.core.state.isSwiping || this.core.state.inMotion) {
            return;
        }

        if (this.core.settings.autoplay === false) {
            window.clearInterval(this.interval);
            return;
        }

        this.core.next(this.core.settings.autoplaySpeed);
    };

    /**
     * Stops the autoplay.
     * @public
     */
    Autoplay.prototype.stop = function() {
        window.clearInterval(this.interval);
    };

    /**
     * Pauses the autoplay.
     * @public
     */
    Autoplay.prototype.pause = function() {
        window.clearInterval(this.interval);
    };

    /**
     * Destroys the plugin.
     */
    Autoplay.prototype.destroy = function() {
        var handler, property;

        window.clearInterval(this.interval);

        for (handler in this.handlers) {
            this.core.$element.off(handler, this.handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    };

    $.fn.owlCarousel.Constructor.Plugins.autoplay = Autoplay;

})(window.Zepto || window.jQuery, window, document);

/**
 * Navigation Plugin
 * @version 2.0.0
 * @author Artus Kolanowski
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {
    'use strict';

    /**
     * Creates the navigation plugin.
     * @class The Navigation Plugin
     * @param {Owl} carousel - The Owl Carousel.
     */
    var Navigation = function(carousel) {
        /**
         * Reference to the core.
         * @protected
         * @type {Owl}
         */
        this._core = carousel;

        /**
         * Indicates whether the plugin is initialized or not.
         * @protected
         * @type {Boolean}
         */
        this._initialized = false;

        /**
         * The current paging indexes.
         * @protected
         * @type {Array}
         */
        this._pages = [];

        /**
         * All DOM elements of the user interface.
         * @protected
         * @type {Object}
         */
        this._controls = {};

        /**
         * Markup for an indicator.
         * @protected
         * @type {Array.<String>}
         */
        this._templates = [];

        /**
         * The carousel element.
         * @type {jQuery}
         */
        this.$element = this._core.$element;

        /**
         * Overridden methods of the carousel.
         * @protected
         * @type {Object}
         */
        this._overrides = {
            next: this._core.next,
            prev: this._core.prev,
            to: this._core.to
        };

        /**
         * All event handlers.
         * @protected
         * @type {Object}
         */
        this._handlers = {
            'prepared.owl.carousel': $.proxy(function(e) {
                if (this._core.settings.dotsData) {
                    this._templates.push($(e.content).find('[data-dot]').andSelf('[data-dot]').attr('data-dot'));
                }
            }, this),
            'add.owl.carousel': $.proxy(function(e) {
                if (this._core.settings.dotsData) {
                    this._templates.splice(e.position, 0, $(e.content).find('[data-dot]').andSelf('[data-dot]').attr('data-dot'));
                }
            }, this),
            'remove.owl.carousel prepared.owl.carousel': $.proxy(function(e) {
                if (this._core.settings.dotsData) {
                    this._templates.splice(e.position, 1);
                }
            }, this),
            'change.owl.carousel': $.proxy(function(e) {
                if (e.property.name == 'position') {
                    if (!this._core.state.revert && !this._core.settings.loop && this._core.settings.navRewind) {
                        var current = this._core.current(),
                            maximum = this._core.maximum(),
                            minimum = this._core.minimum();
                        e.data = e.property.value > maximum
                            ? current >= maximum ? minimum : maximum
                            : e.property.value < minimum ? maximum : e.property.value;
                    }
                }
            }, this),
            'changed.owl.carousel': $.proxy(function(e) {
                if (e.property.name == 'position') {
                    this.draw();
                }
            }, this),
            'refreshed.owl.carousel': $.proxy(function() {
                if (!this._initialized) {
                    this.initialize();
                    this._initialized = true;
                }
                this._core.trigger('refresh', null, 'navigation');
                this.update();
                this.draw();
                this._core.trigger('refreshed', null, 'navigation');
            }, this)
        };

        // set default options
        this._core.options = $.extend({}, Navigation.Defaults, this._core.options);

        // register event handlers
        this.$element.on(this._handlers);
    }

    /**
     * Default options.
     * @public
     * @todo Rename `slideBy` to `navBy`
     */
    Navigation.Defaults = {
        nav: false,
        navRewind: true,
        navText: [ 'prev', 'next' ],
        navSpeed: false,
        navElement: 'div',
        navContainer: false,
        navContainerClass: 'owl-nav',
        navClass: [ 'owl-prev', 'owl-next' ],
        slideBy: 1,
        dotClass: 'owl-dot',
        dotsClass: 'owl-dots',
        dots: true,
        dotsEach: false,
        dotData: false,
        dotsSpeed: false,
        dotsContainer: false,
        controlsClass: 'owl-controls'
    }

    /**
     * Initializes the layout of the plugin and extends the carousel.
     * @protected
     */
    Navigation.prototype.initialize = function() {
        var $container, override,
            options = this._core.settings;

        // create the indicator template
        if (!options.dotsData) {
            this._templates = [ $('<div>')
                .addClass(options.dotClass)
                .append($('<span>'))
                .prop('outerHTML') ];
        }

        // create controls container if needed
        if (!options.navContainer || !options.dotsContainer) {
            this._controls.$container = $('<div>')
                .addClass(options.controlsClass)
                .appendTo(this.$element);
        }

        // create DOM structure for absolute navigation
        this._controls.$indicators = options.dotsContainer ? $(options.dotsContainer)
            : $('<div>').hide().addClass(options.dotsClass).appendTo(this._controls.$container);

        this._controls.$indicators.on('click', 'div', $.proxy(function(e) {
            var index = $(e.target).parent().is(this._controls.$indicators)
                ? $(e.target).index() : $(e.target).parent().index();

            e.preventDefault();

            this.to(index, options.dotsSpeed);
        }, this));

        // create DOM structure for relative navigation
        $container = options.navContainer ? $(options.navContainer)
            : $('<div>').addClass(options.navContainerClass).prependTo(this._controls.$container);

        this._controls.$next = $('<' + options.navElement + '>');
        this._controls.$previous = this._controls.$next.clone();

        this._controls.$previous
            .addClass(options.navClass[0])
            .html(options.navText[0])
            .hide()
            .prependTo($container)
            .on('click', $.proxy(function(e) {
                this.prev(options.navSpeed);
            }, this));
        this._controls.$next
            .addClass(options.navClass[1])
            .html(options.navText[1])
            .hide()
            .appendTo($container)
            .on('click', $.proxy(function(e) {
                this.next(options.navSpeed);
            }, this));

        // override public methods of the carousel
        for (override in this._overrides) {
            this._core[override] = $.proxy(this[override], this);
        }
    }

    /**
     * Destroys the plugin.
     * @protected
     */
    Navigation.prototype.destroy = function() {
        var handler, control, property, override;

        for (handler in this._handlers) {
            this.$element.off(handler, this._handlers[handler]);
        }
        for (control in this._controls) {
            this._controls[control].remove();
        }
        for (override in this.overides) {
            this._core[override] = this._overrides[override];
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    }

    /**
     * Updates the internal state.
     * @protected
     */
    Navigation.prototype.update = function() {
        var i, j, k,
            options = this._core.settings,
            lower = this._core.clones().length / 2,
            upper = lower + this._core.items().length,
            size = options.center || options.autoWidth || options.dotData
                ? 1 : options.dotsEach || options.items;

        if (options.slideBy !== 'page') {
            options.slideBy = Math.min(options.slideBy, options.items);
        }

        if (options.dots || options.slideBy == 'page') {
            this._pages = [];

            for (i = lower, j = 0, k = 0; i < upper; i++) {
                if (j >= size || j === 0) {
                    this._pages.push({
                        start: i - lower,
                        end: i - lower + size - 1
                    });
                    j = 0, ++k;
                }
                j += this._core.mergers(this._core.relative(i));
            }
        }
    }

    /**
     * Draws the user interface.
     * @todo The option `dotData` wont work.
     * @protected
     */
    Navigation.prototype.draw = function() {
        var difference, i, html = '',
            options = this._core.settings,
            $items = this._core.$stage.children(),
            index = this._core.relative(this._core.current());

        if (options.nav && !options.loop && !options.navRewind) {
            this._controls.$previous.toggleClass('disabled', index <= 0);
            this._controls.$next.toggleClass('disabled', index >= this._core.maximum());
        }

        this._controls.$previous.toggle(options.nav);
        this._controls.$next.toggle(options.nav);

        if (options.dots) {
            difference = this._pages.length - this._controls.$indicators.children().length;

            if (options.dotData && difference !== 0) {
                for (i = 0; i < this._controls.$indicators.children().length; i++) {
                    html += this._templates[this._core.relative(i)];
                }
                this._controls.$indicators.html(html);
            } else if (difference > 0) {
                html = new Array(difference + 1).join(this._templates[0]);
                this._controls.$indicators.append(html);
            } else if (difference < 0) {
                this._controls.$indicators.children().slice(difference).remove();
            }

            this._controls.$indicators.find('.active').removeClass('active');
            this._controls.$indicators.children().eq($.inArray(this.current(), this._pages)).addClass('active');
        }

        this._controls.$indicators.toggle(options.dots);
    }

    /**
     * Extends event data.
     * @protected
     * @param {Event} event - The event object which gets thrown.
     */
    Navigation.prototype.onTrigger = function(event) {
        var settings = this._core.settings;

        event.page = {
            index: $.inArray(this.current(), this._pages),
            count: this._pages.length,
            size: settings && (settings.center || settings.autoWidth || settings.dotData
                ? 1 : settings.dotsEach || settings.items)
        };
    }

    /**
     * Gets the current page position of the carousel.
     * @protected
     * @returns {Number}
     */
    Navigation.prototype.current = function() {
        var index = this._core.relative(this._core.current());
        return $.grep(this._pages, function(o) {
            return o.start <= index && o.end >= index;
        }).pop();
    }

    /**
     * Gets the current succesor/predecessor position.
     * @protected
     * @returns {Number}
     */
    Navigation.prototype.getPosition = function(successor) {
        var position, length,
            options = this._core.settings;

        if (options.slideBy == 'page') {
            position = $.inArray(this.current(), this._pages);
            length = this._pages.length;
            successor ? ++position : --position;
            position = this._pages[((position % length) + length) % length].start;
        } else {
            position = this._core.relative(this._core.current());
            length = this._core.items().length;
            successor ? position += options.slideBy : position -= options.slideBy;
        }
        return position;
    }

    /**
     * Slides to the next item or page.
     * @public
     * @param {Number} [speed=false] - The time in milliseconds for the transition.
     */
    Navigation.prototype.next = function(speed) {
        $.proxy(this._overrides.to, this._core)(this.getPosition(true), speed);
    }

    /**
     * Slides to the previous item or page.
     * @public
     * @param {Number} [speed=false] - The time in milliseconds for the transition.
     */
    Navigation.prototype.prev = function(speed) {
        $.proxy(this._overrides.to, this._core)(this.getPosition(false), speed);
    }

    /**
     * Slides to the specified item or page.
     * @public
     * @param {Number} position - The position of the item or page.
     * @param {Number} [speed] - The time in milliseconds for the transition.
     * @param {Boolean} [standard=false] - Whether to use the standard behaviour or not.
     */
    Navigation.prototype.to = function(position, speed, standard) {
        var length;

        if (!standard) {
            length = this._pages.length;
            $.proxy(this._overrides.to, this._core)(this._pages[((position % length) + length) % length].start, speed);
        } else {
            $.proxy(this._overrides.to, this._core)(position, speed);
        }
    }

    $.fn.owlCarousel.Constructor.Plugins.Navigation = Navigation;

})(window.Zepto || window.jQuery, window, document);

/**
 * Hash Plugin
 * @version 2.0.0
 * @author Artus Kolanowski
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {
    'use strict';

    /**
     * Creates the hash plugin.
     * @class The Hash Plugin
     * @param {Owl} carousel - The Owl Carousel
     */
    var Hash = function(carousel) {
        /**
         * Reference to the core.
         * @protected
         * @type {Owl}
         */
        this._core = carousel;

        /**
         * Hash table for the hashes.
         * @protected
         * @type {Object}
         */
        this._hashes = {};

        /**
         * The carousel element.
         * @type {jQuery}
         */
        this.$element = this._core.$element;

        /**
         * All event handlers.
         * @protected
         * @type {Object}
         */
        this._handlers = {
            'initialized.owl.carousel': $.proxy(function() {
                if (this._core.settings.startPosition == 'URLHash') {
                    $(window).trigger('hashchange.owl.navigation');
                }
            }, this),
            'prepared.owl.carousel': $.proxy(function(e) {
                var hash = $(e.content).find('[data-hash]').andSelf('[data-hash]').attr('data-hash');
                this._hashes[hash] = e.content;
            }, this)
        };

        // set default options
        this._core.options = $.extend({}, Hash.Defaults, this._core.options);

        // register the event handlers
        this.$element.on(this._handlers);

        // register event listener for hash navigation
        $(window).on('hashchange.owl.navigation', $.proxy(function() {
            var hash = window.location.hash.substring(1),
                items = this._core.$stage.children(),
                position = this._hashes[hash] && items.index(this._hashes[hash]) || 0;

            if (!hash) {
                return false;
            }

            this._core.to(position, false, true);
        }, this));
    }

    /**
     * Default options.
     * @public
     */
    Hash.Defaults = {
        URLhashListener: false
    }

    /**
     * Destroys the plugin.
     * @public
     */
    Hash.prototype.destroy = function() {
        var handler, property;

        $(window).off('hashchange.owl.navigation');

        for (handler in this._handlers) {
            this._core.$element.off(handler, this._handlers[handler]);
        }
        for (property in Object.getOwnPropertyNames(this)) {
            typeof this[property] != 'function' && (this[property] = null);
        }
    }

    $.fn.owlCarousel.Constructor.Plugins.Hash = Hash;

})(window.Zepto || window.jQuery, window, document);
