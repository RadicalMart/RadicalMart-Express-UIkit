<?php
/*
 * @package     RadicalMart Uikit Package
 * @subpackage  tpl_radicalmart_express_uikit
 * @version     1.0.0
 * @author      Delo Design - delo-design.ru
 * @copyright   Copyright (c) 2023 Delo Design. All rights reserved.
 * @license     GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 * @link        https://delo-design.ru/
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