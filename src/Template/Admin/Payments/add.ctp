<<<<<<< HEAD
=======
<nav class="actions large-2 medium-2 columns" id="actions-sidebar">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin_add');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
>>>>>>> master
<div class="payments form large-10 medium-10 columns content">
    <?= $this->Form->create($payment) ?>
    <fieldset>
        <legend><?= __('Add Payment') ?></legend>
        <?php
            echo $this->Form->input('value');
            echo $this->Form->input('paid');
            echo $this->Form->input('cheque_number');
            echo $this->Form->input('name_on_cheque');
<<<<<<< HEAD
            echo $this->Form->input('invoices._ids', ['options' => $invoices, 'type' => 'select', 'label' => 'Invoice Associated']);
=======
            echo $this->Form->input('invoices._ids', ['options' => $invoices]);
>>>>>>> master
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
