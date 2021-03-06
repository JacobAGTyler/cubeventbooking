<?php
echo $this->element('pdf-head');
// NB: footer must be at the beginning of the file...
echo $this->element('pdf-foot');
 
// here is the body of your content as such
echo $this->Html->tag('h2', $invoice['id']);

?>

<div class="invoices view large-9 medium-8 columns content">
    <h3>Payment Invoice</h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $invoice->has('user') ? $this->Html->link($invoice->user->username, ['controller' => 'Users', 'action' => 'view', $invoice->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($invoice->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Initial Value') ?></th>
            <td><?= $this->Number->currency($invoice->initialvalue,'GBP') ?></td>
        </tr>
        <tr>
            <th><?= __('Payments Recieved') ?></th>
            <td><?= $this->Number->currency($invoice->value,'GBP') ?></td>
        </tr>
        <tr>
            <th><?= __('Balance') ?></th>
            <td><?= $this->Number->currency($invoice->balance,'GBP') ?></td>
        </tr>
        <tr>
            <th><?= __('Date Created') ?></th>
            <td><?= h($this->Time->i18nFormat($invoice->created,'dd-MMM-YY HH:mm', 'Europe/London')) ?></tr>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Invoice Line Items') ?></h4>
        <?php if (!empty($invoice->invoice_items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Value') ?></th>
                <th><?= __('Description') ?></th>
                <th><?= __('Quantity') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($invoice->invoice_items as $invoiceItems): ?>
            <tr>
                <td><?= h($invoiceItems->id) ?></td>
                <td><?= h($this->number->currency($invoiceItems->value,'GBP')) ?></td>
                <td><?= h($invoiceItems->description) ?></td>
                <td><?= h($invoiceItems->quantity) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'InvoiceItems', 'action' => 'view', $invoiceItems->id]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Payments') ?></h4>
        <?php if (!empty($invoice->payments)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Value') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Paid') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($invoice->payments as $payments): ?>
            <tr>
                <td><?= h($payments->id) ?></td>
                <td><?= $this->Number->currency($payments->value,'GBP') ?></td>
                <td><?= $this->Time->i18nFormat($payments->created,'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                <td><?= $this->Time->i18nFormat($payments->paid,'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Payments', 'action' => 'view', $payments->id]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
