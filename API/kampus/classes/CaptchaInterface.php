<?php
namespace PHPMaker2020\project1;

/**
 * Captcha interface
 */
interface CaptchaInterface
{
	public function getHtml();
	public function getConfirmHtml();
	public function validate();
	public function getScript();
}
?>