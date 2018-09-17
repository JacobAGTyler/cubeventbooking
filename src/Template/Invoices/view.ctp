<?php

/**
* @var \App\Model\Entity\Invoice $invoice
 */

?>
<div class="row">
    <div class="col-lg-11 col-md-11">
        <h1 class="page-header"><i class="fa fa-file-o fa-fw"></i> Payment Invoice INV #<?= $this->Number->format($invoice->id) ?></h1>
    </div>
    <div class="col-lg-1 col-md-1">
        <br/>
        <div class="pull-right pull-down">
            <div class="btn-group">
                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                    Actions
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="<?php echo $this->Url->build([
                        'controller' => 'Invoices',
                        'action' => 'regenerate',
                        'prefix' => false,
                        $invoice->id],['_full']); ?>">Update Invoice</a>
                    </li>
                    <li><a href="<?php echo $this->Url->build([
		                    'controller' => 'Invoices',
		                    'action' => 'view',
		                    'prefix' => false,
		                    $invoice->id,
		                    '_ext' => 'pdf',
                        ]); ?>"><span><i class="fa fa-file-pdf-o fa-fw"></i> Download</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <br/>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-body">
                <span><?= __('User') ?>: <?= $invoice->has('user') ? $this->Html->link($invoice->user->full_name, ['controller' => 'Users', 'action' => 'view', $invoice->user->id]) : '' ?></span>
                <br/>
                <span><?= __('Application') ?>: <?= $invoice->has('application') ? $this->Html->link($invoice->application->display_code, ['controller' => 'Applications', 'action' => 'view', $invoice->application->id]) : '' ?></span>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-body">
                <span><?= __('Date Created') ?>: <?= h($this->Time->i18nFormat($invoice->created,'dd-MMM-YYYY HH:mm')) ?></span>
                <br/>
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
                    <th><?= __('Payments Received') ?></th>
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
                        </tr>
                        <?php foreach ($invoice->invoice_items as $invoiceItems): ?>
                        <tr>
                            <td><?= h($invoiceItems->description) ?></td>
                            <td><?= h($invoiceItems->quantity) ?></td>
                            <td><?= h($this->number->currency($invoiceItems->value,'GBP')) ?></td>
                            <td><?= h($this->number->currency($invoiceItems->quantity_price,'GBP')) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <p>Deposits for invoices should be made payable to <strong><?= h($invoice->application->event->event_type->payable->text) ?></strong> and sent to <strong><?= h($invoice->application->event->name) ?>, <?= h($invoice->application->event->address) ?>, <?= h($invoice->application->event->city) ?>, <?= h($invoice->application->event->postcode) ?></strong> by <strong><?= $this->Time->i18nformat($invoice->application->event->closing_date,'dd-MMM-yyyy') ?></strong>. Please write <strong><?= h($invoice->application->event->event_type->invoice_text->text) ?><?= $this->Number->format($invoice->id) ?></strong> on the back of the cheque.</p>
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
                <p>Deposits for invoices should be made payable to <strong><?= h($invoice->application->event->event_type->payable->text) ?></strong> and sent to <strong><?= h($invoice->application->event->name) ?>, C/O: <?= h($invoice->application->event->admin_firstname) ?> <?= h($invoice->application->event->admin_lastname) ?> <?= h($invoice->application->event->address) ?>, <?= h($invoice->application->event->city) ?>, <?= h($invoice->application->event->postcode) ?></strong> by <strong><?= $this->Time->i18nformat($invoice->application->event->closing_date,'dd-MMM-yyyy') ?></strong>. Please write <strong><?= h($invoice->application->event->event_type->invoice_text->text) ?><?= $this->Number->format($invoice->id) ?></strong> on the back of the cheque.</p>
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
                <div class="panel-body">
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
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?php if (!empty($invoice->notes)) : ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-pencil-square-o fa-fw"></i> Invoice Notes
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tr>
                                <th><?= __('Id') ?></th>
                                <th><?= __('Note') ?></th>
                                <th><?= __('Last Modified') ?></th>
                            </tr>
                            <?php foreach ($invoice->notes as $notes): ?>
                                <tr>
                                    <td><?= h($notes->id) ?></td>
                                    <td><?= $this->Text->autoParagraph($notes->note_text) ?></td>
                                    <td><?= $this->Time->i18nformat($notes->modified,'dd-MMM-yy HH:mm') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif; ?>     
    </div>
</div>

