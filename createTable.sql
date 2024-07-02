CREATE TABLE `users` (
                         `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                         `email` VARCHAR(255) NOT NULL UNIQUE,
                         `password` VARCHAR(255) NOT NULL,
                         `name` VARCHAR(255),
                         `telephone` VARCHAR(20),
                         `active` BIT DEFAULT false,
                         `email_send` BIT DEFAULT false

);

CREATE TABLE `groups` (
                         `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                         `title` VARCHAR(255) NOT NULL UNIQUE,
                         `description` TEXT NOT NULL

);

CREATE TABLE `group_user` (
                          `user_id` INT NOT NULL,
                          `group_id` INT NOT NULL,
                          PRIMARY KEY (`user_id`, `group_id`),
                          FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
                          FOREIGN KEY (`group_id`) REFERENCES `groups`(`id`) ON DELETE CASCADE

);

CREATE TABLE `message_sections` (
                                    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                    `title` VARCHAR(255) NOT NULL,
                                    `color` ENUM('Черный', 'Зеленый', 'Красный', 'Оранжевый') NOT NULL DEFAULT 'Черный',
                                    `created_at` timestamp NOT NULL DEFAULT NOW(),
                                    `creator_id` INT NOT NULL,
                                    `parent_id` INT,
                                    FOREIGN KEY  (`creator_id`) REFERENCES `users`(`id`),
                                    FOREIGN KEY  (`parent_id`) REFERENCES `message_sections`(`id`)
);

CREATE TABLE `messages` (
                         `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                         `title` VARCHAR(255) NOT NULL,
                         `text` TEXT NOT NULL,
                         `created_at` timestamp NOT NULL DEFAULT NOW(),
                         `sender_id` INT NOT NULL,
                         `receiver_id` INT NOT NULL,
                         `section_id` INT NOT NULL,
                         FOREIGN KEY  (`sender_id`) REFERENCES `users`(`id`),
                         FOREIGN KEY  (`receiver_id`) REFERENCES `users`(`id`),
                         FOREIGN KEY  (`section_id`) REFERENCES `message_sections`(`id`)
);

INSERT INTO `users`
(`email`, `password`, `name`, `telephone`, `active`, `email_send`)
VALUES
    ('admin@example.com', '$2y$10$eMBfah05Llvt7X9lXi4RG.kRAsUOgNSgmkXafXbFNpRJ9m8zNQX.a', 'Администратор', '112', true, true),
    ('Leroy@mail.ru', '$2y$10$kq2pIBbNK5KXx9Goy1grnuTa5sCSNiOBG8KLptX10F7kp2gXO5oIK', 'Вавилов Илья Максимович', '79141531557', true, true),
    ('examplemail@mail.ru', '$2y$10$gcP6am0MS5SJPzCOWGslm.2g9d5oZGZxrEzL3B8wvhkxLTJSQ68/W', 'Пример пользователя', '112', false, false)
;

INSERT INTO `groups`
(`title`, `description`)
VALUES
    ('Администратор', 'Обладает правами администратора'),
    ('Пользователь', 'Обладает правами пользователя')
;

INSERT INTO `group_user`
(`user_id`, `group_id`)
VALUES
    ('1', '1'),
    ('1', '2'),
    ('2', '2')
;
