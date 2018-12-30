<?php 

namespace InfoMail\Database;

use InfoMail\Config\PdoSetting;

// include_once 'infomail/Config/PdoSetting.php';
include_once '../../Config/PdoSetting.php';

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
            $val[$row['terminal_id']] = $row['disp_name'];
            // $val[] = $row['terminal_id'];
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
    // 要修正
    public function setOids($val='')
    {
        if (!$this->isAdmin()) {return false;}
        if ($val=='') {
            $sql = 'select * from out_date where out_date = curdate() AND in_out = "1";';
        } else {
            $sql = 'select * from out_date where out_date = "' . $val . '" AND in_out = "1";';   
        }
        $db = $this->getDb();
        $stmt = $db->query($sql);
        $return = array();
        while ($row = $stmt->fetch()) {
            $return[] = $row['terminal_id'];
        }
        $this->oids = $return;
        return true;
    }
    /**
     * @return array|bool
     */
    public function getOids($val='')
    {
        if (!$this->isAdmin()) {return false;}
        $this->setOids($val);
        return $this->oids;    
    }
    /**
     * メールコンテンツをDBに登録する（挿入文）
     *
     * @var bool isToAll
     * @var string title
     * @var string body
     * @return bool
     */
    public function insertMail($isToAll,$title,$body)
    {
        if (!$this->isAdmin()) {return false;}
        if ($isToAll) {$isToAll='1';}
        if (!$isToAll) {$isToAll='0';}
        $sql = 'INSERT INTO mail_for_crew (datetime,for_all,title,body) VALUES (now(),"' . $isToAll . '","' . $title . '","' . $body . '");';
        // return $sql;
        /*
         * except as below ...
        INSERT INTO mail_for_crew (
            datetime,
            for_all,
            title,body
        ) VALUES (
            now(),
            '1',
            'title...',
            'body...'
        );
         */
        $db = $this->getDb();
        $stmt = $db->query($sql);
        return true;
    }
    /**
     * 今日のメールを取得する（件名、時刻）
     */
     public function getTodayMails()
     {
        $sql = 'SELECT id, title, datetime FROM mail_for_crew WHERE datetime > curdate();';
        // SELECT title, body FROM mail_for_crew curdate() < datetime;
        $db = $this->getDb();
        $stmt = $db->query($sql);
        $return = array();
        // $return = array('test_title','test_body');
        while ($row = $stmt->fetch()) {
            $return[$row['id']
        ] = array(
            'title' => $row['title'],
            'time' => date('H:i',strtotime($row['datetime'])));
        }
        return $return;
     }
    /**
     * 昨日以前のメールを、n件目からm件分取得する（件名、時刻）
     * 
     * @var int page
     * @var string visibility
     * @return array|bool
     */
    public function getArchieves($page,$val=true)
    {
        $contents_on_a_page = 20;
        // SELECT * FROM mail_for_crew WHERE datetime < curdate() ORDER BY id DESC LIMIT 20 OFFSET 20;
        // SELECT * FROM mail_for_crew WHERE datetime < curdate() for_all = '1' ORDER BY id DESC LIMIT 20 OFFSET 20;
        if ($val) {
            $sql = 'SELECT id, title, datetime FROM mail_for_crew WHERE datetime < curdate() AND for_all = "1" ORDER BY id DESC LIMIT ' . $contents_on_a_page . ' OFFSET ' . ($page-1)*$contents_on_a_page . ';';
        } else {
            if (!$this->isAdmin()) {return false;}
            $sql = 'SELECT id, title, datetime FROM mail_for_crew WHERE datetime < curdate() ORDER BY id DESC LIMIT ' . $contents_on_a_page . ' OFFSET ' . ($page-1)*$contents_on_a_page . ';';
        }
        $db = $this->getDb();
        $stmt = $db->query($sql);
        $return = array();
        while ($row = $stmt->fetch()) {
            $return[$row['id']] = array(
                'title' => $row['title'],
                'date' => date('Y/m/d',strtotime($row['datetime']))
            );
        }
        return $return;
    }
    /**
     * idからメールを取得する（件名、日時、本文）
     * 
     * @var string content-id
     */
    public function getMailContet($id)
    {
        // if (!$this->isAdmin()) {return false;}
        $sql = 'SELECT title, datetime, body FROM mail_for_crew WHERE id = "' . $id . '";';
        $db = $this->getDb();
        $stmt = $db->query($sql);
        $return = array();
        while ($row = $stmt->fetch()) {
            $return['title'] = $row['title'];
            $return['date'] = date('Y/m/d',strtotime($row['datetime']));
            $return['time'] = date('H:i',strtotime($row['datetime']));
            $return['body'] = $row['body'];
        }
        return $return;
    }
}
