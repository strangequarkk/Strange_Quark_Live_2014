<?php

class Tag extends DataObject {
    static $db = array(
        'Title' => 'Varchar(200)',
    );

    static $belongs_many_many = array(
        'GalleryImages' => 'GalleryImage'
    );
    
    //public function Title(){
      //  return
    //}
}

?>
