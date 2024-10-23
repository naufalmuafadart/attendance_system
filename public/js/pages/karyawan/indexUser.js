const showList = (data) => {
    const userContainer = document.getElementById('userContainer');
    const userTemplate = document.getElementById('userTemplate');
    userContainer.innerHTML = '';
    for (let index = 0; index < data.length; index++) {
        const clon = userTemplate.content.cloneNode(true);
        clon.querySelector('.name').innerText = data[index].name;
        clon.querySelector('.position').innerText = data[index].nama_jabatan;
        clon.querySelector('.phone').innerText = data[index].telepon;
        clon.querySelector('.phone').setAttribute('href', `https://wa.me/62${data[index].telepon.substring(1, data[index].telepon.length)}`);
        clon.querySelector('.userAnchor').setAttribute('href', `/pegawai/show/${data[index].id}`);
        userContainer.appendChild(clon);
    }
};

const setupPage = async () => {
    const userContainer = document.getElementById('userContainer');
    const userTemplate = document.getElementById('userTemplate');
    const response = await fetch('/api/user/users_and_their_position');
    const responseJson = await response.json();
    const { data } = responseJson;
    showList(data);
    // for (let index = 0; index < data.length; index++) {
    //     const clon = userTemplate.content.cloneNode(true);
    //     clon.querySelector('.name').innerText = data[index].name;
    //     clon.querySelector('.position').innerText = data[index].nama_jabatan;
    //     clon.querySelector('.phone').innerText = data[index].telepon;
    //     clon.querySelector('.phone').setAttribute('href', `https://wa.me/62${data[index].telepon.substring(1, data[index].telepon.length)}`);
    //     clon.querySelector('.userAnchor').setAttribute('href', `/pegawai/show/${data[index].id}`);
    //     userContainer.appendChild(clon);
    // }

    document.getElementById("inputSearch").oninput = (e) => {
        const input = e.target.value;
        const filtered_data = data.filter((datum) => datum.name.toLowerCase().includes(input.toLowerCase()));
        showList(filtered_data);
    };
};

setupPage();
