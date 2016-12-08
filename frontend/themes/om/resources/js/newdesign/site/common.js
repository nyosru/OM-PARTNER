jQuery(document).ready(function()
{
  "use strict";
  /* Navigation */
  jQuery("#nav > li").hover(function()
  {
    var e = jQuery(this).find(".level0-wrapper");
    e.hide(), e.css("left", "0"), e.stop(true, true).delay(150).fadeIn(300, "easeOutCubic")
  }, function()
  {
    jQuery(this).find(".level0-wrapper").stop(true, true).delay(300).fadeOut(300, "easeInCubic")
  });
  slideEffectAjax()
  jQuery("#nav li.level0.drop-menu").mouseover(function()
    {
      return jQuery(window).width() >= 740 && jQuery(this).children("ul.level1").fadeIn(100), !1
    }).mouseleave(function()
    {
      return jQuery(window).width() >= 740 && jQuery(this).children("ul.level1").fadeOut(100), !1
    }), jQuery("#nav li.level0.drop-menu li").mouseover(function()
    {
      if (jQuery(window).width() >= 740)
      {
        jQuery(this).children("ul").css(
        {
          top: 0,
          left: "165px"
        });
        var e = jQuery(this).offset();
        e && jQuery(window).width() < e.left + 325 ? (jQuery(this).children("ul").removeClass("right-sub"), jQuery(this).children("ul").addClass("left-sub"), jQuery(this).children("ul").css(
        {
          top: 0,
          left: "-167px"
        })) : (jQuery(this).children("ul").removeClass("left-sub"), jQuery(this).children("ul").addClass("right-sub")), jQuery(this).children("ul").fadeIn(100)
      }
    }).mouseleave(function()
    {
      jQuery(window).width() >= 740 && jQuery(this).children("ul").fadeOut(100)
    }),
    function deleteCartInCheckoutPage()
    {
      return jQuery(".checkout-cart-index a.btn-remove2,.checkout-cart-index a.btn-remove").on("click", function(e)
      {
        return e.preventDefault(), confirm(confirm_content) ? void 0 : !1
      }), !1
    }

  function slideEffectAjax()
  {
    jQuery(".top-cart-contain").mouseenter(function()
    {
      jQuery(this).find(".top-cart-content").stop(true, true).slideDown()
    }), jQuery(".top-cart-contain").mouseleave(function()
    {
      jQuery(this).find(".top-cart-content").stop(true, true).slideUp()
    })
  }

  function deleteCartInSidebar()
  {
    return is_checkout_page > 0 ? !1 : void jQuery("#cart-sidebar a.btn-remove, #mini_cart_block a.btn-remove").each(function() {})
  }
  /* Best-Seller Slider */
  jQuery("#best-seller-slider .slider-items").owlCarousel(
    {
      items: 4,
      itemsDesktop: [1024, 4],
      itemsDesktopSmall: [900, 3],
      itemsTablet: [600, 2],
      itemsMobile: [320, 1],
      navigation: !0,
      navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
      slideSpeed: 500,
      pagination: !0
    }),
    /* Bag-Seller Slider */
    jQuery("#bag-seller-slider .slider-items").owlCarousel(
    {
      items: 3,
      itemsDesktop: [1024, 4],
      itemsDesktopSmall: [900, 3],
      itemsTablet: [600, 2],
      itemsMobile: [320, 1],
      navigation: !0,
      navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
      slideSpeed: 500,
      pagination: !1
    }),
    jQuery("#bag-seller-slider1 .slider-items").owlCarousel(
    {
      items: 3,
      itemsDesktop: [1024, 4],
      itemsDesktopSmall: [900, 3],
      itemsTablet: [600, 2],
      itemsMobile: [320, 1],
      navigation: !0,
      navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
      slideSpeed: 500,
      pagination: !1
    }),
    /* Featured Slider */
    jQuery("#featured-slider .slider-items").owlCarousel(
    {
      items: 6,
      itemsDesktop: [1024, 4],
      itemsDesktopSmall: [900, 3],
      itemsTablet: [600, 2],
      itemsMobile: [320, 1],
      navigation: !0,
      navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
      slideSpeed: 500,
      pagination: !0
    }),
    /* Recommended Slider */
    jQuery("#recommend-slider .slider-items").owlCarousel(
    {
      items: 6,
      itemsDesktop: [1024, 4],
      itemsDesktopSmall: [900, 3],
      itemsTablet: [600, 2],
      itemsMobile: [320, 1],
      navigation: !0,
      navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
      slideSpeed: 500,
      pagination: !1
    }),
    /* Brand Logo Slider */
    jQuery("#brand-logo-slider .slider-items").owlCarousel(
    {
      autoplay: !0,
      items: 6,
      itemsDesktop: [1024, 4],
      itemsDesktopSmall: [900, 3],
      itemsTablet: [600, 2],
      itemsMobile: [320, 1],
      navigation: !1,
      navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
      slideSpeed: 500,
      pagination: !0
    }),
    /* Category Description Slider */
    jQuery("#category-desc-slider .slider-items").owlCarousel(
    {
      autoplay: !0,
      items: 1,
      itemsDesktop: [1024, 1],
      itemsDesktopSmall: [900, 1],
      itemsTablet: [600, 1],
      itemsMobile: [320, 1],
      navigation: !0,
      navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
      slideSpeed: 500,
      pagination: !1
    }),
    /* More View Slider */
    jQuery("#more-views-slider .slider-items").owlCarousel(
    {
      autoplay: !0,
      items: 3,
      itemsDesktop: [1024, 4],
      itemsDesktopSmall: [900, 3],
      itemsTablet: [600, 2],
      itemsMobile: [320, 1],
      navigation: !0,
      navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
      slideSpeed: 500,
      pagination: !1
    }),
    /* Related Products Slider */
    jQuery("#related-products-slider .slider-items").owlCarousel(
    {
      items: 4,
      itemsDesktop: [1024, 4],
      itemsDesktopSmall: [900, 3],
      itemsTablet: [600, 2],
      itemsMobile: [320, 1],
      navigation: !0,
      navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
      slideSpeed: 500,
      pagination: !0
    }),
    /* UpSell Products Slider */
    jQuery("#upsell-products-slider .slider-items").owlCarousel(
    {
      items: 4,
      itemsDesktop: [1024, 4],
      itemsDesktopSmall: [900, 3],
      itemsTablet: [600, 2],
      itemsMobile: [320, 1],
      navigation: !0,
      navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
      slideSpeed: 500,
      pagination: !0
    }),
    /* Cross-Sell Products */
    jQuery("#cross-sell-products .slider-items").owlCarousel(
    {
      items: 4,
      itemsDesktop: [1024, 4],
      itemsDesktopSmall: [900, 3],
      itemsTablet: [600, 2],
      itemsMobile: [320, 1],
      navigation: !0,
      navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
      slideSpeed: 500,
      pagination: !0
    }),
    jQuery("#crosssel-products-slider .slider-items").owlCarousel(
    {
      items: 5,
      itemsDesktop: [1024, 4],
      itemsDesktopSmall: [900, 3],
      itemsTablet: [600, 2],
      itemsMobile: [320, 1],
      navigation: !0,
      navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
      slideSpeed: 500,
      pagination: !1
    }),
    /* Mobile Menu */
    jQuery(document).ready(function(e)
    {
      e("#mobile-menu").mobileMenu(
      {
        MenuWidth: 250,
        SlideSpeed: 300,
        WindowsMaxWidth: 767,
        PagePush: !0,
        FromLeft: !0,
        Overlay: !0,
        CollapseMenu: !0,
        ClassName: "mobile-menu"
      })
    }),
    jQuery(document).ready(function()
    {
      jQuery(".subDropdown")[0] && jQuery(".subDropdown").on("click", function()
      {
        jQuery(this).toggleClass("plus"), jQuery(this).toggleClass("minus"), jQuery(this).parent().find("ul").slideToggle()
      })
    })
})
var isTouchDevice = "ontouchstart" in window || navigator.msMaxTouchPoints > 0;
jQuery(window).on("load", function()
  {
    isTouchDevice && jQuery("#nav a.level-top").on("click", function()
    {
      if (jQueryt = jQuery(this), jQueryparent = jQueryt.parent(), jQueryparent.hasClass("parent"))
      {
        if (!jQueryt.hasClass("menu-ready")) return jQuery("#nav a.level-top").removeClass("menu-ready"), jQueryt.addClass("menu-ready"), !1;
        jQueryt.removeClass("menu-ready")
      }
    }), jQuery().UItoTop()
  }),
  /* ToTop */
  function(e)
  {
    jQuery.fn.UItoTop = function(t)
    {
      var n = {
          text: "",
          min: 200,
          inDelay: 600,
          outDelay: 400,
          containerID: "toTop",
          containerHoverID: "toTopHover",
          scrollSpeed: 1200,
          easingType: "linear"
        },
        i = e.extend(n, t),
        s = "#" + i.containerID,
        o = "#" + i.containerHoverID;
      jQuery("body").append('<a href="#" id="' + i.containerID + '">' + i.text + "</a>"), jQuery(s).hide().on("click", function()
      {
        return jQuery("html, body").animate(
        {
          scrollTop: 0
        }, i.scrollSpeed, i.easingType), jQuery("#" + i.containerHoverID, this).stop().animate(
        {
          opacity: 0
        }, i.inDelay, i.easingType), !1
      }).prepend('<span id="' + i.containerHoverID + '"></span>').hover(function()
      {
        jQuery(o, this).stop().animate(
        {
          opacity: 1
        }, 600, "linear")
      }, function()
      {
        jQuery(o, this).stop().animate(
        {
          opacity: 0
        }, 700, "linear")
      }), jQuery(window).scroll(function()
      {
        var t = e(window).scrollTop();
        "undefined" == typeof document.body.style.maxHeight && jQuery(s).css(
        {
          position: "absolute",
          top: e(window).scrollTop() + e(window).height() - 50
        }), t > i.min ? jQuery(s).fadeIn(i.inDelay) : jQuery(s).fadeOut(i.Outdelay)
      })
    }
  }(jQuery), jQuery(document).ready(function() {}), jQuery.extend(jQuery.easing,
  {
    easeInCubic: function(e, t, n, i, s)
    {
      return i * (t /= s) * t * t + n
    },
    easeOutCubic: function(e, t, n, i, s)
    {
      return i * ((t = t / s - 1) * t * t + 1) + n
    }
  }),
  /* Accordion */
  function(e)
  {
    e.fn.extend(
    {
      accordion: function()
      {
        return this.each(function() {})
      }
    })
  }(jQuery), jQuery(function(e)
  {
    e(".accordion").accordion(), e(".accordion").each(function()
    {
      var t = e(this).find("li.active");
      t.each(function(n)
      {
        e(this).children("ul").css("display", "block"), n == t.length - 1 && e(this).addClass("current")
      })
    })
  }),
  function(e)
  {
    e.fn.extend(
    {
      accordionNew: function()
      {
        return this.each(function()
        {
          function t(t, i)
          {
            e(t).parent(l).siblings().removeClass(s).children(a).slideUp(c), e(t).siblings(a)[i || o]("show" == i ? c : !1, function()
            {
              e(t).siblings(a).is(":visible") ? e(t).parents(l).not(n.parents()).addClass(s) : e(t).parent(l).removeClass(s), "show" == i && e(t).parents(l).not(n.parents()).addClass(s), e(t).parents().show()
            })
          }
          var n = e(this),
            i = "accordiated",
            s = "active",
            o = "slideToggle",
            a = "ul, div",
            c = "fast",
            l = "li";
          if (n.data(i)) return !1;
          e.each(n.find("ul, li>div"), function()
          {
            e(this).data(i, !0), e(this).hide()
          }), e.each(n.find("em.open-close"), function()
          {
            e(this).on("click", function()
            {
              return void t(this, o)
            }), e(this).bind("activate-node", function()
            {
              n.find(a).not(e(this).parents()).not(e(this).siblings()).slideUp(c), t(this, "slideDown")
            })
          });
          var r = location.hash ? n.find("a[href=" + location.hash + "]")[0] : n.find("li.current a")[0];
          r && t(r, !1)
        })
      }
    })
  }(jQuery), jQuery(function(e)
  {
    e(".accordion").accordion(), e(".accordion").each(function()
    {
      var t = e(this).find("li.active");
      t.each(function(n)
      {
        e(this).children("ul").css("display", "block"), n == t.length - 1 && e(this).addClass("current")
      })
    })
  });