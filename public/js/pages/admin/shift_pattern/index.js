const { createApp, ref } = Vue;

const app = createApp({
    data() {
        return {
            shift_patterns: 'tst'
        };
    },
    async mounted() {
        const response = await fetch('/api/shift_pattern');
        const responseJSON = await response.json();
        if (response.status === 200) {
            this.shift_patterns = responseJSON['data'];
        }
    },
});

app.mount('#app');
