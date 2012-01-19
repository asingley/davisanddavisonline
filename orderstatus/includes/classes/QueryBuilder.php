<?php

class QueryBuilder {
	var $baseQuery;
	var $wheres = array();
	var $orderBy;
	
	/*
		Used to make it easier to build complex queries.
		QueryBuilder is instantiated with a table name and a list of 
		fields to return.  Use the addConstraints methods to add constraints
		as needed, optionally use addOrderBy, and then use getQuery to 
		retrieve the completed query.		
	*/
	
	function QueryBuilder($tableName, $returnFields) {
		$first = true;
		foreach ($returnFields as $fieldName) {
			if ($first) {
				$list = $fieldName;
				$first = false;
			} else {
				$list .= ', ' . $fieldName;
			}
		}
		$this->baseQuery = "SELECT $list FROM $tableName";
	}
	function getQuery() {
		$query = $this->baseQuery;
		if (count($this->wheres) > 0) {
			$query .= " WHERE ";
			for ($i = 0; $i < count($this->wheres); $i++) {
				$query .= $this->wheres[$i];
				if ($i < (count($this->wheres) - 1)) {
					$query .= " AND ";
				}
			}
		}
		if (!empty($this->orderBy)) {
			$query .= " ORDER BY $this->orderBy";
		}
		return $query;
	} 	
	function addConstraint($fieldName, $value) {
		if (is_numeric($value)) {
			$this->wheres[] = "$fieldName = $value";
		} elseif ($value != null) {
			$this->wheres[] = "$fieldName = '$value'";
		}
	}
	function addConstraintLike($fieldName, $value) {
		$this->wheres[] = "$fieldName LIKE '%$value%'";
	}
	function addConstraintNull($fieldName) {
		$this->wheres[] = "$fieldName IS NULL";
	}
	function addConstraintNotNull($fieldName) {
		$this->wheres[] = "$fieldName IS NOT NULL";
	}
	function addConstraintMin($fieldName, $min) {
		$this->addConstraintInequality($fieldName, '>', $min);
	}
	function addConstraintMax($fieldName, $max) {
		$this->addConstraintInequality($fieldName, '<', $max);
	}
	function addConstraintInequality($fieldName, $inequality, $value) {
		$value = is_numeric($value) ? $value : "'$value'";
		$this->wheres[] = "$fieldName $inequality $value";
	
	}
	function addConstraintPossibilities($fieldName, $values) {
		if (count($values) > 0) {
			$where = "(";
			for ($i = 0; $i < count($values); $i++) {
				$where .= "$fieldName = '" . $values[$i] . "'";
				if ($i < (count($values) - 1)) {
					$where .= " OR ";
				}
			}	
			$where .= ")";
			$this->wheres[] = $where;	
		}
	}
	function addConstraintRange($fieldName, $val1, $val2) {
		if ($val1 && $val2) {
			$min = min($val1, $val2);
			$max = max($val1, $val2);
			$this->_quote($max);
			$this->_quote($min);
			$this->wheres[] = "$fieldName > $min AND $fieldName < $max";
		} elseif ($val1) {
			$this->_quote($val1);
			$this->wheres[] = "$fieldName > $val1";
		} elseif ($val2) {
			$this->_quote($val2);
			$this->wheres[] = "$fieldName < $val2";
		}
	}
	function addOrderBy($column) {
		$this->orderBy = $column;
	}
	function _quote(&$var) {
		if (!is_numeric($var)) {
			$var = "'$var'";
		}
	}
}
?>