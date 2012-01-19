<? 
require_once('includes/dbopen.php');
class Form {
	/*
		Abstract Form class for implementing UIs.
		Automatically selects the method named in
		$_REQUEST['action'], if that method exists.
		Otherwise, defaults to your defaultBehavior 
		method.
		
		Use the generateSelectMenu, checkSelected, 
		and checkChecked to automate parts of form generation.
	
	*/
	
	var $database;
	var $errors;
	var $page;
	var $message;
	var $nextRowShaded = false;
	
	function Form() {
		$this->database = $GLOBALS['db'];
		if (isset($_REQUEST['action'])) {		
			if (method_exists($this, $_REQUEST['action'])) {
				$this->$_REQUEST['action']();
				return;
			}
		} 
		$this->defaultBehavior();
	}
	function defaultBehavior() {
		die("Default method of Form is abstract - must be overridden");
	}
	function getErrors() {
		return $this->errors;
	}
	function getPage() {
		return 'templates/' . $this->page;
	
	}
	function getMessage() {
		return $this->message;
	}
	function trToggle($shadedRowClassName) {
		if ($this->nextRowShaded) {
			print "<tr class=\"$shadedRowClassName\">";
			$this->nextRowShaded = false;
		} else {
			print "<tr>";
			$this->nextRowShaded = true;
		}
	}
	function selectMenu($name, $matchValue, $options, $labelIsValue = false) {
		$output = '<select name="' . $name . '" id="' . $name . '">\n';
		foreach ($options as $value => $label) {
			if ($labelIsValue) {
				$output .= "\t" . '<option';
				$output .= $this->checkSelected($matchValue, $label);
			} else {
				$output .= "\t" . '<option value="' . $value . '"';	
				$output .= $this->checkSelected($matchValue, $value);
			
			}
			$output .= '>' . $label . "</option>\n";
		}
		$output .= "</select>\n";
		print $output;
	}
	function checkSelected($var, $value, $labelType = 'selected') {
		// When generating a Select box, checks whether
		// the current value should be selected.
		if ($var==$value) {
				return " $labelType=\"$labelType\"";
		} else {
				return false;
		}
	
	}
	function checkChecked($varray, $value) {
	
		//Same as checkSelected, but for checkboxes and radio buttons.
		//and it checks an array
		$checked = ' checked="checked"';
		
		if (is_array($varray)) {
			if (in_array($value, $varray)) {
				return $checked;
			} else {
				return false;
			}
		} elseif ($varray==$value) {
			return $checked;
		} else {
			return false;
		}
	}
}
?>
