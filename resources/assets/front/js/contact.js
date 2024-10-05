/*
***
***
Name: 			contact.js
Written by: 	ThemeTrades
Theme Version:	1.0.0
***
***
*/

(function($) {

		'use strict';

	var FormFunction = function(){

				var checkSelectorExistence = function(selectorName) {
				  if(jQuery(selectorName).length > 0){return true;}else{return false;}
				};

				/* Email Form Input */
				var validateEmail = function(email)	{
					var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
					if(emailReg.test(email)) {
						return true;
					} else {
						return false;
					}
				}

				/* URL Form Input */
				var validateURL = function(textval) {
					 var urlregex = new RegExp(
						   "^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.){1}([0-9A-Za-z]+\.)");
					 return urlregex.test(textval);
				}

				/* Integer Number Form Input */
				var validateInteger = function(){
					if(!checkSelectorExistence('.int-value')){return;}
					$(".int-value").on('keydown', function (e) {
						// Allow: backspace, delete, tab, escape, enter and .
						if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
							 // Allow: Ctrl+A, Command+A
							(e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) ||
							 // Allow: home, end, left, right, down, up
							(e.keyCode >= 35 && e.keyCode <= 40)) {
								 // let it happen, don't do anything
								 return;
						}
						// Ensure that it is a number and stop the keypress
						if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
							e.preventDefault();
						}
					});
				}

				/* Integer Number Form Input */
				var validateCharacter  = function(){
					if(!checkSelectorExistence('.valid-character')){return;}
					$('.valid-character').keyup(function() {
						if (this.value.match(/[^a-zA-Z ]/g)) {
							this.value = this.value.replace(/[^a-zA-Z ]/g, '');
						}
					});
				}


				var contactForm = function()	{
					if(!checkSelectorExistence('.ajax-form')){return;}
					window.verifyRecaptchaCallback = function (response) {
						$('input[data-recaptcha]').val(response).trigger('change');
					}

					window.expiredRecaptchaCallback = function () {
						$('input[data-recaptcha]').val("").trigger('change');
					}


					 jQuery('.ajax-form').on('submit', function( event ) {
							event.preventDefault();
                         if ($('#error-msg').text() !== '') {
                             $('#phoneNumber').focus();
                             var response = '<div class="err alert alert-danger">Contact number is '  + $("#error-msg").text() +'</div>';
                             $('.ajax-form .ajax-message').html(response).delay(5000).hide('slow');
                             return false;
                         }
                            var grecaptchaResponse = grecaptcha.getResponse();
                            if (grecaptchaResponse.length == 0) {
                                var response =	'<div class="alert alert-danger alert-dismissable">'+ Lang.get('js.google_captcha_required') +'</div>';
                                jQuery(this).find(".ajax-message").html(response).show('slow');
                                $('.ajax-form .ajax-message').html(response).delay(5000).hide('slow');
                                return false;
                            }
							var response		=	'<div class="alert alert-warning alert-dismissable"> '+ Lang.get('js.processing') +'</div>';
							jQuery(this).find(".ajax-message").html(response).show('slow');
							var formData 		= 	new FormData(this);
							var formAction		=	jQuery(this).attr('action');
							jQuery.ajax({
								type: 'POST',
								url: formAction,
								data: formData,
								contentType: false,
								cache: false,
								processData:false,
								dataType: 'json',
								success : function(data)
								{
									if(data.success){
										response = '<div class="gen alert alert-success">'+Lang.get('js.messages_sent')+'</div>';
                                        $('#valid-msg').addClass('hide');
                                    }else{
										response = '<div class="err alert alert-danger">'+data.message+'</div>';
									}
									$('.ajax-form .ajax-message').html(response).delay(5000).hide('slow');
									$('.ajax-form')[0].reset();
									grecaptcha.reset();
								},
								error : function(data){
                                    response = '<div class="err alert alert-danger">'+data.responseJSON.message+'</div>';
                                    $('.ajax-form .ajax-message').html(response).delay(5000).hide('slow');
								},

							});

					});


				}

				// var subscriptionForm = function()	{
				// 	if(!checkSelectorExistence('.subscribe-form')){return;}
				// 	jQuery('.subscribe-form').on('submit', function( event ) {
				// 			event.preventDefault();
				// 			var response		=	'<div class="alert alert-warning alert-dismissable"> Processing.. </div>';
				// 			jQuery(this).find(".ajax-message").html(response).show('slow');
                //
				// 			var formData 		= 	new FormData(this);
				// 			var formAction		=	jQuery(this).attr('action');
                //
				// 			jQuery.ajax({
				// 				type: 'POST',
				// 				url: formAction,
				// 				data: formData,
				// 				contentType: false,
				// 				cache: false,
				// 				processData:false,
				// 				dataType: 'json',
				// 				success : function(data)
				// 				{
				// 					if(data.success){
				// 						response = '<div class="gen alert alert-success">'+data.message+'</div>';
				// 					}else{
				// 						response = '<div class="err alert alert-danger">'+data.message+'</div>';
				// 					}
				// 					$('.subscribe-form .ajax-message').html(response).delay(5000).hide('slow');
				// 					$('.subscribe-form')[0].reset();
				// 				},
				// 				error : function(data){
                //                     response = '<div class="err alert alert-danger">'+data.responseJSON.message+'</div>';
                //                     $('.subscribe-form .ajax-message').html(response).delay(5000).hide('slow');
				// 				},
                //
				// 			});
                //
				// 	});
                //
                //
				// }

				/* Functions Calling */
				return {
					afterLoadThePage:function(){
						contactForm();
						// subscriptionForm();
						validateInteger();
						validateCharacter();
					},
				}

	}(jQuery);

	/* jQuery Window Load */
	jQuery(window).on("load", function (e) {FormFunction.afterLoadThePage();});

})(jQuery);
