<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/25
 * Time: 11:44
 */

namespace app\common\lib;


class Aes
{
    private $hex_iv = '878zxc321smn7d9s0wkjuytrvbnd6gaq';

    private $key = '2j8s2jjugyuhgdnfijmwy36b7n8kmf8p';

    //加密数据
    public function encrypt($input)
    {
        $data = openssl_encrypt($input, 'AES-256-CBC', $this->key, OPENSSL_RAW_DATA, $this->hexToStr($this->hex_iv));
        $data = base64_encode($data);
        return $data;
    }
    //解密数据
    public function decrypt($input)
    {
        $decrypted = openssl_decrypt(base64_decode($input), 'AES-256-CBC', $this->key, OPENSSL_RAW_DATA, $this->hexToStr($this->hex_iv));
        return $decrypted;
    }
    private function addpadding($string, $blocksize = 16) {

        $len = strlen($string);

        $pad = $blocksize - ($len % $blocksize);

        $string .= str_repeat(chr($pad), $pad);

        return $string;

    }
    private function strippadding($string) {

        $slast = ord(substr($string, -1));

        $slastc = chr($slast);

        $pcheck = substr($string, -$slast);

        if (preg_match("/$slastc{" . $slast . "}/", $string)) {

            $string = substr($string, 0, strlen($string) - $slast);

            return $string;

        } else {

            return false;

        }

    }
    function hexToStr($hex)
    {

        $string='';

        for ($i=0; $i < strlen($hex)-1; $i+=2)

        {

            $string .= chr(hexdec($hex[$i].$hex[$i+1]));

        }

        return $string;
    }
}