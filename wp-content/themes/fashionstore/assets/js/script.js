(function($){
    "use strict"; // Start of use strict

    /************** FUNCTION ****************/
    function fix_position_megamenu(){
    	if($(window).width() >= 768){
	    	$('.main-nav').each(function(){	    		
	    		if($('.rtl-enable').length > 0){
	    			if($(this).parents('.vc_row').length > 0){
		    			var row_pos = $(window).width() - ($(this).parents('.vc_row').offset().left + $(this).parents('.vc_row').outerWidth()) +15;
		    		}
		    		else{
		    			var row_pos = $(window).width() - ($('#header .container').offset().left + $('#header .container').outerWidth()) +15;
		    		}
	                var mega_pos = $(window).width() - ($(this).offset().left + $(this).outerWidth());
	                var left = row_pos-mega_pos;
	                if(left != 0) $(this).find('.has-mega-menu > .sub-menu').css('right',left);
	            }
	            else{
	            	if($(this).parents('.vc_row').length > 0){
		    			var row_pos = $(this).parents('.vc_row').offset().left;
		    		}
		    		else{
		    			var row_pos = $('#header .container').offset().left;
		    		}
		    		var mega_pos = $(this).offset().left;
		    		var left = row_pos-mega_pos+15;
	    			if(left != 0) $(this).find('.has-mega-menu > .sub-menu').css('left',left);
	    		}
	    	})
	    	//Menu sub pos
	    	var c_width = $(window).width();
			$('.main-nav li:not(.has-mega-menu) ul.sub-menu').each(function(){
				var left = $(this).offset().left;
				if($('.rtl-enable').length > 0){
					if(left < 150){
						$(this).css({"right": "inherit"});
						$(this).css({"left": "-50px"});
					}
				}
				else{
					if(c_width - left < 250){
						$(this).css({"left": "-100%"});
					}
				}
			})
	    }
    }
    function menu_responsive(){
    	//Menu Responsive
		$('body').on('click',function(event){
			if($(window).width()<768){
				$('.main-nav>ul').removeClass('active');
			}
		});
		$('.toggle-mobile-menu').on('click',function(event){
			if($(window).width()<768){
				event.preventDefault();
				event.stopPropagation();
				$('.main-nav>ul').toggleClass('active');
			}
		});
		$('.main-nav li.menu-item-has-children>a').on('click',function(event){
			if($(window).width()<768 && !$(this).parent().hasClass('has-mega-menu')){
				event.preventDefault();
				event.stopPropagation();
				$(this).next().slideToggle('slow');
			}
		});

		$('.menu-hover-link').on('click',function(event){
			event.preventDefault();
			$('.content-menu-hover').toggleClass('active');
		});
    }
    function popup_letter(){
    	//Popup letter
		var content = $('#boxes-content').html();
		$('#boxes-content').html('');
		$('#boxes').html(content);
		if($('#boxes').html() != ''){
			var id = '#dialog';	
			//Get the screen height and width
			var maskHeight = $(document).height();
			var maskWidth = $(window).width();
		
			//Set heigth and width to mask to fill up the whole screen
			$('#mask').css({'width':maskWidth,'height':maskHeight});
			
			//transition effect		
			$('#mask').fadeIn(500);	
			$('#mask').fadeTo("slow",0.9);	
		
			//Get the window height and width
			var winH = $(window).height();
			var winW = $(window).width();
	              
			//Set the popup window to center
			$(id).css('top',  winH/2-$(id).height()/2);
			$(id).css('left', winW/2-$(id).width()/2);
		
			//transition effect
			$(id).fadeIn(2000); 	
		
			//if close button is clicked
			$('.window .close-popup').click(function (e) {
				//Cancel the link behavior
				e.preventDefault();
				
				$('#mask').hide();
				$('.window').hide();
			});		
			
			//if mask is clicked
			$('#mask').click(function () {
				$(this).hide();
				$('.window').hide();
			});
		}
    }
    function fix_variable_product(){
    	//Fix product variable thumb    	
        $('body .variations_form select').live('change',function(){
            var id = $('input[name="variation_id"]').val();
            if(id){
                $('.product-gallery .bx-pager').find('a[data-variation_id="'+id+'"]').trigger( 'click' );
            	if($('.product-supper11').length > 0){
            		var slider_owl = $(this).parents('.product-supper11').find('.product-detail11 .wrap-item');
        			var index = slider_owl.find('.item[data-variation_id="'+id+'"]').attr('data-index');
					slider_owl.trigger('owl.goTo', index);
				}
				if($('.trend-box18').length > 0){
					$(this).parents('.item-detail18').find('.trend-thumb18').find('img').removeClass('active');
					$(this).parents('.item-detail18').find('.trend-thumb18').find('div[data-variation_id="'+id+'"]').find('img').addClass('active');
				}
            }
        })
        // variable product
        if($('.wrap-attr-product.special').length > 0){
            $('.attr-filter ul li a').live('click',function(event){
                event.preventDefault();
                $(this).parents('ul').find('li').removeClass('active');
                $(this).parent().addClass('active');
                var attribute = $(this).parent().attr('data-attribute');
                var id = $(this).parents('ul').attr('data-attribute-id');
                $('#'+id).val(attribute);
                $('#'+id).trigger( 'change' );
                $('#'+id).trigger( 'focusin' );
                return false;
            })
            $('.attr-hover-box').hover(function(){
                var seff = $(this);
                var old_html = $(this).find('ul').html();
                var current_val = $(this).find('ul li.active').attr('data-attribute');
                $(this).next().find('select').trigger( 'focusin' );
                var content = '';
                $(this).next().find('select').find('option').each(function(){
                    var val = $(this).attr('value');
                    var title = $(this).html();
                    var el_class = '';
                    if(current_val == val) el_class = ' class="active"';
                    if(val != ''){
                        content += '<li'+el_class+' data-attribute="'+val+'"><a href="#"><span class="bgcolor-'+val+'"></span>'+title+'</a></li>';
                    }
                })
                // console.log(content);
                if(old_html != content) $(this).find('ul').html(content);
            })
            $('body .reset_variations').live('click',function(){
                $('.attr-hover-box').each(function(){
                    var seff = $(this);
                    var old_html = $(this).find('ul').html();
                    var current_val = $(this).find('ul li.active').attr('data-attribute');
                    $(this).next().find('select').trigger( 'focusin' );
                    var content = '';
                    $(this).next().find('select').find('option').each(function(){
                        var val = $(this).attr('value');
                        var title = $(this).html();
                        var el_class = '';
                        if(current_val == val) el_class = ' class="active"';
                        if(val != ''){
	                        content += '<li'+el_class+' data-attribute="'+val+'"><a href="#"><span class="bgcolor-'+val+'"></span>'+title+'</a></li>';
	                    }
                    })
                    if(old_html != content) $(this).find('ul').html(content);
                    $(this).find('ul li').removeClass('active');
                })
            })
        }
        //end
    }
    function img_control(){
    	if($('.banner-slider19').length>0){
			$('.banner-slider19').each(function(){
				//Get html
				if($(this).find('.owl-item.active').prev().length>0){
					$('.prev-img').html($(this).find('.owl-item.active').prev().find('.banner-thumb-hidden').html());
				}else{
					$('.prev-img').html($(this).find('.owl-item').last().find('.banner-thumb-hidden').html());
				}
				if($(this).find('.owl-item.active').next().length>0){
					$('.next-img').html($(this).find('.owl-item.active').next().find('.banner-thumb-hidden').html());
				}else{
					$('.next-img').html($(this).find('.owl-item').first().find('.banner-thumb-hidden').html());
				}
			});
		}
    }
    function afterAction(){
		this.$elem.find('.owl-item').removeClass('active');
		this.$elem.find('.owl-item').eq(this.owl.currentItem).addClass('active');
		img_control();		
	}
    function s7upf_qty_click(){
    	//QUANTITY CLICK
		$(".quantity").find(".qty-up").on("click",function(){
            var min = $(this).prev().attr("data-min");
            var max = $(this).prev().attr("data-max");
            var step = $(this).prev().attr("data-step");
            if(step === undefined) step = 1;
            if(max !==undefined && Number($(this).prev().val())< Number(max) || max === undefined){ 
                if(step!='') $(this).prev().val(Number($(this).prev().val())+Number(step));
            }            
            $( 'div.woocommerce > form input[name="update_cart"]' ).prop( 'disabled', false );
            return false;
        })
        $(".quantity").find(".qty-down").on("click",function(){
            var min = $(this).next().attr("data-min");
            var max = $(this).next().attr("data-max");
            var step = $(this).next().attr("data-step");
            if(step === undefined) step = 1;
            if(Number($(this).next().val()) > 1){
	            if(min !==undefined && $(this).next().val()>min || min === undefined){
	                if(step!='') $(this).next().val(Number($(this).next().val())-Number(step));
	            }
	        }
            $( 'div.woocommerce > form input[name="update_cart"]' ).prop( 'disabled', false );
	        return false;
        })
        $("input.qty-val").on("keyup change",function(){
        	var max = $(this).attr('data-max');
        	if( Number($(this).val()) > Number(max) ) $(this).val(max);
            $( 'div.woocommerce > form input[name="update_cart"]' ).prop( 'disabled', false );
        })
		//END
    }
    function s7upf_fix_price(){
		$('.product-price').each(function(){
            var sale_price = $(this).find('del').html();
            if(sale_price){
                $(this).find('del').remove();
                $(this).append('<del>'+sale_price+'</del>');
            }
        })
    }
    function s7upf_owl_slider(){
    	//Carousel Slider
		if($('.sv-slider').length>0){
			$('.sv-slider').each(function(){
				var seff = $(this);
				var item = seff.attr('data-item');
				var speed = seff.attr('data-speed');
				var itemres = seff.attr('data-itemres');
				var animation = seff.attr('data-animation');
				var nav = seff.attr('data-nav');
				var text_prev = seff.attr('data-prev');
				var text_next = seff.attr('data-next');
				var pagination = false, navigation= true, singleItem = false;
				var autoplay;
				if(speed != '') autoplay = speed;
				else autoplay = false;
				// Navigation
				if(nav == 'nav-hidden'){
					pagination = false;
					navigation= false;
				}
				if(nav == 'testimo-slider' || nav == 'banner-slider17' || nav == 'banner-slider18' || nav == 'banner-slider10'){
					pagination = true;
					navigation= false;
				}
				if(animation != ''){
					singleItem = true;
					item = '1';
				}
				var prev_text = '<i class="fa fa-angle-left" aria-hidden="true"></i>';
				var next_text = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
				if(nav == 'nav-text-data'){
					var prev_text = text_prev;
					var next_text = text_next;
				}
				if(nav == 'shoplook-slider7' || nav == 'testimo-slide7'){
					var prev_text = '';
					var next_text = '';
				}				
				// Item responsive
				if(itemres == '' || itemres === undefined || itemres.split(',').length < 4){
					if(item == '1') itemres = '1,1,1,1';
					if(item == '2') itemres = '1,1,2,2';
					if(item == '3') itemres = '1,1,2,3';
					if(item == '4') itemres = '1,2,2,4';
					if(item >= '5') itemres = '1,2,3,5';
				}
				itemres = itemres.split(',');
				seff.owlCarousel({
					items: item,
					itemsCustom: [ 
					[0, itemres[0]], 
					[360, itemres[0]], 
					[480, itemres[1]], 
					[640, itemres[2]], 
					[992, itemres[3]], 
					[1200, item] 
					],
					autoPlay:autoplay,
					pagination: pagination,
					navigation: navigation,
					navigationText:[prev_text,next_text],
					singleItem : singleItem,
					// addClassActive : true,
					afterAction: afterAction,
					transitionStyle : animation
				});
				if($(this).parent().hasClass('banner-slider19')){
					$(this).find('.owl-controls .owl-prev').append('<div class="prev-img"></div>');
					$(this).find('.owl-controls .owl-next').append('<div class="next-img"></div>');	
					img_control();
				}
			});			
		}
    }

    function s7upf_all_slider(){
    	//Carousel Slider
		if($('.smart-slider').length>0){
			$('.smart-slider').each(function(){
				var seff = $(this);
				var item = seff.attr('data-item');
				var speed = seff.attr('data-speed');
				var itemres = seff.attr('data-itemres');
				var text_prev = seff.attr('data-prev');
				var text_next = seff.attr('data-next');
				var pagination = seff.attr('data-pagination');
				var navigation = seff.attr('data-navigation');
				var autoplay;
				if(speed === undefined) speed = '';
				if(speed != '') autoplay = speed;
				else autoplay = false;
				if(item == '' || item === undefined) item = 1;
				if(itemres === undefined) itemres = '';
				if(text_prev == 'false') text_prev = '';
				else{
					if(text_prev == '' || text_prev === undefined) text_prev = '<i class="fa fa-angle-left" aria-hidden="true"></i>';
					else text_prev = '<i class="fa '+text_prev+'" aria-hidden="true"></i>';
				}
				if(text_next == 'false') text_next = '';
				else{
					if(text_next == '' || text_next === undefined) text_next = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
					else text_next = '<i class="fa '+text_next+' aria-hidden="true"></i>';
				}
				if(pagination == 'true') pagination = true;
				else pagination = false;
				if(navigation == 'true') navigation = true;
				else navigation = false;
				// Item responsive
				if(itemres == '' || itemres === undefined){
					if(item == '1') itemres = '0:1,480:1,768:1,1200:1';
					if(item == '2') itemres = '0:1,480:1,768:2,1200:2';
					if(item == '3') itemres = '0:1,480:2,768:2,1200:3';
					if(item == '4') itemres = '0:1,480:2,768:2,1200:4';
					if(item >= '5') itemres = '0:1,480:2,768:3,1200:5';
				}				
				itemres = itemres.split(',');
				var itemsCustom =[];
				var i;
				for (i = 0; i < itemres.length; i++) { 
				    itemres[i] = itemres[i].split(':');
				}
				seff.owlCarousel({
					items: item,
					itemsCustom: itemres,
					autoPlay:autoplay,
					pagination: pagination,
					navigation: navigation,
					navigationText:[text_prev,text_next],
					// addClassActive : true,
					// afterAction: afterAction,
				});
			});			
		}
    }

    /************ END FUNCTION **************/

	$(document).ready(function(){
		fix_position_megamenu();
		menu_responsive();
		popup_letter();
		s7upf_fix_price();
		s7upf_qty_click();
		fix_variable_product();		
		//Home 18
		$('.get-cat-thumb').each(function(){
			var thumb_html = $(this).html();
			var id = $(this).parents('.tab-pane').attr('id');
			$(this).parents('.trend-box18').find('.trend-title18').find('a[href="#'+id+'"]').append(thumb_html);
			$(this).remove();
		})
		//Deal Count Down 11
		$('.product-supper11').each(function(){
			var button = $(this).find('.single_add_to_cart_button');
			button.addClass('btn-link11');
			button.attr('data-hover',button.html());
			button.html('<span>'+button.html()+'</span>');
			var link_detail = $(this).find('.supper-deal-link').html();
			$(this).find('.supper-deal-link').remove();
			button.parent().append(link_detail);
		})
		if($('.deal-count11').length>0){
			$('.deal-count11').TimeCircles({
				fg_width: 0.03,
				bg_width: 1,
				text_size: 0.07,
				circle_bg_color: "#333333",
				time: {
					Days: {
						show: true,
						text: "Days",
						color: "#fdcd26"
					},
					Hours: {
						show: true,
						text: "Hours",
						color: "#fdcd26"
					},
					Minutes: {
						show: true,
						text: "Minutes",
						color: "#fdcd26"
					},
					Seconds: {
						show: true,
						text: "Seconds",
						color: "#fdcd26"
					}
				}
			}); 
		}

		//Banner home 2
		$('.banner-slider2').each(function(){
			var index = 0;
			var seff = $(this);
			seff.find('.bxslider li').each(function(){
				var pager_html = $(this).find('.item-pager').html();
				$(this).find('.item-pager').remove();
				if(pager_html) pager_html = pager_html.replace('index="0"','index="'+index+'"');
				index++;
				seff.find('.bx-pager').append(pager_html);
			})
		})

		//Widget Faqs
		$('.widget-faqs li').first().addClass('active');
		$('.widget-faqs li').find('p').hide();
		$('.widget-faqs li').first().find('p').show();
		$('.widget-faqs li h3').on('click',function(){
			$(this).parent().siblings().removeClass('active');
			$(this).parent().addClass('active');
			$('.widget-faqs p').not($(this).next()).slideUp();
			$(this).next().slideDown();
		});
	
		//Back To Top
		$('.back-to-top').on('click',function(event){
			event.preventDefault();
			$('html, body').animate({scrollTop:0}, 1000);
		});
		$('.price-style3').each(function(){
			var s_html = $(this).find('.content-move').html();
			$(this).find('.content-move').remove();
			$(this).find('.product-price').append(s_html);
		})
		//Cat search
		$('.select-category .list-category-toggle li a').click(function(event){
			event.preventDefault();
			$(this).parents('.list-category-toggle').find('li').removeClass('active');
			$(this).parent().addClass('active');
			var x = $(this).attr('data-filter');
			if(x){
				x = x.replace('.','');
				$('.cat-value').val(x);
			}
			else $('.cat-value').val('');
			$('.category-toggle-link span').text($(this).text());
		});
		//Big Sale Count Down
		if($('.bigsale-countdown').length>0){
			var color = "#fdcd26";
			var m_color = $('.bigsale-countdown').attr('data-color');
			if(m_color) color = m_color;
			$('.bigsale-countdown').TimeCircles({
				fg_width: 0.03,
				bg_width: 1,
				text_size: 0.07,
				circle_bg_color: "#333333",
				time: {
					Days: {
						show: true,
						text: "day",
						color: color
					},
					Hours: {
						show: true,
						text: "hour",
						color: color
					},
					Minutes: {
						show: true,
						text: "min",
						color: color
					},
					Seconds: {
						show: true,
						text: "sec",
						color: color
					}
				}
			}); 
		}
		$('.img-popup').fancybox();
		//Video Light Box
		if($('.content-fashion-design').length>0){
			$('.content-fashion-design .fancybox-media').attr('rel', 'media-gallery').fancybox({
				openEffect : 'none',
				closeEffect : 'none',
				prevEffect : 'none',
				nextEffect : 'none',
				arrows : false,
				helpers : {
					media : {},
					buttons : {}
				}
			});
		}
		//Fix mailchimp
        $('.sv-mailchimp-form').each(function(){
            var placeholder = $(this).attr('data-placeholder');
            var submit = $(this).attr('data-submit');
            if(placeholder) $(this).find('input[name="EMAIL"]').attr('placeholder',placeholder);
            if(submit) $(this).find('input[type="submit"]').val(submit);
        })
		//Mini cart
			//Count item cart
			if($("#count-cart-item").length){
				var count_cart_item = $("#count-cart-item").val();
				$(".cart-item-count").html(count_cart_item);
			}
			if($(".get-count-cart-item")){
				var count_cart_item = $(".get-count-cart-item").val();
				$(".number-cart-total").html(count_cart_item);
			}
		//End mini cart
		if($(window).width() >= 768){
			var c_width = $(window).width();
			$('.main-nav .sub-menu .sub-menu').each(function(){
				var left = $(this).offset().left;
				if(c_width - left < 250){
					$(this).css({"left": "-100%"})
				}
				if(left < 250){
					$(this).css({"left": "100%"})
				}
			})
		}
		//Featured Product Tab
		$('.featured-product-title a').on('click',function(event){
			event.preventDefault();
			$(this).parent().siblings().removeClass('active');
			$(this).parent().addClass('active');
			var id=$(this).attr('data-id');
			$('.content-featured-product').each(function(){
				if($(this).attr('id')==id){
					$(this).addClass('active');
				}else{
					$(this).removeClass('active');
				}
			});
		});
		//Supper Deal Countdown
		if($('.supper-deal-countdown').length>0){
			$('.supper-deal-countdown').TimeCircles({
				fg_width: 0.03,
				bg_width: 1.2,
				text_size: 0.07,
				circle_bg_color: "#fff",
				time: {
					Days: {
						show: true,
						text: "",
						color: "#fff"
					},
					Hours: {
						show: true,
						text: "",
						color: "#fff"
					},
					Minutes: {
						show: true,
						text: "",
						color: "#fff"
					},
					Seconds: {
						show: true,
						text: "",
						color: "#fff"
					}
				}
			}); 
		}
	
	});

	/************ END READY **************/

	$(window).load(function(){
		s7upf_owl_slider();
		s7upf_all_slider();
		//Related Product Slider
		if($('.related-product-slider').length>0){
			$('.related-product-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 3,
					itemsCustom: [ 
					[0, 1], 
					[480, 2], 
					[667, 3], 
					[992, 3], 
					[1200, 3] 
					],
					pagination: true,
					navigation: false,
				});
			});
		}
		
		//Featured Product Gallery
		if($('.featured-product-gallery').length>0){
			$('.featured-product-gallery').each(function(){
					$(this).find('.bxslider').bxSlider({
						pagerCustom: $(this).find('.bx-pager'),
						controls:false,
				});
			})
		}
		//Product Gallery
		if($('.product-gallery').length>0){
			$('.product-gallery').each(function(){
					$(this).find('.bxslider').bxSlider({
						pagerCustom: $(this).find('.bx-pager'),
						controls:false,
				});
			});
		}
		$('.product-gallery .bxslider img').on('hover',function(){
			$.removeData($('.product-gallery .bxslider img'), 'elevateZoom');//remove zoom instance from image
			$('.zoomContainer').remove();
			$(this).elevateZoom({
				zoomType: "inner",
				cursor: "crosshair",
				zoomWindowFadeIn: 500,
				zoomWindowFadeOut: 750
			});
		})

		//Product Tab
		$('.title-gal-pro-tab a').on('click',function(event){
			event.preventDefault();
			$(this).parent().siblings().removeClass('active');
			$(this).parent().addClass('active');
			var id=$(this).attr('data-id');
			$(this).parents('.product-tab4').find('.gal-pro-slider').not("#"+id).removeClass('active');
			$("#"+id).addClass('active');
		});

		//Tabs Product Gallery
		if($('.gal-pro-tab').length>0){
			$('.gal-pro-tab').each(function(){
				$(this).find('.bxslider').bxSlider({
					pagerCustom: $(this).find('.bx-pager'),
					controls:false,
					randomStart:true
				});
			})
		}

		//Perfect Banner Slider
		if($('.perfect-banner-slider').length>0){
			$('.perfect-banner-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 1,
					itemsCustom: [ 
					[0, 1], 
					[480, 1], 
					[768, 1], 
					[992, 1], 
					[1200, 1] 
					],
					pagination: true,
					navigation: false,
					autoPlay:true,
				});
			});
		}

		//Slick Slider
		if($('.testimo-slider10').length>0){
			$('.testimo-slider10 .center').each(function(){
				$(this).slick({
				  centerMode: true,
				  centerPadding: '27.5%',
				  prevArrow:'<div class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>',
				  nextArrow:'<div class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>',
				  slidesToShow: 1,
				  responsive: [
					{
					  breakpoint: 768,
					  settings: {
						arrows: false,
						centerMode: false,
						centerPadding: '0px',
						slidesToShow: 1
					  }
					}
				  ]
				});	
			});
		}

		if($('.banner-slider11').length>0){
			$('.banner-slider11 .center').each(function(){
				$(this).slick({
				  centerMode: true,
				  centerPadding: '20%',
				  prevArrow:'<div class="prev"><span>prev</span></div>',
				  nextArrow:'<div class="next"><span>next</span></div>',
				  slidesToShow: 1,
				  responsive: [
					{
					  breakpoint: 768,
					  settings: {
						arrows: false,
						centerMode: false,
						centerPadding: '0px',
						slidesToShow: 1
					  }
					}
				  ]
				});	
			});
		}

		//Latest Slider 6
		if($('.latest-news-slider6').length>0){
			$('.latest-news-slider6').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 3,
					itemsCustom: [ 
					[0, 1], 
					[480, 1], 
					[568, 2], 
					[801, 3], 
					[1200, 3] 
					],
					pagination: false,
					navigation: true,
					navigationText:['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>']
				});
			});
		}

		//Banner Slider 12
		if($('.banner-slider12').length>0){
			$('.banner-slider12').each(function(){
					$(this).find('.bxslider').bxSlider({
						controls:false,
						pager:true,		
						startSlide: 1,
				});
			})
		}

		//Owl Direct Nav
		if($('.owl-default').length>0){
			$('.owl-default').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 1,
					itemsCustom: [ 
					[0, 1], 
					[480, 1], 
					[768, 1], 
					[992, 1], 
					[1200, 1] 
					],
					pagination: false,
					navigation: true,
					addClassActive:true,
					navigationText:['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>']
				});
			});
		}

		//Blog Masonry 
		if($('.list-blog-masonry').length>0){
			$('.list-blog-masonry').find('.content-blog-inner').masonry({
				itemSelector: '.post-item',
			});
		}

		//Banner Slider 2
		if($('.banner-slider2').length>0){
			$('.banner-slider2 .bxslider').bxSlider({
				pagerCustom: '.banner-slider2 .bx-pager',
				controls:false,
				auto:true,
				autoHover:true,
				startSlide: 2,
			});
		}

		//Product detai home 11
		if($('.product-detail11').length>0){
			$('.product-detail11').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 1,
					itemsCustom: [ 
					[0, 1], 
					[480, 1], 
					[768, 1], 
					[992, 1], 
					[1200, 1] 
					],
					pagination: false,
					navigation: true,
					addClassActive:true,
					navigationText:['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>']
				});
			});
		}

		//Collection Slider 18
		if($('.collect-slider18').length>0){
			$('.collect-slider18').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 1,
					itemsCustom: [ 
					[0, 1], 
					[480, 1], 
					[768, 1], 
					[992, 1], 
					[1200, 1] 
					],
					pagination: true,
					navigation: true,
					navigationText:['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>']
				});
				
			});
			//Insert Control
			$('.collect-content18').each(function(){
				$(this).find('.collect-slider18 .owl-controls .owl-pagination').insertBefore($(this).find('.collect-info18 .shopnow'));
			});
		}

		//Advantage Slider widget
		if($('.wg-adv-slider').length>0){
			$('.wg-adv-slider').each(function(){
				$(this).find('.wrap-item').owlCarousel({
					items: 1,
					itemsCustom: [ 
					[0, 1], 
					[480, 2], 
					[768, 1], 
					[992, 1], 
					[1200, 1] 
					],
					pagination: true,
					navigation: false,
					autoPlay:true,
					addClassActive:true,
				});
			});
		}

		// product list thumb fix
		$('.product-listview .product-gallery').each(function(){
			var pager_height = $(this).find('.bx-pager').height();
			$(this).find('.bx-pager').css('margin-top',-(pager_height/2+4));
		})

		if($('.rtl-enable').length > 0){
            $('div[data-vc-full-width="true"]').each(function(){
                var style = $(this).attr('style');
                style = style.replace("left","right");
                $(this).attr('style',style);
            })
        }
        $('.adv-slider18 .owl-item').on('mouseover',function(){
			$(this).siblings().addClass('onhover');
			$(this).removeClass('onhover');
		});
		$('.adv-slider18 .owl-item').on('mouseout',function(){
			$('.adv-slider18 .owl-item').removeClass('onhover');
		});
		
	});

	/************ END LOAD **************/
	var w_width = $(window).width();
	$(window).resize(function(){
		var c_width = $(window).width();
        setTimeout(function() {
            if($('.rtl-enable').length > 0 && c_width != w_width){
                $('div[data-vc-full-width="true"]').each(function(){
                    var style = $(this).attr('style');
                    style = style.replace(" left:"," right:");
                    $(this).attr('style',style);
                })
                w_width = c_width;
            }            
			if(c_width != w_width) fix_position_megamenu();
        }, 3000);
	});

	/************ END RESIZE **************/

	$(window).scroll(function(){

	});

	/************ END SCROLL **************/

})(jQuery);