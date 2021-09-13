<?php

namespace App\Models;


class Utilidades
{
    public static function convertirFechaFormatoNormal($fecha)
    {
        $res = null;

        if ($fecha != null) {
            $res = date('d-m-Y', strtotime(str_replace('/', '-', $fecha)));
        }

        return $res;
    }

    public static function convertirFechaFormatoBaseDatos($fecha)
    {
        $res = null;

        if ($fecha != null) {
            $res = date('Y-m-d', strtotime(str_replace('/', '-', $fecha)));
        }

        return $res;
    }

    public static function convertirFormatoFechaHoraBaseDatos($fecha)
    {
        $res = null;

        if ($fecha != null) {
            $res = date('Y-m-d h:i', strtotime(str_replace('/', '-', $fecha)));
        }

        return $res;
    }

    public static function encode_img_base64($img_path = false, $img_type = 'png')
    {
        try {
            if ($img_path) {
                //convert image into Binary data
                $img_data = fopen($img_path, 'rb');
                $img_size = filesize($img_path);
                $binary_image = fread($img_data, $img_size);
                fclose($img_data);

                //Build the src string to place inside your img tag
                $img_src = "data:image/" . $img_type . ";base64," . str_replace("\n", "", base64_encode($binary_image));

                return $img_src;
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return false;
        }

        return false;
    }
}
