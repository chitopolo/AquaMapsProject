<?php
App::uses('DataSet', 'Model');

class CSVImport{
	
	var $file_name;
	var $table_name;
	var $arr_csv_columns;
	var $arr_csv_columns_to_load;
	var $error;
	var $line_separate_char;
	var $field_separate_char = ",";
    var $field_enclose_char  = "\"";
    var $field_escape_char   = "\\";


	function _get_csv_header_fields()
	{
	$this->arr_csv_columns = array();
	$fpointer = fopen($this->file_name, "r");
	if ($fpointer)
	{
	  $arr = fgetcsv($fpointer, 10*1024, ',');
	  if(is_array($arr) && !empty($arr))
	  {
	    //if($this->use_csv_header)
	    if(true)
	    {
	      foreach($arr as $val)
	        //if(''!=trim($val))
	          $this->arr_csv_columns[] = array('name'=>$val, 'type'=>'TEXT');
	    }
	    else
	    {
	      $i = 1;
	      foreach($arr as $val)
	      {
	        //if(''!=trim($val))
	        $this->arr_csv_columns[] = array('name'=>'column'.$i, 'type'=>'TEXT');
	        $i++;
	      }
	    }
	  }
	  unset($arr);
	  fclose($fpointer);
	}
	else{
	  //$this->error = "file cannot be opened: ".(""==$this->file_name ? "[empty]" : @mysql_escape_string($this->file_name));
	  return false;
	}
	return $this->arr_csv_columns;
	}

	public function create_import_table()
	{

	$this->DataSet = new DataSet();
	$sql = "CREATE TABLE IF NOT EXISTS ".$this->table_name." (";

	if(!($this->_get_csv_header_fields() ) ){

		echo 'Error';
		exit;
	}

	if(!empty($this->arr_csv_columns))
	{
	  $arr = array();
	  foreach($this->arr_csv_columns as $i=>$column)
	    $arr[] = "`".$column['name']."` ".$column['type'];
	  //if( !empty($this->additional_create) )
	  //  $arr[] = $this->additional_create;
	  $sql .= implode(",", $arr);
	  $sql .= ")";
	  //new dBug($sql);
	  $res = $this->DataSet->query($sql);
	  //$this->error = $this->db->fError;
	  //var_dump($this->error);
	  //$this->table_exists = empty($this->error);
	}
	}


	function import()
	{

		$this->line_separate_char = '\n';

		$this->arr_csv_columns_to_load = $this->arr_csv_columns;
		  
		$fields = array();
		foreach($this->arr_csv_columns_to_load as $column)
		{
		  $field = '@dummy';
		  if( is_array($column) )
		  {
		    $field = '`'.$column['name'].'`';
		  }
		  elseif( '' != trim($column) )
		  {
		    $field = '`'.$column.'`';
		  }
		  $fields[] = $field;
		}

		$sql = "LOAD DATA INFILE '".@mysql_escape_string($this->file_name).
		     "' IGNORE INTO TABLE `".$this->table_name.
		     "` FIELDS TERMINATED BY '".@mysql_escape_string($this->field_separate_char).
		     "' OPTIONALLY ENCLOSED BY '".@mysql_escape_string($this->field_enclose_char).
		     "' ESCAPED BY '".@mysql_escape_string($this->field_escape_char).
		     "' LINES TERMINATED BY '". $this->line_separate_char .
		     "' ".
		     " IGNORE 1 LINES ".
		     "(".implode(",", $fields).")";

		$res = $this->DataSet->query($sql);

		// error_log($sql);
		/*
		$this->error = $this->fDB->fError;
		if(empty($this->error)) //OK!
		{
		$sql = "SELECT COUNT(*) AS cnt
		         FROM `".$this->table_name."`";
		$res = $this->fDB->query($sql);
		$this->error = $this->fDB->fError;
		if(empty($this->error)) //OK!
		{
		  $this->rows_count = $this->fDB->getField();
		}
		}*/
	}
		
}

?>