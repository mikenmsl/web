<?php
header('Content-Type: text/html; charset=utf-8');


$host =  '127.0.0.1:3306';
$database = 'ips';
$user = 'root'; 
$password = ''; 
include 'simple_html_dom.php';
//PDO
$data = json_decode(file_get_contents("php://input"), true);
$sw = $data['action'].'_'.$data['table'];
if ($data['action'] != 'pars'){
  $db = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password);
  try
  {
      $db = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password);
  }
  catch(  PDOException $e  )
  {
      echo "You have an error: ".$e->getMessage()."<br>";
      echo "On line: ".$e->getLine();
  }
 
  $table = $data['table'];
  $db->query('SET CHARACTER SET utf8'); 
}
switch($sw) {
  case 'select_sources':
    $query = 'SELECT * FROM '.$data['table'];
      $res =   $db->query($query);
      $result = $res->FETCHALL(PDO::FETCH_ASSOC);
      echo   json_encode($result);
    break;
  case 'select_links':
    $query = 'SELECT * FROM '.$data['table'];
    $query = $query.' WHERE source_id = '.$data['id'];
    $res =   $db->query($query);
    $result = $res->FETCHALL(PDO::FETCH_ASSOC);
    echo   json_encode($result);
    break;
  case 'select_tools':
    $query = 'SELECT * FROM '.$data['table'];
    $query = $query.' WHERE source_id = '.$data['id_s'];
    $query = $query.' AND link_id = '.$data['id_l'];
    $res =   $db->query($query);
    $result = $res->FETCHALL(PDO::FETCH_ASSOC);
    echo json_encode($result);
    break;
  case 'select_resources':
    $query = 'SELECT * FROM '.$data['table'];
    $query = $query.' WHERE source_id = '.$data['id_s'];
    $query = $query.' AND link_id = '.$data['id_l'];
    $res =   $db->query($query);
    $result = $res->FETCHALL(PDO::FETCH_ASSOC);
    echo json_encode($result);
    break;
  case 'add_sources':
    $add = $data['data'];
    $query = "INSERT INTO sources (source_id, source_name, ip_address, issued_year, developers) VALUES ('".$add['source_id']."', '".$add['source_name']."', '".$add['ip_address']."', '".$add['issued_year']."', '".$add['developers']."');";
    $res =   $db->query($query);
    echo  json_encode($query);
    break;
  case 'add_links':
    $add = $data['data'];
    $query = "INSERT INTO links (link_id, source_id, url) VALUES ('".$add['link_id']."', '".$add['source_id']."', '".$add['url']."');";
    $res =   $db->query($query);
    echo  json_encode($query);
    break;
  case 'add_resources':
    $res = $data['resources'];
    $tool = $data['tools'];
    $resource_id = $db->query('SELECT MAX(resource_id) FROM `resources`')->FETCH(PDO::FETCH_ASSOC);
    $tool_id = $db->query('SELECT MAX(tool_id) FROM `tools`')->FETCH(PDO::FETCH_ASSOC);
    $resource_id['MAX(resource_id)'] += 1;
    $tool_id['MAX(tool_id)'] += 1;
    $query_t = "INSERT INTO `tools` (`tool_id`, `tool`, `link_id`, `source_id`) VALUES ('".$tool_id['MAX(tool_id)']."', '".$tool['tool']."', '".$tool['link_id']."','".$tool['source_id']."');";
    $query_r = "INSERT INTO `resources` (`resource_id`, `resource`, `link_id`, `source_id`) VALUES ('".$resource_id['MAX(resource_id)']."', '".$res['resource']."', '".$tool['link_id']."','".$tool['source_id']."');";
    $res =   $db->query($query_r);
    $res =   $db->query($query_t);
    echo   $tool_id['MAX(tool_id)'];
    break;
  case 'remove_all':
    $query_r = "DELETE FROM resources WHERE source_id = ".$data['id'];
    $query_t = "DELETE FROM tools WHERE source_id = ".$data['id'];
    $query_l = "DELETE FROM links WHERE source_id = ".$data['id'];
    $query_s = "DELETE FROM sources WHERE source_id = ".$data['id'];
    $res = $db->query($query_r);
    $res = $db->query($query_t);
    $res = $db->query($query_l);
    $res = $db->query($query_s);
    echo json_encode($query_s);
    break;
  case 'remove_links': 
    $links_id = $data['data'];
    $query_r = "DELETE FROM resources WHERE source_id = ".$data['id']." AND link_id in (". implode(', ', $links_id).");";
    
    $query_t = "DELETE FROM tools WHERE source_id = ".$data['id']." AND link_id in (". implode(', ', $links_id).");";

    $query_l = "DELETE FROM links WHERE source_id = ".$data['id']." AND link_id in (". implode(', ', $links_id).");";
    $res =   $db->query($query_r);
    $res =   $db->query($query_t);
    $res =   $db->query($query_l);
    echo json_encode($query_l);
    break;
  case 'update_resources':
    $res = $data['resources'];
    $tool = $data['tools'];
    $query_t = "UPDATE `tools` SET `tool` = '".$tool['tool']."' WHERE `tools`.`link_id` = ".$tool['link_id']." AND `tools`.`source_id` = ".$tool['source_id']."; ";
    $query_r = "UPDATE `resources` SET `resource` = '".$res['resource']."' WHERE `resources`.`link_id` = ".$tool['link_id']." AND `resources`.`source_id` = ".$tool['source_id'].";";
    $res =   $db->query($query_r);
    $res =   $db->query($query_t);
    echo  $query_r.$query_t;
    break;
  case 'edit_sources':
    $dt = $data['data'];
    echo json_encode($data['data']);
    $query = "UPDATE `sources` SET `source_name` = '".$dt['source_name']."', `ip_address` = '".$dt['ip_address']."', `issued_year` = '".$dt['issued_year']."', `developers` = '".$dt['developers']."' WHERE `sources`.`source_id` = ".$dt['source_id'].";";
    $res =   $db->query($query);
    echo  $query;

    break;
  case 'pars_resources':
    $tags = explode(" + ", $data['data']);
    $html = new simple_html_dom();
    $html->load_file($data['url']);
    $objects = $html->find($tags[0]);
    if ($tags[1]){
      preg_match_all('|\d+|', $tags[1], $matches);
      foreach ($matches[0] as $var) {
        $text .= $objects[$var-1]->plaintext;       
      }      
    }
    else {
      foreach ($objects as $object) {
        $text .= $object->plaintext;
      }
    }
    $text = preg_replace('/\s+/', ' ', $text); 
    echo json_encode($text);
    break;
}
?>


