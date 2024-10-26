const { createApp, ref } = Vue;

const app = createApp({
    data() {
        return {
            employees: [],
            selected_ids: [],
        };
    },
    setup() {
        const startDateModel = ref('');
        const endDateModel = ref('');
        const isLockLocation = ref(true);
        return {
            startDateModel,
            endDateModel,
            isLockLocation,
        };
    },
    async mounted() {
        const response = await fetch("/api/user/users_and_their_position");
        const responseJson = await response.json();
        this.employees = responseJson['data'];
    },
    computed: {
        areAllSelected() {
            return this.selected_ids.length === this.employees.length;
        }
    },
    methods: {
        onCheckboxUserChange(user_id, is_checked) {
            if (this.selected_ids.indexOf(user_id) === -1) {
                this.selected_ids.push(user_id);
            } else {
                this.selected_ids.slice(this.selected_ids.indexOf(user_id), 1);
            }
        },
        toggleSelectAll(event) {
            if (event.target.checked) {
                // If checked, add all employee IDs to selected_id array
                this.selected_ids = this.employees.map((employee) => employee.id);
            } else {
                // If unchecked, clear the selected_ids array
                this.selected_ids = [];
            }
        },
        async onSubmitMappingShift() {
            console.log('Submit Mapping shift');
            const data = {
                "shift_id": Number(shift_id),
                "selected_ids": this.selected_ids,
                "start_date": this.startDateModel,
                "end_date": this.endDateModel,
                "is_lock_location": this.isLockLocation,
            };
            document.getElementById('btnSubmitAssign').disabled = false;

            const response = await fetch('/api/mapping_shift', {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json',
                }
            });
            const responseJson = await response.json();
            if (response.ok) {
                // console.log(responseJson);
                window.location.href = '/shift';
            } else {
                const { message } = responseJson;
                alert(message);
            }
        },
    }
});

app.mount('#app');
