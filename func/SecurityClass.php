<?php

/**
 * login method
 */
class Security
{
	/*
	* サニタイズ処理
	*/
	function f($val)
	{
		return htmlspecialchars($val, ENT_QUOTES, 'utf-8');
	}
}