<?php

class VideothumbnailField extends InputListField {

  static public $assets = array(
    'js' => array(
      'thumbnail.js'
    ),
    'css' => array(
      'thumbnail.css'   // /path/to/field/assets/css/styles.css
    )
  );

  public function __set($option, $value) {
    $this->$option = $value;
  }

  public function custominput($val) {
    $input = parent::input();
    $decoded = $val;
    $input->addClass('radio invisible');
    $input->attr('type', 'radio');
    $input->attr('id', $decoded);
    $input->val($val);
    $input->attr('checked', $val == $this->value());
    return $input;
  }

  public function media() {
    $media = [];
    //Loop through files
    if($this->page()->files()->toArray()):
      foreach($this->page()->files() as $file):
        //Different settings for videos and images
        if($this->only == $file->type() || !$this->only):
          switch ((string)$file->type()) {
            case 'video':
                  $thumbnail = $this->videothumbnailobject($file);
                break;
            case 'image':
                  $thumbnail = $this->imagethumbnailobject($file);
                break;
          }
          //Add each file item to media array
          $media[] = $thumbnail;
        endif;
      endforeach;
    endif;
    //Return
    return $media;
  }


  public function content() {
    $html = '<ul class="input-list field-grid cf">';
    if($this->media()):
      foreach($this->media() as $file) {
        $input = $file['name'];
        $html .= '<li class="input-list-item field-grid-item">';
        $html .= $this->custominput($input);
        $html .= $this->item($input, $file);
        $html .= '</li>';
      }
    else:
      $html .= '<li class="input-list-item field-grid-item"><div class="structure-empty ui-sortable-handle">No files attached to this page.</div></li>';
    endif;
    $html .= '</ul>';
    $content = new Brick('div');
    $content->addClass('field-content');
    $content->append($html);
    return $content;
  }

  public function details($file) {
    $details = '<span class="thumbnail-frame">'.$this->thumbnailsnippet($file).'</span>';
    $details .= '<ul class="specs">';
    $details .= '<li class="spec-item"><strong>Name:</strong>&nbsp;'.$file['name'].'</li>';
    $details .= '<li class="spec-item"><strong>Filename:</strong>&nbsp;'.$file['filename'].'</li>';
    $details .= '<li class="spec-item"><strong>UID:</strong>&nbsp;'.$file['uid'].'</li>';
    //$details .= '<li class="spec-item"><strong>Dimensions:</strong>&nbsp;'.$file['width'].'px &times; '.$file['height'].'px</li>';
    $details .= '</ul>';
    return $details;
  }

  public function item($value, $file) {

    //Create the label
    $label = new Brick('label');
    $label->append($this->details($file));
    $label->addClass('input input-with-radio');
    $label->attr('data-focus', 'true');
    $label->attr('for', $file['name']);

    //Return
    return $label;
  }

  public function validate() {
    return true;
  }

  public function thumbnailsnippet($file) {
    switch ($file['type']) {
      case 'video':
            $snippet = '<video autoplay loop width="180"><source src="'.$file['uid'].'"/></video>';
          break;
      case 'image':
            $snippet = '<img src="'.$file['thumbnails']['h350'].'">';
          break;
    }
    return $snippet;
  }

  /*
  public function value() {
    $value = stripslashes(parent::value());
    if(empty($value)) {
      // get the first key of options
      $media = $this->media();
      if(is_array($options)) {
        reset($media);
        $value = key($media);
      }
    }
    return $value;
  }

  public function result() {
    $input = str_replace("'",'"',stripslashes(parent::result())); //
    return $input;
  }
  */

  // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ //
  // !Thumbnail objects //
  // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ //

  public function thumbnailobject($file) {
    $site = $this->page()->site();
    $domain = $site->url();
    $thumbnail['name'] = (string)$file->name();
    $thumbnail['type'] = (string)$file->type();
    $thumbnail['uid'] = str_replace($domain,"",(string)$file->url());
    $thumbnail['filename'] = (string)$file->filename();
    $thumbnail['type'] = (string)$file->type();
    $thumbnail['width'] = (string)$file->width();
    $thumbnail['height'] = (string)$file->height();
    return $thumbnail;
  }


  public function videothumbnailobject($file) {
    $thumbnail = $this->thumbnailobject($file);
    return $thumbnail;
  }

  public function imagethumbnailobject($file) {
    $thumbnail = $this->thumbnailobject($file);
    $thumbnail['thumbnails']['h350'] = (string)$file->thumb(['height' => 350, 'quality' => 80])->url();
    return $thumbnail;
  }

}

namespace Kirby\Component;

require_once(__DIR__.DS.'lib'.DS.'thumb.php');
require_once(__DIR__.DS.'lib'.DS.'component.php');
require_once(__DIR__.DS.'lib'.DS.'drivers.php');

// Initialize the plugin

$kirby->set('component', 'thumb', 'Kirby\Component\VideoThumb');
