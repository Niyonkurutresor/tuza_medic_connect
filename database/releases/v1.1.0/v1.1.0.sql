create table `notifications`
(
    `id`         bigint unsigned not null auto_increment primary key,
    `title`      varchar(255) null,
    `type`       varchar(255) null,
    `read_at`    timestamp null,
    `user_id`    bigint unsigned null,
    `created_at` timestamp null,
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `notifications`
    add constraint `notifications_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade on update cascade;

alter table `users`
    add `email_notification` tinyint(1) not null default '1';
    
