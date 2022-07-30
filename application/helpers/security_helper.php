<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('CheckPermission'))
{
	function CheckPermission($business_login=""){
        $expired		= true;
		$denied			= true;
	    $ci_instance	=& get_instance();
        
        if( isset($ci_instance->session) && $ci_instance->session->userdata('email') == '' ){
			$expired	= true;
			$denied		= true;
		}else{
           
			//for home only 
            if($ci_instance->session->userdata('email') == '')
            {
			    
			    $expired = true;
			    $denied = true;
			}else{
                $expired	= false;
                $permissions['user_permission'] = $ci_instance->session->userdata('permission_admin');
                
                $module			= $ci_instance->uri->segment(1);
			    $controller		= $ci_instance->uri->segment(2);
                $method			= $ci_instance->uri->segment(3);
                
                if((int)$ci_instance->session->userdata('userlevel') != 1){
                    foreach($permissions['user_permission'] as $permit){
                        $page_module				= $permit;
                        if($module==$page_module) {
                            $denied = false;break;
                        }
                    }
				}else {
				    $denied = false;
			    }
			}
		}
		
		if ($denied || $expired){
		    // save the current page before redirected to login page
            //$uri_sess['last_accessed_page'] = $ci_instance->uri->uri_string();
            //$ci_instance->session->set_userdata($uri_sess);
            
            if($expired) { 
            	$text = "Login session expired"; 
            	$page = "Login";
            }else if(!$expired && $denied){
            	$text = "You dont have permission on this page";
            	$page = "Login";
            }
            
		    echo '
		    	
					<h1>&nbsp;</h1>
					<div class="main-wthree">
						<h2>401</h2>
						<p style="margin-bottom: 40px">
							<span class="sub-agileinfo">
								'.$text.' <br />
							</span>
							<br />
							<br />
							<a class="btn" href="'.base_url().'login/login_page">Return to '.$page.' page</a>
							
						</p>
					</div>
			
			';
            exit();
            // Redirecting to '.$page.' Page
           // <meta http-equiv="refresh" content="2;URL=\''.base_url().'login/login_page\'">
		}
	}
}