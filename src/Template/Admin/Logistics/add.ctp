<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Logistics'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Applications'), ['controller' => 'Applications', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Application'), ['controller' => 'Applications', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Logisticstypes'), ['controller' => 'Logisticstypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Logisticstype'), ['controller' => 'Logisticstypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="logistics form large-9 medium-8 columns content">
    <?= $this->Form->create($logistic) ?>
    <fieldset>
        <legend><?= __('Add Logistic') ?></legend>
        <?php
            echo $this->Form->input('application_id', ['options' => $applications, 'empty' => true]);
            echo $this->Form->input('logisticstype_id', ['options' => $logisticstypes, 'empty' => true]);
            echo $this->Form->input('header');
            echo $this->Form->input('text');
            echo $this->Form->input('parameter_id', ['options' => $parameters, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>