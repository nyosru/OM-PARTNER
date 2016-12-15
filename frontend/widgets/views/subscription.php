<style>
	.subscription-popup {
		background: #fff;
		border-radius: 5px;
		bottom: 0;
		box-shadow: 0 0;
		display: none;
		opacity: 0;
		padding: 42px;
		position: fixed;
		right: 20px;
		-webkit-transform: translateY(100%);
		-ms-transform: translateY(100%);
		transform: translateY(100%);
		transition: .2s ease;
		width: 400px;
		z-index: 1000;
	}

	.subscription-popup.is-opened {
		bottom: 20px;
		box-shadow: 0 0 8px 0 rgba(0, 0, 0, .1);
		opacity: 1;
		-webkit-transform: translateY(0);
		-ms-transform: translateY(0);
		transform: translateY(0);
	}

	.subscription-popup:before,
	.subscription-popup:after {
		bottom: 0;
		content: "";
		display: block;
		height: 14px;
		position: absolute;
	}

	.subscription-popup:before {
		background: #00a5a2;
		border-bottom-left-radius: 5px;
		left: 0;
		width: 67.5%;
	}

	.subscription-popup:after {
		background: #e9516c;
		border-bottom-right-radius: 5px;
		right: 0;
		width: 30.75%;
	}

	.subscription-popup .close-btn {
		background-color: transparent;
		display: block;
		border: 0;
		padding: 0;
		position: absolute;
		right: 14px;
		top: 14px;
	}

	.subscription-popup .logo {
		padding: 0;
		text-align: center;
	}

	.subscription-popup .info {
		padding: 20px 0;
		text-align: center;
	}

	.subscription-popup .errors,
	.subscription-popup .error {
		color: #f00;
	}

	.subscription-popup .subpro_clear {
		padding-bottom: 15px;
	}

	.subscription-popup input {
		border: 1px solid #e0e0e0;
		border-radius: 2px;
		outline: 0;
		padding: 5px;
		width: 100%;
	}

	.subscription-popup input:focus {
		border-color: #a1a1a1;
	}

	.subscription-popup [type="submit"] {
		background: #4a90e2;
		border: 0;
		border-radius: 2px;
		color: #fff;
		padding: 10px 0;
		width: 100%;
	}

	.subscription-popup [type="submit"]:disabled {
		background: #bcbcbc;
	}
</style>

<div class="subscription-popup">
	<button class="close-btn" onclick="$(this).closest('.subscription-popup').removeClass('is-opened');"><i class="fa fa-times" aria-hidden="true"></i></button>
	<div class="content">
		<div class="logo">
			<img src="/images/logo/OM_logo.png" alt="Одежда-Мастер">
		</div>
		<div class="info">
			ПОДПИШИТЕСЬ<br>
			на рассылку Одежда-Мастер<br>
			и Вы будете в курсе новинок каталога.<br>
			А также Вас ждут специальные<br>
			скидки и бонусы только для подписчиков!
		</div>
		<div class="errors"></div>

		<?php echo $form; ?>
	</div>
</div>

<script>
	var $sc = $('.subscription-popup');

	setTimeout(function () {
		$sc.addClass('is-opened');
	}, 2000);

	$sc.find('form').on('submit', function (e) {
		e.preventDefault();

		$.ajax({
			url: $(this).attr('action'),
			method: $(this).attr('method'),
			dataType: 'json',
			data: $(this).serialize(),
			beforeSend: function () {
				$sc.find('form [type=submit]').attr('disabled', 'disabled');
			}
		})
			.done(function (data) {
				if (data.response === 1) {
					$sc.find('form').remove();
					$sc.find('.errors').remove();
					$sc.find('.info').html('Спасибо!<br>Ваш запрос успешно отправлен.');
				} else {
					var errors = '<p>К сожалению возникли некоторые ошибки. Пожалуйста, исправьте их и мы продолжим.</p>';
					$sc.find('.error').remove();

					for(var name in data.errors)
						for(var errorKey in data.errors[name])
							$sc.find('[name="' + name + '"]').after( $('<small>').addClass('error').text(data.errors[name][errorKey] ));

					$sc.find('.errors').html(errors);
				}
			})
			.fail(function () {
				$sc.find('.errors').html('К сожалению возникли непредвиденные ошибки. Попробуйте, пожалуйста, еще раз.')
			})
			.always(function () {
				$sc.find('form [type=submit]').removeAttr('disabled');
			});
	});
</script>