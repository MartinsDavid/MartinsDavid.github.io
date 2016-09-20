<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of validation
 *
 * @author David
 */
class Validation {
    
    public static function validateItem($var,$type) {
        
        $filter=false;
        switch ($type){
            case 'mail':
                $var = substr($var, 0, 254);
                $filter = FILTER_VALIDATE_EMAIL;
                break;
            case 'int':
                $filter = FILTER_VALIDATE_INT;
                break;
            case 'float':
                $filter = FILTER_VALIDATE_FLOAT;
                break;
            case 'regex':
                $filter = FILTER_VALIDATE_REGEXP;
                break;
            case 'pseudo':
                $filter = preg_match("#.*^(?=.{4,20}).*$#",$var);
            case 'mdp':
                $filter = preg_match("#.*^(?=.{4,18})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#",$var);
        }
        
        return filter_var($var,$filter)==false ? false : true;
    }   
    
    public static function valider($tableau) {
        
        foreach ($tableau as $key => $value) {
            if(isset($value)) {
                $tabR[]= self::validateItem($value,$key);
            }
            else {
                $tabR[]=false;
            }
        }       
        return $tabR;

    }
    
    public static function nettoyerString($elt) 
	{
		$elt = filter_var($elt, FILTER_SANITIZE_STRING);
		$elt = addslashes($elt);
		$elt = trim($elt);
		return $elt;
	}
    
}









//class Validation{
//    
//    public static function validerMail($mail){
//        if (!isset($mail))
//        {
//            throw new \Exception("Variable inexistante", 001);
//        }
//        if(!filter_var($mail, FILTER_VALIDATE_EMAIL) || $mail === "")
//        {
//            throw new \Exception(" Adresse mail invalide", 002);
//        }
//    }
//    
//    public static function validerMotDePasse($motDePasse){
//        if(!isset($motDePasse))
//        {
//            throw new \Exception("Variable inexistante", 001);
//        }
//        
//        if(!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $motDePasse))
//        {
//            throw new \Exception(" Mot de passe invalide",003);
//        }   
//    }
//    
//    public static function validerNom($nom){
//        if(!isset($nom))
//        {
//            throw new \Exception("Variable inexistante", 001);
//        }
//        if(!preg_match("#.*^(?=.{1,30}).*$#", $nom))
//        {
//            throw new \Exception(" Taille incorrecte", 005);
//        }
//    }
//    
//    public static function validerPrenom($prenom){
//        if(!isset($nom))
//        {
//            throw new \Exception("Variable inexistante", 001);
//        }
//        if(!preg_match("#.*^(?=.{1,30}).*$#", $prenom))
//        {
//            throw new \Exception(" Taille incorrecte", 008);
//        }
//    }
//    
//    public static function validerUrl($url)
//    {
//        if(!isset($url))
//        {
//           throw new \Exception("Variable inexistante", 001);
//        }
//        if(!filter_var($url, FILTER_VALIDATE_URL))
//        {
//            throw new \Exception(" Url invalide",006);
//        }
//    }
//    
//    public static function validerDate($date)
//    {
//        if(!isset($date))
//        {
//           throw new \Exception("Variable inexistante", 001);
//        }
//        if(!checkdate($date['month'], $date['day'], $date['year']))
//        {
//            throw new \Exception("Date incorrecte", 007);
//        }
//    }
//    
//    public static function validerText($text)
//    {
//        if(!isset($text))
//        {
//            throw new \Exception("Variable inexistante", 001);
//        }
//
//    }
//}


