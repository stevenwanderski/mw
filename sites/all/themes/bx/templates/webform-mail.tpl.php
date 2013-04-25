<?php
// $Id: webform-mail.tpl.php,v 1.3.2.3 2010/08/30 20:22:15 quicksketch Exp $

/**
 * @file
 * Customize the e-mails sent by Webform after successful submission.
 *
 * This file may be renamed "webform-mail-[nid].tpl.php" to target a
 * specific webform e-mail on your site. Or you can leave it
 * "webform-mail.tpl.php" to affect all webform e-mails on your site.
 *
 * Available variables:
 * - $node: The node object for this webform.
 * - $submission: The webform submission.
 * - $email: The entire e-mail configuration settings.
 * - $user: The current user submitting the form.
 * - $ip_address: The IP address of the user submitting the form.
 *
 * The $email['email'] variable can be used to send different e-mails to different users
 * when using the "default" e-mail template.
 */
?>

<?php // print_r($submission) ?>

<?php print ($email['html'] ? '<p>' : '') . t('Submitted on %date'). ($email['html'] ? '</p>' : ''); ?>


<?php print ($email['html'] ? '<p>' : ''); ?>%email[full_name]<?php print ($email['html'] ? '</p>' : ''); ?>

<?php print ($email['html'] ? '<p>' : ''); ?>%email[email_address]<?php print ($email['html'] ? '</p>' : ''); ?>

<?php if($submission->data[5]){	print '%email[interest]';	} ?>
	
<?php if($submission->data[6]['value'][0] != ''){	print '%email[other]'; } ?>

<?php if($submission->data[7]){	print 'Subscribe to newsletter: YES'; } ?>
	

<?php	if($submission->data[8]){	print '%email[order_white_paper]'; }?>


