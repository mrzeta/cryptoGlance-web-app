<?php

/*
 * @author Stoyvo
 */
class Class_Wallets_Abstract {
    
    protected $_apiURL;
    protected $_label;
    protected $_address;
    protected $_fileHandler;
        
    public function __construct($label, $address) {
        $this->_label = $label;
        $this->_address = $address;
    }
    
//    public function getAddressData() {
//        return json_decode($this->_fileHandler->read(), true);
//    }
}
?>