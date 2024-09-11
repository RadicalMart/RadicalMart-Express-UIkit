<?php
/*
 * @package     RadicalMart Uikit Package
 * @subpackage  tpl_radicalmart_express_uikit
 * @version     __DEPLOY_VERSION__
 * @author      RadicalMart Team - radicalmart.ru
 * @copyright   Copyright (c) 2024 RadicalMart. All rights reserved.
 * @license     GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 * @link        https://radicalmart.ru/
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\Component\RadicalMartExpress\Site\Helper\CheckoutHelper;
use Joomla\Component\RadicalMartExpress\Site\Helper\ProductsHelper;

CheckoutHelper::loadAssets();

/** @var object $product */
$product = $displayData;
if (empty($product))
{
	return '';
}
?>
<button class="uk-button uk-button-primary" radicalmart_express-checkout="openWindow" data-product_id="<?php echo $product->id; ?>" disabled>
	<?php echo ProductsHelper::replaceShortcodes(Text::_('COM_RADICALMART_EXPRESS_CHECKOUT_PRODUCT_BUTTON'), $product); ?>
</button>