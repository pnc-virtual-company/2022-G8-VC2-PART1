<template>
    <div class="main_container">
        <list_form @filters="getFilters"></list_form>
        <list_card :filterData="filterData"></list_card>
    </div>
</template>

<script>
import ListCard from "@/components/list_all_leave/ListAllLeaveCard.vue";
import ListForm from "@/components/list_all_leave/ListForm.vue"
export default {
    data() {
        return {
            filter_status: "",
            filter_leave_type: ""
        }
    },
    components: {
        "list_card": ListCard,
        "list_form": ListForm,
    },
    inject: ['list_all_leaves'],
    methods: {
        getFilters(filter_status, filter_leave_type) {
            this.filter_status = filter_status
            this.filter_leave_type = filter_leave_type
        }
    },
    computed: {
        filterData() {
            let all_data = this.list_all_leaves;
            if (this.filter_status !== "Show all" && this.filter_leave_type !== "Show all") {
                all_data = this.list_all_leaves.filter(students => (students.status.toLowerCase() == this.filter_status.toLowerCase()) && (students.leave_type == this.filter_leave_type))
            }
            if (this.filter_status !== "Show all") {
                all_data == this.list_all_leaves.filter(students => students.status.toLowerCase() == this.filter_status.toLowerCase())
            }
            if (this.filter_leave_type !== "Show all") {
                all_data == this.list_all_leaves.filter(students => students.leave_type == this.filter_leave_type)
            }
            if (all_data.length > 0) {
                return all_data
            } else {
                return this.list_all_leaves
            }
        }
    }
}
</script>

<style scoped>
</style>