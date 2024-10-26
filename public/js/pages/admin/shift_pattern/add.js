const { createApp, ref } = Vue;

const app = createApp({
    data() {
        return {
            shifts: null,
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
        const response = await fetch('/api/shift');
        const responseJson = await response.json();
        if (response.status === 200) {
            this.shifts = responseJson['data'];
            this.mondayShiftIdModel = this.shifts[0]['id'];
            this.tuesdayShiftIdModel = this.shifts[0]['id'];
            this.wednesdayShiftIdModel = this.shifts[0]['id'];
            this.thursdayShiftIdModel = this.shifts[0]['id'];
            this.fridayShiftIdModel = this.shifts[0]['id'];
            this.saturdayShiftIdModel = this.shifts[0]['id'];
            this.sundayShiftIdModel = this.shifts[0]['id'];
        }
    },
    methods: {
        async onSubmit() {
            const data = {
                "name": this.nameModel,
                "monday_shift_id": this.mondayShiftIdModel,
                "tuesday_shift_id": this.tuesdayShiftIdModel,
                "wednesday_shift_id": this.wednesdayShiftIdModel,
                "thursday_shift_id": this.thursdayShiftIdModel,
                "friday_shift_id": this.fridayShiftIdModel,
                "saturday_shift_id": this.saturdayShiftIdModel,
                "sunday_shift_id": this.sundayShiftIdModel,
            };
            const response = await fetch('/api/shift_pattern', {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json',
                }
            });

            const responseJson = await response.json();

            if (!response.ok) {
                alert(responseJson.message);
            } else {
                window.location.href = '/admin/shift_pattern';
            }
        }
    },
});

app.mount('#app');
