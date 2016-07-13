<?php

class AboutPage extends Page {
    
  public static $has_one = array(
    'PortraitImage' => 'Image'
  );
  
    public function getCMSFields() {
        $fields = parent::getCMSFields();
       
        $fields->addFieldToTab("Root.Main", $uploadField = new UploadField(
                $name = 'PortraitImage',
                $title = 'Portrait'
            ) ); 
        return $fields;		
  }
}


class AboutPage_Controller extends Page_Controller {
}
?>
