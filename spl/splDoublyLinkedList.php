<?php

/**
 * spl数据结构demo
 * 双向链表 SplDoublyLinkedList
 * 栈SplStack
 * 队列SplQueue
 *
 * 栈和队列都是继承于双向链表，所以，所有双向链表的方法都可以被栈和队列使用。调用方法也一致。
 */

$list = new SplDoublyLinkedList();

// push($value)
// 在结尾插入一个新值
$list->push('value1');
$list->push('value2');
$list->push('value3');
$list->push('value4');
$list->push('value5');

// pop()
// 抛出结尾的一个元素，会使得链表结构减少一个
$list->pop();

// key()
// 获得当前节点的索引值
$list->key();

// count()
// 获得链表的数量
$list->count();

// rewind()
// 将指针返回至初始节点
$list->rewind();

// current()
// 获得当前节点
$list->current();

// top()
// 返回最后一个节点的值
$list->top();

// bottom()
// 返回第一个节点的值
$list->bottom();

// next()
// 指针移到下一个节点
$list->next();

// prev()
// 指针移到上一个节点, 如果原本指针在第一个，那么前一个节点为-1，并且将无法获得当前值
$list->prev();

// valid()
// 判断该链表是否有更多的值，返回bool
$list->valid();

// isEmpty()
// 判断该链表是否为空链表，返回bool
$list->isEmpty();

// offsetExists($index)
// 判断参索引是否存在，返回bool
$list->offsetExists(2);

// offsetGet($index)
// 返回参数索引的节点值
$list->offsetGet(2);

// offsetSet($index, $newValue)
// 设置参数索引的节点值, $index必须在链表的键范围中。
// 当一个节点用offsetUnset删掉时时，并不能用offsetSet重新给已删掉的节点设置值，只能对当前可见的节点的值进行修改
$list->offsetSet(3, 'value6');

// offsetUnset($index)
// 删除参数索引的节点
$list->offsetUnset(3);

// add($index, $value);
// 对指定的索引新增一个新值。 当一个节点用offsetUnset时，并没有直接删除，该节点还仍然会保存在内存中。用add可以重新给该节点设置值
$list->add(3, 'first');

// unshift($value)
// 在链表的开始节点插入value作为新的开始节点
$list->unshift('second');

// shift()
// 将链表的第一个移除
$list->shift();

// setIteratorMode(int $mode)
// 设置链表的模式。等价于下面的情况：
// IT_MODE_LIFO: 栈模式，先进后出；IT_MODE_FIFO：队列模式，先进先出
// IT_MODE_DELETE； IT_MODE_KEEP
$list->setIteratorMode(SplDoublyLinkedList::IT_MODE_FIFO);

// getIteratorMode()
// 获得链表的模式
$list->getIteratorMode();

echo "example: \n";
echo "FIFO (First In First Out): \n";
$list->setIteratorMode(SplDoublyLinkedList::IT_MODE_FIFO);
for ($list->rewind(); $list->valid(); $list->next()) {
    echo $list->current()."\n";
}

echo "LIFO (First In First Out): \n";
$list->setIteratorMode(SplDoublyLinkedList::IT_MODE_LIFO);
for ($list->rewind(); $list->valid(); $list->next()) {
    echo $list->current()."\n";
}



















