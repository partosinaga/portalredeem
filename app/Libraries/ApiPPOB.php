<?php
require_once 'Curl.php';
/**
 * Description of ApiPPOB lib
 *
 * For calling the PPOB APIs, so put the API were needed here.
 *
 * @Author: NH - CGW
 *
 * API list:
 * - PPOB Adapter
 * - ....
 */
class ApiPPOB {
	const CODE_SUCCESS = "00";

	/**
	 * Description of Function trxPPOB
	 * @Header:
	 * 		- Content-Type: application/json
	 * 		- Authorization: Bearer {token}
	 * @Method: POST
	 * @Params:
	 * 		- data (required)
	 * @Response: JSON
	 *
	 * @Author: NH - CGW
	 *
	 */
	public function trxPPOB($post_data) {
        $api_url = env('API_URL_PPOB');
        $http_headers = array(
            "Content-Type: application/json"
        );

        $ch = new \Curl();
        $ch->create($api_url);
        $ch->option(CURLOPT_CONNECTTIMEOUT, 60);
        $ch->option(CURLOPT_TIMEOUT, 60);
        //$ch->option(CURLOPT_HTTPHEADER, $http_headers);
        $ch->option(CURLOPT_RETURNTRANSFER, 1);
        $ch->post($post_data);

        $execute	= $ch->execute();
        $curl_info	= $ch->info;

        return array(
            'url' => $api_url,
            'res' => (preg_match('/^(\{|\[)/', substr($execute, 0, 1)) ? json_decode($execute, true) : $execute),
            'info' => $curl_info
        );
	}

}
?>