<?php

namespace Contato\Controller;

// imposrt Zend\Mvc
use Zend\Mvc\Controller\AbstractActionController;

// import Zend\View
use Zend\View\Model\ViewModel;

// import Zend\Db
use Zend\Db\Adapter\Adapter as AdaptadorAlias,
    Zend\Db\Sql\Sql,
    Zend\Db\ResultSet\ResultSet;

class HomeController extends AbstractActionController {

    /**
     * action index
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction() {
        /**
         * função anônima para var_dump estilizado
         */
        $myVarDump = function($nome_linha = "Nome da Linha", $data = null, $caracter = ' - ') {
            echo str_repeat($caracter, 100) . '<br/>' . ucwords($nome_linha) . '<pre><br/>';
            var_dump($data);
            echo '</pre>' . str_repeat($caracter, 100) . '<br><br>';
        };

        /**
         * conexão com o banco de dados
         */
        /*
        $adapter = new AdaptadorAlias(array(
            'driver' => 'Pdo_Mysql',
            'database' => 'agenda_contatos',
            'username' => 'tutorialzf2',
            'password' => 'O0d4m4R453n64n'
        ));
        */
        // o código acima foi substituído pelo código abaixo pois agora estamos usando um serviço do Service Manager
        // que foi configurado no arquivo zf2-tutorial/config/autoload/global.php
        $adapter = $this->getServiceLocator()->get('AdapterDb');

        /**
         * obter nome do schema do banco de dados
         */
        $myVarDump(
                "Nome Schema", $adapter->getCurrentSchema()
        );

        /**
         * contar a quantidade de elementos da nossa tabela
         */
        $myVarDump(
                "Quantidade de elementos na tabela Contatos", $adapter->query("SELECT * FROM `contatos`")->execute()->count()
        );

        /**
         * montar objeto sql e executar
         */
        $sql = new Sql($adapter);
        $select = $sql->select()->from('contatos');
        $statement = $sql->prepareStatementForSqlObject($select);
        $resultSql = $statement->execute();
        $myVarDump(
                "Object SQL com Select executando", $resultSql
        );

        /**
         * montar objeto resultset com objeto sql e mostrar resultado em array
         */
        $resultSet = new ResultSet;
        $resultSet->initialize($resultSql);
        $myVarDump(
                "Resultado do Objeto SQL para Array ", $resultSet->toArray()
        );
        die();
    }

    public function sobreAction() {
        return new ViewModel();
    }

}