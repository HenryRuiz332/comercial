<?php

 	 /*
        *Author:  Henry Ruiz : henryruiz332@gmail.com
        *Requerimientos :  composer require "intervention/image"
        *version. 1.0
        
            
    */
 	namespace App\Traits;
 	trait Main{

 		/*Path server root*/
 		public static function pathServer(){

	        $path = $_SERVER['DOCUMENT_ROOT'];
	        $pathPublicOut = explode('public',$path);
	        $path = $pathPublicOut[0]; 
	        return $path;

	    }
 	}
 	