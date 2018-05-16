<?php namespace SkyOJ\Core;

final class SkyOJ
{
    public $cache_pool;
    private $m_user;
    private $m_router;

    public function __construct()
    {
        global $_E,$_G,$_config;

        $db = $_config['db'];
        \SkyOJ\Core\Database\DB::$prefix = $db['tablepre'];
        \SkyOJ\Core\Database\DB::initialize($db['query_string'], $db['dbuser'], $db['dbpassword'],$db['dbname']);
        \SkyOJ\Core\Database\DB::query('SET NAMES UTF8');

        \LOG::intro();
        \userControl::intro();

        $this->User = new \SkyOJ\Core\User\User();
        if( !$this->User->load($_G['uid']) )
        {
            if( !$this->User->loadByData(\SkyOJ\Core\User\User::getGuestData()) )
            {
                die('INIT ERROR'); #TODO;
            }
        }

        $this->m_user = $this->User;
        $this->applyRouter();
    }

    public function applyRouter()
    {
        $this->m_router = new Router\Router();
        $this->m_router->addRouter('GET','/ping',[['string','text']],'\\SkyOJ\\API\\Ping');
    }

    public function getCurrentUser()
    {
        return $this->m_user;
    }

    public function run()
    {
        $res = $this->m_router->run($this);
        $json = [
            "code" => 1,
            "uid"  => $this->getCurrentUser()->uid,
            "data"=> $res,
        ];
        die( json_encode($json) );
    }
}