<?php
//$this->title = 'Title Show Page !';
use app\components\MyWidget;
?>



<h2>Переключение шаблона show</h2>
<!--ВЫВОД ВИДЖЕТА-->
<?php
//echo MyWidget::widget( ['name' => 'Вася'] );
//echo MyWidget::widget(); //параметр по умолчанию
?>
<!--ЭКРАНИПУЕМ КРНТЕНТ-->
<?php MyWidget::begin();?>
<h1>Новый текст!</h1>
<?php MyWidget::end(); ?>

<?php //var_dump( $dat );?>
<?php //echo count( $dat->products ); //отложенная загрузка?>
<?php //var_dump( $dat );?>
<?php
//foreach( $dat as $data ){
//    echo '<ul>';
//        echo '<li>' . $data->title . '</li>';
//    $products = $data->products;
//    foreach($products as $product){
//        echo '<ul>';
//            echo '<li>' . $product->title . '</li>';
//        echo '</ul>';
//    }
//    echo '</ul>';
//}
?>

<button class="btn btn-success" id="btn">I Button</button>

<!--подключение скрипта отдельному файлу, с добавлением зависимотей-->
<?php //$this->registerJsFile( '@web/js/script.js', ['depends' => 'yii\web\YiiAsset'] )?>

<!--подключение небольших частей js кода-->
<?php //$this->registerJs( "console.log('Script page!')", \yii\web\View::POS_LOAD ) ?>

<!--добавление стилей напрямую к странице-->
<?php //$this->registerCss( '.container { background: #ccc }' ) ?>


<?php
$js = <<<JS
    $('#btn').on('click', function (){
        $.ajax({
            url: 'index.php?r=start/index',
            type: 'POST',
            data: {test: '123'},
            // data: data,
            success: function ( res ){
                console.log( res );
            },
            error: function (){
                alert( 'Error!' );
            }
        });
        return false;
    })
JS;

$this->registerJs( $js );