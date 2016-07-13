<?php
class Page extends SiteTree {

	private static $db = array(
	);

	private static $has_one = array(
	);

}
class Page_Controller extends ContentController {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	private static $allowed_actions = array (
             'AJAXSubmit', 
            'CommissionForm'
	);

	public function init() {
		parent::init();

		// Note: you should use SS template require tags inside your templates 
		// instead of putting Requirements calls here.  However these are 
		// included so that our older themes still work
                
                Requirements::javascript("//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" );
                Requirements::javascript("themes/strange/javascript/jquery.fancybox.js");
                Requirements::javascript("themes/strange/javascript/jquery.fancybox-thumbs.js");
                //Requirements::javascript("themes/strange/javascript/jquery.magnific-popup.min.js");
                Requirements::javascript("themes/strange/javascript/jQueryRotateCompressed.js");
                Requirements::customScript(<<<JS
            var thisLink = '{$this->Link()}';
JS
            );
                Requirements::javascript("themes/strange/javascript/strange.js");
                //Requirements::CSS("themes/strange/css/magnific-popup.css");
                Requirements::CSS("themes/strange/css/jquery.fancybox.css");
                Requirements::CSS("themes/strange/css/jquery.fancybox-thumbs.css");
                Requirements::themedCSS('reset'); //css reset
		Requirements::themedCSS('layout'); 
		Requirements::themedCSS('typography'); 
		Requirements::themedCSS('form'); 
	}
        
        // create the form
    function CommissionForm() {

 
            if ($this->ID <= 0) return false;
            $checkbox= new CheckboxSetField( $name = "ProjectType", $title = "Project Type", $source = array( "illustration" => "Illustration", "webDev" => "Web Development", "other" => "Other:", ), $value = "" );
            $checkbox->addExtraClass('req')->setAttribute('required', true);
            $fields = new FieldList(
                 TextField::create("ClientName")->setTitle('Your Name')->addExtraClass('req')->setAttribute('required', true),
                TextField::create("Organization")->setTitle('Organization'), 
                EmailField::create("Email")->setTitle('Email Address')->setAttribute('required', true)->setAttribute('type', 'email')->addExtraClass('req'),
                $checkbox,
                TextField::create("TypeOther")->setTitle(''),
                DateField::create("Deadline")->setTitle('Project Deadline')->setConfig('showcalendar', true),
                TextField::create("Budget")->setTitle('Budget'),
                TextareaField::create("Description")->setTitle('Project Description')->addExtraClass('req')->setAttribute('required', true),
                LiteralField::create("Captcha")->setContent('<div class="g-recaptcha" data-sitekey="6LcQ6SQTAAAAAOO5NTLEiTw6QDzxQuaCcFdio1AP"></div>'),
                new HiddenField('Page', 'Page', $this->ID)
            );

            $actions = new FieldList(
                new FormAction('doSubmit', 'submit')
            );
           
            return new Form($this, 'CommissionForm', $fields, $actions);
   
    }
    
    // handle the submitted (non-AJAX) Form
    function doSubmit($postedData, $form) {
 
         //prep data for email and db
                $projTypeText = "";
                $pType= "";
                if(strlen($postedData['ProjectType']['illustration']) > 0){
                    $projTypeText= "an illustration commission ";
                    $pType = "Illustration";
                }
                if(strlen($postedData['ProjectType']['webDev']) > 0){
                    if(!empty($projTypeText)){
                        $projTypeText .= "and ";
                        $pType .= ", ";
                    }
                    $projTypeText .= "some development work ";
                    $pType .= "Web Development";
                }
                if((strlen($postedData['ProjectType']['other']))||(strlen($postedData['TypeOther']))){
                    if(!empty($projTypeText)){
                        $projTypeText .= "and ";
                        $pType .= ", ";
                    } 
                    $projTypeText .= $postedData['TypeOther']." ";
                    $pType .= $postedData['TypeOther'];
                }
                $postedData['WorkType']= (strlen($projTypeText) > 0)? $projTypeText : "some kind of mystery work";
                $commissionData['ProjectType'] = $pType;
                
                if((strlen($postedData['Budget']) <= 0)&&(strlen($postedData['Deadline']) <= 0)){
                    $postedData['LeftOut'] = "They didn't mention a budget or a deadline.";
                }else if(strlen($postedData['Budget']) <= 0){
                    $postedData['LeftOut'] = "They didn't mention a budget.";
                }else if(strlen($postedData['Deadline']) <= 0){
                    $postedData['LeftOut'] = "They didn't mention a deadline.";
                }
                
                //make entry in commission hit table
                $CommissionHit = new CommissionHit($commissionData);
                $CommissionHit->write();
            
                
                //build & send email
                $email = new Email();
                $email->setTemplate('CommissionEmail');
                $email->setSubject('WORK REQUEST from '.$postedData['ClientName']);
                $email->setFrom($postedData['Email']);
                $email->setTo('commissions@strange-quark.com');
                
                $email->populateTemplate($postedData);
                $email->send();
                
                //return message
                $thanksMessage = "Thanks for contacting me. I'll get in touch with you as soon as I can!";
                return $thanksMessage;
                Director::redirectBack();
    }
    
     function AjaxSubmit($postedData) {
        if (Director::is_ajax()) {
            parse_str(urldecode($this->requestParams['values']), $postedData);
            $commissionData = array();
            foreach($postedData as $key=>$value){
                if(($key != 'TypeOther')&&($key != 'SecurityID')){
                    $commissionData[$key] = $value;
                }
            }
            if ($postedData['SecurityID'] == Session::get('SecurityID')) {
                
                //prep data for email and db
                $projTypeText = "";
                $pType= "";
                if(array_key_exists('ProjectType', $postedData)){
                    if((array_key_exists('illustration',$postedData['ProjectType']))&&(strlen($postedData['ProjectType']['illustration']) > 0)){
                        $projTypeText= "an illustration commission ";
                        $pType = "Illustration";
                    }
                    if((array_key_exists('webDev',$postedData['ProjectType']))&&(strlen($postedData['ProjectType']['webDev']) > 0)){
                        if(!empty($projTypeText)){
                            $projTypeText .= "and ";
                            $pType .= ", ";
                        }
                        $projTypeText .= "some development work ";
                        $pType .= "Web Development";
                    }
                    if(((array_key_exists('other',$postedData['ProjectType']))&&(strlen($postedData['ProjectType']['other'])))||(strlen($postedData['TypeOther']))){
                        if(!empty($projTypeText)){
                            $projTypeText .= "and ";
                            $pType .= ", ";
                        } 
                        $projTypeText .= $postedData['TypeOther']." ";
                        $pType .= $postedData['TypeOther'];
                    }
                }
                
                $postedData['WorkType']= (strlen($projTypeText) > 0)? $projTypeText : "some kind of mystery work";
                $commissionData['ProjectType'] = $pType;
                
                if((strlen($postedData['Budget']) <= 0)&&(strlen($postedData['Deadline']) <= 0)){
                    $postedData['LeftOut'] = "They didn't mention a budget or a deadline.";
                }else if(strlen($postedData['Budget']) <= 0){
                    $postedData['LeftOut'] = "They didn't mention a budget.";
                }else if(strlen($postedData['Deadline']) <= 0){
                    $postedData['LeftOut'] = "They didn't mention a deadline.";
                }
                
                //make entry in commission hit table
                $contactPage = DataObject::get_one('ContactPage');
                $commissionData['ContactPageID'] = $contactPage->ID;
                
                //set contact page id or else it won't show in the gridfield
                $CommissionHit = new CommissionHit($commissionData);
                $CommissionHit->write();
                
                
                //build & send email
                $email = new Email();
                $email->setTemplate('CommissionEmail');
                $email->setSubject('WORK REQUEST from '.$postedData['ClientName']);
                $email->setFrom($postedData['Email']);
                $email->setTo('commissions@strange-quark.com');
                
                $email->populateTemplate($postedData);
                $email->send();
                
                //return message
                $thanksMessage = "Thanks for contacting me. I'll get in touch with you as soon as I can!";
                return $thanksMessage;
            }
            else return false;
        }
        return array();
    }
    
    
    function PageById($id){
       return DataObject::get_by_id("SiteTree", (int)$id);
    }
     

}
