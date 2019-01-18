<?php

namespace Media\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

class MediaHelper extends Helper
{

    /**
     * Default Helpers
     *
     * @var array $helpers
     */
    public $helpers = [
        'Html',
        'Form',
        'Url'
    ];

    public $explorer = false;

    /**
     * Constructor
     *
     * @param \Cake\View\View $View
     *            The View this helper is being attached to.
     * @param array $config
     *            Configuration settings for the helper.
     */
    public function __construct(View $View, array $config = [])
    {
        parent::__construct($View, $config);
    }

    public function tinymce($field, $ref, $ref_id, $options = array())
    {
        echo $this->Html->script('/media/js/tinymce/tinymce.min.js');
        echo $this->Html->script('/media/js/tinymce/editor.js');
        return $this->textarea($field, $ref, $ref_id, 'tinymce', $options);
    }

    public function ckeditor($field, $ref, $ref_id, $options = array())
    {
        echo $this->Html->script('/media/js/ckeditor/ckeditor.js');
        return $this->textarea($field, $ref, $ref_id, 'ckeditor', $options);
    }

    public function redactor($field, $ref, $ref_id, $options = array())
    {
        echo $this->Html->script('/media/js/redactor/redactor.min.js');
        echo $this->Html->css('/media/js/redactor/redactor.css');
        return $this->textarea($field, $ref, $ref_id, 'redactor', $options);
    }

    public function textarea($field, $ref, $ref_id, $editor = false, $options = array())
    {
        $options = array_merge(array('label' => false, 'style' => 'width:100%;height:300px', 'row' => 160, 'type' => 'textarea', 'class' => "wysiwyg $editor"), $options);
        $html = $this->Form->input($field, $options);
        if (isset($ref_id) && !$this->explorer) {
            $html .= '<input type="hidden" id="explorer" value="' . $this->Url->build('/media/Medias/index/' . $ref . '/' . $ref_id) . '">';
            $this->explorer = true;
        }
        return $html;
    }

    /**
     *
     * @param string $ref
     *            Table name
     * @param int $refId
     *            Entity ID
     *
     * @return string
     */
    public function iframe($ref, $refId)
    {
        return '<iframe src="' . $this->Url->build("/media/medias/index/$ref/$refId") . '" style="width:100%;height:550px;" id="medias-' . $ref . '-' . $refId . '"></iframe>';
    }
}
