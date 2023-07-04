<?php
return [
    "permissions" => [
        [
            "section" => "adminPanel",
            "dependency" => "isAdmin",
            "title" => "پنل مدیریت",
            "child" => [
                [
                    "title" => "منوی داشبورد",
                    "group" => "dashbord",
                    "permission_title" => ["مشاهده"],
                    "permissions" => [
                        ["id" => "ucv", "title" => "مشاهده داشبورد", "disable" => true, "default" => true]
                    ]
                ],
                [
                    "title" => "بخش کاربرا",
                    "group" => "userList",
                    "permission_title" => ["مشاهده", "ویرایش", "حذف", "اضافه"],
                    "permissions" => [
                        ["id" => "ulv", "title" => "مشاهده لیست کاربران"],
                        ["id" => "ula", "title" => "اضافه کردن کاربر", "disable" => true, "default" => false],
                        ["id" => "ule", "title" => "ویرایش کاربران", "disable" => true, "default" => false],
                        ["id" => "uld", "title" => "حذف کاربران", "disable" => true, "default" => false],
                    ]
                ],
                [
                    "title" => "تنظیمات",
                    "group" => "settings",
                    "permission_title" => ["مشاهده", "ویرایش", "حذف", "اضافه"],
                    "dependency" => "ulvUserList",
                    "permissions" => [
                        ["id" => "usv", "title" => "مشاهده تنظیمات"],
                        ["id" => "usa", "title" => "اضافه کردن تنظیمات", "disable" => true, "default" => false],
                        ["id" => "use", "title" => "ویرایش تنظیمات", "disable" => true, "default" => false],
                        ["id" => "usd", "title" => "حذف تنظیمات", "disable" => true, "default" => false],
                    ]
                ],
                [
                    "title" => "مرخصی",
                    "group" => "vacation",
                    "permission_title" => ["مشاهده", "ویرایش", "حذف", "اضافه"],
                    "dependency" => "ulvUserList",
                    "permissions" => [
                        ["id" => "uvv", "title" => "مشاهده مرخصی"],
                        ["id" => "uva", "title" => "اضافه کردن مرخصی", "disable" => true, "default" => false],
                        ["id" => "uve", "title" => "ویرایش مرخصی", "disable" => true, "default" => false],
                        ["id" => "uvd", "title" => "حذف مرخصی", "disable" => true, "default" => false],
                    ]
                ]
            ],
        ]
    ]
];
