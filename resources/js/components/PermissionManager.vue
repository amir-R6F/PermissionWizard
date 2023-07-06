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

            <b-form-checkbox-group v-model="userPermission">
                <b-checkbox :value="{permission: 'isAdmin', dependency: null}"
                            @change="!userPermission.find((obj) => {return obj.permission === 'isAdmin'})? userPermission = [] : true"></b-checkbox>

                <b-card v-for="(section, i) in availablePermission" :key="i"
                        v-if="showDependency(section)">

                    <b-card-header>
                        <span class="font-bold text-base" v-text="section.title"></span>
                    </b-card-header>

                    <b-card-title>
                        <div class="gridSystem font-bold text-base rounded-lg bg-sky p-2 text-fog">
                            <div class="md:justify-self-auto">Parent</div>
                            <div>View</div>
                            <div>Add</div>
                            <div>Edite</div>
                            <div>Delete</div>
                        </div>
                    </b-card-title>

                    <div class="my-xl-4" v-for="(child, j) in section.child" :key="j"
                         v-if="showDependency(child)">
                        <div class="gridSystem">
                            <span class="font-bold text-base md:grow md:justify-self-auto" v-text="child.title"></span>
                            <div class="contents" v-for="(permission, k) in child.permissions" :key="k">
                                <b-form-checkbox
                                    :value="{permission: permission.id + child.group[0].toUpperCase() + child.group.substring(1), dependency: child.dependency? child.dependency: null}"
                                    @change="dependencyChecker(child, permission)"
                                    class="text-sm md:grow flex flex-row-reverse ">
                                    {{ permission.title }}
                                </b-form-checkbox>
                            </div>
                        </div>

                        <div class="gridSystem" v-for="(sub, s) in child.subMenu"
                             v-if="showDependency(sub)">

                            <span class="font-bold text-base md:grow md:justify-self-auto" v-text="sub.title"></span>
                            <div class="contents" v-for="(permission, g) in sub.permissions" >
                                <b-form-checkbox
                                    :value="{permission: permission.id + sub.group[0].toUpperCase() + sub.group.substring(1), dependency: sub.dependency? sub.dependency: null}"
                                    @change="dependencyChecker(sub, permission)"
                                    class="text-sm md:grow flex flex-row-reverse ">
                                    {{ permission.title }}
                                </b-form-checkbox>
                            </div>

                        </div>

                    </div>
                </b-card>
            </b-form-checkbox-group>

            <b-btn variant="outline-primary" @click="createRole" v-if="!role.id">create role</b-btn>
            <b-btn variant="outline-primary" @click="editRole" v-else>edit role</b-btn>
            {{ userPermission }}
        </div>
    </div>
</template>

<script>

export default {
    name: "PermissionManager",
    props:['per'],
    data() {
        return {
            role: {
                id: null,
                title: null
            },
            roleList: [],
            availablePermission: this.per,
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
<!--        <b-form-checkbox-group v-model="userPermission">-->
<!--            <b-checkbox value="isAdmin"></b-checkbox>-->
<!--            <b-card v-for="(section, i) in availablePermission" :key="i"-->
<!--                    v-if="section.dependency?  userPermission.includes('isAdmin'): false">-->
<!--                <h1 v-text="section.title"></h1>-->
<!--                <b-row v-for="(child, j) in section.child" :key="j"-->
<!--                       v-if="child.dependency && !userPermission.includes(child.dependency)? false : true">-->
<!--                    <h1 v-text="child.title"></h1>-->
<!--                    <b-form-checkbox v-for="(permission, k) in child.permissions" :key="k"-->
<!--                                     :value="permission.id + child.group[0].toUpperCase() + child.group.substring(1)">-->
<!--                        {{ permission.title }}-->
<!--                    </b-form-checkbox>-->
<!--                </b-row>-->
<!--            </b-card>-->
<!--        </b-form-checkbox-group>-->
