<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\Exception\PersistenceFailedException;

class AdicionasController extends AppController
{
    public function initialize(): void
    {
        parent::initialize(); // TODO: Change the autogenerated stub
    }

    public  function adicionaruser() {
        $response = null;
        $statusCode = 200;

        if ($this->request->is('post')){
            $user = $this->Users->newEmptyEntity();
            $user = $this->Users->patchEntity($user, $this->request->getData());

            try {
                $this->Users->saveOrFail($user);
                $response = 'Usuario adicionado com sucesso';

                $subject = 'TADS 5';
                $deliver = '<h4>Boas vindas</h4>Cadastro do usuário realizado com sucesso!';
                $this->sendEmail($user, $subject, $deliver);
            } catch (PersistenceFailedException $e) {
                $statusCode = 400;
                $response = $e->getAttributes();
            }

        }

        return $this->response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withStatus($statusCode)
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function adicionarservico(){
        $response = null;
        $statusCode = 200;

        if ($this->request->is('post')){
            $servico = $this->Servicos->newEmptyEntity();
            $servico = $this->Servicos->patchEntity($servico, $this->request->getData());

            try {
                $this->Servicos->saveOrFail($servico);
                $response = 'Serviço adicionado com sucesso';
            } catch (PersistenceFailedException $e) {
                $statusCode = 400;
                $response = $e->getAttributes();
            }

        }

        return $this->response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withStatus($statusCode)
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function adicionarfornecedor(){
        $response = null;
        $statusCode = 200;

        if ($this->request->is('post')){
            $fornecedor = $this->Fornecedors->newEmptyEntity();
            $fornecedor = $this->Fornecedors->patchEntity($fornecedor, $this->request->getData());

            try {
                $this->Fornecedors->saveOrFail($fornecedor);
                $response = 'Fornecedor adicionado com sucesso';
            } catch (PersistenceFailedException $e) {
                $statusCode = 400;
                $response = $e->getAttributes();
            }

        }

        return $this->response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withStatus($statusCode)
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function adicionarpeca(){
        $response = null;
        $statusCode = 200;

        if ($this->request->is('post')){
            $peca = $this->Pecas->newEmptyEntity();
            $peca = $this->Pecas->patchEntity($peca, $this->request->getData());

            try {
                $this->Pecas->saveOrFail($peca);
                $response = 'Fornecedor adicionado com sucesso';
            } catch (PersistenceFailedException $e) {
                $statusCode = 400;
                $response = $e->getAttributes();
            }

        }

        return $this->response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withStatus($statusCode)
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function adicionarfabricante(){
        $response = null;
        $statusCode = 200;

        if ($this->request->is('post')){
            $fabricante = $this->Fabricantes->newEmptyEntity();
            $fabricante = $this->Fabricantes->patchEntity($fabricante, $this->request->getData());

            try {
                $this->Fabricantes->saveOrFail($fabricante);
                $response = 'Fornecedor adicionado com sucesso';
            } catch (PersistenceFailedException $e) {
                $statusCode = 400;
                $response = $e->getAttributes();
            }

        }


        return $this->response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withStatus($statusCode)
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function adicionarstipo(){
        $response = null;
        $statusCode = 200;

        if ($this->request->is('post')){
            $tipo = $this->Tipos->newEmptyEntity();
            $tipo = $this->Tipos->patchEntity($tipo, $this->request->getData());

            try {
                $this->Tipos->saveOrFail($tipo);
                $response = 'Fornecedor adicionado com sucesso';
            } catch (PersistenceFailedException $e) {
                $statusCode = 400;
                $response = $e->getAttributes();
            }

        }


        return $this->response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withStatus($statusCode)
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function adicionarveiculo(){
        $response = null;
        $statusCode = 200;

        if ($this->request->is('post')){
            $veiculo = $this->Veiculos->newEmptyEntity();
            $veiculo = $this->Veiculos->patchEntity($veiculo, $this->request->getData());

            try {
                $this->Veiculos->saveOrFail($veiculo);
                $response = 'Fornecedor adicionado com sucesso';
            } catch (PersistenceFailedException $e) {
                $statusCode = 400;
                $response = $e->getAttributes();
            }

        }


        return $this->response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withStatus($statusCode)
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function adicionarmanutencao(){
        $response = null;
        $statusCode = 200;

        if ($this->request->is('post')){
            $manutencao = $this->Manutencaos->newEmptyEntity();
            $manutencao = $this->Manutencaos->patchEntity($manutencao, $this->request->getData());

            try {
                $this->Manutencaos->saveOrFail($manutencao);
                $response = 'Fornecedor adicionado com sucesso';
            } catch (PersistenceFailedException $e) {
                $statusCode = 400;
                $response = $e->getAttributes();
            }

        }


        return $this->response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withStatus($statusCode)
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

    public function adicionarmanupeca(){
        $response = null;
        $statusCode = 200;

        if ($this->request->is('post')){
            $manupeca = $this->Manupecas->newEmptyEntity();
            $manupeca = $this->Manupecas->patchEntity($manupeca, $this->request->getData());

            try {
                $this->Manupecas->saveOrFail($manupeca);
                $response = 'Fornecedor adicionado com sucesso';
            } catch (PersistenceFailedException $e) {
                $statusCode = 400;
                $response = $e->getAttributes();
            }

        }


        return $this->response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withStatus($statusCode)
            ->withType('application/json')
            ->withStringBody(json_encode($response));
    }

}
