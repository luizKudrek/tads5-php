<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Servicos Controller
 *
 * @property \App\Model\Table\ServicosTable $Servicos
 */
class ServicosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Servicos->find();
        $servicos = $this->paginate($query);

//        $this->set(compact('servicos'));
        return $this->response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Autenticacao')
            ->withType('application/json')
            ->withStringBody(json_encode($servicos));
    }

    /**
     * View method
     *
     * @param string|null $id Servico id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function view($id = null)
    {
        try {
            $servico = $this->Servicos->get($id, [
                'contain' => ['Fornecedors']
            ]);

            return $this->response
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Autenticacao')
                ->withType('application/json')
                ->withStringBody(json_encode($servico));

        } catch (\Cake\Datasource\Exception\RecordNotFoundException $e) {
            // Se não encontrar o registro, retorna erro 404
            return $this->response
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Autenticacao')
                ->withStatus(404)
                ->withType('application/json')
                ->withStringBody(json_encode(['erro' => 'Serviço não encontrado']));
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $servico = $this->Servicos->newEmptyEntity();
        if ($this->request->is('post')) {
            $servico = $this->Servicos->patchEntity($servico, $this->request->getData());
            if ($this->Servicos->save($servico)) {
                $this->Flash->success(__('The servico has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The servico could not be saved. Please, try again.'));
        }
        $this->set(compact('servico'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Servico id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $servico = $this->Servicos->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $servico = $this->Servicos->patchEntity($servico, $this->request->getData());
            if ($this->Servicos->save($servico)) {
                $this->Flash->success(__('The servico has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The servico could not be saved. Please, try again.'));
        }
        $this->set(compact('servico'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Servico id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        // 1. Garante que a requisição seja feita via POST ou DELETE
        try {
            $this->request->allowMethod(['post', 'delete']);
        } catch (MethodNotAllowedException $e) {
            return $this->response
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Autenticacao')
                ->withStatus(405) // 405 Method Not Allowed
                ->withType('application/json')
                ->withStringBody(json_encode(['message' => 'Método não permitido para esta ação.']));
        }

        // 2. Tenta obter o registro pelo ID
        if ($id === null) {
            return $this->response
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Autenticacao')
                ->withStatus(400) // 400 Bad Request
                ->withType('application/json')
                ->withStringBody(json_encode(['message' => 'ID do serviço não fornecido.']));
        }

        try {
            $servico = $this->Servicos->get($id);
        } catch (RecordNotFoundException $e) {
            // Se não encontrar o registro, retorna erro 404
            return $this->response
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Autenticacao')
                ->withStatus(404) // 404 Not Found
                ->withType('application/json')
                ->withStringBody(json_encode(['message' => 'Serviço não encontrado para o ID fornecido.']));
        } catch (\Exception $e) {
            // Captura outras exceções na busca (ex: ID inválido que não seja um UUID se for o caso)
            return $this->response
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Autenticacao')
                ->withStatus(500) // 500 Internal Server Error
                ->withType('application/json')
                ->withStringBody(json_encode(['message' => 'Ocorreu um erro inesperado ao buscar o serviço.', 'error' => $e->getMessage()]));
        }

        // 3. Tenta deletar o registro
        if ($this->Servicos->delete($servico)) {
            return $this->response
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Autenticacao')
                ->withStatus(204); // 204 No Content é o padrão para DELETE bem-sucedido sem retorno de corpo
            // Ou 200 OK com uma mensagem de sucesso, se preferir:
            // ->withStatus(200)
            // ->withType('application/json')
            // ->withStringBody(json_encode(['message' => 'Serviço deletado com sucesso.']));
        } else {
            // Se houver regras de negócio ou restrições de chave estrangeira que impeçam a deleção
            return $this->response
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Autenticacao')
                ->withStatus(500) // 500 Internal Server Error
                ->withType('application/json')
                ->withStringBody(json_encode(['message' => 'O serviço não pôde ser deletado. Por favor, tente novamente.', 'errors' => $servico->getErrors()]));
        }
    }
}
