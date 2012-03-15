<?php

use Entity\Entry;

class IndexController extends Zend_Controller_Action
{
	protected $_entityManager;
	
    public function init()
    {
    	$this->_entityManager = $this->getInvokeArg('bootstrap')
    	                             ->getResource('doctrine')
    	                             ->getEntityManager();
    }
    
    public function indexAction()
    {
    	$queryBuilder = $this->_entityManager->createQueryBuilder();
    	$queryBuilder->select('e')
    	             ->from('Entity\Entry', 'e')
    	             ->orderBy('e.id', 'DESC');
    	$paginator = new Zend_Paginator(new FernandoMantoan_Paginator_Adapter_Doctrine($queryBuilder));
    	$paginator->setCurrentPageNumber($this->_getParam('page', 1))
    	          ->setItemCountPerPage(10);
    	
    	$this->view->entries = $paginator;
    }
}