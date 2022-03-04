<?php

if (!function_exists('getFieldInput')) {
    /**
     * Method to generate field input
     * @param $type string
     * @param $name string
     * @return string
     */
    function getFieldInput($key, $field, $value = '', $options = [], $dataAttributes = [])
    {
        $checked = $value ? ' checked' : '';
        $required = isset($field['required']) ? 'required' : ''; 
        $placeholder = isset($field['placeholder']) ? $field['placeholder'] : $field['label'];
        $hint =  isset($field['hint']) ? $field['hint'] : '';

        switch($field['type']) {
            case 'text':
                return '<input type="' . $field['type'] . '" name="' . $key . '" class="form-control" placeholder="' . $placeholder . '" value="' . $value . '" '. $required.' />';
                break;
            case 'file':
                    return '<input type="' . $field['type'] . '" name="' . $key . '" class="form-control" placeholder="' . $placeholder . '" value="' . $value . '" '. $required.' /><small class="text-warning">' . $hint . '</small>';
                break;
            case 'email':
            case 'number':
                return '<input type="' . $field['type'] . '" name="' . $key . '" class="form-control" placeholder="' . $field['label'] . '" value="' . $value . '" '. $required.' />';
                break;
            case 'password':
                return '<input type="' . $field['type'] . '" name="' . $key . '" class="form-control" placeholder="' . $field['label'] . '"  />';
                break;
            case 'checkbox':
                return '<input type="' . $field['type'] . '" name="' . $key . '" class="form-control" placeholder="' . $field['label'] . '" value="1" '. $checked .' />';
                break;
            case 'textarea':
                return '<textarea name="' . $key . '" class="form-control" rows="5"  placeholder="' . $field['label'] . '">' . $value . '</textarea>';
                break;
            case 'date':
                return '
                <div class="input-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input class="form-control datepicker" placeholder="Select date" type="text" data-format="yyyy-dd-mm" value="' . $value .'" name="' . $key . '">
                </div>
                ';
                break;
            case 'wysiwyg':
                return '
                    <textarea name="' . $key . '" style="display:none;" class="wysiwyg">
                        ' . $value . '
                    </textarea>
                ';
                break;
            case 'select':
                $optionsHTML = '<option value="">-- Pilih ' . $field['label'] . ' --'. '</option>';
                $options = (!isset($options) 
                    ? $options 
                    : isset($field['options'])) ? $field['options'] : [];

                foreach($options as $option) {
                    $dataAttributes = '';
                    if (isset($option['data'])) {    
                        foreach ($option['data'] as $dataKey => $dataValue) {
                            $dataAttributes .= 'data-' . $dataKey . '="' . $dataValue . '"';
                        }
                    }

                    $selected = !is_object($value) && $option['value'] == $value ? ' selected' : '';
                    $optionsHTML .= '<option value="' . $option['value'] . '"' . $selected . ' ' . $dataAttributes . '>' . $option['text'] . '</option>';
                }

                return '
                    <select class="form-control" name="' . $key . '" '. $required .'>
                        ' . $optionsHTML . '
                    </select>
                ';
                break;
            case 'datetime':
            return '
            <div class="input-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="material-icons">event</i></span>
                </div>
                <input class="form-control" type="datetime" value="' . $value .'" name="' . $key . '">
            </div>
            ';
            break;
        }

    }
}