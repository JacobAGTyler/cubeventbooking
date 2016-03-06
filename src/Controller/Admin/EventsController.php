<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 */
class EventsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Settings', 'Discounts']
        ];
        $this->set('events', $this->paginate($this->Events));
        $this->set('_serialize', ['events']);
    }

    /**
     * View method
     *
     * @param string|null $id Event id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => ['Settings', 'Discounts', 'Applications']
        ]);
        $this->set('event', $event);
        $this->set('_serialize', ['event']);

        // Get Entities from Registry
        $sets = TableRegistry::get('Settings');
        $dscs = TableRegistry::get('Discounts');

        $now = Time::now();
        $userId = $this->Auth->user('id');

        // Table Entities
        if(isset($event->discount_id)) {
            $discount = $dscs->get($event->discount_id);
        }
        if(isset($event->legaltext_id)) {
            $legal = $sets->get($event->legaltext_id);
        }
        if(isset($event->invtext_id)) {
            $invText = $sets->get($event->invtext_id);
        }

        // Pass to View
        $this->set(compact('users', 'payments', 'discount', 'invText', 'legal'));

        // Set Logo Dimensions
        $setting = $sets->get(7);
        $logoSet = $setting->text;
        $logoHeight = $logoSet;
        $logoWidth = $logoSet / $event->logo_ratio;
        $this->set(compact('logoWidth', 'logoHeight'));
    }

    public function fullView($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => ['Settings', 'Discounts', 'Applications', 'Applications.Users', 'Applications.Scoutgroups']
        ]);
        $this->set('event', $event);
        $this->set('_serialize', ['event']);

        // Get Entities from Registry
        $apps = TableRegistry::get('Applications');
        $invs = TableRegistry::get('Invoices');
        $itms = TableRegistry::get('InvoiceItems');
        $atts = TableRegistry::get('Attendees');
        $sets = TableRegistry::get('Settings');
        $dscs = TableRegistry::get('Discounts');
        $usrs = TableRegistry::get('Users');

        $now = Time::now();
        $userId = $this->Auth->user('id');

        // Table Entities
        $applications = $apps->find('all')->where(['event_id' => $event->id]);
        $invoices = $invs->find('all')->contain(['Applications'])->where(['Applications.event_id' => $event->id]);
        $allInvoices = $invs->find('all')->contain(['Applications'])->where(['Applications.event_id' => $event->id]);
        if(isset($event->discount_id)) {
            $discount = $dscs->get($event->discount_id);
        }
        if(isset($event->legaltext_id)) {
            $legal = $sets->get($event->legaltext_id);
        }
        if(isset($event->invtext_id)) {
            $invText = $sets->get($event->invtext_id);
        }
        if(isset($event->admin_user_id)) {
            $administrator = $usrs->get($event->admin_user_id);
        }

        // Pass to View
        $this->set(compact('applications', 'users', 'payments', 'discount', 'invText', 'legal', 'administrator'));
        $this->set('invoices', $allInvoices);

        // Counts of Entities
        $cntApplications = $applications->count('*');
        $cntInvoices = $invoices->count('*');

        $this->set(compact('cntApplications', 'cntInvoices'));

        if ($cntInvoices < 1)
        {
        	$sumValues = 0;
        	$sumPayments = 0;
        	$sumBalances = 0;

        	$invCubs = 0;
        	$invYls = 0;
        	$invLeaders = 0;
        } else {
        	// Sum Values & Calculate Balances
        	$sumValueItem = $invoices->select(['sum' => $invoices->func()->sum('initialvalue')])->group('Applications.event_id')->first();
        	$sumPaymentItem = $invoices->select(['sum' => $invoices->func()->sum('value')])->group('Applications.event_id')->first();

            $sumValues = $sumValueItem->sum;
            $sumPayments = $sumPaymentItem->sum;

        	$sumBalances = $sumValues - $sumPayments;

        	// Count of Line Items
        	$invItemCounts = $itms->find('all')->contain(['Invoices.Applications'])->where(['Applications.event_id' => $event->id])->select(['sum' => $invoices->func()->sum('Quantity')])->group('itemtype_id')->toArray();

        	$invCubs = $invItemCounts[1]->sum;
        	$invYls = $invItemCounts[2]->sum;
        	$invLeaders = $invItemCounts[3]->sum;  
        }

        $this->set(compact('sumValues', 'sumBalances', 'sumPayments'));
        $this->set(compact('invCubs', 'invYls', 'invLeaders'));

        if ($cntApplications < 1)
        {
        	$appCubs = 0;
        	$appYls = 0;
        	$appLeaders = 0;
        } else
        {
        	// Set Attendee Counts
	        $attendeeCubCount = $apps->find('all')
	            ->hydrate(false)
	            ->join([
	                'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id',],
	                't' => ['table' => 'attendees','type' => 'INNER','conditions' => 't.id = x.attendee_id',],
	                'r' => ['table' => 'roles','type' => 'INNER','conditions' => 'r.id = t.role_id']
	            ])->where(['r.minor' => 1, 't.role_id' => 1, 'Applications.event_id' => $id]);

	        $attendeeYlCount = $apps->find('all')
	            ->hydrate(false)
	            ->join([
	                'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id',],
	                't' => ['table' => 'attendees','type' => 'INNER','conditions' => 't.id = x.attendee_id',],
	                'r' => ['table' => 'roles','type' => 'INNER','conditions' => 'r.id = t.role_id']
	            ])->where(['r.minor' => 1, 't.role_id <>' => 1, 'Applications.event_id' => $id]);

	        $attendeeLeaderCount = $apps->find('all')
	            ->hydrate(false)
	            ->join([
	                'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id',],
	                't' => ['table' => 'attendees','type' => 'INNER','conditions' => 't.id = x.attendee_id',],
	                'r' => ['table' => 'roles','type' => 'INNER','conditions' => 'r.id = t.role_id']
	            ])->where(['r.minor' => 0, 'Applications.event_id' => $id]);

	        // Count of Attendees
	        $appCubs = $attendeeCubCount->count('*');
	        $appYls = $attendeeYlCount->count('*');
	        $appLeaders = $attendeeLeaderCount->count('*');
	    }

        $this->set(compact('appCubs', 'appYls', 'appLeaders'));

        // Set Logo Dimensions
        $setting = $sets->get(7);
        $logoSet = $setting->text;
        $logoHeight = $logoSet;
        $logoWidth = $logoSet / $event->logo_ratio;
        $this->set(compact('logoWidth', 'logoHeight'));

    }

    public function regList($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => ['Settings'
            , 'Discounts'
            , 'Applications'
                , 'Applications.Invoices'
                ,'Applications.Attendees']
        ]);
        $this->set('event', $event);
        $this->set('_serialize', ['event']);

        // Get Entities from Registry
        $sets = TableRegistry::get('Settings');
        $dscs = TableRegistry::get('Discounts');

        $now = Time::now();
        $userId = $this->Auth->user('id');

        // Table Entities
        if(isset($event->discount_id)) {
            $discount = $dscs->get($event->discount_id);
        }
        if(isset($event->legaltext_id)) {
            $legal = $sets->get($event->legaltext_id);
        }
        if(isset($event->invtext_id)) {
            $invText = $sets->get($event->invtext_id);
        }

        // Pass to View
        $this->set(compact('users', 'payments', 'discount', 'invText', 'legal'));

        // Set Logo Dimensions
        $setting = $sets->get(7);
        $logoSet = $setting->text;
        $logoHeight = $logoSet;
        $logoWidth = $logoSet / $event->logo_ratio;
        $this->set(compact('logoWidth', 'logoHeight'));
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $event = $this->Events->newEntity();
        if ($this->request->is('post')) {
            $event = $this->Events->patchEntity($event, $this->request->data);
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }
        $inv = $this->Events->Settings->find('list', ['limit' => 200, 'conditions' => ['settingtype_id' => 4]]);
        $legal = $this->Events->Settings->find('list', ['limit' => 200, 'conditions' => ['settingtype_id' => 3]]);
        $discounts = $this->Events->Discounts->find('list', ['limit' => 200]);
        $users = $this->Events->Users->find('list', ['limit' => 200, 'conditions' => ['authrole' => 'admin']]);
        $this->set(compact('event', 'inv', 'legal', 'discounts', 'users'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Event id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => ['Settings']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->data);
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }
        $inv = $this->Events->Settings->find('list', ['limit' => 200, 'conditions' => ['settingtype_id' => 4]]);
        $legal = $this->Events->Settings->find('list', ['limit' => 200, 'conditions' => ['settingtype_id' => 3]]);
        $discounts = $this->Events->Discounts->find('list', ['limit' => 200]);
        $users = $this->Events->Users->find('list', ['limit' => 200, 'conditions' => ['authrole' => 'admin']]);
        $this->set(compact('event', 'inv', 'legal', 'discounts', 'users'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Event id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
            $this->Flash->success(__('The event has been deleted.'));
        } else {
            $this->Flash->error(__('The event could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}