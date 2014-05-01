<?php
namespace Contato\Model;

use Zend\Db\TableGateway\TableGateway;

class ContatoTable
{
    protected $tableGateway;
    
    /**
     * Construtor com dependência da classe TableGateway
     * @param \Zend\Db\TableGateway\TableGateway $tableGateway
     */
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    /**
     * Recuperar todos os elementos da tabela contatos
     * @return ResultSet
     */
    public function fetchAll()
    {
        return $this->tableGateway->select();
    }
    
    /**
     * Localizar linha específica pelo id da tabela contatos
     * @param type $id
     * @return \Model\Contato
     * @throws \Exception
     */
    public function find($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Não foi encontrado contato de id = {$id}");
        }
        
        return $row;
    }
}



















