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
export function initList()
{
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

//
// index.php
//

// підрахунок елементів в списку
export function countItems() {
    // знаходимо елемент для запису
    let element = document.querySelector(".nrItems");

    // зчитуємо localeStorage
    let links = getFromLocaleStorage();

    // рахуємо кількість елементів
    let nrItems = links.length;

    // записуємо в елемент
    element.textContent = nrItems;
}

// додаємо подію
export function addEvent(){
let item = document.querySelector(".clear");
item.addEventListener("click",() => {
    clearList();
})}

// очищення списку
function clearList() 
{
    let status = prompt("Уведіть '1111' щоб очистити список");
    if (status == '1111')
    {
        initList();
        countItems();
        alert("Список очищено!");
    }
    else {
        alert("Код підтвердження невірний! Очищення скасовано.");
    }
}

// перевірка чи потрібна ініціалізація списку
export function checkInitList()
{
    if (localStorage.getItem("links") === null)
    {
        initList();
    }
}

// 
// add.php
// 

// зберегти посилання обробка події
export function eventSaveLink ()
{
    let item = document.querySelector(".btnSave");
    let input = document.querySelector(".input");
    
    item.addEventListener("click", () => {      
        setInLocaleStorage(input.value);
        alert("Посилання додано!")
        input.value = "";     
    })
}

// 
// list.php
// 

// створити елемент
export function mkItems(mp)
{
    // завантаження данних з сховища
    let links = getFromLocaleStorage();

    for (let link of links)
    {
        mkRequest(link,mp);
    }
}

// 
// запити
// 

export function mkRequest(url,mp)
{
    // створюємо запит
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./parseLink.php", true);

    // створюємо форму запиту
    let form = new FormData();
    form.append("link",url);
    
    // відправляємо запит
    xhr.send(form);

    // обробка відповіді сервера
    xhr.onload = () => {
        // ковертація строки в дом
        let domStr = new DOMParser();        
        let domObj = domStr.parseFromString(xhr.response,'text/html');

        // додаємо в елемент в дом
        domObj = domObj.querySelector('.item');
                        
        mp.appendChild(domObj);
    }
}