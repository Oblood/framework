<?php
use \oblood\library\Web;

/**
 * $option = [
 *      'controller' => '..',
 *      'action'     => '..',
 *      'initAttribute' => [],
 *      'template'   => '..'   优先级最高
 * ]
 */


Web::get('/', ['template' => 'index.php']);
