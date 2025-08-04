<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Fornecedors Controller
 *
 * @property \App\Model\Table\FornecedorsTable $Fornecedors
 */
class FornecedorsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Fornecedors->find()
            ->contain(['Servicos']);
        $fornecedors = $this->paginate($query);

       // $this->set(compact('fornecedors'));
        return $this->response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Autenticacao')
            ->withType('application/json')
            ->withStringBody(json_encode($fornecedors));
    }

    /**
     * View method
     *
     * @param string|null $id Fornecedor id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fornecedor = $this->Fornecedors->get($id, contain: ['Servicos', 'Manutencaos', 'Pecas']);
        $this->set(compact('fornecedor'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fornecedor = $this->Fornecedors->newEmptyEntity();
        if ($this->request->is('post')) {
            $fornecedor = $this->Fornecedors->patchEntity($fornecedor, $this->request->getData());
            if ($this->Fornecedors->save($fornecedor)) {
                $this->Flash->success(__('The fornecedor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fornecedor could not be saved. Please, try again.'));
        }
        $servicos = $this->Fornecedors->Servicos->find('list', limit: 200)->all();
        $this->set(compact('fornecedor', 'servicos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Fornecedor id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fornecedor = $this->Fornecedors->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fornecedor = $this->Fornecedors->patchEntity($fornecedor, $this->request->getData());
            if ($this->Fornecedors->save($fornecedor)) {
                $this->Flash->success(__('The fornecedor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fornecedor could not be saved. Please, try again.'));
        }
        $servicos = $this->Fornecedors->Servicos->find('list', limit: 200)->all();
        $this->set(compact('fornecedor', 'servicos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Fornecedor id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fornecedor = $this->Fornecedors->get($id);
        if ($this->Fornecedors->delete($fornecedor)) {
            $this->Flash->success(__('The fornecedor has been deleted.'));
        } else {
            $this->Flash->error(__('The fornecedor could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
