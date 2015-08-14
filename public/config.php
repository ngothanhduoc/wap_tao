<?php

/** This file is part of KCFinder project
  *
  *      @desc Base configuration file
  *   @package KCFinder
  *   @version 2.51
  *    @author Pavel Tzonkov <pavelc@users.sourceforge.net>
  * @copyright 2010, 2011 KCFinder Project
  *   @license http://www.opensource.org/licenses/gpl-2.0.php GPLv2
  *   @license http://www.opensource.org/licenses/lgpl-2.1.php LGPLv2
  *      @link http://kcfinder.sunhater.com
  */

// IMPORTANT!!! Do not remove uncommented settings in this file even if
// you are using session configuration.
// See http://kcfinder.sunhater.com/install for setting descriptions

$_CONFIG = array(

    'disabled' => false,
    'denyZipDownload' => false,
    'denyUpdateCheck' => false,
    'denyExtensionRename' => false,

    'theme' => "oxygen",

    'uploadURL' => "../../../assets/images/news",
    'uploadDir' => "../../../assets/images/news",

    'dirPerms' => 0755,
    'filePerms' => 0644,

    'access' => array(

        'files' => array(
            'upload' => true,
            'delete' => true,
            'copy' => true,
            'move' => true,
            'rename' => true
        ),

        'dirs' => array(
            'create' => true,
            'delete' => true,
            'rename' => true
        )
    ),

    'deniedExts' => "exe com msi bat php phps phtml php3 php4 cgi pl",
    /*
	 'types' => array(
        // CKEditor & FCKEditor types
        'wap'       =>  array(
                            'type' => "*img",
                            'thumbWidth' => 100,
                            'thumbHeight' => 100,
                            'maxImageWidth' => 480,
                            'maxImageHeight' => 480
                        ),
        'image'    =>  "bmp gif jpeg jpg png ico webp *.webp image/webp",
        'mimages'   =>  "*mime image/gif image/png image/jpeg",
        'notimages' =>  "*mime ! image/gif image/png image/jpeg",
        'flash'   =>  "swf",
        // TinyMCE types
        'media'   =>  "swf flv avi mpg mpeg qt mov wmv asf rm",
        'file'	  =>  '',	
    ),
    */
    'types' => array(

        // CKEditor & FCKEditor types
        'files'   =>  "*",
        'flash'   =>  "swf",
        'images'  =>  "*img",

        // TinyMCE types
        'file'    =>  "",
        'media'   =>  "swf flv avi mpg mpeg qt mov wmv asf rm",
        'image'   =>  "*img",
    ),
	
	/*
	'types' => array(
	   // The folowing directory types are just for an example
	   'files'     => "",
	   'flash'     => "swf",
	   'media'     => "swf flv avi mpg mpeg qt mov wmv asf rm",
	   'misc'      => "! pdf doc docx xls xlsx",
	   'images'    => "*img",
	   'mimages'   => "*mime image/gif image/png image/jpeg",
	   'notimages' => "*mime ! image/gif image/png image/jpeg"
	),
	*/
    'filenameChangeChars' => array(
        ' ' => "-",
        ':' => "-",
        '%' => "-",
        '@' => "-",
        '$' => "-",
        '#' => "-",
        '&' => "-",
        '"' => "-",
        "'" => "-",
        "!" => "-",
        "^" => "-",
        "*" => "-",
        "(" => "-",
        ")" => "-",
        "<" => "-",
        ">" => "-",
    ),

    'dirnameChangeChars' => array(/*
        ' ' => "_",
        ':' => "."
    */),

    'mime_magic' => "",

    'maxImageWidth' => 0,
    'maxImageHeight' => 0,

    'thumbWidth' => 100,
    'thumbHeight' => 100,

    'thumbsDir' => ".thumbs",

    'jpegQuality' => 90,

    'cookieDomain' => "",
    'cookiePath' => "",
    'cookiePrefix' => 'KCFINDER_',

    // THE FOLLOWING SETTINGS CANNOT BE OVERRIDED WITH SESSION CONFIGURATION
    '_check4htaccess' => true,
    //'_tinyMCEPath' => "/tiny_mce",

    '_sessionVar' => &$_SESSION['KCFINDER'],
    //'_sessionLifetime' => 30,
    //'_sessionDir' => "/full/directory/path",

    //'_sessionDomain' => ".mysite.com",
    //'_sessionPath' => "/my/path",
);

?>