const setupPage = async () => {
    let parts = window.location.href.split('/');
    const _id = parts[parts.length - 1];
    const response = await fetch(`/api/announcement/${_id}`);
    const responseJson = await response.json();
    if (response.ok) {
        const { data: announcement } = responseJson;
        const { title, content, created_at } = announcement;
        const d = new Date(Date.parse(created_at));
        document.querySelector('#announcementTitle').innerText = title;
        document.querySelector('#announcementDate').innerText = `Diumumkan pada ${d.toLocaleDateString('id-ID')}`;
        document.querySelector('#announcementContent').innerHTML = content;
        document.querySelector('#downloadAnchor').setAttribute('href', `/api/download/from_announcement?id=${_id}`);
        document.querySelector('#downloadAnchor').classList.remove('d-none');
    }
};

setupPage();
