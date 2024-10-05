create table `reviews`
(
    `id`         bigint unsigned not null auto_increment primary key,
    `patient_id` int unsigned not null,
    `doctor_id`  bigint unsigned not null,
    `review`     varchar(255) not null,
    `rating`     int          not null,
    `created_at` timestamp null,
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `reviews`
    add constraint `reviews_patient_id_foreign` foreign key (`patient_id`) references `patients` (`id`) on delete cascade on update cascade;
alter table `reviews`
    add constraint `reviews_doctor_id_foreign` foreign key (`doctor_id`) references `doctors` (`id`) on delete cascade on update cascade;
create table `google_calendar_integrations`
(
    `id`           bigint unsigned not null auto_increment primary key,
    `user_id`      bigint unsigned not null,
    `access_token` varchar(255) not null,
    `meta`         json         not null,
    `last_used_at` varchar(255) not null,
    `created_at`   timestamp null,
    `updated_at`   timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `google_calendar_integrations`
    add constraint `google_calendar_integrations_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete CASCADE on update CASCADE;
create table `google_calendar_lists`
(
    `id`                 bigint unsigned not null auto_increment primary key,
    `user_id`            bigint unsigned not null,
    `calendar_name`      varchar(255) not null,
    `google_calendar_id` varchar(255) not null,
    `meta`               json         not null,
    `created_at`         timestamp null,
    `updated_at`         timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `google_calendar_lists`
    add constraint `google_calendar_lists_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete CASCADE on update CASCADE;
create table `appointment_google_calendars`
(
    `id`                      bigint unsigned not null auto_increment primary key,
    `user_id`                 bigint unsigned not null,
    `google_calendar_list_id` bigint unsigned not null,
    `google_calendar_id`      varchar(255) not null,
    `created_at`              timestamp null,
    `updated_at`              timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `appointment_google_calendars`
    add constraint `appointment_google_calendars_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete CASCADE on update CASCADE;
alter table `appointment_google_calendars`
    add constraint `appointment_google_calendars_google_calendar_list_id_foreign` foreign key (`google_calendar_list_id`) references `google_calendar_lists` (`id`) on delete CASCADE on update CASCADE;
alter table `users`
    add `time_zone` varchar(255) null;
create table `user_google_appointments`
(
    `id`                 bigint unsigned not null auto_increment primary key,
    `user_id`            bigint unsigned not null,
    `appointment_id`     varchar(255) not null,
    `google_calendar_id` varchar(255) not null,
    `google_event_id`    varchar(255) not null,
    `created_at`         timestamp null,
    `updated_at`         timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `user_google_appointments`
    add constraint `user_google_appointments_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete CASCADE on update CASCADE;
