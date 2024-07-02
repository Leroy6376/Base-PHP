<?php

function findUser(string $email): array
{
    $connection = connectToDB();
    $query = $connection->prepare('SELECT * FROM `users` WHERE `email` = :email LIMIT 1');
    $query->bindParam(':email', $email);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC) ?: [];
}

function getUser(string $id): array
{
    $connection = connectToDB();
    $query = $connection->prepare('SELECT * FROM `users` WHERE `id` = :id LIMIT 1');
    $query->bindParam(':id', $id);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC) ?: [];
}

function getUserProfile(string $id): array
{
    $user = getUser($id);
    $user['name'] = ['key' => 'ФИО', 'value' => $user['name']];
    $user['email'] = ['key' => 'Email', 'value' => $user['email']];
    $user['telephone'] = ['key' => 'Телефон', 'value' => phoneFormat($user['telephone'])];
    $user['active'] = ['key' => 'Активность', 'value' => $user['active'] ? 'Да' : 'Нет'];
    $user['email_send'] = ['key' => 'Подписан на рассылку', 'value' => $user['active'] ? 'Да' : 'Нет'];
    return [$user['name'], $user['email'], $user['telephone'], $user['active'], $user['email_send']];
}

function getUserGroups(string $id): array
{
    $connection = connectToDB();
    $query = $connection->prepare('SELECT `title`, `description` FROM `group_user` LEFT JOIN `groups` ON `group_id` = `groups`.`id` WHERE `user_id` = :id');
    $query->bindParam(':id', $id);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC) ?: [];
}

function validateUserProfile(array $user) : bool | string
{
    if (empty($user['name'])) {
        return 'Не задано ФИО пользователя';
    }
    if (empty($user['email'])) {
        return 'Не задан email пользователя';
    }
    if (!empty(findUser($user['email']))) {
        return 'Текущий email уже используется';
    }
    if (empty($user['password']) || mb_strlen($user['password']) < 6) {
        return 'Не задан пароль или его длина составляет менее 6 символов';
    }
    if ($user['password'] !== $user['password_confirmation']) {
        return 'Пароли должны совпадать';
    }
    return false;
}

function createUser(string $name, string $email, string $password): int
{
    $password = password_hash($password, PASSWORD_DEFAULT);
    $defaultTelephone = '01';
    $defaultActive = true;
    $defaultEmailSend = true;
    $connection = connectToDB();
    $query = $connection->prepare('INSERT INTO `users` (`email`, `password`, `name`, `telephone`, `active`, `email_send`) VALUES (:email, :password, :name, :telephone, :active, :email_send)');
    $query->bindParam(':email', $email);
    $query->bindParam(':password', $password);
    $query->bindParam(':name', $name);
    $query->bindParam(':telephone', $defaultTelephone);
    $query->bindParam(':active', $defaultActive);
    $query->bindParam(':email_send', $defaultEmailSend);

    $query->execute();
    return (int) $connection->lastInsertId();
}
