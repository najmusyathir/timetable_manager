INSERT INTO
    `batches` (`id`, `intake`, `semester`)
VALUES
    (2, '2023/Q3', 4),
    (3, '2024/Q1', 3),
    (4, '2024/Q3', 2),
    (6, '2025/Q1', 1),
    (7, '2023/Q1', NULL);

INSERT INTO
    `classrooms` (`id`, `name`)
VALUES
    (23, 'Kelas 1'),
    (24, 'Kelas 2'),
    (25, 'Kelas 3'),
    (26, 'Makmal Komputer'),
    (27, 'Dewan Seminar'),
    (28, 'Makmal Sains'),
    (29, 'Makmal Kimia'),
    (30, 'Makmal Fizik'),
    (31, 'Bilik Seni'),
    (32, 'Bilik Muzik'),
    (33, 'Makmal Biologi');

INSERT INTO
    `courses` (`id`, `code`, `semester`)
VALUES
    (1, 'SS1', '2'),
    (2, 'S1', '1'),
    (5, 'S2', '2'),
    (9, 'AA3', '2');

INSERT INTO
    `users` (
        `id`,
        `name`,
        `email`,
        `email_verified_at`,
        `user_type`,
        `password`,
        `remember_token`,
        `created_at`,
        `updated_at`,
        `matric_no`,
        `phone_no`,
        `batch_id`,
        `course_id`
    )
VALUES
    (
        1,
        'admin',
        'admin@gmail.com',
        NULL,
        'admin',
        '$2y$12$qDaQlkk14q7mS0UGKzJ/O.PvRNiEzEPXoNAe.PQ2RcVxOQY2f92Va',
        NULL,
        '2024-06-10 21:54:48',
        '2024-06-10 21:54:48',
        NULL,
        NULL,
        NULL,
        NULL
    ),
    (
        2,
        'stud1',
        'stud1@gmail.com',
        NULL,
        'student',
        '$2y$12$TY5laWKZUMbfnKSqQV8L1OYbzzBEgXROW3SQO.pEjJFaov5xJywhi',
        NULL,
        '2024-06-10 21:55:45',
        '2024-06-10 21:59:51',
        'S001',
        NULL,
        NULL,
        NULL
    ),
    (
        3,
        'stud2',
        'stud2@gmail.com',
        NULL,
        'student',
        '$2y$12$rob7CHvSpMWKIduwnD8M7O3JlhDb0sollaVygJcE3rSLYTo7vC/26',
        NULL,
        '2024-06-10 21:57:58',
        '2024-06-10 22:00:04',
        'S002',
        NULL,
        NULL,
        NULL
    ),
    (
        4,
        'stud3',
        'stud3@gmail.com',
        NULL,
        'student',
        '$2y$12$RZ3mfx02Xt.NnYi/qY1FAuADnpgyziggg.0yBwOE6Wpnph0ZmL9Ve',
        NULL,
        '2024-06-10 21:58:19',
        '2024-06-10 22:00:12',
        'S003',
        NULL,
        NULL,
        NULL
    ),
    (
        5,
        'teach1',
        'teach1@gmail.com',
        NULL,
        'teacher',
        '$2y$12$21En4oR/YkcGUwuyY4LcyeKihcCxgtIFnKLLe25H2OApnyKtYIXAK',
        NULL,
        '2024-06-10 21:58:41',
        '2024-06-10 22:00:20',
        'T001',
        NULL,
        NULL,
        NULL
    ),
    (
        6,
        'teach2',
        'teach2@gmail.com',
        NULL,
        'teacher',
        '$2y$12$EYkFXV4ORNZ/L4X9m48NJum3sH4Uf.zkK84a5XnouwxZpw0uOnbFq',
        NULL,
        '2024-06-10 21:58:59',
        '2024-06-10 22:00:31',
        'T002',
        NULL,
        NULL,
        NULL
    ),
    (
        7,
        'teach3',
        'teach3@gmail.com',
        NULL,
        'teacher',
        '$2y$12$rAYKMEaxyOTreciba764k.coHB.Y9A.DT..kYA9WHmPgEWYe47r7i',
        NULL,
        '2024-06-10 21:59:17',
        '2024-06-10 22:00:40',
        'T003',
        NULL,
        NULL,
        NULL
    );

INSERT INTO
    `subjects` (`id`, `name`, `code`, `credit_hour`)
VALUES
    (1, 'Sejarah', 'SEJ', 2),
    (8, 'Bahasa Malaysia', 'BM', 3),
    (11, 'Additional Mathematics', 'AMT', 3),
    (13, 'Physics', 'PHY', 3),
    (14, 'Biology', 'BIO', 3),
    (18, 'Chemistry', 'CHM', 3),
    (20, 'Pengajian Am', 'PA', 3),
    (21, 'Syariah', 'SYA', 3),
    (22, 'Pengajian Perniagaan', 'PP', 3),
    (23, 'MUET', 'MUET', 3),
    (24, 'Kokurikulum', 'KOKU', 2),
    (25, 'Geography', 'GEO', 3),
    (26, 'Sport Science', 'SS', 3);

INSERT INTO
    `days` (`id`, `name`)
VALUES
    (1, 'Sunday'),
    (2, 'Monday'),
    (3, 'Tuesday'),
    (4, 'Wednesday'),
    (5, 'Thursday'),
    (6, 'Friday'),
    (7, 'Saturday');

INSERT INTO
    `timeslots` (`id`, `time`)
VALUES
    (1, "07:50"),
    (2, "08:30"),
    (3, "09:10"),
    (4, "09:50"),
    (5, "10:20"),
    (6, "11:00"),
    (7, "11:40"),
    (8, "12:20"),
    (9, "13:00"),
    (10, "13:40"),
    (11, "14:20"),
    (12, "15:00"),
    (13, "15:40"),
    (14, "16:20"),
    (15, "17:00");

INSERT INTO
    `schedules` (
        `id`,
        `subject_id`,
        `instructor_id`,
        `course_id`,
        `location_id`,
        `day_id`,
        `start_id`,
        `end_id`
    )
VALUES
    (10, 20, 5, 9, 27, 2, NULL, NULL),
    (11, 21, 6, 9, 23, 2, NULL, NULL),
    (12, 21, 6, 9, 23, 2, NULL, NULL),
    (13, 22, 7, 9, 24, 2, NULL, NULL),
    (14, 23, 5, 9, 27, 3, NULL, NULL),
    (15, 1, 6, 9, 24, 3, NULL, NULL),
    (16, 1, 6, 9, 24, 3, NULL, NULL),
    (17, 20, 7, 9, 27, 3, NULL, NULL),
    (18, 21, 5, 9, 23, 4, NULL, NULL),
    (19, 23, 6, 9, 24, 4, NULL, NULL),
    (20, 23, 6, 9, 24, 4, NULL, NULL),
    (21, 1, 7, 9, 25, 4, NULL, NULL),
    (22, 20, 5, 9, 27, 4, NULL, NULL),
    (23, 24, 7, 9, 32, 4, NULL, NULL);