<?php

class PluginUsertopics_HookUsertopics extends Hook {

    /*
     * Регистрация событий на хуки
	*/
    public function RegisterHook() {
        $this->AddHook('template_user_topics', 'displayTopics',__CLASS__);
    }
	
	public function displayTopics(){
		$s = '';
		if(Router::GetActionEventName()=='EventWhois') {
			$sUserLogin = Router::GetActionEvent();
			if (($oUserProfile=$this->User_GetUserByLogin($sUserLogin))) {
				print_r($oUserPrifile);
				$aResult=$this->Topic_GetTopicsPersonalByUser($oUserProfile->getId(),1,$iPage,Config::Get('module.topic.per_page'));
				$aTopics=$aResult['collection'];
				$this->Viewer_Assign('aTopics',$aTopics);
				$s = $this->Viewer_Fetch(Plugin::GetTemplatePath('usertopics').'featured.tpl');
			}
		 }
        return $s;
	}
}
?>
