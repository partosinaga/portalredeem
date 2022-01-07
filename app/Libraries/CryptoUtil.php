<?php

/**
 * Description of CryptoUtil lib
 *
 * @Author: NH - CGW
 *
 */
class CryptoUtil {
	private static $ENCRYPT_PATTERN; // ENCRYPT PATTERN: Ubah susunan array (0-9) untuk menset PATTERN anda sendiri. Example: array(9,8,7,6,5,4,3,2,1,0)
	private static $HASH_N = 10; // Set 2-10; Untuk mensplit hash (displit sesuai nilai N) dan kemudian diacak susunannya.
	private static $HASH =  array('abcde','fghij','klmno','pqrst','uvwxyz','ABCDE','FGHIJ','KLMNO','PQRST','UVWXYZ'); // Tidak boleh ada huruf yang sama dari masing-masing value

	public function __construct() {
		self::$ENCRYPT_PATTERN = explode(',', env('CRYPTO_PATTERN'));
	}

	public static function encrypt($str) {
        if (!is_array(self::$ENCRYPT_PATTERN) || !is_array(self::$HASH) || count(self::$ENCRYPT_PATTERN) != self::$HASH_N || count(self::$HASH) != self::$HASH_N) {
            return FALSE;
        }

        $HASH_MAPS = array_combine(self::$ENCRYPT_PATTERN, self::$HASH);

        $first_salt = _randCode(rand(1,9));
        $last_salt = _randCode(rand(1,9));

        $hex_str = unpack('H*', $str);
        $hash = $first_salt. array_shift($hex_str) . $last_salt . strlen($last_salt) . strlen($first_salt);

        $split_to	= self::$HASH_N;
        if (strlen($hash) < $split_to) return FALSE;

        $split_len	= floor(strlen($hash)/$split_to);

        $split_hash = array();
        $i=0; $offset=0;
        while ($i<$split_to) {
            $i++;
            $split_hash[] = $i==$split_to ? substr($hash, $offset) : substr($hash, $offset, $split_len);
            $offset = $i * $split_len;
        };
        $hash_keys = array_keys($split_hash);
        array_pop($hash_keys);
        shuffle($hash_keys);

        $hash_key = ''; $hash_val = '';
        foreach($hash_keys as $key) {
            $hash_val .= $split_hash[$key];
            $hash_key .= substr(str_shuffle($HASH_MAPS[$key]), 0, 1);
        }
        $hash_val .= $split_hash[strlen($hash_key)];
        $hash_key .= substr(str_shuffle($HASH_MAPS[strlen($hash_key)]), 0, 1);

        return $hash_key.$hash_val;
	}

	public static function decrypt($encryption) {
		try {
			$HASH_MAPS = array_combine(self::$ENCRYPT_PATTERN, self::$HASH);

			$key_len	= self::$HASH_N;
			if (strlen($encryption) < ($key_len*2)) return FALSE;

			$hash = substr($encryption, $key_len);
			$split_len	= floor(strlen($hash)/$key_len);

			$split_hash = array();
			$i=0; $offset=0;
			while ($i<$key_len) {
				$i++;
				$split_hash[] = $i==$key_len ? substr($hash, $offset) : substr($hash, $offset, $split_len);
				$offset = $i * $split_len;
			};


			$hash_key = substr($encryption, 0, $key_len);
			$reserve_hash = array();
			for ($i=0; $i<$key_len; $i++) {
				$key = array_keys(preg_grep('/'.$hash_key[$i].'/', $HASH_MAPS));
				$reserve_hash[$key[0]] = $split_hash[$i];
			}
			ksort($reserve_hash);
			$hash_val = implode('', $reserve_hash);

			$salt_key = substr($hash_val, -2, 2);
			if (!is_numeric($salt_key)) return FALSE;

			return pack('H*', substr($hash_val, $salt_key[1], -(2 + $salt_key[0])));
		} catch(\Exception $exc) {
			//throw $exc;
			return FALSE;
		}
	}

}
?>