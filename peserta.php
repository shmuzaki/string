<?php
//nokartu = 1001012491091
$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
$xml .= "<soap:Envelope xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>";
$xml .= "<soap:Body>";
$xml .= "<EligibilitasPeserta xmlns='http://tempuri.org/'>";
$xml .= "<token>WhTCrcPRDrv5d1JZAFEBrw==</token>";
$xml .= "<nokainhealth>1001012491091</nokainhealth>";
$xml .= "<tglpelayanan>2017-07-24T00:00:00</tglpelayanan>";
$xml .= "<kodeprovider>1801R023</kodeprovider>";
$xml .= "<jenispelayanan>3</jenispelayanan>";
$xml .= "<poli>BDM</poli>";
$xml .= "</EligibilitasPeserta>";
$xml .= "</soap:Body>";
$xml .= "</soap:Envelope>";

$xmlOb=new SimpleXMLElement($xml);
$xmlOb->asXML("request_eligibilitas.xml");

//tampilkan xml di browser
//header('Content-Type: application/xml; charset=utf-8');
//tampilkan data xml di browser
//echo $xml;

function post_xml($url,$xml) {

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_HEADER, true);
  curl_setopt($ch, CURLINFO_HEADER_OUT, true);
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_HTTPHEADER, Array(
  "Content-Type: text/xml; charset=utf-8",
  "Content-Length:".strlen($xml),
  "SOAPAction: \"http://tempuri.org/EligibilitasPeserta\"",
  ));
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $xml );
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

  $result = curl_exec($ch);
  $info = curl_getinfo($ch);
  curl_close($ch);
  return $result;
}  

$url = 'https://dummy.inhealth.co.id/pelkesws/InHealthService.asmx';

//echo post_xml($url,$xml);
$hasil = post_xml($url,$xml);

$xmlOb=new SimpleXMLElement($hasil);
$xmlOb->asXML("response_eligibilitas.xml");

header('Content-Type: application/xml; charset=utf-8');
echo $hasil;

//$file = file_get_contents($hasil);
//$data = simplexml_load_string($file);
//print_r($data);

//$data= simplexml_load_string($hasil);
//print_r($data);
//$string = htmlentities($hasil);
//echo htmlspecialchars($hasil);

//$file = file_get_contents("response_eligibilitas.xml");
//$xmldata = new SimpleXMLElement($file);
//echo $data->xpath('soap:envelope');
//echo $data->EligibilitasPesertaResponse->EligibilitasPesertaResult->NMPST;

//foreach($xmldata->children()->children() as $child){
 //           echo $child->getName()."<br />";
//}
//echo $data->EligibilitasPesertaResponse->EligibilitasPesertaResult->NMPST;