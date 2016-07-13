<?php

class ContactPage extends Page {
     public static $has_many = array(
    	'CommissionHits' => 'CommissionHit'
   );
     
     
   public function getCMSFields() {
	   
   	$fields = parent::getCMSFields();
        $config = GridFieldConfig_RelationEditor::create();
        $config->getComponentByType('GridFieldDataColumns')->setDisplayFields(array(
            'ClientName' => 'ClientName',
            'Organization' => 'Organization',
            'Email' => 'Email',
            'ProjectType' => 'ProjectType',
            'Deadline' => 'Deadline',
            'Budget' => 'Budget',
            'Description' => 'Description'
        )); 
        $hitsField = new GridField(
            'CommissionHits', // Field name
            'CommissionHit', // Field title
            $this->CommissionHits(), // List of all Commission Hits
            $config
        );    
	$fields->addFieldToTab('Root.CommissionHits', $hitsField); 	
	return $fields;		
  }

}
class ContactPage_Controller extends Page_Controller {
}
?>
