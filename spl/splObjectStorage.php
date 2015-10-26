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

// rewind()
// 返回并指向第一个节点元素
$obj->rewind();


// setInfo(mixed $data)
// 给当前节点赋值。必须是调用rewind后，才可以用setInfo赋值，否则找不到对象。
$obj->setInfo('AAA');

// getInfo()
// 获得当前节点的值。也必须是调用rewind后，才可以调用getInfo。
$obj->getInfo();

// current()
// 获得当前节点对象
$obj->current();

// getHash()
// 获得参数的hash值
$obj->getHash($a2);

// next()
// 指针移到下一个节点
$obj->next();

// offsetExists
// 判断对象容器中是否存在该对象
$obj->offsetExists($a2);

// offsetSet()
// 给对象容器中的某个对象设置值
$obj->offsetSet($a2, 'BBB');

// offsetGet()
// 获得对象容器中的某个针对象对应的值
$obj->offsetGet($a2);

// offsetUnset()
// 将某节点删除
//$obj->offsetUnset($a1);


// serialize()
// 将对象容器序列化
$serialize_obj = $obj->serialize();

// unserialize()
// 将对象容器反序列化
$obj_2 = new SplObjectStorage();
$obj_2->unserialize($serialize_obj);

var_dump($obj_2);





