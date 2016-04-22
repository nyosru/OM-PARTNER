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