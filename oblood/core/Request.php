<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/16 0016
 * Time: ���� 3:08
 */

namespace oblood\core;


class Request extends Object{

    /**
     * ��ȡ�������
     * @param $name
     * @return string
     */
    public function getParameter($name) {}

    /**
     * ��ȡȫ�����������
     * ��Ϊû�������������Կ��ܻ���� String[]�����
     * @return array
     */
    public function getParameters(){}

    /**
     * �����������
     * @param $name
     * @param $value
     */
    public function setParameter($name , $value) {}

    /**
     * ���������ַ�
     * ��$_GET��$_POST��������е������ַ����˵�
     */
    private function filterSensitiveCharacters() {

    }

}