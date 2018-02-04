<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 04.02.2018
 * Time: 15:51
 */
namespace app\components;
use app\models\Category;
use yii\base\Widget;
class MenuWidget extends Widget{
    public $tpl;
    public $data;//массив всех категорий
    public $tree;
    public $menuHTML;


    public function init(){
        parent::init();
        if($this->tpl === null){
            $this->tpl === 'menu';
        }
        $this->tpl.='.php';
    }

    public function run(){
        $this->data = Category::find()->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        debug($this->tree);
        return $this->tpl;
    }





    protected function getTree()
    {
        $tree = [];
        foreach ($this->data as $id => &$node) {
            if (!$node['parent_id'])
                $tree[$id] = &$node;
            else
                $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
        }
        return $tree;
    }

} 