<?php
include('../common/common.php');

class HTMLCacheDemo extends UseCase {
    const KEY_NAME = 'htmldemo';
 
    protected function init() {
        HTMLCache::initialize($this->getMemcache(), 15);
    }

    public function execute() {
        $date = date('Y-m-d H:i:s');

        if (!HTMLCache::get(self::KEY_NAME)) {
            $view = new View('views/HTMLDemoContent.phtml');
            /** some extra heavy stuff **/ 
            $view->date = $date; 
            $view->render();
            HTMLCache::write();
        }
        echo "<h3>PHP time is : $date </h3>\n";

    }

}

$usecase = new HTMLCacheDemo();
$usecase->execute();

