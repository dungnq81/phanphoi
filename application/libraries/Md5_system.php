<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Md5_system
{
	private $ham='';
	public function __construct(){}
	public function __destruct(){}
	public function hsc_md5_password($password,$email)
	{
		$s1=md5(md5(md5(md5(md5($password)))));$s2=substr(md5($s1),0,2);
		$s3=md5((md5($s1)).$s2);$s4=strlen($email);
		$this->ham=md5((md5($email.$s3)).$s4);
		return $this->ham;
	}
	public function hsc_md5_reg($id)
	{
		$this->ham=md5(md5($id));
		return $this->ham;
	}
}
?>