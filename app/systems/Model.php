<?php declare(strict_types=1);

namespace Systems;
use PDO;

class Model
{
	protected object $db;
	protected array $bindValue = [];
	protected string $select = '*';
	protected string $table = '';
	protected string $join = '';
	protected string $where = '';
	protected string $order = '';
	protected string $limit = '';
	
	function __construct()
	{
		$this->db = new Database();
		// $this->db = Singleton::getInstance();
	}

	public function select(string $data)
	{
		$this->select = $data;
		return $this;
	}

	public function table(string $table)
	{
		// $this->tab = $table;
		$this->table = $table;
		return $this;
	}

	public function join(string $table, string $key, string $val)
	{
	    $this->join = " INNER JOIN {$table} ON {$key} = {$val}";
	    return $this;
	}

	public function where(string $key, string|int|null $val)
	{
		$where = (empty($this->where)) ? "WHERE" : "AND" ;
		$this->where .= " {$where} {$key} = :{$key}";
		$this->bindValue = array_merge($this->bindValue, [$key => $val]);
		return $this;
	}

	public function find(int $id, string $fetch='')
	{
		$this->where('id', $id);
		return $this->get('single', $fetch);
	}

	public function orWhere(string $key, string|int|null $val)
	{
		$this->where .= " OR $key = :$key";
		$this->bindValue = array_merge($this->bindValue, [$key => $val]);
		return $this;
	}

	public function notWhere(string $key, string|int|null $val)
	{
		$where = (empty($this->notWhere)) ? "AND" : "WHERE";
		$this->where .= " $where NOT $key = :$key";
		$this->bindValue = array_merge($this->bindValue, [$key => $val]);
		return $this;
	}

	public function null(string $key)
	{
		$where = (empty($this->where)) ? "WHERE" : "AND" ;
		$this->where .= " {$where} {$key} IS NULL";
		return $this;
	}
	public function notNull(string $key)
	{
		$where = (empty($this->where)) ? "WHERE" : "AND" ;
		$this->where .= " {$where} {$key} IS NOT NULL";
		return $this;
	}

	// like('title', '%'.$value.'%')
	public function like(string $key, string|null $val)
	{
		$like = (empty($this->where)) ? "WHERE" : "AND" ;
		$this->where .= " {$like} {$key} LIKE :{$key}";
		$this->bindValue = array_merge($this->bindValue, [$key => $val]);
		return $this;
	}

	public function orLike(string $key, string|null $val)
	{
		$this->where .= " OR {$key} LIKE :{$key}";
		$this->bindValue = array_merge($this->bindValue, [$key => $val]);
		return $this;
	}

	public function joinWhere(string $key, string|null $val)
	{
		$where = (empty($this->where)) ? "WHERE" : "AND" ;
		$this->where .= " {$where} {$key} = {$val}";
		return $this;
	}

	public function orJoinWhere(string $key, string|null $val)
	{
		$this->where .= " OR {$key} = {$val}";
		return $this;
	}
	public function order(string $order='')
	{
		$this->order = !empty($order) ? " ORDER BY {$order}" : "";
		return $this;

	}

	public function limit(int $start, int $end=0)
	{
		// $end = (empty($end)) ? '' : ', '.$end;
		// $this->limit = " LIMIT {$start}{$end}";
		$this->limit = " LIMIT {$end} OFFSET {$start}";
		return $this;
	}

	public function get(string $type='', string $fetch='')
	{
		$select = "SELECT {$this->select} FROM {$this->table}{$this->join}{$this->where}{$this->order}{$this->limit}";
		// pr($select);
		$query = $this->db->pdo->prepare($select);
		if (!empty($this->bindValue)) {
			foreach ($this->bindValue as $k => $v) {
				$query->bindValue(":$k", $v);
			}
		}
		$query->execute();
		$fetch = ($fetch == 'object') ? PDO::FETCH_OBJ : PDO::FETCH_ASSOC ;

		// PHP >= 8.0
		$row = match ($type) {
			'' => ($query->rowCount() > 0)? $query->fetchAll($fetch) : '',
			'all' => $query->fetchAll(),
			'single' => $query->fetch($fetch),
			'count' => $query->rowCount(),
			default => '',
		};

		// PHP < 8.0
		// switch ($type) {
		// 	case '':
		// 		$row = ($query->rowCount() > 0)? $query->fetchAll($fetch) : '';
		// 		break;
		// 	case 'single':
		// 		$row = $query->fetch($fetch);
		// 		break;
		// 	case 'count':
		// 		$row = $query->rowCount(); //rowCount Not Working All Database
		// 		break;
		// 	case 'all':
		// 		$row = $query->fetchAll(); //rowCount Not Working All Database
		// 		break;				
		// 	default:
		// 		$row = '';
		// 		break;
		// }
		$this->emptyProperty();
		return !empty($row)?$row:false;
		
	}
	
	public function insert(array $data = [], string $lastid = '')
	{
		if (!empty($data)) {
			$keys = '';
			$values = '';

			$keys .= implode(',', array_keys($data));
			$values .= ":".implode(', :', array_keys($data));
			$sql = "INSERT INTO ".$this->table." (".$keys.") VALUES (".$values.")";

			$query = $this->db->pdo->prepare($sql);
			foreach ($data as $key => $value) {
				$query->bindValue(":$key", $value);
			}
			$result = $query->execute();
			if (!empty($lastid)) {
				$result = $this->db->pdo->lastInsertId();
			}
			$this->emptyProperty();
			return $result;
		}
	}

	public function updateOrInsert(array $data)
	{
		if ($this->get('single')) {
			$this->update($data);
		}else{
			$this->insert($data, 'id');
		}
	}

	public function update(array $data = [])
	{
		if (!empty($data)) {
			$keyvalue = '';
			$i=0;
			foreach ($data as $key => $value) {
				$add = ($i > 0) ? ', ' : '';
				$keyvalue .= "{$add}{$key} = :{$key}"; 
				$i++;
			}
			$sql = "UPDATE {$this->table} SET {$keyvalue}{$this->where}";
			$query = $this->db->pdo->prepare($sql);
			foreach ($data as $k => $v) {
				$query->bindValue(":$k", $v);
			}
			foreach ($this->bindValue as $k => $v) {
				$query->bindValue(":$k", $v);
			}
			$update = $query->execute();
			$this->emptyProperty();
			return $update;

			//return $update?$query->rowCount():false; 
			//When You Not Change Update Value It Shuld be return false
		}else{
			return false;
		}

	}

	public function delete(int $id = null)
	{
		is_null($id) ?: $this->where('id', $id);
		$sql = "DELETE FROM {$this->table}{$this->where}";
		$query = $this->db->pdo->prepare($sql);
		
		foreach ($this->bindValue as $k => $v) {
			$query->bindValue(":$k", $v);
		}

		$result = $query->execute();
		$this->emptyProperty();
		return $result ? true : false;

	}

	public function emptyProperty()
	{
		$this->bindValue = [];
		$this->select = '*';
		$this->join = $this->where = $this->order = $this->limit = '';
		// $this->table = '';
		return;
	}
	
}
?>