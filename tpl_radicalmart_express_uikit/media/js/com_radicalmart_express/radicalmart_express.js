/*
 * @package     RadicalMart Uikit Package
 * @subpackage  tpl_radicalmart_express_uikit
 * @version     __DEPLOY_VERSION__
 * @author      Delo Design - delo-design.ru
 * @copyright   Copyright (c) 2023 Delo Design. All rights reserved.
 * @license     GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 * @link        https://delo-design.ru/
 */

document.addEventListener('DOMContentLoaded', function () {
	let config = {
		checkout: {
			openWindowButtonsLock: true,
			windowShow: true,
			errorsShow: true,
			formErrorsShow: true
		}
	};

	window.RadicalMartExpressDisplay = config;
	document.dispatchEvent(new CustomEvent('onRadicalMartExpressDisplayAfterSetConfig', {detail: config}));
});


document.addEventListener('onRadicalMartExpressCheckoutBeforeOpenWindow', function (event) {
	if (RadicalMartExpressDisplay.checkout.openWindowButtonsLock) {
		document.querySelectorAll('[radicalmart_express-checkout="openWindow"], [data-radicalmart_express-checkout="openWindow"]')
			.forEach(function (button) {
				button.setAttribute('disabled', '');
			});
	}
});

document.addEventListener('onRadicalMartExpressCheckoutAfterOpenForm', function (event) {
	if (RadicalMartExpressDisplay.checkout.windowShow) {
		if (event.detail) {
			UIkit.modal(document.querySelector('#RadicalMartExpressCheckoutModal')).show();
		}
	}

	if (RadicalMartExpressDisplay.checkout.openWindowButtonsLock) {
		document.querySelectorAll('[radicalmart_express-checkout="openWindow"], [data-radicalmart_express-checkout="openWindow"]')
			.forEach(function (button) {
				button.removeAttribute('disabled');
			});
	}
});

document.addEventListener('onRadicalMartExpressCheckoutError', function (event) {
	if (RadicalMartExpressDisplay.checkout.errorsShow) {
		if (event.detail) {
			UIkit.notification(event.detail, {status: 'danger'})
		}
	}

	if (RadicalMartExpressDisplay.checkout.openWindowButtonsLock) {
		document.querySelectorAll('[radicalmart_express-checkout="openWindow"], [data-radicalmart_express-checkout="openWindow"]')
			.forEach(function (button) {
				button.removeAttribute('disabled');
			});
	}
});

document.addEventListener('onRadicalMartExpressCheckoutFormError', function (event) {
	if (RadicalMartExpressDisplay.checkout.formErrorsShow) {
		if (event.detail && event.detail.messages) {
			event.detail.messages.forEach(function (message) {
				UIkit.notification(message, {status: 'danger'})
			})
		}
	}
});