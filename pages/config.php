<?php

$package = rex_addon::get('service_bw');
$form = rex_config_form::factory('service_bw');

$field = $form->addInputField('text', 'bearer', null, ['class' => 'form-control']);
$field->setLabel($package->i18n('bearer_token'));
$field->getValidator()->add('notEmpty', $package->i18n('bearer_empty'));

$field = $form->addInputField('text', 'gebiet_ags', null, ['class' => 'form-control']);
$field->setLabel($package->i18n('gebiet_ags'));
$field->getValidator()->add('notEmpty', $package->i18n('gebiet_ags_empty'));

$field = $form->addInputField('text', 'gebiet_id', null, ['class' => 'form-control']);
$field->setLabel($package->i18n('gebiet_id'));
$field->getValidator()->add('notEmpty', $package->i18n('gebiet_id_empty'));

$fragment = new rex_fragment();
$fragment->setVar('class', 'edit', false);
$fragment->setVar('title', $package->i18n('service_bw_config'), false);
$fragment->setVar('body', $form->get(), false);
echo $fragment->parse('core/page/section.php');
