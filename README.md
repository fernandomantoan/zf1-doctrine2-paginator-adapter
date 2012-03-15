# Zend Framework 1.x Paginator Adapter for Doctrine 2.x

Implementation of a simple Zend_Paginator_Adapter to use with Doctrine 2.x QueryBuilder objects.

## Dependencies

This project needs the [ZendFramework1-Doctrine2 integration](http://github.com/guilhermeblanco/ZendFramework1-Doctrine2) created by [Guilherme Blanco](http://github.com/guilhermeblanco).

## Usage

Using the adapter is a very easy process. First of all a Doctrine QueryBuilder object must be created, just like the following sample:

	$queryBuilder = $this->_entityManager->createQueryBuilder();
	$queryBuilder->select('e')
	             ->from('Entity\Entry', 'e')
	             ->orderBy('e.id', 'DESC');

After having the QueryBuilder instantiated and populated, just pass it to the Adapter:

	$adapter = new FernandoMantoan_Paginator_Adapter_Doctrine($queryBuilder);
	$paginator = new Zend_Paginator($adapter);
	$paginator->setCurrentPageNumber($this->_getParam('page', 1))
	          ->setItemCountPerPage(10);
	$this->view->entries = $paginator;

In your view you can use the following code to show the paginator:

	<?php if (sizeof($this->entries) == 0): ?>
	No entries found
	<?php else: ?>
	    <?php foreach ($this->entries as $entry): ?>
	    //... your code
	    <?php endforeach; ?>
	    <?php echo $this->paginationControl($this->entries, 'sliding', 'pagination.phtml'); ?>
	<?php endif; ?>

The project comes with a pagination.phtml file in application/views/scripts/pagination.html, you can customize it if you want.

## Contribute

You can contribute by supporting more Doctrine 2.x types like ArrayCollection and others. Also some issues will be added to the project's page so that interested contributors can implement common requested features.

