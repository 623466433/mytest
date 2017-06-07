<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/7
 * Time: 9:02
 */

namespace lib;


class Wechat
{
    private $postObj;//消息对象
    public  $openId; //用户openid
    private $ourOpenId;//我们自己的openid
    public  $msgType;  //消息类型
    public  $eventType;//事件类型
    public  $imgUrl;//图片地址
    public  $mediaId;//多媒体mediaId,图片语音视频
    /**
     * @param string $token为公众号配置的token字符串
     * @return bool true即为认证通过 false为认证失败
     */
    private function checkSignature($token = "")
    {
        // you must define TOKEN by yourself
        if (empty($token)) {
            throw new Exception('TOKEN is not defined!');
        }
        //获取认证参数
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $tmpArr = array($token, $timestamp, $nonce);
        // 字典序排序并sha1加密
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        //对比是否通过
        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 验证微信服务器
     * @param $token为公众号配置的token字符串
     */
    public function valid($token)
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature($token)){
            echo $echoStr;
            exit;
        }
    }

    /**
     * 回复消息初始化
     */
    public function _msgInit(){
        if(!empty($GLOBALS["HTTP_RAW_POST_DATA"])){
            $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
            //将xml转换成对象
            libxml_disable_entity_loader(true);
            $this->postObj      = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $this->openId       = $this->postObj->FromUserName;
            $this->ourOpenId    = $this->postObj->ToUserName;
            $this->msgType      = $this->postObj->MsgType;
            if ($this->msgType == "event"){
                $this->eventType    = $this->postObj->Event;
            }elseif ($this->msgType == "image"){
                $this->mediaId = $this->postObj->MediaId;
                $this->imgUrl = $this->postObj->PicUrl;
            }elseif ($this->msgType == "voice"){
                $this->mediaId = $this->postObj->MediaId;
            }
        }
    }

    /**
     * 回复文本消息
     * @param $content
     * @throws \Exception
     */
    public function sendTextMsg($content){
        if (!isset($this->postObj)){
            throw new \Exception("\$this->postObj is empty");
        }
        $str = "
            <xml>
                <ToUserName><![CDATA[".$this->openId."]]></ToUserName>
                <FromUserName><![CDATA[".$this->ourOpenId."]]></FromUserName>
                <CreateTime>".time()."</CreateTime>
                <MsgType><![CDATA[text]]></MsgType>
                <Content><![CDATA[".$content."]]></Content>
            </xml>
        ";
        echo $str;
    }
}