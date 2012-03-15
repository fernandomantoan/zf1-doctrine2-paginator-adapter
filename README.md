# Zend Framework 1.x Paginator Adapter for Doctrine 2.x

Implementation of a simple Zend_Paginator_Adapter to use with Doctrine 2.x QueryBuilder objects.

## Dependencies

This project needs the [ZendFramework1-Doctrine2 integration](http://github.com/guilhermeblanco/ZendFramework1-Doctrine2) created by [Guilherme Blanco](http://github.com/guilhermeblanco).

## Usage

Using the adapter is a very common process. First of all a Doctrine QueryBuilder object must be created, just like the following sample:

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
	<table>
				<thead>
					<tr>
						<th scope="col">Id</th>
						<th scope="col">Description</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td colspan="2"><?php echo $this->paginationControl($this->entries, 'sliding', 'pagination.phtml'); ?></td>
					</tr>
				</tfoot>
				<tbody>
					<?php if (sizeof($this->entries) == 0): ?>
					<tr>
						<td colspan="2">No entries found</td>
					</tr>
					<?php else: ?>
					<?php foreach ($this->entries as $entry): ?>
					<tr>
						<td><?php echo $entry->getId(); ?></td>
						<td><?php echo $entry->getDescription(); ?></td>
					</tr>
					<?php endforeach; ?>
					<?php endif; ?>
				</tbody>
	</table>

The project comes with a pagination.phtml file, which is as follows:

	<?php if ($this->pageCount): ?>
	<div class="paginationControl">
	<!-- Previous page link -->
	<?php if (isset($this->previous)): ?>
		<a href="<?php echo $this->url(array('page' => $this->previous)); ?>">&lt; Previous</a>
	<?php else: ?>
		<span class="disabled">&lt; Previous</span> 
	<?php endif; ?>
	&nbsp;&nbsp;
	<!-- Numbered page links -->
	Page <b><?php echo $this->current; ?></b> of <?php echo $this->pageCount; ?>
	<?php foreach ($this->pagesInRange as $page): ?>
		<?php if ($page != $this->current): ?>
			<a href="<?php echo $this->url(array('page' => $page)); ?>"><?php echo $page; ?></a>
		<?php else: ?>
			<span><?php echo $page; ?></span>
		<?php endif; ?>
	<?php endforeach; ?>
	&nbsp;&nbsp;
	<!-- Next page link -->
	<?php if (isset($this->next)): ?>
		<a href="<?php echo $this->url(array('page' => $this->next)); ?>">Next &gt;</a>
	<?php else: ?>
		<span class="disabled">Next &gt;</span>
	<?php endif; ?>
	</div>
	<?php endif; ?>

## Contribute

You can contribute by supporting more Doctrine 2.x types like ArrayCollection and others. Also some issues will be added to the project's page so that interested contributors can implement common requested features.

