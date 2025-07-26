<?php

namespace App\Controller;

use App\Controller\AppController;

class VisualizacaosController extends AppController
{
    public function visualManutencao()
    {
        $this->request->allowMethod(['post']);

        $response = [];
        $codigo  = 500 ;

        if ($this->request->is('post')) {
            $manutencao = $this->fetchTable('Manutencaos', );
   // nota: valor, data , numero / veiculo: modelo / fornecedor: telefone
            $response = $manutencao->find()
                ->select([
                    'Fornecedors.nome',
                    'Fornecedors.cnpj',
                    'Fornecedors.telefone',
                    'Veiculos.placa',
                    'Veiculos.modelo',
                    'Manutencaos.data',
                    'Manutencaos.numntfiscal',
                    'Manutencaos.valor',
                    'Fabricantes.abreviado'
                ])
                ->join([
                        'table' => 'Veiculos',
                        'type' => 'INNER',
                        'conditions' => 'Manutencaos.veiculo_id = Veiculos.id'
                ])
                ->join([
                'table' => 'Fornecedors',
                'type' => 'INNER',
                'conditions' => 'Manutencaos.fornecedor_id = Fornecedors.id'
                ])
                ->join([
                'table' => 'Fabricantes',
                'type' => 'INNER',
                'conditions' => 'Veiculos.fabricante_id = Fabricantes.id'
                 ])
                ->toArray();
        }

        $this->set([
            'data' => $response,
            '_serialize' => ['data']
        ]);

        return $this->response
            ->withHeader("Access-Control-Allow-Origin", "*")
            ->withStatus($codigo)
            ->withType("aplication/json")
            ->withStringBody(json_encode($response));
    }


}
