<?php

namespace app\components\widget;

use app\models\Category;
use Yii;
use yii\base\Widget;

class MenuWidget extends Widget
{
    public $template;
    public $category;
    public $treeMenu;
    public $menuHtml;

    public function init()
    {
        parent::init();

        if( $this->template === null ) {
            $this->template = 'menu';
        }
        $this->template .= '.php';
    }

    public function run()
    {
        // get cache берём меню из кеша
        $menu = Yii::$app->cache->get('menu');
        if ($menu) return $menu;

        $this->category = Category::find()->indexBy('id')->asArray()->all();
        $this->treeMenu = $this->getTreeMenu();
        $this->menuHtml = $this->getMenuHtml($this->treeMenu);

        //set cache запись меню в кеш, хронится в папке runtime
        Yii::$app->cache->set('menu', $this->menuHtml, 60);
        return $this->menuHtml;
    }

    /**
     * Отрисовка вложенного меню
     *
     * @return array
     */
    protected function getTreeMenu(){
        $tree = [];
        foreach( $this->category as $id=>&$node ){
            if( !$node['parent_id'] )
                $tree[$id] = &$node;
            else
                $this->category[$node['parent_id']]['childs'][$node['id']] = &$node;
        }
        return $tree;
    }

    /**
     * Перебираем массив для отрисовки
     *
     * @param array $treeMenu вложенный массив
     * @return string
     */
    protected function getMenuHtml( $treeMenu ) {
        $page = '';
        foreach( $treeMenu as $category ) {
            $page .= $this->catToTemplate( $category );
        }
        return $page;
    }

    /**
     * Принимает каждый переданный элемент и помещает его в шаблон
     *
     * @param $category
     * @return false|string
     */
    protected function catToTemplate( $category ) {
        ob_start(); // буферизирует вывод не выводя на экран
        include __DIR__ . '/menu_tpl/' . $this->template;
        return ob_get_clean();
    }
}