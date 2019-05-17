<?php
	include 'log.php';
	if(!session_id()) {
			session_start();
		}
	logoutLog('disconnect');