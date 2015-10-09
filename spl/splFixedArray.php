<?php

/**
 * spl数据结构demo
 * 阵列 SplFixedArray
 *
 */

// 定义一个长度为5的阵列
$array = new SplFixedArray(5);

$array[1] = 2;
$array[3] = 'value2';


// count()
// 阵列长度
$array->count();

// key()
// 获得当前节点的索引
$array->key();

// valid()
// 判断是否还存在值
$array->valid();

// rewind()
// 回到初始节点
$array->rewind();

// current()
// 获得当前节点
$array->current();

// next()
// 指针移动到下一个节点
$array->next();

// setSize(int $size)
// 重新设置阵列数组的大小
$array->setSize(10);

// getSize()
// 获得阵列数组的大小
$array->getSize();

// offsetExists(int $index)
// 判断该索引是否存在值，返回boolean
$array->offsetExists(3);

// offsetGet(int $index)
// 获得该索引对应的值
$array->offsetGet(3);

// offsetSet(int $index, mixed $value)
// 设置该索引对应的值
$array->offsetSet(6, 'value3');

// offsetUnset(int $index)
// 删除该索引对应的值
$array->offsetUnset(6);


// toArray()
// 将阵列转化成php数组
// output: Array ( [0] => [1] => 2 [2] => [3] => value2 [4] => [5] => [6] => [7] => [8] => [9] => )

$php_array = $array->toArray();

// fromArray($php_array)
// 将php数组转化成阵列
// output: SplFixedArray Object ( [0] => [1] => 2 [2] => [3] => value2 [4] => [5] => [6] => [7] => [8] => [9] => )
$spl_array = SplFixedArray::fromArray($php_array);





















