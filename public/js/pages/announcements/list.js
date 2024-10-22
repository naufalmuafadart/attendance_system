const setupPage = async () => {
    const response = await fetch("/api/announcement");
    const responseJson = await response.json();

    if (response.ok) {
        const announcementContainer = document.getElementById("announcementContainer");
        const announcementTemplate = document.getElementById("announcementTemplate");
        const { data:  announcements } = responseJson;
        for (let announcement of announcements) {
            const clon = announcementTemplate.content.cloneNode(true);

            const d = new Date(Date.parse(announcement.created_at));

            clon.querySelector("a").setAttribute('href', `/pengumuman/show/${announcement.id}`);
            clon.querySelector("h4").textContent = announcement.title;
            clon.querySelector("span").textContent = d.toLocaleDateString('id-ID');
            announcementContainer.appendChild(clon);
        }
    } else {
        document.getElementById("textAnnouncementNotFound").classList.remove("d-none");
    }
};

setupPage();
