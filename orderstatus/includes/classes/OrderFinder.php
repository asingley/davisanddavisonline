<?php
require_once('includes/classes/QueryBuilder.php');

class OrderFinder {

	var $queryBuilder;
	
	function OrderFinder() {
		$this->queryBuilder = new QueryBuilder('orders', array('orderNumber', 'name', 'company', 'orderDate', 'status', 'trackingNumber', 'status'));
	}
	function search($fromDate, $toDate, $status, $orderNumber, $email, 
							$name, $company, $zip, $shipName,
							$shipCompany, $shipZip) {
							
		$searchFields = array('status', 'orderNumber', 'name', 'email', 'company', 'zip',
		'shipName', 'shipCompany', 'shipZip');
		foreach ($searchFields as $fieldName) {
			if (!empty($$fieldName)) {
				$this->queryBuilder->addConstraintLike($fieldName, $$fieldName);
			}
		}
		if (!empty($_REQUEST['fromDate'])) {
			$this->queryBuilder->addConstraintMin('orderDate',$_REQUEST['fromDate']);
		}
		if (!empty($_REQUEST['toDate'])) {
			$this->queryBuilder->addConstraintMax('orderDate',$_REQUEST['toDate']);
		}
		
		$this->queryBuilder->addOrderBy('orderNumber');
		
		return $this->execute();
	}
	function execute() {
		return $GLOBALS['db']->getAll($this->queryBuilder->getQuery());
	}
	function getOpenOrders() {
	
		$this->queryBuilder->addConstraintPossibilities('status', $GLOBALS['openStatusOptions']); 
		$this->queryBuilder->addOrderBy('orderNumber');
		return $this->execute();
	}
	function getNextOpenOrderNumber($prevOpenOrderNumber) {
		// Once we define an open order, limit this query.
		$qb = new QueryBuilder('orders', array('orderNumber'));
		$qb->addConstraintMin('orderNumber', $prevOpenOrderNumber);
		$qb->addConstraintPossibilities('status', $GLOBALS['openStatusOptions']); 
		return $GLOBALS['db']->getOne($qb->getQuery());
	}

}
?>
