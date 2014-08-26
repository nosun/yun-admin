<?php
function flash_message() 
{ 
    // get flash message from CI instance 
    $ci =& get_instance(); 
    $flashmsg = $ci->session->flashdata('message'); 
    $html = ''; 
    if (is_array($flashmsg)) 
    { 
        $html = '<div id="flashmessage" class="'.$flashmsg[type].'"> 
            <img style="float: right;cursor: pointer" id="closemessage" src="'.base_url().'views/assets/img/cross.png" /> 
            <strong>'.$flashmsg['title'].'</strong> 
            <p>'.$flashmsg['content'].'</p> 
            </div>'; 
    } 
    return $html; 
}  
