$('document').ready(function(){

	

		$('#user-form').on('click','.user-login-btn',function(){


			var email = $('#email').val();
			var password = $('#password').val();

			var btn = $(this);
			
			$.ajax({

				url : ajax_url+'login/login',
				type: 'POST',
				data : {email:email,password:password},
				beforeSend : function() {

					btn.attr('disabled','disabled');
					btn.val('wait..');
					$('.form-error').hide();
					$('.form-error').html('');
				},
		error : function(jqXHR,exception) {
				console.log(jqXHR.responseText);
				var msg = '';
		        if (jqXHR.status === 0) {
		            msg = 'Not connect.\n Verify Network.';
		        } else if (jqXHR.status == 404) {
		            msg = 'Requested page not found. [404]';
		        } else if (jqXHR.status == 500) {
		            msg = 'Internal Server Error [500].';
		        } else if (exception === 'parsererror') {
		            msg = 'Requested JSON parse failed.';
		        } else if (exception === 'timeout') {
		            msg = 'Time out error.';
		        } else if (exception === 'abort') {
		            msg = 'Ajax request aborted.';
		        } else {
		            msg = 'Uncaught Error.\n' + jqXHR.responseText;
		        }
		        alert(msg);
			},
				success : function(html) {	

					console.log(html);

					btn.removeAttr('disabled');
					btn.val('Login');
					var data = $.parseJSON(html);

					if (data.status=='success') {

						window.location = ajax_url+'market';

					} else {

						$('.form-error').show();

						$('.form-error').html(data.error);

					}
				}

			});


			return false;
		});

	

	$('#submit-otp').on('click',function(){

		var otp = $('#one-time-otp').val();
		var btn = $(this);


		if (otp=='') {

			$('.otp-error').html('Please enter the OTP');
			return false;
		}

		$.ajax({

			type : 'POST',
			url : ajax_url+"login/check_otp",
			data :{otp:otp},
			beforeSend : function() {
				btn.val('wait...');
				btn.attr('disabled','disabled');
			},
		error : function(jqXHR,exception) {
				console.log(jqXHR.responseText);
				var msg = '';
		        if (jqXHR.status === 0) {
		            msg = 'Not connect.\n Verify Network.';
		        } else if (jqXHR.status == 404) {
		            msg = 'Requested page not found. [404]';
		        } else if (jqXHR.status == 500) {
		            msg = 'Internal Server Error [500].';
		        } else if (exception === 'parsererror') {
		            msg = 'Requested JSON parse failed.';
		        } else if (exception === 'timeout') {
		            msg = 'Time out error.';
		        } else if (exception === 'abort') {
		            msg = 'Ajax request aborted.';
		        } else {
		            msg = 'Uncaught Error.\n' + jqXHR.responseText;
		        }
		        alert(msg);
			},
			success : function(html) {
				btn.val('Submit');
				console.log(html);
				btn.removeAttr('disabled');

				if (html=='success') {

					window.location = ajax_url+'market';

				} else {

					$('.otp-error').html('Incorrect OTP');

				}
			}
		});

		return false;
	});


	$('#create-account').on('click',function(){

		var btn = $(this);


		var form = $('.user-signup-form');

		var form_data = form.serialize();

		console.log(form_data);


		$.ajax({

			type : 'POST',
			url  : ajax_url+'signup/create_user',
			data : form_data,
			beforeSend : function() {
				btn.attr('disabled','disabled');
				btn.html('Please Wait...');
				
				$('.error').hide();
			},
		error : function(jqXHR,exception) {
				console.log(jqXHR.responseText);
				var msg = '';
		        if (jqXHR.status === 0) {
		            msg = 'Not connect.\n Verify Network.';
		        } else if (jqXHR.status == 404) {
		            msg = 'Requested page not found. [404]';
		        } else if (jqXHR.status == 500) {
		            msg = 'Internal Server Error [500].';
		        } else if (exception === 'parsererror') {
		            msg = 'Requested JSON parse failed.';
		        } else if (exception === 'timeout') {
		            msg = 'Time out error.';
		        } else if (exception === 'abort') {
		            msg = 'Ajax request aborted.';
		        } else {
		            msg = 'Uncaught Error.\n' + jqXHR.responseText;
		        }
		        alert(msg);
			},
			success : function(html) {

				$('.error').show();

				console.log(html);

				btn.removeAttr('disabled');
				btn.html('Create Account');
				
				var data = $.parseJSON(html);

				if (data.status=='false') {

					$('.name-error').html(data.name);	
					$('.email-error').html(data.email);	
					$('.phone-error').html(data.phone);	
					$('.password-error').html(data.password);	
					$('.retype-error').html(data.retype);	
					$('.country-error').html(data.country);	
					

				} else {

					window.location = ajax_url+'signup/verify_otp';
				}

			}
		});
		return false;


	});

	var actionRow = $('#actionRow');
	$('.deposit').on('click',function(){
		$('#crypto-qrcode').html('');
		$('#crypto-qrcode').hide();

		var deposit = $(this);
		var crypto = deposit.attr('data-crypto');
		var crypto_address = deposit.attr('data-cryptoAddress');

		var parent_row = deposit.closest("tr");

		$('.currencyName').html(crypto);
		$('#action_depositAddress').html(crypto_address);

		parent_row.after(actionRow);

		  var qrcode = new QRCode("crypto-qrcode",{
              text: crypto_address,
              width: 156,
              height: 156,
              colorDark : "#000000",
              colorLight : "#ffffff",
              correctLevel : QRCode.CorrectLevel.H
          });

		actionRow.slideDown();

		// alert(parent_row.attr('id'));

	});

	$('.matchlink.qrcode_link').on('click',function(){

		$('#crypto-qrcode').slideDown();


	});


	var pick = [0,1,2,3,4];
	var coins = ['bitcoin','litecoin','ethereum','ripple','dash'];
	get_coins(ajax_url+'home/get_coins','bitcoin');
	get_coins(ajax_url+'home/get_coins','litecoin');
	get_coins(ajax_url+'home/get_coins','ethereum');
	get_coins(ajax_url+'home/get_coins','ripple');
	get_coins(ajax_url+'home/get_coins','dash');





	// console.log(coins[number]);

	setInterval(function(){

		var number = parseInt(Math.random()*10) % 5;
		get_coins(ajax_url+'home/get_coins',coins[number]);
	
	},5000);



	$('.crypto-trading').on('click','tr',function(){

		var row = $(this);
		var table  = row.closest('table');
		var pair = row.attr('data-pair');

		table.find('tr').removeClass('selected');
		row.addClass('selected');

		$.ajax({

			url : ajax_url+'home/set_coin_session',
			type : 'GET',
			data : {pair:pair},
			success  : function(html) {

				console.log(html);

			}

		});

		// $('.crypto-trading tr').removeClass('selected')
	});


	refresh_trading(ajax_url+'home/refresh_trading','bitcoin','.btc-pair');
	refresh_trading(ajax_url+'home/refresh_trading','litecoin','.ltc-pair');
	// refresh_trading(ajax_url+'home/refresh_trading','blackdiamondcoin','.bdc-pair');
	refresh_trading(ajax_url+'home/usd_price','usd','.usd-pair');
});



function get_coins(ajax_url,coin){


	$.ajax({

		url : ajax_url, 
		type : 'GET',
		data: {coin:coin},

		beforeSend:  function(){

			$('div.'+coin+'-coin .ajax-loader').show();

		},
		success : function(html){

			// console.log(html);
			
			$('div.'+coin+'-coin .ajax-loader').hide();
			// $('div.'+coin+' .ajax-loader').hide();
		var data = $.parseJSON(html);

		if (data.status=='success') {
				
				$('div.'+coin+'-coin .uk-margin-remove-top').html('$'+data.usd_price+data.icon);

		} else {

			   $('.error-msg').html('Crypto market data not available');

		}
	}

	});
}


function refresh_trading(ajax_url,coin,table_class){


	$.ajax({

		url : ajax_url, 
		type : 'GET',
		data: {coin,coin},

		beforeSend:  function(){

			// $('div.'+coin+'-coin .ajax-loader').show();

		},
		error : function(jqXHR,exception) {
				console.log(jqXHR.responseText);
				var msg = '';
		        if (jqXHR.status === 0) {
		            msg = 'Not connect.\n Verify Network.';
		        } else if (jqXHR.status == 404) {
		            msg = 'Requested page not found. [404]';
		        } else if (jqXHR.status == 500) {
		            msg = 'Internal Server Error [500].';
		        } else if (exception === 'parsererror') {
		            msg = 'Requested JSON parse failed.';
		        } else if (exception === 'timeout') {
		            msg = 'Time out error.';
		        } else if (exception === 'abort') {
		            msg = 'Ajax request aborted.';
		        } else {
		            msg = 'Uncaught Error.\n' + jqXHR.responseText;
		        }
		        alert(msg);
			},
		success : function(html){

			console.log(html);
			
			// $('div.'+coin+'-coin .ajax-loader').hide();
			// $('div.'+coin+' .ajax-loader').hide();
		var data = $.parseJSON(html);

		if (data.status=='success') {
				
				$(table_class+' tbody').html(data.result);

		
		} else {

			   $('.error-msg').html('Crypto market data error');

		}
	}

	});
}




