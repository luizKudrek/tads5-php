<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Manutencaos Controller
 *
 * @property \App\Model\Table\ManutencaosTable $Manutencaos
 */
class ManutencaosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Manutencaos->find()
            ->contain(['Fornecedors', 'Veiculos']);
        $manutencaos = $this->paginate($query);

       // $this->set(compact('manutencaos'));
        return $this->response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Autenticacao')
            ->withType('application/json')
            ->withStringBody(json_encode($manutencaos));
    }

    /**
     * View method
     *
     * @param string|null $id Manutencao id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $manutencao = $this->Manutencaos->get($id, contain: ['Fornecedors', 'Veiculos', 'Manupecas']);
        $this->set(compact('manutencao'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $manutencao = $this->Manutencaos->newEmptyEntity();
        if ($this->request->is('post')) {
            $manutencao = $this->Manutencaos->patchEntity($manutencao, $this->request->getData());
            if ($this->Manutencaos->save($manutencao)) {
                $this->Flash->success(__('The manutencao has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The manutencao could not be saved. Please, try again.'));
        }
        $fornecedors = $this->Manutencaos->Fornecedors->find('list', limit: 200)->all();
        $veiculos = $this->Manutencaos->Veiculos->find('list', limit: 200)->all();
        $this->set(compact('manutencao', 'fornecedors', 'veiculos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Manutencao id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $manutencao = $this->Manutencaos->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $manutencao = $this->Manutencaos->patchEntity($manutencao, $this->request->getData());
            if ($this->Manutencaos->save($manutencao)) {
                $this->Flash->success(__('The manutencao has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The manutencao could not be saved. Please, try again.'));
        }
        $fornecedors = $this->Manutencaos->Fornecedors->find('list', limit: 200)->all();
        $veiculos = $this->Manutencaos->Veiculos->find('list', limit: 200)->all();
        $this->set(compact('manutencao', 'fornecedors', 'veiculos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Manutencao id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $manutencao = $this->Manutencaos->get($id);
        if ($this->Manutencaos->delete($manutencao)) {
            $this->Flash->success(__('The manutencao has been deleted.'));
        } else {
            $this->Flash->error(__('The manutencao could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
