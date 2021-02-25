<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\View;
use yii\web\AssetBundle;

/**
 * подключение скриптов
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class IEAppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
         'js/html5shiv.js',
         'js/respond.min.js',
    ];

    public $lsOptions = [
        'condition' => 'lte IE9',
        'position' => View::POS_HEAD,
    ];
}
