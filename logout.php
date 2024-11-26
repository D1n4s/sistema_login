<?php
//codigo pra deslogar do sistema
//inicia a sessão
session_start();

//detruir a sessao
session_destroy();

//redirecionar pra pagina de login
header("Location:index.php");
exit;