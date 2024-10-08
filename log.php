<?php 
require_once('dbconnection.php');
define('LOGNAME','access_log');
class Logger
{
	private $_dbconnection;
	private $_db;
	public function __construct()
	{
		$this->_dbconnection=DBConnection::instatiate();
		$this->_collection=$this->_dbconnection->getCollection(LOGNAME);
	}
	public function logRequest($data=array())
	{
		$request=array();
		$request['page']=$_SERVER['SCRIPT_NAME'];
		$request['viewed_at']=new MongoDate($_SERVER['REQUEST_NAME']);
		$request['ip_address']=$_SERVER['REMOTE_ADDR'];
		$request['user_agent']=$_SERVER['HTTP_USER_AGENT'];
		if(!empty($_SERVER['QUERY_STRING']))
		{
				$params=array();
				foreach(explode('&',$_SERVER['QUERY_STRING'])as $parameter)
				{
					list($key,$value)=explode('=',$parameter);
					$params[$key]=$value;
				}
				$request['query_params']=$params;
		}
		if(!empty($data))
		{
			$request=array_merge($request,$data);
		}
		$this->_collection->insert($request);
	}
}

		