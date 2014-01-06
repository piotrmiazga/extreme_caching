<?php

class View {

    private $_viewFilename;
    
    public function __construct($viewFilename) {
        $this->_viewFilename = $viewFilename;
    }

    public function render() {
        include($this->_viewFilename);
    }


}
