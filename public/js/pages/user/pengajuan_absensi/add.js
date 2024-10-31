// let blob_url = '';
// let file_name = '';
//
// const setupPage = () => {
//     const formSubmit = document.getElementById('formSubmit');
//     const inputUserId = document.getElementById('inputUserId');
//     const inputShiftId = document.getElementById('inputShiftId');
//     const mappingShiftExistSection = document.getElementById('mappingShiftExistSection');
//     const mappingShiftExistNotSection = document.getElementById('mappingShiftExistNotSection');
//     const inputShift = document.getElementById('inputShift');
//     const clockInCheckInput = document.getElementById('clockInCheckInput');
//     const clockOutCheckInput = document.getElementById('clockOutCheckInput');
//     const isClockInChecked = document.getElementById('isClockInChecked');
//     const isClockOutChecked = document.getElementById('isClockOutChecked');
//     const inputFile = document.getElementById('inputFile');
//     const inputDate = document.getElementById('inputDate');
//     const inputReason = document.getElementById('inputReason');
//     const clockInInput = document.getElementById('clockInInput');
//     const clockOutInput = document.getElementById('clockOutInput');
//
//     inputDate.addEventListener('change', async (e) => {
//         mappingShiftExistSection.classList.add('d-none');
//         mappingShiftExistNotSection.classList.remove('d-flex');
//         mappingShiftExistNotSection.classList.add('d-none');
//
//         const d = e.target.value;
//         const user_id = inputUserId.value;
//         const response = await fetch(`/api/shift/get_by_user_id_and_date?user_id=${user_id}&date=${d}`);
//         const responseJson = await response.json();
//
//         if (response.ok) {
//             const { data } = responseJson;
//             const { nama_shift, jam_masuk, jam_keluar, id } = data;
//             mappingShiftExistSection.classList.remove('d-none');
//             inputShiftId.value = id;
//             inputShift.value = `${nama_shift} (${jam_masuk}-${jam_keluar})`;
//         } else {
//             mappingShiftExistNotSection.classList.remove('d-none');
//             mappingShiftExistNotSection.classList.add('d-flex');
//         }
//     });
//
//     clockInCheckInput.onchange = (e) => {
//         if (isClockInChecked.value === '0') {
//             isClockInChecked.value = '1';
//         } else {
//             isClockInChecked.value = '0';
//         }
//     };
//
//     clockOutCheckInput.onchange = (e) => {
//         if (isClockOutChecked.value === '0') {
//             isClockOutChecked.value = '1';
//         } else {
//             isClockOutChecked.value = '0';
//         }
//     };
//
//     inputFile.addEventListener('change', async (e) => {
//         const file = e.target.files[0];
//         if (file) {
//             blob_url = URL.createObjectURL(file);
//             file_name = file.name;
//         }
//     })
//
//     formSubmit.addEventListener('submit', async (e) => {
//         e.preventDefault();
//
//         const formData = new FormData();
//         formData.append('user_id', inputUserId.value);
//         formData.append('date', inputDate.value);
//         if (isClockInChecked.value === '0' && isClockOutChecked.value === '0') {
//             alert('Jam masuk dan jam keluar harus dipilih salah satu atau keduanya');
//             return;
//         }
//         if (isClockInChecked.value === '1') {
//             formData.append('clock_in', clockInInput.value);
//         }
//         if (isClockOutChecked.value === '1') {
//             formData.append('clock_out', clockOutInput.value);
//         }
//         formData.append('reason', inputReason.value);
//
//         const responseBlob = await fetch(blob_url);
//         const file = await responseBlob.blob();
//         formData.append('file', file, file_name);
//
//         const response = await fetch('/api/attendance_request', {
//             method: 'POST',
//             body: formData,
//         });
//         const responseJson = await response.json();
//         console.log(responseJson);
//         if (response.ok) {
//             window.location.href = '/dashboard';
//         }
//         else {
//             const { message } = responseJson;
//             alert(message);
//         }
//     });
// };
//
// setupPage();

const { createApp, ref } = Vue;

const app = createApp({
    data() {
        return {
            user_id,
            is_has_fetch_date: false,
            is_no_shift: true,
            shift: null,
            is_btn_submit_disabled: false,
            blob_url: null,
            file_name: null,
        };
    },
    setup() {
        const dateModel = ref('');
        const shiftModel = ref('');
        const descriptionModel = ref('');
        const clockInCheckModel = ref(false);
        const clockInModel = ref('');
        const clockOutCheckModel = ref(false);
        const clockOutModel = ref('');
        return {
            dateModel,
            shiftModel,
            descriptionModel,
            clockInCheckModel,
            clockInModel,
            clockOutCheckModel,
            clockOutModel,
        };
    },
    watch: {
        async dateModel(newValue, oldValue) {
            const response = await fetch(`/api/shift/get_by_user_id_and_date?user_id=${this.user_id}&date=${newValue}`);
            const responseJson = await response.json();
            if (response.ok) {
                const { data } = responseJson;
                this.shift = data;
                this.shiftModel = `${this.shift.nama_shift} (${this.shift.jam_masuk}-${this.shift.jam_keluar})`;
                this.is_no_shift = false;
            } else if (response.status === 404) {
                this.is_no_shift = true;
            }
            this.is_has_fetch_date = true;
        },
    },
    methods: {
        onFileChange(e) {
            console.log('file change');
            const file = e.target.files[0];
            if (file) {
                this.blob_url = URL.createObjectURL(file);
                this.file_name = file.name;
            }
        },
        async onSubmit() {
            this.is_btn_submit_disabled = true;

            if (!this.clockInCheckModel && this.clockOutCheckModel) {
                alert('Clock in dan clock out harus dipilih salah satu atau keduanya');
                return;
            }

            if (this.clockInCheckModel && !this.clockInModel) {
                alert('Clock in harus diisi');
                return;
            }

            if (this.clockOutCheckModel && !this.clockOutModel) {
                alert('Clock out harus diisi');
                return;
            }

            if (!this.descriptionModel) {
                alert('Deskripsi / alasan wajib diisi');
                return;
            }

            if (!this.blob_url || !this.file_name) {
                alert('File bukti harus diunggah');
                return;
            }

            const formData = new FormData();
            formData.append('user_id', user_id);
            formData.append('date', this.dateModel);
            if (this.clockInCheckModel) {
                formData.append('clock_in', this.clockInModel);
            }

            if (this.clockOutCheckModel) {
                formData.append('clock_out', this.clockOutModel);
            }
            formData.append('reason', this.descriptionModel);

            const responseBlob = await fetch(this.blob_url);
            const blob = await responseBlob.blob();

            formData.append('file', blob, this.file_name);
            const response = await fetch('/api/attendance_request', {
                method: 'POST',
                body: formData,
            });
            const responseJson = await response.json();
            if (response.ok) {
                window.location.href = '/dashboard';
            }
            else {
                const { message } = responseJson;
                alert(message);
                this.is_btn_submit_disabled = false;
            }
        }
    }
});

app.mount('#app');
