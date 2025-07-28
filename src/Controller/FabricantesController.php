<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\Exception\PersistenceFailedException;

/**
 * Fabricantes Controller
 *
 * @property \App\Model\Table\FabricantesTable $Fabricantes
 */
class FabricantesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Fabricantes->find();
        $fabricantes = $this->paginate($query);

       // $this->set(compact('fabricantes'));
        return $this->response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Autenticacao')
            ->withType('application/json')
            ->withStringBody(json_encode($fabricantes));
    }

    /**
     * View method
     *
     * @param string|null $id Fabricante id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fabricante = $this->Fabricantes->get($id, contain: ['Veiculos']);
        $this->set(compact('fabricante'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fabricante = $this->Fabricantes->newEmptyEntity();
        if ($this->request->is('post')) {
            $fabricante = $this->Fabricantes->patchEntity($fabricante, $this->request->getData());
            if ($this->Fabricantes->save($fabricante)) {
                $this->Flash->success(__('The fabricante has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fabricante could not be saved. Please, try again.'));
        }
        $this->set(compact('fabricante'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Fabricante id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        {
            $response = null;
            $statusCode = 200;

            if ($this->request->is(['post', 'put', 'patch'])) {
                $data = $this->request->getData();
                $id = $data['id'] ?? null;

                if ($id === null) {
                    $statusCode = 400;
                    $response = ['erro' => 'ID do serviço não fornecido.'];
                } else {
                    $servico = $this->Fabricantes->get($id);

                    $servico = $this->Fabricantes->patchEntity($servico, $data);

                    try {
                        $this->Fabricantes->saveOrFail($servico);
                        $response = 'Serviço editado com sucesso!';
                    } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
                        $statusCode = 400;
                        $response = $e->getAttributes();
                    }
                }
            }

            return $this->response
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withStatus($statusCode)
                ->withType('application/json')
                ->withStringBody(json_encode($response));
    }
    }

    /**
     * Delete method
     *
     * @param string|null $id Fabricante id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fabricante = $this->Fabricantes->get($id);
        if ($this->Fabricantes->delete($fabricante)) {
            $this->Flash->success(__('The fabricante has been deleted.'));
        } else {
            $this->Flash->error(__('The fabricante could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
