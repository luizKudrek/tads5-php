<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Pecas Controller
 *
 * @property \App\Model\Table\PecasTable $Pecas
 */
class PecasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Pecas->find()
            ->contain(['Fornecedors']);
        $pecas = $this->paginate($query);

        //$this->set(compact('pecas'));
        return $this->response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Autenticacao')
            ->withType('application/json')
            ->withStringBody(json_encode($pecas));
    }

    /**
     * View method
     *
     * @param string|null $id Peca id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $response = null;
        $statusCode = 200;

        $id = $this->request->getData('id') ?? $this->request->getQuery('id');

        if (!$id) {
            $statusCode = 400;
            $response = ['erro' => 'ID da peça não fornecido.'];
        } else {
            try {
                $peca = $this->Pecas->get($id, [
                    'contain' => ['Fornecedors', 'Manupecas']
                ]);
                $response = $peca;
            } catch (\Exception $e) {
                $statusCode = 404;
                $response = ['erro' => 'Peça não encontrada.'];
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
        $peca = $this->Pecas->newEmptyEntity();
        if ($this->request->is('post')) {
            $peca = $this->Pecas->patchEntity($peca, $this->request->getData());
            if ($this->Pecas->save($peca)) {
                $this->Flash->success(__('The peca has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The peca could not be saved. Please, try again.'));
        }
        $fornecedors = $this->Pecas->Fornecedors->find('list', limit: 200)->all();
        $this->set(compact('peca', 'fornecedors'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Peca id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $response = null;
        $statusCode = 200;

        try {
            $data = $this->request->getData();

            if (!isset($data['id'])) {
                throw new \Exception("ID da peça não fornecido");
            }

            $peca = $this->Pecas->get($data['id'], ['contain' => []]);

            if ($this->request->is(['patch', 'post', 'put'])) {
                $peca = $this->Pecas->patchEntity($peca, $data);

                if ($this->Pecas->save($peca)) {
                    $response = ['status' => 'success', 'message' => 'Peça atualizada com sucesso'];
                } else {
                    $statusCode = 400;
                    $response = ['status' => 'error', 'message' => 'Erro ao atualizar a peça', 'errors' => $peca->getErrors()];
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
     * @param string|null $id Peca id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete()
    {
        $this->request->allowMethod(['post', 'delete']);
        $response = null;
        $statusCode = 200;

        $id = $this->request->getData('id');

        try {
            if (!$id) {
                throw new \Exception('ID não fornecido.');
            }

            $peca = $this->Pecas->get($id);

            if ($this->Pecas->delete($peca)) {
                $response = ['status' => 'success', 'message' => 'Peça excluída com sucesso.'];
            } else {
                $statusCode = 500;
                $response = ['status' => 'error', 'message' => 'Erro ao excluir a peça.'];
            }
        } catch (\Exception $e) {
            $statusCode = 500;
            $response = ['status' => 'error', 'message' => 'Erro ao excluir a peça.', 'exception' => $e->getMessage()];
        }

        return $this->response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Autenticacao')
            ->withType('application/json')
            ->withStatus($statusCode)
            ->withStringBody(json_encode($response));
    }
}
