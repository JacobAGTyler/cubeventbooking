<?= $this->assign('title', 'Unread Notifications'); ?>
<nav class="actions notifications large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <h3 class="heading"><?= __('Actions') ?></h3>
        <li><?= $this->Html->link(__('List All Notifications'), ['action' => 'index']) ?></li>
    </ul>

    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="notifications index large-10 medium-9 columns content">
    <h3><?= __('Notifications') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('notificationtype_id', 'Type') ?></th>
                <th><?= $this->Paginator->sort('new', 'Read') ?></th>
                <th><?= $this->Paginator->sort('notification_header', 'Header') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody> 
            <?php foreach ($notifications as $notification): ?>
            <tr>
                <td><?= $this->Number->format($notification->id) ?></td>
                <td><?= $notification->has('user') ? $this->Html->link($notification->user->full_name, ['controller' => 'Users', 'action' => 'view', $notification->user->id]) : '' ?></td>
                <td><?= $notification->has('notificationtype') ? $this->Html->link($notification->notificationtype->notification_type, ['controller' => 'Notificationtypes', 'action' => 'view', $notification->notificationtype->id]) : '' ?></td>
                <td><?= $notification->new ? __('No') : __('Yes'); ?></td>
                <td><?= h($notification->notification_header) ?></td>
                <td><?= h($notification->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $notification->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $notification->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $notification->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notification->id)]) ?>
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