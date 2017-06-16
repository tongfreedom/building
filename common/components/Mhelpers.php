<?php 

namespace common\components;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

class Mhelpers extends Component
{

  public function curPageURL() {
      $isHTTPS = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on");
      $port = (isset($_SERVER["SERVER_PORT"]) && ((!$isHTTPS && $_SERVER["SERVER_PORT"] != "80") || ($isHTTPS && $_SERVER["SERVER_PORT"] != "443")));
      $port = ($port) ? ':'.$_SERVER["SERVER_PORT"] : '';
      $url = ($isHTTPS ? 'https://' : 'http://').$_SERVER["SERVER_NAME"].$port.$_SERVER["REQUEST_URI"];
      return $url;
  }

  public function subdetail($details) {
      $detail = strip_tags($details);
      $detail_sub = iconv_substr($detail, 0, 150, "UTF-8");
      $detail_arr = explode(" ",$detail_sub);
      $numItems = count($detail_arr);
      $i = 0;
      $text = "";
      foreach ($detail_arr as $da) {
        if(++$i !== $numItems) {
           $text .=  $da." ";
        }
      }

      return $text;
  }

  public function subtitle($detail) {
      $detail = strip_tags($detail);
      $detail_sub = iconv_substr($detail, 0, 40, "UTF-8");
      $text = $detail_sub.'...';
      return $text;
  }
}