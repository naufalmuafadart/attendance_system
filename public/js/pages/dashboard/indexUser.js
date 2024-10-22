const setupPage = async () => {
    const response = await fetch("/api/announcement/latest_3");
    const responseJson = await response.json();

    const announcementContainer = document.getElementById("announcementContainer");
    const announcementTemplate = document.getElementById("announcementTemplate");

    const { data: announcements } = responseJson;
    if (announcements.length) {
        announcementContainer.classList.remove("d-none");
    }
    for (let i = 0; i < announcements.length; i++) {
        const announcement = announcements[i];
        const clon = announcementTemplate.content.cloneNode(true);

        const d = new Date(Date.parse(announcement.created_at));

        clon.querySelector("a").setAttribute('href', `/pengumuman/show/${announcement.id}`);
        clon.querySelector(".title").textContent = announcement.title;
        clon.querySelector(".created_at").textContent = d.toLocaleDateString('id-ID');
        announcementContainer.appendChild(clon);
    }
};

setupPage();
