<?php 
class Admin_model extends CI_Model
{
	private $prefix=PREFIX;
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
	public function count_table_dk($table,$col,$dk){
		$sql="SELECT * FROM ".$this->prefix."$table WHERE $col = $dk";
		$query=$this->db->query($sql);
		return $query->num_rows();	
	}
	public function select_table_dk($table,$col,$dk){
		$sql="SELECT * FROM ".$this->prefix."$table WHERE $col $dk";
		$query=$this->db->query($sql);
		return $query->result();	
	}
	public function select_table_dk_col_get($table,$dk,$col_get){
		$sql="SELECT $col_get FROM ".$this->prefix."$table WHERE $dk";
		$query=$this->db->query($sql);
		return $query->result();	
	}
	public function select_table_dk_col_all($table,$dk){
		$sql="SELECT * FROM ".$this->prefix."$table WHERE $dk";
		$query=$this->db->query($sql);
		return $query->result();	
	}
	public function select_table_2dk($table,$col1,$dk1,$col2,$dk2){
		$sql="SELECT * FROM ".$this->prefix."$table WHERE $col1 $dk1 and $col2 $dk2";
		$query=$this->db->query($sql);
		return $query->result();	
	}
	public function checkuser($email,$matkhau,$type){
		$check_md5=$this->md5_system->hsc_md5_password($email,$matkhau);
		$sql="select *from ".$this->prefix."thanhvien where email='$email' and matkhau='$check_md5' and typethanhvien='$type'";
		$query=$this->db->query($sql);
		return $query->num_rows();
	}
	public function get_user_by_email($email,$type){
		$sql="select *from ".$this->prefix."thanhvien where email='$email' ";
		$query=$this->db->query($sql);
		return $query->result();
	}
	public function count_history_table_today($table,$col){
		$sql="SELECT * FROM ".$this->prefix."$table WHERE date($col) = CURDATE()";
		$query=$this->db->query($sql);
		return $query->num_rows();	
	}
	public function getRows($table,$dk,$order_by,$params = array())
    {
        $this->db->select('*');
        $this->db->from($this->prefix.$table);
		$this->db->where($dk);
        $this->db->order_by($order_by,'desc');
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        $query = $this->db->get();
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
    }
	public function select_value_table_dk_col($table,$col,$dk,$col_get){
		$sql="SELECT $col_get FROM ".$this->prefix."$table WHERE $col $dk";
		$query=$this->db->query($sql);
		if($query->result()){
			foreach($query->result() as $row){
				$value=$row->$col_get;
			}
		}else{
			$value='';
		}
		return $value;	
	}		
	public function select_value_table_dk_col_1value($table,$dk,$col_get){	
		$value='';
		$sql="SELECT $col_get FROM ".$this->prefix."$table WHERE $dk";	
		$query=$this->db->query($sql);	
		if($query->result()){
			foreach($query->result() as $row){	
				$value=$row->$col_get;
			}		
		}
		return $value;		
	}
	public function count_table_dk_cus($table,$dk){
		$sql="SELECT * FROM ".$this->prefix."$table WHERE $dk";
		$query=$this->db->query($sql);
		return $query->num_rows();	
	}
}