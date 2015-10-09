<?php
/**
 * PHP5 SPL ѧϰ
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
 * ���spl������class
 */
function getClass()
{
    $spl_classes = spl_classes();
    foreach ($spl_classes AS $key=>$val) {
        echo $key.'=>'.$val.'<br />';
    }
}

/**
 * apply �󶨷������ص�
 * iterator_apply():������������1 ArrayIterator����, 2 ������, 3 Ҫ���ݸ������Ĳ���
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
 * Ŀ¼
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




