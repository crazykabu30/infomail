<?php 

namespace InfoMail\Database;

use InfoMail\Config\PdoSetting;

include_once 'infomail/Config/PdoSetting.php';

class MailDb
{
    /**
     * pdo_dns
     *
     * @var string
     */
    protected $pdo;
    /**
     * dbuser
     *
     * @var string
     */
    protected $user;
    /**
     * dbpass
     *
     * @var string
     */
    protected $pass;
    /**
     * ['admin'=>true,'crew'=>true]
     *
     * @var array
     */
    protected $acls;
    /**
     * 'admin'|'crew'
     *
     * @var string
     */
    protected $acl;
    /**
     * db-object
     * 
     * @var object
     */
    protected $db;
    /**
     * ['name'=>tid, ...]
     *
     * @var array
     */
    protected $terminals;
    /**
     * oids
     *
     * @var array
     */
    protected $oids;
    /**
     * object init
     */
	public function __construct ()
	{
		$class = new PdoSetting();
		$settings = $class->getConfig();
		$this->pdo = $settings['pdo'];
		$this->user = $settings['user'];
		$this->pass = $settings['pass'];
        $this->setDb();
        $this->acls = array('crew'=>true,'admin'=>true);
        $this->setAcl();
	}
    /**
     * @return bool
     */
    protected function setDb()
    {
        try {
            $pdo = $this->pdo;
            $user = $this->user;
            $pass = $this->pass;
            $this->db = new \PDO($pdo,$user,$pass);
            return true;
        } catch(PDOException $e) {
            echo  'db接続エラー: ' . $e->getMessage();
            exit;
        }
    }
    /**
     * @return object|bool
     */
    protected function getDb()
    {
        if (!isset($this->db)) {
            if ($this->setDb()) {
                return false;
            }
        }
        return $this->db;
    }
    /** 
     * @param string admin|crew
     */
    public function setAcl($val='crew')
    {
        if (!$this->isValidAcl($val)) {$val='crew';}
        $this->acl = $val;
    }
    /** 
     * @param string admin|crew
     * @return bool
     */
    protected function isValidAcl($val)
    {
        return isset($this->acls[$val]);
    }
    /** 
     * @return bool
     */
    public function isAdmin()
    {
        if ($this->acl==='admin') {return true;}
        return false;
    }
    /**
    * @return bool
    */
    protected function setTerminals()
    {
        $sql = 'select * from terminals;';
        $db = $this->getDb();
        $stmt = $db->query($sql);
        $val = array();
        while ($row = $stmt->fetch()) {
            // $val[$row['terminal_id']] = $row['name'];
            $val[] = $row['terminal_id'];
        }
        $this->terminals = $val;
    }
    /**
     * @return array|bool [tid]=>disp-name|false
     */
	public function getTerminals()
	{
        if (!$this->isAdmin()) {return false;}
        if (!isset($this->terminals)) {
            if ($this->setTerminals()) {
                return false;
            }
        }
        return $this->terminals;
	}
    /**
     * @return bool
     */
    public function setOids()
    {
        if (!$this->isAdmin()) {return false;}
        $sql = 'select * from out_date where out_date = curdate() AND in_out = "1";';
        $db = $this->getDb();
        $stmt = $db->query($sql);
        $val = array();
        while ($row = $stmt->fetch()) {
            $val[] = $row['terminal_id'];
        }
        return $this->oid = $val;
    }
    /**
     * @return array|bool
     */
    public function getOids()
    {
        if (!$this->isAdmin()) {return false;}
        if (!isset($this->oids)) {
            if ($this->setOids()) {
                return false;
            }
        }
        return $this->oids;
    }
}
