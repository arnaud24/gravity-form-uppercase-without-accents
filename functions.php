<?php
add_action('gform_pre_submission_1', 'capitalize_fields'); //gform_pre_submission_1 > ID formulaire
function capitalize_fields($form){
    
    foreach( $form['fields'] as &$field ) {
        $field_step1 = htmlentities($_POST[ "input_{$field['id']}" ], ENT_NOQUOTES, $charset='utf-8');

        $field_step2 = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $field_step1);
        $field_step3 = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $field_step2); // pour les ligatures e.g. 'œ'
        $field_step4 = preg_replace('#&[^;]+;#', '', $field_step3); // supprime les autres caractères
        $field_step5 = mb_strtoupper($field_step4);
        $_POST[ "input_{$field['id']}" ] = $field_step5;
        
        }

    return $form;
} 
?>
