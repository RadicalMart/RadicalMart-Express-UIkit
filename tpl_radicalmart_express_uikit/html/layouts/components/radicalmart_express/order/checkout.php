<?php
/*
 * @package     RadicalMart Uikit Package
 * @subpackage  tpl_radicalmart_express_uikit
 * @version     3.0.0
 * @author      RadicalMart Team - radicalmart.ru
 * @copyright   Copyright (c) 2024 RadicalMart. All rights reserved.
 * @license     GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 * @link        https://radicalmart.ru/
 */

defined('_JEXEC') or die;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Form\Form;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\Component\RadicalMartExpress\Site\Helper\ProductsHelper;

extract($displayData);

/**
 * Layout variables
 * -----------------
 *
 * @var  object $product The product object.
 * @var  Form   $form    The form object.
 *
 */

$params = ComponentHelper::getParams('com_radicalmart_express');
$title  = $params->get('display_checkout_title', 'COM_RADICALMART_EXPRESS_DISPLAY_CHECKOUT_TITLE');
$title  = ProductsHelper::replaceShortcodes(Text::_($title), $product);
?>

<div id="RadicalMartExpressCheckoutModal"
	 style="position: fixed; left: 0; top: 0; bottom: 0; right: 0; background: rgba(0,0,0,0.6); display: flex; align-items: center; justify-content: center; z-index: 999">
	<div id="RadicalMartExpressCheckoutModalInner" style="display: inline-block; max-width: 500px; max-height: 90vh; background: #fff; overflow-y: auto;
position: relative; padding: 25px;">
		<h3><?php echo $title; ?></h3>
		<?php echo LayoutHelper::render('components.radicalmart_express.order.checkout.form', $displayData); ?>
		<a onclick="closeCheckoutModal()" title="<?php echo Text::_('COM_RADICALMART_EXPRESS_CLOSE'); ?>"
		   style="position: absolute; top: 5px; right: 5px; color: #ccc; cursor: pointer;">
			<svg height="16" viewBox="0 0 512 512" width="16" xmlns="http://www.w3.org/2000/svg">
				<path d="M256 0C114.836 0 0 114.836 0 256s114.836 256 256 256 256-114.836 256-256S397.164 0 256 0zm0 0"
					  fill="silver"></path>
				<path d="M350.273 320.105c8.34 8.344 8.34 21.825 0 30.168a21.275 21.275 0 01-15.086 6.25c-5.46 0-10.921-2.09-15.082-6.25L256 286.164l-64.105 64.11a21.273 21.273 0 01-15.083 6.25 21.275 21.275 0 01-15.085-6.25c-8.34-8.344-8.34-21.825 0-30.169L225.836 256l-64.11-64.105c-8.34-8.344-8.34-21.825 0-30.168 8.344-8.34 21.825-8.34 30.169 0L256 225.836l64.105-64.11c8.344-8.34 21.825-8.34 30.168 0 8.34 8.344 8.34 21.825 0 30.169L286.164 256zm0 0"
					  fill="#fafafa"></path>
			</svg>
		</a>
	</div>
</div>
<script>
	function closeCheckoutModal() {
		document.querySelector('#RadicalMartExpressCheckoutModal').style.display = 'none';
	}
</script>