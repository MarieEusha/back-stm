<?php


namespace App\Controller;


use App\Entity\Player;
use Symfony\Component\HttpFoundation\File\File;

class PictureFilePlayerController
{
    public function __invoke(Player $data)
    {
        $dir = __DIR__.'\..\..\public\storage\images\\';

        $image = imagecreatefromjpeg($dir.$data->getPicture());
        dd($image);
    }
}