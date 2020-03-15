<?php
declare(strict_types=1);

namespace App\Controller\Admin;

/**
 * Prices Controller
 *
 * @property \App\Model\Table\PricesTable $Prices
 */
class PricesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ItemTypes', 'Events'],
        ];
        $prices = $this->paginate($this->Prices);

        $this->set(compact('prices'));
        $this->set('_serialize', ['prices']);
    }

    /**
     * View method
     *
     * @param string|null $id Price id.
     *
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $price = $this->Prices->get($id, [
            'contain' => ['ItemTypes', 'Events'],
        ]);

        $this->set('price', $price);
        $this->set('_serialize', ['price']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $price = $this->Prices->newEntity();
        if ($this->request->is('post')) {
            $price = $this->Prices->patchEntity($price, $this->request->getData());
            if ($this->Prices->save($price)) {
                $this->Flash->success(__('The price has been saved.'));

                return $this->redirect(['controller' => 'Events', 'action' => 'view', $price->event_id]);
            } else {
                $this->Flash->error(__('The price could not be saved. Please, try again.'));
            }
        }
        $itemTypes = $this->Prices->ItemTypes->find('list', ['limit' => 200]);
        $events = $this->Prices->Events->find('list', ['limit' => 200]);
        $this->set(compact('price', 'itemTypes', 'events'));
        $this->set('_serialize', ['price']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Price id.
     *
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $price = $this->Prices->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $price = $this->Prices->patchEntity($price, $this->request->getData());
            if ($this->Prices->save($price)) {
                $this->Flash->success(__('The price has been saved.'));

                return $this->redirect(['controller' => 'Events', 'action' => 'view', $price->event_id]);
            } else {
                $this->Flash->error(__('The price could not be saved. Please, try again.'));
            }
        }
        $itemTypes = $this->Prices->ItemTypes->find('list', ['limit' => 200]);
        $events = $this->Prices->Events->find('list', ['limit' => 200]);
        $this->set(compact('price', 'itemTypes', 'events'));
        $this->set('_serialize', ['price']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Price id.
     *
     * @return \Cake\Http\Response Redirects to Event View.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $price = $this->Prices->get($id);

        $eventId = $price->event_id;

        if ($this->Prices->delete($price)) {
            $this->Flash->success(__('The price has been deleted.'));
        } else {
            $this->Flash->error(__('The price could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'Events', 'action' => 'view', $eventId]);
    }
}
