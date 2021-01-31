<?php
//$this->title = 'Title Show Page !';
//?>



<h2>Переключение шаблона show</h2>

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