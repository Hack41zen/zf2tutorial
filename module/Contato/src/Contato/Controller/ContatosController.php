<?php

namespace Contato\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class ContatosController extends AbstractActionController
{
    public function novoAction()    
    {
        
    }
    
    public function adicionarAction()
    {
        // obtém a requisição
        $request = $this->getRequest();
        
        // verifica se a requisição é do tipo post
        if ($request->isPost()) {
            // obter e armazenar os valores do post
            $postData = $request->getPost()->toArray();
            $formularioValido = false;
            
            if ($formularioValido) {
                // aqui vai a lógica para adicionar os dados à tabela no banco
                // 1 - solicitar serviço para pegar o model responsável pela adição
                // 2 - inserir dados no banco pelo model
                // adicionar mensagem de sucesso
                $this->flashMessenger()->addSuccessMessage("Contato criado com sucesso!");
                
                // redirecionar para a action index no Controller Contatos
                return $this->redirect()->toRoute('contatos');
            } else {
                // adicionar mensagem de erro
                $this->flashMessenger()->addErrorMessage("Erro ao tentar criar um contato");
                
                // redirecionar para a action novo no controller contatos
                return $this->redirect()->toRoute('contatos', array('action' => 'novo'));
            }
        }
        
    }
    
    public function detalhesAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        
        if (! $id) {
            $this->flashMessenger()->addMessage("Contato não encontrado!");
            return $this->redirect()->toRoute('contatos');
        }
        
        $form = array(
            'nome' => 'Eduardo Vinicius Micami',
            'telefone_principal' => '(085) 8585-8585',
            'telefone_secundario' => '(085) 8585-8585',
            'data-criacao' => '02/13/2013',
            'data-atualizacao' => '02/13/2013',
        );
        
        return array('id' => $id, 'form' => $form);
    }
    
    public function editarAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        
        if (! $id) {
            $this->flashMessenger()->addMessage("Contato não encontrado");
            return $this->redirect()->toRoute('contatos');
        }
        
        $form = array(
            'nome' => 'Eduardo Vinicius Micami',
            'telefone_principal' => '(085) 8585-8585',
            'telefone_secundario' => '(085) 8585-8585',
        );
        
        return array('id' => $id, 'form' => $form);
    }
    
    public function atualizarAction()
    {
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            
            $postData = $request->getPost()->toArray();
            $formularioValido = true;
            
            if ($formularioValido) {
                
                $this->flashMessenger()->addSuccessMessage("Contato editado com sucesso!");
                return $this->redirect()->toRoute('contatos', array('action' => 'detalhes', 'id' => $postData['id'],));
            } else {
                $this->flashMessenger()->addErrorMessage("Error ao editar contato!");
                return $this->redirect()->toRoute('contatos', array('action' => 'editar', 'id' => $postData['id'],));
            }
        }
    }
    
    public function deletarAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        
        if (! $id) {
            $this->flashMessenger()->addMessage("Contato não encontrado!");
        } else {
            $this->flashMessenger()->addSuccessMessage("Contato de ID $id deletado com sucesso!");
        }
        
        return $this->redirect()->toRoute('contatos');
    }
}

