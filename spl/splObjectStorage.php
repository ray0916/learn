<?php

/**
 * spl数据结构demo
 * 对象容器 SplObjectStorage
 *
 */

// 实例化
$obj = new SplObjectStorage();


// addAll(SplObjectStorage $storage)
// 将另一个对象容器的对象数据全部加入到自己的对象中
$o = new StdClass;
$obj_1 = new SplObjectStorage();
$obj_1[$o] = 'hello';


$obj->addAll($obj_1);

//echo $obj[$o]; // hello

// attach(object $object[, mixed $data=null])
// 往对象容器中添加对象
$a1 = new StdClass;
$a2 = new StdClass;
$obj->attach($a1);
$obj->attach($a2, 'class 2');
$obj->attach($a2, array('k1'=>'class 2'));

// detach(object $object)
// 将参数对象从对象容器中分离
$obj->detach($o);// $obj[$o] 报错，找不到对象

// contains(object $object)
// 判断对象容器是否存在该对象
$obj->contains($o); // false


// count()
// 获得映射对象中的对象数量
$obj->count();

// valid()
// 判断对象容器当前指针后面是否有值
$obj->valid();

// key()
// 返回对象容器当前节点的索引
$obj->key();

// setInfo(mixed $data)
//


var_dump($obj[$o]);





