<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/16 0016
 * Time: ���� 12:58
 */

namespace oblood\core;


class App extends Object{

    /**
     * ��ܿ�ʼ����
     */
    public static function run() {



        //�Զ�����
        spl_autoload_register('\oblood\core\App::autoload');

        //�������..... �Թ�

        //�쳣����..... �Թ�

        //��ȡȫ�����������Ŀ������

        //����������

        //���������

        new Test();

    }


    /**
     * ����Զ�����
     * �Զ����ع����Կռ�����Ϊ�ʼ�·��������
     * ���� \oblood\core\App   ,�Զ����ص��ļ�·��Ϊ�� {BASE_ROOT}/oblood/core/App.php
     * @param $class
     */
    public static function autoload($class) {

        $classArray = explode('\\' , $class);

        $classPath = BASE_ROOT . '/' . implode('/' , $classArray) . '.php';

        if(!in_array($classPath , get_required_files())) {
            if(is_file($classPath)) {
                require_once $classPath;
            }
        }
    }
}