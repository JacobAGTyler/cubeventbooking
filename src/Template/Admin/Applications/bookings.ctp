<<<<<<< HEAD
=======
<div class="actions columns large-2 medium-3">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin_index');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</div>
>>>>>>> master
<div class="applications index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
<<<<<<< HEAD
            <th><?= __('Application') ?></th>
            <th><?= __('User') ?></th>
            <th><?= __('Scoutgroup') ?></th>
            <th><?= __('Section') ?></th>
            <th><?= __('permitholder') ?></th>
            <th><?= __('modified') ?></th>
=======
            <th><?= $this->Paginator->sort('Application') ?></th>
            <th><?= $this->Paginator->sort('User') ?></th>
            <th><?= $this->Paginator->sort('Scoutgroup') ?></th>
            <th><?= $this->Paginator->sort('Section') ?></th>
            <th><?= $this->Paginator->sort('permitholder') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
>>>>>>> master
        </tr>
    </thead>
    <tbody>
    <?php foreach ($applications as $application): ?>
        <tr>
            <td><?= h($application->display_code) ?></td>
            <td><?= $application->has('user') ? $this->Html->link($application->user->full_name, ['controller' => 'Users', 'action' => 'view', $application->user->id]) : '' ?></td>
            <td><?= $application->has('scoutgroup') ? $this->Html->link($this->Text->truncate($application->scoutgroup->scoutgroup,18), ['controller' => 'Scoutgroups', 'action' => 'view', $application->scoutgroup->id]) : '' ?></td>
            <td><?= h($application->section) ?></td>
            <td><?= $this->Text->truncate($application->permitholder,18) ?></td>
            <td><?= $this->Time->i18nFormat($application->modified, 'dd-MMM-yy HH:mm') ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $application->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $application->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $application->id], ['confirm' => __('Are you sure you want to delete # {0}?', $application->id)]) ?>
            </td>
        </tr>

<<<<<<< HEAD
        <?php foreach ($applications->has('invoices') as $invoice): ?>
            <tr>
                <td><?= h($invoice->balance) ?></td>
            </tr>

        <?php endforeach; ?>
    <?php endforeach; ?>
    </tbody>
    </table>
=======
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
>>>>>>> master
</div>
