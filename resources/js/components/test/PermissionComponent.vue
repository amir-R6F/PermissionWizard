<template>
    <div>
        <div class="gridSystem my-xl-4" v-for="(child, j) in data" :key="j"
             v-if="showDependency(child)">

            <span class="font-bold text-base md:grow md:justify-self-auto" v-text="child.title"></span>
            <div v-for="(permission, k) in child.permissions" :key="k">
                <b-form-checkbox
                    @change="pushData(child, permission, $event)"
                    class="text-sm md:grow flex flex-row-reverse ">
                    {{ permission.title }}
                </b-form-checkbox>
            </div>
            <permission-component :data="child.child"></permission-component>
        </div>

    </div>
</template>

<script>
export default {
    name: "PermissionComponent",
    props: ["data"],
    data() {
        return {}
    },
    methods: {
        pushData(child, permission, e) {
            if (e.target.checked) {
                let value = {
                    permission: permission.id + child.group[0].toUpperCase() + child.group.substring(1),
                    dependency: child.dependency ? child.dependency : null
                }
                event.$emit("dependencyCheck");
                event.$emit("pushData", value)
            } else {
                event.$emit("dependencyCheck");
            }
        },
        showDependency(data){
            event.$emit("CheckShowDependency", data);
        }
    }
}
</script>

<style scoped>

</style>
