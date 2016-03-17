<<<<<<< HEAD
<div class="row">
    <div class="col-lg-6 col-md-6">
        <h1 class="page-header"><i class="fa fa-files-o fa-fw"></i> Payment Invoice INV #<?= $this->Number->format($invoice->id) ?></h1>
    </div>
    <div class="col-lg-6 col-md-6">
        </br>
        <div class="pull-right pull-down">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-warning dropdown-toggle" data-toggle="dropdown">
                    Actions
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="<?php echo $this->Url->build([
                        'controller' => 'Invoices',
                        'action' => 'regenerate',
                        'prefix' => 'admin',
                        $invoice->id],['_full']); ?>">Update Invoice</a>
                    </li>
                </ul>
            </div>
        </div>
        </br>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-body">
                <span><?= __('User') ?>: <?= $invoice->has('user') ? $this->Html->link($invoice->user->full_name, ['controller' => 'Users', 'action' => 'view', $invoice->user->id]) : '' ?></span>
                </br>
                <span><?= __('Application') ?>: <?= $invoice->has('application') ? $this->Html->link($invoice->application->display_code, ['controller' => 'Applications', 'action' => 'view', $invoice->application->id]) : '' ?></span>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-body">
                <span><?= __('Date Created') ?>: <?= h($this->Time->i18nFormat($invoice->created,'dd-MMM-YYYY HH:mm')) ?></span>
                </br>
                <span><?= __('Date Last Modified') ?>: <?= h($this->Time->i18nFormat($invoice->modified,'dd-MMM-YYYY HH:mm')) ?></span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-hover">  
                <tr>
                    <th><?= __('Initial Value') ?></th>
                    <th><?= __('Payments Recieved') ?></th>
                    <th><?= __('Balance') ?></th>          
                </tr>
                <tr>
                    <td><?= $this->Number->currency($invoice->initialvalue,'GBP') ?></td>
                    <td><?= $this->Number->currency($invoice->value,'GBP') ?></td>
                    <td><?= $this->Number->currency($invoice->balance,'GBP') ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<?php if (!empty($invoice->invoice_items)): ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <i class="fa fa-files-o fa-fw"></i> Invoice Line Items
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Quantity') ?></th>
                            <th><?= __('Value') ?></th>
                            <th><?= __('Sum Price') ?></th>
                            <th><?= __('Visible') ?></th>
                        </tr>
                        <?php foreach ($invoice->invoice_items as $invoiceItems): ?>
                        <tr>
                            <td><?= h($invoiceItems->Description) ?></td>
                            <td><?= h($invoiceItems->Quantity) ?></td>
                            <td><?= h($this->number->currency($invoiceItems->Value,'GBP')) ?></td>
                            <td><?= h($this->number->currency($invoiceItems->quantity_price,'GBP')) ?></td>
                            <td><?= $invoiceItems->visible ? __('Yes') : __('No'); ?>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <p>Deposits for invoices should be made payable to <strong><?= h($invPayable) ?></strong> and sent to <strong><?= h($eventName) ?>, <?= h($invAddress) ?>, <?= h($invCity) ?>, <?= h($invPostcode) ?></strong> by <strong><?= $this->Time->i18nformat($invDeadline,'dd-MMM-yyyy') ?></strong>. Please write <strong><?= h($invPrefix) ?><?= $this->Number->format($invoice->id) ?></strong> on the back of the cheque.</p>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if (empty($invoice->invoice_items)): ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-yellow">
            <div class="panel-body">
                <p>Deposits for invoices should be made payable to <strong><?= h($invPayable) ?></strong> and sent to <strong><?= h($eventName) ?>, <?= h($invAddress) ?>, <?= h($invCity) ?>, <?= h($invPostcode) ?></strong> by <strong><?= $this->Time->i18nformat($invDeadline,'dd-MMM-yyyy') ?></strong>. Please write <strong><?= h($invPrefix) ?><?= $this->Number->format($invoice->id) ?></strong> on the back of the cheque.</p>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="row">
    <div class="col-lg-12">
        <?php if (!empty($invoice->payments)): ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-gbp fa-fw"></i> Payments Recieved
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body"><div class="related">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tr>
                                <th><?= __('Id') ?></th>
                                <th><?= __('Value') ?></th>
                                <th><?= __('Created') ?></th>
                                <th><?= __('Paid') ?></th>
                                <th><?= __('Name on Cheque') ?></th>
                            </tr>
                            <?php foreach ($invoice->payments as $payments): ?>
                                <tr>
                                    <td><?= h($payments->id) ?></td>
                                    <td><?= $this->Number->currency($payments->value,'GBP') ?></td>
                                    <td><?= $this->Time->i18nformat($payments->created,'dd-MMM-yy HH:mm') ?></td>
                                    <td><?= $this->Time->i18nformat($payments->paid,'dd-MMM-yy HH:mm') ?></td>
                                    <td><?= h($payments->name_on_cheque) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if (empty($invoice->payments)): ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-gbp fa-fw"></i> Payments received will be listed here.
                </div>
            </div>
        <?php endif; ?>
=======
<nav class="actions large-2 medium-3 columns" id="actions-sidebar">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Index'), ['prefix' => 'admin', 'controller' => 'Invoices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Update Invoice'), ['prefix' => 'admin', 'controller' => 'Invoices', 'action' => 'regenerate',$invoice->id,$invoice->user_id]) ?></li>
    </ul>
    <ul class="side-nav">

        <?= $this->start('Sidebar');
        echo $this->element('Sidebar/admin');
        $this->end(); ?>
        
        <?= $this->fetch('Sidebar') ?>
        
    </ul>
</nav>
<div class="invoices view large-10 medium-9 columns content">
    <h3>Payment Invoice</h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $invoice->has('user') ? $this->Html->link($invoice->user->full_name, ['controller' => 'Users', 'action' => 'view', $invoice->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Invoice ID Number') ?></th>
            <td><?= h($invPrefix) ?><?= $this->Number->format($invoice->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Application') ?></th>
            <td><?= $invoice->has('application') ? $this->Html->link($invoice->application->display_code, ['controller' => 'Applications', 'action' => 'view', $invoice->application->id]) : '' ?></td>
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
            <td><?= h($this->Time->i18nFormat($invoice->created,'dd-MMM-YYYY HH:mm')) ?></tr>
        </tr>
        <tr>
            <th><?= __('Date Last Modified') ?></th>
            <td><?= h($this->Time->i18nFormat($invoice->modified,'dd-MMM-YYYY HH:mm')) ?></tr>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Invoice Line Items') ?></h4>
        <?php if (!empty($invoice->invoice_items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Description') ?></th>
                <th><?= __('Quantity') ?></th>
                <th><?= __('Value') ?></th>
                <th><?= __('Sum Price') ?></th>
                <th><?= __('Visible') ?></th>
            </tr>
            <?php foreach ($invoice->invoice_items as $invoiceItems): ?>
            <tr>
                <td><?= h($invoiceItems->Description) ?></td>
                <td><?= h($invoiceItems->Quantity) ?></td>
                <td><?= h($this->number->currency($invoiceItems->Value,'GBP')) ?></td>
                <td><?= h($this->number->currency($invoiceItems->quantity_price,'GBP')) ?></td>
                <td><?= $invoiceItems->visible ? __('Yes') : __('No'); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
        <div class="warning">

            <p>Deposits for invoices should be made payable to <strong><?= h($invPayable) ?></strong> and sent to <strong><?= h($eventName) ?>, <?= h($invAddress) ?>, <?= h($invCity) ?>, <?= h($invPostcode) ?></strong> by <strong><?= $this->Time->i18nformat($invDeadline,'dd-MMM-YY') ?></strong>. Please write <strong><?= h($invPrefix) ?><?= $this->Number->format($invoice->id) ?></strong> on the back of the cheque.</p>

        </div>
    </div>
    <div class="related">
        <h4><?= __('Payments Recieved') ?></h4>
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
                <td><?= $this->Time->i18nformat($payments->created,'dd-MMM-yy HH:mm') ?></td>
                <td><?= $this->Time->i18nformat($payments->paid,'dd-MMM-yy HH:mm') ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Payments', 'action' => 'view', $payments->id]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
>>>>>>> master
    </div>
</div>
