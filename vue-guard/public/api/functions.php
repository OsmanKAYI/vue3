<?php

function dieErrorWithJson($message)
{
  $arrResponse = array();
  $arrResponse['error'] = $message;
  $arrResponse['success'] = false;
  dieWithJson($arrResponse);
} // dieErrorWithJson

function dieWithJson($arrResponse)
{
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($arrResponse, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  die();
} // dieWithJson

function DD($el, $title = "")
{
  if ($title <> "") echo "<h1>$title</h1>";
  echo "
  <pre>";
  print_r($el);
  echo "</pre>";
} // DD

function DDD($el, $title = "")
{
  DD($el, $title);
  die();
} // DDD

function Capitalize($str)
{
  $lowercase = array('ğ', 'ü', 'ş', 'i', 'ö', 'ç', 'ı');
  $uppercase = array('Ğ', 'Ü', 'Ş', 'İ', 'Ö', 'Ç', 'I');
  $str = trim(str_replace($lowercase, $uppercase, $str));
  $str = strtoupper($str);
  return $str;
} // Capitalize

function generateJWT($id, $payloadData, $mySecretKeyForJwt)
{
  // JWT header (This section is FIXED)
  $header = [
    'alg' => 'HS256',
    'typ' => 'JWT',
  ];

  // JWT payload
  $payload = [
    'sub' => $id,
    'iat' => time(), // Issued At: The time when the token was generated
    'exp' => time() + (3600 * 24), // Expiration Time: The validity period of the token (24 hours in this example)
  ];

  $payload            = array_merge($payload, $payloadData);

  // Encode the header and payload in base64url format
  $base64UrlHeader    = base64UrlEncode(json_encode($header));
  $base64UrlPayload   = base64UrlEncode(json_encode($payload));

  // Create the signature
  $signature          = hash_hmac('sha256', "$base64UrlHeader.$base64UrlPayload", $mySecretKeyForJwt, true);

  // Encode the signature in base64url format
  $base64UrlSignature = base64UrlEncode($signature);

  // Create the JWT
  $jwt = "$base64UrlHeader.$base64UrlPayload.$base64UrlSignature";

  return $jwt;
} // generateJWT

// Base64url encode function
function base64UrlEncode($data)
{
  return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function verifyJWT($secretKey)
{
  $validToken = true;

  // "Header" bilgisinden "Authorization" verisini al
  $headers = getallheaders();
  $authorizationHeader = isset($headers['Authorization']) ? $headers['Authorization'] : '';

  // Extract the token from the Authorization header (assuming it is in the format "Bearer {token}")
  $tokenParts = explode(' ', $authorizationHeader);
  $token = isset($tokenParts[1]) ? $tokenParts[1] : '';

  if (empty($token)) {
    return array(!$validToken, 'Token bulunamadı!');
  }

  // Split the token into its three parts
  list($header, $payload, $signature) = explode('.', $token);

  // Base64 decode the header and payload
  $decodedHeader  = base64_decode($header);
  $decodedPayload = base64_decode($payload);

  // Recreate the signature from the decoded parts
  $calculatedSignature = hash_hmac('sha256', "$header.$payload", $secretKey, true);
  $calculatedSignature = base64UrlEncode($calculatedSignature);

  // Compare the recreated signature with the received signature
  if ($calculatedSignature == $signature) {
    // Signature is valid, proceed to check expiration time (exp claim)
    // You can access the claims in the payload
    $claims = json_decode($decodedPayload, true);
    // Check if the token is expired
    $currentTimestamp = time();
    if (isset($claims['exp']) && $claims['exp'] > $currentTimestamp) {
      return array($validToken, 'Token geçerli!'); // Token ve süresi geçerli!
      //print_r($claims);
    } else {
      return array(!$validToken, 'Token geçerlilik süresi bitmiş!');
    }
  } else {
    return array(!$validToken, 'Token doğrulanamadı!');
  }
} // verifyJWT