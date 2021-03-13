<?php

namespace app\components\widget;

use app\models\Category;
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
        $this->category = Category::find()->indexBy('id')->asArray()->all();
        $this->treeMenu = $this->getTreeMenu();
        $this->menuHtml = $this->getMenuHtml($this->treeMenu);
        return $this->menuHtml;
    }

    /**
     * @return array
     */
    protected function getTreeMenu(){
        $tree = [];
        foreach($this->category as $id=>&$node){
            if(!$node['parent_id'])
                $tree[$id] = &$node;
            else
                $this->category[$node['parent_id']]['childs'][$node['id']] = &$node;
        }
        return $tree;
    }

    protected function getMenuHtml($tree) {
        $page = '';
        foreach($tree as $category) {
            $page .= $this->catToTemplate($category);
        }
        return $page;
    }

    protected function catToTemplate($category) {
        ob_start(); // буферизирует вывод не выводя на экран
        include __DIR__ . '/menu_tpl/' . $this->template;
        return ob_get_clean();
    }
}