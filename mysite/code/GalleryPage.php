<?php

//Model
class GalleryPage extends Page {
	
   public static $has_many = array(
    	'GalleryImages' => 'GalleryImage'
   );
   
  
   public function getCMSFields() {
	   
   	$fields = parent::getCMSFields();
        
        $config = GridFieldConfig_RelationEditor::create();
        $config->getComponentByType('GridFieldDataColumns')->setDisplayFields(array(
           'Title' => 'Title',
           'Date' => 'Date',
           'Description' => 'Description',
           'BuyLocation' => 'BuyLocation',
	   'Thumbnail' => 'Thumbnail'  
        )); 
        $imagesField = new GridField(
            'GalleryImages', // Field name
            'GalleryImage', // Field title
            $this->GalleryImages(), // List of all Commission Hits
            $config
        );    
	$fields->addFieldToTab('Root.Images', $imagesField); 
		
	return $fields;		
  }
}

//Controller
class GalleryPage_Controller extends Page_Controller {
	
	public static $allowed_actions = array (
            'tagged'
	);
        

        public function AllTags(){
            $tagArr = array();
            $titles = array();
            foreach(GalleryImage::get() as $galImg){
                $tagList = $galImg->RelationTags();

                foreach($tagList as $tag){
                    $itemTag = array('Title'=>$tag->Title, 'Link'=>urlencode($tag->Title));
                    if(!in_array($itemTag, $tagArr)){
                        array_push($tagArr,$itemTag);
                        $titles[] = $tag->Title;
                    }
                }
            }
            array_multisort($titles, SORT_ASC, $tagArr); //sort tags alphabetically by title
            return new ArrayList($tagArr);
        }
        
	public function GroupedGalleryImages() {
            $link = $_SERVER['REQUEST_URI'];
            $urlArr = explode('/', trim($link,'/'));
            $targetTag = false;
            if((count($urlArr) > 2)&&($urlArr[count($urlArr)-2] == "tagged")){ 
                $targetTag = urldecode($urlArr[count($urlArr)-1]);
                }
            if($targetTag){
                //get only images that are tagged
                return GroupedList::create(GalleryImage::get()->filter('RelationTags.Title', $targetTag)->sort('Date DESC'));
            }else{
                
                return GroupedList::create(GalleryImage::get()->sort('Date DESC'));
            
            }
	}
        
        
	public function init() {
		parent::init();
	}
}
?>
