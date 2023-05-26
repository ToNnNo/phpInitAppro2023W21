<?php
require_once dirname(__DIR__).'/secure/adminGuardAuthenticator.php';
require_once dirname(__DIR__).'/functions/sql.php';
require_once dirname(__DIR__).'/functions/session.php';
require_once dirname(__DIR__).'/functions/response.php';
require_once dirname(__DIR__).'/functions/request.php';
require_once dirname(__DIR__).'/functions/render.php';

$id = query('livre');

$sql = "select id from livre where id=?";
$livre = find($sql, [$id]);

if(!$livre) {
    redirect('livres.php');
}

$sql = "delete from livre where id=?";
execute($sql, [$id]);

addFlash('success', 'Le livre a bien été supprimé');
redirect('livres.php');