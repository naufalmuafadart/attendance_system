const { createApp, ref } = Vue;

const app = createApp({
    data() {
        return {
            shifts: null,
        }
    },
    setup() {
        const nameModel = ref('');
        const startDateModel = ref();
        const mondayShiftIdModel = ref(0);
        const tuesdayShiftIdModel = ref(0);
        const wednesdayShiftIdModel = ref(0);
        const thursdayShiftIdModel = ref(0);
        const fridayShiftIdModel = ref(0);
        const saturdayShiftIdModel = ref(0);
        const sundayShiftIdModel = ref(0);

        const secondMondayShiftIdModel = ref(0);
        const secondTuesdayShiftIdModel = ref(0);
        const secondWednesdayShiftIdModel = ref(0);
        const secondThursdayShiftIdModel = ref(0);
        const secondFridayShiftIdModel = ref(0);
        const secondSaturdayShiftIdModel = ref(0);
        const secondSundayShiftIdModel = ref(0);

        startDateModel.valueAsDate = new Date();

        return {
            nameModel,
            startDateModel,
            mondayShiftIdModel,
            tuesdayShiftIdModel,
            wednesdayShiftIdModel,
            thursdayShiftIdModel,
            fridayShiftIdModel,
            saturdayShiftIdModel,
            sundayShiftIdModel,
            secondMondayShiftIdModel,
            secondTuesdayShiftIdModel,
            secondWednesdayShiftIdModel,
            secondThursdayShiftIdModel,
            secondFridayShiftIdModel,
            secondSaturdayShiftIdModel,
            secondSundayShiftIdModel,
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

            this.secondMondayShiftIdModel = this.shifts[0]['id'];
            this.secondTuesdayShiftIdModel = this.shifts[0]['id'];
            this.secondWednesdayShiftIdModel = this.shifts[0]['id'];
            this.secondThursdayShiftIdModel = this.shifts[0]['id'];
            this.secondFridayShiftIdModel = this.shifts[0]['id'];
            this.secondSaturdayShiftIdModel = this.shifts[0]['id'];
            this.secondSundayShiftIdModel = this.shifts[0]['id'];
        }
    },
    methods: {
        async onSubmit() {
            const data = {
                "name": this.nameModel,
                "start_date": this.startDateModel,
                "monday_shift_id": this.mondayShiftIdModel,
                "tuesday_shift_id": this.tuesdayShiftIdModel,
                "wednesday_shift_id": this.wednesdayShiftIdModel,
                "thursday_shift_id": this.thursdayShiftIdModel,
                "friday_shift_id": this.fridayShiftIdModel,
                "saturday_shift_id": this.saturdayShiftIdModel,
                "sunday_shift_id": this.sundayShiftIdModel,
                "second_monday_shift_id": this.secondMondayShiftIdModel,
                "second_tuesday_shift_id": this.secondTuesdayShiftIdModel,
                "second_wednesday_shift_id": this.secondWednesdayShiftIdModel,
                "second_thursday_shift_id": this.secondThursdayShiftIdModel,
                "second_friday_shift_id": this.secondFridayShiftIdModel,
                "second_saturday_shift_id": this.secondSaturdayShiftIdModel,
                "second_sunday_shift_id": this.secondSundayShiftIdModel,
            };
            const response = await fetch('/api/two_week_shift_pattern', {
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
                window.location.href = '/admin/two_week_shift_pattern';
            }
        }
    },
});

app.mount('#app');
