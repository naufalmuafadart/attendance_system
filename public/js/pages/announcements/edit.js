const setupPage = () => {
    const inputFile = document.getElementById('inputFile');
    const oldFileNameP = document.getElementById('oldFileNameP');
    const oldFileNameCross = document.getElementById('oldFileNameCross');

    oldFileNameCross.onclick = () => {
        oldFileNameP.classList.add('d-none');
        inputFile.classList.remove('d-none');
    };
};

setupPage();
