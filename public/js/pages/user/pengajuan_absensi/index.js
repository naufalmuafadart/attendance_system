const { createApp, ref } = Vue;

const app = createApp({
    data() {
        return {
            requests: [],
            user_id,
        };
    },
    setup() {
        const firstDateModel = ref('');
        const lastDateModel = ref('');

        return {
            firstDateModel,
            lastDateModel,
        };
    },
    async mounted() {
        const response = await fetch(`/api/attendance_request/user_view/${this.user_id}`);
        const responseJson = await response.json();
        if (response.status === 200) {
            this.requests = responseJson['data'];
        }
    },
    computed: {
        // a computed getter
        filteredRequests() {
            if (this.requests.length === 0) return [];
            // if (this.firstDateModel === '' && this.lastDateModel !== '') {
            //     return this.requests;
            // }
            if (this.firstDateModel !== '' && this.lastDateModel !== '') {
                return this.requests.filter((request) => {
                    const firstDate = new Date(Date.parse(this.firstDateModel));
                    const lastDate = new Date(Date.parse(this.lastDateModel));
                    const d = new Date(request.date);
                    return d >= firstDate && d <= lastDate;
                });
            }
            if (this.firstDateModel !== '') {
                return this.requests.filter((request) => {
                    const firstDate = new Date(Date.parse(this.firstDateModel));
                    const d = new Date(request.date);
                    return d >= firstDate;
                });
            }
            if (this.lastDateModel !== '') {
                return this.requests.filter((request) => {
                    const lastDate = new Date(Date.parse(this.lastDateModel));
                    const d = new Date(request.date);
                    return d <= lastDate;
                });
            }
            return this.requests;
        }
    }
});

app.mount('#app');
