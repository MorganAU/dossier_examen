<?php
/**
*Plugin Name: Comment Plugin 0.0001
*Plugin URI: https://mon_site.fr
*Description: un plugin pour mon examen Titre pro DWWM
*Version 0.1
*Author: Morgan AUGEREAU
*Author URI: https://mon_site.fr
*License: GPL2
**/
include_once $_SERVER['DOCUMENT_ROOT'] . '/objects/class-comment.php';

add_filter('the_content', 'cafs_add_comment_after_post');

function cafs_add_comment_after_post($sContent)
{
	$aComments = array();

	$comment = new Comment();

	$aComments = $comment->getAllComments($_SESSION['post_id']);

	// Si la page est un article
	if (is_single()) {
		//On ajoute les commentaires
		$sContent .= '
			<br /><br />
			<style type="text/css">
				#comment {
				border: 1px solid #e64946;
				padding: 10px;
			}
			</style>
			<div style="background-color:white">';
		
		for ($i =  count($aComments) - 1 ; $i > -1 ; $i--) {
			$sContent .= '<div style="background-color:white">';
			$sContent .= '<h4 stlye="color:#e64946">' . $aComments[$i]['author_id'] . '</h4>';
			$sContent .= '<div id="comment">' . $aComments[$i]['text_comment'] . '</div>';
			//$sContent .= '<h3>' . $aComments[$i]['moderate'] . '</h3>';
			$sContent .= '</div><br />'; 
			}
			
		$sContent .= '
			</center>
				</div><br />
				';
	}
	return $sContent;
}

function cafs_retry()
{
	return 'Essaie encore';
}
