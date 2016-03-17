

<div class="champions form large-9 medium-8 columns content">
    <?= $this->Form->create($champion) ?>
    <fieldset>
        <legend><?= __('Add Champion') ?></legend>
        <?php
            echo $this->Form->input('district_id', ['options' => $districts]);
            echo $this->Form->input('user_id',['options' => $users, 'empty' => true]);
            echo $this->Form->input('firstname');
            echo $this->Form->input('lastname');
            echo $this->Form->input('email');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
