<<<<<<< HEAD
<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-files-o fa-fw"></i> Your Invoices</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id','Invoice Number') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                        <th><?= $this->Paginator->sort('user_id', 'User ID') ?></th>
                        <th><?= $this->Paginator->sort('initialvalue', 'Total Invoice Value') ?></th>
                        <th><?= $this->Paginator->sort('value', 'Payments Received') ?></th>
                        <th><?= $this->Paginator->sort('Balance') ?></th>
                        <th><?= $this->Paginator->sort('created', 'Date Created') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($invoices as $invoice): ?>
                    <tr>
                        <td>Invoice #<?= $this->Number->format($invoice->id) ?></td>
                        <td class="actions">
                            <div class="dropdown btn-group">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-gear"></i>  <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu " role="menu">
                                    <li><?= $this->Html->link(__('View'), ['controller' => 'Invoices', 'action' => 'view', $invoice->id]) ?></li>
                                    <li><?= $this->Html->link(__('Update'), ['controller' => 'Invoices', 'action' => 'regenerate', $invoice->id]) ?></li>
                                </ul>
                            </div>
                        </td>
                        <td><?= $invoice->has('user') ? $this->Html->link($this->Text->truncate($invoice->user->username,18), ['controller' => 'Users', 'action' => 'view', $invoice->user->id]) : '' ?></td>
                        <td><?= $this->Number->currency($invoice->initialvalue,'GBP') ?></td>
                        <td><?= $this->Number->currency($invoice->value,'GBP') ?></td>
                        <td><?= $this->Number->currency($invoice->balance,'GBP') ?></td>
                        <td><?= $this->Time->i18nformat($invoice->created,'dd-MMM-yy HH:mm') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-sm-6">
                    <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">
                        Showing page <?= $this->Paginator->counter() ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="dataTables_paginate paginatior paging_simple_numbers" id="dataTables-example_paginate">
                        <ul class="pagination">
                            <?= $this->Paginator->prev(__('Previous')) ?>
                            <?= $this->Paginator->numbers() ?>
                            <?= $this->Paginator->next(__('Next')) ?>
                        </ul>
                    </div>
                </div>
            </div>
            <hr>
        </div>
=======
<nav class="actions large-2 medium-3 columns" id="actions-sidebar">

<?= $this->start('Sidebar');
echo $this->element('Sidebar/start');
echo $this->element('Sidebar/user');
echo $this->element('Sidebar/end');
$this->end(); ?>

<?= $this->fetch('Sidebar') ?>

</nav>
<div class="invoices index large-10 medium-9 columns content">
    <h3><?= __('Payment Invoices') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id','Invoice Number') ?></th>
                <th><?= $this->Paginator->sort('user_id', 'User ID') ?></th>
                <th><?= $this->Paginator->sort('initialvalue', 'Total Invoice Value') ?></th>
                <th><?= $this->Paginator->sort('value', 'Payments Received') ?></th>
                <th><?= $this->Paginator->sort('Balance') ?></th>
                <th><?= $this->Paginator->sort('created', 'Date Created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($invoices as $invoice): ?>
            <tr>
                <td>Invoice #<?= $this->Number->format($invoice->id) ?></td>
                <td><?= $invoice->has('user') ? $this->Html->link($this->Text->truncate($invoice->user->username,18), ['controller' => 'Users', 'action' => 'view', $invoice->user->id]) : '' ?></td>
                <td><?= $this->Number->currency($invoice->initialvalue,'GBP') ?></td>
                <td><?= $this->Number->currency($invoice->value,'GBP') ?></td>
                <td><?= $this->Number->currency($invoice->balance,'GBP') ?></td>
                <td><?= $this->Time->i18nformat($invoice->created,'dd-MMM-yy HH:mm') ?></td>

                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Invoices', 'action' => 'view', $invoice->id]) ?>
                    <?= $this->Html->link(__('Update'), ['controller' => 'Invoices', 'action' => 'regenerate', $invoice->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
>>>>>>> master
    </div>
</div>
