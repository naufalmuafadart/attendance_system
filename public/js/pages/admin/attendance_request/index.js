const { createApp, ref } = Vue;

const rowUser = {
    props: {
        index: Number,
        user_name: String,
        date: String,
        shift_name: String,
        clock_in: String,
        clock_out: String,
        reason: String,
        status: String,
        file: String,
    },
    data() {
        return {
            imageURL: '',
        };
    },
    async mounted() {
        if (this.isFileIsAnImage(this.file)) {
            await this.displayImage();
        }
    },
    template: `
    <tr>
        <td>{{ index + 1 }}</td>
        <td>{{ user_name }}</td>
        <td>{{ date }}</td>
        <td>{{ shift_name }}</td>
        <td>{{ clock_in == null ? '-' : clock_in }}</td>
        <td>{{ clock_out == null ? '-' : clock_out }}</td>
        <td>{{ reason }}</td>
        
        <td v-if="!isFileIsAnImage(file)">
            <button class="btn btn-primary" @click="downloadFile">
                <i class="fa fa-download" style="font-size: 1rem;"></i>
            </button>
        </td>
        <td v-else="">
            <img :src="imageURL" alt="prove_image" style="max-width: 5rem;"/>
        </td>
        
        <td v-if="status==='pending'"><span class="badge badge-pill badge-warning">Pending</span></td>
        <td v-else-if="status==='approved'"><span class="badge badge-pill badge-success">Diterima</span></td>
        <td v-else="status==='rejected'"><span class="badge badge-pill badge-danger">Ditolak</span></td>
        
        <td>
            <button class="btn btn-info" @click="openModal">
                  <i class="material-icons" style="font-size: 1rem;">call_made</i>
            </button>
        </td>
    </tr>
    `,
    methods: {
        downloadFile() {
            this.$emit('download-file', this.index);
        },
        openModal() {
            this.$emit('open-modal', this.index);
        },
        isFileIsAnImage(fileName) {
            // Define the common image extensions
            const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg', 'tiff'];

            // Get the file extension in lowercase
            const extension = fileName.split('.').pop().toLowerCase();

            // Check if the extension is in the list of image extensions
            return imageExtensions.includes(extension);
        },
        async displayImage() {
            const myHeaders = new Headers();
            myHeaders.append("Content-Type", "application/json");

            const raw = JSON.stringify({
                "path": this.file
            });

            const requestOptions = {
                method: "POST",
                headers: myHeaders,
                body: raw,
                redirect: "follow"
            };

            const response = await fetch("/api/download", requestOptions);
            if (response.ok) {
                const blob = await response.blob();
                this.imageURL = URL.createObjectURL(blob);
            }
        }
    }
}

const detailModal = {
    props: {
        user_name: String,
        date: String,
        shift_name: String,
        clock_in: String,
        clock_out: String,
        reason: String,
        is_shown: Boolean,
        status: String,
        file: String,
        index: Number,
    },
    data() {
        return {
            modalDisplay: 'none',
            btn_reject_has_clicked: false,
            imageURL: '',
        };
    },
    async mounted() {
        if (this.isFileIsAnImage(this.file)) {
            await this.displayImage();
        }
    },
    setup() {
        const reasonModel = ref('');
        return {
            reasonModel,
        };
    },
    watch: {
        is_shown(newValue, oldValue) {
            this.modalDisplay = newValue ? 'block' : 'none';
            this. btn_reject_has_clicked = false;
        },
        async file(newValue, oldValue) {
            if (this.isFileIsAnImage(newValue)) {
                await this.displayImage();
            }
        }
    },
    template: `
        <div id="largeModal" class="custom-modal-overlay" :style="{ 'display': modalDisplay }">
            <div class="custom-modal-content">
                <span class="custom-modal-close-button" @click="onClose">&times;</span>
                <h2>Detail pengajuan absen</h2>
                <table class="table table-bordered table-striped mb-2">
                    <tbody>
                    <tr>
                        <td>Nama Karyawan</td>
                        <td style="text-align: right;">{{ user_name }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td style="text-align: right;">{{ date }}</td>
                    </tr>
                    <tr>
                        <td>Shift</td>
                        <td style="text-align: right;">{{ shift_name }}</td>
                    </tr>
                    <tr>
                        <td>Clock In</td>
                        <td style="text-align: right;">{{ clock_in == null ? '-' : clock_in }}</td>
                    </tr>
                    <tr>
                        <td>Clock out</td>
                        <td style="text-align: right;">{{ clock_out == null ? '-' : clock_out }}</td>
                    </tr>
                    <tr>
                        <td>Alasan</td>
                        <td style="text-align: right;">{{ reason }}</td>
                    </tr>
                    <tr>
                        <td>File</td>
                        <td style="text-align: right;" v-if="!isFileIsAnImage(file)">
                            <button @click="downloadFile">Download</button>
                        </td>
                        <td v-else="" style="text-align: right"><img :src="imageURL" alt="prove image" style="max-width: 50%;"/></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td style="text-align: right;">{{ status }}</td>
                    </tr>
                    <tr v-if="status==='rejected'">
                        <td>Alasan ditolak</td>
                        <td style="text-align: right;">{{ reject_reason }}</td>
                    </tr>
                    </tbody>
                </table>

                <div class="d-flex justify-content-center" v-if="status === 'pending'">
                    <button class="btn btn-info" @click="onApprove">
                        <i data-feather="check" style="height: 1rem"></i>
                        Terima
                    </button>
                    <div style="width: 10px;"></div>
                    <button class="btn btn-danger" @click="onBtnRejectClicked">
                        <i data-feather="x" style="height: 1rem"></i>
                        Tolak
                    </button>
                </div>
                <form v-if="status === 'pending' && btn_reject_has_clicked" @submit.prevent="onReject">
                    <h3>Alasan Penolakan</h3>
                    <div class="form-group">
                        <input type="text" class="form-control" v-model="reasonModel">
                    </div>
                    <button class="btn btn-info">Submit Penolakan</button>
                </form>
            </div>
        </div>
    `,
    methods: {
        onBtnRejectClicked() {
            this.btn_reject_has_clicked = true;
        },
        onApprove() {
            this.$emit('on-approve');
        },
        onReject() {
            this.$emit('on-reject', this.reasonModel);
        },
        onClose() {
            this.$emit('close-modal');
        },
        isFileIsAnImage(fileName) {
            // Define the common image extensions
            const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg', 'tiff'];

            // Get the file extension in lowercase
            const extension = fileName.split('.').pop().toLowerCase();

            // Check if the extension is in the list of image extensions
            return imageExtensions.includes(extension);
        },
        async displayImage() {
            const myHeaders = new Headers();
            myHeaders.append("Content-Type", "application/json");

            const raw = JSON.stringify({
                "path": this.file
            });

            const requestOptions = {
                method: "POST",
                headers: myHeaders,
                body: raw,
                redirect: "follow"
            };

            const response = await fetch("/api/download", requestOptions);
            if (response.ok) {
                const blob = await response.blob();
                this.imageURL = URL.createObjectURL(blob);
            }
        },
        downloadFile() {
            this.$emit('download-file', this.index);
        },
    }
};

const app = createApp({
    data() {
        return {
            'requests': [],
            isModalVisible: false,
            selected_request_index: -1,
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
    methods: {
        openModal(index) {
            this.selected_request_index = index;
            this.isModalVisible = true;
        },
        closeModal() {
            this.isModalVisible = false;
        },
        downloadFile(index) {
            if (index > -1) {
                const path = this.requests[index].file;
                const myHeaders = new Headers();
                myHeaders.append("Content-Type", "application/json");

                const raw = JSON.stringify({path});

                const requestOptions = {
                    method: "POST",
                    headers: myHeaders,
                    body: raw,
                    redirect: "follow"
                };

                fetch("/api/download", requestOptions)
                    .then((response) => response.blob())
                    .then((blob) => {
                        const url = window.URL.createObjectURL(blob); // Create a URL for the Blob
                        const a = document.createElement('a'); // Create a temporary anchor element
                        a.style.display = 'none';
                        a.href = url;
                        a.download = path.substring(33); // Set the download attribute with a filename
                        document.body.appendChild(a);
                        a.click(); // Trigger the download
                        window.URL.revokeObjectURL(url); // Release the Blob URL after the download
                        document.body.removeChild(a); // Remove the temporary anchor
                    })
                    .catch((error) => console.error(error));
            }
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
        async onReject(reason) {
            if (this.selected_request_index > -1) {
                if (confirm('Apakah anda yakin akan menolak pengajuan absen ini?')) {
                    const url = `/api/attendance_request/reject/${this.requests[this.selected_request_index].id}`;
                    const data = { reason };
                    if (data['reason'] === '') {
                        alert('Alasan penolakan tidak boleh kosong');
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

app.component('row-user', rowUser);
app.component('detail-modal', detailModal);

app.mount('#app');
