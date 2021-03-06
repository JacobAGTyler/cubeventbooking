<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="row">
    <div class="col-lg-12">
        <h3><i class="fal fa-ticket fa-fw"></i> Tokens</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('email_send_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('expires') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('utilised') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('active') ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($tokens as $token): ?>
                    <tr>
                        <td><?= $this->Number->format($token->id) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fal fa-eye"></i>', ['action' => 'view', $token->id], ['title' => __('View'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fal fa-pencil"></i>', ['action' => 'edit', $token->id], ['title' => __('Edit'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                            <?= $this->Form->postLink('<i class="fal fa-trash-alt"></i>', ['action' => 'delete', $token->id], ['confirm' => __('Are you sure you want to delete # {0}?', $token->id), 'title' => __('Delete'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                        </td>
                        <td><?= $token->has('user') ? $this->Html->link($token->user->full_name, ['controller' => 'Users', 'action' => 'view', $token->user->id]) : '' ?></td>
                        <td><?= $token->has('email_send') ? $this->Html->link($token->email_send->id, ['controller' => 'EmailSends', 'action' => 'view', $token->email_send->id]) : '' ?></td>
                        <td><?= $this->Time->i18nFormat($token->created,'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                        <td><?= $this->Time->i18nFormat($token->modified,'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                        <td><?= $this->Time->i18nFormat($token->expires,'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                        <td><?= $token->utilised ? '<i class="fal fa-check fa-fw"></i>' : '' ?></td>
                        <td><?= $token->active ? '<i class="fal fa-check fa-fw"></i>' : '' ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
        </div>
    </div>
</div>
