const { createApp, ref } = Vue;

const app = createApp({
    data() {
        return {
            'requests': [],
            isModalVisible: false,
            selected_request_index: -1,
            btn_reject_has_clicked: false,
        };
    },
    setup() {
        const reasonModel = ref('');
        return {
            reasonModel,
        };
    },
    async mounted() {
        const response = await fetch('/api/attendance_request/admin_view');
        const responseJSON = await response.json();
        if (response.status === 200) {
            this.requests = responseJSON['data'];
            if (this.requests.length > 0) {
                this.selected_request_index= 0;
            }
        }
    },
    computed: {
        modalDisplay() {
            return this.isModalVisible ? 'block' : 'none';
        },
    },
    methods: {
        openModal(index) {
            this.selected_request_index = index;
            this.isModalVisible = true;
        },
        closeModal() {
            this.isModalVisible = false;
            this.btn_reject_has_clicked = false;
        },
        onBtnRejectClicked() {
            this.btn_reject_has_clicked = true;
        },
        async onApprove() {
            if (this.selected_request_index > -1) {
                if (confirm('Apakah anda yakin akan menerima pengajuan absen ini?')) {
                    const url = `/api/attendance_request/approve/${this.requests[this.selected_request_index].id}`;
                    const response = await fetch(url, {
                        method: 'POST',
                    });
                    const responseJSON = await response.json();
                    if (response.status === 200) {
                        window.location.reload();
                    } else {
                        alert(responseJSON.message);
                    }
                }
            }
        },
        async onReject() {
            if (this.selected_request_index > -1) {
                if (confirm('Apakah anda yakin akan menolak pengajuan absen ini?')) {
                    const url = `/api/attendance_request/reject/${this.requests[this.selected_request_index].id}`;
                    const data = { 'reason': this.reasonModel };
                    if (data['reason'] === '') {
                        alert('Alasan pengajuan tidak boleh kosong');
                        return;
                    }
                    const response = await fetch(url, {
                        method: 'POST',
                        body: JSON.stringify(data),
                        headers: {
                            'Content-Type': 'application/json',
                        },
                    });
                    const responseJSON = await response.json();
                    if (response.status === 200) {
                        window.location.reload();
                    } else {
                        alert(responseJSON.message);
                    }
                }
            }
        },
    },
});

app.mount('#app');
