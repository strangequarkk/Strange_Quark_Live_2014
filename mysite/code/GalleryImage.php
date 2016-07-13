<?php

class GalleryImage extends DataObject {
  
  public static $db = array(	
	  'Title' => 'Varchar',
          'Date' => 'Date',
          'Description' => 'HTMLText',
          'BuyLink' => 'Varchar(300)',
          'BuyLocation'=> 'Varchar'
  );
 
  // One-to-one relationship with gallery page
  public static $has_one = array(
    'Image' => 'Image',
    'ThumbnailImage' => "Image",
    'GalleryPage' => 'GalleryPage'	
  );
  
    private static  $many_many = array(
        'RelationTags' => 'Tag'
    );
 
 // tidy up the CMS by not showing these fields
  public function getCMSFields() {
        $fields = parent::getCMSFields();
        $fields->removeFieldFromTab("Root.Main","GalleryPageID");
        
        $dateField = new DateField('Date');
        $dateField->setConfig('showcalendar', true);
        
        $tagField = new TagField('RelationTags', null, null, 'GalleryImage');
        $tagField->setSeparator(",");
        $fields->addFieldToTab("Root.RelationTags", $tagField);
        
        $fields->addFieldToTab('Root.Main', $dateField, "Description");
        return $fields;		
  }
  
  
  // this function creates the thumbnail for the CMS summary fields to use
   public function getThumbnail() { 
     return $this->Image()->CMSThumbnail();
  }
  
  public function getYearCreated() {
        return date('Y', strtotime($this->Date));
  }
}
?>
