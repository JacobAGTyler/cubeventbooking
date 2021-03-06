<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reservation $reservation
 *
 * @var array $events
 * @var array $users
 * @var array $attendees
 * @var array $reservationStatuses
 */
?>
<div class="row form form-row">
    <div class="col-md-12">
        <?= $this->Form->create($reservation) ?>
        <fieldset>
            <legend><?= __('Edit Reservation') ?></legend>
            <?php
                echo $this->Form->control('event_id', ['options' => $events]);
                echo $this->Form->control('user_id', ['options' => $users]);
                echo $this->Form->control('attendee_id', ['options' => $attendees]);
                echo $this->Form->control('reservation_status_id', ['options' => $reservationStatuses]);
                echo $this->Form->control('expires');
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
