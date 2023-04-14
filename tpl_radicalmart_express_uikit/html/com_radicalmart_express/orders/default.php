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

\defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;

// Load assets
/** @var Joomla\CMS\WebAsset\WebAssetManager $assets */
$assets = $this->document->getWebAssetManager();
if ($this->params->get('radicalmart_express_js', 1))
{
	$assets->useScript('com_radicalmart_express.site');
}

if ($this->params->get('trigger_js', 1))
{
	$assets->useScript('com_radicalmart_express.site.trigger');
}
?>
<div id="RadicalMartExpress" class="orders">
	<div class="uk-child-width-expand@m uk-grid-medium" uk-grid>
		<div class="uk-width-1-4@m">
			<?php echo LayoutHelper::render('components.radicalmart_express.account.sidebar'); ?>
		</div>
		<div>
			<div class="uk-card uk-card-default uk-card-small">
				<div class="uk-card-header">
					<h1 class="uk-h2">
						<?php echo $this->params->get('seo_orders_h1', Text::_('COM_RADICALMART_EXPRESS_ORDERS')); ?>
					</h1>
				</div>
				<?php if (empty($this->items)): ?>
					<div class="uk-card-body">
						<div class="uk-alert uk-alert-warning">
							<?php echo Text::_('COM_RADICALMART_EXPRESS_ERROR_ORDERS_NOT_FOUND'); ?>
						</div>
					</div>
				<?php else: ?>
					<?php foreach ($this->items as $i => $item):
						if ($i > 0) echo '<hr>' ?>
						<div class="uk-card-body">
							<h2 class="uk-h3">
								<a href="<?php echo $item->link; ?>">
									<span><?php echo $item->title; ?></span>
									<span class="uk-text-muted uk-text-small">
										<?php echo Text::sprintf('COM_RADICALMART_EXPRESS_DATE_FROM',
											HTMLHelper::date($item->created, Text::_('DATE_FORMAT_LC2'))); ?>
									</span>
								</a>
							</h2>
							<table class="uk-table uk-table-small uk-table-justify uk-table-responsive uk-table-divider uk-margin-small-top uk-margin-remove-bottom">
								<tbody>
								<tr>
									<th class="uk-width-medium">
										<?php echo Text::_('COM_RADICALMART_EXPRESS_PRODUCTS'); ?>
									</th>
									<td>
										<?php echo count($item->products); ?>
									</td>
								</tr>
								<?php if ($item->shipping): ?>
									<tr>
										<th class="uk-width-medium">
											<?php echo Text::_('COM_RADICALMART_EXPRESS_SHIPPING'); ?>
										</th>
										<td><?php echo $item->shipping->get('title'); ?></td>
									</tr>
								<?php endif; ?>
								<?php if ($item->payment):?>
									<tr>
										<th class="uk-width-medium">
											<?php echo Text::_('COM_RADICALMART_EXPRESS_PAYMENT'); ?>
										</th>
										<td><?php echo $item->payment->get('title'); ?></td>
									</tr>
								<?php endif; ?>
								<tr>
									<th class="uk-width-medium">
										<?php echo Text::_('COM_RADICALMART_EXPRESS_TOTAL'); ?>
									</th>
									<td>
										<?php echo $item->total['final_string']; ?>
									</td>
								</tr>
								<tr>
									<th class="uk-width-medium">
										<?php echo Text::_('COM_RADICALMART_EXPRESS_ORDER_STATUS'); ?>
									</th>
									<td>
										<?php if ($item->status):
											$class = '';
											if ($item->status->id === 2)
											{
												$class = 'uk-label-success';
											}
											elseif ($item->status->id === 3)
											{
												$class = 'uk-label-danger';
											}
											?>
											<span class="uk-label <?php echo $class; ?>">
												<?php echo $item->status->title; ?>
											</span>
										<?php else: ?>
											<span class="uk-label uk-label-danger">
												<?php echo Text::_('COM_RADICALMART_EXPRESS_ERROR_STATUS_NOT_FOUND'); ?>
											</span>
										<?php endif; ?>
									</td>
								</tr>
								</tbody>
							</table>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>