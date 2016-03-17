<nav class="actions large-2 medium-3 columns" id="actions-sidebar">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/user');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>


<div class="invoices form large-10 medium-9 columns content">
    <?= $this->Form->create($disForm); ?>
    <fieldset>
        <legend><?= __('Enter discount code to apply') ?></legend>
        <?php
            echo $this->Form->input('discount', ['label' => false]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>

</div>