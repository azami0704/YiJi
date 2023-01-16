<?php
session_start();
date_default_timezone_set("Asia/Taipei");
$dns = "mysql:local=localhost;charset=utf8;dbname=db201";
$pdo = new PDO($dns, 'root', '');

class DB
{
    protected $dns = "mysql:local=localhost;charset=utf8;dbname=db201";
    protected $pdo;
    protected $table;
    public $type=[
            1=>"健康新知",
            2=>"菸害防治",
            3=>"癌症防治",
            4=>"慢性病防治"
            ];

    public function __construct($table)
    {
        $this->table = $table;
        $this->pdo = new PDO($this->dns, 'root', '');
    }

    public function find($id)
    {
        $sql = "SELECT * FROM `$this->table`";
        if (is_array($id)) {
            $sql .= " WHERE " . join(" AND ", $this->arrToSql($id));
        } else {
            $sql .= " WHERE `id`='$id'";
        }
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
    public function all(...$args)
    {
        $sql = "SELECT * FROM `$this->table`";
        if (isset($args[0])) {
            if (is_array($args[0])) {
                $sql .= " WHERE " . join(" AND ", $this->arrToSql($args[0]));
            } else {
                $sql .= $args[0];
            }
        }
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function save($data, ...$id)
    {
        if (isset($id[0])) {
            $sql = "UPDATE `$this->table` SET ";
            $sql .= join(" , ", $this->arrToSql($data));
            if (is_array($id[0])) {
                $sql .= " WHERE " . join(" AND ", $this->arrToSql($id[0]));
            } else {
                $sql .= " WHERE `id`='$id[0]'";
            }
        } else {
            $sql = "INSERT INTO `$this->table` ";
            $key = array_keys($data);
            $sql .= "(`" . join("`,`", $key) . "`) VALUES ('" . join("','", $data) . "')";
        }
        // return $sql;
        return $this->pdo->exec($sql);
    }
    public function del($id)
    {
        $sql = "DELETE FROM `$this->table`";
        if (is_array($id)) {
            $sql .= " WHERE " . join(" AND ", $this->arrToSql($id));
        } else {
            $sql .= " WHERE `id`='$id'";
        }
        return $this->pdo->exec($sql);
    }
    public function count($arg)
    {
        return $this->mathSql('COUNT', '*', $arg);
    }
    public function sum($col, $arg)
    {
        return $this->mathSql('SUM', $col, $arg);
    }
    public function avg($col, $arg)
    {
        return round($this->mathSql('AVG', $col, $arg), 2);
    }
    public function min($col, $arg)
    {
        return $this->mathSql('MIN', $col, $arg);
    }
    public function max($col, $arg)
    {
        return $this->mathSql('MAX', $col, $arg);
    }
    private function arrToSql($arr)
    {
        $res = [];
        foreach ($arr as $key => $value) {
            $res[] = "`$key`='$value'";
        }
        return $res;
    }

    private function mathSql($method, $col, $arg)
    {
        $sql = "SELECT $method($col) FROM `$this->table`";
        if (is_array($arg)) {
            $sql .= " WHERE " . join(" AND ", $this->arrToSql($arg));
        } else if ($arg != 1) {
            $sql .= $arg;
        }
        return $this->pdo->query($sql)->fetchColumn();
    }
}

function q($sql)
{
    global $pdo;
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function to($url)
{
    header("location:" . $url);
}

$Po = new DB('po');
$News = new DB('news');
$Pop = new DB('pop');
$Know = new DB('know');
$Que = new DB('que');
$User = new DB('user');
$Total = new DB('total');
$Log= new DB('log');

if (!isset($_SESSION['visited'])) {
    $_SESSION['visited'] = true;
    $todayTotal = $Total->find(['date' => date("Y-m-d")]);
    if (empty($todayTotal)) {
        $Total->save(['date' => date("Y-m-d"), 'total' => 1]);
    } else {
        $Total->save(['total' => $todayTotal['total'] + 1], $todayTotal['id']);
    }
}


