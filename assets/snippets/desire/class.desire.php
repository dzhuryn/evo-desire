<?php


class desire
{
    protected $storage = 'cookies';
    protected $key = 'desire';
    protected $items = array();
    protected $time;
    protected $userId;
    protected $modx;
    protected $table;

    //при старте получаем список из хранилиа (куки, ...)
    public function __construct($storage,$modx)
    {
        $this->modx = $modx;
        $this->storage = $storage;
        if(empty($_SESSION['webInternalKey'])){
            return 'empty webInternalKey';
        }
        else{
            $this->userId = $_SESSION['webInternalKey'];
        }
        $this->table = $this->modx->getFullTableName('desire');
        $this->time = time()+86400*30;



        switch ($this->storage){
            case 'cookies':
                if(!empty($_COOKIE[$this->key])){
                    $this->items = $_COOKIE[$this->key];
                }
                break;

            case 'database':
                $sql = "select `items` from ".$this->table.' where userId='.$this->userId;
                $q = $this->modx->db->query($sql);
                $res = $this->modx->db->getValue($sql);
                if(!empty($res)){
                    $this->items = $res;
                }

                break;
        }
        if(!empty($this->items)){
            $this->items = json_decode($this->items,true);
        }
    }
    // получаем список товаров через ','
    public function getItems(){

        $ids = '';
        if(!empty($this->items) && is_array($this->items)){
            $ids = implode(',',$this->items);
        }
        return $ids;
    }

    //добавляем елемент
    public function addItem($id)
    {
        $this->items[$id]=$id;
        $this->save();
    }

    //удаляем елемент
    public function deleteItem($id)
    {


        if(isset($this->items[$id])){
            unset($this->items[$id]);
            $this->save();
        }
    }

    //сохраняем список в хранилище
    public function save()
    {
        $this->items = json_encode($this->items);
        switch ($this->storage){
            case 'cookies':
                setcookie ($this->key, $this->items,$this->time);
                break;
            case 'database':
                $sql = "select `id` from ".$this->table.' where userId='.$this->userId;
                $q = $this->modx->db->query($sql);
                $id = $this->modx->db->getValue($sql);
                $fields = [
                    'userId'=>$this->userId,
                    'items'=>$this->items,
                ];
                if(!empty($id)){
                    $this->modx->db->update( $fields, $this->table, 'id = "' . $id . '"' );
                }
                else{
                    $this->modx->db->insert( $fields, $this->table);
                }

                break;
        }
    }
    //проверяем ести ль id в списке товаров
    public function inDesire($id)
    {
        if(empty($this->items[$id])){
            return 0;
        }
        else{
            return 1;
        }
    }
}