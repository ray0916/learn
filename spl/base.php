<?php
/**
 * PHP5 SPL 学习
 * Date: 2015/10/5
 * Time: 18:12
 */

/**
 *
 *
 *
 *
 *
 */



/**
 * 获得spl的所有class
 */
function getClass()
{
    $spl_classes = spl_classes();
    foreach ($spl_classes AS $key=>$val) {
        echo $key.'=>'.$val.'<br />';
    }
}

/**
 * apply 绑定方法并回调
 * iterator_apply():有三个参数：1 ArrayIterator对象, 2 方法名, 3 要传递给方法的参数
 */
function addCaps(Iterator $it)
{
    echo ucfirst($it->current()).'<br/>';
    return true;
}

function apply(){
    $arr = array('chen', 'wang', 'liu');

    try {
        $it = new ArrayIterator($arr);
        iterator_apply($it, 'addCaps', array($it));
    }
    catch(Exception $e) {
        // echo the error message
        echo $e->getMessage();
    }
}

/**
 * Extending the DirectoryIterator
 * 目录
 */
class DirectoryReader extends DirectoryIterator
{
    // constructor
    function __construct($path)
    {
        parent::__construct($path);
    }

    // return the current filename
    function current()
    {
        return parent::getFilename();
    }

    // members are only valid if they are a directory
    function valid()
    {
        if(parent::valid())
        {
            if(!parent::isDir())
            {
                parent::next();
                return $this->valid();
            }
            return true;
        }
        return false;
    }
}

try{
    // a new iterator object
    $it = new DirectoryReader('/data');

    // loop over the object member
    while($it->valid())
    {
        // echo the current object member
        echo $it->current().'<br />';

        // advance the internal pointer
        $it->next();
    }
}
catch (Exception $e){
    echo 'No files Found! <br />';
}




