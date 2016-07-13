<?php
class DevClientPage extends Page {
    public static $db = array(	
          'ContractDuration' => 'Varchar',
           'WorkType' => 'Varchar',
           'ClientSiteLink' => 'Varchar'
  );
    
    public static $has_one = array(
    'ClientPreviewImage' => 'Image'
  );
    
     public function getCMSFields() {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', new TextField('ContractDuration'), 'Content');
        $fields->addFieldToTab('Root.Main', new TextField('WorkType'), 'Content');
        $fields->addFieldToTab('Root.Main', new TextField('ClientSiteLink'), 'Content');
        $fields->addFieldToTab("Root.Main", $uploadField = new UploadField(
                $name = 'ClientPreviewImage',
                $title = 'Gallery Preview'
            ) ); 
         //$uploadField->setAllowedMaxFileNumber(1);
        return $fields;		
  }
}


class DevClientPage_Controller extends Page_Controller {
      // this function creates the thumnail for the summary fields to use
   /*public function getThumbnail() { 
     return $this->ClientPreviewImage()->CMSThumbnail();
  }*/
}
?>
