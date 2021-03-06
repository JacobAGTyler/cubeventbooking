<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Param'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Logistic Items'), ['controller' => 'LogisticItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Logistic Item'), ['controller' => 'LogisticItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="params index large-9 medium-8 columns content">
    <h3><?= __('Params') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('parameter_id') ?></th>
                <th><?= $this->Paginator->sort('constant') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($params as $param): ?>
            <tr>
                <td><?= $this->Number->format($param->id) ?></td>
                <td><?= $param->has('parameter') ? $this->Html->link($param->parameter->id, ['controller' => 'Parameters', 'action' => 'view', $param->parameter->id]) : '' ?></td>
                <td><?= h($param->constant) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $param->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $param->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $param->id], ['confirm' => __('Are you sure you want to delete # {0}?', $param->id)]) ?>
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
    </div>
</div>
