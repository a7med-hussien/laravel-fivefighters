<?php 


namespace App\Http\Helpers;
use App\Http\Controllers\Slim;

class FullStack
{
	
	public static function uploadImage($name, $destination)
	{
		$image = Slim::getImages($name)[0];
		$ext = pathinfo($image['input']['name'], PATHINFO_EXTENSION);
		$name = rand(9999999,00000).'_'.date('ymd').'.'.$ext;
		$data = $image['output']['data'];
		$file = Slim::saveFile($data, $name, $destination);
		return $file['path'];
	}

}
?>