<?php


namespace App\Controller;


use App\Entity\Player;
use Symfony\Component\HttpFoundation\File\File;

class PictureFilePlayerController
{
    public function __invoke(Player $data)
    {
        $path = 'storage\images\\'.$data->getPicture();
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pictureBase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        //$image = imagecreatefromjpeg('storage\images\\'.$data->getPicture());
        return $pictureBase64;
    }
}