<?php
/**
 *
 * @author MaximAL
 * @since 2018-12-17
 * @date 2018-12-17
 * @time 19:55
 * @copyright © MaximAL, Sijeko 2018
 */

namespace maximal\thumbnail\yii;

use yii\helpers\FileHelper;
use yii\imagine\Image;
use Yii;

/**
 * Class WebpThumbnailer
 * @package app\modules\maximal\thumbnail\yii
 */
class WebpThumbnailer extends \maximal\thumbnail\WebpThumbnailer
{
	/**
	 * @var string Path of thumbnail cache directory; it can contain Yii aliases such as `@webroot` or `@app`
	 */
	public static $cachePathAlias = '@webroot/assets/thumbnails';

	/**
	 * @var string URL of thumbnail cache directory; it can contain Yii aliases such as `@web`
	 */
	public static $cacheUrlAlias = '@web/assets/thumbnails';

	/**
	 * @param string $path Path of the original image file; it can contain Yii aliases such as `@webroot` or `@app`
	 * @param int $width Width of generated thumbnail
	 * @param int $height Height of generated thumbnail
	 * @param bool $inset `true` for `THUMBNAIL_INSET` and `false` for `THUMBNAIL_OUTBOUND` mode
	 * @param array $options Key-value pairs of HTML attributes for the `&lt;img&gt;` tag
	 * @return string `&lt;picture&gt;` HTML tag with WebP source and `&lt;img&gt;` fallback (thumbnail of initial type)
	 */
	public static function picture($path, $width, $height, $inset = true, $options = [])
	{
		$image = FileHelper::normalizePath(Yii::getAlias($path));
		static::$cachePath = Yii::getAlias(static::$cachePathAlias);
		static::$cacheUrl = Yii::getAlias(static::$cacheUrlAlias);

		return parent::picture($image, $width, $height, $inset, $options);
	}

	protected static function createImagine()
	{
		return Image::getImagine();
	}
}
