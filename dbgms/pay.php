<?php
require (_DBGMS_ . 'dbgms.php');

// 加载通用配置
if(! defined ( 'DBGMS_ROOT' ))
{
	exit ( '权限路径.No direct script access allowed' );
}

header('Content-type:text/html; Charset=utf-8');
/*** 请填写以下配置信息 ***/
$appid = '2019112769448979';			//https://open.alipay.com 账户中心->密钥管理->开放平台密钥，填写添加了电脑网站支付的应用的APPID
$returnUrl = 'http://www.xxx.com/alipay/return.php';     //付款成功后的同步回调地址
$notifyUrl = 'http://www.xxx.com/alipay/notify.php';     //付款成功后的异步回调地址
$outTradeNo = uniqid();     //你自己的商品订单号，不能重复
$payAmount = 0.01;          //付款金额，单位:元
$orderName = '支付测试';    //订单标题
$signType = 'RSA2';			//签名算法类型，支持RSA2和RSA，推荐使用RSA2
//MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCtg2TsGAUzxHs8ypOgw0dGUx9jDGxu3NtZc1ySedJ8pk/0F7rIsEehKootWNIqwiShfPEncTJmmgOmx4wBQGfMk7Ub5UZ60wgs0Ni4JyF7WsxTYlci9cqCod4nbJ9ffYu3xqQ8OC7LxAazwTw4XfeIkB2NI3HesBOw6yKnEhWMgoHCtvUI3nobvwHGpwYFF2Z521ym2ZZibxzLpkBEFt6Lq0ixGxjgqVK9slbVrlfDQY3WUglEoe1fuuXwEeXGyGdvU1ImA3JE+/BqZky46VB6ARGs9LuI6t6UQUhgdXibUOpCMQMO44z0noIE+356o4a+C0Nn8AAxrAR80LkZwyCnAgMBAAECggEBAKbeLUnM0/v0IpzVKWK7Sql8OTw1b3ay2hTNmCKaG+6at1vFEnH87fY2BgsUV5KdgUL4+Kb4+wKnbYmQcLmnaevZxZwdREnM+Bi5hSKdJ1sNeGFcuvY5MVeuOgrqMN9RyvOjisELOx3l2Jg45yRCYlMoXfMlOlZyOY20pG/OOYEVT3pCbgHgxTXGJyS900K2Eu9Rp/r8KDVbnzzsRcxpGC4E5qHJaZT8uZUiDpBetIm5Jl/8FYwLx201FD2rJsVuASi+EV8n41Ec0hFN8K8s0E8vEAMXUTqbXGjImT1ItQ82vBHVIwDbx3ruWktjr2VTBrua0XWsbSf7WvATJQeS2LECgYEA3/korXa0MrsnycKfGKYaRBO1ObWQ8+gWy4ZPBl7hoI9MlZCfTMxU1M5oVE+YDg7nVTnpLUx2lF/hAF4WdaMiMbwcfdTsl2A/f+i/uGnHyJYT1aan8hM7nAiQmVdyJoeWlFvNrUbYdtup/+ErnaCTDaVKkrNnSLS16p5j9HbrOjkCgYEAxlMUNOTOc0yDEZzAwM6xmGlfITjHMrRdHbRoQQ/CYrYy4xO+6X0qqm+TsPZKtps/fYe8zBh2hlIL+OaxRdJSXFMDxc6pTLELshlisPbb5fPPicg7Ih6zJqpLoZ6l6kmWaIAe04E8VWveSidcsSaLoAaoz5richI2XczFrORqsd8CgYACh2myK7j1Ka/VU2FAgf+h7ScKs8YjOuem/Kk/xSp/CZ8vwSZLU7NRg9MhwJRS9FAgYjsDy+0616pOusE+Ks1kCl+3/AN/4hJVe2dOycL7vNYUf4E99oGhzWb0lEwxqy5EFpVH85jWHrzYqs43RWzjpo4lAemUpJW5RHiUdhNJ4QKBgD2m0/BBdKBJF7Gg7hbB6ll74DO+p8XuZcf3LjWThZUUGKuYls+Utm+3Mc1gMwejKVCHorw7mpTU6p3ccR1IbYv/zntubBjILN+XnqNuihto+IpXcXKA4qZRaCN84wz7BUPFGFAdq7jOSJL6u4jid6MujsnC10QovzfXkVfWxgg3AoGAKTX7BT1b6rLIA4EAyCgM4Ar11tTI8Z/uRkEOQzY3l0P5r1UlEEuTUul1agOCq+8lVLYRDbAY3rTodn5zh1bI2tXC94LQRiB9fzRMD5XAsvu5ijjlAOd9jTxGXyqCmdEbbfCtx1SffYg4VU6ywX2NuGGflSXAjlkxUO/c3Mvjsrw=
$rsaPrivateKey='MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCtg2TsGAUzxHs8ypOgw0dGUx9jDGxu3NtZc1ySedJ8pk/0F7rIsEehKootWNIqwiShfPEncTJmmgOmx4wBQGfMk7Ub5UZ60wgs0Ni4JyF7WsxTYlci9cqCod4nbJ9ffYu3xqQ8OC7LxAazwTw4XfeIkB2NI3HesBOw6yKnEhWMgoHCtvUI3nobvwHGpwYFF2Z521ym2ZZibxzLpkBEFt6Lq0ixGxjgqVK9slbVrlfDQY3WUglEoe1fuuXwEeXGyGdvU1ImA3JE+/BqZky46VB6ARGs9LuI6t6UQUhgdXibUOpCMQMO44z0noIE+356o4a+C0Nn8AAxrAR80LkZwyCnAgMBAAECggEBAKbeLUnM0/v0IpzVKWK7Sql8OTw1b3ay2hTNmCKaG+6at1vFEnH87fY2BgsUV5KdgUL4+Kb4+wKnbYmQcLmnaevZxZwdREnM+Bi5hSKdJ1sNeGFcuvY5MVeuOgrqMN9RyvOjisELOx3l2Jg45yRCYlMoXfMlOlZyOY20pG/OOYEVT3pCbgHgxTXGJyS900K2Eu9Rp/r8KDVbnzzsRcxpGC4E5qHJaZT8uZUiDpBetIm5Jl/8FYwLx201FD2rJsVuASi+EV8n41Ec0hFN8K8s0E8vEAMXUTqbXGjImT1ItQ82vBHVIwDbx3ruWktjr2VTBrua0XWsbSf7WvATJQeS2LECgYEA3/korXa0MrsnycKfGKYaRBO1ObWQ8+gWy4ZPBl7hoI9MlZCfTMxU1M5oVE+YDg7nVTnpLUx2lF/hAF4WdaMiMbwcfdTsl2A/f+i/uGnHyJYT1aan8hM7nAiQmVdyJoeWlFvNrUbYdtup/+ErnaCTDaVKkrNnSLS16p5j9HbrOjkCgYEAxlMUNOTOc0yDEZzAwM6xmGlfITjHMrRdHbRoQQ/CYrYy4xO+6X0qqm+TsPZKtps/fYe8zBh2hlIL+OaxRdJSXFMDxc6pTLELshlisPbb5fPPicg7Ih6zJqpLoZ6l6kmWaIAe04E8VWveSidcsSaLoAaoz5richI2XczFrORqsd8CgYACh2myK7j1Ka/VU2FAgf+h7ScKs8YjOuem/Kk/xSp/CZ8vwSZLU7NRg9MhwJRS9FAgYjsDy+0616pOusE+Ks1kCl+3/AN/4hJVe2dOycL7vNYUf4E99oGhzWb0lEwxqy5EFpVH85jWHrzYqs43RWzjpo4lAemUpJW5RHiUdhNJ4QKBgD2m0/BBdKBJF7Gg7hbB6ll74DO+p8XuZcf3LjWThZUUGKuYls+Utm+3Mc1gMwejKVCHorw7mpTU6p3ccR1IbYv/zntubBjILN+XnqNuihto+IpXcXKA4qZRaCN84wz7BUPFGFAdq7jOSJL6u4jid6MujsnC10QovzfXkVfWxgg3AoGAKTX7BT1b6rLIA4EAyCgM4Ar11tTI8Z/uRkEOQzY3l0P5r1UlEEuTUul1agOCq+8lVLYRDbAY3rTodn5zh1bI2tXC94LQRiB9fzRMD5XAsvu5ijjlAOd9jTxGXyqCmdEbbfCtx1SffYg4VU6ywX2NuGGflSXAjlkxUO/c3Mvjsrw=';	//商户私钥，填写对应签名算法类型的私钥，如何生成密钥参考：https://docs.open.alipay.com/291/105971和https://docs.open.alipay.com/200/105310
/*** 配置结束 ***/
$aliPay = new AlipayService();
$aliPay->setAppid($appid);
$aliPay->setReturnUrl($returnUrl);
$aliPay->setNotifyUrl($notifyUrl);
$aliPay->setRsaPrivateKey($rsaPrivateKey);
$aliPay->setTotalFee($payAmount);
$aliPay->setOutTradeNo($outTradeNo);
$aliPay->setOrderName($orderName);
$sHtml = $aliPay->doPay();
echo $sHtml;
class AlipayService
{
    protected $appId;
    protected $returnUrl;
    protected $notifyUrl;
    protected $charset;
    //私钥值
    protected $rsaPrivateKey;
    protected $totalFee;
    protected $outTradeNo;
    protected $orderName;
    public function __construct()
    {
        $this->charset = 'utf8';
    }
    public function setAppid($appid)
    {
        $this->appId = $appid;
    }
    public function setReturnUrl($returnUrl)
    {
        $this->returnUrl = $returnUrl;
    }
    public function setNotifyUrl($notifyUrl)
    {
        $this->notifyUrl = $notifyUrl;
    }
    public function setRsaPrivateKey($saPrivateKey)
    {
        $this->rsaPrivateKey = $saPrivateKey;
    }
    public function setTotalFee($payAmount)
    {
        $this->totalFee = $payAmount;
    }
    public function setOutTradeNo($outTradeNo)
    {
        $this->outTradeNo = $outTradeNo;
    }
    public function setOrderName($orderName)
    {
        $this->orderName = $orderName;
    }
    /**
     * 发起订单
     * @return array
     */
    public function doPay()
    {
        //请求参数
        $requestConfigs = array(
            'out_trade_no'=>$this->outTradeNo,
            'product_code'=>'FAST_INSTANT_TRADE_PAY',
            'total_amount'=>$this->totalFee, //单位 元
            'subject'=>$this->orderName,  //订单标题
        );
        $commonConfigs = array(
            //公共参数
            'app_id' => $this->appId,
            'method' => 'alipay.trade.page.pay',             //接口名称
            'format' => 'JSON',
            'return_url' => $this->returnUrl,
            'charset'=>$this->charset,
            'sign_type'=>'RSA2',
            'timestamp'=>date('Y-m-d H:i:s'),
            'version'=>'1.0',
            'notify_url' => $this->notifyUrl,
            'biz_content'=>json_encode($requestConfigs),
        );
        $commonConfigs["sign"] = $this->generateSign($commonConfigs, $commonConfigs['sign_type']);
        return $this->buildRequestForm($commonConfigs);
    }
    /**
     * 建立请求，以表单HTML形式构造（默认）
     * @param $para_temp 请求参数数组
     * @return 提交表单HTML文本
     */
    protected function buildRequestForm($para_temp) {
        $sHtml = "正在跳转至支付页面...<form id='alipaysubmit' name='alipaysubmit' action='https://openapi.alipay.com/gateway.do?charset=".$this->charset."' method='POST'>";
        foreach($para_temp as $key=>$val){
            if (false === $this->checkEmpty($val)) {
                $val = str_replace("'","&apos;",$val);
                $sHtml.= "<input type='hidden' name='".$key."' value='".$val."'/>";
            }
        }
        //submit按钮控件请不要含有name属性
        $sHtml = $sHtml."<input type='submit' value='ok' style='display:none;''></form>";
        $sHtml = $sHtml."<script>document.forms['alipaysubmit'].submit();</script>";
        return $sHtml;
    }
    public function generateSign($params, $signType = "RSA") {
        return $this->sign($this->getSignContent($params), $signType);
    }
    protected function sign($data, $signType = "RSA") {
        $priKey=$this->rsaPrivateKey;
        $res = "-----BEGIN RSA PRIVATE KEY-----\n" .
            wordwrap($priKey, 64, "\n", true) .
            "\n-----END RSA PRIVATE KEY-----";
        ($res) or die('您使用的私钥格式错误，请检查RSA私钥配置');
        if ("RSA2" == $signType) {
            openssl_sign($data, $sign, $res, version_compare(PHP_VERSION,'5.4.0', '<') ? SHA256 : OPENSSL_ALGO_SHA256); //OPENSSL_ALGO_SHA256是php5.4.8以上版本才支持
        } else {
            openssl_sign($data, $sign, $res);
        }
        $sign = base64_encode($sign);
        return $sign;
    }
    /**
     * 校验$value是否非空
     *  if not set ,return true;
     *    if is null , return true;
     **/
    protected function checkEmpty($value) {
        if (!isset($value))
            return true;
        if ($value === null)
            return true;
        if (trim($value) === "")
            return true;
        return false;
    }
    public function getSignContent($params) {
        ksort($params);
        $stringToBeSigned = "";
        $i = 0;
        foreach ($params as $k => $v) {
            if (false === $this->checkEmpty($v) && "@" != substr($v, 0, 1)) {
                // 转换成目标字符集
                $v = $this->characet($v, $this->charset);
                if ($i == 0) {
                    $stringToBeSigned .= "$k" . "=" . "$v";
                } else {
                    $stringToBeSigned .= "&" . "$k" . "=" . "$v";
                }
                $i++;
            }
        }
        unset ($k, $v);
        return $stringToBeSigned;
    }
    /**
     * 转换字符集编码
     * @param $data
     * @param $targetCharset
     * @return string
     */
    function characet($data, $targetCharset) {
        if (!empty($data)) {
            $fileType = $this->charset;
            if (strcasecmp($fileType, $targetCharset) != 0) {
                $data = mb_convert_encoding($data, $targetCharset, $fileType);
                //$data = iconv($fileType, $targetCharset.'//IGNORE', $data);
            }
        }
        return $data;
    }
}