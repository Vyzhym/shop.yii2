<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 04.02.2018
 * Time: 15:51
 */
namespace app\components;
use app\models\Category;
use Symfony\Component\DomCrawler\Tests\Field\InputFormFieldTest;
use yii\base\Widget;
use Yii;
class MenuWidget extends Widget{
    public $tpl;
    public $data;//массив всех категорий
    public $tree;
    public $menuHtml;


    public function init(){
        parent::init();
        if($this->tpl === null){
            $this->tpl === 'menu';
        }
        $this->tpl.='.php';
    }

    public function run(){
        //get cache
        $menu = Yii::$app->cache->get('menu');
        if ($menu) return $menu;
        $this->data = Category::find()->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);
        //set cache
        Yii::$app->cache->set('menu', $this->menuHtml, 60);


        return $this->menuHtml;
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

    protected function getMenuHtml($tree)
    {
    $str = '';
        foreach ($tree as $category) {
            $str .= $this->catToTemplate($category);
        }
        return $str;
    }

    protected function catToTemplate ($category)
    {
        ob_start();
        include __DIR__ . '/menu_tpl/'.$this->tpl ;
        return ob_get_clean();
    }

} 