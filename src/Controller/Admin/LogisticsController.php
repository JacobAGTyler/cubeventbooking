<?php
namespace App\Controller\Admin;

/**
 * Logistics Controller
 *
 * @property \App\Model\Table\LogisticsTable $Logistics
 */
class LogisticsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Applications', 'Logisticstypes', 'Parameters']
        ];
        $logistics = $this->paginate($this->Logistics);

        $this->set(compact('logistics'));
        $this->set('_serialize', ['logistics']);
    }

    /**
     * View method
     *
     * @param string|null $logisticId Logistic id.
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($logisticId = null)
    {
        $logistic = $this->Logistics->get($logisticId, [
            'contain' => ['Applications', 'Logisticstypes', 'Parameters']
        ]);

        $this->set('logistic', $logistic);
        $this->set('_serialize', ['logistic']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $logistic = $this->Logistics->newEntity();
        if ($this->request->is('post')) {
            $logistic = $this->Logistics->patchEntity($logistic, $this->request->getData());
            if ($this->Logistics->save($logistic)) {
                $this->Flash->success(__('The logistic has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The logistic could not be saved. Please, try again.'));
            }
        }
        $applications = $this->Logistics->Applications->find('list', ['limit' => 200]);
        $logisticstypes = $this->Logistics->Logisticstypes->find('list', ['limit' => 200]);
        $parameters = $this->Logistics->Parameters->find('list', ['limit' => 200]);
        $this->set(compact('logistic', 'applications', 'logisticstypes', 'parameters'));
        $this->set('_serialize', ['logistic']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Logistic id.
     * @return \Cake\Http\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $logistic = $this->Logistics->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $logistic = $this->Logistics->patchEntity($logistic, $this->request->getData());
            if ($this->Logistics->save($logistic)) {
                $this->Flash->success(__('The logistic has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The logistic could not be saved. Please, try again.'));
            }
        }
        $applications = $this->Logistics->Applications->find('list', ['limit' => 200]);
        $logisticstypes = $this->Logistics->Logisticstypes->find('list', ['limit' => 200]);
        $parameters = $this->Logistics->Parameters->find('list', ['limit' => 200]);
        $this->set(compact('logistic', 'applications', 'logisticstypes', 'parameters'));
        $this->set('_serialize', ['logistic']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Logistic id.
     * @return \Cake\Http\Response|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $logistic = $this->Logistics->get($id);
        if ($this->Logistics->delete($logistic)) {
            $this->Flash->success(__('The logistic has been deleted.'));
        } else {
            $this->Flash->error(__('The logistic could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
