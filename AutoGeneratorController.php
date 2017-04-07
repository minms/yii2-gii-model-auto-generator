<?php
/**
 * Created by PhpStorm.
 * User: luckerdj
 * Date: 2017/4/7
 * Time: 下午2:59
 */

namespace minms\gii;

use Yii;
use yii\console\Controller;
use yii\db\Connection;

class AutoGeneratorController extends Controller
{
    /**
     * @var string yii文件所在绝对路径
     */
    public $yiiPath = '../../yii';

    /**
     * @var Connection|string 数据库连接|数据库配置
     */
    public $db = 'db';

    public $ns = 'common\\\\models\\\\base';
    public $useTablePrefix = 1;
    public $generateLabelsFromComments = 1;

    /**
     * 初始化
     */
    public function init()
    {
        if (is_string($this->db)) {
            $this->db = Yii::$app->get($this->db);
        }

        $this->yiiPath = realpath($this->yiiPath);
        parent::init();
    }

    /**
     * 执行命令
     * @return int
     */
    public function actionIndex()
    {
        $output = null;
        $return = null;
        $tables = $this->db->createCommand('show tables')->queryAll();
        if (count($tables) == 0) {
            echo "don't have anything \n";
            return 0;
        }

        foreach ($tables as &$table) {
            $table = current($table);
            $class = str_replace(' ', '', ucwords(str_replace('_', ' ', $table)));
            echo "\n" . 'exec: php ' . $this->yiiPath . ' gii/model --tableName=' . $table . ' --modelClass=' . $class . ' --ns=' . $this->ns . ' '
                . '--useTablePrefix=' . $this->useTablePrefix . ' '
                . '--generateLabelsFromComments=' . $this->generateLabelsFromComments . ' ' . "\n";
            exec('php ' . $this->yiiPath . ' gii/model '
                . '--tableName=' . $table . ' '
                . '--modelClass=' . $class . ' '
                . '--ns=' . $this->ns . ' '
                . '--useTablePrefix=' . $this->useTablePrefix . ' '
                . '--generateLabelsFromComments=' . $this->generateLabelsFromComments . ' '
                . '<<< "ya"', $output, $return);
            foreach ($output as $item) {
                if (empty($item)) {
                    continue;
                }
                echo $item . "\n";
            }

            unset($table, $class, $output, $return);
        }

        echo "generate done!\n";
        return 0;
    }
}