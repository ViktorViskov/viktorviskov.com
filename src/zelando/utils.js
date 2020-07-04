//
// робота з тегами
//

// створення елементу
export function crtTag(tagName, ...classes) {
    // створюємо елемент
    let item = document.createElement(tagName);

    // добавляємо класси
    for (className of classes) {
        item.classList.add(className);
    }

    // вертаємо елемент
    return item;
}

//
// робота з localeStorage
//

// ініціалізація списку
export function initList() {
    localStorage.setItem("links", JSON.stringify([]));
}

// запис елементу
export function setInLocaleStorage(link) {
    let links = JSON.parse(localStorage.getItem("links"));
    links.push(link);
    localStorage.setItem("links", JSON.stringify(links));
}

// взяти всі елементи
export function getFromLocaleStorage() {
    let arr = JSON.parse(localStorage.getItem("links"));
    return arr;
}
// підрахунок елементів в сховищі
function countLinks()
{
    // зчитуємо localeStorage
    let links = getFromLocaleStorage();

    // повертаємо кількість елементів
    return links.length
}

//
// index.php
//

// підрахунок елементів в списку
export function setCountItems() {
    // знаходимо елемент для запису
    let element = document.querySelector(".nrItems");

    // записуємо в елемент
    element.textContent = countLinks();
}

// додаємо подію
export function addEvent() {
    let item = document.querySelector(".clear");
    item.addEventListener("click", () => {
        clearList();
    });
}

// очищення списку
function clearList() {
    let status = prompt("Уведіть '1111' щоб очистити список");
    if (status == "1111") {
        initList();
        setCountItems();
        alert("Список очищено!");
    } else {
        alert("Код підтвердження невірний! Очищення скасовано.");
    }
}

// перевірка чи потрібна ініціалізація списку
export function checkInitList() {
    if (localStorage.getItem("links") === null) {
        initList();
    }
}

// блокування переглянути список при 0 кількості елементів в списку
export function blockShowBtn ()
{
    if (!countLinks())
    {
        let item = document.querySelector(".show");
        item.href = "#";
    }
}

//
// add.php
//

// зберегти посилання обробка події
export function eventSaveLink() {
    let item = document.querySelector(".btnSave");
    let input = document.querySelector(".input");

    item.addEventListener("click", () => {
        if (input.value) {
            setInLocaleStorage(input.value);
            alert("Посилання додано!");
            input.value = "";
        } else {
            alert("Введіть посилання.");
        }
    });
}

//
// list.php
//

// створити елемент
export function mkItems(mp) {
    // завантаження данних з сховища
    let links = getFromLocaleStorage();

    for (let i = 0; i < links.length; i++) {
        mkRequest(links[i], mp, i);
    }
}
// запис загальної кількості елементів в списку
export function setTotalAmount()
{
    let item = document.querySelector(".total");
    item.textContent = countLinks();
}
// обновити лічильник завантаженних даних
function updateCounter()
{
    let item = document.querySelector(".current");
    item.textContent = parseInt(item.textContent) + 1;
}

//
// запити
//

export function mkRequest(url, mp, nrItem) {
    // створюємо запит
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./parseLink.php", true);

    // створюємо форму запиту
    let form = new FormData();
    form.append("link", url);

    // відправляємо запит
    xhr.send(form);

    // обробка відповіді сервера
    xhr.onload = () => {
        // ковертація строки в дом
        let domStr = new DOMParser();
        let domObj = domStr.parseFromString(xhr.response, "text/html");

        // додаємо подію на видалення
        let delBtn = domObj.querySelector(".delete");
        delBtn.addEventListener("click", () => {
            if (confirm("Ви дійсно бажаєте видалити елемент?")) {
                deleteInArr(nrItem);
                domObj.remove();
                location.reload();
            }
        });

        // додаємо в елемент в дом
        domObj = domObj.querySelector(".item");
        mp.appendChild(domObj);

        // обновляємо лічильник завантаженних данних
        updateCounter();
    };
}

//
// list.php
//

// видали елемент з сховища
function deleteInArr(nr) {
    let arr = getFromLocaleStorage();
    let newArr = [];
    for (let i = 0; i < arr.length; i++) {
        if (i != nr) {
            newArr.push(arr[i]);
        } else {
            continue;
        }
    }
    localStorage.setItem("links", JSON.stringify(newArr));
}
