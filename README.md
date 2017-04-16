# yii2-gii-model-auto-generator
批量将数据库中的表自动生成为YII2的AR模型


### 使用方法

#### YII2高级模板
在console/config/main.php中加入
```
'controllerMap' => [
        'auto' => [
            'class' => 'minms\gii\AutoGeneratorController',
            //'yiiPath' => '/path/to/yii',
            //'ns' => 'common\\\\models\\\\base', //生成的类存放位置, 默认common/models/base
            //'db' => 'db', //使用的数据库, 默认db
        ]
    ],
```
执行命令
```
php yii auto
或
./yii auto
```
