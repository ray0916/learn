<?php

/**
 * spl���ݽṹdemo
 * ˫������ SplDoublyLinkedList
 * ջSplStack
 * ����SplQueue
 *
 * ջ�Ͷ��ж��Ǽ̳���˫���������ԣ�����˫������ķ��������Ա�ջ�Ͷ���ʹ�á����÷���Ҳһ�¡�
 */

$list = new SplDoublyLinkedList();

// push($value)
// �ڽ�β����һ����ֵ
$list->push('value1');
$list->push('value2');
$list->push('value3');
$list->push('value4');
$list->push('value5');

// pop()
// �׳���β��һ��Ԫ�أ���ʹ������ṹ����һ��
$list->pop();

// key()
// ��õ�ǰ�ڵ������ֵ
$list->key();

// count()
// ������������
$list->count();

// rewind()
// ��ָ�뷵������ʼ�ڵ�
$list->rewind();

// current()
// ��õ�ǰ�ڵ�
$list->current();

// top()
// �������һ���ڵ��ֵ
$list->top();

// bottom()
// ���ص�һ���ڵ��ֵ
$list->bottom();

// next()
// ָ���Ƶ���һ���ڵ�
$list->next();

// prev()
// ָ���Ƶ���һ���ڵ�, ���ԭ��ָ���ڵ�һ������ôǰһ���ڵ�Ϊ-1�����ҽ��޷���õ�ǰֵ
$list->prev();

// valid()
// �жϸ������Ƿ��и����ֵ������bool
$list->valid();

// isEmpty()
// �жϸ������Ƿ�Ϊ����������bool
$list->isEmpty();

// offsetExists($index)
// �жϲ������Ƿ���ڣ�����bool
$list->offsetExists(2);

// offsetGet($index)
// ���ز��������Ľڵ�ֵ
$list->offsetGet(2);

// offsetSet($index, $newValue)
// ���ò��������Ľڵ�ֵ, $index����������ļ���Χ�С�
// ��һ���ڵ���offsetUnsetɾ��ʱʱ����������offsetSet���¸���ɾ���Ľڵ�����ֵ��ֻ�ܶԵ�ǰ�ɼ��Ľڵ��ֵ�����޸�
$list->offsetSet(3, 'value6');

// offsetUnset($index)
// ɾ�����������Ľڵ�
$list->offsetUnset(3);

// add($index, $value);
// ��ָ������������һ����ֵ�� ��һ���ڵ���offsetUnsetʱ����û��ֱ��ɾ�����ýڵ㻹��Ȼ�ᱣ�����ڴ��С���add�������¸��ýڵ�����ֵ
$list->add(3, 'first');

// unshift($value)
// ������Ŀ�ʼ�ڵ����value��Ϊ�µĿ�ʼ�ڵ�
$list->unshift('second');

// shift()
// ������ĵ�һ���Ƴ�
$list->shift();

// setIteratorMode(int $mode)
// ���������ģʽ���ȼ�������������
// IT_MODE_LIFO: ջģʽ���Ƚ������IT_MODE_FIFO������ģʽ���Ƚ��ȳ�
// IT_MODE_DELETE�� IT_MODE_KEEP
$list->setIteratorMode(SplDoublyLinkedList::IT_MODE_FIFO);

// getIteratorMode()
// ��������ģʽ
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



















