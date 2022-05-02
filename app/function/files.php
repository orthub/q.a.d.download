<?php
require_once __DIR__ . '/database.php';

function get_user_role_by_id(string $user_id)
{
  $sql = 'SELECT `user_role` FROM `users` WHERE `id` = :user_id';
  $stmt = get_db()->prepare($sql);
  $stmt->execute([':user_id' => $user_id]);
  $res = $stmt->fetchColumn();

  return $res;
}


function get_files_from_db_for_user_role(string $user_role)
{
  $sql = 'SELECT `id`, `path`, `doc_user_role`
          FROM `documents`
          WHERE `doc_user_role` = :doc_user_role';
  $stmt = get_db()->prepare($sql);
  $stmt->execute([':doc_user_role' => $user_role]);
  $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

  return $res;
}