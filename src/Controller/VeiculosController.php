<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Veiculos Controller
 *
 * @property \App\Model\Table\VeiculosTable $Veiculos
 */
class VeiculosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Veiculos->find()
            ->contain(['Fabricantes', 'Tipos']);
        $veiculos = $this->paginate($query);

        //$this->set(compact('Veiculos'));
        return $this->response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Autenticacao')
            ->withType('application/json')
            ->withStringBody(json_encode($veiculos));
    }

    /**
     * View method
     *
     * @param string|null $id Veiculo id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $response   = null;
        $statusCode = 200;

        // Tenta pegar o ID enviado em multipart/form-data, x-www-form-urlencoded ou JSON
        $id = $this->request->getData('id');
        if ($id === null) {
            // Tenta pegar como query-string (?id=1)
            $id = $this->request->getQuery('id');
        }

        if ($id === null) {
            $statusCode = 400;
            $response   = ['erro' => 'ID do veículo não fornecido.'];
        } else {
            try {
                $veiculo  = $this->Veiculos->get($id, [
                    'contain' => ['Fabricantes', 'Tipos', 'Manutencaos']
                ]);
                $response = $veiculo;
            } catch (\Exception $e) {
                $statusCode = 404;
                $response   = ['erro' => 'Veículo não encontrado.'];
            }
        }

        return $this->response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Autenticacao')
            ->withStatus($statusCode)
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $veiculo = $this->Veiculos->newEmptyEntity();
        if ($this->request->is('post')) {
            $veiculo = $this->Veiculos->patchEntity($veiculo, $this->request->getData());
            if ($this->Veiculos->save($veiculo)) {
                $this->Flash->success(__('The veiculo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The veiculo could not be saved. Please, try again.'));
        }
        $fabricantes = $this->Veiculos->Fabricantes->find('list', limit: 200)->all();
        $tipos = $this->Veiculos->Tipos->find('list', limit: 200)->all();
        $this->set(compact('veiculo', 'fabricantes', 'tipos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Veiculo id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    /*public function edit($id = null)
    {
        $veiculo = $this->Veiculos->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $veiculo = $this->Veiculos->patchEntity($veiculo, $this->request->getData());
            if ($this->Veiculos->save($veiculo)) {
                $this->Flash->success(__('The veiculo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The veiculo could not be saved. Please, try again.'));
        }
        $fabricantes = $this->Veiculos->Fabricantes->find('list', limit: 200)->all();
        $tipos = $this->Veiculos->Tipos->find('list', limit: 200)->all();
      //  $this->set(compact('veiculo', 'fabricantes', 'tipos'));
        return $this->response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Autenticacao')
            ->withStatus($statusCode)
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }
    */
    public function edit($id = null)
    {
        $response = null;
        $statusCode = 200;

        try {
            $veiculo = $this->Veiculos->get($id, ['contain' => []]);

            if ($this->request->is(['patch', 'post', 'put'])) {
                $data = $this->request->getData();

                $veiculo = $this->Veiculos->patchEntity($veiculo, $data);

                if ($this->Veiculos->save($veiculo)) {
                    $response = ['status' => 'success', 'message' => 'Veículo atualizado com sucesso'];
                } else {
                    $statusCode = 400;
                    $response = ['status' => 'error', 'message' => 'Erro ao atualizar o veículo', 'errors' => $veiculo->getErrors()];
                }
            } else {
                $statusCode = 405;
                $response = ['status' => 'error', 'message' => 'Método não permitido'];
            }
        } catch (\Exception $e) {
            $statusCode = 500;
            $response = ['status' => 'error', 'message' => 'Erro interno do servidor', 'exception' => $e->getMessage()];
        }

        return $this->response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Autenticacao')
            ->withType('application/json')
            ->withStatus($statusCode)
            ->withStringBody(json_encode($response));
    }


    /**
     * Delete method
     *
     * @param string|null $id Veiculo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $veiculo = $this->Veiculos->get($id);
        if ($this->Veiculos->delete($veiculo)) {
            $this->Flash->success(__('The veiculo has been deleted.'));
        } else {
            $this->Flash->error(__('The veiculo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
