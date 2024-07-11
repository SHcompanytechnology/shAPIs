<?php

include_once('conexaoSH.php');

$USUARIO= $_GET['usuario'];
$SENHA= $_GET['senha'];

$query = $pdo->query("SELECT * from Usuarios where Usuario= '$USUARIO' and Senha= '$SENHA'");

$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }
    $dados[] = array(
                  
        'id' => $res[$i]['id'],  
        'nome' => $res[$i]['Nome'], 
        'sobrenome' => $res[$i]['Sobrenome'], 
        'email' => $res[$i]['Email'], 
        'nivelDeHierarquia' => $res[$i]['NivelDeHierarquia'], 
        'telefone' => $res[$i]['Telefone'],      
    );
}

if (count($res) > 0) {
    $result = json_encode(array('success' => true, 'result' => $dados));
} else {
    $result = json_encode(array('success' => false, 'result' => '0'));
}
echo $result;