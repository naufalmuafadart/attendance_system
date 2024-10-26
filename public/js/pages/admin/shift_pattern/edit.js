const { createApp, ref } = Vue;

const app = createApp({
    data() {
        return {
            shifts: null,
            shift_pattern: null,
            users: [],
            selected_ids: [],
            shift_pattern_id,
        }
    },
    setup() {
        const nameModel = ref('');
        const mondayShiftIdModel = ref(0);
        const tuesdayShiftIdModel = ref(0);
        const wednesdayShiftIdModel = ref(0);
        const thursdayShiftIdModel = ref(0);
        const fridayShiftIdModel = ref(0);
        const saturdayShiftIdModel = ref(0);
        const sundayShiftIdModel = ref(0);

        return {
            nameModel,
            mondayShiftIdModel,
            tuesdayShiftIdModel,
            wednesdayShiftIdModel,
            thursdayShiftIdModel,
            fridayShiftIdModel,
            saturdayShiftIdModel,
            sundayShiftIdModel,
        };
    },
    async mounted() {
        let response = await fetch('/api/shift/');
        let responseJson = await response.json();
        if (response.status === 200) {
            this.shifts = responseJson['data'];
        }

        response = await fetch( `/api/shift_pattern/${this.shift_pattern_id}`);
        responseJson = await response.json();
        if (response.status === 200) {
            this.shift_pattern = responseJson['data'];
            this.nameModel =  this.shift_pattern.name;
            this.mondayShiftIdModel = this.shift_pattern['monday_shift_id'];
            this.tuesdayShiftIdModel = this.shift_pattern['tuesday_shift_id'];
            this.wednesdayShiftIdModel = this.shift_pattern['wednesday_shift_id'];
            this.thursdayShiftIdModel = this.shift_pattern['thursday_shift_id'];
            this.fridayShiftIdModel = this.shift_pattern['friday_shift_id'];
            this.saturdayShiftIdModel = this.shift_pattern['saturday_shift_id'];
            this.sundayShiftIdModel = this.shift_pattern['sunday_shift_id'];
        }

        response = await fetch('/api/user/users_and_their_position');
        responseJson = await response.json();
        if (response.status === 200) {
            this.users = responseJson['data'];
        }

        response = await fetch(`/api/user/shift_pattern/${this.shift_pattern_id}`);
        responseJson = await response.json();
        if (response.status === 200) {
            this.selected_ids = responseJson['data'].map((datum) => datum.id);
        }
    },
    computed: {
        areAllSelected() {
            return this.selected_ids.length === this.users.length;
        },
    },
    methods: {
        toggleSelectAll(event) {
            if (event.target.checked) {
                this.selected_ids = this.users.map((user) => user.id);
            } else {
                // If unchecked, clear the selected_ids array
                this.selected_ids = [];
            }
        },
        async onAssignEmployee() {
            const data = {
                'arr_id': this.selected_ids,
                'shift_pattern_id': this.shift_pattern_id,
            };
            const response = await fetch('/api/shift_pattern/assign_user', {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json',
                }
            });
            const responseJSON = await response.json();

            if (response.status === 200) {
                window.location.reload();
            } else {
                alert(responseJSON.message);
            }
        }
    }
});

app.mount('#app');
