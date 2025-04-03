<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\EmailTemplate;

class Alert extends Mailable
{
  use Queueable, SerializesModels;
  
  /**
  * Create a new message instance.
  *
  * @return void
  */
  public $message;
  public $alias;
  public function __construct($message,$alias)
  {
    $this->message = $message;
    $this->alias = $alias;
  }

  /**
  * Build the message.
  *
  * @return $this
  */
  public function build()
  {

    $template =EmailTemplate::where('alias',$this->alias)->first();
    $subject = $template ? $template->subject : '';
    $html = $template ? $template->message : '';
    $subject=$this->toMailHtml($subject,$this->message);
    return $this->toHtml($html, $this->message)->subject($subject);
  }

  private function toMailHtml($html, $variables) {

    $html = stripslashes(html_entity_decode($html));
    foreach ($variables as $var => $val) {

      preg_match_all('/\{+'.$var.'+\}/i', $html, $matches);

      if(isset($matches[0]) && is_array($matches[0])) {

        $mt = $matches[0];

        foreach($mt as $mtk) {
          $html = str_replace($mtk, $val, $html);
        }
      }
    }

    return $html;
  }

  private function toHtml(String $html, Array $variables) {

    $html = $this->toMailHtml($html, $variables);

    return $this->view('email.alert',array('data'=>$html));
  }
}