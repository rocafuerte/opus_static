<?php 
class Query {
	public $table;
	public $result;
	public $query;
	public $askFor;
	public $orderBy;
	public $order;
	public $field;
	public $value;
	public $expression;
	
	public function __construct($table){	
		$this->setTable($table);
	}
	
	public function setTable($table){
		$this->table=$table;
	}
	
	public function getTable(){
		return $this->table;
	}
	
	public function getOrderBy(){
		return $this->orderBy;
	}
	
	public function getOrder(){
		return $this->order;
	}
	
	public function getResult(){
		return $this->result;
	}
	
	public function getAskFor(){
		return $this->askFor;
	}
	
	public function getExpression(){
		return $this->expression;
	}
	
	public function getField(){
		return $this->field;
	}
	
	public function getValue(){
		return $this->value;
	}
	
	# makeQuery("*",5)
	
	public function leftJoinImage($askFor,$order_by,$order,$limit){
		$this->orderBy=$order_by;
		$this->order=$order;
		$this->askFor=$askFor;
		$this->query="SELECT $askFor FROM ".$this->table."
					  LEFT JOIN bilder 
					  ON ".$this->table.".image_id = bilder.id
					  ORDER BY ".$this->table.".$order_by $order
					  LIMIT 0, ".$limit."";
		$this->result = mysql_query($this->query) or die(mysql_error());
	}
	
	public function makeQuery($askFor,$orderBy,$order, $limit){
		$this->orderBy=$orderBy;
		$this->order=$order;
		$this->askFor=$askFor;		
		$this->query="SELECT $askFor FROM ".$this->table."
					  ORDER BY $orderBy $order
					  LIMIT 0, ".$limit."";
		$this->result = mysql_query($this->query) or die(mysql_error());
	}
	
	public function getResultRow($field){
		return @mysql_result($this->result,0,$field);
	}
	
	public function getArray(){
		while($row = mysql_fetch_assoc($this->result)){
			echo '<br/>'.$row['date'];
		}
	}
	
	# Gets rows from $this->table where ƒield = $value ORDER BY $orderBy (field) $order (ASC or DESC)
	
	public function whereQuery($askFor,$field,$value,$orderBy,$order,$limit){
		$this->orderBy=$orderBy;
		$this->order=$order;
		$this->askFor=$askFor;
		$this->field=$field;
		$this->value=$value;
		$this->query="SELECT $askFor FROM ".$this->table."
					  WHERE $field = '$value'
					  ORDER BY $orderBy $order
					  LIMIT 0, $limit";
		$this->result = mysql_query($this->query) or die(mysql_error());
	}
	
	public function whereCustom($askFor,$expression,$orderBy,$order,$limit){
		$this->orderBy=$orderBy;
		$this->order=$order;
		$this->askFor=$askFor;
		$this->field=$field;
		$this->value=$value;
		$this->expression=$expression;
		$this->query="SELECT $askFor FROM ".$this->table."
					  WHERE $expression
					  ORDER BY $orderBy $order
					  LIMIT 0, $limit";
		$this->result = mysql_query($this->query) or die(mysql_error());
	}
	
	public function whereLeftJoinImageQuery($askFor,$field,$value,$orderBy,$order){
		$this->orderBy=$orderBy;
		$this->order=$order;
		$this->askFor=$askFor;
		$this->field=$field;
		$this->value=$value;
		$this->query="SELECT $askFor FROM ".$this->table."
					  LEFT JOIN bilder ON ".$this->table.".image_id = bilder.id
					  WHERE ".$this->table.".$field = '$value'
					  ORDER BY ".$this->table.".$orderBy $order";
		$this->result = mysql_query($this->query) or die(mysql_error());
	}
	
	public function whereAndLeftJoinImageQuery($askFor,$field,$value,$orderBy,$order){
		$this->orderBy=$orderBy;
		$this->order=$order;
		$this->askFor=$askFor;
		$this->field=$field;
		$this->value=$value;
		$this->query="SELECT $askFor FROM ".$this->table."
					  LEFT JOIN bilder ON ".$this->table.".image_id = bilder.id
					  WHERE ".$this->table.".$field = '$value' AND image_id > '0'
					  ORDER BY ".$this->table.".$orderBy $order";
		$this->result = mysql_query($this->query) or die(mysql_error());
	}
	
	public function getNumRows(){
		return mysql_num_rows($this->result);
	}
}
?>