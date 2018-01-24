<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-bell-o fa-fw"></i> All Notifications</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                        <th><?= $this->Paginator->sort('new', 'Read') ?></th>
                        <th><?= $this->Paginator->sort('notification_type_id', 'Type') ?></th>
                        <th><?= $this->Paginator->sort('user_id', 'User') ?></th>
                        <th><?= $this->Paginator->sort('created') ?></th>
                    </tr>
                </thead>
                <tbody> 
                    <?php foreach ($notifications as $notification): ?>
                        <tr <?= $notification->new ? __('class="info"') : __(''); ?>>
                            <td><?= $this->Number->format($notification->id) ?></td>
                            <td class="actions">
                                <div class="dropdown btn-group">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-gear"></i>  <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu " role="menu">
                                        <li><?= $this->Html->link(__('View'), ['controller' => 'Notifications', 'prefix' => 'admin', 'action' => 'view', $notification->id]) ?></li>
                                        <li><?= $this->Html->link(__('Edit'), ['controller' => 'Notifications', 'prefix' => 'admin', 'action' => 'edit', $notification->id]) ?></li>
                                        <li><?= $this->Form->postLink(__('Delete'), ['controller' => 'Notifications', 'prefix' => 'admin', 'action' => 'delete', $notification->id], ['confirm' => __('Are you sure you want to delete notification # {0}?', $notification->id)]) ?></li>
                                    </ul>
                                </div>
                            </td>
                            <td><?= $notification->new ? __('No') : __('Yes'); ?></td>
                            <td><?= $notification->has('notificationtype') ? h($notification->notificationtype->notification_type) : '' ?></td>
                            <td><?= $notification->has('user') ? $this->Html->link($this->Text->truncate($notification->user->full_name,20), ['prefix' => 'admin', 'controller' => 'Users', 'action' => 'view', $notification->user_id]) : '' ?></td>
                            <td><?= h($notification->created) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
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
    </div>
</div>
