<template>
    <div class="dark:bg-gray-800">
        <div class="dark:text-fog">
            <b-row v-for="(role, i) in roleList" :key="i">
                <b-col cols="4">
                    <h5 v-text="role.title"></h5>
                </b-col>
                <b-col cols="8">
                    <b-btn @click="getRoleForEdit(role)">edit</b-btn>
                    <b-btn @click="deleteRole(role.id)">delete</b-btn>
                </b-col>
            </b-row>
        </div>

        <div>
            <b-form-input placeholder="عنوان نقش" v-model="role.title"></b-form-input>

            <b-checkbox :value="{permission: 'isAdmin', dependency: null}"
                        @change="!userPermission.find((obj) => {return obj.permission === 'isAdmin'})? userPermission = [] : true">
            </b-checkbox>

            <div v-for="(section, i) in availablePermission" :key="i">
                <permission-component :data="section.child"></permission-component>
            </div>

            <b-btn variant="outline-primary" @click="createRole" v-if="!role.id">create role</b-btn>
            <b-btn variant="outline-primary" @click="editRole" v-else>edit role</b-btn>
            {{ userPermission }}
        </div>
    </div>
</template>

<script>
import CryptoJS from "crypto-js";

export default {
    name: "RoleComponent",
    data() {
        return {
            role: {
                id: null,
                title: null
            },
            roleList: [],
            availablePermission: [
                {
                    "section": "adminPanel",
                    "dependency": "isAdmin",
                    "title": "پنل مدیریت",
                    "child": [
                        {
                            "title": "منوی داشبورد",
                            "group": "dashbord",
                            "permission_title": [
                                "مشاهده"
                            ],
                            "permissions": [
                                {
                                    "id": "ucv",
                                    "title": "مشاهده داشبورد",
                                    "disable": true,
                                    "default": true
                                }
                            ]


                        },
                        {
                            "title": "بخش کاربرا",
                            "group": "userList",
                            "permission_title": [
                                "مشاهده",
                                "ویرایش",
                                "حذف",
                                "اضافه"
                            ],
                            "permissions": [
                                {
                                    "id": "ulv",
                                    "title": "مشاهده لیست کاربران"
                                },
                                {
                                    "id": "ula",
                                    "title": "اضافه کردن کاربر",
                                    "disable": true,
                                    "default": false
                                },
                                {
                                    "id": "ule",
                                    "title": "ویرایش کاربران",
                                    "disable": true,
                                    "default": false
                                },
                                {
                                    "id": "uld",
                                    "title": "حذف کاربران",
                                    "disable": true,
                                    "default": false
                                }
                            ]
                        },
                        {
                            "title": "تنظیمات",
                            "group": "settings",
                            "permission_title": [
                                "مشاهده",
                                "ویرایش",
                                "حذف",
                                "اضافه"
                            ],
                            "permissions": [
                                {
                                    "id": "usv",
                                    "title": "مشاهده تنظیمات"
                                },
                                {
                                    "id": "usa",
                                    "title": "اضافه کردن تنظیمات",
                                    "disable": true,
                                    "default": false
                                },
                                {
                                    "id": "use",
                                    "title": "ویرایش تنظیمات",
                                    "disable": true,
                                    "default": false
                                },
                                {
                                    "id": "usd",
                                    "title": "حذف تنظیمات",
                                    "disable": true,
                                    "default": false
                                }
                            ]
                        },
                        {
                            "title": "کلاس ها",
                            "group": "class",
                            "permission_title": [
                                "مشاهده",
                                "ویرایش",
                                "حذف",
                                "اضافه"
                            ],
                            "permissions": [
                                {
                                    "id": "ucv",
                                    "title": "مشاهده کلاس"
                                },
                                {
                                    "id": "uca",
                                    "title": "اضافه کردن کلاس",
                                    "disable": true,
                                    "default": false
                                },
                                {
                                    "id": "uce",
                                    "title": "ویرایش کلاس",
                                    "disable": true,
                                    "default": false
                                },
                                {
                                    "id": "ucd",
                                    "title": "حذف کلاس",
                                    "disable": true,
                                    "default": false
                                }
                            ],
                            "child": [
                                {
                                    "title": "دانشجو ها",
                                    "group": "students",
                                    "dependency": "ucvClass",
                                    "permission_title": [
                                        "مشاهده",
                                        "ویرایش",
                                        "حذف",
                                        "اضافه",
                                        "تایید",
                                    ],
                                    "permissions": [
                                        {
                                            "id": "scv",
                                            "title": "مشاهده دانشجوها"
                                        },
                                        {
                                            "id": "sca",
                                            "title": "اضافه کردن دانشجو",
                                            "disable": true,
                                            "default": false
                                        },
                                        {
                                            "id": "sce",
                                            "title": "ویرایش دانشجو",
                                            "disable": true,
                                            "default": false
                                        },
                                        {
                                            "id": "scd",
                                            "title": "حذف دانشجو",
                                            "disable": true,
                                            "default": false
                                        },
                                        {
                                            "id": "sct",
                                            "title": "تایید دانشجو",
                                            "disable": true,
                                            "default": false
                                        }
                                    ],
                                },
                                {
                                    "title": "اساتید",
                                    "group": "masters",
                                    "dependency": "uceClass",
                                    "permission_title": [
                                        "مشاهده",
                                        "ویرایش",
                                        "حذف",
                                        "اضافه",
                                        "تایید",
                                    ],
                                    "permissions": [
                                        {
                                            "id": "mcv",
                                            "title": "مشاهده اساتید"
                                        },
                                        {
                                            "id": "mca",
                                            "title": "اضافه کردن اساتید",
                                            "disable": true,
                                            "default": false
                                        },
                                        {
                                            "id": "mce",
                                            "title": "ویرایش اساتید",
                                            "disable": true,
                                            "default": false
                                        },
                                        {
                                            "id": "mcd",
                                            "title": "حذف اساتید",
                                            "disable": true,
                                            "default": false
                                        },
                                        {
                                            "id": "mct",
                                            "title": "تایید اساتید",
                                            "disable": true,
                                            "default": false
                                        }
                                    ],
                                }
                            ]
                        },
                        {
                            "title": "مرخصی",
                            "group": "vacation",
                            "permission_title": [
                                "مشاهده",
                                "ویرایش",
                                "حذف",
                                "اضافه"
                            ],
                            "permissions": [
                                {
                                    "id": "uvv",
                                    "title": "مشاهده مرخصی"
                                },
                                {
                                    "id": "uva",
                                    "title": "اضافه کردن مرخصی",
                                    "disable": true,
                                    "default": false
                                },
                                {
                                    "id": "uve",
                                    "title": "ویرایش مرخصی",
                                    "disable": true,
                                    "default": false
                                },
                                {
                                    "id": "uvd",
                                    "title": "حذف مرخصی",
                                    "disable": true,
                                    "default": false
                                }
                            ]
                        }
                    ]
                }
            ],
            userPermission: []
        }
    },
    created() {
        this.getRols();
    },
    computed: {
        permissionToArray() {
            let permissionList = [];
            this.userPermission.filter((obj) => {
                permissionList.push(obj.permission);
            })
            return permissionList;
        }
    },
    methods: {
        dependencyChecker(child, permission) {
            this.userPermission = this.userPermission.filter((obj) => {
                return obj.dependency != permission.id + child.group[0].toUpperCase() + child.group.substring(1)
            });
        },
        showDependency(data) {
            return data.dependency && !this.userPermission.find((obj) => {
                return obj.permission === data.dependency
            }) ? false : true
        },
        createRole() {
            axios.post("addRole", {permissions: this.userPermission, title: this.role.title}).then(res => {
                console.log(res)
            }).catch(e => {
                console.log(e)
            })
        },
        getRols() {
            axios.get("listOfRoles").then(res => {
                this.roleList = res.data.roles;
            }).catch(e => {
                console.log(e)
            })
        },
        getRoleForEdit(role) {
            axios.post("getRoleToEdit", {id: role.id}).then(res => {
                this.role.id = role.id;
                this.role.title = role.title
                this.userPermission = res.data.permissions;
            }).catch(e => {

            })
        },
        editRole() {
            axios.post("updateRole", {role: this.role, permissions: this.userPermission}).then(res => {
                console.log(res)
            }).catch(e => {

            })
        },
        deleteRole(id) {
            axios.post("destroyRole", {id: id}).then(res => {
                console.log(res)
            }).catch(e => {

            })
        }

    }
}
</script>

<style scoped>

</style>

