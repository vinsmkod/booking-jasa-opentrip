
<?php
namespace App\Libraries;

use CodeIgniter\Images\Handlers\GDHandler;

class CustomGDHandler extends GDHandler
{
    protected function copyImage($src, $dest)
    {
        // Pastikan semua variabel tidak bernilai null
        $this->xAxis = $this->xAxis ?? 0;
        $this->yAxis = $this->yAxis ?? 0;
        $this->width = $this->width ?? imagesx($src);
        $this->height = $this->height ?? imagesy($src);
        $origWidth = imagesx($src);
        $origHeight = imagesy($src);

        // Panggil fungsi copy
        return imagecopyresampled(
            $dest,
            $src,
            0,
            0,
            $this->xAxis,
            $this->yAxis,
            $this->width,
            $this->height,
            $origWidth,
            $origHeight
        );
    }
}
