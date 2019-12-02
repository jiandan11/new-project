<?php
defined ( 'DBGMS_ROOT' ) or exit ( 'No direct script access allowed' );
/**
 * 生成验证码类 单例模式 类会自动开启session,并将使用md5加密后写入$_SESSION['captcha'] .
 * @author cy________
 * @param $randLength 设置验证码的长度        	
 * @param $x_size 设置验证码图片的宽        	
 * @param $y_size 设置验证码图片的高        	
 * @param $captchaResource 用于存储验证码图像资源        	
 * @param $pixelNum 设置验证码干扰点个数        	
 * @param $fontDir 验证码字体目录        	
 * @param $randNum 生成的验证码        	
 * @param $captchaInstance 类的实例        	
 */
class Hs {
	private $randLength = 4;
	private $x_size = 70;
	private $y_size = 30;
	private $captchaResource;
	private $pixelNum = 0;
	public $fontDir = "";
	public static $randNum;
	public static $captchaInstance;
	
	/**
	 * 私有化构造方法 , 使该类不能再外部实例化
	 */
	public function __construct($imgspathyzm)
	{
	}
	
	/**
	 * 私有化__clone , 防止类被复制
	 */
	private function __clone()
	{
	}
	
	/**
	 * 用于实例化类 公共的静态 , 使这个方法可以在类不实例化的情况下调用
	 *
	 * @return 类的实例
	 */
	public static function getInstance($imgspathyzm)
	{
		if(! (self::$captchaInstance instanceof self))
		{
			self::$captchaInstance = new self ();
		}
		self::$captchaInstance->fontDir = DBGMS . "/fonts/";
		return self::$captchaInstance;
	}
	/**
	 * 生成验证码图片的方法
	 */
	public function startCreateCaptcha($sessionsign)
	{
		
		// 生成验证码
		self::$randNum = $this->randNum ( $this->randLength );
		// 创建图像资源
		$this->captchaResource = $this->createImage ( $this->x_size, $this->y_size );
		// 将随机数写入验证码
		$this->inputRand ( $this->captchaResource, self::$randNum, $this->x_size, $this->y_size, $this->randLength, $this->fontDir );
		// 设置干扰点
		$this->setPixel ( $this->captchaResource, $this->x_size, $this->y_size, $this->pixelNum );
		// 显示验证码图片
		$this->display ( $this->captchaResource );
		// 保存验证码到session
		$this->inputToSession ( self::$randNum, $sessionsign );
	}
	
	/**
	 * 生成验证码
	 *
	 * @param int $randLength
	 *        	验证码串的长度
	 * @return string $rand 生成的验证码串
	 */
	private function randNum($randLength)
	{
		$rand = substr ( md5 ( mt_rand () ), 0, $randLength );
		return $rand;
	}
	
	/**
	 * 创建图像资源
	 *
	 * @param $width 图像的宽        	
	 * @param $height 图像的高        	
	 * @return $imageIdentifier 创建的图像资源
	 */
	private function createImage($width, $height)
	{
		$imageIdentifier = imagecreatetruecolor ( $width, $height );
		$bgColor = imagecolorallocate ( $imageIdentifier, 255, 255, 255 );
		imagefilledrectangle ( $imageIdentifier, 0, 0, $width, $height, $bgColor );
		return $imageIdentifier;
	}
	
	/**
	 * 将随机数写入验证码
	 *
	 * @param object $im
	 *        	图像资源
	 * @param string $r
	 *        	验证码串
	 * @param int $x
	 *        	验证码宽
	 * @param int $y
	 *        	验证码高
	 * @param int $l
	 *        	验证码长度
	 * @param string $d
	 *        	验证码字体目录
	 */
	private function inputRand($im, $r, $x, $y, $l, $d)
	{
		$_x = 0;
		$_y = $y;
		
		for($i = 0;$i < $l;$i ++)
		{
			$color = imagecolorallocate ( $im, mt_rand ( 0, 255 ), mt_rand ( 0, 255 ), mt_rand ( 0, 255 ) );
			imagettftext ( $im, $x / $l, 0, $_x, $_y, $color, $d . 't' . mt_rand ( 1, 9 ) . '.ttf', $r[$i] );
			$_x += $x / $l;
		}
	}
	
	/**
	 * 设置干扰点
	 *
	 * @param object $im        	
	 * @param int $x        	
	 * @param int $y        	
	 * @param int $pixelNum
	 *        	干扰点个数
	 */
	private function setPixel($im, $x, $y, $pixelNum)
	{
		for($i = 0;$i < $pixelNum;$i ++)
		{
			$_x = mt_rand ( 0, $x );
			$_y = mt_rand ( 0, $y );
			$color = imagecolorallocate ( $im, mt_rand ( 0, 255 ), mt_rand ( 0, 255 ), mt_rand ( 0, 255 ) );
			imagesetpixel ( $im, $_x, $_y, $color );
		}
	}
	
	/**
	 * 显示验证码图片
	 *
	 * @param obj $im
	 *        	图像资源
	 */
	private function display($im)
	{
		ob_clean ();
		header ( 'Content-Type:image/png' );
		header ( 'Pragma: no-cache' );
		imagepng ( $im );
	}
	/**
	 * 将验证码写入session md5加密
	 *
	 * @param string $num
	 *        	验证码串
	 */
	private function inputToSession($num, $sessionsign = NULL)
	{
		session_start ();
		if(empty ( $sessionsign ))
		{
			$_SESSION['captcha'] = md5 ( $num );
		}
		else
		{
			$_SESSION[$sessionsign] = md5 ( $num );
		}
	}
	private function __destruct()
	{
		unset ( self::$randNum );
		imagedestroy ( $im );
	}
}
/*
 * 实例化验证码类
 */
// $image = Hs::getInstance ();
?>